<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Simple Connection Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🔗 Connection Test</h1>
            
            <?php
            $servername = "db";
            $username = "user";
            $password = "password";
            $dbname = "LoginReg";

            echo "<h3>Testing connection with user account:</h3>";
            echo "<p><strong>Host:</strong> $servername</p>";
            echo "<p><strong>Username:</strong> $username</p>";
            echo "<p><strong>Database:</strong> $dbname</p>";

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            if ($conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connection Successful!</h3>";
                
                // Test query
                $result = mysqli_query($conn, "SELECT DATABASE() as db, USER() as user");
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<p><strong>Connected database:</strong> " . $row['db'] . "</p>";
                    echo "<p><strong>Connected as:</strong> " . $row['user'] . "</p>";
                }
                
                // Show tables
                $tables = mysqli_query($conn, "SHOW TABLES");
                echo "<p><strong>Tables in database:</strong> " . mysqli_num_rows($tables) . "</p>";
                
                mysqli_close($conn);
                echo "</div>";
                
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<h3>❌ Connection Failed!</h3>";
                echo "<p>Error: " . mysqli_connect_error() . "</p>";
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