<?php
include 'config.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>Student Management System</h1>

<!-- Add Student Button -->
<div style="text-align:center; margin-bottom:20px;">
    <a href="index.php">➕ Add Student</a>
</div>

<!-- Search Form -->
<form action="search.php" method="GET">
    <input type="text" name="search" placeholder="Search student by Name">
    <button type="submit">Search</button>
</form>

<br>

<table border="1">

<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Action</th>
</tr>

<?php
$result = mysqli_query($conn, "SELECT * FROM students");

while($row = mysqli_fetch_assoc($result)) {
?>

<tr>
    <td><?php echo $row['id']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td><?php echo $row['email']; ?></td>

    <td>
        <a href="delete_student.php?id=<?php echo $row['id']; ?>"
           onclick="return confirm('Are you sure you want to delete this student?');">
            Delete
        </a>
    </td>
</tr>

<?php } ?>

</table>

</body>
</html>
