<?php

if (isset($_SESSION['shots'])) {
    date_default_timezone_set('Europe/Moscow');
    $mysqli = new mysqli(
        'localhost',
        'root',
        'root',
        'coolbd'
    );
    if (!$mysqli->connect_error) {
        $result = $mysqli->query('SELECT * FROM shots');
        while ($row = $result->fetch_array()) {
            echo '<tr class="table-rows">';
            printf("<td> %s </td>", $row['id_shot']);
            printValuesWithoutNumber($row);
            echo '</tr>';
        }
        $mysqli->close();
    } else {
        foreach ($_SESSION['shots'] as $key => $value) {
            echo '<tr class="table-rows">';
            printf("<td> %s </td>", $key + 1);
            printValuesWithoutNumber($value);
            echo '</tr>';
        }
    }
}

function printValuesWithoutNumber($array): void {
    printf("<td> %s </td>", $array['r']);
    printf("<td> %s </td>", $array['x']);
    printf("<td> %s </td>", $array['y']);
    printf("<td> %s </td>", $array['res']);
    printf("<td> %s ms</td>", $array['running_time']);
    printf("<td> %s </td>", date('H:i:s', time()));
}
