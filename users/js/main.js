function manage_cart(pid,type){
     if(type=="update"){
          var qty =jQuery("#"+pid+"qty").val();
     }else{
          var qty =jQuery("#qty").val();
     }
     jQuery.ajax({
          url:'manage_cart.php',
          type:'post',
          data: 'pid='+pid+'&qty='+qty+'&type='+type,
          success:function(result){
               if(type=='update' || type=='remove'){
                    window.location.href='cart.php';
               }
              jQuery('.total_product').html(result); 
          }
     });
}