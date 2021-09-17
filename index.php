<?php
session_start();
include 'config.php';
//include 'auth.php';
if (isset($_SESSION['login']) === TRUE) {
    header('location:dashshow.php');
}
$msg = "";




if (isset($_POST['signin'])) {
    $user = $_POST['username'];
    echo $user;
    $pass = bin2hex($_POST['password']);
    echo $pass;
    if (!empty($user)) {
        $sql = "SELECT username from users where username='$user' ";
        $result = mysqli_query($conn, $sql) or trigger_error("not execute");
        $rowCount = mysqli_num_rows($result);
        if ($rowCount > 0) {

            $sql = "SELECT password from users where username='$user' and password='$pass'";
            echo $sql;
            $result = $conn->query($sql) or trigger_error("not execute");
            $rowCount = mysqli_num_rows($result);

            if ($rowCount > 0) {
                $sql = "SELECT status from users where username='$user' and status='1'";
                $result = $conn->query($sql) or trigger_error("not execute");
                $rowCount = mysqli_num_rows($result);
                echo $sql;
                if ($rowCount > 0) {
                    $_SESSION['username'] = $user;
                    $_SESSION['login'] = TRUE;
                    header('location:dashshow.php');
                    //echo "<script>alert('user not found');</script>";

                } else {
                    $msg = "<script>alert('email not verified');</script>";
                    $_SESSION['email'] = $user;
                    echo "<script>alert('email not verified');</script>";
                    include 'emailverify.php';
                    //   echo $msg;
                }
            } else {
                echo "<script type='text/javascript'>alert('password does not match');</script>";
            }
        } else {
            echo "user not found";
        }
    } else {
        $msg = "please fill username ";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="./plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Admin</b> Signin</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form method="post">
                    <div class="input-group mb-3">
                        <input type="email" name="username" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div><span style="color:red;">
                            <?php echo $msg; ?>
                    </div></span>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="justify-content-center">

                        <!-- /.col -->
                        <div class="center">
                            <button type="submit" name="signin" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center mt-2 mb-3">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
                    </a>
                </div>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <a href="forgotpass.php">I forgot my password</a>
                </p>
                <p class="mb-0">
                    <a href="register.php" class="text-center">Register a new membership</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="./plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="./dist/js/adminlte.min.js"></script>
</body>

</html>