<?php
require_once('NumberValidator.php');
require_once('ShotChecker.php');
require_once('DBManager.php');
require_once('TablePrinter.php');
require_once('Cleaner.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") mainPost();
if ($_SERVER['REQUEST_METHOD'] == "GET") mainGet();


function mainGet(): void
{
    if (isset($_GET['action'])) {
        if ($_GET['action'] == 'request') {
            $tablePrinter = new TablePrinter();
            $tablePrinter->printValuesFromDb();
        }
        if ($_GET['action'] == 'clear') {
            $cleaner = new Cleaner();
            $cleaner->clean();
        }
    }
}

function mainPost(): void
{
    if (!isset($_POST['r']) || !isset($_POST['x']) || !isset($_POST['y'])) {
        http_response_code(400);
        return;
    }
    $x = $_POST['x'];
    $y = $_POST['y'];
    $r = $_POST['r'];

    $validator = new NumberValidator();

    if (!$validator->validateNumbers($x, $y, $r)) return;
    $checker = new ShotChecker();

    if ($checker->checkHit($x, $y, $r)) {
        $res = 'HIT';
    } else $res = 'MISS';

    $runningTime = round(microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'], 6);

    date_default_timezone_set('Europe/Moscow');
    $curr_time = date('H:i:s', time());
    $shot = [
        'r' => $r,
        'x' => $x,
        'y' => $y,
        'res' => $res,
        'running_time' => $runningTime,
        'curr_time' => $curr_time
    ];

    $dbManager = new DBManager();
    $dbManager->insertData($shot);

    echo "
    <tr class=\"table-rows\">
    <td> $r </td>
    <td> $x </td>
    <td> $y </td>
    <td> $res </td>
    <td> $runningTime </td>
    <td> $curr_time </td>
    </tr>
    ";
}
