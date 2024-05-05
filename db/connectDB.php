<?php
$host = "localhost";
$username = "root";
$password = "12345678";
$db = "php-mysqli-vuejs-cdn"; 
// สร้าง connection
$conn = mysqli_connect($host, $username, $password, $db);
// ตรวจสอบ connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
} 
// Change character set to utf8
mysqli_set_charset($conn,"utf8");
?>