
<?php
session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"] !== true){
  //if not login in
  $_SESSION["secure_Attempt"] = true;
  header("location: index.php");
  exit();
}
session_destroy();   // function that destroys session
$_SESSION["loggedOut"] == true;
header("location: index.php");

?>
