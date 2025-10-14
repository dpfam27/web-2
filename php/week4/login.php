<?php
include("db_connect.php");

if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = MD5($_POST['password']);

    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($link, $query);

    if(mysqli_num_rows($result) == 1){
        echo "Login successful!";
        // Redirect to a protected page or dashboard
    } else {
        echo "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <h2>Login</h2>
    <form action="" method="POST">
        <label for="">Username</label>
        <input type="text" name="username" required><br><br>
        
        <label for="">Password</label>
        <input type="password" id="" name="password" required><br><br>
        
        <input type="submit" name='login' value="Login">
    </form>
</body>
</html>