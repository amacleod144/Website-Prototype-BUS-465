<?php
  session_start();

  if(!isset($_SESSION['email'])||($_SESSION['role'] != 1)){
     header("Location:admin_login.php");
}
?>

<html>
<head>
  <meta charset="utf-8" >
  <meta name="viewport" content="width=device-width">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" type="text/css" href="profile_style.css">
  <link rel="stylesheet" type="text/css" href="navbar_style.css">
  <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
  <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="confirm.js" type="text/javascript"></script>
</head>
<body>

  <div class="topnav">
    <a href="admin_page.php" class="active">Dashboard</a>
    <div class="topnav-right">
      <a href="logout.php" onclick="return confirm_logout();">Logout</a>
    </div>
  </div>

<h1>Admin Dashboard</h1>
<div class="flex-parent jc-center">
  <form action="admin_users.php">
      <input type="submit" value="Customers" class="button"/>
  </form>

  <form action="admin_orders.php">
      <input type="submit" value="Customer Orders" class="button"/>
  </form>

  <form action="admin_washstats.php">
      <input type="submit" value="Wash Report" class="button"/>
  </form>

  <form action="admin_detailstats.php">
      <input type="submit" value="Detail Report" class="button"/>
  </form>
</div>

<br>
<br>
<h1>Latest Orders</h1>

<table id="recent_orders_table" class="display" cellspacing="0" width="100%">
  <thead>
    <th>Service Name</th>
    <th>Price</th>
    <th>Service Date</th>
    <th>Order Timestamp</th>
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

 $query = "SELECT services.name,services.price,service_date,order_timestamp
 FROM services,ordered_services,users
 WHERE services.service_id = ordered_services.service_id
 AND users.user_id=ordered_services.user_id";

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
  $('#recent_orders_table').DataTable({
    "order": [[3, "desc"]]
  });
});
</script>

</body>
</html>
