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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

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
					<?php
						if(isset($_GET["restock"])){
							$dcode = $_GET["code"];

							$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_detail_code='$dcode'");
							$detail_row = mysqli_fetch_assoc($detail_result);
							$pcode = $detail_row['product_code'];

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);
							
							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);
						}
					?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Restock Product (<?php echo $row['product_name'];?>)</h1>
                    </div>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="restockproduct" method="post" action="" enctype="multipart/form-data" autocomplete="off">
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
													<p>Stock 1<input class="form-control" id="mininput" type="number" name="prod_stock1" min="<?php echo $detail_row["product_stock1"];?>" value="<?php echo $detail_row['product_stock1'];?>" required></p>
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
														<p>Stock 2<input class="form-control" type="number" name="prod_stock2" min="<?php echo $detail_row["product_stock2"];?>" value="<?php echo $detail_row['product_stock2'];?>" required></p>
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
														<p>Stock 3<input class="form-control" type="number" name="prod_stock3" min="<?php echo $detail_row["product_stock3"];?>" value="<?php echo $detail_row['product_stock3'];?>" required></p>
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
														<p>Stock 4<input class="form-control" type="number" name="prod_stock4" min="<?php echo $detail_row["product_stock4"];?>" value="<?php echo $detail_row['product_stock4'];?>" required></p>
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
														<p>Stock 5<input class="form-control" type="number" name="prod_stock5" min="<?php echo $detail_row["product_stock5"];?>" value="<?php echo $detail_row['product_stock5'];?>" required></p>
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
														<p>Stock 6<input class="form-control" type="number" name="prod_stock6" min="<?php echo $detail_row["product_stock6"];?>" value="<?php echo $detail_row['product_stock6'];?>" required></p>
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
															<?php
																if (empty($images['product_img6'])){}
																else{
															?>
																	<td class="image"><img src="product/<?=$images['product_img6']?>" width="200px" style="object-fit:contain;"></td>
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
											<?php 	}
												}
											?>
										</div>
										<br/>
										<input type="submit" name="savebtn" value="Restock Product" class="btn btn-primary buttonedit ml-2">
										<a href="index-product-details.php?detail&code=<?php echo $row['product_code'];?>" class="btn btn-primary buttonedit ml-2">Back to List</a>
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
<script>
	$('form')
		.each(function(){
			$(this).data('serialized', $(this).serialize())
		})
        .on('change input', function(){
            $(this)				
                .find('input:submit, button:submit')
                    .attr('disabled', $(this).serialize() == $(this).data('serialized'))
            ;
         })
		.find('input:submit, button:submit')
			.attr('disabled', true)
	;
</script>
<?php
	}
?>
<?php
if(isset($_POST["savebtn"])){
	$s1 = $_POST["prod_stock1"];
	$s2 = $_POST["prod_stock2"];
	$s3 = $_POST["prod_stock3"];
	$s4 = $_POST["prod_stock4"];
	$s5 = $_POST["prod_stock5"];	
	$s6 = $_POST["prod_stock6"];
	mysqli_query($connect,"UPDATE product_detail SET product_stock1='$s1', product_stock2='$s2', product_stock3='$s3',product_stock4='$s4',product_stock5='$s5',product_stock6='$s6',product_stock6='$s6' WHERE product_detail_code='$dcode'");
			
?>

<script>
	swal({
		title: "Stock Updated!",
		type: "success"},function(isConfirm){
					alert('ok');
			  });
			  $('.swal2-confirm').click(function(){
					window.location.href = 'index.php';
			  });  

</script>
<?php
}
mysqli_close($connect);
?>