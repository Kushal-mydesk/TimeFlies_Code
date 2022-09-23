<?php

if (isset($_POST['login-submit'])) {
  
  require 'dbh.inc.php';

  $mailphnid = $_POST['mailphnid'];
  $password = $_POST['pwd'];

  if(empty($mailphnid) || empty($password)){
     header("Location: ../index.php?error=emptyfields");
     exit();
  }
  else {
     $spl = "SELECT * FROM users WHERE phnUsers=? OR emailUsers=?;";
     $stmt = mysqli_stmt_init($conn);
     if(!mysqli_stmt_prepare($stmt, $spl)){
          header("Location: ../index.php?error=sqlrunningError");
          exit();
     }
     else{
          mysqli_stmt_bind_param($stmt,"is",$mailphnid,$mailphnid);
          mysqli_stmt_execute($stmt);
          $resultCheck = mysqli_stmt_get_result($stmt);
          if ($row = mysqli_fetch_assoc($resultCheck)) {
             $pwdcheck = password_verify($password, $row['pwdUsers']); 
             if($pwdcheck == false){
               header("Location: ../index.php?error=wrongPassWord");
               exit();
             } 
              else if($pwdcheck == true){
                    session_start();
                    $_SESSION['userID'] = $row['id'];
                    $_SESSION['userfirstname']=  $row['firstNameUsers'];
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
               } 
               else{
                    header("Location: ../index.php?error=wrongPassWord");
                    exit();
               }
          }
          else{
               header("Location: ../index.php?error=EmailorPhnnumbererror");
               exit();
          }
     }
  }
  header('Location: ../index.php?error=couldnotlogin');
  exit();
}
else{
     header('Location: ../index.php?error=couldnotlogin');
     exit();
   
}
