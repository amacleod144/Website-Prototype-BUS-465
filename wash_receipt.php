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
  <title>Wash Receipt</title>
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
      <a href="wash_receipt.php" class="active">Receipt</a>
      <div class="topnav-right">
        <a href="logout.php" onclick="return confirm_logout();">Logout</a>
      </div>
    </div>

    <h1>Wash Receipt</h1>
  <div class="container">
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

        $query = "SELECT * FROM services WHERE service_id = '{$_SESSION['wash']}'";

        $result = mysqli_query($db,$query);

        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $price = $row['price'];


        echo "Thank you for purchasing a ".$name."!";
        echo "<br>A copy of your receipt with your wash code has been sent to ".$_SESSION['email'].".";
        echo "<br>Your total of $".$price." has been processed.";
        echo "<br>You may redeem your wash anytime during our regular business hours using the wash code.";

        $db->close();

      ?>

    </div>
  </div>

</body>
</html>
