<?php
include 'config.php';
session_start();
require 'vendor/autoload.php';
if (!$_SESSION['login']) {
    header('location:index.php');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    echo $id;
    $sql = "SELECT  name, desc_prod,price,quantity from product where id='$id'";
    $result = mysqli_query($conn, $sql) or trigger_error(error_log('fhdfghsh'));
    //$row = $res->num_rows;
    //echo $sql;
    while ($row = mysqli_fetch_assoc($result)) {
        $name = $row['name'];
        $desc = $row['desc_prod'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $html = "<h3>invoice</h3></br>
            <h4>Product Name: $name </h4></br>
            <p>Product Desc :  $desc</p>
            <p>Product Desc :  $price</p>
            <p>Product Desc :  $quantity</p>
";
    }
}

use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation




// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($name);
