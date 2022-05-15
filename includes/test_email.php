<?php
$to='ndungudennis250@gmail.com';
$subject='test';
$message='test';
$headers='From:The Agro-Market <a@gmail.com>\r\n';
$headers.='MIME-Version: 1.0'."\r\n";
$headers.='Content-type: text/html; charset=iso-8859-1'."\r\n";

mail($to,$subject,$message,$headers);
?>
