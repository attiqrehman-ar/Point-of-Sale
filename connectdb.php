<?php
// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "inventory management system");
      
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
