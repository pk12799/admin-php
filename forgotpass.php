<?php
session_start();
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$phpmailer =  new PHPMailer();
if (isset($_POST['send'])) {
    $email = $_POST['email'];
    //echo $email;
    if (!empty($email)) {
        $sql = "SELECT username from users where username='$email'";
        $res = mysqli_query($conn, $sql);
        $count = $res->num_rows;
        // echo $email;
        if ($count > 0) {
            //$msg = "<script>alert('email alredy reguistered, try to signin')</script>";
            //  echo $msg;

            $_SESSION['email'] = $email;
            //echo $email;
            //print_r($_SESSION['email']);
            $phpmailer->isSMTP();
            $phpmailer->Host = 'smtp.gmail.com ';
            $phpmailer->SMTPAuth = true;
            $phpmailer->Port = 587;
            $phpmailer->Username = 'parvexkhan88@gmail.com';
            $phpmailer->Password = 'White@3047';
            //$email = 'parvezkhan12799@gmail.com';
            $phpmailer->setFrom('parvexkhan88@gmail.com');
            $phpmailer->AddAddress($email);  // Add a recipient
            print_r($email);
            $phpmailer->IsHTML(true);
            $_SESSION['otp'] = substr(str_shuffle("0123456789"), 0, 5);
            $phpmailer->Subject = 'verify otp for password change';
            $phpmailer->WordWrap = 50;
            $otp = $_SESSION['otp'];
            $phpmailer->Body = "This is your otp <b>$otp</b>";
            $phpmailer->AltBody = 'This is the body in plain text for non-HTML$phpmailer clients';
            //$phpmailer->addAttachment('/home/acer/Downloads/index.jpeg');
            //$phpmailer->addAttachment('PHPMailer-master');

            if (!$phpmailer->Send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $phpmailer->ErrorInfo;
                exit;
            }

            header('location:forgotpassverify.php');
            //email end
            //            if(){
        }
    }
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Forgot Password</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Admin</b>LTE</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" name="send" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 mb-1">
                    <a href="index.php">Login</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="dist/js/pages/dashboard.js"></script>
</body>

</html>