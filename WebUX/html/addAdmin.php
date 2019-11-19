<?php
$mysqli = new mysqli( "cs-database.cs.loyola.edu", "arschilke", "1737341", "jorochial" );
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
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
  echo $sql;
  if ($mysqli->query($sql) === TRUE) {
      $htmlOutput .= "<p>Users added successfully.</p>";
  }
  else{
    $htmlOutput .= "Insertion Failed: ". $mysqli->error;
  }
  echo $htmlOutput;
}
else {
  echo "vaildation fail";
}
?>
