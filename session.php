<?php
  
   include_once 'inc/services/db_config.php';
   session_start();
   $conn=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE);
   $user_check = $_SESSION['login_user'];
   $ses_sql = mysqli_query($conn,"select * from users where user_email = '$user_check' ");
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   $currempid=$row['id'];
   $currusertype=$row['user_type'];
   if(!isset($_SESSION['login_user'])){
        header("location:login.php");
   }
?>
