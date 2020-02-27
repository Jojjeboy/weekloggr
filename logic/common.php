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