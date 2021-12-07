<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width">
   <title>Create an Account</title>
  <link rel="stylesheet" href="create_style.css">
  <script src="input_ver.js"></script>
</head>
<body>

<div class="background">


  <h1>Create an Account</h1>

  <div class="message">
  <p>Please enter your personal details to create your Car-Toon's Carwash online account.</p>
  <p>Upon succesful creation of your account you will be redirected to the Login page.</p>
  </div>

  <div class="container">
    <p>Account Details</p>

    <form action = "create_account.php" method = "POST" name="account" onsubmit="return (validatePhone(document.account.phone) && checkPass(this));">



      <label for="firstname">First Name:</label>
      <input type="text" id = "firstname" name="firstname" required><br>

      <label for="lastname">Last Name:</label>
      <input type="text" id = "lastname" name="lastname" required><br>

      <label for="emailaddress">Email:</label>
      <input type="text" id="email" name="email" required><br>

      <label for="phone" >Phone Number:</label>
      <input type="tel" id="phone" name="phone" placeholder="Ex. 6045552929" required><br>

      <label for="dob">Date of Birth:</label>
      <input type="date" id="date_of_birth" name="date_of_birth" required><br>





      <label for="password">New Password:</label>
      <input type="password" id="password" name="password" required><br>

      <label for="confirmpass">Confirm Password:</label>
      <input type="password" id="confirmpass" name="confirmpass" required><br>
      <input type="submit" value="Create Account" class="button" name="submitbutton">
      <br>
      <a href="login.php">Already have an account? Click here</a>


    </form>
    <br>
  </div>
</div>

<?php
if(isset($_POST['submitbutton'])){
   $servername = "localhost";
   $username = "awmacleo";
   $password = "456JX4Z672fZwyKs";
   $dbname = "carwashdb_group1";

   // Create connection
   $db = mysqli_connect($servername, $username, $password, $dbname);
   // Check connection
   if ($db->connect_error) {
     die("Connection failed: " . $db->connect_error);
   }


   $sql="INSERT INTO users
   (firstname,lastname,email,phone_number,date_of_birth,password)
   VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[email]',
   '$_POST[phone]','$_POST[date_of_birth]','$_POST[password]')";

   $query = "SELECT * FROM users WHERE
   email = '$_POST[email]'";

   $result = mysqli_query($db,$query);

   if (mysqli_num_rows($result)==0)
   {

       if (mysqli_query($db,$sql))
       {
         header("Location: https://datalab3.bus.sfu.ca/awmacleo/Project/login.php");
       }
       else
       {
          echo "<script language='javascript'>";
          echo "alert('Unable to create account due to database error, please try again')";
          echo "</script>";
         }

   }

   else
   {
     echo "<script language='javascript'>";
     echo "alert('There is already an account with that email address')";
     echo "</script>";
   }
   mysqli_close($db);
}
 ?>


</body>
</html>
