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
                        <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
                    </div>

                    <!-- Content Row -->		 
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="addnewproduct" method="post" action="" enctype="multipart/form-data" autocomplete="off" onsubmit="return validation()" onchange="createInputText()">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Name <span style="color:red;">*</span><input class="form-control" type="text" name="prod_name" value="<?php echo isset($_POST["prod_name"]) ? $_POST["prod_name"] : ''; ?>" required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
												<p>Price (RM) <span style="color:red;">*</span><input class="form-control" id="pricecs" type="number" name="prod_price" min="1" step="0.01" lang="nb" value="<?php echo isset($_POST["prod_price"]) ? $_POST["prod_price"] : ''; ?>" required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													Brand <span style="color:red;">*</span>
													<select class="form-control" name="brand" id="brand" required>
														<option value="" disabled selected>Select</option>
														<?php
															$brand_option = mysqli_query($connect,"SELECT * FROM brand WHERE brand_status=1");
															
															while($brand_row = mysqli_fetch_assoc($brand_option)){
														?>
																<option value="<?php echo $brand_row['brand_name'];?>"><?php echo $brand_row['brand_name'];?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>
										</div>
											<script type="text/javascript">
												document.getElementById('brand').value = "<?php echo $_POST['brand'];?>";
											</script>
										
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
												<label>Descriptions <span style="color:red;">*</span></label>
													<textarea class="form-control validate" name="prod_descrip" rows="10" required><?php echo isset($_POST["prod_descrip"]) ? $_POST["prod_descrip"] : ''; ?></textarea>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
												<label>Category <span style="color:red;">*</span></label>
													<select class="form-control" name="category" id="category" required>
														<option value="" disabled selected>Select</option>
														<?php
															$cat_option = mysqli_query($connect,"SELECT * FROM category");
															
															while($cat_row = mysqli_fetch_assoc($cat_option)){
														?>
																<option value="<?php echo $cat_row['cat_name'];?>"><?php echo $cat_row['cat_name'];?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>

											<div class="col-md-4" id="cap">
												<div class="form-group">
												<label id="label"></label><input id="capacity" class="form-control" type="hidden" name="prod_cap" placeholder="8+128GB OR 128GB" value="<?php echo isset($_POST["prod_cap"]) ? $_POST["prod_cap"] : ''; ?>" oninput="this.value = this.value.replace(/[^0-9.+.G.T.B.m]/g, '').replace(/(\..*)\./g, '$1');">
												</div>
											</div>
										</div>
										<script type="text/javascript">
												document.getElementById('category').value = "<?php echo $_POST['category'];?>";
										</script>

										<script>
										function createInputText(){
											var select = document.getElementById('category');
											var chosenOption = select.options[select.selectedIndex];
											

											if (chosenOption.value == "Phone" || chosenOption.value == "Tablet") {
												document.getElementById("cap").style.display = "inline";
												document.getElementById("capacity").required = true;
												document.getElementById('capacity').type = 'text';
												//$('#label').html("RAM + ROM *");
												document.getElementById('label').innerHTML="RAM + ROM ";
												document.getElementById('req').innerHTML=" *";
												document.getElementById("req").style.color = "red";
												document.getElementById("capacity").placeholder = "8+128GB OR 128GB";
												
											}
											else if(chosenOption.value == "Watch")
											{
												document.getElementById("cap").style.display = "inline";
												document.getElementById("capacity").required = true;
												document.getElementById('label').innerHTML="Case Size ";
												document.getElementById('capacity').type = 'text';
												document.getElementById('req').innerHTML=" *";
												document.getElementById("req").style.color = "red";
												document.getElementById("capacity").placeholder = "42mm";
											}
											else 
											{
												document.getElementById("cap").style.display = "none";
												document.getElementById("capacity").required = false;
											}
										}
										</script>
										

										<br>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Specifications</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<label>Display (Optional)</label>
													<textarea class="form-control validate" name="spec1" rows="5"><?php echo isset($_POST["spec1"]) ? $_POST["spec1"] : ''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Chip (Optional)</label>
													<textarea class="form-control validate" name="spec2" rows="5"><?php echo isset($_POST["spec2"]) ? $_POST["spec2"] : ''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Front Camera (Optional)</label>
													<textarea class="form-control validate" name="spec3" rows="2"><?php echo isset($_POST["spec3"]) ? $_POST["spec3"] : ''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Back Camera (Optional)</label>
													<textarea class="form-control validate" name="spec4" rows="5"><?php echo isset($_POST["spec4"]) ? $_POST["spec4"] : ''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Power and Battery (Optional)</label>
													<textarea class="form-control validate" name="spec5" rows="5"><?php echo isset($_POST["spec5"]) ? $_POST["spec5"] : ''; ?></textarea>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Others (Optional)</label>
													<textarea class="form-control validate" name="spec6" rows="5"><?php echo isset($_POST["spec6"]) ? $_POST["spec6"] : ''; ?></textarea>
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
													<p>Color 1 <span style="color:red;">*</span><input class="form-control" type="text" id="prod_color1" name="prod_color1" onkeyup="checkC1()"  value="<?php echo isset($_POST["prod_color1"]) ? $_POST["prod_color1"] : ''; ?>" required></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 1<span style="color:red;">*</span><input class="form-control" type="number" min=0 name="prod_stock1" value="<?php echo isset($_POST["prod_stock1"]) ? $_POST["prod_stock1"] : ''; ?>"required></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 1<span style="color:red;">*</span></label>
														<br>
														<input type="file" name="prod_img1" required>
														<br><label>Choose image</label>
												</div>
											</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 2 <span id="c2color">(Optional)</span><input class="form-control" type="text" id="prod_color2" name="prod_color2" onkeyup="c2required(),checkC2()"  value="<?php echo isset($_POST["prod_color2"]) ? $_POST["prod_color2"] : ''; ?>"></p>
													<span id="error2" style="color:red"></span>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 2 <span id="s2stock">(Optional)</span><input class="form-control" type="number" id="prod_stock2" name="prod_stock2" min=0 onkeyup="c2required()" value="<?php echo isset($_POST["prod_stock2"]) ? $_POST["prod_stock2"] : ''; ?>"></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 2 <span id="img2">(Optional)</span></label><br/>
														<input type="file" name="prod_img2" id="prod_img2">
														<br><label>Choose image</label>
												</div>
											</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 3 <span id="c3color">(Optional)</span><input class="form-control" type="text" id="prod_color3" name="prod_color3" onkeyup="c3required(),checkC3()" value="<?php echo isset($_POST["prod_color3"]) ? $_POST["prod_color3"] : ''; ?>"></p>
													<span id="error3" style="color:red"></span>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 3 <span id="s3stock">(Optional)</span><input class="form-control" type="number" id="prod_stock3" name="prod_stock3" min=0 onkeyup="c3required()" value="<?php echo isset($_POST["prod_stock3"]) ? $_POST["prod_stock3"] : ''; ?>"></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 3 <span id="img3">(Optional)</span></label><br/>
														<input type="file" name="prod_img3" id="prod_img3">
														<br><label>Choose image</label>
												</div>
											</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 4 <span id="c4color">(Optional)</span><input class="form-control" type="text" id="prod_color4" name="prod_color4" onkeyup="c4required(),checkC4()" value="<?php echo isset($_POST["prod_color4"]) ? $_POST["prod_color4"] : ''; ?>"></p>
													<span id="error4" style="color:red"></span>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 4 <span id="s4stock">(Optional)</span><input class="form-control" type="number" id="prod_stock4" name="prod_stock4" min=0 onkeyup="c4required()" value="<?php echo isset($_POST["prod_stock4"]) ? $_POST["prod_stock4"] : ''; ?>"></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 4 <span id="img4">(Optional)</span></label><br/>
														<input type="file" name="prod_img4" id="prod_img4">
														<br><label>Choose image</label>
													</div>
												</div>
										</div>
										
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 5 <span id="c5color">(Optional)</span><input class="form-control" type="text" id="prod_color5" name="prod_color5" onkeyup="c5required(),checkC5()" value="<?php echo isset($_POST["prod_color5"]) ? $_POST["prod_color5"] : ''; ?>"></p>
													<span id="error5" style="color:red"></span>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 5 <span id="s5stock">(Optional)</span><input class="form-control" type="number" id="prod_stock5" name="prod_stock5" min=0 onkeyup="c5required()" value="<?php echo isset($_POST["prod_stock5"]) ? $_POST["prod_stock5"] : ''; ?>"></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 5 <span id="img5">(Optional)</span></label><br/>
														<input type="file" name="prod_img5" id="prod_img5">
														<br><label>Choose image</label>
													</div>
												</div>
										</div>

										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Color 6 <span id="c6color">(Optional)</span><input class="form-control" type="text" id="prod_color6" name="prod_color6" onkeyup="c6required(),checkC6()"  value="<?php echo isset($_POST["prod_color6"]) ? $_POST["prod_color6"] : ''; ?>"></p>
													<span id="error6" style="color:red"></span>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<p>Stock 6 <span id="s6stock">(Optional)</span><input class="form-control" type="number" id="prod_stock6" name="prod_stock6" min=0 onkeyup="c6required()" value="<?php echo isset($_POST["prod_stock6"]) ? $_POST["prod_stock6"] : ''; ?>"></p>
												</div>
											</div>
											
											<div class="col-md-4">
												<div class="form-group">
													<label>Image 6 <span id="img6">(Optional)</span></label><br/>
														<input type="file" id="prod_img6" name="prod_img6">
														<br><label>Choose image</label>
												</div>
											</div>
										</div>
										<script>
											function c2required(){
												var c2 = document.getElementById("prod_color2").value;
												var s2 = document.getElementById("prod_stock2").value;
												if(c2.length != 0 || s2.length != 0){
													document.getElementById('c2color').innerHTML="*";
													document.getElementById('s2stock').innerHTML="*";
													document.getElementById('img2').innerHTML="*";
													document.getElementById("c2color").style.color = "red";
													document.getElementById("s2stock").style.color = "red";
													document.getElementById("img2").style.color = "red";
													document.getElementById("prod_color2").required = true;
													document.getElementById("prod_stock2").required = true;
													document.getElementById("prod_img2").required = true;
												}
												else{
													document.getElementById('c2color').innerHTML="(Optional)";
													document.getElementById('s2stock').innerHTML="(Optional)";
													document.getElementById('img2').innerHTML="(Optional)";
													document.getElementById("c2color").style.removeProperty('color');
													document.getElementById("s2stock").style.removeProperty('color');
													document.getElementById("img2").style.removeProperty('color');
													document.getElementById("prod_color2").required = false;
													document.getElementById("prod_stock2").required = false;
													document.getElementById("prod_img2").required = false;
												}
											}
											function c3required(){
												var c3 = document.getElementById("prod_color3").value;
												var s3 = document.getElementById("prod_stock3").value;
												if(c3.length != 0 || s3.length != 0){
													document.getElementById('c3color').innerHTML="*";
													document.getElementById('s3stock').innerHTML="*";
													document.getElementById('img3').innerHTML="*";
													document.getElementById("c3color").style.color = "red";
													document.getElementById("s3stock").style.color = "red";
													document.getElementById("img3").style.color = "red";
													document.getElementById("prod_color3").required = true;
													document.getElementById("prod_stock3").required = true;
													document.getElementById("prod_img3").required = true;
												}
												else{
													document.getElementById('c3color').innerHTML="(Optional)";
													document.getElementById('s3stock').innerHTML="(Optional)";
													document.getElementById('img3').innerHTML="(Optional)";
													document.getElementById("c3color").style.removeProperty('color');
													document.getElementById("s3stock").style.removeProperty('color');
													document.getElementById("img3").style.removeProperty('color');
													document.getElementById("prod_color3").required = false;
													document.getElementById("prod_stock3").required = false;
													document.getElementById("prod_img3").required = false;
												}
											}
											function c4required(){
												var c4 = document.getElementById("prod_color4").value;
												var s4 = document.getElementById("prod_stock4").value;
												if(c4.length != 0 || s4.length != 0){
													document.getElementById('c4color').innerHTML="*";
													document.getElementById('s4stock').innerHTML="*";
													document.getElementById('img4').innerHTML="*";
													document.getElementById("c4color").style.color = "red";
													document.getElementById("s4stock").style.color = "red";
													document.getElementById("img4").style.color = "red";
													document.getElementById("prod_color4").required = true;
													document.getElementById("prod_stock4").required = true;
													document.getElementById("prod_img4").required = true;
												}
												else{
													document.getElementById('c4color').innerHTML="(Optional)";
													document.getElementById('s4stock').innerHTML="(Optional)";
													document.getElementById('img4').innerHTML="(Optional)";
													document.getElementById("c4color").style.removeProperty('color');
													document.getElementById("s4stock").style.removeProperty('color');
													document.getElementById("img4").style.removeProperty('color');
													document.getElementById("prod_color4").required = false;
													document.getElementById("prod_stock4").required = false;
													document.getElementById("prod_img4").required = false;
												}
											}
											function c5required(){
												var c5 = document.getElementById("prod_color5").value;
												var s5 = document.getElementById("prod_stock5").value;
												if(c5.length != 0 || s5.length != 0){
													document.getElementById('c5color').innerHTML="*";
													document.getElementById('s5stock').innerHTML="*";
													document.getElementById('img5').innerHTML="*";
													document.getElementById("c5color").style.color = "red";
													document.getElementById("s5stock").style.color = "red";
													document.getElementById("img5").style.color = "red";
													document.getElementById("prod_color5").required = true;
													document.getElementById("prod_stock5").required = true;
													document.getElementById("prod_img5").required = true;
												}
												else{
													document.getElementById('c5color').innerHTML="(Optional)";
													document.getElementById('s5stock').innerHTML="(Optional)";
													document.getElementById('img5').innerHTML="(Optional)";
													document.getElementById("c5color").style.removeProperty('color');
													document.getElementById("s5stock").style.removeProperty('color');
													document.getElementById("img5").style.removeProperty('color');
													document.getElementById("prod_color5").required = false;
													document.getElementById("prod_stock5").required = false;
													document.getElementById("prod_img5").required = false;
												}
											}
											function c6required(){
												var c6 = document.getElementById("prod_color6").value;
												var s6 = document.getElementById("prod_stock6").value;
												if(c6.length != 0 || s6.length != 0){
													document.getElementById('c6color').innerHTML="*";
													document.getElementById('s6stock').innerHTML="*";
													document.getElementById('img6').innerHTML="*";
													document.getElementById("c6color").style.color = "red";
													document.getElementById("s6stock").style.color = "red";
													document.getElementById("img6").style.color = "red";
													document.getElementById("prod_color6").required = true;
													document.getElementById("prod_stock6").required = true;
													document.getElementById("prod_img6").required = true;
												}
												else{
													document.getElementById('c6color').innerHTML="(Optional)";
													document.getElementById('s6stock').innerHTML="(Optional)";
													document.getElementById('img6').innerHTML="(Optional)";
													document.getElementById("c6color").style.removeProperty('color');
													document.getElementById("s6stock").style.removeProperty('color');
													document.getElementById("img6").style.removeProperty('color');
													document.getElementById("prod_color6").required = false;
													document.getElementById("prod_stock6").required = false;
													document.getElementById("prod_img6").required = false;
												}
											}
										</script>
										<input type="submit" id="savebtn" name="savebtn" value="Add Product" class="btn btn-primary buttonedit ml-2">
										<a href="all-product.php" class="btn btn-primary buttonedit ml-2">Back to Product List</a>
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
	
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
</body>

</html>
<script>
var color1 = document.getElementById('prod_color1');
var color2 = document.getElementById('prod_color2');
var color3 = document.getElementById('prod_color3');
var color4 = document.getElementById('prod_color4');
var color5 = document.getElementById('prod_color5');
var color6 = document.getElementById('prod_color6');

function checkC1(){
	if(color1.value.toLowerCase() == color2.value.toLowerCase() || color1.value.toLowerCase() == color3.value.toLowerCase() || color1.value.toLowerCase() == color4.value.toLowerCase() || color1.value.toLowerCase() == color5.value.toLowerCase() || color1.value.toLowerCase() == color6.value.toLowerCase()){
		if(color2.value.length != 0 || color3.value.length != 0 || color4.value.length != 0 || color5.value.length != 0 || color6.value.length != 0){
			document.getElementById('error1').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color1.value.length == 0){
				document.getElementById('error1').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error1').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
function checkC2(){
	if(color2.value.toLowerCase() == color1.value.toLowerCase() || color2.value.toLowerCase() == color3.value.toLowerCase() || color2.value.toLowerCase() == color4.value.toLowerCase() || color2.value.toLowerCase() == color5.value.toLowerCase() || color2.value.toLowerCase() == color6.value.toLowerCase()){
		if(color1.value.length != 0 || color3.value.length != 0 || color4.value.length != 0 || color5.value.length != 0 || color6.value.length != 0){
			document.getElementById('error2').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color2.value.length == 0){
				document.getElementById('error2').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error2').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
function checkC3(){
	if(color3.value.toLowerCase() == color1.value.toLowerCase() || color3.value.toLowerCase() == color2.value.toLowerCase() || color3.value.toLowerCase() == color4.value.toLowerCase() || color3.value.toLowerCase() == color5.value.toLowerCase() || color3.value.toLowerCase() == color6.value.toLowerCase()){
		if(color1.value.length != 0 || color2.value.length != 0 || color4.value.length != 0 || color5.value.length != 0 || color6.value.length != 0){
			document.getElementById('error3').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color3.value.length == 0){
				document.getElementById('error3').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error3').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
function checkC4(){
	if(color4.value.toLowerCase() == color1.value.toLowerCase() || color4.value.toLowerCase() == color2.value.toLowerCase() || color4.value.toLowerCase() == color3.value.toLowerCase() || color4.value.toLowerCase() == color5.value.toLowerCase() || color4.value.toLowerCase() == color6.value.toLowerCase()){
		if(color1.value.length != 0 || color2.value.length != 0 || color3.value.length != 0 || color5.value.length != 0 || color6.value.length != 0){
			document.getElementById('error4').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color4.value.length == 0){
				document.getElementById('error4').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error4').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
function checkC5(){
	if(color5.value.toLowerCase() == color1.value.toLowerCase() || color5.value.toLowerCase() == color2.value.toLowerCase() || color5.value.toLowerCase() == color3.value.toLowerCase() || color5.value.toLowerCase() == color4.value.toLowerCase() || color5.value.toLowerCase() == color6.value.toLowerCase()){
		if(color1.value.length != 0 || color2.value.length != 0 || color3.value.length != 0 || color4.value.length != 0 || color6.value.length != 0){
			document.getElementById('error5').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color5.value.length == 0){
				document.getElementById('error5').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error5').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
function checkC6(){
	if(color6.value.toLowerCase() == color1.value.toLowerCase() || color6.value.toLowerCase() == color2.value.toLowerCase() || color6.value.toLowerCase() == color3.value.toLowerCase() || color6.value.toLowerCase() == color4.value.toLowerCase() || color6.value.toLowerCase() == color5.value.toLowerCase()){
		if(color1.value.length != 0 || color2.value.length != 0 || color3.value.length != 0 || color4.value.length != 0 || color5.value.length != 0){
			document.getElementById('error6').innerHTML="Cannot repeat the color.";
			document.getElementById('savebtn').disabled = true;

			if(color6.value.length == 0){
				document.getElementById('error6').innerHTML="";
				document.getElementById('savebtn').disabled = false;
			}
		}
	}
	else{
		document.getElementById('error6').innerHTML="";
		document.getElementById('savebtn').disabled = false;
	}
}
</script>
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
<script>

	var img=document.forms['addnewproduct']["prod_img1"];

	var validExt=["jpeg","png","jpg"];
	function validation()
	{
		if(img.value!='')
		{	
			var img_ext=img.value.substring(img.value.lastIndexOf('.')+1);
			
			var result=validExt.includes(img_ext);

			if(result==false)
			{
				swal({title: "Selected Files is Not an Image!",
					  type: "warning"});
				return false;
			}	
		}
		else
				{
					swal({title:"No image is selected!",
						 type:"warning"});
					return false;
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
	$pprice = $_POST["prod_price"];
	$pcap = $_POST["prod_cap"];
	$brand = $_POST["brand"];
	$cat = $_POST["category"];
	
	$spec_display = $_POST["spec1"];
	$spec_chip = $_POST["spec2"];
	$spec_front_cam = $_POST["spec3"];
	$spec_back_cam = $_POST["spec4"];
	$spec_battery = $_POST["spec5"];
	$spec_others = $_POST["spec6"];
	
	$c1 = $_POST["prod_color1"];
	$s1 = $_POST["prod_stock1"];
	$c2 = $_POST["prod_color2"];
	$s2 = $_POST["prod_stock2"];
	$c3 = $_POST["prod_color3"];
	$s3 = $_POST["prod_stock3"];
	$c4 = $_POST["prod_color4"];
	$s4 = $_POST["prod_stock4"];
	$c5 = $_POST["prod_color5"];
	$s5 = $_POST["prod_stock5"];
	$c6 = $_POST["prod_color6"];
	$s6 = $_POST["prod_stock6"];

	$result = mysqli_query($connect,"SELECT * FROM product WHERE product_name = '$pname'");
	$count = mysqli_num_rows($result);
	if($count != 0){
?>
					<script>
						
						swal({title:"The product name is already in use. Please change.",
							  type:"warning"});
					</script>
<?php
	}
	$checkName = strtolower($pname);
	$result1 = mysqli_query($connect,"SELECT * FROM product WHERE LOWER(product_name) = '$checkName'");
	$count1 = mysqli_num_rows($result1);
	
	$result2 = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code = '$pcode'");
	$count2 = mysqli_num_rows($result2);
	
	$result3 = mysqli_query($connect,"SELECT * FROM product_specification WHERE product_code = '$pcode'");
	$count3 = mysqli_num_rows($result3);
	
	if(isset($_FILES["prod_img1"]) || isset($_FILES["prod_img2"]) || isset($_FILES["prod_img3"]) || isset($_FILES["prod_img4"]) || isset($_FILES["prod_img5"]) || isset($_FILES["prod_img6"])){
		$img1_name = $_FILES["prod_img1"]["name"];
		$img1_size = $_FILES["prod_img1"]["size"];
		$tmp_name1 = $_FILES["prod_img1"]["tmp_name"];
		$error1 = $_FILES["prod_img1"]["error"];
		
		$img2_name = $_FILES["prod_img2"]["name"];
		$img2_size = $_FILES["prod_img2"]["size"];
		$tmp_name2 = $_FILES["prod_img2"]["tmp_name"];
		$error2 = $_FILES["prod_img2"]["error"];
		
		$img3_name = $_FILES["prod_img3"]["name"];
		$img3_size = $_FILES["prod_img3"]["size"];
		$tmp_name3 = $_FILES["prod_img3"]["tmp_name"];
		$error3 = $_FILES["prod_img3"]["error"];
		
		$img4_name = $_FILES["prod_img4"]["name"];
		$img4_size = $_FILES["prod_img4"]["size"];
		$tmp_name4 = $_FILES["prod_img4"]["tmp_name"];
		$error4 = $_FILES["prod_img4"]["error"];
		
		$img5_name = $_FILES["prod_img5"]["name"];
		$img5_size = $_FILES["prod_img5"]["size"];
		$tmp_name5 = $_FILES["prod_img5"]["tmp_name"];
		$error5 = $_FILES["prod_img5"]["error"];

		$img6_name = $_FILES["prod_img6"]["name"];
		$img6_size = $_FILES["prod_img6"]["size"];
		$tmp_name6 = $_FILES["prod_img6"]["tmp_name"];
		$error6 = $_FILES["prod_img6"]["error"];
		
		if($error1 === 0 || $error2 === 0 || $error3 === 0 || $error4 === 0 || $error6 === 0 ){
			if($img1_size > 1250000 || $img2_size > 1250000 || $img3_size > 1250000 || $img4_size > 1250000 || $img5_size > 1250000 || $img6_size > 1250000){
				$alert = "Sorry, file too large";
			}
			else{
				$img1_ex = pathinfo($img1_name, PATHINFO_EXTENSION);
				$img1_ex_lc = strtolower($img1_ex);
				
				$img2_ex = pathinfo($img2_name, PATHINFO_EXTENSION);
				$img2_ex_lc = strtolower($img2_ex);
				
				$img3_ex = pathinfo($img3_name, PATHINFO_EXTENSION);
				$img3_ex_lc = strtolower($img3_ex);
				
				$img4_ex = pathinfo($img4_name, PATHINFO_EXTENSION);
				$img4_ex_lc = strtolower($img4_ex);
				
				$img5_ex = pathinfo($img5_name, PATHINFO_EXTENSION);
				$img5_ex_lc = strtolower($img5_ex);

				$img6_ex = pathinfo($img6_name, PATHINFO_EXTENSION);
				$img6_ex_lc = strtolower($img6_ex);
				
				$allowed_exs = array("jpg","jpeg","png");
				
				if($count1 != 0 || $count2 != 0 || $count3 != 0){
?>
					<script>
						
						swal({title:"The product name is already in use. Please change.",
							  type:"warning"});
					</script>
<?php				
				}
				else{
					if(in_array($img1_ex_lc, $allowed_exs)){
						$new_img1_name = uniqid("IMG-", true).'.'.$img1_ex_lc;
						$img1_upload_path = 'product/'.$new_img1_name;
						move_uploaded_file($tmp_name1, $img1_upload_path);}
					
					if(in_array($img2_ex_lc, $allowed_exs)){
						$new_img2_name = uniqid("IMG-", true).'.'.$img2_ex_lc;
						$img2_upload_path = 'product/'.$new_img2_name;
						move_uploaded_file($tmp_name2, $img2_upload_path);}
					
					if(in_array($img3_ex_lc, $allowed_exs)){
						$new_img3_name = uniqid("IMG-", true).'.'.$img3_ex_lc;
						$img3_upload_path = 'product/'.$new_img3_name;
						move_uploaded_file($tmp_name3, $img3_upload_path);}
						
					if(in_array($img4_ex_lc, $allowed_exs)){
						$new_img4_name = uniqid("IMG-", true).'.'.$img4_ex_lc;
						$img4_upload_path = 'product/'.$new_img4_name;
						move_uploaded_file($tmp_name4, $img4_upload_path);}
						
					if(in_array($img5_ex_lc, $allowed_exs)){
						$new_img5_name = uniqid("IMG-", true).'.'.$img5_ex_lc;
						$img5_upload_path = 'product/'.$new_img5_name;
						move_uploaded_file($tmp_name5, $img5_upload_path);}
					
					if(in_array($img6_ex_lc, $allowed_exs)){
						$new_img6_name = uniqid("IMG-", true).'.'.$img6_ex_lc;
						$img6_upload_path = 'product/'.$new_img6_name;
						move_uploaded_file($tmp_name6, $img6_upload_path);}
					
					mysqli_query($connect,"INSERT INTO product (product_name,product_start_price,product_descrip,brand_name,cat_name) VALUES ('$pname','$pprice','$pdescrip','$brand','$cat')");
					
					$prod_res = mysqli_query($connect,"SELECT * FROM product WHERE product_name='$pname'");
					$prod_row = mysqli_fetch_assoc($prod_res);
					$pcode = $prod_row['product_code'];

					mysqli_query($connect,"INSERT INTO product_image (product_color1,product_img1,product_color2,product_img2,product_color3,product_img3,product_color4,product_img4,product_color5,product_img5,product_color6,product_img6,product_code) VALUES ('$c1','$new_img1_name','$c2','$new_img2_name','$c3','$new_img3_name','$c4','$new_img4_name','$c5','$new_img5_name','$c6','$new_img6_name','$pcode')");
					mysqli_query($connect,"INSERT INTO product_detail (product_capacity,product_price,product_stock1,product_stock2,product_stock3,product_stock4,product_stock5,product_stock6,product_code) VALUES ('$pcap','$pprice','$s1','$s2','$s3','$s4','$s5','$s6','$pcode')");
					mysqli_query($connect,"INSERT INTO product_specification (product_display,product_chip,product_back_cam,product_front_cam,product_battery,others,product_code) VALUES ('$spec_display','$spec_chip','$spec_back_cam','$spec_front_cam','$spec_battery','$spec_others','$pcode')");
?>

<script>
	
	swal({
    title: "Record Saved!",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-product.php';
          });
	  	
</script>
<?php
				}
			}
		}
	}
}
mysqli_close($connect);
?>