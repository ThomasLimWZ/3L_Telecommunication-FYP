<?php include("admin/connection.php");
	
	$code = $_POST['cap_selected'];
	
    $checkPrice = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$code'");
    $checkRow = mysqli_fetch_assoc($checkPrice);
    
    echo $checkRow['product_price'];
?>