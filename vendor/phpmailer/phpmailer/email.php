<?php
$phpmailer = new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.mailtrap.io';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 2525;
$phpmailer->Username = '4a60d0b7322906';
$phpmailer->Password = 'd7b839b3e074ce';

$mail->From         = 'pkpk120799@gmail.com';
$mail->FromName     = 'Admin';
$mail->AddAddress('parvezkhan12799@gmail.com', 'Receiver');  // Add a recipient
$mail->IsHTML(true);

$mail->Subject = 'Here is the Subject';
$mail->WordWrap = 50;
$mail->Body = "This is in <b>Blod Text</b>";
$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

if (!$mail->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    exit;
}

echo 'Message has been sent';
