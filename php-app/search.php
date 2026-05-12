<?php include 'config.php';

$search = $_GET['search'];

$result = mysqli_query($conn,
"SELECT * FROM students WHERE name LIKE '%$search%'");
?>

<h2>Search Results</h2>

<a href="index.php">Back</a>

<table border="1">
  <tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>


<?php while($row = mysqli_fetch_assoc($result)) { ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
</tr>

<?php } ?>

</table>
