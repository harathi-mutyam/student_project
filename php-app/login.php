<?php
session_start();
include 'config.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    $user = mysqli_fetch_assoc($result);

    if($user && password_verify($password, $user['password'])){

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['student_id'] = $user['student_id'];

        if($user['role'] == 'admin'){
            header("Location:index.php");
        }
        else{
            header("Location:student_dashboard.php");
        }

        exit();
    }

    $error = "Invalid Login";
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card p-4 shadow">

<h2 class="text-center mb-4">Login</h2>

<?php if(isset($error)){ ?>

<div class="alert alert-danger">
<?php echo $error; ?>
</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label class="d-block text-start">
Email
</label>

<input type="email"
       name="email"
       class="form-control"
       required>

</div>

<div class="mb-3">

<label class="d-block text-start">
Password
</label>

<input type="password"
       name="password"
       class="form-control"
       required>

</div>

<div class="text-start">

<button type="submit"
        name="login"
        class="btn btn-primary">

Login

</button>

</div>

</form>

</div>

</div>

</body>
</html>
