<!doctype html>
<html lang="en" class="h-100">

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
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <title>Weekloggr</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">

    <meta name="theme-color" content="#563d7c">

</head>

<body>
    <div class="container-fluid">
        <div class="mt-1">
            <h1>Weekloggr</h1>
            <?php
            $weeknr = 0;
            $first = true;
            foreach ($weeklogs as $row) {
                if ($weeknr != $row['weeknr']) {
                    if ($first == false) {
                        echo '</div></ul>';
                    }
                    echo '<div class="card m-3">';
                    echo '<ul class="list-group list-group-flush">';
                    $currWeekClass = $currentWeekNr == $row['weeknr'] ? ' sameAsCurrent' : '';
                    echo '<h6 class="m-2 ml-3' . $currWeekClass . '">'; ?>
                    Vecka <?php echo $row['weeknr']?>
                    </h6>
                    <?php
                    $weeknr = $row['weeknr'];
                    $first = false;
                } 
                ?>
                <li class="list-group-item">
                    <span class="dropup">
                        <a class="navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown10">
                            <a class="dropdown-item small warning" href="<?php echo $base_url . '/delete/' . $row['id']; ?>">Ta bort</a>
                            <button type="button" class="btn small btn-link copybtn" onclick="copyToInput(this, <?php echo $row['id']; ?>, true)">Redigera</button>
                            <button type="button" class="btn small btn-link copybtn" onclick="copyToInput(this, <?php echo $row['id']; ?>)">Kopiera till inmatningsfält</button>
                        </div>
                    </span>
                    <span class="text-<?php echo $row['id']; ?>"> 
                        <?php echo $row['text']; ?>
                    </span>
                </li>
                <?php 
            }
            ?>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-expand navbar-dark bg-dark">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample02" aria-controls="navbarsExample02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample02">
            <ul class="navbar-nav">
                <li class="nav-item dropup">
                    <a class="nav-link navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Weekloggr</a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item" href="#">Settings</a>
                    </div>
                </li>
            </ul>
            <form method="POST" name="addweeklog" action="<?php echo $base_url; ?>/addlog">
                <input class="form-control" name="weeklog" type="text" placeholder="Log work done">
                <button type="submit" class="d-none">Skicka</button>
            </form>
        </div>
    </nav>


    <script src="<?php echo $base_url; ?>/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="<?php echo $base_url; ?>/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?php echo $base_url; ?>/bootstrap.min.js"></script>

    <script src="<?php echo $base_url; ?>/weeklog.js"></script>
</body>

</html>