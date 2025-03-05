<?php
error_reporting(0);
session_start();    
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'db_connect.php'; // เชื่อมต่อฐานข้อมูล

// แสดงข้อผิดพลาด (เปิดการแสดงผลข้อผิดพลาด เพื่อให้เห็นข้อผิดพลาดระหว่างการพัฒนา)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// รับข้อมูลจากฟอร์ม
$email = $_POST['email'];
$password = $_POST['password'];

// เตรียม SQL Query สำหรับการเพิ่มข้อมูล
$query = "SELECT id FROM users WHERE email = '$email' AND password = '$password' ";
$count  = $dbo->query("$query")->rowCount(); 
$row = $dbo->query("$query")->fetch();   

if ($count == 1) {
    $_SESSION['user_id'] = $row['id']; 
   header("location: signup_login.php?error=0"); // get method (error=0) : login success
}

else{
    header("location: signup_login.php?error=1"); // get method (error=0) : login fall
}

?>
