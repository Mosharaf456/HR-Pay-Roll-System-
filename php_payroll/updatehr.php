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
    $sql = "UPDATE hr SET name = :name,
            password = :password,phoneNumber = :phoneNumber, join_date = :join_date, address = :address , gender = :gender, age = :age
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':name' => $_POST['name'],
        ':password' => $_POST['password'],
        ':phoneNumber' => $_POST['phoneNumber'],
        ':join_date' => $_POST['join_date'],
        ':address' => $_POST['address'],
        ':gender' => $_POST['gender'],
        ':age' => $_POST['age'],
        ':id' => $_POST['id']));
    $_SESSION['success'] = 'Record updated';
    header( 'Location: hr.php' ) ;
    return;
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing HR id";
  header('Location: hr.php');
  return;
}

$stmt = $pdo->prepare("SELECT * FROM hr where id = :xyz");
$stmt->execute(array(":xyz" => $_GET['id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Wrong value id';
    header( 'Location: hr.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$n = htmlentities($row['name']);
$p = htmlentities($row['password']);
$phn = htmlentities($row['phoneNumber']);
$jd = htmlentities($row['join_date']);
$ad= htmlentities($row['address']);
$gen= htmlentities($row['gender']);
$ag= htmlentities($row['age']);

$id = $row['id'];

// cancel and back to hr portal
if ( isset($_POST['cancel'])){
    $_SESSION['success'] = 'Edit cancel';
        header( 'Location: hr.php' ) ;
        return;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
<p>Edit HR Info:</p>
<form method="post">
<p>Name:
<input type="text" name="name" required value="<?= $n ?>"></p>
<p>Password:
<input type="password" name="password" required value="<?= $p ?>"></p>
<p>Phone Number:
<input type="text" name="phoneNumber" required value="<?= $phn?>"></p>
<p>Join Date:
<input type="date" name="join_date" required value="<?= $jd ?>"></p>
<p>Address:
<input type="text" name="address" required value="<?= $ad ?>"></p>
<p>Gender:
<input type="text" name="gender" required value="<?= $gen ?>"></p>
<p>Age:
<input type="text" name="age" required value="<?= $ag ?>"></p>

<!-- hidden input -->
<input type="hidden" name="id" value="<?= $id ?>">
<p><input type="submit" name= "submit" value="Update"/>
</p>
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
