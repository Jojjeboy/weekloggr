<!doctype html>
<html lang="sv" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Weekloggr</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">

    <meta name="theme-color" content="#563d7c">

</head>

<body>

    <div class="container-fluid">
        <div class="mt-1">
            <h1><a href="/">Todo</a> &nbsp; <span class="font-weight-lighter">|</span> &nbsp; <a href="/done">Done</a></h1>

            <?php foreach ($todos as $todo) { ?>
                <div class="input-group todo mb-3 todo-status-<?php echo $todo['status'] ?>">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <input data-id="<?php echo $todo['todo_id']; ?>" type="checkbox" <?php echo $todo['status'] == 1 ? 'checked' : ''; ?> aria-label="Checkbox for following text input">
                        </div>
                    </div>
                    <?php $todo['text'] = preg_replace('/(?<!\S)#([0-9a-zA-Z]+)/', '<a href="/todo/hashtag/$1">#$1</a>', $todo['text']); ?>
                    <span>
                        <?php
                        if ($todo['is_sticky']) { ?>
                            <svg class="bi bi-arrow-down-left" width="1em" height="1em" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M5 9.5a.5.5 0 01.5.5v4.5H10a.5.5 0 010 1H5a.5.5 0 01-.5-.5v-5a.5.5 0 01.5-.5z" clip-rule="evenodd"></path>
                                <path fill-rule="evenodd" d="M14.354 5.646a.5.5 0 010 .708l-9 9a.5.5 0 01-.708-.708l9-9a.5.5 0 01.708 0z" clip-rule="evenodd"></path>
                            </svg>
                        <?php }
                        echo $todo['text'];
                        ?>
                    </span>
                </div>
            <?php } ?>

        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav">
                <li class="nav-item dropup">
                    <a class="nav-link navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekloggr </a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item toggle-all d-none" href="#"><small>Visa alla gömda</small></a>
                        <a class="dropdown-item" href="<?php echo $base_url; ?>/settings">Settings</a>
                    </div>
                </li>
            </ul>
            <form method="POST" name="addTodo" action="<?php echo $base_url; ?>/addtodo">
                <input class="form-control text" name="todo" type="text" placeholder="What to do?">
                <button type="submit" class="d-none">Skicka</button>
            </form>
        </div>
    </nav>

    <script src="<?php echo $base_url; ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/todo.js"></script>
</body>

</html>