<?php
function pr($arr){
     echo '<pre>';
     print_r($arr);
}
function prx($arr){
     echo '<pre>';
     print_r($arr);
     die();
} 
function get_product($conn,$limit='',$cat_id=''){
     $sql="SELECT * FROM product WHERE status=1 ";
     if($cat_id!=''){
          $sql.=" AND categories_id='$cat_id' ";
     }
     $sql.=" ORDER BY id DESC ";
     if($limit!=''){
          $sql.=" LIMIT $limit";
     }
     
     $result=mysqli_query($conn,$sql);
     $data=array();
     while($row=mysqli_fetch_assoc($result)){
          $data[] = $row;
     }
     return $data;
}
function get_product_from_cart($conn,$product_id){
     $sql="SELECT product.*,categories.categories FROM product,categories WHERE product.status=1";
     if($product_id!=''){
          $sql.=" AND product.id=$product_id";
     }
     $sql.=" AND product.categories_id=categories.id";
     $sql.=" ORDER BY product.id DESC";
     $result=mysqli_query($conn,$sql);
     $data=array();
     while($row=mysqli_fetch_assoc($result)){
          $data[] = $row;
     }
     return $data;
}
function get_safe_value($conn,$str){
     if($str!=''){
          $str=trim($str);
          return mysqli_real_escape_string($conn,$str);
     }
}
?>