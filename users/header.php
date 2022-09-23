<?php
  require 'includes/dbh.inc.php';
  require 'includes/add_to_cart.inc.php';
  require 'includes/functions.inc.php';
  $cat_res = mysqli_query($conn, "SELECT * FROM categories WHERE status=1 ");
  $cat_arr= array();
  while($row = mysqli_fetch_assoc($cat_res)){
    $cat_arr[]= $row;
  }

  $obj = new add_to_cart();
  $total_count = $obj->totalProduct();

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="icon" href="icon.ico">
    <title>TimeFlies</title>
    <link rel="stylesheet" type="text/css" href="Home_Page.css">
  </head>
  <body>
    <script type="text/javascript" src="js/main.js"></script>
    <script type="text/javascript" src="js/jquery-3.5.1.js"></script>
    <div class="head-container" id="top">
      <div class="header">
        <nav class="main_menu_navbar">
          <ul class="main_menu">
            <li class="drop"><a href="index.php" id="link">Home</a></li>
            <?php
            foreach($cat_arr as $list){
              ?>
              <li class="drop"><a href="categories_details.php?id=<?php echo $list['id']?>" id="link"><?php echo $list['categories']?></a></li>
              <?php
            }
            ?>
            <li class="drop"><a href="contact.php?error=trying" id="link">Contact</a></li>
          </ul>
        </nav>
        <div class="login-signup-logout">
         <?php 
            if(isset($_SESSION['userfirstname'])){
              echo '<div class="welcome"><h4>'.$_SESSION['userfirstname'].'</h4> 
              <form action ="includes/logout.inc.php" id="logout" method="post">
              <button type="submit" name="logout-submit" id="logout-btn">LogOut</button>
              </form><a href="my_order.php" style="margin-top: 34px;" id="my_order">My Orders</a></div>';
            }
            else if(isset($_SESSION['signed_user'])){
            //if( isset($_GET['error']) == "signup-success"  && !($_GET['error'] == "sqlRunningError") && !($_GET['error'] == "wrongPassWord")  && !($_GET['error'] == "EmailorPhnnumbererror") && !($_GET['error'] == "passwordcheck") && !($_GET['error'] == "phnNumberTaken") && !($_GET['error'] == "emailIdTaken") && !($_GET['error'] == "send-success") && !($_GET['error'] == 'trying')) {
              echo '<div class="welcome"><h4>'.$_SESSION['signed_user'].' </h4>
              <form action ="includes/logout.inc.php" id="logout" method="post">
              <button type="submit" name="logout-submit" id="logout-btn">SignOut</button>
              </form><a href="my_order.php" style="margin-top: 34px;" id="my_order">My Orders</a></div>';
            }
            else{
              echo '<div class="header-in" id="login-signup">
              <a href="#loginContainer"><button type="button" class="btn-login" id="login">LogIn</button></a>
              <h4 id="or">or</h4>
              <a href="#signupContainer"><button type="button" id="signup">SignUp</button></a></div>';
            }
          ?>
        </div>
        <div class="qty">
          <p class="total_product"><?php echo $total_count; ?></p>
        </div>
        <div class="cart">
          <a href="cart.php"><i class="fab fa-opencart"></i></a>
        </div>
      </div>
    </div>
