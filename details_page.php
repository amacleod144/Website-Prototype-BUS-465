<?php
  session_start();

  if(!isset($_SESSION['email'])||(!isset($_SESSION['user_id']))){
     header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Details</title>
    <link href="details_style.css" rel="stylesheet" type="text/css"/>
    <link href="navbar_style.css" rel="stylesheet" type="text/css"/>
    <script src="date_functions.js"></script>
    <script src="input_ver.js"></script>
    <script src="confirm.js" type="text/javascript"></script>
  </head>

  <body>
    <div class="background">
      <div class="topnav">
        <a href="customer_profile.php">Home</a>
        <a href="washes_page.php">Washes</a>
        <a href="details_page.php" class="active">Details</a>
        <div class="topnav-right">
          <a href="logout.php" onclick="return confirm_logout();">Logout</a>
        </div>
      </div>
    <div class="title">
    <h1>DETAILS</h1>
    </div>
    <div class="container">
        <p> These are the detail packages we offer. Once you pick one, select it in the form below and book a day. Once confirmed, our detail manager will contact you.</p>
        <p>Due to capacity we can only accomodate one detail per day. Please call ahead by 24 hours to cancel.</p>
    </div>
          <div class="box" id="interior">
            <h3>Interior - $150</h3>
            <p>Full interior cleaning including shampoo deep clean and upholstery polish. Approximate length 3 hours.</p>
          </div>
          <div class="box" id="exterior">
            <h3>Exterior - $150</h3>
            <p>Full exterior service, including clay-bar, hand-wax, wheel-shine. Approximate length 3 hours.</p>
          </div>
          <div class="box" id="fullcar">
            <h3>Full - $250</h3>
            <p>Full detail including all interior and exterior services. 50% off wash coupon included. Approximate length 5 hours.</p>
          </div>
      <div class="submission">

      <form action="details_page.php" method="POST" onsubmit="return validateDetail();">
        <label for="detail">Choose your detail:</label>
        <select id="detail" name="detail">
          <option value="0" disabled selected> -- select an option -- </option>
          <option value="4">Interior</option>
          <option value="5">Exterior</option>
          <option value="6">Full</option>
        </select><br>
        <label for="booking">Choose your date:</label>
        <input type="date" id="booking" name="booking"><br>
        <input type="submit" value="Book Detail" class="button" name="submitbutton">
      </div>
    </div>

  <script>
  setMinBooking();
  </script>

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


              $booking = strtotime($_POST["booking"]);
              $booking = date('Y-m-d',$booking);
              $detail = $_POST["detail"];


              $sql1= "SELECT * FROM ordered_services WHERE
              service_date = '" .$booking. "'";

              $sql2="INSERT INTO ordered_services
              (user_id,service_id,service_date)
              VALUES ('{$_SESSION['user_id']}','$detail','$booking')";

              $result = mysqli_query($db,$sql1);

              if(mysqli_num_rows($result)==0) {

                 if(mysqli_query($db,$sql2)){
                   $_SESSION["detail"] = $detail; //will take them to receipt page
                   $_SESSION["booking"] = $booking;
                   header("Location:detail_receipt.php");
                   }
                 else{
                   echo "Error: Unable to add record " .mysqli_error($db);
                   echo '<br><a href="details_page.html">Click here to try again</a>';
                   }
             }
              else {
                // Display the alert box
                echo "<script language='javascript'>";
                echo "alert('Sorry that date is booked')";
                echo "</script>";

              }

              mysqli_close($db);
     }

  ?>

  </body>
</html>
