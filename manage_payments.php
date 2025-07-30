<?php
session_start();
include 'db.php';
if ($_SESSION['role'] !== 'admin') exit("Access Denied");

// Get all pending payments
$result = $conn->query("SELECT payments.*, users.name FROM payments 
  JOIN orders ON payments.order_id = orders.order_id 
  JOIN users ON orders.user_id = users.id 
  WHERE payments.payment_status = 'pending'");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Payments</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<!-- nav -->
 <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>

<div class="container mt-5">
  <h2>🧾 Pending Payments</h2>
  <?php if ($result->num_rows > 0): ?>
  <table class="table table-bordered text-center">
    <tr class="table-dark">
      <th>Payment ID</th>
      <th>Order ID</th>
      <th>User</th>
      <th>Amount</th>
      <th>Status</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?php echo $row['payment_id']; ?></td>
      <td><?php echo $row['order_id']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td>Rs. <?php echo $row['amount']; ?></td>
      <td><?php echo ucfirst($row['payment_status']); ?></td>
      <td><a href="mark_paid.php?id=<?php echo $row['payment_id']; ?>" class="btn btn-success btn-sm">Mark as Paid</a></td>
    </tr>
    <?php endwhile; ?>
  </table>
  <?php else: ?>
    <div class="alert alert-info">No pending payments.</div>
  <?php endif; ?>
</div>
</body>
</html>
