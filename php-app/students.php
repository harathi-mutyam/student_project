<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM students");

while($row = mysqli_fetch_assoc($result)) {
    echo $row['name'] . " - " . $row['email'];
    echo "<br>";
}
?>