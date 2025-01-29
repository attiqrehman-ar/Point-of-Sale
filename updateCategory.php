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
        <?php
require 'connectdb.php';

$id = $_GET['id'];
$query = "SELECT * FROM categories WHERE id = '$id'";
$result = mysqli_query($conn, $query);
$category = mysqli_fetch_assoc($result);

mysqli_close($conn);
?>
  
        <!-- Add this form below the existing top div -->
        <div class="form-container category-form">
            <h2>Update Category</h2>
            <form id="productForm" class="category-form" method="post">
                <div class="form-row">
                    <div class="form-group">
                        <label for="productName">Cateogry Name</label>
                        <input type="text" id="productName" name="name" value="<?= $category['category_name'] ?>" required>
</div> 
                    </div>
                </div>
                <button type="submit">Update Category</button>
            </form>
        </div>
    </section>
    
    <?php
require 'connectdb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];

  $query = "UPDATE categories SET category_name = '$name' WHERE id = '$id'";
  mysqli_query($conn, $query);

  mysqli_close($conn);

  header("Location: categories.php");
  exit;
}
?>


    <script src="script.js"></script>
</body>
</html>
