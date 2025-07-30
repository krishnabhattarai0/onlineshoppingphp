<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$orders = $conn->query("SELECT o.*, p.payment_status FROM orders o 
                        JOIN payments p ON o.order_id = p.order_id 
                        WHERE o.user_id = '$user_id'
                        ORDER BY o.created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
  <title>My Orders</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>
<div class="container mt-5">
  <h2 class="mb-4">📦 My Orders</h2>
  <?php if ($orders->num_rows > 0): ?>
  <table class="table table-bordered text-center">
    <thead class="table-dark">
      <tr>
        <th>Order ID</th>
        <th>Total Price</th>
        <th>Status</th>
        <th>Payment</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = $orders->fetch_assoc()): ?>
      <tr>
        <td>#<?php echo $row['order_id']; ?></td>
        <td>Rs. <?php echo $row['total_price']; ?></td>
        <td><?php echo ucfirst($row['status']); ?></td>
        <td><?php echo ucfirst($row['payment_status']); ?></td>
        <td><?php echo $row['created_at']; ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <?php else: ?>
    <div class="alert alert-info text-center">You have no orders.</div>
  <?php endif; ?>
</div>
</body>
</html>
