<?php
require_once "connection.php";
session_start();

if ( isset($_POST['submit'])  ) {
     // Salary table update
    $sql = "UPDATE salary SET total_amount = :total_amount
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    ':total_amount' => $_POST['salary1'],
    ':id' => $_POST['id']));

    // employee table update
    $sql = "UPDATE employee SET salary = :salary
            WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':salary' => $_POST['salary1'],
        ':id' => $_POST['id']));

    // // Salary table update
    // $sql = "UPDATE salary SET total_amount = :salary
    //         WHERE id = :id";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(array(
    //     ':salary' => $_POST['salary']));

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

$stmt = $pdo->prepare("SELECT * FROM employee where id = :xyz");
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
$ag = htmlentities($row['age']);
$jd = htmlentities($row['join_date']);
$sal= htmlentities($row['salary']);

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
<p>Increment or  Deduction Employee Info:</p>
<form method="post">
    <p>Name:
    <input type="text" name="name" readonly required value="<?= $n ?>"></p>
    <p>Age:
    <input type="date" name="age" readonly required value="<?= $ag ?>"></p>
    <p>Join Date:
    <input type="date" name="join_date" readonly required value="<?= $jd ?>"></p>

    <p>Salary Deduction /<br> Increment with net balance:
    <input type="text" name="salary1" required value="<?= $sal ?>"></p>

    <!-- hidden input -->

    <input type="hidden" readonly name="id" value="<?= $id ?>"> 

    <p><input type="submit" name= "submit" value="Confirm"/>
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
