<?php include("admin/connection.php");
	session_start();
	
	$cus_email = $_SESSION['email'];
	$cart = $_POST['cart_code'];
	$color = $_POST['product_color'];
	
	
	mysqli_query($connect,"UPDATE cart SET product_color='$color' WHERE cart_code='$cart' AND cus_email='$cus_email' AND cart_status=1");
?>