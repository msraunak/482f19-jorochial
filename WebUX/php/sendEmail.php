<?php


#$bid = $_GET["bidId"];

 $to_email = 'arschilke@loyola.edu';
 $subject = 'Testing PHP Mail';
 $message = 'This mail is sent using the PHP mail function';
 $headers = 'From: noreply @ company . com';
 mail($to_email,$subject,$message,$headers);

?>
