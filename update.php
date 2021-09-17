<?php
session_start();
include 'config.php';
if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}


include 'nav.php';

?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_POST['update'])) {
        // File upload configuration 
        $price = $_POST['price'];
        $quant = $_POST['quantity'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $desc = $_POST['desc'];
        $sql = "update product set name ='$name', type_id ='$type',desc_prod='$desc',price='$price',quantity='$quant' where id='$id'";

        $res = mysqli_query($conn, $sql) or trigger_error('error on add');
        $lastid = $conn->insert_id;

        $uploadsDir = "uploads/";
        $allowedFileType = array('jpg', 'png', 'jpeg');

        // Velidate if files exist
        if (!empty(array_filter($_FILES['upload_images']['name']))) {
            // Loop through file items
            foreach ($_FILES['upload_images']['name'] as $id => $val) {
                // Get files upload path


                $fileName        = $_FILES['upload_images']['name'][$id];
                $tempLocation    = $_FILES['upload_images']['tmp_name'][$id];
                $fileType        = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                $uploadDate      = date('dmyhms');
                $fileName          = "$uploadDate$fileName";
                $targetFilePath  = $uploadsDir . $fileName;
                //echo $fileType, $allowedFileType;
                if (in_array($fileType, $allowedFileType)) {
                    if (move_uploaded_file($tempLocation, $targetFilePath)) {
                        $sqlVal = "$fileName";
                        $sql = "INSERT into images(i_name,prod_id) values('$sqlVal','$lastid')";
                        //              echo $sql;
                        $res = mysqli_query($conn, $sql);
                    } else {
                        $response = array(
                            "status" => "alert-danger",
                            "message" => "File coud not be uploaded."
                        );
                    }
                } else {
                    echo "nahi";
                    $response = array(
                        "status" => "alert-danger",
                        "message" => "Only .jpg, .jpeg and .png file formats allowed."
                    );
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="container">
        <?php
        $sql = "SELECT name,desc_prod, type_id,price,quantity from product where id='$id'";

        $res = mysqli_query($conn, $sql);
        if ($row = mysqli_fetch_assoc($res)) {
        ?>
            <div class="form-group">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input name="name" value="<?php echo $row['name']; ?>" type="text" class="form-control" placeholder="Product Name">
                    </div>
                    <?php
                    $t_id = $row['type_id'];
                    $q  = "select name from type where id='$t_id'";
                    $r = mysqli_query($conn, $q);
                    //echo $q.$row['price'];
                    if ($rows = mysqli_fetch_assoc($r)) {
                    ?>
                        <div class="form-group">
                            <select class="selectpicker form-control" name="type">
                                <?php $sql = "SELECT id,name from type";

                                $result = $conn->query($sql) or trigger_error('type not');
                                $rows  = $result->num_rows;

                                if ($rows > 0) {
                                    while ($rows = mysqli_fetch_assoc($result)) {
                                ?>
                                        <option <?php echo $row['type_id'] == $rows['id'] ? 'selected' : ''; ?> value="<?php echo htmlentities($rows['id']); ?>"><?php echo htmlentities($rows['name']); ?></option>
                                <?php }
                                }

                                ?>

                            </select>
                        </div>
                    <?php } ?>

            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">Product Description<?php  ?></label>
                <textarea class="form-control" placeholder="Product Description" name="desc" rows="3"><?php echo $row['desc_prod']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="price">Product Price</label><i class="fas fa-rupee-sign"></i>
                <input type="number" name="price" class="form-control" value="<?php echo $row['price']; ?>" placeholder="Product Price">

            </div>
            <div class="form-group">
                <label for="quantity">Product Quantity</label>
                <input type="number" name="quantity" class="form-control" value="<?php echo $row['quantity']; ?>" placeholder="Product Quantity">
            </div>
            <div class="form-group">
                <label for="images">Select Images</label>
                <input type="file" name="upload_images[]" multiple class="form-control-file">
            </div>
            <div class="form-group">
                <button type="submit" name="update" class="btn btn-primary btn-block">Add Product</button>
            </div>
            </form>
        <?php

        }
        ?>
    </div>
    </div>
    <script>
        CKEDITOR.replace('desc');
    </script>

</body>


</html>