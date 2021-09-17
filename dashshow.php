<?php
session_start();
include 'config.php';

if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}

include 'nav.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>


</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <?php

    ?>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM product";
                            $res = mysqli_query($conn, $sql);
                            $count = $res->num_rows;


                            ?>
                            <h3><?php echo $count;  ?></h3>

                            <p>Total Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="showproducts.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->

                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">

                            <?php
                            $sql = "SELECT * FROM users";
                            $res = mysqli_query($conn, $sql);
                            $count = $res->num_rows;
                            ?>
                            <h3><?php echo $count ?></h3>

                            <p>Admin</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <?php
                            $sql = "SELECT * FROM type";
                            $res = mysqli_query($conn, $sql);
                            $count = $res->num_rows;
                            ?>
                            <h3><?php echo $count ?></h3>

                            <p>Product Type</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="AddProductType.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->

            <!-- /.card -->

            <!-- DIRECT CHAT -->



            <!-- Contacts are loaded here -->

            <!--/.direct-chat -->

            <!-- TO DO List -->

            <!-- /.Left col -->
            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->


        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        <!-- jQuery -->

        <!-- Bootstrap 4 -->

</body>

</html>