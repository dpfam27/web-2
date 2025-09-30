<?php
$servername = "mysql-db"; // tên container MySQL
$username = "root";       // user
$password = "Dpfam278@";  // pass root
$database = "laptop_shop"; // tên database

// Tạo connection
$conn = new mysqli($servername, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
// echo "Kết nối thành công!";
?>
