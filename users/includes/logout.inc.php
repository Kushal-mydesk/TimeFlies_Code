<?php
 session_start();
 unset( $_SESSION['userID']);
 unset( $_SESSION['signed_user']);
 unset( $_SESSION['userfirstname']);
 header('Location: ' . $_SERVER['HTTP_REFERER']);
 //session_destroy();
?>

