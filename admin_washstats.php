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
  <title>Wash Report</title>
  <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="navbar_style.css">
  <script src="jquery-3.2.1.min.js" type="text/javascript"></script>
  <script src="jquery.dataTables.min.js" type="text/javascript"></script>
  <script src="confirm.js" type="text/javascript"></script>
</head>
<body>

  <div class="topnav">
    <a href="admin_page.php">Dashboard</a>
    <a href="admin_users.php">Customers</a>
    <a href="admin_orders.php">Customer Orders</a>
    <a href="admin_washstats.php" class="active">Wash Report</a>
    <a href="admin_detailstats.php">Detail Report</a>
    <div class="topnav-right">
      <a href="logout.php" onclick="return confirm_logout();">Logout</a>
    </div>
  </div>

<h1>Wash Report</h1>

<table id="users_table" class="display" cellspacing="0" width="100%">
  <thead>
    <tr>
    <th>Wash</th>
    <th>Orders This Month</th>
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

   $query = "SELECT services.name,COUNT(ordered_services.service_id) AS NumOrders
  FROM services,ordered_services
  WHERE services.service_id = ordered_services.service_id
  AND YEAR(order_timestamp) = YEAR(CURRENT_DATE())
  AND MONTH(order_timestamp) = MONTH(CURRENT_DATE())
  AND services.service_id IN (1,2,3)
  GROUP BY services.service_id";
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
  $('#users_table').DataTable({
    "order": [[1,"desc"]]
  });
});
</script>

</body>
</html>
