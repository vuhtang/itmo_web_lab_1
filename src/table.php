<?php

function printValuesFromDb(): bool {
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
        return true;
    } else return false;
}

function printValuesWithoutNumber($array): void {
    printf("<td> %s </td>", $array['r']);
    printf("<td> %s </td>", $array['x']);
    printf("<td> %s </td>", $array['y']);
    printf("<td> %s </td>", $array['res']);
    printf("<td> %.6f ms</td>", $array['running_time']);
    printf("<td> %s </td>", $array['curr_time']);
}

if (!printValuesFromDb()) {
    if (isset($_SESSION['shots'])) {
        foreach ($_SESSION['shots'] as $key => $value) {
            echo '<tr class="table-rows">';
            printf("<td> %s </td>", $key + 1);
            printValuesWithoutNumber($value);
            echo '</tr>';
        }
    }
}
