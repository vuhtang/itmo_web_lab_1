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

    $shot = [
        'r' => $r,
        'x' => $x,
        'y' => $y,
        'res' => $res,
        'running_time' => $runningTime
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
        $sql = 'INSERT INTO shots (r, x, y, res, running_time) VALUES ('
            . $r . ',' . $x . ',' . $y . ',\'' . $res . '\',' . $runningTime . ')';
        echo $sql;
        $mysqli->query($sql);
        $mysqli->close();
        echo 'very nice';
    }

    header('Location: ../index.php');
}
