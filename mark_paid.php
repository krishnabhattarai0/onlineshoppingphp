<?php
session_start();
include 'db.php';
if ($_SESSION['role'] !== 'admin') exit("Access Denied");

$payment_id = $_GET['id'];

// Mark payment as paid
$conn->query("UPDATE payments SET payment_status='paid' WHERE payment_id='$payment_id'");

// Also update order status
$conn->query("UPDATE orders SET status='completed' 
              WHERE order_id=(SELECT order_id FROM payments WHERE payment_id='$payment_id')");

header("Location: manage_payments.php");
exit();
?>
