<?php
     require 'header.php';
     $cart_total = 0;
      foreach($_SESSION['cart'] as $key=>$val){
            $productARR = get_product_from_cart($conn,$key);
            $price = $productARR[0]['price'];
            $qty = $val['qty'];
            $cart_total = $cart_total+($price * $qty);
       } 
    if(isset($_POST['submit'])){
      $address = get_safe_value($conn,$_POST['address']);
      $landmark = get_safe_value($conn,$_POST['landmark']);
      $city = get_safe_value($conn,$_POST['city_state']);
      $pincode = get_safe_value($conn,$_POST['pincode']);
      $payment_type = get_safe_value($conn,$_POST['payment_type']);
      $payment_status = 'pending';
      $user_id= $_SESSION['userID'];
      $total_price = $cart_total;
        if($payment_type == 'COD'){
            $payment_status = 'pending';
          }
      $order_status = 'pending';
      date_default_timezone_set('Asia/Kolkata');
      $added_on=date('Y-m-d H:i:s');
      
      $sql = "INSERT INTO `order`(`users_id`, `address`, `landmark`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES ('$user_id', '$address', '$landmark', '$city', '$pincode', '$payment_type','$total_price','$payment_status','$order_status', '$added_on')";
      mysqli_query($conn,$sql);

      $order_id= mysqli_insert_id($conn);
      foreach($_SESSION['cart'] as $key=>$val){
        $productARR = get_product_from_cart($conn,$key);
        $price = $productARR[0]['price'];
        $qty = $val['qty'];
        $cart_total = $cart_total+($price * $qty);
        $order_sql = "INSERT INTO `order_detail`(`order_id`, `product_id`, `order_qty`, `price`) VALUES ('$order_id', '$key', '$qty', '$price')";
        mysqli_query($conn,$order_sql);
     }
     
     
     $_SESSION['order'] = 'success';
     header("Location:thank_you.php");
     unset($_SESSION['cart']);
    }
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
  if(!isset($_SESSION['userfirstname'])){
      if(!isset($_SESSION['signed_user'])){
            echo '<div class="procedural">
                      <p>In Order To proceed you need to <strong>login</strong> <b>or</b> <strong>signup</strong> <img src="arrow.png"/></p>
                  </div>';
       }else{
        echo '<form class="form_Checkout" action="" method="post">
                    <div class="Address_information">
                        <input class="checkout_inputs" type="text" name="address"  placeholder="Address">
                        <input  class="checkout_inputs" type="text"  name="landmark"  placeholder="Landmark">
                        <input  class="checkout_inputs" type="text"  name="city_state"  placeholder="city/state">
                        <input  class="checkout_inputs" type="text"  name="pincode"  placeholder="Post code/Zip">
                    </div>
                    <div class="Payment_information">
                          COD<input type="radio" name="payment_type" value="COD" required>
                          Credit or Debit Card<input type="radio" name="payment_type" value="credit_debit" required>
                    </div>
                    <button type="submit" name="submit" class="proceed">Proceed</button>
                </form>
              ';
            }
   }else{
    echo '
    <form class="form_Checkout"  action="" method="post">
    <div class="Address_information">
      <input class="checkout_inputs" type="text" name="address"  placeholder="Address">
      <input  class="checkout_inputs" type="text"  name="landmark"  placeholder="Landmark">
      <input  class="checkout_inputs" type="text"  name="city_state"  placeholder="city/state">
      <input  class="checkout_inputs" type="text"  name="pincode"  placeholder="Post code/Zip">
    </div>
    <div class="Payment_information">
          COD<input type="radio" name="payment_type" value="COD" required>
          Credit or Debit Card<input type="radio" name="payment_type" value="credit_debit" required>
    </div>
    <button type="submit" name="submit" class="proceed">Proceed</button>
   </form>
          ';
   }?>

   
<div class="order_details">
    <h2>YOUR ORDER</h2>
    <?php
      if(isset($_SESSION['cart'])){
    ?>
    <div class="cart_details">
       <?php
          $cart_total = 0;
          foreach($_SESSION['cart'] as $key=>$val){
            $productARR = get_product_from_cart($conn,$key);
            $pname = $productARR[0]['name'];
            $mrp = $productARR[0]['mrp'];
            $price = $productARR[0]['price'];
            $image = $productARR[0]['image'];
            $qty = $val['qty'];
            $cart_total = $cart_total+($price * $qty);
            $subtotal = $price * $qty;
        ?>    
      <div class="products">
        <div class="pro_img">
          <img src="<?php echo '../media/product/'.$image?>" height="140px" width="100px" alt="">
        </div>
        <div class="pro_name">
          <p><?php echo $pname ?></p>
        </div>
        <div class="pro_price">
          <p><?php echo "Rs.".$subtotal ?></p>
        </div>
      </div>
      <?php } ?>
    </div>
    <div class="price_details">
        <p><strong>Order Total</strong></p>
        <p><?php echo "Rs.".$cart_total ?></p>
    </div>
</div>
<?php } else {
     echo ' <div class="Existance_Error">
               <h2 style="opacity: 0.6;">Your Cart is Empty</h2>
               <a href="index.php"><button type="button" class="continue">Continue Shopping</button></a>
            </div>';
} ?>


<div class="Checkout_footer">
  <?php
    require 'footer.php';
  ?>
</div>