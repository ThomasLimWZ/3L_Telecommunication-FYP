<?php include("admin/connection.php");
	session_start();
	
	$cus_email = $_SESSION['email'];
	$cart = $_POST['cart_code'];
	$price = $_POST['product_price'];
	$qty = $_POST['quantity'];
	
	$subtotal = $price * $qty;
	
	mysqli_query($connect,"UPDATE cart SET quantity='$qty', cart_subtotal='$subtotal' WHERE cart_code='$cart' AND cus_email='$cus_email' AND cart_status=1");
	
	echo number_format("$subtotal",2);
	echo "<meta http-equiv='refresh' content='0'>";
?>