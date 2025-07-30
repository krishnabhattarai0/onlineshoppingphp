<?php
session_start();
include 'db.php';
if ($_SESSION['role'] !== 'admin') { echo "Access Denied."; exit(); }

$products = $conn->query("SELECT * FROM products");
?>

<!DOCTYPE html>
<html>
<head>
  <title>Manage Products</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <!-- nav -->
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
  <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
       
            <li><a  href="add_product.php">Add Product</a></li>
          
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h2>Manage Products</h2>
  <table class="table table-bordered text-center">
    <tr class="table-dark">
      <th>Name</th>
      <th>Price</th>
      <th>Category</th>
      <th>Actions</th>
    </tr>
    <?php while ($row = $products->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $row['name']; ?></td>
      <td>Rs. <?php echo $row['price']; ?></td>
      <td><?php echo $row['category']; ?></td>
      <td>
        <a class="btn btn-sm btn-warning" href="edit_product.php?id=<?php echo $row['id']; ?>">Edit</a>
        <a class="btn btn-sm btn-danger" href="delete_product.php?id=<?php echo $row['id']; ?>">Delete</a>
      </td>
    </tr>
    <?php } ?>
  </table>
</div>
</body>
</html>
