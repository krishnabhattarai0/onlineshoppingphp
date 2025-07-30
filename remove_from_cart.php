<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$cart_id = $_GET['id'];
$conn->query("DELETE FROM cart WHERE id = '$cart_id'");
header("Location: view_cart.php");
exit();
?>
