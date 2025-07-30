<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    exit("Access Denied.");
}

$id = $_GET['id'];

// Step 1: Delete from order_items first (if any)
$conn->query("DELETE FROM order_items WHERE product_id = '$id'");

// Step 2: Delete from cart (optional but good practice)
$conn->query("DELETE FROM cart WHERE product_id = '$id'");

// Step 3: Delete the product
$conn->query("DELETE FROM products WHERE id = '$id'");

// Redirect
header("Location: manage_products.php");
exit();
?>
