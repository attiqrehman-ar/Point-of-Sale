<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="form.css">
    <link rel="stylesheet" href="style.css">
     
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
            <span class="logo_name">POS</span>
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
    
    <?php

$mesg="";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productName = $_POST["productName"];
    $category_id = $_POST["category"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $description = $_POST["description"];
    
    try{
      require 'connectdb.php';
      // Query to insert product into database
      $query = "SELECT MAX(id) as max_id FROM products";
      $result = mysqli_query($conn, $query);
      $row = mysqli_fetch_assoc($result);
      $max_product_id = $row['max_id'] + 1;
      
      // Insert a new product into the products table
      $query = "INSERT INTO products (id, product_name, category_id, price, quantity, description) VALUES ('$max_product_id', '$productName', '$category_id', '$price', '$quantity', '$description')";
      mysqli_query($conn, $query);
    
      // Close connection
      mysqli_close($conn);
    
      // Redirect to products page
      header("Location: products.php");
      exit;
    } catch (mysqli_sql_exception $e) {
            $mesg= "Trigger occure. You enter quantity less then 0";    
    }
} 
    
    ?>
    
    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>
        </div>
        
        <!-- Add this form below the existing top div -->
        <div class="form-container">
            <h2>Add Product</h2>
            <div class="error"> <?php echo $mesg ?> </div>
            <form id="productForm" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" id="productName" name="productName" required>
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category" required>
    <?php
    require 'connectdb.php';
    $query = "SELECT * FROM categories";
    $result = mysqli_query($conn, $query);
    // Fetch categories as an array
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Display categories as options
    foreach ($categories as $category) {
      ?>
      <option value="<?= $category["id"] ?>"><?= $category["category_name"] ?></option>
      <?php
    }
    ?>
  </select>
  

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" required></textarea>
                    </div>
               
                </div>
                <button type="submit">Add Product</button>
            </form>
        </div>
    </section>
    
    

    <script src="script.js"></script>
</body>
</html>
