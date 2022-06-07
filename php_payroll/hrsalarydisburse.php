<h1>Welcome Employee Salary Disburse portal for HR</h1>

<?php
require_once "connection.php";
session_start();

if(isset($_POST['submit'])){

    echo "Welcome ".$_SESSION['success'];
    // check available
    $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em");

    $stmt->execute(array(
        ':em' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Check0";
    if($row == true){
        echo "Email already exits/Give another one for new employee";
        echo "Check1...............................................................";
    }else{
    

        echo "Check2...................................................................";
        // // Employee table add
        $sql = "INSERT INTO employee (name, email, password,age,join_date,quality,address,salary)
            VALUES (:name, :email, :password,:age,:join_date,:quality,:address,:salary)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':age' => $_POST['age'],
        ':join_date' => $_POST['join_date'],
        ':quality' => $_POST['quality'],
        ':address' => $_POST['address'],
        ':salary' => $_POST['salary']));
        echo "Check3...................................................................";
        // getting employee id 
        
        $stmt = $pdo->prepare("SELECT * FROM employee WHERE email = :em");
    
        $stmt->execute(array(
            ':em' => $_POST['email']));
        $row3 = $stmt->fetch(PDO::FETCH_ASSOC);

          $emid=(int)$row3['id'];
          $emid = htmlentities($row3['id']);
        //  $empID=$_POST['id'];
         echo "Check4...................................................................";
         // login table add
         $sql = "INSERT INTO login (id,name, email, password,type)
         VALUES (:id,:name, :email, :password,:type)";
         $stmt = $pdo->prepare($sql);
         $stmt->execute(array(
         ':id' => $emid,
         ':name' => $_POST['name'],
         ':email' => $_POST['email'],
         ':password' => $_POST['password'],
         ':type' => 'employee'));

        echo "Check5........................................";
        $_SESSION['success'] = 'Record updated';
        header( 'Location: hr.php' ) ;
        return;

    }


}
// cancel and back to hr portal
if ( isset($_POST['cancel'])){
    $_SESSION['success'] = ' cancel';
        header( 'Location: hr.php' ) ;
        return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = "Missing HR id";
    header('Location: hr.php');
    return;
  }
// Flash pattern message
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

if ( isset($_POST['name']) && isset($_POST['email'])
     && isset($_POST['password'])) {

    // Data validation
    if ( strlen($_POST['name']) < 1 || strlen($_POST['password']) < 1) {
        $_SESSION['error'] = 'Missing data';
        header("Location: add.php");
        return;
    }

}

//Your details table (employee).........................
echo "Employee details:";
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
    echo('<a href="hrpaydistribute.php?id='.$row['id'].'">Confirm Pay</a> / ');
    echo('<a href="hrincriment_deduction.php?id='.$row['id'].'"> Confirm Deduction</a>');
    echo("</td></tr>\n");
}

?>


