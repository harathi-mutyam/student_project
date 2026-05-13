<?php
session_start();
include "db.php";

/* SECURITY CHECK */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

/* GET LOGGED STUDENT */
$student_id = $_SESSION['student_id'];

if (!$student_id) {
    die("Student not linked to this account.");
}

/* STUDENT INFO */
$student = $conn->query("
    SELECT * FROM students WHERE id = $student_id
")->fetch_assoc();

/* MARKS (SUBJECTS TABLE) */
$result = $conn->query("
    SELECT subject_name, marks 
    FROM subjects 
    WHERE student_id = $student_id
");

$subjects = [];
$total = 0;
$count = 0;

while ($row = $result->fetch_assoc()) {
    $subjects[] = $row;
    $total += $row['marks'];
    $count++;
}

/* PERCENTAGE */
$percentage = ($count > 0) ? ($total / ($count * 100)) * 100 : 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body { font-family: Arial; background:#f4f6f9; padding:20px; }
        .card { background:white; padding:20px; border-radius:10px; margin-bottom:20px; }
        table { width:100%; border-collapse:collapse; }
        th, td { border:1px solid #ddd; padding:10px; text-align:center; }
        th { background:#007bff; color:white; }
    </style>
</head>
<body>

<div class="card">
    <h2>Welcome, <?= $student['name'] ?></h2>
    <p><b>Email:</b> <?= $student['email'] ?></p>
</div>

<div class="card">
    <h3>Academic Performance</h3>
    <p><b>Percentage:</b> <?= round($percentage, 2) ?>%</p>
</div>

<div class="card">
    <h3>Subjects & Marks</h3>

    <table>
        <tr>
            <th>Subject</th>
            <th>Marks</th>
        </tr>

        <?php foreach ($subjects as $s) { ?>
        <tr>
            <td><?= $s['subject_name'] ?></td>
            <td><?= $s['marks'] ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<div class="card">
    <h3>Performance Chart</h3>
    <canvas id="chart"></canvas>
</div>

<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($subjects, 'subject_name')) ?>,
        datasets: [{
            label: 'Marks',
            data: <?= json_encode(array_column($subjects, 'marks')) ?>,
            backgroundColor: '#007bff'
        }]
    }
});
</script>

</body>
</html>
