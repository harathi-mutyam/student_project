<?php

session_start();

include 'config.php';

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$student = mysqli_fetch_assoc(
    mysqli_query($conn,
    "SELECT * FROM students WHERE id=$student_id")
);

$result = mysqli_query($conn,
    "SELECT * FROM subjects WHERE student_id=$student_id"
);

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

<h2 class="text-center mb-4">

Welcome <?php echo $student['name']; ?>

</h2>

<table class="table table-bordered">

<thead class="table-dark">

<tr>

<th>Subject</th>
<th>Marks</th>

</tr>

</thead>

<tbody>

<?php while($row = mysqli_fetch_assoc($result)) {

$total += $row['marks'];
$count++;

$subjects[] = $row['subject_name'];
$marks[] = $row['marks'];

?>

<tr>

<td><?php echo $row['subject_name']; ?></td>

<td><?php echo $row['marks']; ?></td>

</tr>

<?php } ?>

</tbody>

</table>

<?php

$percentage = 0;

if($count > 0){

    $percentage = ($total / ($count * 100)) * 100;
}
?>

<h4>Total Marks: <?php echo $total; ?></h4>

<h4>
Percentage:
<?php echo round($percentage,2); ?>%
</h4>

<hr>

<canvas id="marksChart"></canvas>

<script>

const ctx = document.getElementById('marksChart');

new Chart(ctx, {

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

            y: {

                beginAtZero: true,
                max: 100
            }
        }
    }
});

</script>

<br>

<a href="logout.php"
   class="btn btn-danger">

Logout

</a>

</div>

</div>

</body>
</html>
