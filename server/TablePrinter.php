<?php
require_once('DBManager.php');

class TablePrinter
{
    public function printValuesFromDb(): bool
    {
        $dbManager = new DBManager();
        $shots = $dbManager->getAllData();
        if ($shots != null) {
            while ($row = $shots->fetch_array()) {
                echo '<tr class="table-rows">';
                printf("<td> %s </td>", $row['r']);
                printf("<td> %s </td>", $row['x']);
                printf("<td> %s </td>", $row['y']);
                printf("<td> %s </td>", $row['res']);
                printf("<td> %f</td>", $row['running_time']);
                printf("<td> %s </td>", $row['curr_time']);
                echo '</tr>';
            }
            return true;
        } else return false;
    }
}
