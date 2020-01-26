<?php
require 'flight/Flight.php';

Flight::set('base_url', 'http://' . Flight::request()->host);

Flight::route('/', function () {
    $logs = Flight::selectData("SELECT * FROM `weekloggr`");
    Flight::render('template.php', 
        array(
            'weeklogs' => $logs, 
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        )
    );
});

Flight::route('/hashtag/@tag', function ($tag) {
    $logs = Flight::selectData("select * from weekloggr_with_tags wwt where wwt.name = '#$tag'");
    if(count($logs) < 1){
        Flight::redirect('/');
    }
    Flight::render('template.php', 
        array(
            'weeklogs' => $logs, 
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        )
    );
});

Flight::route('/addlog', function () {
    if (Flight::request()->method == 'POST') {
        $db = Flight::setup();
        $sql = "INSERT INTO weekloggr (text, weeknr) VALUES (?,?)";
        $successfullyInserted = $db->prepare($sql)->execute([Flight::request()->data->weeklog, Flight::getWeekNr(null)]);
        $tags = Flight::extractHashTags(Flight::request()->data->weeklog);

        if(count($tags) > 0 && $successfullyInserted){
            $lastInsertedWeekloggrId = $db->lastInsertId();
            foreach ($tags as $tag) {
                $tagId = Flight::doesTagExist($tag);
                if($tagId){
                    $sql = "INSERT INTO weekloggr_tags (weekloggr_id, tag_id) VALUES (?,?)";
                    $db->prepare($sql)->execute([$lastInsertedWeekloggrId, $tagId]);
                }
                else {
                    $sql = "INSERT INTO tags (name) VALUES (?)";
                    $db->prepare($sql)->execute([$tag]);
                    $lastTagId = $db->lastInsertId();

                    $sql = "INSERT INTO weekloggr_tags (weekloggr_id, tag_id) VALUES (?,?)";
                    $db->prepare($sql)->execute([$lastInsertedWeekloggrId, $lastTagId]);
                }
            }
        }
    }
    Flight::redirect('/');
});

Flight::route('/update/@id', function ($id) {
    if (Flight::request()->method == 'POST') {
        $db = Flight::setup();   
        $sql = 'UPDATE weekloggr SET text = ?, date = ?, weeknr = ? WHERE id = ' . $id;

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
    $successfullyInserted = $stmt->execute();

    if($successfullyInserted){
        
        $sql = 'DELETE FROM weekloggr_tags WHERE weekloggr_id = :id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
        $stmt->execute();   

        // Delete orphan tags
        $sql = 'DELETE FROM tags WHERE tags.id NOT IN (SELECT tag_id FROM `weekloggr_tags`)';
        $stmt = $db->prepare($sql);
        $stmt->execute();
    }
    Flight::redirect('/');
});

Flight::map('extractHashTags', function($string){
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


Flight::map('selectData', function($sql){
    $db = Flight::setup();
    $logs = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $logs;
});

Flight::map('doesTagExist', function($tag){
    $res = Flight::selectData("select id from tags where name = '$tag'");
    if(count($res)){
        return $res[0]['id'];
    }
    return null;
});

Flight::map('isTagOrphan', function($tag){
    $res = Flight::selectData("select id from tags where name = '$tag'");
    if(count($res)){
        return $res[0]['id'];
    }
    return null;
});


Flight::start();