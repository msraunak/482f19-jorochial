<?php

#if email in db, else skip


require_once 'config.php';


$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}
 $to_email = $_GET['emailAddress'];


$sql = "SELECT * FROM Bidders WHERE email = '$to_email'";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
  $subject = $_GET['emailSubject'];
  $message = $_GET['emailMessage'];
  $headers = 'From: noreply@jorochial.cs.loyola.edu';
  mail($to_email,$subject,$message,$headers);
}



?>
