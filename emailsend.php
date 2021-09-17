<?php
session_start();
include 'config.php';
if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
$phpmailer =  new PHPMailer();
include 'nav.php';


if (isset($_POST['Send'])) {
    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $desc = $_POST['desc'];
    $tempname = $_FILES["upload"]["tmp_name"];
    $filename = $_FILES["upload"]["name"];

    //$target = $tempname . $filename;



    //Load Composer's autoloader

    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.gmail.com';
    $phpmailer->SMTPAuth = true;
    $phpmailer->Port = 587;
    $phpmailer->Username = 'parvexkhan88@gmail.com';
    $phpmailer->Password = 'White@3047';

    $phpmailer->setFrom('parvexkhan88@gmail.com');
    $phpmailer->AddAddress($to);  // Add a recipient
    $phpmailer->IsHTML(true);

    $phpmailer->Subject = $subject;
    $phpmailer->WordWrap = 150;
    $phpmailer->Body = $desc;
    $phpmailer->AltBody = 'This is the body in plain text for non-HTML$phpmailer clients';
    //$phpmailer->addAttachment('/home/acer/Downloads/index.jpeg');
    $phpmailer->addAttachment($tempname, $filename);

    if (!$phpmailer->Send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
        exit;
    }
    header('location:emailsend.php');
    //echo '<b>Message has been sent</b>';
}

?>
<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send emails</title>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">

        <div class="form-group">
            <h3>Compose new Mails</h3>
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="to">To:</label>
                    <input name="to" type="text" class="form-control" placeholder="To">
                </div>

                <div class="form-group">
                    <input name="subject" type="text" class="form-control" placeholder="Subject">
                </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Body</label>
            <textarea class="form-control" placeholder="Product Description" name="desc" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="file">Select</label>
            <input type="file" name="upload" multiple class="form-control-file">
        </div>
        <div class="form-group">
            <button type="submit" name="Send" class="btn btn-primary btn-block">Send Mails</button>
        </div>
        </form>
    </div>
    </div>
    <script>
        CKEDITOR.replace('desc');
    </script>

</body>


</html>