<?php
session_start();
if(!isset($_SESSION['email'])){
   header("Location:login.php");
 }
 ?>
 <!DOCTYPE html>
 <html>
   <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Washes</title>
     <link href="washes_style.css" rel="stylesheet" type="text/css"/>
     <link href="navbar_style.css" rel="stylesheet" type="text/css"/>
     <script src="input_ver.js"></script>
     <script src="confirm.js"></script>
   </head>
   <body>
     <div class="background">

      <div class="topnav">
         <a href="customer_profile.php">Home</a>
         <a href="washes_page.php" class="active">Washes</a>
         <a href="details_page.php">Details</a>
         <div class="topnav-right">
           <a href="logout.php" onclick="return confirm_logout();">Logout</a>
         </div>
       </div>

     <div class="title">
     <h1>WASHES</h1>
     </div>
     <div class="message">
       <p> Please select one of the following washes. All washes include a free hand pre-wash within attendant hours. After pressing buy, you will be directed to our payment portal after which you can redeem your wash anytime during our regular business hours. </p>
      </div>

         <div class="box" id="gold">
           <h3>Gold - $16</h3>
           <p>Our classic hand pre-wash and premium machine wash, no wax or add-ons but guaranteed quality.</p>
         </div>

         <div class="box" id="diamond">
           <h3>Diamond - $18</h3>
           <p>Our signature wash includes RainGuard protectant wax to keep your car shiny and streak-free for longer.</p>
         </div>

         <div class="box" id="platinum">
           <h3>Platinum - $21</h3>
           <p>Our top wash comes with extra rinse, premium Carnauba wax, and wheel shine for a smooth finish</p>
         </div>

         <div class="submission">
           <form action="washes_page.php" method="POST" onsubmit="return validateWash();">
             <label for="wash">Choose your wash:</label>
             <select id="wash" name="wash">
               <option value="0" disabled selected> -- select an option -- </option>
               <option value="1">Gold</option>
               <option value="2">Diamond</option>
               <option value="3">Platinum</option>
             </select><br>
             <input type="submit" value="Buy Wash" class="button" name="submitbutton">
       </div>

   <?php
     if(isset($_POST['submitbutton'])){
       $_SESSION['wash'] = $_POST['wash'];
       header("Location: https://datalab3.bus.sfu.ca/awmacleo/Project/payment_page.php");
     }
     ?>

   </body>
 </html>
