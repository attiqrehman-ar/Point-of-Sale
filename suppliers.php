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

    <title>Admin Dashboard </title> 
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

                    <a href="./addSupplier.php">
                        <i class="uil uil-plus"></i>
                        Add New
                    </a>
                </button>
            </div>
            <table class="product-table">
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Number</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
<?php
                require 'connectdb.php';

$query = "SELECT * FROM suppliers";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
  while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['number'] . "</td>";
    echo "<td>" . $row['address'] . "</td>";
    echo "<td>" . $row['email'] . "</td>";
    echo "<td>";
    echo "<button class='edit-btn'><a href='updateSupplier.php?id=" . $row['id'] . "'>Edit</a></button>";
    ?> 
    
        <form action="#" method="get" class="f">
        <input type="hidden" name="id" value="<?= $row["id"] ?>">
        <button class="delete-btn" name="btn" type="submit" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
    </form>
    <?php
    
    echo "</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='5'>No suppliers found</td></tr>";
}
?>

<?php
if (isset($_GET['btn'])) {
    // Retrieve the ID of the customer from the previous page
  $id = $_GET['id'];

  // Delete the customer's record from the database
  $query = "DELETE FROM suppliers WHERE id = '$id'";
  mysqli_query($conn, $query);

  // Close the database connection
  mysqli_close($conn);

  // Redirect to the customers page
  header("Location: customers.php");
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
