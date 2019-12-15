<?php
require_once '../config.php';
$mysqli = new mysqlii_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$statement = $mysqli_query($mysqli,"select * from Item ");
$json_array=array();
while($row = mysqli_fetch_assoc($result))
{
	$json_array[] = $row;
}

print(json_encode($json_array));
//mysqli_close($db);
?>
