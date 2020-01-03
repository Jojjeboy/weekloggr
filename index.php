<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    

    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr','root','mysql'));
    $db = Flight::db();
    $x = $db->query("SELECT * FROM `weekloggr`")->fetchAll(PDO::FETCH_ASSOC);
    Flight::render('start.php', array('weeklogs' => $x));
});

Flight::route('/addlog', function(){
    $wl = new Weekloggr();
    $text = Flight::request()->query['text'];
    $weeknr = $wl->getWeekNr();
});

class Weekloggr{
    public static function getWeekNr(){
        $dt = new DateTime();
        $weeknr = $dt->format("W");
        if($weeknr[0] == "0"){
            $weeknr = $weeknr[1];
        }
        
        return $weeknr;
    }
}

Flight::start();
