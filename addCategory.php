<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!----======== CSS ======== -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="main.css"> 
    <link rel="stylesheet" href="form.css">
     
    <!----===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Add category</title> 
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
                <li><a href="./login.php">
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
        
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name = $_POST["name"];
            
            require 'connectdb.php';
          // Query to insert category into database
          $query = "SELECT MAX(id) as max_id FROM categories";
          $result = mysqli_query($conn, $query);
          $row = mysqli_fetch_assoc($result);
          $max_id = $row['max_id'] + 1;
          
          // Insert a new category into the categories table
          $query = "INSERT INTO categories (id, category_name) VALUES ('$max_id', '$name')";
          mysqli_query($conn, $query);
        
          // Close connection
          mysqli_close($conn);
        
          // Redirect to categories page
          header("Location: categories.php");
        exit;
        }        
        ?>

        <!-- Add this form below the existing top div -->
        <div class="form-container category-form">
            <h2>Add Category</h2>
            <form id="productForm" class="category-form" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Cateogry Name</label>
                        <input type="text" id="productName" name="name" required>
                    </div>
                </div>
                <button type="submit">Add Category</button>
            </form>
        </div>
    </section>
    
    

    <script src="script.js"></script>
</body>
</html>
