<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id']) || $_SESSION["position"] != "Manager"){
?>
<script>
	alert("Please log in");
</script>
<?php
		header("refresh:0.5; url = login.php");
		exit();
	}
	else{
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3L Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include("sidebar-manager.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include("topbar-manager.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<?php
						if(isset($_GET["add"])){
							$pcode = $_GET["code"];

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);
							
							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);

                            $capacity_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
							$cap_row = mysqli_fetch_assoc($capacity_result);
						}
					?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Product Detail for <b><?php echo $row['product_name'];?></b></h1>
                    </div>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form  method="post" action="" enctype="multipart/form-data" autocomplete="off">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<?php
														if($row['cat_name'] == 'Watch')
                                                        {
                                                        ?>
                                                        <p>Case Size <span style="color:red;">*</span><input class="form-control" type="text" name="prod_cap" placeholder="35mm OR 42mm" maxlength="4" oninput="this.value = this.value.replace(/[^0-9.m]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo isset($_POST["prod_cap"]) ? $_POST["prod_cap"] : ''; ?>" required></p>
                                                    	<p>Price (RM) <span style="color:red;">*</span><input id="pricecs" class="form-control" type="number" name="prod_price" min="1" step="0.01" lang="nb" value="<?php echo isset($_POST["prod_price"]) ? $_POST["prod_price"] : ''; ?>" required></p>
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
													<p>RAM + ROM <span style="color:red;">*</span><input class="form-control" type="text" name="prod_cap" maxlength="11" placeholder="8+128GB OR 128GB" oninput="this.value = this.value.replace(/[^0-9.+.G.T.B]/g, '').replace(/(\..*)\./g, '$1');" value="<?php echo isset($_POST["prod_cap"]) ? $_POST["prod_cap"] : ''; ?>" required></p>
                                                    <p>Price (RM) <span style="color:red;">*</span><input class="form-control" id="pricecs" type="number" name="prod_price" min="1" step="0.01" lang="nb" value="<?php echo isset($_POST["prod_price"]) ? $_POST["prod_price"] : ''; ?>" required></p>
													<?php
                                                        }
                                                    ?>
												</div>
											</div>
										</div>
										
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Colors and Stocks</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 1<input class="form-control" type="text" name="prod_color1" value="<?php echo $color_row['product_color1'];?>" disabled></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 1 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock1" min="0" value="<?php echo isset($_POST["prod_stock1"]) ? $_POST["prod_stock1"] : ''; ?>" required></p>
												</div>
											</div>
										</div>
										
										<?php
											if(empty($color_row['product_color2'])){}
											else{
										?>
											<div class="row formtype">
												<div class="col-md-4">
													<div class="form-group">
														<p>Color 2<input class="form-control" type="text" name="prod_color2" value="<?php echo $color_row['product_color2'];?>" disabled></p>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<p>Stock 2 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock2" min="0" value="<?php echo isset($_POST["prod_stock2"]) ? $_POST["prod_stock2"] : ''; ?>" required></p>
													</div>
												</div>
											</div>
										<?php
											}
										?>
										
										<?php
											if(empty($color_row['product_color3'])){}
											else{
										?>
											<div class="row formtype">
												<div class="col-md-4">
													<div class="form-group">
														<p>Color 3<input class="form-control" type="text" name="prod_color3" value="<?php echo $color_row['product_color3'];?>" disabled></p>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<p>Stock 3 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock3" min="0" value="<?php echo isset($_POST["prod_stock3"]) ? $_POST["prod_stock3"] : ''; ?>" required></p>
													</div>
												</div>
											</div>
										<?php
											}
										?>
										
										<?php
											if(empty($color_row['product_color4'])){}
											else{
										?>
											<div class="row formtype">
												<div class="col-md-4">
													<div class="form-group">
														<p>Color 4<input class="form-control" type="text" name="prod_color4" value="<?php echo $color_row['product_color4'];?>" disabled></p>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<p>Stock 4 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock4" min="0" value="<?php echo isset($_POST["prod_stock4"]) ? $_POST["prod_stock4"] : ''; ?>" required></p>
													</div>
												</div>
											</div>
										<?php
											}
										?>
										
										<?php
											if(empty($color_row['product_color5'])){}
											else{
										?>
											<div class="row formtype">
												<div class="col-md-4">
													<div class="form-group">
														<p>Color 5<input class="form-control" type="text" name="prod_color5" value="<?php echo $color_row['product_color5'];?>" disabled></p>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<p>Stock 5 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock5" min="0" value="<?php echo isset($_POST["prod_stock5"]) ? $_POST["prod_stock5"] : ''; ?>" required></p>
													</div>
												</div>
											</div>
										<?php
											}
										?>
										<?php
											if(empty($color_row['product_color6'])){}
											else{
										?>
											<div class="row formtype">
												<div class="col-md-4">
													<div class="form-group">
														<p>Color 6<input class="form-control" type="text" name="prod_color6" value="<?php echo $color_row['product_color6'];?>" disabled></p>
													</div>
												</div>
												
												<div class="col-md-4">
													<div class="form-group">
														<p>Stock 6 <span style="color:red;">*</span><input class="form-control" type="number" name="prod_stock6" min="0" value="<?php echo isset($_POST["prod_stock6"]) ? $_POST["prod_stock6"] : ''; ?>" required></p>
													</div>
												</div>
											</div>
										<?php
											}
										?>
										<br>
										<input type="submit" id="savebtn" name="savebtn" value="Add Product Details" class="btn btn-primary buttonedit ml-2">
										<a href="product-details-manager.php?view&code=<?php echo $pcode;?>" class="btn btn-primary buttonedit ml-2">Back to Product Details</a>
									</form>
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
                
            <!-- End of Main Content -->
			<br>
            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>3L Telecommunication</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <?php include("logout-model.php");?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<style>
	/* Chrome, Safari, Edge, Opera */
	input#pricecs::-webkit-outer-spin-button,
	input#pricecs::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
	}

	/* Firefox */
	input#pricecs{
	-moz-appearance: textfield;
	}
