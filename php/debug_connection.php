<?php
echo "<h1>🔍 Connection Diagnostic</h1>";

echo "<h3>1. PHP Extensions Check:</h3>";
echo "mysqli extension: " . (extension_loaded('mysqli') ? '✅ Loaded' : '❌ Not loaded') . "<br>";
echo "PDO extension: " . (extension_loaded('pdo') ? '✅ Loaded' : '❌ Not loaded') . "<br>";
echo "PDO MySQL: " . (extension_loaded('pdo_mysql') ? '✅ Loaded' : '❌ Not loaded') . "<br>";

echo "<h3>2. Connection Variables:</h3>";
$servername = "db";
$username = "root";
$password = "Dpfam278@";
$dbname = "LoginReg";

echo "Host: $servername<br>";
echo "Username: $username<br>";
echo "Database: $dbname<br>";
echo "Password: " . (empty($password) ? 'Empty' : 'Set (' . strlen($password) . ' chars)') . "<br>";

echo "<h3>3. Network Test:</h3>";
// Test if we can reach the database host
$ping = @fsockopen('db', 3306, $errno, $errstr, 5);
if ($ping) {
    echo "✅ Can reach database host 'db' on port 3306<br>";
    fclose($ping);
} else {
    echo "❌ Cannot reach database host 'db' on port 3306<br>";
    echo "Error: $errno - $errstr<br>";
}

echo "<h3>4. Connection Test:</h3>";
try {
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if ($conn) {
        echo "✅ Connection successful!<br>";
        
        // Test query
        $result = mysqli_query($conn, "SELECT DATABASE() as db, USER() as user, VERSION() as version");
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            echo "Connected database: " . $row['db'] . "<br>";
            echo "Connected as: " . $row['user'] . "<br>";
            echo "MySQL version: " . $row['version'] . "<br>";
        }
        
        // Test table access
        $tables = mysqli_query($conn, "SHOW TABLES");
        echo "Tables found: " . mysqli_num_rows($tables) . "<br>";
        
        mysqli_close($conn);
    } else {
        echo "❌ Connection failed!<br>";
        echo "Error: " . mysqli_connect_error() . "<br>";
        echo "Error number: " . mysqli_connect_errno() . "<br>";
    }
} catch (Exception $e) {
    echo "❌ Exception: " . $e->getMessage() . "<br>";
}

echo "<h3>5. PHP Info:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Server: " . $_SERVER['SERVER_SOFTWARE'] . "<br>";
?>