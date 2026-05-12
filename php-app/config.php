<?php
$host = "mysql-db";
$user = "root";
$password = "root";
$database = "studentdb";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed");
}
?>
