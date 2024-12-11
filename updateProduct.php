<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="form.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="pictures/logo.jpeg" alt="">
            </div>
            <span class="logo_name">IMS</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="./products.php">
                    <i class="uil uil-box"></i>
                    <span class="link-name">Products</span>
                </a></li>
                <li><a href="./categories.php">
                    <i class="uil uil-list-ul"></i>
                    <span class="link-name">Categories</span>
                </a></li>
                <li><a href="./orders.php">
                    <i class="uil uil-shopping-cart"></i>
                    <span class="link-name">Orders</span>
                </a></li>
                <li><a href="./customers.php">
                    <i class="uil uil-users-alt"></i>
                    <span class="link-name">Customers</span>
                </a></li>
                <?php
                
                session_start();

                if (isset($_SESSION["admin"]) && $_SESSION["admin"] === true) { ?>

                     <li><a href="./suppliers.php"> 
                         <i class="uil uil-truck"></i> 
                        <span class="link-name">Suppliers</span> 
                     </a></li>
                <?php } ?>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="./logout.php">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>
                <div class="mode-toggle">
                  <!-- <span class="switch"></span> -->
                </div>
            </ul>
        </div>
    </nav>
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Update Product</h2>

<?php
require 'connectdb.php';
$id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);
mysqli_close($conn);
?>

<!-- Form to update product -->
<form id="productForm" method="post">
  <div class="form-row">
    <div class="form-group">
      <label for="productName">Product Name</label>
      <input type="text" id="productName" name="productName" value="<?= $product['product_name'] ?>" required>
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select id="category" name="category" required>
        <option value="" disabled selected>Select Category</option>
        <?php
        require 'connectdb.php';
        $query = "SELECT * FROM categories";
        $result = mysqli_query($conn, $query);
        while ($category = mysqli_fetch_assoc($result)) {
          ?>
          <option value="<?= $category['id'] ?>" <?= $product['category_id'] == $category['id'] ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
          <?php
        }
        mysqli_close($conn);
        ?>
      </select>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="price">Price</label>
      <input type="number" id="price" name="price" value="<?= $product['price'] ?>" required>
    </div>
    <div class="form-group">
      <label for="quantity">Quantity</label>
      <input type="number" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group">
      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" required><?= $product['description'] ?></textarea>
    </div>
  </div>
  <button type="submit">Update Product</button>
</form>

        </div>
    </section>
    
    <?php
require 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
//   $id = $_GET["id"];
  $productName = $_POST["productName"];
  $category = $_POST["category"];
  $price = $_POST["price"];
  $quantity = $_POST["quantity"];
  $description = $_POST["description"];

  $query = "UPDATE products SET product_name = '$productName', category_id = '$category', price = '$price', quantity = '$quantity', description = '$description' WHERE id = '$id'";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  header("Location: products.php");
  exit;
}
?>


    <script src="script.js"></script>
</body>
</html>
