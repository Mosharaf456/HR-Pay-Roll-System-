<?php
session_start();
if(isset($_SESSION['email'])) {
    session_destroy();
    echo "Logged Out";
    echo "<br><a href='login.php'>Login</a>";
}else{
    header("location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Payroll System</title>
</head>
<body>
    
</body>
</html>