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
	<!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

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
                        <h1 class="h3 mb-0 text-gray-800">All Product</h1><a href="add-product-manager.php" class="btn btn-primary float-right veiwbutton">Add Product</a>
                    </div>
					
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form method="GET" action="">
										<div class="row formtype">
											<div class="col-md-3">
												<div class="form-group">
													<label>Brand &nbsp;</label> <a href="all-product-manager.php"><i style="color:black;" class="fa">&#xf021;</i></a>
													<select class="form-control" name="brand" id="filtercode" onchange="filterBrand()">
														<option selected disabled>Select</option>
														<?php
															$brand_option = mysqli_query($connect,"SELECT * FROM brand WHERE brand_status=1");
															
															while($brand_row = mysqli_fetch_assoc($brand_option)){
														?>
																<option value="<?php echo $brand_row['brand_name'];?>" <?php if($_GET['brand'] == $brand_row['brand_name'])echo "selected";?> ><?php echo $brand_row['brand_name']?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Filter</label> <button type="submit" id="filterbtn" name="filterbtn" class="btn btn-success btn-block mt-0 search_button" disabled> Filter </button> 
												</div>
											</div>
										</div>
									</form>
									<br/>
									<form method="GET" action="">
										<div class="row formtype">
											<div class="col-md-3">
												<div class="form-group">
													<label>Category &nbsp;</label> <a href="all-product-manager.php"><i style="color:black;" class="fa">&#xf021;</i></a>
													<select class="form-control" name="category" id="cat" onchange="filterCat()">
														<option selected disabled>Select</option>
														<?php
															$cat_option = mysqli_query($connect,"SELECT * FROM category");
															
															while($cat_row = mysqli_fetch_assoc($cat_option)){
														?>
																<option value="<?php echo $cat_row['cat_name'];?>" <?php if($_GET['category'] == $cat_row['cat_name'])echo "selected";?> ><?php echo $cat_row['cat_name']?></option>";
														<?php
															}
														?>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Filter</label> <button type="submit" id="filtercat" name="filtercat" class="btn btn-success btn-block mt-0 search_button" disabled> Filter </button> 
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
						<br/>

							<div class="row">
								<div class="col-sm-12">
									<form method="GET" action="">
										<div class="card card-table">
										<div class="card-body">
											<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
												<?php
													if(isset($_GET["filterbtn"])){
														$i = 1;
														$brand_filter = $_GET["brand"];
														$result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name 
																						  WHERE product.brand_name='$brand_filter' AND product.product_status = 1 AND brand.brand_status=1");
													
												?>
												<thead>
													<tr>
														<th>&nbsp;</th>
														<th>No.</th>
														<th>Name</th>
														<th>Brand</th>
														<th>Category</th>
														<th>Price (RM) </th>
														<th>Stock Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
												<?php
														while($row = mysqli_fetch_assoc($result)){
															$prod_code = $row['product_code'];
															$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$prod_code'");
															$price = array();
															$stock = array();
															while($detail_row = mysqli_fetch_assoc($detail_result)){
																$price[] = $detail_row['product_price'];
																$stock[] = $detail_row['product_stock1']+$detail_row['product_stock2']+$detail_row['product_stock3']+$detail_row['product_stock4']+$detail_row['product_stock5']+$detail_row['product_stock6'];
															}
															$max = $price[0];
															$min = $price[0];
															foreach($price as $key => $val){
																if($max < $val){
																	$max = $val;
																}
															}
															foreach($price as $key => $val){
																if($min > $val){
																	$min = $val;
																}
															}
															$total_stock = array_sum($stock);
												?>
													<tr>
														<td><input type="checkbox" onclick="terms_changed(this)" name="delete[]" value="<?php echo $row['product_code']; ?>"></td>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['product_name']; ?></td>
														<td><?php echo $row['brand_name']; ?></td>
														<td><?php echo $row['cat_name']; ?></td>
														<td>
															<?php 
																if(count($price) > 1){
																	echo $min." - RM ".$max;
																}
																else{
																	echo $min;
																}
															?>
														</td>
														<td>
															<b>
																<?php if($total_stock >5){
																		echo '<span style="color:green;">Sufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																	else{
																		echo'<span style="color:red;">Insufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																?>
															</b>
														</td>	
														<td>	
															<!-- Call to action buttons -->
															<ul class="list-inline m-0">
																<li class="list-inline-item">
																	<a href="view-product-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="edit-product-manager.php?edit&code=<?php echo $row['product_code'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="all-product-manager.php?del&code=<?php echo $row['product_code'];?>" onclick="return del_confirmation();"><button class="btn btn-danger btn-sm rounded-0" type="button" title="Delete"><i class="fa fa-trash"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="product-details-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-info btn-sm rounded-0" type="button" title="Add product details"><i class="far fa-file-alt"></i></button></a>
																</li>
															</ul>
														</td>
													</tr>
													<?php
													$i++;
														}}
														
														else if(isset($_GET["filtercat"])){
															$i = 1;
															$cat_filter = $_GET["category"];
															$result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name 
																							  WHERE product.cat_name='$cat_filter' AND product.product_status = 1 AND brand.brand_status=1");
															
													?>
													<thead>
														<tr>
															<th>&nbsp;</th>
															<th>No.</th>
															<th>Name</th>
															<th>Brand</th>
															<th>Category</th>
															<th>Price (RM) </th>
															<th>Stock Status</th>
															<th>Actions</th>
														</tr>
													</thead>
													<tbody>
													<?php
															while($row = mysqli_fetch_assoc($result)){
																$prod_code = $row['product_code'];
																$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$prod_code'");
																$price = array();
																$stock = array();
																while($detail_row = mysqli_fetch_assoc($detail_result)){
																	$price[] = $detail_row['product_price'];
																	$stock[] = $detail_row['product_stock1']+$detail_row['product_stock2']+$detail_row['product_stock3']+$detail_row['product_stock4']+$detail_row['product_stock5']+$detail_row['product_stock6'];
																}
																$max = $price[0];
																$min = $price[0];
																foreach($price as $key => $val){
																	if($max < $val){
																		$max = $val;
																	}
																}
																foreach($price as $key => $val){
																	if($min > $val){
																		$min = $val;
																	}
																}
																$total_stock = array_sum($stock);
													?>
														<tr>
															<td><input type="checkbox" onclick="terms_changed(this)" name="delete[]" value="<?php echo $row['product_code']; ?>"></td>
															<td><?php echo $i; ?></td>
															<td><?php echo $row['product_name']; ?></td>
															<td><?php echo $row['brand_name']; ?></td>
															<td><?php echo $row['cat_name']; ?></td>
															<td>
																<?php 
																	if(count($price) > 1){
																		echo $min." - RM ".$max;
																	}
																	else{
																		echo $min;
																	}
																?>
															</td>
															<td>
																<b>
																	<?php if($total_stock >5){
																			echo '<span style="color:green;">Sufficient</span>';
																			echo ' ('.$total_stock.')';
																		}
																		else{
																			echo'<span style="color:red;">Insufficient</span>';
																			echo ' ('.$total_stock.')';
																		}
																	?>
																</b>
															</td>	
															<td>	
																<!-- Call to action buttons -->
																<ul class="list-inline m-0">
																	<li class="list-inline-item">
																		<a href="view-product-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
																	</li>
																	<li class="list-inline-item">
																		<a href="edit-product-manager.php?edit&code=<?php echo $row['product_code'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
																	</li>
																	<li class="list-inline-item">
																		<a href="all-product-manager.php?del&code=<?php echo $row['product_code'];?>" onclick="return del_confirmation();"><button class="btn btn-danger btn-sm rounded-0" type="button" title="Delete"><i class="fa fa-trash"></i></button></a>
																	</li>
																	<li class="list-inline-item">
																		<a href="product-details-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-info btn-sm rounded-0" type="button" title="Add product details"><i class="far fa-file-alt"></i></button></a>
																	</li>
																</ul>
															</td>
														</tr>
														<?php
														$i++;
															}
															}
												
													else{
												?>
													<thead>
														<tr>
															<th>&nbsp;</th>
															<th>No.</th>
															<th>Name</th>
															<th>Brand</th>
															<th>Category</th>
															<th>Price (RM) </th>
															<th>Stock Status</th>
															<th>Actions</th>
														</tr>
													</thead>
												<?php
														$i = 1;
														$result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status = 1 AND brand.brand_status=1");
														
														while($row = mysqli_fetch_assoc($result)){
															$prod_code = $row['product_code'];
															$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$prod_code'");
															$price = array();
															$stock = array();
															while($detail_row = mysqli_fetch_assoc($detail_result)){
																$price[] = $detail_row['product_price'];
																$stock[] = $detail_row['product_stock1']+$detail_row['product_stock2']+$detail_row['product_stock3']+$detail_row['product_stock4']+$detail_row['product_stock5']+$detail_row['product_stock6'];
															}
															$max = $price[0];
															$min = $price[0];
															foreach($price as $key => $val){
																if($max < $val){
																	$max = $val;
																}
															}
															foreach($price as $key => $val){
																if($min > $val){
																	$min = $val;
																}
															}
															$total_stock = array_sum($stock);
												?>
													<tr>
														<td><input type="checkbox" onclick="terms_changed(this)" name="delete[]" value="<?php echo $row['product_code']; ?>"></td>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['product_name']; ?></td>
														<td><?php echo $row['brand_name']; ?></td>
														<td><?php echo $row['cat_name']; ?></td>
														<td>
															<?php 
																if(count($price) > 1){
																	echo $min." - RM ".$max;
																}
																else{
																	echo $min;
																}
															?>
														</td>
														<td>
															<b>
																<?php if($total_stock >5){
																		echo '<span style="color:green;">Sufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																	else{
																		echo'<span style="color:red;">Insufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																?>
															</b>
														</td>	
														<td>	
															<!-- Call to action buttons -->
															<ul class="list-inline m-0">
																<li class="list-inline-item">
																	<a href="view-product-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="edit-product-manager.php?edit&code=<?php echo $row['product_code'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="all-product-manager.php?del&code=<?php echo $row['product_code'];?>" onclick="return del_confirmation();"><button class="btn btn-danger btn-sm rounded-0" type="button" title="Delete"><i class="fa fa-trash"></i></button></a>
																</li>
																<li class="list-inline-item">
																	<a href="product-details-manager.php?view&code=<?php echo $row['product_code'];?>"><button class="btn btn-info btn-sm rounded-0" type="button" title="Add product details"><i class="far fa-file-alt"></i></button></a>
																</li>
															</ul>
														</td>
													</tr>
												<?php
															$i++;
														}
													}
												?>
												</tbody>
											</table>
										</div>
										<br>
										<button type="submit" id="deletebtn" name="deletebtn" class="btn btn-primary btn-block" onclick="return del_confirmation();" disabled>DELETE Selected Product</button>
										<br>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

            <!-- /.container-fluid -->
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

	<!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script> 
</body>

</html>

<script type="text/javascript">
	function terms_changed(termsCheckBox){
		if(termsCheckBox.checked){
			document.getElementById("deletebtn").disabled = false;
		} else{
			document.getElementById("deletebtn").disabled = true;
		}
	}
	function filterBrand(){
		var select = document.getElementById('filtercode');
		var selected = select.options[select.selectedIndex].value;

		if(selected == "Select")
			document.getElementById("filterbtn").disabled=true;
		else
			document.getElementById("filterbtn").disabled=false;
	}
	function filterCat(){
		var select = document.getElementById('cat');
		var selected = select.options[select.selectedIndex].value;

		if(selected == "Select")
			document.getElementById("filtercat").disabled=true;
		else
			document.getElementById("filtercat").disabled=false;
	}
	function del_confirmation(){
		var option;
		option = confirm("Do you want to delete the product?");
		return option;
	}
</script>

<?php
	}
?>
<?php
//remove multiple products
if(isset($_GET['deletebtn'])){
	$product = $_GET["delete"];
	foreach($product as $id){
		mysqli_query($connect,"UPDATE product SET product_status = 0 WHERE product_code='$id'");
	}
?>
<script>
	swal({
    title: "The product is deleted!",
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

//remove product
if(isset($_GET["del"])) {
	$pcode = $_GET['code'];
	//update product table and set product_status to 0
	mysqli_query($connect,"UPDATE product SET product_status = 0 WHERE product_code='$pcode'");
?>
<script>
	swal({
    title: "The product is deleted!",
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
mysqli_close($connect);
?>


