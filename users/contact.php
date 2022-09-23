<?php
     require 'header.php';
     if (isset($_POST['send_submit'])) {
          $name = $_POST['name'];
          $email = $_POST['email'];
          $mobile = $_POST['mobile'];
          $query = $_POST['query'];
          date_default_timezone_set('Asia/Kolkata');
          $added_on=date('Y-m-d H:i:s');
          $sql="INSERT INTO contact_us (name, email, mobile, comment, added_on) VALUES ('$name', '$email', '$mobile', '$query', '$added_on')";
          $stmt = mysqli_stmt_init($conn);
          if(!mysqli_stmt_prepare($stmt, $sql)){
               header("Location: ../index.php?error=sqlInsertError");
               exit();
          }
          else{
               mysqli_stmt_execute($stmt);
               header("Location:contact.php?error=send-success");
               exit();
          }
          mysqli_stmt_close($stmt);
          mysqli_close($conn); 
     }
?>

<div class="banner">
</div>

<?php
     if($_GET['error']== 'trying'){
          echo '
          <div class="tag">
               <h3>Are you trying to reach us?</hh3>
          </div>
          ';
     }
     else if($_GET['error']== 'send-success'){
          echo '
          <div class="tag">
               <h3>Thanks For Contacting us!</h3>
          </div>
          ';
     }
?>
<div class="contact_form_container">
<Form method="post" class="form_contact"> 
     <div class="Contact_name">  
          <input class="contact_name" type="text" name="name" placeholder="Name" required>  
     </div>
     <div class="Contact_email">  
          <input class="contact_email" type="email" name="email" placeholder="Email" required>  
     </div>
     <div class="Contact_mobile">  
          <input class="contact_mobile" type="text" name="mobile" placeholder="Mobile" required>  
     </div>
     <div class="Contact_query">  
         <textarea class="contact_query" cols="157" rows="15" type="text" name="query"    placeholder="Enter Your Query Here" required></textarea>
     </div>
     <div class="Send_m">
          <a href=""><button type="submit" name="send_submit"  class="send">Send Message</button></a>
     </div>

</Form>
</div>

<?php
     require 'footer.php';
?>