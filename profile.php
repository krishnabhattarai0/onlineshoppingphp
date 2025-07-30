<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) header("Location: login.php");

$user_id = $_SESSION['user_id'];
$user = $conn->query("SELECT * FROM users WHERE id='$user_id'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $conn->query("UPDATE users SET name='$name', email='$email' WHERE id='$user_id'");
    $_SESSION['user_name'] = $name;
    $msg = "Profile updated successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Profile</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
        
          <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
        
        
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <h2>👤 My Profile</h2>
  <?php if (isset($msg)) echo "<div class='alert alert-success'>$msg</div>"; ?>
  <form method="POST">
    <input class="form-control my-2" name="name" value="<?php echo $user['name']; ?>" required>
    <input class="form-control my-2" name="email" value="<?php echo $user['email']; ?>" required>
    <button class="btn btn-success">Update Profile</button>
  </form>
</div>
</body>
</html>
