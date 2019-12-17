<?php

 $to_email = $_GET['emailAddress'];
 $subject = $_GET['emailSubject'];
 $message = $_GET['emailMessage'];
 $headers = 'From: noreply@jorochial.cs.loyola.edu';
 mail($to_email,$subject,$message,$headers);

?>
