<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Test with Existing Data</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🔗 Testing Connection to Your DBeaver Database</h1>
            
            <?php
            // Using root connection like DBeaver
            $servername = "db";  // Docker service name
            $username = "root";
            $password = "Dpfam278@";
            $dbname = "LoginReg";

            echo "<h3>Connection Details:</h3>";
            echo "<p><strong>Host:</strong> $servername (Docker internal)</p>";
            echo "<p><strong>Username:</strong> $username</p>";
            echo "<p><strong>Database:</strong> $dbname</p>";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connection Successful!</h3>";
                
                // Show current database
                $result = mysqli_query($conn, "SELECT DATABASE() as current_db");
                $row = mysqli_fetch_assoc($result);
                echo "<p><strong>Connected to:</strong> " . $row['current_db'] . "</p>";
                
                // Show data from table1 (same as DBeaver)
                echo "<h3>📊 Data from table1 (same as in DBeaver):</h3>";
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
                    
                    echo "<p><strong>Total records:</strong> " . mysqli_num_rows($data_result) . "</p>";
                } else {
                    echo "<p>No data found in table1</p>";
                }
                
                echo "</div>";
                mysqli_close($conn);
                
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<h3>❌ Connection Failed!</h3>";
                echo "<p>Error: " . mysqli_connect_error() . "</p>";
                echo "<p>This might be because PHP container can't connect to MySQL with root user.</p>";
                echo "</div>";
            }
            ?>
            
            <div class="text-center mt-2">
                <a href="index.php" class="btn">← Back to Home</a>
                <a href="http://localhost:8081" class="btn btn-info" target="_blank">📊 phpMyAdmin</a>
            </div>
        </div>
    </div>
</body>
</html>