<?php
require 'flight/Flight.php';

Flight::route('/', function(){
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr','root','mysql'));
    $db = Flight::db();
    
    if(Flight::request()->method == 'POST'){
    //echo "<pre>";
    //print_r();
    //echo "---------------------------<br /></pre>";
        //$insertRes = $db->query("INSERT INTO `weekloggr`"); 
        $wl = new Weekloggr();
        $sql = "INSERT INTO weekloggr (text, weeknr) VALUES (?,?)";
        $db->prepare($sql)->execute([Flight::request()->data->weeklog, $wl->getWeekNr()]);
    }
    
    $x = $db->query("SELECT * FROM `weekloggr`")->fetchAll(PDO::FETCH_ASSOC);
    Flight::render('start.php', array('weeklogs' => $x));
});

Flight::route('/addlog', function(){
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
