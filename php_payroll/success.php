<?php
session_start();
if(isset($_SESSION['name'])){
    echo "Welcome ".$_SESSION['name']." to the system";
    echo "<br>Your username is ".$_SESSION['email'];
    echo "<br>Please logout to use the system";
    echo "<br><a href='logout.php'> Logout</a>";
} else{
    header("location: login.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success Sign up</title>
</head>
<body>
    
</body>
</html>