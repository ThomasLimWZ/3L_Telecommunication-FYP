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
<?php error_reporting(0); ?>
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
<style>
.container {
    text-align: left;
    overflow: hidden;
    width: 80%;
    margin: 0 auto;
  display: table;
  padding: 0 0 8em 0;
}

.image:hover {
  background-color: #FDF5E6;
 transform: translate3d(6px, -6px, 0);
  transition-delay: 0s;
    transition-duration: 0.4s;
    transition-property: all;
  transition-timing-function: line;
  cursor:pointer;
}

.imagee{position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  height: 100%;
  width: 100%;
  opacity: 0;
  transition: .5s ease;
  background-color: #008CBA;}

#image_title:hover { opacity: 1;}

#image_title:hover > * {transform: translateY(0);}

</style>
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Product</h1><?php include("connection.php"); ?>
                    </div>
					
					<?php
						if(isset($_GET["edit"])){
							$pcode = $_GET["code"];

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);
							
							$spec_result = mysqli_query($connect, "SELECT * FROM product_specification WHERE product_code='$pcode'");
							$spec_row = mysqli_fetch_assoc($spec_result);
											
							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);
						}
					?>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="updateproduct" method="post" action="" enctype="multipart/form-data" autocomplete="off">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Name<input class="form-control" type="text" name="prod_name" value="<?php echo $row['product_name'];?>" required></p>
												</div>
											</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<label>Descriptions</label>
													<textarea class="form-control validate" name="prod_descrip" rows="10" required><?php echo $row['product_descrip'];?></textarea>
												</div>
											</div>
										
											<div class="col-md-4">
												<div class="form-group">
													<label>Brand</label>
													<select class="form-control" name="brand">
														<?php
															$brand_option = mysqli_query($connect,"SELECT * FROM brand WHERE brand_status=1");
															
															while($brand_row = mysqli_fetch_assoc($brand_option)){
														?>
																<option value="<?php echo $brand_row['brand_name'];?>" <?php if($row['brand_name'] == $brand_row['brand_name'])echo "selected";?> >
																<?php echo $brand_row['brand_name'];?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Category</label>
													<select class="form-control" name="category">
														<?php
															$cat_option = mysqli_query($connect,"SELECT * FROM category");
															
															while($cat_row = mysqli_fetch_assoc($cat_option)){
														?>
																<option value="<?php echo $cat_row['cat_name'];?>" <?php if($row['cat_name'] == $cat_row['cat_name'])echo "selected";?> >
																<?php echo $cat_row['cat_name'];?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
										
										<br>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Specifications</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<label>Display (Optional)</label>
													<textarea class="form-control validate" name="spec1" rows="5"><?php echo $spec_row['product_display'];?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Chip (Optional)</label>
													<textarea class="form-control validate" name="spec2" rows="5"><?php echo $spec_row['product_chip'];?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Front Camera (Optional)</label>
													<textarea class="form-control validate" name="spec3" rows="2"><?php echo $spec_row['product_front_cam'];?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Back Camera (Optional)</label>
													<textarea class="form-control validate" name="spec4" rows="5"><?php echo $spec_row['product_back_cam'];?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Power and Battery (Optional)</label>
													<textarea class="form-control validate" name="spec5" rows="5"><?php echo $spec_row['product_battery'];?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Others (Optional)</label>
													<textarea class="form-control validate" name="spec6" rows="5"><?php echo $spec_row['others'];?></textarea>
												</div>
											</div>
										</div>
										
										<br>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Colors</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 1 <input class="form-control" type="text" id="prod_color1" name="prod_color1" value="<?php echo $color_row['product_color1'];?>" onkeyup="checkC1()" required></p>
													<span id="error1" style="color:red"></span>
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
														<p>Color 2 <input class="form-control" type="text" id="prod_color2" name="prod_color2" value="<?php echo $color_row['product_color2'];?>" onkeyup="checkC2()" required></p>
														<span id="error2" style="color:red"></span>
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
														<p>Color 3 <input class="form-control" type="text" id="prod_color3" name="prod_color3" value="<?php echo $color_row['product_color3'];?>" onkeyup="checkC3()" required></p>
														<span id="error3" style="color:red"></span>
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
														<p>Color 4 <input class="form-control" type="text" id="prod_color4" name="prod_color4" value="<?php echo $color_row['product_color4'];?>" onkeyup="checkC4()" required></p>
														<span id="error4" style="color:red"></span>
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
														<p>Color 5 <input class="form-control" type="text" id="prod_color5" name="prod_color5" value="<?php echo $color_row['product_color5'];?>" onkeyup="checkC5()" required></p>
														<span id="error5" style="color:red"></span>
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
														<p>Color 6<input class="form-control" type="text" id="prod_color6" name="prod_color6" value="<?php echo $color_row['product_color6'];?>" onkeyup="checkC6()" required></p>
														<span id="error6" style="color:red"></span>
													</div>
												</div>
											</div>
										<?php
										}
										?>

										<br>
										<div class="row formtype">
											<?php 
												$res = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code = '$pcode'");

												if(mysqli_num_rows($res) > 0){
													while($images = mysqli_fetch_assoc($res)){  
											?>
														<div>
															<table class="container">
																<tr>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color1'];?>"><img src="product/<?=$images['product_img1']?>" width="200px" style="object-fit:contain;"></a></td>
															<?php
																if (empty($images['product_img2'])){
															?>

																	<td class="image"><a href="add-color-manager.php?add&code=<?php echo $pcode;?>&color=<?php echo 'product_color2';?>"><img src="product/emptycolor.png" width="200px" style="object-fit:contain;"></a></td>
																	
																	
															<?php
																}
																else{
															?>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color2'];?>"><img src="product/<?=$images['product_img2']?>" width="200px" style="object-fit:contain;"></a></td>
																	
															<?php
																}
															?>
															<?php
																if (empty($images['product_img3'])){
															?>

																	<td class="image"><a href="add-color-manager.php?add&code=<?php echo $pcode;?>&color=<?php echo 'product_color3';?>"><img src="product/emptycolor.png" width="200px" style="object-fit:contain;"></a></td>
																	
															<?php
																}
																else{
															?>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color3'];?>"><img src="product/<?=$images['product_img3']?>" width="200px" style="object-fit:contain;"></a></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img4'])){
															?>

																	<td class="image"><a href="add-color-manager.php?add&code=<?php echo $pcode;?>&color=<?php echo 'product_color4';?>"><img src="product/emptycolor.png" width="200px" style="object-fit:contain;"></a></td>
																	
															<?php
																}
																else{
															?>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color4'];?>"><img src="product/<?=$images['product_img4']?>" width="200px" style="object-fit:contain;"></a></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img5'])){
															?>

																	<td class="image"><a href="add-color-manager.php?add&code=<?php echo $pcode;?>&color=<?php echo 'product_color5';?>"><img src="product/emptycolor.png" width="200px" style="object-fit:contain;"></a></td>
																	
															<?php
																}
																else{
															?>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color5'];?>"><img src="product/<?=$images['product_img5']?>" width="200px" style="object-fit:contain;"></a></td>
															<?php
																}
															?>
															<?php
																if (empty($images['product_img6'])){
															?>

																	<td class="image"><a href="add-color-manager.php?add&code=<?php echo $pcode;?>&color=<?php echo 'product_color6';?>"><img src="product/emptycolor.png" width="200px" style="object-fit:contain;"></a></td>
																	
															<?php
																}
																else{
															?>
																	<td class="image"><a href="update-productimg-manager.php?edit&code=<?php echo $pcode;?>&color=<?php echo $images['product_color6'];?>"><img src="product/<?=$images['product_img6']?>" width="200px" style="object-fit:contain;"></a></td>
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
										<br>
										<input type="submit" id="savebtn" name="savebtn" value="Update Product" class="btn btn-primary buttonedit ml-2">
										<a href="all-product-manager.php" class="btn btn-primary buttonedit ml-2">Back to Product List</a>
										<?php
										if($row['cat_name'] == "Phone" || $row['cat_name'] == "Tablet" || $row['cat_name'] == "Watch"){
										?>
										<a href="product-details-manager.php?view&code=<?php echo $pcode;?>" class="btn btn-success buttonedit ml-2">Price and Capacity</a>
										<?php
										}
										else{
											?>
											<a href="product-details-manager.php?view&code=<?php echo $pcode;?>" class="btn btn-success buttonedit ml-2">Price Details</a>
										<?php
										}
										?>
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

<script>
var color1 = document.getElementById('prod_color1');
var color2 = document.getElementById('prod_color2');
var color3 = document.getElementById('prod_color3');
var color4 = document.getElementById('prod_color4');
var color5 = document.getElementById('prod_color5');
var color6 = document.getElementById('prod_color6');

var c3 = "<?php echo $color_row['product_color3']; ?>";
var c4 = "<?php echo $color_row['product_color4']; ?>";
var c5 = "<?php echo $color_row['product_color5']; ?>";
var c6 = "<?php echo $color_row['product_color6']; ?>";
if(c3 === "" && c4 === "" && c5 === ""  && c6 === ""){
	function checkC1(){
		if(color1.value.toLowerCase() == color2.value.toLowerCase()){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error1').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC2(){
		if(color2.value.toLowerCase() == color1.value.toLowerCase()){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error2').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
}
else if(c4 === "" && c5 === ""){
	function checkC1(){
		if(color1.value.toLowerCase() == color2.value.toLowerCase() || color1.value.toLowerCase() == color3.value.toLowerCase()){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error1').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC2(){
		if(color2.value.toLowerCase() == color1.value.toLowerCase() || color2.value.toLowerCase() == color3.value.toLowerCase()){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error2').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC3(){
		if(color3.value.toLowerCase() == color1.value.toLowerCase() || color3.value.toLowerCase() == color2.value.toLowerCase()){
			document.getElementById('error3').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error3').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
}
else if(c6 === "" && c5 === ""){
	function checkC1(){
		if(color1.value.toLowerCase() == color2.value.toLowerCase() || color1.value.toLowerCase() == color3.value.toLowerCase()){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error1').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC2(){
		if(color2.value.toLowerCase() == color1.value.toLowerCase() || color2.value.toLowerCase() == color3.value.toLowerCase()){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error2').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC3(){
		if(color3.value.toLowerCase() == color1.value.toLowerCase() || color3.value.toLowerCase() == color2.value.toLowerCase()){
			document.getElementById('error3').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error3').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
}
else if(c5 === ""){
	function checkC1(){
		if(color1.value.toLowerCase() == color2.value.toLowerCase() || color1.value.toLowerCase() == color3.value.toLowerCase() || color1.value.toLowerCase() == color4.value.toLowerCase()){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error1').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC2(){
		if(color2.value.toLowerCase() == color1.value.toLowerCase() || color2.value.toLowerCase() == color3.value.toLowerCase() || color2.value.toLowerCase() == color4.value.toLowerCase()){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error2').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC3(){
		if(color3.value.toLowerCase() == color1.value.toLowerCase() || color3.value.toLowerCase() == color2.value.toLowerCase() || color3.value.toLowerCase() == color4.value.toLowerCase()){
			document.getElementById('error3').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error3').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC4(){
		if(color4.value.toLowerCase() == color1.value.toLowerCase() || color4.value.toLowerCase() == color2.value.toLowerCase() || color4.value.toLowerCase() == color3.value.toLowerCase()){
			document.getElementById('error4').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error4').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
}
else{
	function checkC1(){
		if(color1.value.toLowerCase() == color2.value.toLowerCase() || color1.value.toLowerCase() == color3.value.toLowerCase() || color1.value.toLowerCase() == color4.value.toLowerCase() || color1.value.toLowerCase() == color5.value.toLowerCase()){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error1').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC2(){
		if(color2.value.toLowerCase() == color1.value.toLowerCase() || color2.value.toLowerCase() == color3.value.toLowerCase() || color2.value.toLowerCase() == color4.value.toLowerCase() || color2.value.toLowerCase() == color5.value.toLowerCase()){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error2').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC3(){
		if(color3.value.toLowerCase() == color1.value.toLowerCase() || color3.value.toLowerCase() == color2.value.toLowerCase() || color3.value.toLowerCase() == color4.value.toLowerCase() || color3.value.toLowerCase() == color5.value.toLowerCase()){
			document.getElementById('error3').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error3').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
	function checkC4(){
		if(color4.value.toLowerCase() == color1.value.toLowerCase() || color4.value.toLowerCase() == color2.value.toLowerCase() || color4.value.toLowerCase() == color3.value.toLowerCase() || color4.value.toLowerCase() == color5.value.toLowerCase()){
			document.getElementById('error4').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled=true;
		}
		else{
			document.getElementById('error4').innerHTML="";
			document.getElementById('savebtn').disabled=false;
		}
	}
}
</script>
<?php
	}
?>
<?php
if(isset($_POST["savebtn"])){
	$pname = $_POST["prod_name"];
	$pdescrip = $_POST["prod_descrip"];
	$brand = $_POST["brand"];
	$cat = $_POST["category"];
	
	$spec_display = $_POST["spec1"];
	$spec_chip = $_POST["spec2"];
	$spec_front_cam = $_POST["spec3"];
	$spec_back_cam = $_POST["spec4"];
	$spec_battery = $_POST["spec5"];
	
	$c1 = $_POST["prod_color1"];
	$c2 = $_POST["prod_color2"];
	$c3 = $_POST["prod_color3"];
	$c4 = $_POST["prod_color4"];
	$c5 = $_POST["prod_color5"];
	$c6 = $_POST["prod_color6"];
	$name_valid = strtolower($pname);
	$currentName = $row['product_name'];

	$checkName = mysqli_query($connect,"SELECT * FROM product WHERE LOWER(product_name)='$name_valid' EXCEPT SELECT * FROM product WHERE product_name='$currentName'");
	$count = mysqli_num_rows($checkName);
	if($count != 0){
?>	
		<script>
		swal({title:"The product name is already in use. Please change it.",
		type:"error"});
		</script>
<?php
	}
	else{
		mysqli_query($connect,"UPDATE product SET product_name='$pname', product_descrip='$pdescrip', brand_name='$brand', cat_name='$cat' WHERE product_code='$pcode'");
						
		mysqli_query($connect,"UPDATE product_image SET product_color1='$c1', product_color2='$c2', product_color3='$c3', product_color4='$c4', product_color5='$c5', product_color6='$c6' WHERE product_code='$pcode'");
						
		mysqli_query($connect,"UPDATE product_specification SET product_display='$spec_display', product_chip='$spec_chip', product_front_cam='$spec_front_cam', product_back_cam='$spec_back_cam',product_battery='$spec_battery' WHERE product_code='$pcode'");
?>
<script>
	swal({
    title: "Record updated",
	type: "success"
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-product-manager.php';
          });
</script>
<?php
	}
}
mysqli_close($connect);
?>