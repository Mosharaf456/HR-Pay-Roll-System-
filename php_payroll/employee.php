
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/media..css">
    <title>Employee Payroll</title>
</head>
<body style="margin-top: 20px;" >
<!-- My php file work -->
<h1>Welcome employee Portal!</h1>
    <div class="container">
        <div class="row">
            <div class="col-6">
            <form method="post" action="employee.php">
            <table>
                <tr>
                <td style="margin-right: 50px;">Enter Your Email:</td>
                <td><input type="email" name="email" require placeholder="Enter Your Email" style="margin-right: 50px;"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" name="edit" value="Your INFO" style="margin-left: 50px; padding:5px;">
                    </td>
                </tr>
                <tr>
                    <td><input type="hidden" name="id" value="<?= $id ?>"></td>
                </tr>
            </table>

        </form>
            </div>
            <div class="col-6">
            <form method="post" action="employee.php">
            <table>
            
                
            </table>
        </form>
            </div>
        </div>
    </div>
    <!--End My php file work -->

    <p>

    <?php
require_once "connection.php";
session_start();

if(isset($_SESSION['success4']) && isset($_SESSION['id']  ) ) {
    echo "Hello ".$_SESSION['email'];
    echo "<br>".$_SESSION['success4'] ;
    echo "<br><a href='logout.php'>Logout</a> <br>";
    // new work

    //Your details table (employee)
    // $em =$_SESSION['email'];
    // .............................................................now
    if(isset($_POST['email']) && isset($_POST['edit'])){
        $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em");

        $stmt->execute(array(
            ':em' => $_POST['email']));
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "Check0";
        if($row == true){
            echo "Email  exits";
            echo "Check1...............................................................";
            $id = $row['id'];
            echo "Employee details:";
            echo('<table border="1">'."\n");
            $stmt = $pdo->query("SELECT * FROM employee WHERE id = $id");
            while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                echo "<tr><td>";
                echo(htmlentities($row['name']));
                echo("</td><td>");
                echo(htmlentities($row['age']));
                echo("</td><td>");
                echo("</td><td>");
                echo(htmlentities($row['address']));
                echo("</td><td>");
                echo("</td><td>");
                echo(htmlentities($row['salary']));
                echo("</td><td>");
                echo('<a href="emupdate.php?id='.$row['id'].'">Edit</a> / ');
                echo('<a href="emwithdraw.php?id='.$row['id'].'">withdraw</a>');
                echo("</td></tr>\n");
                }
        }else{
            echo "Wrong email/ enter your valid email/contact with HR";
        }

    }
}else{
    header("location: login.php");
    return;
}
?>





    </p>


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



<!--javaScript library -->
<script src="./js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="./js/bootstrap.min.js"></script>
<script src="https://kit.fontawesome.com/202c4372ef.js" crossorigin="anonymous"></script>
</body>
</html>

