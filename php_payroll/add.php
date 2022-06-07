<h1>welcome Employee Add portal</h1>

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD NEW ONE</title>
</head>
<body>
<p>Add A New User</p>
<form method="post" action="add.php">
            <table>
                <tr>    
                    <td>Name</td>
                    <td><input type="text" name="name" required></td>
                    
                </tr>
                <tr>    
                    <td>Email</td>
                    <td><input type="email" name="email" required></td>
                    
                </tr>
                <tr>    
                    <td>Password</td>
                    <td><input type="password" name="password" required></td>
                    
                </tr>
                <tr>    
                    <td><label for="start">Age:</label></td>
                    <td><input type="date" id="start" name="age" placeholder="enter numbers" required ></td>                    
                </tr>
                <tr>    
                    <td><label for="start">Join date:</label></td>

                    <td><input type="date" name="join_date" placeholder="enter numbers" required></td>
                    
                </tr>
            
                <tr>    
                    <td>Qualification</td>
                    <td><input type="text" name="quality" required></td>
                    
                </tr>
                <tr>    
                    <td>Address</td>
                    <td><input type="text" name="address" required></td>
                    
                </tr>
                <tr>    
                    <td>Salary</td>
                    <td><input type="text" name="salary" required></td>
                    
                </tr>
                <tr>   
                    <td><input type="submit" name="submit" value="Add"></td>
                    
                </tr>
                <br>
                
            </table>
        </form>
        <form method="post" action="add.php">
        <table>
            <tr>   
                <td><input type="submit" name="cancel" value="Cancel"></td>        
            </tr>
        </table>
        </form>
    
</body>
</html>



