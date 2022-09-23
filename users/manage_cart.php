<?php
     require 'includes/dbh.inc.php';
     require 'includes/add_to_cart.inc.php';
     require 'includes/functions.inc.php';
     $pid = get_safe_value($conn,$_POST['pid']);
     $qty = get_safe_value($conn,$_POST['qty']);
     $type =  get_safe_value($conn,$_POST['type']);

     $obj = new add_to_cart();

     if($type == 'add'){
          $obj->addProduct($pid,$qty);
     }
     if($type == 'update'){
          $obj->updateProduct($pid,$qty);
     }
     if($type == 'remove'){
          $obj->removeProduct($pid,$qty);
     }

     echo $obj->totalProduct();
?>