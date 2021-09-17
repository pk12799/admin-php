<?php
include 'config.php';
session_start();
if (!$_SESSION['login']) {
    header('location:index.php');
}
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "select id, i_name from images where prod_id='$id'";
    echo $sql;
    $dir = "uploads/";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)) {
        echo $row['i_name'];
        $i = $row['id'];
        $url = $dir . $row['i_name'];
        echo $url;
        unlink($url);
        $sq = "delete from images where id='$i'";
        echo $sq;
        $r = mysqli_query($conn, $sq);
        if ($r) {
            echo "succes";
        }
    }

    $sql = "DELETE from product where id='$id'";
    echo $sql;
    $res = mysqli_query($conn, $sql);
    if ($res) {
        header('location:showproducts.php');
    } else {
        echo "failed";
    }
}
