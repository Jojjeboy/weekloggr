<?php
require 'flight/Flight.php';

Flight::set('base_url', 'http://' . Flight::request()->host);

Flight::route('/', function () {
    //Flight::extractHashTags('Sprintplanering #ers #höndbas');
    $db = Flight::setup();
    //Flight::archiveold($db);

    $x = $db->query("SELECT * FROM `weekloggr`")->fetchAll(PDO::FETCH_ASSOC);
    Flight::render('template.php', 
        array(
            'weeklogs' => $x, 
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        )
    );
});

Flight::route('/hashtag/@tag', function ($tag) {
    echo $tag;
    die();
});

Flight::route('/addlog', function () {
    if (Flight::request()->method == 'POST') {
        $db = Flight::setup();
        $sql = "INSERT INTO weekloggr (text, weeknr) VALUES (?,?)";
        $successfullyInserted = $db->prepare($sql)->execute([Flight::request()->data->weeklog, Flight::getWeekNr(null)]);
        $tags = Flight::extractHashTags(Flight::request()->data->weeklog);

        if(count($tags) > 0 && $successfullyInserted){
            $id = $db->lastInsertId();
            foreach ($tags as $tag) {
                $sql = "INSERT INTO weekloggrTags (tag, weekloggr_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$tag, $id]);
            }
        }
    }
    Flight::redirect('/');
});

Flight::route('/update/@id', function ($id) {
    if (Flight::request()->method == 'POST') {
        $db = Flight::setup();   
        $sql = 'UPDATE weekloggr SET text = ?, date = ?, weeknr = ? WHERE id = ' . $id;
            
            //$stmt = $db->prepare($sql);
        $db->prepare($sql)
            ->execute([
            Flight::request()->data->weeklog, 
            Flight::request()->data->date,
            Flight::getWeekNr(Flight::request()->data->date)
            ]);
    }
    Flight::redirect('/');
    print_r(Flight::request()->data->date); die();
});

Flight::route('/delete/@id', function ($id) {

    $db = Flight::setup();

    $sql = 'DELETE FROM weekloggr WHERE id = :id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    Flight::redirect('/');
});

Flight::map('extractHashTags', function($string){
    //$string = 'Tweet #hashtag';
    $arrayOfTags = [];
    preg_match_all("/(#\w+)/u", $string, $matches); 
    return $matches[0];
});

Flight::map('archiveold', function ($db) {
    $sql = 'UPDATE weekloggr SET is_visible = :is_visible WHERE date < now() - interval 30 DAY';
    
    $stmt = $db->prepare($sql);
    $archivedStatus = 0;
    $stmt->bindParam(':is_visible', $archivedStatus, PDO::PARAM_INT);
    $stmt->execute();
});

Flight::map('setup', function () {
    // Mac
    Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', 'root'));
    
    //Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'jojje', 'Lia02014'));
    //Flight::register('db', 'PDO', array('mysql:host=localhost;dbname=weekloggr', 'root', 'Wrong_password'));
    return Flight::db();
});

Flight::map('getWeekNr', function ($inputDate) {
    if($inputDate){
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


Flight::start();