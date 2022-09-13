<?php

session_start();
if (!isset($_SESSION['shots']))
    $_SESSION['shots'] = [];
main();

function checkHit($x, $y, $r): bool
{
    return checkRectangle($x, $y, $r) || checkTriangle($x, $y, $r) || checkSector($x, $y, $r);
}

function checkRectangle($x, $y, $r): bool
{
    return $y >= -$r && $y <= 0 && $x >= 0 && $x <= $r / 2;
}

function checkTriangle($x, $y, $r): bool
{
    // y = -x + R
    return $y <= (-$x + $r) && $y >= 0 && $x >= 0;
}

function checkSector($x, $y, $r): bool
{
    // x^2 + y^2 = R^2/4
    return $x <= 0 && $y <= 0 && $x ** 2 + $y ** 2 <= $r ** 2 / 4;
}

function main(): void
{
    if (!isset($_POST['r']) || !isset($_POST['x']) || !isset($_POST['y'])) {
        http_response_code(400);
        return;
    }

    $x = floatval($_POST['x']);
    $y = floatval($_POST['y']);
    $r = floatval($_POST['r']);

    if (checkHit($x, $y, $r)) {
        $res = 'HIT';
    } else $res = 'MISS';

    $runningTime = microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'];
    date_default_timezone_set('Europe/Moscow');
    $curr_time = date('H:i:s', time());

    $shot = [
        'r' => $r,
        'x' => $x,
        'y' => $y,
        'res' => $res,
        'running_time' => $runningTime,
        'curr_time' =>$curr_time
    ];

    $_SESSION['shots'][] = $shot;

    $mysqli = new mysqli(
        'localhost',
        'root',
        'root',
        'coolbd'
    );

    if (!$mysqli->connect_error) {
        echo 'nice';
        $mysqli->set_charset("utf8");
        $sql = 'INSERT INTO shots (r, x, y, res, running_time, curr_time) VALUES ('
            . $r . ',' . $x . ',' . $y . ',\'' . $res . '\',' . $runningTime . ',\''. $curr_time . '\')';
        $mysqli->query($sql);
        $mysqli->close();
    }

    header('Location: ../index.php');
}
