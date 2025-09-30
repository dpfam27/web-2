<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Setup and Import</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🔧 Database Setup and Import</h1>
            
            <?php
            $servername = "db";
            $username = "root";
            $password = "Dpfam278@";
            $dbname = "LoginReg";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connected to Docker MySQL Database</h3>";
                
                // Show existing tables
                echo "<h4>📋 Current tables in LoginReg database:</h4>";
                $tables_result = mysqli_query($conn, "SHOW TABLES");
                if (mysqli_num_rows($tables_result) > 0) {
                    echo "<ul>";
                    while ($table = mysqli_fetch_array($tables_result)) {
                        echo "<li>" . $table[0] . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No tables found. Let's create the table1 from your DBeaver setup!</p>";
                }
                
                // Create table1 like in DBeaver
                echo "<h4>🛠 Creating table1 (same structure as DBeaver):</h4>";
                $create_table = "CREATE TABLE IF NOT EXISTS `table1` (
                    `id` int(11) NOT NULL AUTO_INCREMENT,
                    `firstname` varchar(100) NOT NULL,
                    `lastname` varchar(100) NOT NULL,
                    `email` varchar(150) NOT NULL,
                    `contact` varchar(20) NOT NULL,
                    PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";
                
                if (mysqli_query($conn, $create_table)) {
                    echo "<p>✅ Table 'table1' created successfully!</p>";
                } else {
                    echo "<p>❌ Error creating table: " . mysqli_error($conn) . "</p>";
                }
                
                // Insert sample data (same as DBeaver)
                echo "<h4>📊 Inserting sample data:</h4>";
                $check_data = mysqli_query($conn, "SELECT COUNT(*) as count FROM table1");
                $count_row = mysqli_fetch_assoc($check_data);
                
                if ($count_row['count'] == 0) {
                    $insert_data = "INSERT INTO `table1` (`firstname`, `lastname`, `email`, `contact`) VALUES
                        ('John', 'Doe', 'john.doe@example.com', '1234567890'),
                        ('Jane', 'Smith', 'jane.smith@example.com', '0987654321'),
                        ('Mike', 'Johnson', 'mike.johnson@example.com', '5555555555')";
                    
                    if (mysqli_query($conn, $insert_data)) {
                        echo "<p>✅ Sample data inserted successfully!</p>";
                    } else {
                        echo "<p>❌ Error inserting data: " . mysqli_error($conn) . "</p>";
                    }
                } else {
                    echo "<p>ℹ️ Table already contains {$count_row['count']} records</p>";
                }
                
                // Show the data
                echo "<h4>📋 Current data in table1:</h4>";
                $data_result = mysqli_query($conn, "SELECT * FROM table1");
                
                if ($data_result && mysqli_num_rows($data_result) > 0) {
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    while ($row = mysqli_fetch_assoc($data_result)) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['contact'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";
                    echo "</table>";
                } else {
                    echo "<p>No data found</p>";
                }
                
                echo "</div>";
                mysqli_close($conn);
                
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<h3>❌ Connection Failed!</h3>";
                echo "<p>Error: " . mysqli_connect_error() . "</p>";
                echo "</div>";
            }
            ?>
            
            <div class="text-center mt-2">
                <a href="index.php" class="btn">← Back to Home</a>
                <a href="test_dbeaver_data.php" class="btn btn-success">Test Data Again</a>
                <a href="http://localhost:8081" class="btn btn-info" target="_blank">📊 phpMyAdmin</a>
            </div>
        </div>
    </div>
</body>
</html>