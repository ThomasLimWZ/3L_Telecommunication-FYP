<?php include("admin/connection.php");
    $name = $_POST['prodName'];

    $result = mysqli_query($connect,"SELECT * FROM product WHERE product_name='$name'");
    $row = mysqli_fetch_assoc($result);

    echo $row['product_code'];
?>