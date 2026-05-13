<?php
session_start();
include "db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// GET STUDENT
$student = $conn->query("
    SELECT * FROM students WHERE user_id=$user_id
")->fetch_assoc();

$student_id = $student['id'];

// GET MARKS
$marks = $conn->query("
    SELECT * FROM marks WHERE student_id=$student_id
");

// CALCULATE PERCENTAGE
$total = 0;
$count = 0;
$data = [];

while ($row = $marks->fetch_assoc()) {
    $total += $row['marks'];
    $count++;
    $data[] = $row;
}

$percentage = ($count > 0) ? ($total / ($count * 100)) * 100 : 0;
?>

<h2>Welcome <?= $student['name'] ?></h2>

<h3>Percentage: <?= round($percentage, 2) ?>%</h3>

<table border="1">
    <tr>
        <th>Subject</th>
        <th>Marks</th>
    </tr>

    <?php foreach ($data as $m) { ?>
        <tr>
            <td><?= $m['subject'] ?></td>
            <td><?= $m['marks'] ?></td>
        </tr>
    <?php } ?>
</table>

<canvas id="chart"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('chart');

new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($data, 'subject')) ?>,
        datasets: [{
            label: 'Marks',
            data: <?= json_encode(array_column($data, 'marks')) ?>,
            backgroundColor: 'blue'
        }]
    }
});
</script>
