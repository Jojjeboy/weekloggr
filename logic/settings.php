<?php


Flight::route('/settings', function () {
    $settings = Flight::selectData("select * from settings");

    $archiveOld = false;
    foreach ($settings as $setting) {
        if ($setting['key'] === 'archiveOld') {
            $archiveOld = (bool) $setting['value'];
        }
        if ($setting['key'] === 'archiveAfter') {
            $archiveAfter = $setting['value'];
        }
    }

    Flight::renderSettings($archiveOld, $archiveAfter);
});

Flight::route('/settings/update', function () {
    if (Flight::request()->method == 'POST') {

        $db = Flight::setup();

        if (Flight::request()->data->archiveOld != null) {
            $sql = "UPDATE settings SET value = :value WHERE settings.`key` = 'archiveOld'";
            $archiveOld = Flight::request()->data->archiveOld;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':value', $archiveOld, PDO::PARAM_STR);
            $stmt->execute();
        }
        if (Flight::request()->data->archiveAfter) {
            $sql = "UPDATE settings SET value = :value WHERE settings.`key` = 'archiveAfter'";
            $archiveAfter = Flight::request()->data->archiveAfter;
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':value', $archiveAfter, PDO::PARAM_STR);
            $stmt->execute();
            Flight::archiveold($archiveAfter);
        }
    }

    Flight::redirect('/settings');
});

Flight::map('archiveold', function ($nrOfDaysOffset) {

    $db = Flight::setup();

    $sql = "UPDATE weekloggr SET is_visible = :is_visible";
    $stmt = $db->prepare($sql);
    $archivedStatus = 1;
    $stmt->bindParam(':is_visible', $archivedStatus, PDO::PARAM_INT);
    $stmt->execute();

    if ($nrOfDaysOffset !== 'none') {
        $sql = "UPDATE weekloggr SET is_visible = :is_visible WHERE date < now() - interval $nrOfDaysOffset DAY";
        $stmt = $db->prepare($sql);
        $archivedStatus = 0;
        $stmt->bindParam(':is_visible', $archivedStatus, PDO::PARAM_INT);
        $stmt->execute();
    }
});