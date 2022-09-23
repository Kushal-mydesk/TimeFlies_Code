<?php
     require 'header.php';
?>


<!--Start of the Sign Up portion-->
 <div class="signup-container" id="signupContainer">
        <div class="popup-signup">
         <div class="popup-content">
            <img src="https://img.icons8.com/ios/50/000000/close-window.png" alt="Close" class="signup-close">
            <h4>Create A New Account</h4>
            <?php
              if (isset($_GET['error'])){
                if ($_GET['error'] == "passwordcheck"){
                  echo '<script>alert("The passwords are incorrect!")</script>';
                }
                elseif($_GET['error'] == "phnNumberTaken"){
                  echo '<script>alert("This Phone Number has already been taken!")</script>';
                }
                elseif($_GET['error'] == "emailIdTaken"){
                  echo '<script>alert("This Email Id has already been taken!")</script>';
                }
              }
            ?>
            <form action="includes/signup.inc.php" method="post" class="signup" autocomplete="off" id="formSignup">
                <div class="username">
                  <input type="text" name="first-name" id="person-first-name" placeholder="First Name" required>
                </div>
                <div class="username">
                  <input type="text" name="last-name" id="person-last-name" placeholder="Last Name" required>
                </div>
                <div class="mobilenumber">
                  <input type="text" name="phn" id="signing-mobile-number" placeholder="Enter Mobile Number" required>
                </div>
                <div class="email">
                  <input type="email" name="email" id="signing-user-name" placeholder="Enter Your Email" required>
                </div>
                <div class="password">
                  <input type="password" name="pwd" id="signing-password" placeholder="Password" required>
                </div>
                <div class="password">
                  <input type="password" name="pwd-repeat" id="signing-password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" name="signup-submit" id="signup-final" class="final-signup-btn" onclick="getSignup">Sign Up</button>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        document.getElementById("signup").addEventListener("click", function(){
          document.querySelector(".popup-signup").style.visibility = "visible";
        })
        document.querySelector(".signup-close").addEventListener("click", function(){
          document.querySelector(".popup-signup").style.visibility = "hidden";
        })
      </script>
<!--End of the Signup Form-->
<!--Coding part of the login Container-->
      <div class="login-container" id="loginContainer">
        <div class="popup-login">
         <div class="popup-content">
            <img src="https://img.icons8.com/ios/50/000000/close-window.png" alt="Close" class="login-close">
            <h4>Get Yourself In</h4>
            <?php
              if (isset($_GET['error'])){
                if ($_GET['error'] == "EmailorPhnnumbererror"){
                  echo '<script>alert("Wrong Email or Phone Number!")</script>';
                }
                elseif($_GET['error'] == "wrongPassWord"){
                  echo '<script>alert("Wrong Password!")</script>';
                }
              }
            ?>
            <form action="includes/login.inc.php" class="login" autocomplete="off" method="post">
                <div class="username">
                  <i class="fas fa-user"></i>
                  <i class="fas fa-close"></i>
                  <input type="text" name="mailphnid" id="login-username" placeholder="Enter Email or Mobile Number" required>
                </div>
                <div class="password">
                  <i class="fas fa-lock"></i>
                  <input type="password" name="pwd" id="login-password" placeholder="Password" required>
                </div>
                <button type="submit" name="login-submit" id="login-final" class="final-login-btn">Log In</button>
            </form>
          </div>
        </div>
      </div>
      <script type="text/javascript">
        document.getElementById("login").addEventListener("click", function(){
          document.querySelector(".popup-login").style.visibility = "visible";
        })
        document.querySelector(".login-close").addEventListener("click", function(){
          document.querySelector(".popup-login").style.visibility = "hidden";
        })
      </script>
<!--End of the Login portion-->
<div class="banner">
</div>
  <?php
   if(isset($_SESSION['order'])){

  ?>
  <div class="cart_container">
      <table class="cart_table">     
        <thead>
          <tr>
            <th style="width:300px">Order_ID</th>
            <th style="width:300px">Order Date</th>
            <th style="width:200px">Address</th>
            <th style="width:300px">Payment Type</th>
            <th style="width:200px">Payment Status</th>
            <th style="width:300px">Order Status</th>
          </tr> 
        </thead>
      
        <tbody> 
          <?php
            $uid = '';
            if(!isset($_SESSION['userID'])){
              if(isset($_SESSION['new_user'])){
                $uid= $_SESSION['new_user'];
              }
            }else{
              $uid= $_SESSION['userID'];
            
            }
            
            $sql = "SELECT * FROM `order` WHERE users_id='$uid'";
            $res = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($res)){
          ?>    
          <tr class="product_details">
            <td style="width:300px" class="table_data" ><a  href="my_order_detail.php?id=<?php echo $row['id'] ?>">Click to see details-><?php echo $row['id'] ?></a></td>
            <td style="width:300px" class="table_data"><?php echo $row['added_on'] ?></td>
            <td style="width:200px" class="table_data"><?php echo $row['address'] ?>/<?php echo $row['city'] ?>/<?php echo $row['pincode'] ?></td>
            <td style="width:200px" class="table_data"><?php echo $row['payment_type'] ?></td>
            <td style="width:300px" class="table_data"><?php echo $row['payment_status'] ?></td>
            <td style="width:300px" class="table_data"><?php echo $row['order_status'] ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table> 
  </div>

  <!--<div class="button_container">
        <a href="index.php"><button type="button" class="continue">Continue Shopping</button></a>
        <a href="checkout.php"><button type="button" class="checkout">CheckOut</button></a>
  </div>-->
  <?php } else {
     echo ' <div class="cart_empty">
      <div class="Existance_Error">
         <h2 style="opacity: 0.6;">No Orders Yet!</h2>
         <a href="index.php"><button type="button" class="continue">Continue Shopping</button></a>
      </div>
    </div> ';
  } ?>

<div class="Checkout_footer">
  <?php
    require 'footer.php';
  ?>
</div>