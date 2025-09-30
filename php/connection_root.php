<?php
// Alternative connection using root with database selection
$servername = "db";
$username   = "root";
$password   = "Dpfam278@";

// Connect as root without database first
$conn = mysqli_connect($servername, $username, $password);

if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Create database if not exists
mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS LoginReg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// Select the database
mysqli_select_db($conn, "LoginReg");

echo "<!-- Database connection successful -->";
?>