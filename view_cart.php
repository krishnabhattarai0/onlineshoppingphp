<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT cart.id AS cart_id, products.name, products.price, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.id 
          WHERE cart.user_id = '$user_id'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>

<div class="container mt-5">
  <h2 class="mb-4">🛒 Your Cart</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered text-center">
      <thead class="table-dark">
        <tr>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Subtotal</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
      <?php $total = 0; while ($row = $result->fetch_assoc()): ?>
        <?php $subtotal = $row['price'] * $row['quantity']; $total += $subtotal; ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td>Rs. <?php echo $row['price']; ?></td>
          <td><?php echo $row['quantity']; ?></td>
          <td>Rs. <?php echo $subtotal; ?></td>
          <td><a href="remove_from_cart.php?id=<?php echo $row['cart_id']; ?>" class="btn btn-danger btn-sm">Remove</a></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
    <h4 class="text-end me-4">Total: Rs. <?php echo $total; ?></h4>
    <div class="text-end">
      <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
    </div>
  <?php else: ?>
    <div class="alert alert-info text-center">Your cart is empty!</div>
  <?php endif; ?>
</div>
</body>
</html>
