<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    //echo 'hello world!';
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr','root','mysql'));
    $db = Flight::db();
    $x = $db->query("SELECT * FROM `weekloggr`")->fetchAll(PDO::FETCH_ASSOC);
    Flight::render('start.php', array('weeklogs' => $x));


});

Flight::start();
