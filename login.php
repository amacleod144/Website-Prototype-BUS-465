<?php
session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Login Page</title>
  <link rel="stylesheet" href="login_style.css">
<script src="input_ver.js"></script>
</head>
<body>
<div class="background">

  <h1> Login </h1>
  <p> Please enter your account details </p>

  <div class="container">
    <form method= POST action="login.php" onsubmit="return validateLogin();">
      <label>Email:</label><br>
      <input type="text" name="email" id="email"/> <br>
      <label> Password:</label><br>
      <input type="password" name="password" id="password"/> <br>
    <br><input type="submit" value = "Login" class="button" name="submitbutton"><br>
    </form>
  </div>

  <div class="links">
    <a href="create_account.php">Click here to create an account</a><br>
    <a href="admin_login.php">Click here if you are an Admin</a>
  </div>


<?php

if(isset($_POST['submitbutton'])){
  $db = mysqli_connect("localhost", "awmacleo",
  "456JX4Z672fZwyKs", "carwashdb_group1");

  $email=$_POST['email'];
  $password=$_POST['password'];

  $query = "SELECT * FROM users WHERE
  email = '" .$email. "' AND password = '" .$password. "'";

  $result = mysqli_query($db,$query);

  if (mysqli_num_rows($result)==1)
   {
     $row = mysqli_fetch_assoc($result);
     $user_id = $row['user_id'];
     $firstname = $row['firstname'];

     $_SESSION['email'] = $email;
     $_SESSION['user_id'] = $user_id;
     $_SESSION['firstname'] = $firstname;
     header("Location: https://datalab3.bus.sfu.ca/awmacleo/Project/customer_profile.php");
  }
  else
   {echo "<script language='javascript'>";
    echo "alert('Email or Password is incorrect')";
    echo "</script>";
   }
}
$db->close();

?>


</body>
</html>
