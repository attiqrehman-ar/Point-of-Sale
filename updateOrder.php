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

    <title>Admin Dashboard Panel</title> 
</head>
<body>

<?php
require 'connectdb.php';

$product_id = "";
$price = "";
$quantity = "";
$customer_id = "";

// Retrieve the ID of the customer from the previous page
$id = $_GET['id'];

// Retrieve the customer's data from the database
$query = "SELECT * FROM orders WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

// Populate the form fields with the customer's information
$product_id = $order['product_id'];
$price = $order['price'];
$quantity = $order['quantity'];
$customer_id = $order['customer_id'];

?>
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
            <h2>Add Product</h2>
            <form id="productForm" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="product_id">Product id</label>
                        <input type="text" id="product_id" name="product_id" readonly value="<?php echo $product_id; ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="customer_id">Customer_id</label>
                        <input type="" id="customer_id" name="customer_id" readonly value="<?php echo $customer_id; ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="name" name="price" readonly value="<?php echo $price; ?>" required>
                        </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="name" name="quantity"  value="<?php echo $quantity; ?>" required>
                    </div>
                </div>
               
                <button type="submit">update order</button>
            </form>
        </div>
    </section>
    <?php
if (!empty($_POST)) {
    $quantity = $_POST['quantity'];
    $grand_total = $price * $quantity;

    // Update the customer's record in the database
    $query = "UPDATE orders SET quantity = '$quantity', grand_total='$grand_total' WHERE id = '$id'";
    mysqli_query($conn, $query);
  
    // Close the database connection
    mysqli_close($conn);
  
    // Redirect to the customers page
    header("Location: orders.php");
    exit;
}

?>
    

    <script src="script.js"></script>
</body>
</html>
