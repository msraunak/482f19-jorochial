<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: ../index.php");
  exit();
}
require_once '../config.php';
$_SESSION["resetPassword"] = False;
$htmlOutput = "";


// Check connection
$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

//Determines if uname exists
$sqlTest = 'SELECT uname, pwd from admin where uname = "'.$_POST['resetUsername'].'"';
$resultUname = $mysqli->query($sqlTest);
if ($resultUname->num_rows = 1) {
    $result = $mysqli->query($sql);
}
else{
    $htmlOutput = "That was the wrong username";
    $_SESSION["resetPassword"] = $htmlOutput;
    header("Location: http://jorochial.cs.loyola.edu/html/Settings.php");
    exit;
}

//Populates row with user profile; username and password
$row = $resultUname->fetch_assoc( );
$hashedPassword = $row['password'];

//If passwords match
if ($_POST["newPwd1"] == $_POST["newPwd2"]){

      //Verifies username password
      if(password_verify($_POST['currentPwd'], $hashedPassword )){

        $newHashedPassword = password_hash($_POST['newPwd1'], PASSWORD_DEFAULT);
        $sqlUpdate = "UPDATE admin set pwd = '$newHashedPassword'";
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

    }
else {
  #echo "vaildation fail";
  $_SESSION["resetPassword"] = False;
}




$_SESSION["adminMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Settings.php");
exit;
?>
