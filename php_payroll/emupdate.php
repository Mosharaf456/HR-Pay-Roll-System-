<h3>Edit your information with correct value:</h3>
<?php
require_once "connection.php";
session_start();

if ( isset($_POST['submit'])  ) {
    // login table update
    $sql = "UPDATE login SET name = :name,
            password = :password
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':password' => $_POST['password'],
        ':id' => $_POST['id']));
   
    // employee table update
    $sql = "UPDATE employee SET name = :name,
            password = :password,age = :age, join_date = :join_date, quality = :quality, address = :address , salary = :salary
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':password' => $_POST['password'],
        ':age' => $_POST['age'],
        ':join_date' => $_POST['join_date'],
        ':quality' => $_POST['quality'],
        ':address' => $_POST['address'],
        ':salary' => $_POST['salary'],
        ':id' => $_POST['id']));
    $_SESSION['success4'] = 'Record updated';
    $_SESSION['email'] =$_POST['email'];
    $_SESSION['id'] = $_POST['id'];
    header( 'Location: emupdate.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing id";
  header('Location: employee.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM employee where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Wrong value id';
    header( 'Location: employee.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$p = htmlentities($row['password']);
$ag = htmlentities($row['age']);
$jd = htmlentities($row['join_date']);
$q = htmlentities($row['quality']);
$ad= htmlentities($row['address']);
// $sal= htmlentities($row['salary']);

$id = $row['id'];

// cancel and back to hr portal
// if ( isset($_POST['cancel'])){
//     $_SESSION['success4'] = 'Edit cancel';
//     // $_SESSION['success4'] = 'Record updated';
//     $_SESSION['email'] =$_POST['email'];
//     $_SESSION['id'] = $_POST['id'];
//     header( 'Location: employee.php' ) ;
//     return;
// }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
<p>Edit Employee Info:</p>
<form method="post">
<p>Name:
<input type="text" name="name" required value="<?= $n ?>"></p>
<p>Password:
<input type="password" name="password" required value="<?= $p ?>"></p>
<p>Age:
<input type="date" name="age" required value="<?= $ag ?>"></p>
<p>Join Date:
<input type="date" name="join_date" readonly required value="<?= $jd ?>"></p>
<p>Quality:
<input type="text" name="quality" required value="<?= $q ?>"></p>
<p>Address:
<input type="text" name="address" required value="<?= $ad ?>"></p>
<!-- <p>Salary:
<input type="text" name="salary" readonly required value="<?= $sal ?>"></p> -->

<!-- hidden input -->
<input type="hidden" name="id" value="<?= $id ?>">
<p><input type="submit" name= "submit" value="Update"/>
</p>
</form>

<form method="post" action="emupdate.php">
        <table>
            <tr>   
                <td><input type="submit" name="cancel" value="Cancel"></td>        
            </tr>
        </table>
 </form>
</body>
</html>
