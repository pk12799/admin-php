<?php
session_start();
if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}

include 'config.php';
include 'nav.php';

//print_r($_SESSION['login']);

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowProduct</title>

</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <?php
    $id = $_GET['id'];
    $sql = "SELECT id,name,type_id,price,desc_prod,quantity FROM product where id='$id'";
    $result = mysqli_query($conn, $sql) or trigger_error(error_log('fhdfghsh'));
    //$row = $res->num_rows;
    //echo $sql;
    while ($row = mysqli_fetch_assoc($result)) {
    ?>

        <div class="container">
            <div id="carouselExampleControls <?php echo $row['product_id']; ?>" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php $var = 0;
                    $prod_id = $row['id'];
                    $q = "select i_name from images where prod_id='$prod_id'";
                    $res = mysqli_query($conn, $q) or trigger_error(mysqli_error($conn));
                    while ($image = mysqli_fetch_array($res)) {
                    ?>
                        <div class="carousel-item <?php echo $var == 0 ? 'active' : ''; ?>">
                            <img src="uploads/<?php echo $image['i_name']; ?>" class="d-block w-100 card-img-top " height="450" alt="...">
                        </div>
                    <?php $var++;
                    } ?>
                </div>
            </div>
            <div class="container">
                <div class="h2 m-4 font-large">Product Name :<?php echo $row['name']; ?></div>
                <p class=" justify-content-right">
                    <a href="invoice.php?id=<?php echo $row['id'] ?>" class="">invoice</a>
                </p>
            </div>
            <div class="container">
                <div class="p m-4" style="font-size: large;">Product Desc : <?php echo $row['desc_prod']; ?></div>
            </div>
            <div class="container">
                <div class="p m-4" style="font-size: large;">Product price : <?php echo $row['price']; ?></div>
            </div>
            <div class="container">
                <div class="p m-4" style="font-size:large;">Product Quantity : <?php echo $row['quantity']; ?></div>
            </div>
        </div>

        <!--Section: Block Content-->

        <!--Section: Block Content-->
    <?php
    } ?>
    <!-- new car -->

    <!-- end -->

    </div>

</body>


</html>