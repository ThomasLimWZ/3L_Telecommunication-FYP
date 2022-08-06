<?php include("admin/connection.php");
    $email = $_POST['cus_email'];
	
    $cus_res = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$email'");
    $cus_row = mysqli_fetch_assoc($cus_res);

    $address = $cus_row['cus_address'];
    $city = $cus_row['cus_city'];
    $state = $cus_row['cus_state'];
    $postcode = $cus_row['cus_post_code'];
    $phone = $cus_row['cus_phone'];
    $name = $cus_row['cus_name'];

    echo json_encode(array($address, $city, $state, $postcode, $phone, $name));
?>