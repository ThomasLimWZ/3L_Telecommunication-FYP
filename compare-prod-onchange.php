<?php include("admin/connection.php");
	
	$code1 = $_POST['prod1_selected'];
    $code2 = $_POST['prod2_selected'];

    echo "compare.php?view&code1=".$code1."&code2=".$code2;
?>