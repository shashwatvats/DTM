<?php
require 'additional/phpmailer/PHPMailerAutoload.php';

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'dtmakgec@gmail.com';                 // SMTP username
$mail->Password = 'ghaziabadakgec';                           // SMTP password
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to

$mail->setFrom('dtmakgec@gmail', 'DTM');
    // Add a recipient           // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML
?>
