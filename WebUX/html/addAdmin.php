<?php
session_start();

require_once 'config.php';

$_SESSION["adminAdd"] = False;
$htmlOutput = "";


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
#echo "Connected successfully";
$user = array($_POST["newAdminEmail"],$_POST["newAdminFirstName"],$_POST["newAdminLastName"],$_POST["newAdminUsername"],$_POST["newAdminPassword"]);
#$user = array("hjfranceschi@loyola.edu","Herve","Franceschi","hjfranceschi","password");
# user should be from form
#| hjfranceschi@loyola.edu | Herve | Franceschi | hjfranceschi | password
if ($_POST["newAdminPassword"] == $_POST["newPassword2"]){
  $sql .= 'INSERT INTO admin(email, fname, lname, uname, pwd) VALUES';

  $user[0] = htmlspecialchars(trim($user[0]));
  $user[1] = htmlspecialchars(trim($user[1]));
  $user[2] = htmlspecialchars(trim($user[2]));
  $user[3] = htmlspecialchars(trim($user[3]));
  $user[4]= password_hash(htmlspecialchars(trim($users[4])), PASSWORD_BCRYPT);
  $sql .= '("'.$user[0].'","'. $user[1] .'","'. $user[2] .'","'. $user[3] .'","'. $user[4] .'")';
  $sql .= ";";
  #echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "Users added successfully";
  }
  else{
    $htmlOutput .= "Insertion Failed: ". $mysqli->error;

  }
  #echo $htmlOutput;
  $_SESSION["adminAdd"] = True;
}
else {
  #echo "vaildation fail";
  $_SESSION["adminAdd"] = False;
}
$htmlOutput = " Username: ".$user[3];
$_SESSION["adminMessage"] = $htmlOutput;
header("Location: http://jorochial.cs.loyola.edu/html/Settings.php");
exit;
?>
