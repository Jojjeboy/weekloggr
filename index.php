<?php
require 'flight/Flight.php';

Flight::set('base_url', 'http://' . Flight::request()->host);

Flight::route('/', function () {
    
    $db = Flight::setup();
    //Flight::archiveold($db);

    $x = $db->query("SELECT * FROM `weekloggr`")->fetchAll(PDO::FETCH_ASSOC);
    Flight::render('template.php', 
        array(
            'weeklogs' => $x, 
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr()
        )
    );
});

Flight::route('/addlog', function () {
    if (Flight::request()->method == 'POST') {
        $db = Flight::setup();
        $sql = "INSERT INTO weekloggr (text, weeknr) VALUES (?,?)";
        $db->prepare($sql)->execute([Flight::request()->data->weeklog, Flight::getWeekNr()]);
    }
    Flight::redirect('/');
});

Flight::route('/delete/@id', function ($id) {

    $db = Flight::setup();

    $sql = 'DELETE FROM weekloggr WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    Flight::redirect('/');
});

Flight::map('archiveold', function ($db) {
    $sql = 'UPDATE weekloggr SET is_visible = :is_visible WHERE date < now() - interval 30 DAY';
    
    $stmt = $db->prepare($sql);
    $archivedStatus = 0;
    $stmt->bindParam(':is_visible', $archivedStatus, PDO::PARAM_INT);
    $stmt->execute();
});

Flight::map('setup', function () {
    //Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', 'mysql'));
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', 'Lia02014'));
    //Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', 'Wrong_password'));
    return Flight::db();
});

Flight::map('getWeekNr', function () {
    $dt = new DateTime();
    $weeknr = $dt->format("W");
    if ($weeknr[0] == "0") {
        $weeknr = $weeknr[1];
    }

    return $weeknr;
});


Flight::start();