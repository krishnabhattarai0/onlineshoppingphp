<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$product_id = $_GET['id'];

// Check if product is already in cart
$check = $conn->query("SELECT * FROM cart WHERE user_id='$user_id' AND product_id='$product_id'");

if ($check->num_rows > 0) {
    // If exists, increase quantity
    $conn->query("UPDATE cart SET quantity = quantity + 1 WHERE user_id='$user_id' AND product_id='$product_id'");
} else {
    // Else insert new
    $conn->query("INSERT INTO cart (user_id, product_id, quantity) VALUES ('$user_id', '$product_id', 1)");
}

header("Location: view_cart.php");
exit();
?>
