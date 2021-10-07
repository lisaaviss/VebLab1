<?php
$start = microtime(true);

session_start();

if(!isset($_SESSION["requestsCount"])){
    $_SESSION["requestsCount"] = 0;
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>Лаб_Веб1</title>
    <style>
        body{
            background: #406343;
            color: #ECE7B4;
            padding: 0;
            margin: 0;
            font-family: fantasy;
        }
        .results{
            color: #593526;
        }
        .results th{
            border: 8px solid #444941;
            background-color: #F3F0D7;
            color: #593526;
            font-size: 20px;
            font-style: italic;
        }
        .results td {
            border: 8px solid #444941;
            font-size: 18px;
            background-color: #F3F0D7;
        }

    </style>
</head>
<body>
<table class="results" width="100%">
    <tr>
        <th>X Координата</th>
        <th>Y Координата</th>
        <th>Радиус</th>
        <th>Результат</th>
        <th>Время работы скрипта</th>
        <th>Текущее время</th>
    </tr>
    <?php
    function inTheArea($x, $y, $r){
        if ($x<=0 && $y>=0 && $r*$r>=($x*$x+$y*$y)){
            return "YES";
        } else if ($x<=-$r && $y<=-$r){
            return "YES";
        } else if ($x>=0 && $y<=0 && $y>=$x-2){
            return "YES";
        } else {return "NO";}
    }

    function printTable($n)
    {
            echo "<tr>\n<td>" . $_SESSION[$n . "x"] .
                "</td>\n<td>" . $_SESSION[$n . "y"] .
                "</td>\n<td>" . $_SESSION[$n . "r"] .
                "</td>\n<td>" . $_SESSION[$n . "res"] .
                "</td>\n<td>" . $_SESSION[$n . "runtime"] .
                "</td>\n<td>" . $_SESSION[$n . "date"] .
                "</td>\n</tr>\n";
    }
    function validateNumbers() {
        $xIsOk = false;
        if ($_GET['xCoordinate'] = -3 |  $_GET['xCoordinate'] = -2 | $_GET['xCoordinate'] = -1 | $_GET['xCoordinate'] = 0 | $_GET['xCoordinate'] = 1 | $_GET['xCoordinate'] = 2 | $_GET['xCoordinate'] = 3 | $_GET['xCoordinate'] = 4 | $_GET['xCoordinate'] = 5) {
                $xIsOk = true;
        }

        $yIsOk = false;
        if (is_numeric($_GET['yCoordinate']) && $_GET['yCoordinate'] > -5 && $_GET['yCoordinate'] < 3) {
                $yIsOk = true;
        }

        $rIsOk = false;
        if ($_GET['radius'] = 1 | $_GET['radius'] = 1.5 | $_GET['radius'] = 2 | $_GET['radius'] = 2.5 | $_GET['radius'] = 3) {
                $rIsOk = true;
        }

        if ($xIsOk && $yIsOk && $rIsOk) {
            return true;
        } else return false;
    }
    date_default_timezone_set("Europe/Moscow");

    for($i = 0; $i < $_SESSION["requestsCount"]; $i++){
        printTable($i);
    }
    if (isset($_GET["xCoordinate"], $_GET["yCoordinate"], $_GET["radius"]) && validateNumbers()) {
        $xCoord = $_GET['xCoordinate'];
        $yCoord = $_GET['yCoordinate'];
        $radius = $_GET['radius'];

        $reqNum = $_SESSION['requestsCount'];

        $_SESSION[$reqNum . 'x'] = $xCoord;
        $_SESSION[$reqNum . 'y'] = $yCoord;
        $_SESSION[$reqNum . 'r'] = $radius;
        $_SESSION[$reqNum . 'res'] = inTheArea($xCoord, $yCoord, $radius);
        $_SESSION[$reqNum . 'date'] = date('d/m/Y h:i:s a', time());
        $_SESSION[$reqNum . 'runtime'] = round(microtime(true) - $start, 6);

        printTable($_SESSION['requestsCount']);
        $_SESSION['requestsCount']++;
    }
    ?>
</body>
</html>
