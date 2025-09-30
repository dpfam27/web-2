<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Connection Test</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <h1>🔗 Database Connection Test</h1>
            
            <?php
            include 'connection.php';
            
            if ($conn) {
                echo "<div class='alert alert-success'>";
                echo "<h3>✅ Connection Successful!</h3>";
                echo "<p><strong>Host:</strong> db (Docker service)</p>";
                echo "<p><strong>Database:</strong> LoginReg</p>";
                echo "<p><strong>User:</strong> root</p>";
                
                // Test query
                $result = mysqli_query($conn, "SELECT DATABASE() as current_db, VERSION() as mysql_version");
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    echo "<p><strong>Current Database:</strong> " . $row['current_db'] . "</p>";
                    echo "<p><strong>MySQL Version:</strong> " . $row['mysql_version'] . "</p>";
                }
                echo "</div>";
                
                // Test if LoginReg database exists and has tables
                $tables_result = mysqli_query($conn, "SHOW TABLES");
                if ($tables_result && mysqli_num_rows($tables_result) > 0) {
                    echo "<div class='alert alert-info'>";
                    echo "<h3>📊 Existing Tables:</h3>";
                    echo "<ul>";
                    while ($table = mysqli_fetch_array($tables_result)) {
                        echo "<li>" . $table[0] . "</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-info'>";
                    echo "<p>📝 No tables found. You can run your database.sql file to create tables.</p>";
                    echo "</div>";
                }
                
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
                <a href="http://localhost:8081" class="btn btn-info" target="_blank">📊 Open phpMyAdmin</a>
            </div>
        </div>
    </div>
</body>
</html>