</style>
<?php
	}
?>
<?php
if(isset($_POST["savebtn"])){
    $capacity = $_POST['prod_cap'];
	$price = $_POST['prod_price'];
	$s1 = $_POST['prod_stock1'];
	$s2 = $_POST['prod_stock2'];
	$s3 = $_POST['prod_stock3'];
	$s4 = $_POST['prod_stock4'];
	$s5 = $_POST['prod_stock5'];
	$s6 = $_POST['prod_stock6'];

	$checkCap = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_capacity='$capacity' AND product_code='$pcode'");
	$count = mysqli_num_rows($checkCap);

	if($count != 0){
?>
		<script>
			swal({title:"This capacity is existing. Please change.",
					type:"warning"});
		</script>
<?php
	}
	else{
		$checkStartRes = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$pcode'");
		$checkStartRow = mysqli_fetch_assoc($checkStartRes);
		$startPrice = $checkStartRow['product_start_price'];

		if($startPrice > $price){
			mysqli_query($connect,"UPDATE product SET product_start_price='$price' WHERE product_code='$pcode'");
		}

		mysqli_query($connect,"INSERT INTO product_detail (product_capacity,product_price,product_stock1,product_stock2,product_stock3,product_stock4,product_stock5,product_stock6,product_code) VALUES ('$capacity','$price','$s1','$s2','$s3','$s4','$s5','$s6','$pcode')");
?>
<script>
	swal({
		title: "Record Saved!",
		type: "success"},function(isConfirm){
					alert('ok');
			  });
			  $('.swal2-confirm').click(function(){
					window.location.href = 'product-details-manager.php?view&code=<?php echo $pcode;?>';
			  });  
</script>
<?php
	}
}
mysqli_close($connect);
?>