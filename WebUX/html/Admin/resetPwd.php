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

//Selects passwor dof that user
$sqlValidateCredentials = "SELECT * from admin where uname = $username";
$result = $mysqli->query($sqlValidateCredentials);

//Does that user exist
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $trueCurrentPassword = $row['pwd'];
    }

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
          header("Refresh:5; url=Settings.php");
          exit;
        }

      }
      else {
        echo '<script language="javascript">';
        echo 'alert("Sorry your password does not match")';
        echo '</script>';
        header("Refresh:5; url=Settings.php");
        exit;
      }

    }
}
else{
  echo '<script language="javascript">';
  echo 'alert("hmmmm")';
  echo '</script>';
}

goto end;

a:
  echo '<script language="javascript">';
  echo 'alert("Sorry those passwords do not match")';
  echo '</script>';
  header("Refresh:5 ; url=Settings.php");
  exit;

b:
  echo '<script language="javascript">';
  echo 'alert("Please enter the correct credentials")';
  echo '</script>';
  header("Refresh:5; url=Settings.php");
  exit;





  end:
  echo '<script language="javascript">';
  echo 'window.location.reload()';
  echo '</script>';
  header("Refresh:5; url=Settings.php");
  exit;

/*
$_SESSION["resetPassword"] = False;
$htmlOutput = "";

$unameFromSettings = $_POST['resetUsername'];


// Check connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//Determines if uname exists
$sqlTest = 'SELECT pwd from admin where uname = "'.$_POST['resetUsername'].'"';
$resultUname = $mysqli->query($sqlTest);
if ($resultUname->num_rows = 1) {
    $htmlOutput .= "That's the right username";
}
else{
    $htmlOutput .= "That was the wrong username";
    $_SESSION["resetPassword"] = $htmlOutput;
    //header("Location: http://jorochial.cs.loyola.edu/html/Settings.php");
    //exit;
}

//Populates row with user profile; username and password
$row = $resultUname->fetch_assoc( );
$hashedPassword = $row['password'];

//If passwords match
if ($_POST["newPwd1"] == $_POST["newPwd2"]){

      //Verifies username password
      if(password_verify($_POST['currentPwd'], $hashedPassword )){

        $newHashedPassword = password_hash($_POST['newPwd1'], PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE admin set pwd = '$newHashedPassword' where uname = '$unameFromSettings'";
        //$resultPassword = $mysqli->query($sqlUpdate);

        #echo $sql;
        if ($mysqli->query($sqlUpdate) === TRUE) {
            $htmlOutput .= "Users added successfully";
        }
        else{
          $htmlOutput .= "Insertion Failed: ". $mysqli->error;
        }

        #echo $htmlOutput;
        $_SESSION["resetPassword"] = True;

      }
      else{
        $htmlOUtput .= "Passwords do not match";
        $_SESSION["resetPassword"] = False;
      }

    }
else {
  #echo "vaildation fail";
  $_SESSION["resetPassword"] = False;
}


$htmlOUtput = "Password is " .$newHashedPassword;
$_SESSION["passwordMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Settings.php");
exit;
*/


?>
