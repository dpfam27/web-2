<?php
//creating a database connection - $link is a variable use for just connection class
$link=mysqli_connect("localhost","root","Klyvu1712@") or die(mysqli_connect_error());
mysqli_select_db($link,"login_demo") or die(mysqli_error($link));


