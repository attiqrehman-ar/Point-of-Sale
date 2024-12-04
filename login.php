<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
   </head>
   <body>

      <?php

$error="";
require "./connectdb.php";
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   $email = $_POST["email"];
   $password = $_POST["password"];
   
   // Check if admin is logging in
   if ($email == "admin@gmail.com" && $password == "1234") {
      session_start();
          $_SESSION["admin"] = true;
          var_dump($_SESSION["admin"]);
          header("Location: checklogin.php");
          exit;
        }
      
        // Check if supplier is logging in
        $query = "SELECT * FROM suppliers WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) > 0) {
          $_SESSION["supplier"] = true;
          header("Location: checklogin.php");
          exit;
        }
      
        $error = "Invalid email or password";
      }
      
      mysqli_close($conn);
      ?>
      
      

      <div class="center">
         <div class="container">
            <div class="error"> <?php echo $error ?> </div>
            <div class="text">
              Please Login here
            </div>
            <form  method="post">
               <div class="data">
                  <label>Email</label>
                  <input type="email" required name="email">
               </div>
               <div class="data">
                  <label>Password</label>
                  <input type="password" required name="password">
               </div>
               <!-- <div class="forgot-pass">
                  <a href="#">Forgot Password?</a>
               </div> -->
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit">login</button>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>