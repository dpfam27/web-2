<?php
echo "<h1>🔍 Database Investigation</h1>";

$servername = "db";
$username = "root";
$password = "Dpfam278@";

// Connect without specifying database first
$conn = mysqli_connect($servername, $username, $password);

if ($conn) {
    echo "<h3>✅ Connected to MySQL Server</h3>";
    
    // Show all databases
    echo "<h4>📊 All Databases:</h4>";
    $dbs = mysqli_query($conn, "SHOW DATABASES");
    while ($db = mysqli_fetch_array($dbs)) {
        echo "- " . $db[0] . "<br>";
    }
    
    // Check specifically for LoginReg database
    echo "<h4>🔍 Checking LoginReg database:</h4>";
    $check_db = mysqli_query($conn, "SELECT SCHEMA_NAME FROM information_schema.SCHEMATA WHERE SCHEMA_NAME = 'LoginReg'");
    if (mysqli_num_rows($check_db) > 0) {
        echo "✅ LoginReg database exists<br>";
        
        // Use LoginReg database
        mysqli_select_db($conn, "LoginReg");
        echo "✅ Selected LoginReg database<br>";
        
        // Show tables in LoginReg
        echo "<h4>📋 Tables in LoginReg:</h4>";
        $tables = mysqli_query($conn, "SHOW TABLES");
        if (mysqli_num_rows($tables) > 0) {
            while ($table = mysqli_fetch_array($tables)) {
                echo "- " . $table[0] . "<br>";
                
                // If table1 exists, show its data
                if ($table[0] == 'table1') {
                    echo "<h5>📊 Data in table1:</h5>";
                    $data = mysqli_query($conn, "SELECT * FROM table1");
                    if (mysqli_num_rows($data) > 0) {
                        echo "<table border='1' style='border-collapse: collapse;'>";
                        echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact</th></tr>";
                        while ($row = mysqli_fetch_assoc($data)) {
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['firstname'] . "</td>";
                            echo "<td>" . $row['lastname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['contact'] . "</td>";
                            echo "</tr>";
                        }
                        echo "</table>";
                    } else {
                        echo "Table1 exists but is empty<br>";
                    }
                }
            }
        } else {
            echo "❌ No tables found in LoginReg database<br>";
            echo "<h4>🛠 Creating table1:</h4>";
            
            $create_table = "CREATE TABLE IF NOT EXISTS `table1` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `firstname` varchar(100) NOT NULL,
                `lastname` varchar(100) NOT NULL,
                `email` varchar(150) NOT NULL,
                `contact` varchar(20) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            
            if (mysqli_query($conn, $create_table)) {
                echo "✅ Table1 created successfully<br>";
                
                // Insert sample data
                $insert_data = "INSERT INTO `table1` (`firstname`, `lastname`, `email`, `contact`) VALUES
                    ('John', 'Doe', 'john.doe@example.com', '1234567890'),
                    ('Jane', 'Smith', 'jane.smith@example.com', '0987654321'),
                    ('Mike', 'Johnson', 'mike.johnson@example.com', '5555555555')";
                
                if (mysqli_query($conn, $insert_data)) {
                    echo "✅ Sample data inserted<br>";
                } else {
                    echo "❌ Error inserting data: " . mysqli_error($conn) . "<br>";
                }
            } else {
                echo "❌ Error creating table: " . mysqli_error($conn) . "<br>";
            }
        }
        
    } else {
        echo "❌ LoginReg database does not exist<br>";
        echo "<h4>🛠 Creating LoginReg database:</h4>";
        
        if (mysqli_query($conn, "CREATE DATABASE LoginReg")) {
            echo "✅ LoginReg database created<br>";
            mysqli_select_db($conn, "LoginReg");
            
            // Create table
            $create_table = "CREATE TABLE IF NOT EXISTS `table1` (
                `id` int(11) NOT NULL AUTO_INCREMENT,
                `firstname` varchar(100) NOT NULL,
                `lastname` varchar(100) NOT NULL,
                `email` varchar(150) NOT NULL,
                `contact` varchar(20) NOT NULL,
                PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
            
            if (mysqli_query($conn, $create_table)) {
                echo "✅ Table1 created<br>";
                
                // Insert sample data
                $insert_data = "INSERT INTO `table1` (`firstname`, `lastname`, `email`, `contact`) VALUES
                    ('John', 'Doe', 'john.doe@example.com', '1234567890'),
                    ('Jane', 'Smith', 'jane.smith@example.com', '0987654321'),
                    ('Mike', 'Johnson', 'mike.johnson@example.com', '5555555555')";
                
                if (mysqli_query($conn, $insert_data)) {
                    echo "✅ Sample data inserted<br>";
                }
            }
        } else {
            echo "❌ Error creating database: " . mysqli_error($conn) . "<br>";
        }
    }
    
    mysqli_close($conn);
} else {
    echo "❌ Cannot connect to MySQL server<br>";
}

echo "<hr>";
echo "<h3>🧪 Test your connection.php now:</h3>";
echo "<a href='final_test.php' style='background: #007bff; color: white; padding: 10px; text-decoration: none; border-radius: 5px;'>Test Final Connection</a>";
?>