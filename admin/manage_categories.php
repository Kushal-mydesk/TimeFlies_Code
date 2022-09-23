<?php
     require 'includes/header.inc.php';
     $categories = '';
     $msg='';
     if(isset($_GET['id']) && $_GET['id']!=''){
          $id = get_safe_value($conn,$_GET['id']);
          $result = mysqli_query($conn,"SELECT * from categories where id ='$id'");
          $check = mysqli_num_rows($result);
          if($check>0){
               $row = mysqli_fetch_assoc($result);
               $categories =   $row['categories'];
          }else{
               header("Location:admin_panel.php");
               die();
          }
     }
     if(isset($_POST['submit'])){
          $categories = get_safe_value($conn,$_POST['categories']);
          $result = mysqli_query($conn,"SELECT * from categories where categories ='$categories'");
          $check = mysqli_num_rows($result);
          if($check>0){
               if(isset($_GET['id']) && $_GET['id']!=''){
                    $getData=mysqli_fetch_assoc($result);{
                         if($id==$getData['id']){

                         }else{
                              $msg="Categorie Already Exists.";   
                         }
                    } 
               }else{
                    $msg="Categorie Already Exists."; 
               }
          }

          if($msg==""){
               if(isset($_GET['id']) && $_GET['id']!=''){
                    $sql = "UPDATE categories SET categories='$categories' WHERE id='$id'";
                    mysqli_query($conn,$sql);
               }else{
                    $sql="INSERT into categories(categories,status) values('$categories','1')";
                    mysqli_query($conn,$sql);
               }
               header("Location:admin_panel.php");
               die();
          }
     } 

   
?>
<div class="content pb-0">
     <div class="animated fadeIn">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                    <div class="card-header"><strong>Categories</strong><small> Form</small></div>
                    <form action="" method="post">
                    <div class="card-body card-block">
                    <div class="form-group">
                         <label for="categories" class=" form-control-label">Categories</label>
                         <input type="text" name="categories" placeholder="Enter Category name" class="form-control" value="<?php echo $categories ?>" required>
                    </div>
                    <button type="submit" class="btn btn-lg btn-info btn-block" name="submit">
                         <span id="payment-button-amount" >Submit</span>
                    </button>
                    <div class="field_error"><?php echo $msg ?></div>
                    </div>
                    </form>
                    </div>
               </div> 
          </div>
     </div>
</div>


<?php
     require 'includes/footer.inc.php';
?>