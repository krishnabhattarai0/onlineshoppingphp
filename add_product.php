<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') {
    exit("Access Denied.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $desc     = $_POST['description'];
    $price    = $_POST['price'];
    $category = $_POST['category'];

    $image_path = '';

    if (!empty($_FILES['image_file']['name'])) {
        $image_name = $_FILES['image_file']['name'];
        $image_tmp  = $_FILES['image_file']['tmp_name'];
        $image_ext  = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed    = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($image_ext, $allowed)) {
            die("❌ Invalid file format. Only JPG, JPEG, PNG, GIF allowed.");
        }

        $new_name    = uniqid() . "." . $image_ext;
        $upload_path = "uploads/" . $new_name;
        move_uploaded_file($image_tmp, $upload_path);
        $image_path = $upload_path;

    } elseif (!empty($_POST['image_url'])) {
        $image_path = $_POST['image_url'];
    } else {
        die("❌ Please upload a file or provide an image URL.");
    }

    $sql = "INSERT INTO products (name, description, price, category, image)
            VALUES ('$name', '$desc', '$price', '$category', '$image_path')";
    $conn->query($sql);
    header("Location: manage_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Product - Bazzar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    label {
      font-weight: bold;
    }
  </style>
</head>
<body>

<!-- Top Navigation Brand -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>

<!-- Main Form -->
<div class="container mt-5">
  <h2 class="mb-4">➕ Add New Product</h2>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="name">Product Name:</label>
      <input id="name" class="form-control" name="name" placeholder="Product Name" required>
    </div>

    <div class="mb-3">
      <label for="desc">Description:</label>
      <textarea id="desc" class="form-control" name="description" placeholder="Product Description" required></textarea>
    </div>

    <div class="mb-3">
      <label for="price">Price (Rs):</label>
      <input id="price" class="form-control" type="number" name="price" step="0.01" placeholder="e.g. 499.00" required>
    </div>

    <div class="mb-3">
      <label for="category">Category:</label>
      <input id="category" class="form-control" name="category" placeholder="e.g. Electronics, Clothing" required>
    </div>

    <div class="mb-3">
      <label>Product Image (Choose one option):</label>
      <input class="form-control my-2" type="file" name="image_file" accept=".jpg,.jpeg,.png,.gif">
      <small class="text-muted">OR paste an image URL below</small>
      <input class="form-control my-2" type="url" name="image_url" placeholder="https://example.com/image.jpg">
    </div>

    <button class="btn btn-primary" type="submit">Add Product</button>
  </form>
</div>

</body>
</html>
