<?php
include 'config.php';

$student_id = (int)$_GET['id'];

// get student info
$student = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT * FROM students WHERE id=$student_id")
);

// fixed 6 subjects
$subjects = ["Math", "Science", "English", "History", "Computer", "Physics"];

// SAVE DATA
if (isset($_POST['save'])) {

    // remove old records (so we update cleanly)
    mysqli_query($conn, "DELETE FROM subjects WHERE student_id=$student_id");

    foreach ($subjects as $sub) {

        $key = strtolower($sub);
        $marks = $_POST[$key];

        mysqli_query($conn,
            "INSERT INTO subjects(student_id, subject_name, marks)
             VALUES($student_id, '$sub', $marks)"
        );
    }

    header("Location: student_subjects.php?id=$student_id");
    exit();
}

// FETCH EXISTING DATA
$data = [];

$result = mysqli_query($conn,
    "SELECT * FROM subjects WHERE student_id=$student_id"
);

while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['subject_name']] = $row['marks'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Subjects</title>
</head>
<body>

<h2>Student: <?php echo $student['name']; ?></h2>

<form method="POST">

<table border="1">

<tr>
    <th>Subject</th>
    <th>Marks</th>
</tr>

<?php foreach ($subjects as $sub) { 
    $key = strtolower($sub);
?>

<tr>
    <td><?php echo $sub; ?></td>

    <td>
        <input type="number"
               name="<?php echo $key; ?>"
               value="<?php echo $data[$sub] ?? ''; ?>"
               required>
    </td>
</tr>

<?php } ?>

</table>

<br>

<button type="submit" name="save">Save Subjects</button>

</form>

<br>

<a href="index.php">⬅ Back to Students</a>

</body>
</html>
