<?php
require_once "connection.php";
session_start();
if(isset($_SESSION['email']) && isset($_SESSION['success10'])){
    echo "Welcome ".$_SESSION['success10'];
    echo "<br><a href='logout.php'>Logout</a>";
    

}else{
    header( 'Location: login.php' ) ;
        return;
}

 // adding employee account
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

        unset($_SESSION['success']);

        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        header( 'Location: success.php' ) ;
        return;
    }


}

?>
<?php
        // Hr account adding...........................
 if(isset($_POST['submit_hr'])){

    // echo "Welcome ".$_SESSION['success'];
    // check available
    $stmt = $pdo->prepare("SELECT * FROM login WHERE email = :em");

    $stmt->execute(array(
        ':em' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Check0";
    if($row == true){
        echo "Email already exits/Give another one for new Hr";
        echo "Check1...............................................................";
    }else{
    

        echo "Check2...................................................................";
        // // Employee table add
        $sql = "INSERT INTO hr (name, email, password,phoneNumber,join_date,address,gender,age)
            VALUES (:name, :email, :password,:phoneNumber,:join_date,:address,:gender,:age)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':name' => $_POST['name'],
        ':email' => $_POST['email'],
        ':password' => $_POST['password'],
        ':phoneNumber' => $_POST['phoneNumber'],
        ':join_date' => $_POST['join_date'],
        ':address' => $_POST['address'],
        ':gender' => $_POST['gender'],
        ':age' => $_POST['age']));
        echo "Check3...................................................................";
        // getting employee id 
        
        $stmt = $pdo->prepare("SELECT * FROM hr WHERE email = :em");
    
        $stmt->execute(array(
            ':em' => $_POST['email']));
        $row4 = $stmt->fetch(PDO::FETCH_ASSOC);

          $emid=(int)$row4['id'];
          $emid = htmlentities($row4['id']);
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
         ':type' => 'hr'));

        echo "Check5........................................";

        unset($_SESSION['success']);

        $_SESSION['name'] = $_POST['name'];
        $_SESSION['email'] = $_POST['email'];
        header( 'Location: success.php' ) ;
        return;
    }


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
<h1>Sign Up For Employee</h1>
        <form method="post" action="signup.php">
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
                    <td><input type="submit" name="submit" value="Sign Up"></td>
                    
                </tr>
            </table>
        </form>
        <!-- HR sign up form.............................................................. -->
        <h1>HR sign Up</h1>
        <form method="post" action="signup.php">
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
                    <td><label for="start">Phone Number:</label></td>
                    <td><input type="text" id="start" name="phoneNumber" placeholder="enter numbers" required ></td>                    
                </tr>
                <tr>    
                    <td><label for="start">Join date:</label></td>

                    <td><input type="date" name="join_date" placeholder="enter numbers" required></td>
                    
                </tr>
            
                <tr>    
                    <td>Address</td>
                    <td><input type="text" name="address" required></td>
                    
                </tr>
            
                <tr>    
                <td>Gender</td>
                <td>
                <select name="gender" id="">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                
                </td> 
                </tr>
                <tr>   
                    <td>Age:</td>
                    <td><input type="date" name="age" placeholder="Number"></td>
                    
                </tr>
                <tr>   
                    <td><input type="submit" name="submit_hr" value="Sign Up hr"></td>
                    
                </tr>
            </table>
        </form>

        <p>footer</p>
        
        
</body>
</html>



