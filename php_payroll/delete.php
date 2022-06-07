<?php
require_once "connection.php";
session_start();

if ( isset($_POST['delete'])) {
    // login deleting 
    $sql = "DELETE FROM login WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_POST['id']));

    // Employee deleting
    $sql = "DELETE FROM employee WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(':id' => $_POST['id']));
    
    $_SESSION['success'] = 'Record deleted';
    $_SESSION['email'] = "";
    header( 'Location: hr.php' ) ;
    return;
}


// Guardian: Make sure that hr_id is present
if ( ! isset($_GET['id']) ) {
    $_SESSION['error'] = "Missing employee id";
    header('Location: hr.php');
    return;
  }
  
  $stmt = $pdo->prepare("SELECT * FROM employee where id = :xyz");
  $stmt->execute(array(":xyz" => $_GET['id']));
  $row = $stmt->fetch(PDO::FETCH_ASSOC);
  if ( $row === false ) {
      $_SESSION['error'] = 'Wrong value user_id';
      header( 'Location: hr.php' ) ;
      return;
  }
  
  // Flash pattern or message
  if ( isset($_SESSION['error']) ) {
      echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
      unset($_SESSION['error']);
  }

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
    <title>Delete employee</title>
</head>
<body>
<p>Confirm: Deleting <?= htmlentities($row['name']) ?></p>

<form method="post" action="delete.php">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<input type="submit" value="Confirm Delete" name="delete">

</form>

<form method="post" action="add.php" style="margin-top: 10px;">
        <table>
            <tr>   
                <td><input type="submit" name="cancel" value="Cancel"></td>        
            </tr>
        </table>
 </form>
</body>
</html>

