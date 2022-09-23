<?php
     require 'header.php';
     $id =mysqli_real_escape_string($conn, $_GET['id']);
     if($id>0){
          $sql = "SELECT product.*,categories.categories FROM product,categories WHERE product.categories_id=categories.id AND product.id ='$id'";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
     }else{
          header('Location:index.php');
          die();
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
                    <form action="includes/login.inc.php" class="login" autocomplete="off" method="post" id="formLogin">
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
<div class="product_details_container">
     <div class="Product_image">
     <img src="<?php echo "../media/product/".$row['image']; ?>">
     </div>

     <div class="Product_name">
     <h3><?php echo $row['name']; ?></h3>
     </div>
     <div class="Product_prize">
          <h4 class="old_prize">Rs.<?php echo $row['mrp']; ?></h4>
          <h4>Rs.<?php echo $row['price']; ?></h4>
     </div>

     <div class="description">
          <h5> <?php echo $row['short_desc']; ?> </h5>
     </div>

     <div class="availability">
          <h4>Availability:</h4>
          <p>In stock</p>
     </div>

     <div class="category">
          <h4>Category:</h4>
          <p><?php echo $row['categories']; ?></p>
     </div>
     <div class="quantity">
          <h4>Quantity:</h4>
          <select class="quantity_details_product" id="qty">
               <option>1</option>
               <option>2</option>
               <option>3</option>
               <option>4</option>
               <option>5</option>
               <option>6</option>
               <option>7</option>
               <option>8</option>
               <option>9</option>
               <option>10</option>
          </select>
     </div>
     <div class="Add_to_cart">
          <a href="javascript:void(0);" onclick="manage_cart('<?php echo $row['id'];?>','add')"><button type="button" class="Addtocart">Add to cart</button></a>
     </div>
     <div class="Long_description">
          <div class="description_header">
           <h4>Description</h4>
          </div>
     </div>
     <div class="description_body">
          <h5> <?php echo $row['description']; ?> </h5>
     </div>
</div>

<?php
     require 'footer.php';
?>



































<?php
  require "footer.php";
?>
