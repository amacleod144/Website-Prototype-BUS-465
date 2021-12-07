<?php
session_start();
if(!isset($_SESSION['email'])){
   header("Location:login.php");
 }

 $db = mysqli_connect("localhost", "awmacleo",
 "456JX4Z672fZwyKs", "carwashdb_group1");

 if ($db->connect_error) {
 die("Connection failed: " . $db->connect_error);
 }

 $query="SELECT * FROM services WHERE service_id = '{$_SESSION['wash']}'";

 $res = mysqli_query($db,$query);
 $row = mysqli_fetch_assoc($res);
 $wash_name = $row['name'];

 $_SESSION['wash_name']=$wash_name;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Payment</title>
    <link href="payment_style.css" rel="stylesheet" type="text/css"/>
    <link href="navbar_style.css" rel="stylesheet" type="text/css"/>
    <script src="confirm.js" type="text/javascript"></script>
  </head>
  <body>

    <div class="background">
      <div class="topnav">
        <a href="customer_profile.php" onclick="return leave_payment();">Home</a>
        <a href="washes_page.php" onclick="return leave_payment();">Washes</a>
        <a href="details_page.php" onclick="return leave_payment();">Details</a>
        <a href="payment_page.php" class="active">Payment</a>
        <div class="topnav-right">
          <a href="logout.php" onclick="return confirm_logout();">Logout</a>
        </div>
      </div>


        <?php
        echo "<h2>"."Payment for ".$_SESSION['wash_name']."</h2>";
        ?>

      <div class="container">
      <form action = "payment_page.php" method = "POST">


          <h2>Billing Address</h2>

          <label for="streetaddress">Street Address:</label>
          <input type="text" id="streetaddress" name="billingaddress" required><br>

          <label for="aptno">Apt. Number: </label>
          <input type="text" id="aptno" name="billingaddress"><br>

          <label for="city">City:</label>
          <input type="text" id="city" name="city" required><br>

          <label for="postalcode">Postal Code: </label>
          <input type="text" id="postalcode" name="billingaddress" required maxlength ="6"> <br>

          <label for="province">Province:</label>
          <select name="address" id="province">
            <option value="" disabled selected>Select your option</option>
            <option value="AB">AB</option>
            <option value="BC">BC</option>
            <option value="MB">MB</option>
            <option value="NB">NB</option>
            <option value="NL">NL</option>
            <option value="NS">NS</option>
            <option value="ON">ON</option>
            <option value="PEI">PEI</option>
            <option value="QC">QC</option>
            <option value="SK">SK</option>
            <option value="NT">NT</option>
            <option value="NU">NU</option>
            <option value="YT">YT</option>
            </select> <br>
      


        </div>



        <div class="container">
          <h2>Payment Details</h2>




          <label for="nameoncard">Name on Card:</label>
          <input type="text" id = "nameoncard" name="nameoncard" required><br>

          <label for="cardnumber">Card Number:</label>
          <input type="tel" id = "cardnumber" name="name" pattern="[0-9\s]{13,19}" placeholder="xxxx xxxx xxxx xxxx" maxlength="19" required><br>

          <label for="securitycode">Security Code:</label>
          <input type="tel" id="securitycode" name="payment" pattern = "[0-9\s]{3,4}" maxlength = "3" required><br>

          <label for="expirydate">Expiry Date:</label>

         <select name='expireYY' id='expireYY'>
          <option value="" disabled selected>Month</option>
          <option value='1'>01</option>
          <option value='2'>02</option>
          <option value='3'>03</option>
          <option value='4'>04</option>
          <option value='5'>05</option>
          <option value='6'>06</option>
          <option value='7'>07</option>
          <option value='8'>08</option>
          <option value='9'>09</option>
          <option value='10'>10</option>
          <option value='11'>11</option>
          <option value='12'>12</option>
         </select>

        <select name='expireYY' id='expireYY'>
          <option value="" disabled selected>Year</option>
          <option value='20'>2020</option>
          <option value='21'>2021</option>
          <option value='22'>2022</option>
          <option value='23'>2023</option>
          <option value='24'>2024</option>
          <option value='25'>2025</option>
          <option value='26'>2026</option>
          <option value='27'>2027</option>
          <option value='28'>2028</option>
          <option value='29'>2029</option>
        </select>



        <br><input type="submit" name="submitbutton" value="Confirm" class="button">

     </form>
    </div>

</div>

<?php

   if(isset($_POST['submitbutton'])){

     $sql = "INSERT INTO ordered_services (user_id,service_id)
     VALUES ('{$_SESSION['user_id']}','{$_SESSION['wash']}')";

     if(mysqli_query($db,$sql)){
       echo "<script>window.location.href='wash_receipt.php';</script>";
       exit;
       }
     else{
       echo "Error: Unable to add record " .mysqli_error($db);
       echo '<br><a href="payment_page.php">Click here to try again</a>';
       }
    }

    mysqli_close($db);
   ?>

  </body>
</html>
