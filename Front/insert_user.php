<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'db_connect.php'; // เชื่อมต่อฐานข้อมูล

// แสดงข้อผิดพลาด (เปิดการแสดงผลข้อผิดพลาด เพื่อให้เห็นข้อผิดพลาดระหว่างการพัฒนา)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// รับข้อมูลจากฟอร์ม
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// เตรียม SQL Query สำหรับการเพิ่มข้อมูล
$sql = "INSERT INTO users (name, username, email, password) VALUES('$name','$username','$email','$password')";
$dbo->query("$sql");

header("location: signup_login.php");

?>
