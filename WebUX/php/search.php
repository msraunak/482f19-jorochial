<?php

require_once 'config.php';

$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " .  $mysqli->connect_error);
}

if(isset($_GET["query"])){
  $query = htmlspecialchars($_GET["query"]);
}else{
  $query = htmlspecialchars("Car");
}


  $htmlResult = "[";
  $sql = "SELECT * from Item where (itemName like '%$query%') order by itemName";
  $result = $mysqli->query($sql);
  if ($result->num_rows <= 0) {
      $sql = "SELECT * from Item where (description like '%$query%')";
      $result = $mysqli->query($sql);
  }
  echo $mysqli->error;
  while( $row = $result->fetch_assoc( ) ){
     $htmlResult .= json_encode($row);
     $htmlResult.=",";

  }
	$htmlResult = substr($htmlResult,0,-1);
	$htmlResult.=']';
	echo $htmlResult;

?>
