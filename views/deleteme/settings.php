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
    <title>Weekloggr - Settings</title>


    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="<?php echo $base_url; ?>/node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $base_url; ?>/style.css">

    <meta name="theme-color" content="#563d7c">

</head>

<body>
    <div class="container-fluid">
        <div class="mt-1">
            <h1><a href="/">Settings</a></h1>
        </div>
        <form method="post" action="<?php echo $base_url; ?>/settings/update">
            <div class="form-group">
                <label>Arkivera gamla loggar</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="archiveOld" id="yes" value="1" <?php echo $archiveOld === true ? 'checked' : '' ?>>
                    <label class="form-check-label" for="exampleRadios1">
                        Ja
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="archiveOld" id="no" value="0" <?php echo $archiveOld === false ? 'checked' : '' ?>>
                    <label class="form-check-label" for="exampleRadios2">
                        Nej
                    </label>
                </div>

            </div>
            <div class="form-group archiveAfter">
                <label for="archiveAfter">Arkivera efter</label>
                <input type="number" min="1" max="60" class="form-control" name="archiveAfter" id="archiveAfter" data-originalvalue="<?php echo $archiveAfter; ?>" value="<?php echo $archiveAfter; ?>" <?php echo $archiveOld === false ? 'disabled' : '' ?>>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="<?php echo $base_url; ?>/node_modules/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="<?php echo $base_url; ?>/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo $base_url; ?>/weeklog.js"></script>
</body>

</html>