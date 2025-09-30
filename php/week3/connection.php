<?php
$servername = "db";              // Docker service name
$username   = "root";            // Use root since it's working in DBeaver
$password   = "Dpfam278@";       // Root password that works in DBeaver
$dbname     = "LoginReg";        // Your existing database

// Kết nối
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

echo "<!-- Database connection successful to existing LoginReg database -->";
?>
