<?php
 require "header.php";

 ?>

    <div class="full_container">
      <div class="slider-frame">
        <div class="slide-images">
          <div class="img-container">
            <img src="Images\For background (1).jpg" width="1730px"  height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (2).jpg" width="1730px" height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (3).jpg" width="1730px" height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (4).jpg" width="1730px" height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (5).jpg" width="1730px" height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (6).jpg" width="1730px" height="1000px" alt="">
          </div>
          <div class="img-container">
            <img src="Images\For background (7).jpg" width="1730px" height="1000px" alt="">
          </div>
        </div>
      </div>
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
                <button type="submit" name="signup-submit" id="signup-final" class="final-signup-btn" >Sign Up</button>
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
      <!--Start of the Box Portions-->
      <div class="box-container">
        <div class="container">
          <div class="box">
            <div class="content">
              <h3>For Him</h3>
              <p>WE care about him
              </p>
              <a href="categories_details.php?id=7">Watch</a>
            </div>
          </div>
          <div class="box">
            <div class="content">
              <h3>For Her</h3>
              <p>WE care about her
              </p>
              <a href="categories_details.php?id=8">Watch</a>
            </div>
          </div>
          <div class="box">
            <div class="content">
              <h3>For All</h3>
              <p>WE care about all
              </p>
              <a href="categories_details.php?id=13">Watch</a>
            </div>
          </div>
        </div>
      </div>
      <!--End of the Boxes portion-->
    </div>
    <!--End of the Full Container portion-->
    <!--Start of the New Arrivals portion-->
 
    <div class="container-2">
      <h2 style="opacity: 0.6;">New Arrivals</h2>
      <div class="flex-box-container-2" id="flex-pic-gen">
        <?php 
          $get_product=get_product($conn,8);
          foreach($get_product as $list){
        ?>
        <!--Start of the single New Arrivals portion-->
        <div class="product_main">
          <div class="product_thumb">
            <a href="product_details.php?id=<?php echo $list['id']?>">
              <img src="<?php echo "../media/product/".$list['image']; ?>" alt="product images" class="">
            </a>
          </div>
          <div class="product_inner">
            <h4><a href="product_details.php?id=<?php echo $list['id']?>"><?php echo $list['name']; ?></a></h4>
            <ul class="product_prize">
              <li class="old_prize"><?php echo "Rs.".$list['mrp']; ?></li>
              <li><?php echo "Rs.".$list['price']; ?></li>
            </ul>
          </div>
        </div>
        <?php } ?>   
        <!--End of the single New Arrivals portion-->
      </div>
    </div>
    <!--End of the New Arrivals portion-->
   
  <?php
  require "footer.php";
   ?>
