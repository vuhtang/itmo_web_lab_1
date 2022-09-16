<?php
require_once('DBManager.php');

class Cleaner
{
    public function clean(): void
    {
        $dbManager = new DBManager();
        $dbManager->clearData();
    }
}
