<?php

Flight::route('/', function () {
    $todos = Flight::selectData("SELECT * FROM `todo` WHERE status = 0 ORDER by is_sticky desc, status asc, todo_id");
    Flight::renderTodo($todos);
   
});

Flight::route('/todo/hashtag/@tag', function ($tag) {
    $todos = Flight::selectData("select * from v_todo_tags vtt where vtt.name = '#$tag'");
    if (count($todos) < 1) {
        Flight::redirect('/');
    }

    Flight::renderTodo($todos);
});

Flight::route('/addTodo', function () {
    if (Flight::request()->method == 'POST') {
        if (Flight::request()->data->todo === 'done') {
            Flight::redirect('/showAll');
        }
        Flight::createtodo(Flight::request()->data);
    }
    Flight::redirect('/');
});

Flight::route('/togglestatus/@id/@newstatus', function ($id, $newstatus) {

    $db = Flight::setup();

    $sql = "UPDATE todo SET status = :status WHERE todo.`todo_id` = $id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':status', $newstatus, PDO::PARAM_INT);
    $successfullyInserted = $stmt->execute();

    if ($successfullyInserted && $newstatus == 1) {
        $res = Flight::selectData("select text from todo where todo_id = $id");
        $text = null;
        if (count($res)) {
            $object = new stdClass();
            $object->weeklog = $res[0]['text'];
            $object->date = null;
            Flight::create($object);
        }
    }

    Flight::redirect('/');
});

Flight::route('/todo/togglesticky/@id/@newstatus', function ($id, $is_sticky) {

    $db = Flight::setup();

    $sql = "UPDATE todo SET is_sticky = :is_sticky WHERE todo.`todo_id` = $id";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':is_sticky', $is_sticky, PDO::PARAM_INT);
    $stmt->execute();

    Flight::redirect('/');
});

Flight::route('/todo/update/@id', function ($id) {
    if (Flight::request()->method == 'POST') {
        Flight::delete($id, 'todo');
        Flight::createtodo(Flight::request()->data);
    }
    Flight::redirect('/');
});

Flight::route('/todo/delete/@id', function ($id) {
    Flight::delete($id, 'todo');
    Flight::redirect('/');
});


/* ========== RENDERER =========== */

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

/* ========== METHODS =========== */

Flight::map('createtodo', function ($requestData) {
    $db = Flight::setup();

    $todo = $requestData->todo;

    $sql = "INSERT INTO todo (text) VALUES (?)";
    $db->prepare($sql)->execute(array($todo));

    $tags = Flight::extractHashTags($todo);

    if (count($tags) > 0) {
        $lastInsertedTodoId = $db->lastInsertId();
        foreach ($tags as $tag) {
            $tagId = Flight::doesTagExist($tag);
            if ($tagId) {
                $sql = "INSERT INTO todo_tags (todo_id, tags_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$lastInsertedTodoId, $tagId]);
            } else {
                $sql = "INSERT INTO tags (name) VALUES (?)";
                $db->prepare($sql)->execute([$tag]);
                $lastTagId = $db->lastInsertId();

                $sql = "INSERT INTO todo_tags (todo_id, tags_id) VALUES (?,?)";
                $db->prepare($sql)->execute([$lastInsertedTodoId, $lastTagId]);
            }
        }
    }
});