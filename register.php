<?php
include 'config.php';
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$phpmailer =  new PHPMailer();

if (isset($_POST['Singup'])) {
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];
    $name = $_POST['fname'];
    //email




    //email end
    if (!empty($email)) {
        $sql = "SELECT username from users where username='$email'";
        $res = mysqli_query($conn, $sql);
        $count = $res->num_rows;
        if ($count > 0) {
            $msg = "<script>alert('email alredy reguistered, try to signin')</script>";
            echo $msg;
        } else {
            if ($pass === $cpass) {
                //email start
                $_SESSION['email'] = $email;
                //echo $email;
                $phpmailer->isSMTP();
                $phpmailer->Host = 'smtp.mailtrap.io';
                $phpmailer->SMTPAuth = true;
                $phpmailer->Port = 587;
                $phpmailer->Username = '4a60d0b7322906';
                $phpmailer->Password = 'd7b839b3e074ce';
                //$email = 'parvezkhan12799@gmail.com';
                $phpmailer->setFrom('parvexkhan88@gmail.com');
                $phpmailer->AddAddress($email);  // Add a recipient
                $phpmailer->IsHTML(true);
                $_SESSION['otp'] = substr(str_shuffle("0123456789"), 0, 5);
                $phpmailer->Subject = 'verify otp for singup';
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


                //email end
                //            if(){
                $pass = bin2hex($pass);
                $sql = "INSERT into users(fname, username,password) values('$name','$email','$pass')";
                $q = mysqli_query($conn, $sql);
                if ($q) {
                    echo "<script>alert('user registered successfully, try signin');</script>";
                    header('location:otpverify.php');
                }
            }
        }
    }
}


?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration Page</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="fname" placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" required="required" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Retype password" name="cpassword" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" name="Singup" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="index.php" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
</body>

</html>