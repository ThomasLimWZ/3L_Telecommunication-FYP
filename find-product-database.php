<?php include("admin/connection.php");
    $searchThings = $_POST['keyword'];

    $things_in_lower = strtolower($searchThings);

    $sql = "SELECT DISTINCT product_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE brand.brand_status=1 AND product.product_status=1 AND LOWER(product.product_name) LIKE '%$things_in_lower%'";
    
    $search_res = $connect->query($sql);
	$count = mysqli_num_rows($search_res);

    if($count > 0){
        while ($search_row = mysqli_fetch_array($search_res)) {
            $res[] = $search_row['product_name'];
        }
    }
    else{
        $res = array();
    }
    
    echo json_encode($res);
?>