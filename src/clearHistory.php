<?php
session_start();
$_SESSION['shots'] = [];

$mysqli = new mysqli(
    'localhost',
    'root',
    'root',
    'coolbd'
);
if (!$mysqli->connect_error) {
    $mysqli->query('DELETE FROM shots');
    $mysqli->query('ALTER TABLE shots AUTO_INCREMENT = 1');
    $mysqli->close();
}
header('Location: ../index.php');