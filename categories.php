<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css">
     
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
        <div class="table-container">
            <div>
                <button  class="edit-btn">

                    <a href="./addCategory.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Sr no</th>
                        <th>Category Name</th>
                        <th>Action</th>
                      
                    </tr>
                </thead>
                <tbody>
                  <?php 
                  require  "connectdb.php";
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);

// Fetch categories as an array
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Close connection
// mysqli_close($conn);

// Display categories
foreach ($categories as $category) { ?>
  <tr>
    <td><?= $category["id"] ?></td>
    <td><?= $category["category_name"] ?></td>
  
<td>
<form action="updateCategory.php" method="get" class="f">
      <input type="hidden" name="id" value="<?= $category["id"] ?>">
      <button class="edit-btn" type="submit">Edit</button>
    </form>
    <form action="#" method="get" class="f">
        <input type="hidden" name="id" value="<?= $category["id"] ?>">
        <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>

  </td>

  </tr>
<?php } ?>


<?php

require 'connectdb.php';

if (isset($_GET['id'])) {
// if (isset($_GET['btn'])) {
  $id = $_GET['id'];
  $query = "DELETE FROM categories WHERE id = '$id'";
  mysqli_query($conn, $query);
  mysqli_close($conn);
  header("Location: categories.php");
  exit;
}

?>

                </tbody>
            </table>
        </div>
    </section>

    <script src="script.js"></script>
</body>
</html>
