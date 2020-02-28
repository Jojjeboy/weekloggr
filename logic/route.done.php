<?php

/* ========== ROUTES =========== */

Flight::route('/done', function () {
    if ((bool) Flight::getSetting('archiveOld')) {
        $nrOfDaysToArchive = Flight::getSetting('archiveAfter');
        Flight::archiveold($nrOfDaysToArchive);
    } else {
        Flight::archiveold('none');
    }
    $logs = Flight::selectData("SELECT * FROM `weekloggr` order by date");

    Flight::renderDone($logs);
});


Flight::route('/done/hashtag/@tag', function ($tag) {
    $logs = Flight::selectData("select * from v_weekloggr_tags vwt where vwt.name = '#$tag'");
    if (count($logs) < 1) {
        Flight::redirect('/done');
    }
    Flight::renderDone($logs);
});

Flight::route('/addlog', function () {
    if (Flight::request()->method == 'POST') {
        Flight::create(Flight::request()->data);
    }
    Flight::redirect('/done');
});


Flight::route('/done/update/@id', function ($id) {
    if (Flight::request()->method == 'POST') {
        Flight::delete($id, 'weekloggr');
        Flight::create(Flight::request()->data);
    }
    Flight::redirect('/done');
});

Flight::route('/done/delete/@id', function ($id) {
    Flight::delete($id, 'weekloggr');
    Flight::redirect('/done');
});

/* ========== RENDERER =========== */

Flight::map('renderDone', function ($logs) {
    Flight::render(
        'partials/header',
        array(
            'heading' => 'Hello',
            'base_url' => 'http://' . Flight::request()->host,
            'jsfile' => 'done.js'
        ),
        'header_content'
    );
    Flight::render(
        'pages/done',
        array(
            'body' => 'World',
            'weeklogs' => $logs,
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        ),
        'body_content'
    );
    Flight::render('layout', array('title' => 'To {do} ne', 'base_url' => 'http://' . Flight::request()->host));
});

/* ========== METHODS =========== */

Flight::map('getSetting', function ($key) {
    $res = Flight::selectData("select value from settings WHERE settings.`key` = '$key'");
    if (count($res)) {
        return $res[0]['value'];
    }
    return null;
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