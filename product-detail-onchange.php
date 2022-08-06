<?php include("admin/connection.php");
	
	$code = $_POST['cap_selected'];
	$color = $_POST['color_selected'];
	
    $checkStock = mysqli_query($connect,"SELECT * FROM product_detail JOIN product_image ON product_detail.product_code=product_image.product_code WHERE product_detail.product_detail_code='$code'");
    
    $checkRow = mysqli_fetch_assoc($checkStock);

    if($color == $checkRow['product_color1'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock1'];
    else  if($color == $checkRow['product_color2'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock2'];
    else if($color == $checkRow['product_color3'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock3'];
    else if($color == $checkRow['product_color4'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock4'];
    else if($color == $checkRow['product_color5'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock5'];
     else if($color == $checkRow['product_color6'] && $code == $checkRow['product_detail_code'])
        echo $checkRow['product_stock6'];
?>