<?php
echo "<h1>Add Student Details</h1>";
?>

<link rel="stylesheet" href="style.css">

<form method="POST" action="save_student.php">
    <input type="text" name="name" placeholder="Name" required>

    <input type="email" name="email" placeholder="Email" required>

    <button type="submit">Add Student</button>
</form>

<br>
<a href="index.php">View Students</a>
