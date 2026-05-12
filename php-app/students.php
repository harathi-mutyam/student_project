<?php
include 'config.php';

$result = mysqli_query($conn, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Students List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 70%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #333;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .add-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<h2 style="text-align:center;">Student Details</h2>

<table>
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

<div class="add-link">
    <a href="add_student_form.php">➕ Add Student</a>
</div>

</body>
</html>
