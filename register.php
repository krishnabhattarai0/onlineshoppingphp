<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Check for existing email
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $msg = "Email already registered.";
    } else {
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if ($conn->query($sql)) {
            $msg = "Registration successful. <a href='login.php'>Login here</a>";
        } else {
            $msg = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
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
     
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2>User Registration</h2>
  <?php if (isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>
  <form method="POST">
    <input class="form-control my-2" type="text" name="name" placeholder="Full Name" required>
    <input class="form-control my-2" type="email" name="email" placeholder="Email" required>
    <input class="form-control my-2" type="password" name="password" placeholder="Password" required>
    <button class="btn btn-primary" type="submit">Register</button>
  </form>
</div>
</body>
</html>
