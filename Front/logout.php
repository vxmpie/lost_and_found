<?php
session_start(); 
//error_reporting(0);
unset($_SESSION["user_id"]);
session_destroy();
header("location: home.php");
exit();
?>