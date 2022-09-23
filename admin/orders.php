<?php
     require 'includes/header.inc.php';
     if(isset($_GET['type']) && $_GET['type']!=''){
          $type = get_safe_value($conn,$_GET['type']);
          if($type=='status'){
               $operation=get_safe_value($conn,$_GET['operation']); 
               $id=get_safe_value($conn,$_GET['id']);
               if($operation == 'marked'){
                    $order_status = 'marked';
               }else{
                    $order_status = 'pending';
               }
               $update_sql="UPDATE `order` set order_status='$order_status' where id='$id'";
               mysqli_query($conn,$update_sql);
          }
          if($type=='delete'){
               $id=get_safe_value($conn,$_GET['id']);
               $delete_sql="DELETE FROM `order` where id='$id'";
               mysqli_query($conn,$delete_sql);
          }
     }
     $sql = "SELECT * FROM `order` ORDER BY id ASC ";
     $result = mysqli_query($conn, $sql);
?>



<div class="content pb-0">
     <div class="orders">
          <div class="row">
               <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                           <h4 class="box-title">Orders </h4>
                          
                        </div>
                        <div class="card-body--">
                              <div class="table-stats order-table ov-h">
                                   <table class="table ">
                                        <thead>
                                             <tr>
                                               <th>ID</th>
                                               <th>User_id</th>
                                               <th>Address</th>
                                               <th>Payment Type</th>
                                               <th>Total Price</th>
                                               <th>Payment Status</th>
                                               <th>Order Status</th>
                                               <th>Date Added On</th>
                                               <th>Manage</th>
                                             </tr>
                                        </thead>
                                        <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                                             <tr>
                                               <td><?php echo $row['id']; ?></td>
                                               <td><?php echo $row['users_id']; ?></td>
                                               <td><?php echo $row['address']; ?>
                                                   /<?php echo $row['city']; ?>
                                                   /<?php echo $row['pincode']; ?>
                                               </td>
                                               <td><?php echo $row['payment_type']; ?></td>
                                               <td><?php echo $row['total_price']; ?></td>
                                               <td><?php echo $row['payment_status']; ?></td>
                                               <td><?php echo $row['order_status']; ?></td>
                                               <td><?php echo $row['added_on']; ?></td>
                                               <td><?php 
                                                  if($row['order_status'] == 'pending') {
                                                       echo "<a href='?type=status&operation=marked&id=".$row['id']."'>Mark as Done</a>&nbsp";
                                                  }else{
                                                       echo "<a href='?type=status&operation=pending&id=".$row['id']."'>Mark as Pending</a>&nbsp";
                                                  } 
                                                  
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