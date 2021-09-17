<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$phpmailer =  new PHPMailer();
$phpmailer->isSMTP();
$phpmailer->Host = 'smtp.gmail.com';
$phpmailer->SMTPAuth = true;
$phpmailer->Port = 587;
$phpmailer->Username = 'parvexkhan88@gmail.com';
$phpmailer->Password = 'White@3047';

$phpmailer->setFrom('parvexkhan88@gmail.com');
$phpmailer->AddAddress('pkkhan120799@gmail.com');  // Add a recipient
$phpmailer->IsHTML(true);

$phpmailer->Subject = 'Here is the Subject';
$phpmailer->WordWrap = 50;
$phpmailer->Body = "This is in <b>successfully send</b>";
$phpmailer->AltBody = 'This is the body in plain text for non-HTML$phpmailer clients';
//$phpmailer->addAttachment('/home/acer/Downloads/index.jpeg');
$phpmailer->addAttachment('PHPMailer-master');

if (!$phpmailer->Send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
    exit;
}

echo 'Message has been sent';
