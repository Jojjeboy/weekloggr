<?php

Flight::map('setup', function () {

    $pass = strpos(Flight::request()->user_agent, 'Win64') !== false ? 'mysql' : 'root';

    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', $pass));


    return Flight::db();
});

Flight::map('selectData', function ($sql) {
    $db = Flight::setup();
    $logs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $logs;
});

Flight::map('delete', function ($id, $table) {
    $db = Flight::setup();
    $sql = 'DELETE FROM `' . $table . '` WHERE ' . $table . '_id = :id';

    $id = (int) $id;
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $successfullyDeleted = $stmt->execute();
    //echo "<pre>"; print_r($successfullyDeleted); die();

    if ($successfullyDeleted) {

        // Delete orphan tags
        $sql = 'DELETE FROM tags WHERE `tags_id` NOT IN (SELECT tags_id FROM `weekloggr_tags` UNION SELECT tags_id FROM `todo_tags`)';

        $stmt = $db->prepare($sql);
        $stmt->execute();
    }

    return $successfullyDeleted;
});

Flight::map('extractHashTags', function ($string) {
    preg_match_all("/(#\w+)/u", $string, $matches);
    return $matches[0];
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

Flight::map('doesTagExist', function ($tag) {
    $res = Flight::selectData("select tags_id from tags where name = '$tag'");
    if (count($res)) {
        return $res[0]['tags_id'];
    }
    return null;
});