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

<?php include("connection.php"); ?>
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
                <?php include("topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
					<?php
						if(isset($_GET["view"])){
							$dcode = $_GET["code"];

							$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_detail_code='$dcode'");
                            $detail_row = mysqli_fetch_assoc($detail_result);
                            
                            $pcode = $detail_row['product_code'];

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);

							$spec_result = mysqli_query($connect, "SELECT * FROM product_specification WHERE product_code='$pcode'");
							$spec_row = mysqli_fetch_assoc($spec_result);

							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);
						}
					?>
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $row['product_name'];?></h1>
                    </div>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="updateproduct" method="post" action="" enctype="multipart/form-data">
                                        <div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
												<?php
													if($row['cat_name'] == 'Audio' || $row['cat_name'] == 'Accessories'){}
													else if($row['cat_name']=='Watch')
													{
													?>
													<p>Case Size<input class="form-control" type="text" name="prod_cap" value="<?php echo $detail_row['product_capacity'];?>" disabled></p>
													<?php
													}
													else{
													?>
													<p>RAM + ROM<input class="form-control" type="text" name="prod_cap" value="<?php echo $detail_row['product_capacity'];?>" disabled></p>
													<?php
													}
													?>
                                                    <p>Price (RM)<input class="form-control" type="text" name="prod_price" value="<?php echo $detail_row['product_price'];?>" disabled></p>
												</div>
											</div>
										</div>
										
										<br>
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
                                                    <p>Stock 1<input class="form-control" type="number" name="prod_stock1" value="<?php echo $detail_row['product_stock1'];?>" disabled></p>
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
                                                        <p>Stock 2<input class="form-control" type="number" name="prod_stock2" value="<?php echo $detail_row['product_stock2'];?>" disabled></p>
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
                                                        <p>Stock 3<input class="form-control" type="number" name="prod_stock3" value="<?php echo $detail_row['product_stock3'];?>" disabled></p>
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
                                                        <p>Stock 4<input class="form-control" type="number" name="prod_stock4" value="<?php echo $detail_row['product_stock4'];?>" disabled></p>
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
                                                        <p>Stock 5<input class="form-control" type="number" name="prod_stock5" value="<?php echo $detail_row['product_stock5'];?>" disabled></p>
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
                                                        <p>Stock 6<input class="form-control" type="number" name="prod_stock6" value="<?php echo $detail_row['product_stock6'];?>" disabled></p>
                                                    </div>
                                                </div>
											</div>
										<?php
											}
										?>
										<br>
										<a href="product-details-manager.php?view&code=<?php echo $row['product_code'];?>" class="btn btn-primary buttonedit ml-2">Back to Product Details</a>
										<a href="edit-product-details-manager.php?edit&code=<?php echo $dcode;?>" class="btn btn-success buttonedit ml-2">Edit Product Detail</a>
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
                <div class="copyright text-center my-auto">
                    <span>3L Telecommunication</span>
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
<?php
	}
?>
