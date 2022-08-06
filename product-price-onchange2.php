<?php include("admin/connection.php");
	
    $code = $_POST['prod_code'];
	
    $checkPrice = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$code'");
    $checkRow = mysqli_fetch_assoc($checkPrice);
    
    echo $checkRow['product_price'];
?>