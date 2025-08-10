<?php
session_start();
include 'db.php';

// Handle search and category filter
$search = $_GET['search'] ?? '';
$filter = $_GET['category'] ?? '';

$sql = "SELECT * FROM products WHERE 1";
if (!empty($search)) $sql .= " AND name LIKE '%$search%'";
if (!empty($filter)) $sql .= " AND category = '$filter'";

$products = $conn->query($sql);
$categories = $conn->query("SELECT DISTINCT category FROM products");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Bazzar - Online Shopping</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .product-card {
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .product-card img {
      height: 90%;
      max-height: 250px;
      object-fit: cover;
      width: 100%;
    }
    .product-info {
      background-color: rgb(243, 230, 230);
      padding: 10px;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav">
        <?php if (isset($_SESSION['user_id'])): ?>
          <li class="nav-item"><a class="nav-link" href="view_cart.php">Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="orders.php">My Orders</a></li>
          <li class="nav-item"><a class="nav-link" href="profile.php">Profile</a></li>
          <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Logout</a></li>
        <?php else: ?>
          <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
          <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
        <?php endif; ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle text-warning" href="#" role="button" data-bs-toggle="dropdown">
            Admin
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
            <li><a class="dropdown-item" href="admin_dashboard.php">Dashboard</a></li>
            <li><a class="dropdown-item" href="add_product.php">Add Product</a></li>
            <li><a class="dropdown-item" href="manage_products.php">Manage Products</a></li>
            <li><a class="dropdown-item" href="manage_payments.php">Manage Payments</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<!-- Contents -->
<div class="container mt-4">
  <h2 class="text-center mb-4">🛒 Welcome to Bazzar</h2>

  <!-- Search & Filter -->
  <form method="GET" class="d-flex justify-content-center mb-4">
    <input class="form-control w-25 me-2" name="search" placeholder="Search products..." value="<?php echo $search; ?>">
    <select class="form-select w-25 me-2" name="category">
      <option value="">All Categories</option>
      <?php while ($cat = $categories->fetch_assoc()): ?>
        <option value="<?php echo $cat['category']; ?>" <?php if ($cat['category'] == $filter) echo 'selected'; ?>>
          <?php echo ucfirst($cat['category']); ?>
        </option>
      <?php endwhile; ?>
    </select>
    <button class="btn btn-outline-primary">Search</button>
  </form>

  <!-- Products -->
  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4">
    <?php if ($products->num_rows > 0): ?>
      <?php while ($row = $products->fetch_assoc()): ?>
        <div class="col">
          <div class="card shadow-sm text-center product-card">
            <img src="<?php echo $row['image']; ?>" alt="Product Image">
            <div class="product-info">
              <h5 class="card-title mb-1"><?php echo ucfirst($row['name']); ?></h5>
              <p class="mb-1 text-danger fw-bold">
                Rs. <?php echo $row['price']; ?>
                <span class="text-muted text-decoration-line-through small">
                  Rs. <?php echo number_format($row['price'] * 1.15, 2); ?>
                </span>
                <span class="badge bg-success ms-2">15% OFF</span>
              </p>
              <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-primary me-2">Add to Cart</a>
              <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-primary">Details</a>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    <?php else: ?>
      <div class="col-12">
        <div class="alert alert-info text-center">No products found.</div>
      </div>
    <?php endif; ?>
  </div>
</div>

<!-- Footer -->
<footer class="bg-dark text-white text-center text-lg-start mt-5">
  <div class="container p-4">
    <div class="row">
      <div class="col-lg-6 col-md-12 mb-4 mb-md-0">
        <h5 class="text-uppercase">Bazzar</h5>
        <p>Your trusted local online shopping platform for clothes, gadgets, and more.</p>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
        <h5 class="text-uppercase">Quick Links</h5>
        <ul class="list-unstyled mb-0">
          <li><a href="index.php" class="text-white">Home</a></li>
          <li><a href="view_cart.php" class="text-white">Cart</a></li>
          <li><a href="orders.php" class="text-white">My Orders</a></li>
          <li><a href="profile.php" class="text-white">Profile</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="text-center p-3 bg-secondary">
    © <?php echo date('Y'); ?> Bazzar. All rights reserved.
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
