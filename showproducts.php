<?php
session_start();
if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}

include 'config.php';
include 'nav.php';


if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    $page_no = $_GET['page_no'];
} else {
    $page_no = 1;
}
$total_records_per_page = 3;
$offset = ($page_no - 1) * $total_records_per_page;
$previous_page = $page_no - 1;
$next_page = $page_no + 1;
$adjacents = "2";
$result_count = mysqli_query(
    $conn,
    "SELECT COUNT(*) As total_records FROM product"
);
$total_records = mysqli_fetch_array($result_count);
$total_records = $total_records['total_records'];
$total_no_of_pages = ceil($total_records / $total_records_per_page);
$second_last = $total_no_of_pages - 1;


?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShowProducts</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">


    <div class="row ml-4 ">
        <?php
        $sql = "SELECT id,name,type_id,price,desc_prod,quantity FROM product LIMIT $offset, $total_records_per_page ";
        $result = mysqli_query($conn, $sql) or trigger_error(error_log('fhdfghsh'));
        //$row = $res->num_rows;
        //echo $sql;
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="card m-3" style="width: 22rem; height:auto;">


                <div id="carouselExampleControls <?php echo $row['product_id']; ?>" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $var = 0;
                        $prod_id = $row['id'];
                        $q = "select i_name from images where prod_id='$prod_id'";
                        $res = mysqli_query($conn, $q) or trigger_error(mysqli_error($conn));
                        while ($image = mysqli_fetch_array($res)) {
                        ?>
                            <div class="carousel-item <?php echo $var == 0 ? 'active' : ''; ?>">
                                <img src="uploads/<?php echo $image['i_name']; ?>" class="d-block w-100 card-img-top " height="250" width="150" alt="...">
                            </div>
                        <?php $var++;
                        } ?>
                    </div>

                </div>
                <div class="card-body">
                    <h1 class="card-title"> <a href="showproduct.php?id=<?php echo $row['id'] ?>" class="btn"><?php echo $row['name']; ?></a></h1>
                    <p class="card-text "><?php echo $row['desc_prod']; ?></p>
                    <p class="card-text fas fa-rupee-sign"><?php echo $row['price']; ?></p>
                    <p class="card-text">Quantity
                        <b class="h5"><?php echo $row['quantity']; ?></b>
                    </p>

                    <p class="card-text btn btn-danger card-link">
                        <a href="delete.php?id=<?php echo $row['id'] ?>" class="btn">delete</a>
                    </p>
                    <span class="span">
                        <p class=" btn btn-primary">
                            <a href="update.php?id=<?php echo $row['id'] ?>" class="btn">update</a>
                        </p>
                    </span>
                    <p class=" ">
                        <a href="invoice.php?id=<?php echo $row['id'] ?>" class="">invoice</a>
                    </p>
                </div>
            </div>
        <?php
        } ?>
        <!-- new car -->

        <!-- end -->

    </div>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <?php
            if ($page_no > 1) {
            ?>
                <a class="page-link" href="showproducts.php?page_no= <?php echo $previous_page; ?>">previous</a>
            <?php }

            ?>
            <?php
            if ($total_no_of_pages > $page_no) {
            ?>
                <a class="page-link" href="showproducts.php?page_no= <?php echo $next_page; ?>">Next</a>
            <?php } ?>



        </ul>
    </nav>
</body>


</html>