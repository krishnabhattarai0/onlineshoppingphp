<?php
session_start();
include 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$product_id = $_GET['id'];
$result = $conn->query("SELECT * FROM products WHERE id = '$product_id'");
if ($result->num_rows == 0) {
    echo "Product not found.";
    exit();
}
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title><?php echo $product['name']; ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>
<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <img src="<?php echo $product['image']; ?>" class="img-fluid rounded" alt="Product Image">
    </div>
    <div class="col-md-6">
      <h2><?php echo $product['name']; ?></h2>
      <h4 class="text-danger">Rs. <?php echo $product['price']; ?></h4>
      <p><?php echo $product['description']; ?></p>
      <p><strong>Category:</strong> <?php echo $product['category']; ?></p>

      <?php if (isset($_SESSION['user_id'])) { ?>
        <a href="add_to_cart.php?id=<?php echo $product['id']; ?>" class="btn btn-success">Add to Cart</a>
      <?php } else { ?>
        <p><a href="login.php" class="btn btn-outline-primary">Login to buy</a></p>
      <?php } ?>
    </div>
  </div>
</div>
</body>
</html>
