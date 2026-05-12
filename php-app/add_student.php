<?php
include 'config.php';

$name = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO students(name,email)
VALUES('$name','$email')";

mysqli_query($conn, $sql);

echo "Student Added";
?>