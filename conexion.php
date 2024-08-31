<?php
$user = 'root';
$pass = '';
$host = 'localhost';
$database = 'usuarios';

try {
    $con = new PDO("mysql:host=$host;dbname=$database", $user, $pass);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("set names utf8");
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>
