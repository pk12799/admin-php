<?php
session_start();
if (!isset($_SESSION['login'])) {
    header('location:index.php');
}
include 'config.php';



include 'nav.php';

if (isset($_POST['Addtype'])) {
    $type = $_POST['Prod_type'];
    if (!empty($type)) {
        $sql = "SELECT * from type where name='$type'";
        $res = $conn->query($sql);
        $rows = $res->num_rows;
        if ($rows > 0) {
            echo "<script>alert('product type alredy in list');</script>";
        } else {
            $sql = "INSERT INTO type (name) values('$type')";
            $res = mysqli_query($conn, $sql);
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
    <title>Add Product Type</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class=" container">
        <form method="post" class="row">
            <div class="col-md-10 col-12">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Product Type" name="Prod_type" required>

                </div>
                <div class="col-4">
                    <button type="submit" name="Addtype" class="btn btn-primary btn-block">Add Product Type</button>
                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class=" ">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * from type";
                    $res = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($res)) {
                        echo "
                    
                    <tr class=''>
  <td scope='row '> " . $row['id'] . "</td>
    <td scope='row'> " . $row['name'] . "</td>

  </tr>
  ";
                    } ?>

                </tbody>
            </table>
        </div>
    </div>

</body>

</html>