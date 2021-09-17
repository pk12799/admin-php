<?php
session_start();
include 'config.php';

$email = $_SESSION['email'];
if (isset($_POST['Verify'])) {
    $votp = $_POST['otp'];

    if ($votp === $_SESSION['otp']) {
        $sql = "UPDATE users set status='1' where username='$email'";
        if ($conn->query($sql)) {
            $msg = "<script>alert('now you can login);</script>";
            echo $msg;
            unset($_SESSION['email']);
            unset($_SESSION['otp']);
            //  unset($_SESSION['email']);  

            header('location:index.php');
        } else {
            echo "error on update";
        }
    } else {
        echo "please fill correct otp";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>verify User</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body>
    <div class="container">
        <h3>OTP send to your email <?php echo $email; ?></h3>
        <form method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" value="<?php echo $email; ?>">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mb-3">
                <input type="text" class="form-control" name="otp" required="required">
                <div class="input-group-append">
                    <div class="input-group-text">

                    </div>
                </div>



                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" name="Verify" class="btn btn-primary btn-block">Verify OTP</button>
                </div>
                <!-- /.col -->

        </form>
    </div>
</body>
<!-- jQuery -->
<script src="./plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="./dist/js/adminlte.min.js"></script>

</html>