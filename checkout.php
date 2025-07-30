<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['address'];
    $payment_method = $_POST['payment'];

    // fetch cart
    $cart_items = $conn->query("SELECT cart.product_id, cart.quantity, products.price 
                                FROM cart 
                                JOIN products ON cart.product_id = products.id 
                                WHERE cart.user_id = '$user_id'");

    if ($cart_items->num_rows == 0) {
        echo "<script>alert('Your cart is empty!'); window.location='index.php';</script>";
        exit();
    }

    $total = 0;
    $order_items = [];

    while ($item = $cart_items->fetch_assoc()) {
        $subtotal = $item['price'] * $item['quantity'];
        $total += $subtotal;
        $order_items[] = [
            'product_id' => $item['product_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price']
        ];
    }

    // save order
    $conn->query("INSERT INTO orders (user_id, total_price, address, status) 
                  VALUES ('$user_id', '$total', '$address', 'pending')");
    $order_id = $conn->insert_id;

    // order items
    foreach ($order_items as $item) {
        $conn->query("INSERT INTO order_items (order_id, product_id, quantity, price)
                      VALUES ('$order_id', '{$item['product_id']}', '{$item['quantity']}', '{$item['price']}')");
    }

    // payment entry
    $conn->query("INSERT INTO payments (order_id, amount, payment_status, method) 
                  VALUES ('$order_id', '$total', 'pending', '$payment_method')");

    // clear cart
    $conn->query("DELETE FROM cart WHERE user_id = '$user_id'");

    echo "<script>alert('✅ Order placed successfully!'); window.location='orders.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Checkout - Bazzar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>label { font-weight: bold; }</style>
</head>
<body>
<div class="container mt-5">
  <h2>🚚 Delivery & Payment Details</h2>

  <form method="POST">
    <div class="mb-3">
      <label for="address">Delivery Address:</label>
      <textarea class="form-control" name="address" id="address" required placeholder="Enter your full address"></textarea>
    </div>

    <div class="mb-3">
      <label>Payment Method:</label><br>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" value="cod" id="cod" checked>
        <label class="form-check-label" for="cod">Cash on Delivery (COD)</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" name="payment" value="online" id="online">
        <label class="form-check-label" for="online">Online Payment</label>
      </div>
    </div>

    <button class="btn btn-success" type="submit">✅ Confirm Order</button>
  </form>
</div>
</body>
</html>
