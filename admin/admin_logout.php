<?php
session_start();
unset($_SESSION['Admin_Login']);
unset($SESSION['Admin_Username']);
header('Location:admin_login.php');
die();
?>