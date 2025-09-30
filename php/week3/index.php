<?php
include "connection.php";
?>

<html lang="en" xmlns="">
<head>
    <title>User Account</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <!-- short column display for forms rows -->
   <!--visit https://www.w3schools.com/bootstrap/bootstrap_forms.asp search for forms template and use it.-->
    <div class="col-lg-4">
    <h2>User data form</h2>
    <form action="" name="form1" method="post">
        <div class="form-group">
            <label for="firstname">First name:</label>
            <input type="text" class="form-control" id="firstname" placeholder="Enter first name" name="firstname">
        </div>
        <div class="form-group">
            <label for="lastname">Last name:</label>
            <input type="text" class="form-control" id="lastname" placeholder="Enter Last name" name="lastname">
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email" placeholder="Enter Email" name="email">
        </div>
        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" class="form-control" id="contact" placeholder="Enter contact" name="contact">
        </div>
        <button type="submit" name="insert" class="btn btn-default">Insert</button>
        <button type="submit" name="update" class="btn btn-default">Update</button>
        <button type="submit" name="delete" class="btn btn-default">Delete</button>

    </form>
</div>
</div>

<!-- new column inserted for records -->
<!-- Search for boostrap table template online and copy code -->
<div class="col-lg-12">
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>#</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Contact</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <tbody>
        <!-- Database connection -->
        <?php
        if ($conn) {
            $res = mysqli_query($conn, "SELECT * FROM table1");
            
            if ($res && mysqli_num_rows($res) > 0) {
                while($row = mysqli_fetch_array($res)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . htmlspecialchars($row["firstname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["lastname"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["contact"]) . "</td>";
                    echo "<td><a href='edit.php?id=" . $row["id"] . "'><button type='button' class='btn btn-success'>Edit</button></a></td>";
                    echo "<td><a href='delete.php?id=" . $row["id"] . "'><button type='button' class='btn btn-danger'>Delete</button></a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No records found</td></tr>";
            }
        } else {
            echo "<tr><td colspan='7'>Database connection error</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>

<!-- new records insertion into database table -->
<!-- records delete from database table -->
<!-- records update from database table -->

<!-- to automatically refresh the pages after crud activity   window.location.href=window.location.href; -->
<?php
if(isset($_POST["insert"]))
{
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $contact = mysqli_real_escape_string($conn, $_POST['contact']);
    
    $query = "INSERT INTO table1 (firstname, lastname, email, contact) VALUES ('$firstname', '$lastname', '$email', '$contact')";
    if(mysqli_query($conn, $query)) {
        ?>
        <script type="text/javascript">
        alert('Record inserted successfully!');
        window.location.href=window.location.href;
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST["delete"]))
{
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $query = "DELETE FROM table1 WHERE firstname='$firstname'";
    if(mysqli_query($conn, $query)) {
        ?>
        <script type="text/javascript">
        alert('Record deleted successfully!');
        window.location.href=window.location.href;
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if(isset($_POST["update"]))
{
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $query = "UPDATE table1 SET lastname='$lastname' WHERE firstname='$firstname'";
    if(mysqli_query($conn, $query)) {
        ?>
        <script type="text/javascript">
        alert('Record updated successfully!');
        window.location.href=window.location.href;
        </script>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
</html>