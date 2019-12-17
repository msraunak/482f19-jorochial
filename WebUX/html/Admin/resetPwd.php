<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';

//User entered values to validate
$username = $_POST['resetUsername'];
$userCurrentPassword = $_POST['currentPwd'];
$newPassword1 = $_POST['newPwd1'];
$newPassword2 = $_POST['newPwd2'];
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//Selects password of that user
$sqlValidateCredentials = "SELECT * from admin where uname = '$username'";
$result = $mysqli->query($sqlValidateCredentials);

//Does that user exist
if ($result->num_rows > 0) {
    // Gets password in database taht matches that username
    while($row = $result->fetch_assoc()) {
        $trueCurrentPassword = $row['pwd'];
    }

    //Determines if passwords match of user
    if ($newPassword1 !== $newPassword2) {
      goto a;
    }
    else { //User passwords match

      //Check if password matches official PASSWORD_DEFAULT
      if (password_verify($newPassword1, $trueCurrentPassword)) {

        $hashedPassword = password_hash($newPassword1, PASSWORD_DEFAULT);
        $sqlUpdatePassword = "UPDATE admin set pwd = '$hashedPassword' where uname = '$username'";

        //Determines if password user entered matches databases
        if($mysqli->query($sqlUpdatePassword)){
          echo '<script language="javascript">';
          echo 'alert("Password successfully changed")';
          echo '</script>';
          header("Refresh:1; url=http://jorochial.cs.loyola.edu/html/Settings.php");
        }

      }
      else {
        echo '<script language="javascript">';
        echo 'alert("Sorry your password does not match database")';
        echo '</script>';
        header("Refresh:1; url=http://jorochial.cs.loyola.edu/html/Settings.php");
      }

    }
}
else{
  echo '<script language="javascript">';
  echo 'alert("That username does not exist! Please try again")';
  echo '</script>';
}

goto end;

a:
  echo '<script language="javascript">';
  echo 'alert("Sorry those passwords do not match")';
  echo '</script>';
  header("Refresh:1 ; url=http://jorochial.cs.loyola.edu/html/Settings.php");

b:
  echo '<script language="javascript">';
  echo 'alert("Please enter the correct credentials")';
  echo '</script>';
  header("Refresh:1; url=http://jorochial.cs.loyola.edu/html/Settings.php");

end:
  header("Refresh:0; url=http://jorochial.cs.loyola.edu/html/Settings.php");

?>
