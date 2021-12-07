<?php
session_start();
if(!isset($_SESSION['email'])){
   header("Location:login.php");
 }
 ?>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="profile_style.css"></link>
  <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css"></link>
  <link rel="stylesheet" type="text/css" href="navbar_style.css">
  <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="confirm.js" type="text/javascript"></script>
  <style>
  /*using internal css to be able to overwrite the necessary jqeury styling*/
    .background {
      background: transparent url('login_img.jpg') 0 0 no-repeat fixed;
      text-align: center;
      filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='login_img.jpg', sizingMethod='scale');

      height: 100%;
      width: 100%;
      display: table;

      /* Center and scale the image nicely */
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
    }

      body,html {
        height: 100%
      }

      body {
          color: white;
          font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
          height:100%;
          width:100%;
      }

      tr {
        color:black;
      }

      th {
        color:white;
      }

      .dataTables_length {
        color:white !important;
      }

      .dataTables_filter {
        color:white !important;
      }

      .dataTables_info {
        color:white !important;
      }

      .dataTables_paginate {
        color:white !important;
      }

      .paginate_button{
        color:white !important;
      }
  </style>
  <title>Profile</title>
</head>

<body>
<div class="background">

    <div class="topnav">
      <a href="customer_profile.php" class="active">Home</a>
      <div class="topnav-right">
        <a href="logout.php" onclick="return confirm_logout();">Logout</a>
      </div>
    </div>

    <?php
    echo "<h1>"."Welcome, ".$_SESSION['firstname']."</h1>";
    ?>
  <div class="flex-parent jc-center">
    <form action="washes_page.php">
        <input type="submit" value="Buy a Wash" class="button"/>
    </form>

    <form action="details_page.php">
        <input type="submit" value="Book a Detail" class="button"/>
    </form>
  </div>

  <br>
  <br>
  <h1>Your Past Orders</h1>

  <table id="your_orders_table" class="display" cellspacing="0" width="100%">
    <thead>
      <tr>
      <th>Service Name</th>
      <th>Price</th>
      <th>Order Date</th>
      <th>Service Date</th>
      </tr>
    </thead>
  <tbody>

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

   $query = "SELECT services.name,services.price,order_timestamp,service_date
   FROM services,ordered_services,users
   WHERE services.service_id = ordered_services.service_id
   AND users.user_id=ordered_services.user_id
   AND users.user_id = '{$_SESSION['user_id']}'";

   $result = mysqli_query($db,$query);


   while($row = mysqli_fetch_row($result)) {
     echo "<tr>";
     foreach($row as $cell)
       echo "<td>$cell</td>";
       echo "</tr>\n";
   };
   $db->close();
   ?>
  </tbody>
  </table>

  <script>
  $(document).ready(function(){
    $('#your_orders_table').DataTable({
      "order": [[2,"desc"]]
    });
  });
  </script>

</div>
  </body>
  </html>
