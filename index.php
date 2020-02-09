<?php
require 'flight/Flight.php';

Flight::set('base_url', 'http://' . Flight::request()->host);

Flight::route('/', function () {
    if((bool) Flight::getSetting('archiveOld')){
        $nrOfDaysToArchive = Flight::getSetting('archiveAfter');
        Flight::archiveold($nrOfDaysToArchive);   
    }
    $logs = Flight::selectData("SELECT * FROM `weekloggr` order by date");
    Flight::render(
        'template.php',
        array(
            'weeklogs' => $logs,
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        )
    );
});

Flight::route('/hashtag/@tag', function ($tag) {
    $logs = Flight::selectData("select * from v_weekloggr_tags vwt where vwt.name = '#$tag'");
    if (count($logs) < 1) {
        Flight::redirect('/');
    }
    Flight::render(
        'template.php',
        array(
            'weeklogs' => $logs,
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        )
    );
});

Flight::route('/addlog', function () {
    if (Flight::request()->method == 'POST') {
        Flight::create(Flight::request()->data);
    }
    Flight::redirect('/');
});


Flight::route('/update/@id', function ($id) {
    if (Flight::request()->method == 'POST') {
        Flight::delete($id);
        Flight::create(Flight::request()->data);
    }
    Flight::redirect('/');
});

Flight::route('/delete/@id', function ($id) {
    Flight::delete($id);
    Flight::redirect('/');
});

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

    Flight::render(
        'settings.php',
        array(
            'archiveOld' => $archiveOld,
            'archiveAfter' => $archiveAfter,
            'base_url' => Flight::get('base_url')
        )
    );
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
    

    $sql = "UPDATE weekloggr SET is_visible = 1";
    $sql = "UPDATE weekloggr SET is_visible = :is_visible WHERE date < now() - interval $nrOfDaysOffset DAY";

    $stmt = $db->prepare($sql);
    $archivedStatus = 0;
    $stmt->bindParam(':is_visible', $archivedStatus, PDO::PARAM_INT);
    $stmt->execute();
});

Flight::map('create', function ($requestData) {
    $db = Flight::setup();

    $sql = "INSERT INTO weekloggr (text, weeknr, date) VALUES (?,?,?)";
    $arrayOfDBParams = array($requestData->weeklog, Flight::getWeekNr(null), date("Y-m-d"));
    if ($requestData->date != null) {
        $arrayOfDBParams = array($requestData->weeklog, Flight::getWeekNr($requestData->date), $requestData->date);
    }
    $successfullyInserted = $db->prepare($sql)->execute($arrayOfDBParams);

    $tags = Flight::extractHashTags($requestData->weeklog);

    if (count($tags) > 0 && $successfullyInserted) {
        $lastInsertedWeekloggrId = $db->lastInsertId();
        foreach ($tags as $tag) {
            $tagId = Flight::doesTagExist($tag);
            if ($tagId) {
                $sql = "INSERT INTO weekloggr_tags (weekloggr_id, tags_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$lastInsertedWeekloggrId, $tagId]);
            } else {
                $sql = "INSERT INTO tags (name) VALUES (?)";
                $db->prepare($sql)->execute([$tag]);
                $lastTagId = $db->lastInsertId();

                $sql = "INSERT INTO weekloggr_tags (weekloggr_id, tags_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$lastInsertedWeekloggrId, $lastTagId]);
            }
        }
    }
});

Flight::map('delete', function ($id) {
    $successfullyDeletedAll = false;
    $db = Flight::setup();
    $sql = 'DELETE FROM weekloggr WHERE weekloggr_id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $successfullyDeleted = $stmt->execute();

    if ($successfullyDeleted) {

        // Delete orphan tags
        $sql = 'DELETE FROM tags WHERE tags.id NOT IN (SELECT tags_id FROM `weekloggr_tags`)';
        $stmt = $db->prepare($sql);
        $stmt->execute();

        $successfullyDeletedAll = true;
    }

    return $successfullyDeletedAll;
});

Flight::map('extractHashTags', function ($string) {
    preg_match_all("/(#\w+)/u", $string, $matches);
    return $matches[0];
});


Flight::map('setup', function () {

    $pass = strpos(Flight::request()->user_agent, 'Win64') !== false ? 'mysql' : 'root';

    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', $pass));


    return Flight::db();
});

Flight::map('getWeekNr', function ($inputDate) {
    if ($inputDate) {
        $dt = new DateTime($inputDate);
    } else {
        $dt = new DateTime();
    }
    $weeknr = $dt->format("W");
    if ($weeknr[0] == "0") {
        $weeknr = $weeknr[1];
    }
    return $weeknr;
});


Flight::map('selectData', function ($sql) {
    $db = Flight::setup();
    $logs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $logs;
});

Flight::map('doesTagExist', function ($tag) {
    $res = Flight::selectData("select tags_id from tags where name = '$tag'");
    if (count($res)) {
        return $res[0]['tags_id'];
    }
    return null;
});


Flight::map('getSetting', function ($key) {
    $res = Flight::selectData("select value from settings WHERE settings.`key` = '$key'");
    if (count($res)) {
        return $res[0]['value'];
    }
    return null;
});


Flight::start();
