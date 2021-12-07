<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width">
  <title>Admin Login</title>
  <link rel="stylesheet" href="admin_style.css">
  <script src="login_ver.js"></script>
</head>
<body>

  <h1> Admin Login </h1>
  <p> Please enter your Admin details </p>

  <form method= POST action="" onsubmit="return validateLogin();">
    <label>Email:</label><br>
    <input type="text" name="email" id="email"/> <br>
    <label> Password:</label><br>
    <input type="password" name="password" id="password"/> <br>
  <br><input type="submit" value = "Login" class="button" name="submitbutton"><br>
  </form>
  <a href="login.php">Not an Admin? Click here</a>
</body>
</html>


<?php

if(isset($_POST['submitbutton'])){

  $db = mysqli_connect("localhost", "awmacleo",
  "456JX4Z672fZwyKs", "carwashdb_group1");

  $email=$_POST['email'];
  $password=$_POST['password'];

  $query = "SELECT * FROM users WHERE
  email = '" .$email. "' AND password = '" .$password. "' AND role = 1";

  $result = mysqli_query($db,$query);

  if (mysqli_num_rows($result)==1)
     {
     $row = mysqli_fetch_assoc($result);
     $role = $row['role'];

     $_SESSION['email'] = $email;
     $_SESSION['role'] = $role;
     header("Location: https://datalab3.bus.sfu.ca/awmacleo/Project/admin_page.php");
    }
    else
     {echo "<script language='javascript'>";
      echo "alert('Email or Password is incorrect')";
      echo "</script>";
     }
}
  $db->close();
?>
