<?php

Flight::map('renderTodo', function ($todos) {
    Flight::render(
        'partials/header',
        array(
            'heading' => 'Hello',
            'base_url' => 'http://' . Flight::request()->host,
            'jsfile' => 'todo.js'
        ),
        'header_content'
    );
    Flight::render(
        'pages/todo',
        array(
            'body' => 'World',
            'todos' => $todos,
            'base_url' => Flight::get('base_url'),
            'currentWeekNr' => Flight::getWeekNr(null)
        ),
        'body_content'
    );
    Flight::render('layout', array('title' => 'To {do} ne', 'base_url' => 'http://' . Flight::request()->host));
});

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


Flight::map('renderSettings', function ($archiveOld, $archiveAfter) {
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
        'pages/settings',
        array(
            'body' => 'World',
            'archiveOld' => $archiveOld,
            'archiveAfter' => $archiveAfter,
            'base_url' => Flight::get('base_url')
        ),
        'body_content'
    );
    Flight::render('layout', array('title' => 'To {do} ne', 'base_url' => 'http://' . Flight::request()->host));
});
