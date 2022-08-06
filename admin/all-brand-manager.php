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
                        <h1 class="h3 mb-0 text-gray-800">All Brand</h1><a href="add-brand-manager.php" class="btn btn-primary float-right veiwbutton">Add Brand</a>
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
													<label>Brand Status &nbsp;</label> <a href="all-brand-manager.php"><i style="color:black;" class="fa">&#xf021;</i></a>
													<select class="form-control" name="status" id="status" onchange="filterStatus()">
														<option disabled selected>Select</option>
														<option value="0" >Inactive</option>
														<option value="1" >Active</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Filter</label> <button type="submit" id="filterbtn" name="filterbtn" class="btn btn-success btn-block mt-0 search_button" disabled> Search </button> 
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<br/>


							<div class="row">
								<div class="col-sm-8">
										<div class="card card-table">
                                        <div class="card-body">
											<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
												<thead>
													<tr>
														<th width="50px">Code</th>
														<th width="50px">Brand</th>
														<th width="400px" style="text-align:center;">Image</th>
														<th>Status</th>
													</tr>
												</thead>
                                                <tbody>
                                                <?php

                                                if(isset($_GET["filterbtn"])){

                                                    $brand_filter = $_GET["status"];
													$result = mysqli_query($connect, "SELECT * FROM brand WHERE brand_status='$brand_filter'");
														
													while($row = mysqli_fetch_assoc($result)){
                                                        $code = $row['brand_code'];
                                                ?>
                                                <tr>
													
                                                    <td><?php echo $row['brand_code']; ?></td>
                                                    <td><?php echo $row['brand_name']; ?></td>
                                                    <td style="text-align:center;">
                                                            <img src="brand/<?=$row['brand_image']?>" alt="brand Image" height="50px" style="object-fit:contain;" >
                                                    </td>
                                                    <td>
														<?php
                                                            if(($row['brand_status'])=='0')
                                                            {
                                                            ?>
                                                            <i><a href="all-brand-manager.php?status&name=<?php echo $row['brand_name'];?>" 
                                                            class="btn btn-danger buttonedit ml-2" onclick="return confirm('Are u sure to activate <?php echo $name?>?')"> Inactive </a></i>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <i><a href="all-brand-manager.php?status&name=<?php echo $row['brand_name'];?>" 
                                                            class="btn btn-success buttonedit ml-2" onclick="return confirm('Are u sure to de-activate <?php echo $name?>?'">Active</a></i>
                                                            <?php
                                                            }
                                                            ?>
														</td>
                                                </tr>
                                            <?php
                                                }}
                                            else{
														$result = mysqli_query($connect, "SELECT * FROM brand");
														
														while($row = mysqli_fetch_assoc($result)){
															$code = $row['brand_code'];
                                                            $name = $row['brand_name'];
												?>
													<tr>
													
														<td><?php echo $row['brand_code']; ?></td>
														<td><?php echo $row['brand_name']; ?></td>
														<td style="text-align:center;">
																<img src="brand/<?=$row['brand_image']?>" alt="brand Image" height="50px" style="object-fit:contain;" >
														</td>
														<td>
														<?php
                                                            if(($row['brand_status'])=='0')
                                                            {
                                                            ?>
                                                            <i><a href="all-brand-manager.php?status&name=<?php echo $row['brand_name'];?>" 
                                                            class="btn btn-danger buttonedit ml-2"  onclick="return confirm('Are u sure to activate <?php echo $name?>?')"> Inactive </a></i>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <i><a href="all-brand-manager.php?status&name=<?php echo $row['brand_name'];?>" 
                                                            class="btn btn-success buttonedit ml-2" onclick="return confirm('Are u sure to de-activate <?php echo $name?>?');">Active</a></i>
                                                            <?php
                                                            }
                                                            ?>
														</td>
													</tr>
                                                <?php
													}}
												?>
												</tbody>
											</table>
										</div></div>
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


<?php

if(isset($_GET['status']))
{
    $name=$_GET['name'];
    $select=mysqli_query($connect,"SELECT * FROM brand where brand_name='$name'");
    $countloop = 0;
    while($row=mysqli_fetch_assoc($select))
    {
        $status=$row['brand_status'];
        if($status=='1')
        {
            $update=mysqli_query($connect,"UPDATE brand SET brand_status='0' where brand_name='$name'");
            $clearance=mysqli_query($connect,"INSERT IGNORE INTO clearance (clearance_product_code,clearance_product_name,clearance_product_start_price,clearance_descrip,clearance_product_status,clearance_brand_name,clearance_cat_name) SELECT * FROM product
                                            WHERE product.brand_name='$name'");
            $clear=mysqli_query($connect,"SELECT * FROM clearance WHERE clearance_brand_name='$name'");
            while($clearrow = mysqli_fetch_assoc($clear)){
                $clearcode=$clearrow['clearance_product_code'];
                $price=mysqli_query($connect,"UPDATE product_detail SET product_price=product_price*0.9 WHERE product_code = $clearcode");
                
                if($countloop == 0){
                    $selectCode = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code = '$clearcode'");
                    $clearPrice = array();
                    while($selectCode_row = mysqli_fetch_assoc($selectCode)){
                        $clearPrice[] = $selectCode_row['product_price'];
                    }
                    mysqli_query($connect,"UPDATE clearance SET clearance_product_start_price=clearance_product_start_price*0.9 WHERE clearance_product_code='$clearcode'");
                    $countloop++;
                }
            }
        
?>
<script>
    swal({
    title: "Brand Status Updated!",
	type: "success"
	
	},function(isConfirm){
					alert('ok');
			});
			$('.swal2-confirm').click(function(){
					window.location.href = 'all-brand-manager.php';
			});
    
</script>
<?php
        }
        else if($status=='0')
        {
            
                $update=mysqli_query($connect,"UPDATE brand SET brand_status='1' where brand_name='$name'");
                $prod=mysqli_query($connect,"SELECT * FROM product WHERE brand_name='$name'");
                while($prodrow = mysqli_fetch_assoc($prod)){
                    $pcode=$prodrow['product_code'];
                    $price=mysqli_query($connect,"UPDATE product_detail SET product_price=product_price/0.9 WHERE product_code = $pcode");
                    
                    if($countloop == 0){
                        $selectCode = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code = '$pcode'");
                        $pprice = array();
                        while($selectCode_row = mysqli_fetch_assoc($selectCode)){
                            $pprice[] = $selectCode_row['product_price'];
                        }
                        $countloop++;
                    }
                }
                mysqli_query($connect,"DELETE FROM clearance WHERE clearance_brand_name='$name'");

?>
<script>
    swal({
    title: "Brand Status Updated!",
	type: "success"
	
	},function(isConfirm){
					alert('ok');
			});
			$('.swal2-confirm').click(function(){
					window.location.href = 'all-brand-manager.php';
			});
    
</script>

<?php
        }
    }
}
}
mysqli_close($connect);
?>
<script type="text/javascript">
	function filterStatus(){
		var select = document.getElementById('status');
		var selected = select.options[select.selectedIndex].value;

		if(selected == "Select")
			document.getElementById("filterbtn").disabled=true;
		else
			document.getElementById("filterbtn").disabled=false;
	}

</script>