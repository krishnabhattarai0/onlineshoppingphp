<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $res = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($res->num_rows == 1) {
        $user = $res->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role'] = $user['role'];

            header("Location: index.php"); // Go to homepage after login
            exit();
        } else {
            $msg = "❌ Invalid password.";
        }
    } else {
        $msg = "❌ Email not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        

        
      </ul>
    </div>
  </div>
</nav>



<div class="container mt-5">
  <h2>Login</h2>
  <?php if (isset($msg)) echo "<div class='alert alert-danger'>$msg</div>"; ?>
  <form method="POST">
    <input class="form-control my-2" type="email" name="email" placeholder="Email" required>
    <input class="form-control my-2" type="password" name="password" placeholder="Password" required>
    <button class="btn btn-success" type="submit">Login</button>
  </form>
</div>
</body>
</html>
