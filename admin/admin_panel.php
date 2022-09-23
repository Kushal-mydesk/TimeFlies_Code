<?php
     require 'includes/header.inc.php';
     if(isset($_GET['type']) && $_GET['type']!=''){
          $type = get_safe_value($conn,$_GET['type']);
          if($type=='status'){
               $operation=get_safe_value($conn,$_GET['operation']); 
               $id=get_safe_value($conn,$_GET['id']);
               if($operation == 'active'){
                    $status = '1';
               }else{
                    $status = '0';
               }
               $update_sql="UPDATE categories set status='$status' where id='$id'";
               mysqli_query($conn,$update_sql);
          }
          if($type=='delete'){
               $id=get_safe_value($conn,$_GET['id']);
               $delete_sql="DELETE FROM categories where id='$id'";
               mysqli_query($conn,$delete_sql);
          }
     }
     $sql = "SELECT * FROM categories ORDER BY id ASC ";
     $result = mysqli_query($conn, $sql);
?>



<div class="content pb-0">
     <div class="orders">
          <div class="row">
               <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Categories </h4>
                           <h4 class="box-link"><a href="manage_categories.php">Add Categories</a></h4> 
                        </div>
                        <div class="card-body--">
                              <div class="table-stats order-table ov-h">
                                   <table class="table ">
                                        <thead>
                                             <tr>
                                               <th>ID</th>
                                               <th>Catogories</th>
                                               <th>Manage</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                             <tr>
                                               <td><?php echo $row['id']; ?></td>
                                               <td><?php echo $row['categories']; ?></td>
                                               <td><?php 
                                                  if($row['status'] == 1) {
                                                       echo "<a href='?type=status&operation=deactive&id=".$row['id']."'>Deactive</a>&nbsp";
                                                  }else{
                                                       echo "<a href='?type=status&operation=active&id=".$row['id']."'>Active</a>&nbsp";
                                                  } 
                                                  echo "<a href='manage_categories.php?id=".$row['id']."'>Edit</a>&nbsp";
                                                  echo "<a href='?type=delete&id=".$row['id']."'>Delete</a>";
                                                  
                                               ?></td>
                                             </tr>
                                        <?php } ?>
                                        </tbody>
                                   </table>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>


<?php     
     require 'includes/footer.inc.php';
?>     