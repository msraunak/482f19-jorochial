<?php
require_once 'config.php';

$htmlOutput = "";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
//$bidder = array($_Post["username"],$_Post["email"],$_Post["password"],$_Post["fname"],$_Post["lname"]);
$bidder = array($_Post["fname"],$_Post["lname"],$_Post["email"],$_Post["username"],$_Post["pwd"]);

$sql = 'INSERT INTO Bidder (fname, lname, email, username, pwd) VALUES';

$bidder[0] = htmlspecialchars(trim($bid[0]));
$bidder[1] = htmlspecialchars(trim($bid[1]));
$bidder[2] = htmlspecialchars(trim($bid[2]));
$bidder[3] = htmlspecialchars(trim($bid[3]));
$bidder[4]= password_hash(htmlspecialchars(trim($bidder[4])), PASSWORD_DEFAULT);
$sql .= '("'.$bidder[0].'","'. $bidder[1] .'","'. $bidder[2] .'","'. $bidder[3] .'","'.$bidder[4].'")';
  $sql .= ";";
 if ($mysqli->query($sql) === TRUE) {
      $htmlOutput = "Success";
  }
  else{
    $htmlOutput .= "Failed ". $mysqli->error;
	echo "inside error";
  }
echo $htmlOutput;
?>
