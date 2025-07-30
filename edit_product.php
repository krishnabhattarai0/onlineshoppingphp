<?php
session_start();
include 'db.php';

if ($_SESSION['role'] !== 'admin') exit("Access Denied");

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM products WHERE id = '$id'")->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = $_POST['name'];
    $desc     = $_POST['description'];
    $price    = $_POST['price'];
    $category = $_POST['category'];

    $image_path = $product['image']; // keep old if no new file

    if (!empty($_FILES['image_file']['name'])) {
        $image_name = $_FILES['image_file']['name'];
        $image_tmp  = $_FILES['image_file']['tmp_name'];
        $image_ext  = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
        $allowed    = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($image_ext, $allowed)) {
            die("❌ Invalid file type. Only JPG, PNG, GIF allowed.");
        }

        $new_name = uniqid() . "." . $image_ext;
        $upload_path = "uploads/" . $new_name;
        move_uploaded_file($image_tmp, $upload_path);
        $image_path = $upload_path;
    }

    $sql = "UPDATE products 
            SET name='$name', description='$desc', price='$price', category='$category', image='$image_path' 
            WHERE id='$id'";
    $conn->query($sql);
    header("Location: manage_products.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Product - Bazzar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand fw-bold" href="index.php">🛒 Bazzar</a>
  </div>
</nav>
<div class="container mt-5">
  <h2>Edit Product</h2>

  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label class="form-label">Product Name:</label>
      <input class="form-control" name="name" value="<?php echo $product['name']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Description:</label>
      <textarea class="form-control" name="description" required><?php echo $product['description']; ?></textarea>
    </div>

    <div class="mb-3">
      <label class="form-label">Price (Rs):</label>
      <input class="form-control" type="number" name="price" value="<?php echo $product['price']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Category:</label>
      <input class="form-control" name="category" value="<?php echo $product['category']; ?>" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Current Image:</label><br>
      <img src="<?php echo $product['image']; ?>" style="max-width: 200px;"><br>

      <label class="form-label mt-2">Upload New Image (optional):</label>
      <input class="form-control" type="file" name="image_file" accept=".jpg,.jpeg,.png,.gif">
    </div>

    <button class="btn btn-success" type="submit">Update Product</button>
  </form>
</div>
</body>
</html>
