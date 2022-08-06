<?php include("admin/connection.php");
    $compareProd1 = $_POST['prod1_selected'];
    $compareProd2 = $_POST['prod2_selected'];

    $checkCat1_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$compareProd1'");
    $checkCat1_row = mysqli_fetch_assoc($checkCat1_res);

    $checkCat2_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$compareProd2'");
    $checkCat2_row = mysqli_fetch_assoc($checkCat2_res);

    if($checkCat1_row['cat_name'] != $checkCat2_row['cat_name']){
        echo "1";
    }
    else{
        echo "0";
    }
?>