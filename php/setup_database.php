<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Setup</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🔧 Database Setup</h1>
            
            <?php
            // Try to connect as root first to create database and user
            $servername = "db";
            $root_password = "Dpfam278@";
            
            // Connect as root without selecting a database
            $root_conn = mysqli_connect($servername, "root", $root_password);
            
            if ($root_conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connected as root successfully!</h3>";
                
                // Create database if it doesn't exist
                $create_db = "CREATE DATABASE IF NOT EXISTS LoginReg CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci";
                if (mysqli_query($root_conn, $create_db)) {
                    echo "<p>✅ Database 'LoginReg' created/verified</p>";
                } else {
                    echo "<p>❌ Error creating database: " . mysqli_error($root_conn) . "</p>";
                }
                
                // Grant privileges to user on LoginReg database
                $grant_sql = "GRANT ALL PRIVILEGES ON LoginReg.* TO 'user'@'%'";
                if (mysqli_query($root_conn, $grant_sql)) {
                    echo "<p>✅ Granted privileges to user on LoginReg database</p>";
                } else {
                    echo "<p>❌ Error granting privileges: " . mysqli_error($root_conn) . "</p>";
                }
                
                // Flush privileges
                if (mysqli_query($root_conn, "FLUSH PRIVILEGES")) {
                    echo "<p>✅ Privileges flushed</p>";
                }
                
                mysqli_close($root_conn);
                echo "</div>";
                
                // Now test connection as user
                echo "<h3>Testing user connection:</h3>";
                $user_conn = mysqli_connect($servername, "user", "password", "LoginReg");
                
                if ($user_conn) {
                    echo "<div class='alert alert-success'>";
                    echo "<h3>✅ User connection successful!</h3>";
                    
                    // Test query
                    $result = mysqli_query($user_conn, "SELECT DATABASE() as current_db");
                    if ($result) {
                        $row = mysqli_fetch_assoc($result);
                        echo "<p><strong>Connected to database:</strong> " . $row['current_db'] . "</p>";
                    }
                    
                    mysqli_close($user_conn);
                    echo "</div>";
                    
                    echo "<div class='alert alert-info'>";
                    echo "<h3>🎉 Setup Complete!</h3>";
                    echo "<p>You can now use the regular connection.php file.</p>";
                    echo "</div>";
                    
                } else {
                    echo "<div class='alert alert-danger'>";
                    echo "<h3>❌ User connection failed!</h3>";
                    echo "<p>Error: " . mysqli_connect_error() . "</p>";
                    echo "</div>";
                }
                
            } else {
                echo "<div class='alert alert-danger'>";
                echo "<h3>❌ Root connection failed!</h3>";
                echo "<p>Error: " . mysqli_connect_error() . "</p>";
                echo "</div>";
            }
            ?>
            
            <div class="text-center mt-2">
                <a href="index.php" class="btn">← Back to Home</a>
                <a href="test_connection.php" class="btn btn-success">Test Connection</a>
                <a href="http://localhost:8081" class="btn btn-info" target="_blank">📊 phpMyAdmin</a>
            </div>
        </div>
    </div>
</body>
</html>