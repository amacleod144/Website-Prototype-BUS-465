<?php
  session_start();

    if(!isset($_SESSION['email'])){
       header("Location:login.php");
}
 ?>
<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Detail Receipt</title>
  <link href="navbar_style.css" rel="stylesheet" type="text/css"/>
  <link href="receipt_style.css" rel="stylesheet" type="text/css"/>
  <script src="confirm.js" type="text/javascript"></script>
</head>
<body>
<div class="background">
    <div class="topnav">
      <a href="customer_profile.php">Home</a>
      <a href="washes_page.php">Washes</a>
      <a href="details_page.php">Details</a>
      <a href="detail_receipt.php" class="active">Receipt</a>
      <div class="topnav-right">
        <a href="logout.php" onclick="return confirm_logout();">Logout</a>
      </div>
    </div>

    <h1>Detail Receipt</h1>
    <div class="container"/>
      <?php
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

        $query = "SELECT * FROM services WHERE service_id = '{$_SESSION['detail']}'";

        $result = mysqli_query($db,$query);

        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];


        echo "Thank you for booking ".$name." for ".$_SESSION['booking'].".";
        echo "<br>Our detail manager will be in touch with you at ".$_SESSION['email']." to arrange the dropoff and pickup times.";
        echo "<br>Your total will be $".$price." payable at time of pickup.";
        echo "<br>If you need to cancel or alter your booking, please contact us at admin@cartoons.ca or 604-555-2452.";

        $db->close();

      ?>
    </div>
  </div>
