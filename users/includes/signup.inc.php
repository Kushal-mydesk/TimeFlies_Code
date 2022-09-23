<?php
if(isset($_POST['signup-submit'])){  
    require 'dbh.inc.php'; 
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $userphn = $_POST['phn'];
    $email = $_POST['email'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];
    date_default_timezone_set('Asia/Kolkata');
    $added_on=date('Y-m-d H:i:s');

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location:". $_SERVER['HTTP_REFERER']."?error=invalidmail"); 
        exit();
    }
    else if ($password != $passwordRepeat) {
        header("Location:". $_SERVER['HTTP_REFERER']."?error=passwordcheck"); 
        exit();
    }
    else{
        $sql_p = "SELECT phnUsers FROM users WHERE phnUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql_p)){
            header("Location:". $_SERVER['HTTP_REFERER']."?error=sqlphnError");
            exit();
        }
        else{
           mysqli_stmt_bind_param($stmt,"i",$userphn); 
           mysqli_stmt_execute($stmt);
           mysqli_stmt_store_result($stmt);
           $resultphnCheck = mysqli_stmt_num_rows($stmt);
           if($resultphnCheck > 0){
            header("Location: ". $_SERVER['HTTP_REFERER']."?error=phnNumberTaken");
            exit();
           }
        }
        $sql_e = "SELECT emailUsers FROM users WHERE emailUsers=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql_e)){
            header("Location: ". $_SERVER['HTTP_REFERER']."?error=sqlemailError");
            exit();
        }
        else{
            mysqli_stmt_bind_param($stmt,"s",$email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultemailCheck = mysqli_stmt_num_rows($stmt);
            if($resultemailCheck > 0){
                header("Location: ". $_SERVER['HTTP_REFERER']."?error=emailIdTaken");
                exit(); 
            }
            else{
                $sql = "INSERT INTO users (firstNameUsers, lastNameUsers,phnUsers,emailUsers,pwdUsers,added_on) VALUES (?, ?, ?, ?, ?,'$added_on')";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ". $_SERVER['HTTP_REFERER']."?error=sqlInsertError");
                    exit();
                }
                else{
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"ssiss",$first_name,$last_name,$userphn,$email,$hashedPwd);
                    mysqli_stmt_execute($stmt);
                    $resultCheck = mysqli_stmt_get_result($stmt);
                    $row = mysqli_fetch_assoc($resultCheck);
                    $user_id=$row['id'];
                    session_start();
                    $_SESSION['signed_user'] = $first_name;
                    $_SESSION['new_user'] = $user_id;
                    header('Location: ' . $_SERVER['HTTP_REFERER']);
                    exit();
                } 
            }

        }
        
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

}
else {
    header("Location: ../index.php");
    exit();
}
 