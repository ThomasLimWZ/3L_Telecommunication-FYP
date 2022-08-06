<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id']) || $_SESSION["position"] != "Staff"){
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


<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include("sidebar.php");?>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Clearance Details</h1><?php include("connection.php"); ?>
                    </div>
					
					<?php
						if(isset($_GET["view"])){
							$ccode = $_GET["code"];

							$result = mysqli_query($connect, "SELECT * FROM clearance WHERE clearance_code='$ccode'");
							$row = mysqli_fetch_assoc($result);
							

							$pcode=$row['clearance_product_code'];
							
							$spec_result = mysqli_query($connect, "SELECT * FROM product_specification WHERE product_code='$pcode'");
							$spec_row = mysqli_fetch_assoc($spec_result);
							
							$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");

							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);
						}
					?>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="updateproduct" method="post" action="" enctype="multipart/form-data">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Name<input class="form-control" type="text" name="prod_name" value="<?php echo $row['clearance_product_name'];?>" disabled></p>
												</div>
											</div>
											
											<?php
											$price = array();
											while($detail_row = mysqli_fetch_assoc($detail_result)){
												$price[] = $detail_row['product_price'];
											}
											$max = $price[0];
											foreach($price as $key => $val){
												if($max < $val){
													$max = $val;
												}
											}
											?>
											<div class="col-md-4">
												<div class="form-group">
													<p>Price<input class="form-control" type="text" name="prod_price" value="RM <?php echo $price[0]." - RM ".$max;?>" disabled></p>
												</div>
											</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<label>Descriptions</label>
													<textarea class="form-control validate" name="prod_descrip" rows="10" disabled><?php echo $row['clearance_descrip'];?></textarea>
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label>Brand</label>
													<input class="form-control" name="brand" value="<?php echo $row['clearance_brand_name']; ?>" disabled>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Category</label>
													<input class="form-control" name="category" value="<?php echo $row['clearance_cat_name']; ?>" disabled>
												</div>
											</div>
										</div>
										
										<br>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Specifications</h1>
										</div>
										<div class="row formtype">
											<?php
												if(empty($spec_row['product_display'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Display</label>
															<textarea class="form-control validate" name="spec1" rows="5" disabled><?php echo $spec_row['product_display'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
											<?php
												if(empty($spec_row['product_chip'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Chip</label>
															<textarea class="form-control validate" name="spec2" rows="5" disabled><?php echo $spec_row['product_chip'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
											<?php
												if(empty($spec_row['product_front_cam'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Front Camera</label>
															<textarea class="form-control validate" name="spec3" rows="2" disabled><?php echo $spec_row['product_front_cam'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
											<?php
												if(empty($spec_row['product_back_cam'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Back Camera</label>
															<textarea class="form-control validate" name="spec4" rows="5" disabled><?php echo $spec_row['product_back_cam'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
											<?php
												if(empty($spec_row['product_battery'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Power and Battery</label>
															<textarea class="form-control validate" name="spec5" rows="5" disabled><?php echo $spec_row['product_battery'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
											<?php
												if(empty($spec_row['others'])){}
												else{
											?>
													<div class="col-md-4">
														<div class="form-group">
															<label>Others</label>
															<textarea class="form-control validate" name="spec6" rows="5" disabled><?php echo $spec_row['others'];?></textarea>
														</div>
													</div>
											<?php
												}
											?>
										</div>
										
										<br>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Colors</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 1<input class="form-control" type="text" name="prod_color1" value="<?php echo $color_row['product_color1'];?>" disabled></p>
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
											</div>
										<?php
											}
										?>
										
										<br/>
										<div class="row formtype">
											<?php 
												$res = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code = '$pcode'");

												if(mysqli_num_rows($res) > 0){
													while($images = mysqli_fetch_assoc($res)){  
											?>
														<div>
															<table class="container">
																<tr>
																	<td class="image"><img src="product/<?=$images['product_img1']?>" width="200px" style="object-fit:contain;"></td>
															<?php
																if (empty($images['product_img2'])){}
																else{
															?>
																	<td class="image"><img src="product/<?=$images['product_img2']?>" width="200px" style="object-fit:contain;"></td>
																	
															<?php
																}
															?>
															<?php
																if (empty($images['product_img3'])){}
																else{
															?>
																	<td class="image"><img src="product/<?=$images['product_img3']?>" width="200px" style="object-fit:contain;"></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img4'])){}
																else{
															?>
																	<td class="image"><img src="product/<?=$images['product_img4']?>" width="200px" style="object-fit:contain;"></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img5'])){}
																else{
															?>
																	<td class="image"><img src="product/<?=$images['product_img5']?>" width="200px" style="object-fit:contain;"></td>
															<?php
																}
															?>
																</tr>
																<tr style="font-weight:bold;">
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color1'];?></td>
															<?php
																if (empty($images['product_img2'])){}
																else{
															?>
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color2'];?></td>
															<?php 
																}
															?>
															<?php
																if (empty($images['product_img3'])){}
																else{
															?>
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color3'];?></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img4'])){}
																else{
															?>
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color4'];?></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img5'])){}
																else{
															?>
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color5'];?></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img6'])){}
																else{
															?>
																	<td style="width:200px; text-align:center;"><?php echo $images['product_color6'];?></td>
															<?php
																}
															?>
														</tr>
															</table>
														</div>
										</div>
										<br>
										<a href="all-clearance.php" class="btn btn-primary buttonedit ml-2">Back to Clearance List</a>
										<?php
										if($row['clearance_cat_name'] == "Phone" || $row['clearance_cat_name'] == "Tablet" || $row['clearance_cat_name'] == "Watch"){
										?>
										<a href="clearance-details.php?view&code=<?php echo $pcode;?>" class="btn btn-success buttonedit ml-2">Price and Capacity</a>
										<?php
										}
										else{
											?>
											<a href="clearance-details.php?view&code=<?php echo $pcode;?>" class="btn btn-success buttonedit ml-2">Price Details</a>
										<?php
										}
										?>
										<a href="edit-clearance.php?edit&code=<?php echo $row['clearance_code'];?>" class="btn btn-success buttonedit ml-2">Edit</a>
									</form>
									<?php }}?>
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
