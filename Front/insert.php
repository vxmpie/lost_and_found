<?php
// รวมไฟล์เชื่อมต่อฐานข้อมูล
include 'db_connect.php'; // เชื่อมต่อฐานข้อมูล

// แสดงข้อผิดพลาด (เปิดการแสดงผลข้อผิดพลาด เพื่อให้เห็นข้อผิดพลาดระหว่างการพัฒนา)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// รับข้อมูลจากฟอร์ม
$owner = '1';
$image = $_FILES['image']['name']; // ข้อมูลไฟล์
$title = $_POST['title'];
$description = $_POST['description'];
$date = $_POST['date'];
$location = $_POST['location'];

// ตั้งค่าให้เวลาโพสต์เป็นเวลาปัจจุบัน

// ตั้งค่าโฟลเดอร์สำหรับเก็บไฟล์
$target_dir = "image/$owner-$title-";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

// ตรวจสอบขนาดไฟล์
$maxFileSize = 5 * 1024 * 1024; // 5 MB
if ($_FILES["image"]["size"] > $maxFileSize) {
    echo "Sorry, your file is too large.";
    exit;
}

// ตรวจสอบว่าไฟล์ถูกอัปโหลดสำเร็จหรือไม่
if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
} else {
    echo "Sorry, there was an error uploading your file.";
    exit; // หยุดการทำงานหากอัปโหลดไฟล์ล้มเหลว
}

// เตรียม SQL Query สำหรับการเพิ่มข้อมูล
$sql = "INSERT INTO items (image, title, description, date, location,owner) VALUES('$owner-$title-$image','$title','$description','$date','$location','$owner')";
$dbo->query("$sql");

header("location: home.php");

?>
