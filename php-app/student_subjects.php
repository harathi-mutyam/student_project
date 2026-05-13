<?php
session_start();
include 'config.php';

/* 1. Check login */
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

/* 2. Make sure student_id exists */
if (!isset($_SESSION['student_id'])) {
    die("Student ID not found in session. Please login again.");
}

$student_id = (int) $_SESSION['student_id'];

/* 3. Fetch student safely */
$studentQuery = mysqli_query($conn, "SELECT * FROM students WHERE id = $student_id");

if (!$studentQuery || mysqli_num_rows($studentQuery) == 0) {
    die("Student not found in database.");
}

$student = mysqli_fetch_assoc($studentQuery);

/* 4. Fetch subjects safely */
$result = mysqli_query($conn, "SELECT * FROM subjects WHERE student_id = $student_id");

if (!$result) {
    die("Error fetching subjects: " . mysqli_error($conn));
}

/* 5. Initialize */
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
            Welcome <?php echo htmlspecialchars($student['name']); ?>
        </h2>

        <table class="table table-bordered">
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
                    <td><?php echo htmlspecialchars($row['marks']); ?></td>
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

        <a href="logout.php" class="btn btn-danger">Logout</a>

    </div>
</div>

</body>
</html>
