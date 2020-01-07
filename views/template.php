<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Weekloggr</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo $base_url;?>/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url;?>/style.css">

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
                echo '<ul class="mb-3 list-group list-group-flush">';
                $currWeekClass = $currentWeekNr == $row['weeknr'] ? ' sameAsCurrent' : '';
                echo '<h6 class="m-2 ml-3'. $currWeekClass .'">Vecka ' . $row['weeknr'] . ' <button type="button" class="btn-small btn-link d-none showHidden" onclick="toggleShown(this)">Visa gömda</button></h6>';
                $weeknr = $row['weeknr'];
                $first = false;
            }
            $showArchived = $row['is_visible'];
            $newStatus = $row['is_visible'] == 1 ? 0 : 1;
            echo '<li class="list-group-item show-'. $showArchived .'">';
            echo $row['text'];
            ?>
            <span class="dropup">
                <a class="nav-link navbar-brand active dropdown-toggle" href="#" id="dropdown10" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                    <div class="dropdown-menu" aria-labelledby="dropdown10">
                        <a class="dropdown-item small" href="<?php echo $base_url .'/delete/'. $row['id']; ?>">Ta bort</a>
                        <a class="dropdown-item small" href="<?php echo $base_url .'/archive/'. $row['id'] . '/' . $newStatus; ?>">Arkivera</a>
                    </div>
                </span>
            <?php
            echo '</li>';
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
            <form method="POST" name="addweeklog" action="<?php echo $base_url;?>/addlog">
                <input class="form-control" name="weeklog" type="text" placeholder="Log work done">
                <button type="submit" class="d-none">Skicka</button>
            </form>
        </form>
        </div>
    </nav>


    <script src="<?php echo $base_url;?>/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="<?php echo $base_url;?>/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="<?php echo $base_url;?>/bootstrap.min.js"></script>

    <script src="<?php echo $base_url;?>/weeklog.js"></script>
</body>

</html>