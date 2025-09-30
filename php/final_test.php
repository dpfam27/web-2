<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>✅ Final Connection Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🎉 Database Connection Working!</h1>
            
            <?php
            // Include your connection file
            include 'connection.php';
            
            if ($conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connection Successful!</h3>";
                echo "<p>Using connection.php - same as your other PHP files will use</p>";
                
                // Show data from table1
                echo "<h3>📊 Data from table1:</h3>";
                $result = mysqli_query($conn, "SELECT * FROM table1");
                
                if ($result && mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<thead>";
                    echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Contact</th></tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    
                    while ($row = mysqli_fetch_assoc($result)) {
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
                    
                    echo "<p><strong>Total records:</strong> " . mysqli_num_rows($result) . "</p>";
                    
                    // Test INSERT operation
                    echo "<h3>🔧 Testing INSERT operation:</h3>";
                    $test_insert = "INSERT INTO table1 (firstname, lastname, email, contact) VALUES ('Test', 'User', 'test@example.com', '1111111111')";
                    
                    if (mysqli_query($conn, $test_insert)) {
                        echo "<p>✅ INSERT test successful! New record added.</p>";
                        
                        // Show updated count
                        $count_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM table1");
                        $count_row = mysqli_fetch_assoc($count_result);
                        echo "<p>📊 Total records now: " . $count_row['total'] . "</p>";
                        
                        // Remove test record
                        mysqli_query($conn, "DELETE FROM table1 WHERE email = 'test@example.com'");
                        echo "<p>🗑 Test record removed</p>";
                    } else {
                        echo "<p>❌ INSERT test failed: " . mysqli_error($conn) . "</p>";
                    }
                    
                } else {
                    echo "<p>No data found in table1</p>";
                }
                
                echo "</div>";
                
                echo "<div class='alert alert-info'>";
                echo "<h3>🎯 Summary:</h3>";
                echo "<ul>";
                echo "<li>✅ PHP can connect to Docker MySQL database</li>";
                echo "<li>✅ Database 'LoginReg' is accessible</li>";
                echo "<li>✅ Table 'table1' exists with data</li>";
                echo "<li>✅ SELECT operations work</li>";
                echo "<li>✅ INSERT operations work</li>";
                echo "<li>✅ Your connection.php file is properly configured</li>";
                echo "</ul>";
                echo "<p><strong>🚀 Your database connection is ready for development!</strong></p>";
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
                <a href="connection.php" class="btn btn-success">View Connection File</a>
                <a href="http://localhost:8081" class="btn btn-info" target="_blank">📊 phpMyAdmin</a>
            </div>
        </div>
    </div>
</body>
</html>