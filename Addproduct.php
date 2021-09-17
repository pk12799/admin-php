<?php
session_start();
include 'config.php';
if (isset($_SESSION['login']) !== TRUE) {
    header('location:index.php');
}


include 'nav.php';

?>
<?php
if (isset($_POST['Add_prod'])) {
    // File upload configuration 
    $price = $_POST['price'];
    $quant = $_POST['quantity'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $desc = $_POST['desc'];
    $sql = "INSERT INTO product (name, type_id,desc_prod,price,quantity) values('$name','$type','$desc','$price','$quant')";
    //echo $sql;
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
?>
<?php

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

        <div class="form-group">
            <form method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input name="name" type="text" class="form-control" placeholder="Product Name">
                </div>

                <div class="form-group">
                    <select class="selectpicker form-control" name="type">
                        <option value=""> Select Product Type </option>
                        <?php $sql = "SELECT id,name from type";

                        $result = $conn->query($sql) or trigger_error('type not');
                        $rows  = $result->num_rows;

                        if ($rows > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <option value="<?php echo htmlentities($row['id']); ?>"><?php echo htmlentities($row['name']); ?></option>
                        <?php }
                        } ?>

                    </select>
                </div>
        </div>
        <div class="form-group">
            <label for="exampleFormControlInput1">Product Description</label>
            <textarea class="form-control" placeholder="Product Description" name="desc" rows="3"></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price</label><i class="fas fa-rupee-sign"></i>
            <input type="number" name="price" class="form-control" placeholder="Product Price">

        </div>
        <div class="form-group">
            <label for="quantity">Product Quantity</label>
            <input type="number" name="quantity" class="form-control" placeholder="Product Quantity">
        </div>
        <div class="form-group">
            <label for="images">Select Images</label>
            <input type="file" name="upload_images[]" onchange="preview_image();" id="gallery-photo-add" multiple class="form-control-file">
            <div class="gallery"></div>
        </div>
        <div class="form-group">
            <button type="submit" name="Add_prod" class="btn btn-primary btn-block">Add Product</button>
        </div>
        </form>
    </div>
    </div>
    <script>
        CKEDITOR.replace('desc');
    </script>
    <script type="text/javascript">
        $(function() {
            // Multiple images preview in browser
            var imagesPreview = function(input, placeToInsertImagePreview) {
                if (input.files) {
                    var filesAmount = input.files.length;
                    for (i = 0; i < filesAmount; i++) {
                        var reader = new FileReader();
                        reader.onload = function(event) {
                            $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                        }
                        reader.readAsDataURL(input.files[i]);
                    }
                }
            };

            $('#gallery-photo-add').on('change', function() {
                imagesPreview(this, 'div.gallery');
            });
        });
    </script>
</body>


</html>