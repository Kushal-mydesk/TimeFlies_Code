<?php
$server_name = "localhost";
$dbUser_name = "root";
$dbUser_password = "";
$dbName = "projectsys";

session_start();
$conn= mysqli_connect($server_name,$dbUser_name,$dbUser_password,$dbName);

if (!$conn) {
     die("Could not connect to database".mysqli_connect_error());
}