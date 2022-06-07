<?php
require_once "connection.php";
session_start();

if(isset($_POST['submit'])){


    $sql = "SELECT email,password FROM login WHERE email = :em AND password = :pass";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':em' => $_POST['email'],
        ':pass' => $_POST['password']));
    $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
    // new work
        $type1='hr';
        $type2='employee';
    // echo "Taken.....";
    if ( $row1 == false ) {
        echo "Wrong email/password";
    }else{
        $type1='hr';
        $type2='employee';
        // Hr validate for log in....................
        $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em and type = :typ");
    
        $stmt->execute(array(
            ':em' => $_POST['email'],
            ':typ' =>  $type1));
        $row2 = $stmt->fetch(PDO::FETCH_ASSOC);

        // Employee validate for log in

        $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em and type = :typ");
    
        $stmt->execute(array(
            ':em' => $_POST['email'],
            ':typ' =>  $type2));
        $row3 = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo "Taken2.....";
        // Hr testing for log in
        if($row2 == true){
            $_SESSION['success'] = 'Hr portal';
            // $_SESSION['email'] = $_POST['email'];
            $_SESSION['id'] = $row2['id'] ;


            header( 'Location: hr.php' ) ;
            return;
        }else{
            $_SESSION['success4'] = 'Employee portal';
            $_SESSION['id'] = $_POST['id'];
            $_SESSION['email'] = $_POST['email'];
            header( 'Location: employee.php' ) ;
            return;
        }
    }


}
//  varify HR
if(isset($_POST['newacc'])){
        if( isset($_POST['email']) && isset($_POST['password'])){
            $sql = "SELECT * FROM login WHERE email = :em AND password = :pass";
            $stmt = $pdo->prepare($sql);

            $stmt->execute(array(
                ':em' => $_POST['email'],
                ':pass' => $_POST['password']));
            $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
            // new work
                $type1='hr';
                // echo "check1 success";
            if ( $row1 == false ) {
                echo "Wrong email/password";
                echo "<br> Enter if you are HR with correct information";
                echo "<br> Contact with HR to create a new employee account";
                // echo "check2 success";
            }else{
                // Hr validate
                $type1='hr';
                $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em and type = :typ");
            
                $stmt->execute(array(
                    ':em' => $_POST['email'],
                    ':typ' =>  $type1));
                $row2 = $stmt->fetch(PDO::FETCH_ASSOC);
                // echo "check3 success";
                if($row2 == true){
                    $_SESSION['success10'] = 'Sign up portal';
                    $_SESSION['email'] = $_POST['email'];
                    header( 'Location: signup.php' );
                    return;
                    // echo "check4 success";
                }
                else{
                    echo "Please Fill up form properly if you are HR otherwise please contact with HR as your new employee account creation";
                    // echo "check5 success";
                }
            }
        }
    
}



?>





<!DOCTYPE html>
<html>
    <head>
        <title>LogIn Monthly Payroll system</title>
    </head>
    <body>
        <h1>Log in page</h1>
        <form method="post" action="login.php">
            <table>
            
                <tr>    
                    <td>Email</td>
                    <td><input type="email" name="email" required></td>
                    
                </tr>
                <tr>    
                    <td>Password</td>
                    <td><input type="password" name="password" required></td>
                    
                </tr>
                <tr>   
                    <td><input type="submit" name="submit" value="Login"></td>
                    
                </tr>
            
                <tr>   
                    <td><input type="submit" name="newacc" value="SIGN UP" style="margin-top: 10px;"></td>
                </tr>
                <!-- hidden input for authentication-->
                <tr>
                    <td><input type="hidden" name="id" value="<?= $row1['id'] ?>"></td>
                </tr>
            </table>
        </form>
        
        
    </body>
</html>