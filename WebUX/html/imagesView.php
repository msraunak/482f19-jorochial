<?php
//Utilizes techniques from Code Tube PDO object Blob work
//All in all allows for down load of image theoretically if separated
$dbh = new PDO("mysql:host=cs-database.cs.loyola.edu;dbname=jorochial", "jbennett", "1670682");
$id = isset($_GET['id'])? $_GET['id'] : "";
$stat = $dbh->prepare("select * from myblolb where id=?");
$stat->bindParam(1, $id);
$stat->execute();
$row = $stat->fetch();
header('Content-Type:' .$row['mime']);
echo $row['data'];
?>
