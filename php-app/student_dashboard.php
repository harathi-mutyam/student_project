<?php
session_start();
include 'config.php';

/* LOGIN CHECK */
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

/* STUDENT ID CHECK */
if (!isset($_SESSION['student_id'])) {
    die("Student session missing. Please login again.");
}

$student_id = (int) $_SESSION['student_id'];

/* STUDENT DATA */
$studentQuery = mysqli_query($conn, "SELECT * FROM students WHERE id=$student_id");

if (!$studentQuery || mysqli_num_rows($studentQuery) == 0) {
    die("Student not found.");
}

$student = mysqli_fetch_assoc($studentQuery);

/* SUBJECTS */
$result = mysqli_query($conn, "SELECT * FROM subjects WHERE student_id=$student_id");

$total = 0;
$count = 0;
$subjects = [];
$marks = [];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

<div class="container mt-5">
<div class="card shadow p-4">

<h2 class="text-center">
Welcome <?php echo htmlspecialchars($student['name']); ?>
</h2>

<table class="table table-bordered mt-3">
<thead class="table-dark">
<tr>
<th>Subject</th>
<th>Marks</th>
</tr>
</thead>

<tbody>
<?php while ($row = mysqli_fetch_assoc($result)) {

$total += $row['marks'];
$count++;

$subjects[] = $row['subject_name'];
$marks[] = $row['marks'];
?>
<tr>
<td><?php echo htmlspecialchars($row['subject_name']); ?></td>
<td><?php echo $row['marks']; ?></td>
</tr>
<?php } ?>
</tbody>
</table>

<?php
$percentage = ($count > 0) ? ($total / ($count * 100)) * 100 : 0;
?>

<h4>Total Marks: <?php echo $total; ?></h4>
<h4>Percentage: <?php echo round($percentage, 2); ?>%</h4>

<hr>

<canvas id="marksChart"></canvas>

<script>
new Chart(document.getElementById('marksChart'), {
    type: 'bar',
    data: {
        labels: <?php echo json_encode($subjects); ?>,
        datasets: [{
            label: 'Marks',
            data: <?php echo json_encode($marks); ?>,
            backgroundColor: 'rgba(54,162,235,0.7)'
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true, max: 100 }
        }
    }
});
</script>

<br>

<a href="logout.php" class="btn btn-danger">Logout</a>

</div>
</div>

</body>
</html>
