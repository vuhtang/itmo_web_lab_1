<?php

class DBManager
{

    private function connect(): mysqli
    {
        return new mysqli(
            'localhost',
            'root',
            'root',
            'coolbd'
        );
    }

    public function insertData($shot): bool
    {
        $mysqli = $this->connect();

        $x = $shot['x'];
        $y = $shot['y'];
        $r = $shot['r'];
        $res = $shot['res'];
        $runningTime = $shot['running_time'];
        $curr_time = $shot['curr_time'];

        if (!$mysqli->connect_error) {
            $mysqli->set_charset("utf8");
            $sql = 'INSERT INTO shots (r, x, y, res, running_time, curr_time) VALUES ('
                . $r . ',' . $x . ',' . $y . ',\'' . $res . '\',' . $runningTime . ',\'' . $curr_time . '\')';
            $mysqli->query($sql);
            $mysqli->close();
        } else return false;
        $mysqli->close();
        return true;
    }

    public function clearData(): bool
    {
        $mysqli = $this->connect();
        if (!$mysqli->connect_error) {
            $mysqli->query('DELETE FROM shots');
            $mysqli->query('ALTER TABLE shots AUTO_INCREMENT = 1');
            $mysqli->close();
        } else return false;
        $mysqli->close();
        return true;
    }

    public function getAllData()
    {
        $mysqli = $this->connect();
        if (!$mysqli->connect_error) {
            $result = $mysqli->query('SELECT * FROM shots');
            $mysqli->close();
            return $result;
        } else {
            $mysqli->close();
            return null;
        }
    }
}