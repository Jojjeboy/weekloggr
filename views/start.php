<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Weekloggr</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
</head>
<style>
    /* You can add global styles to this file, and also import other style files */
    :host {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        font-size: 14px;
        color: #333;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }

    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }


    .navbar2 {
        display: flex;
        overflow: hidden;
        background-color: #333;
        position: fixed;
        bottom: 0px;
        left: 0;
        width: 100%;
        padding: 0;
        margin-bottom: 0;
        height: 42px;
        color: white;
        align-items: baseline;
    }

    .navbar2>div {
        margin: 0 10px;
        padding: 0 6px;
        font-size: 18px;
        line-height: 20px;
        width: 95%
    }

    .navbar2 a {
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    .navbar2 a:hover {
        background: green;

    }

    .navbar2 a.active {
        background-color: #4caf50;
        color: white;
    }

    .main {
        padding: 16px;
        width: 80%;
        
    }
    .main ul {
        background: #fafafa;
    }

    input[type="text"] {
 
        width: 100%;
        position: relative;
        border-radius: 2px;
        border: 1px solid #fafafa;
        height: 25px;
        top: 5px;
    }
</style>

<body>

    <div class="navbar2">
        <form method="POST" name="addweeklog" action="/weekloggr/">
            <input type="text" name="weeklog" id="weekloginput" />
            <button type="submit">Skicka</button>
        </form>
    </div>



    <div class="main" id="main">  

        <?php
        $weeknr = 0;
        $first = true;
        foreach ($weeklogs as $row) {
            if ($weeknr != $row['weeknr']) {
                if ($first == false) {
                    echo '</ul>';
                }
                echo '<ul>';
                echo "<h3>Vecka " . $row['weeknr'] . "</h3>";
                $weeknr = $row['weeknr'];
                $first = false;
            }
            echo '<li>';
            echo $row['text'];
            echo '</li>';
        }
        ?>
        </ul>
    </div>
    <?php
    echo "<pre>";
    //print_r($weeklogs);
    ?>
<script src="http://localhost/weekloggr/umbrellajs.js"></script>
<script src="http://localhost/weekloggr/weeklog.js"></script>
</body>
</html>