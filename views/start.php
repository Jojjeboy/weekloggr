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
    ul.navbar {
        overflow: hidden;
        background-color: #333;
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 0;
        margin-bottom: 0;
        height: 42px;
    }

    ul.navbar li {
        display: inline-block;
    }

    ul.navbar li a {
        float: left;
        display: block;
        color: #f2f2f2;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
        font-size: 17px;
    }

    ul.navbar li a:hover {
        background: green;

    }

    ul.navbar li a.active {
        background-color: #4caf50;
        color: white;
    }

    .main {
        padding: 16px;
        margin-bottom: 30px;
    }
</style>

<body>
    <ul class="navbar">
        <li class="nav-item">
            <a class="nav-link" href="/">Start</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/settings">Settings</a>
        </li>
        <li>
            <input type="text" name="weeklog" id="weekloginput" />
        </li>
    </ul>

    <div class="main">
        <h1>Bottom Navigation Bar</h1>
        <p>Some text some text some text.</p>
        <ul class="weeklogs">
            <?php 
            foreach($weeklogs as $row) { 
                echo '<li>';
                echo $row['text']; 
                echo '</li>'; 
            }
            ?>   
        </ul>
    </div>
    <?php
    echo "<pre>";
    print_r($weeklogs);
    ?>

</body>

</html>