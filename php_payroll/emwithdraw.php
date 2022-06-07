<h3>Employee payment withdraw portal for employee</h3>
<?php
require_once "connection.php";
session_start();

if ( isset($_POST['submit'])  ) {
    //checking

    $sql = "SELECT total_amount FROM salary WHERE id = :id ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
        ':id' => $_POST['id']));
    $row1 = $stmt->fetch(PDO::FETCH_ASSOC);
    $balance= $row1['total_amount']; 
    if ( $row1 == false || $balance == 0) {
        // echo "Wrong email/password";
        $_SESSION['success4'] = 'Balance not paid by Hr or your balance 0 Tk, Cannot withdraw in this month';
        $_SESSION['email'] =$_POST['email'];
        $_SESSION['id'] = $_POST['id'];
        header( 'Location: emupdate.php' ) ;
        return;
    }else{
        // Salary table withdraw update
        $sql1 = "UPDATE salary SET withdraw = :withdraw ,bankname = :bankname
        WHERE id = :id";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute(array(
        ':withdraw' => $_POST['withdraw'],
        ':bankname' => $_POST['bankname'],
        ':id' => $_POST['id'] ));
        // error line 31

        // $row2nd = $stmt1->fetch(PDO::FETCH_ASSOC);

        // if($row2nd == true){
        // after withdraw update  // Salary table total_amount 
        $var=0;
        $sql = "UPDATE salary SET total_amount = :total_amount
        WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
        ':total_amount' => $var,
        ':id' => $_POST['id'] ));
        $_SESSION['success4'] = 'Record updated';
        $_SESSION['email'] =$_POST['email'];
        $_SESSION['id'] = $_POST['id'];
        header( 'Location: emupdate.php' ) ;
        return;
            
        // }
        // else{
            $_SESSION['success4'] = 'Withdraw Later';
            $_SESSION['email'] =$_POST['email'];
            $_SESSION['id'] = $_POST['id'];
            header( 'Location: emupdate.php' ) ;
            return;

            // }
        
     }


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
$em = htmlentities($row['email']);
// $jd = htmlentities($row['join_date']);
$q = htmlentities($row['quality']);
$ad= htmlentities($row['address']);
$sal= htmlentities($row['salary']);

$id = $row['id'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit user</title>
</head>
<body>
<p>Your Payment Info:</p>
<form method="post">
    <p>Name:
    <input type="text" name="name" readonly required value="<?= $n ?>"></p>
    <p>Email:
    <input type="text" name="email" readonly required value="<?= $em ?>"></p>
    <!-- <p>Join Date:
    <input type="date" name="join_date" readonly readonly required value="<?= $jd ?>"></p> -->
    <p>Quality:
    <input type="text" name="quality" readonly required value="<?= $q ?>"></p>
    <p>Address:
    <input type="text" name="address" readonly required value="<?= $ad ?>"></p>
    <p>Balance:
    <input type="text" name="withdraw" readonly required value="<?= $sal ?>"></p>
    <p>Select bank name:
    <select name="bankname">
        <option value="Dhaka Bank Limited">Dhaka Bank Limited</option>
        <option value="United Comercial Bank Limited">United Comercial Bank Limited</option>
        <option value="National Bank Limited">National Bank Limited</option>
    </select>
    </p>


    <!-- hidden input -->
    <input type="hidden" name="id" value="<?= $id ?>">
    <p><input type="submit" name= "submit" value="Confirm withdraw"/>
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
