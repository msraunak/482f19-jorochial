<?php

require_once 'config.php';

$htmlOutput = "No Post";

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}


//retrieve user entered information from form
$username = $password = "";

if(isset($_SERVER["REQUEST_METHOD"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  echo "inside";
  $username = htmlspecialchars(trim($_POST['username']));
  $password = htmlspecialchars(trim($_POST['password']));
  echo $username;

  //get information from Database
  $sql = 'SELECT * FROM Bidder WHERE username = "' . $username . '";';
  $result = $mysqli->query($sql);

  if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
      if ($username == $row["uname"]){
        //verify Password
        if (password_verify($password, $row["pwd"])){
          $htmlOutput = "True";
          exit();
        }else{
          $htmlOutput = "False";
        }
      }
      }
  }  else{
    echo $mysqli->connect_error;
    $userClass = $passwordClass= 'class="form-control is-invalid"';
  }
}
}

echo $htmlOutput;

$mysqli->close();
?>

