
<h1>Distribute Payment:</h1>
<?php
require_once "connection.php";
session_start();

if ( isset($_POST['submit'])  ) {
// checking paid or not
    $stmt = $pdo->prepare("SELECT * FROM salary WHERE email = :em");

    $stmt->execute(array(
        ':em' => $_POST['email']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Check0";
    if($row == true){
        echo "Check1...............................................................";
        $_SESSION['success'] = 'Salary already delivered for current month ,Pay process access after this month ';
        header( 'Location: hr.php' ) ;
        return;
    }else{
    $sql = "INSERT INTO salary (id,name, email,paydate,total_amount)
    VALUES (:id,:name, :email, :paydate,:total_amount)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
    ':id' => $_POST['id'],
    ':name' => $_POST['name'],
    ':email' => $_POST['email'],
    ':paydate' => $_POST['paydate'],
    ':total_amount' => $_POST['total_amount']));
    echo "Check3...................................................................";
    $_SESSION['success'] = 'Salary delivered ';
    header( 'Location: hr.php' ) ;
    return;
    }
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['id']) ) {
  $_SESSION['error'] = "Missing HR id";
  header( 'Location: hr.php' ) ;
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

$id = $row['id'];
$n = htmlentities($row['name']);
$email = htmlentities($row['email']);
$pd = htmlentities($row['join_date']);
$td= htmlentities($row['salary']);


// cancel and back to hr portal
if ( isset($_POST['cancel'])){
    $_SESSION['success'] = 'Payment cancel';
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
<p>Payment Employee Info:</p>
<form method="post">
<p>Name:
<input type="text" name="name" readonly required value="<?= $n ?>"></p>
<p>Email:
<input type="email" name="email" readonly required value="<?= $email ?>"></p>
<p>Salary Amount TK:
<input type="text" name="total_amount" readonly required value="<?= $td ?>"></p>
<p> Enter pay Date:
<input type="date" name="paydate" required value="<?= $pd ?>"></p>
<!-- hidden input -->
<input type="hidden" name="id" value="<?= $id ?>">
<p><input type="submit" name= "submit" value="Confirmed pay"/>
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
