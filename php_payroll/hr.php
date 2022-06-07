<?php
require_once "connection.php";
session_start();


if( isset($_SESSION['success']) && isset($_SESSION['id']) ){

    // echo "Hello ".$_SESSION['email'];
    echo "<br>Welcome ".$_SESSION['success'];
    // new work edit
    

    // end new work edit

    echo "<br><a href='logout.php'>Logout</a>";
}
else{
    header('location: login.php');
    return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/media..css">
    <title>HR Payroll</title>
</head>
<body >
<!-- My php file work -->
<h1>Hello, HR!</h1>
 

<!-- 2nd Start header part -->
<section class="header-part style="background-color: gray;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">Log out <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">Payment details</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">protfolio</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">blog</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">about employee</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link hover-ani" href="#">contact</a>
                            </li> -->
                        </ul>
                    </div>
                    <div class="appoinment">
                        <ul class="navbar-nav ">
                            <li class="nav-item hover-ani">
                                <i class="far fa-calendar-alt"></i>
                                <a class="nav-link" href="#">Payment</a>
                            </li>
                        </ul>
                    </div>
                </nav>

            </div>
        </div>
    </div>
</section>
<!-- 2nd End header part -->

<!-- Edit -->
<?php
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}
if ( isset($_SESSION['success']) ) {
    echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
    unset($_SESSION['success']);
}
//Your details table (employee).........................

echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT * FROM employee");
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['name']));
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['age']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['join_date']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['quality']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['address']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['salary']));
    echo("</td><td>");
    echo('<a href="update.php?id='.$row['id'].'">Edit</a> / ');
    echo('<a href="delete.php?id='.$row['id'].'">Delete</a>');
    echo("</td></tr>\n");
}
echo '<br>';
echo "Click here  to add a new employee: ";
echo '<a href="add.php?id='.$row['id'].'">Add</a>';

echo '<br>';
echo "Click here to pay all employee monthly salary: ";

echo '<a href="hrsalarydisburse.php?id='.$row['id'].'">Salary Disburse</a>';
echo '<br>';
// table for show info hr and edit.............................
echo "<br>Employee details:";

echo('<table border="1">'."\n");
$stmt = $pdo->query("SELECT * FROM hr");
echo "HR Info:";
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
    echo "<tr><td>";
    echo(htmlentities($row['name']));
    echo("</td><td>");
    echo(htmlentities($row['email']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['password']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['phoneNumber']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['join_date']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['address']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['gender']));
    echo("</td><td>");
    echo("</td><td>");
    echo(htmlentities($row['age']));
    echo("</td><td>");
    echo('<a href="updatehr.php?id='.$row['id'].'">Edit</a>');
    echo("</td></tr>\n");
    
}
?>
</table>

<!-- <a href="add.php">Add New</a> -->




<!--javaScript library -->
<script src="./js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="./js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/202c4372ef.js" crossorigin="anonymous"></script>
</body>
</html>

