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
                        <h1 class="h3 mb-0 text-gray-800">Yesterday's Order</h1>
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
													<label>Order Status &nbsp;</label> <a href="yesterday-order-manager.php"><i style="color:black;" class="fa">&#xf021;</i></a>
													<select class="form-control" name="shipping" id="shipping" onchange="filterStatus()">
														<option disabled selected>Select</option>
														<option value="0" >Preparing</option>
														<option value="1" >Shipped Out</option>
														<option value="2" >Delivery in progress</option>
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
									<br/>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
								<form method="GET" action="">
									<div class="card card-table">
									<div class="card-body">
											<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
											<?php
												if(isset($_GET["filterbtn"])){
													$i=1;
													$shipping_filter = $_GET["shipping"];
													$result = mysqli_query($connect, "SELECT * FROM payment JOIN shipping ON payment.payment_code=shipping.payment_code
																					  WHERE shipping.delivery_status='$shipping_filter' AND delivery_status!=3 AND date(payment_date)=CURDATE()-1");
													
											?>
											<thead>
												<tr>
													<th>No.</th>
													<th>Customer Name</th>
													<th>Order Date</th>
													<th>Grand Total (RM)</th>
													<th>Tracking Number</th>
													<th>Order Status</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php
													while($row = mysqli_fetch_assoc($result)){
														$pay_email=$row['cus_email'];
														$cus = mysqli_query($connect, "SELECT * FROM customer WHERE cus_email='$pay_email'");
														while($crow = mysqli_fetch_assoc($cus)){
														
											?>
													<tr>
													<td><?php echo $i;?></td>
														<td><?php echo $crow ["cus_name"];?></td>
														<td><?php 
															$date = date_create($row['payment_date']);
															echo date_format($date,"d-m-Y H:i:s");
														?></td>
														<td><?php echo $row ["payment_total"];?></td>
														<td>
															<?php
																if(empty($row['tracking_number']))
																{
																	echo "Haven't update";
																}
																else
																{
																	echo $row['tracking_number'];
																}
															?>
														</td>
														<td>
															<?php
															if($row['delivery_status'] == 0)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-warning buttonedit ml-2" onclick="return confirm('Update status to Shipped Out?')"> Preparing </a></i>
                                                            <?php
                                                            }
                                                            else if($row['delivery_status'] == 1)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-info buttonedit ml-2" onclick="return confirm('Update status to Delivering in Progress?');">Shipped Out</a></i>
                                                            <?php
                                                            }
															else if($row['delivery_status'] == 2)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-primary buttonedit ml-2" onclick="return confirm('Update status to Delivered?');">Delivery in Progress</a></i>
                                                            <?php
                                                            }
															else
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-success buttonedit ml-2">Delivered</a></i>
                                                            <?php
                                                            }
                                                            ?>
														</td>
													
														<td>
														<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="view-order-manager.php?view&code=<?php echo $row['payment_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
															</li>
															<li class="list-inline-item">
																<a href="edit-order-manager.php?edit&code=<?php echo $row['payment_code'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
															</li>
														</ul>
														</td>
													</tr>
												<?php
													$i++;
														}
													}}
													
												else{
													
													$i=1;
													$result = mysqli_query($connect, "SELECT * FROM payment INNER JOIN customer ON payment.cus_email=customer.cus_email
																					  WHERE date(payment_date)=CURDATE()-1 ");	
												?>
												<thead>
														<tr>
															<th>No.</th>
															<th>Customer Name</th>
															<th>Order Date & Time</th>
															<th>Grand Total (RM)</th>
															<th>Tracking Number</th>
															<th>Order Status</th>
															<th>Actions</th>
														</tr>
												</thead>
												<?php
													while($row = mysqli_fetch_assoc($result)){
											
														$pay_code=$row['payment_code'];
														$ship = mysqli_query($connect, "SELECT * FROM shipping WHERE payment_code='$pay_code' AND delivery_status!=3");
													
														while($srow = mysqli_fetch_assoc($ship)){
												?>	
										
													<tr>
													
														<td><?php echo $i;?></td>
														<td><?php echo $row ["cus_name"];?></td>
														<td><?php 
															$date = date_create($row['payment_date']);
															echo date_format($date,"d-m-Y H:i:s");
														?></td>
														<td><?php echo $row ["payment_total"];?></td>
														<td>
															<?php
																if(empty($srow['tracking_number']))
																{
																	echo "Haven't update";
																}
																else
																{
																	echo $srow['tracking_number'];
																}
															?>
														</td>
														<td>
															<?php
															if($srow['delivery_status'] == 0)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-warning buttonedit ml-2" onclick="return confirm('Update status to Shipped Out?')"> Preparing </a></i>
                                                            <?php
                                                            }
                                                            else if($srow['delivery_status'] == 1)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-info buttonedit ml-2" onclick="return confirm('Update status to Delivering in Progress?');">Shipped Out</a></i>
                                                            <?php
                                                            }
															else if($srow['delivery_status'] == 2)
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-primary buttonedit ml-2" onclick="return confirm('Update status to Delivered?');">Delivery in Progress</a></i>
                                                            <?php
                                                            }
															else
                                                            {
                                                            ?>
                                                            <i><a href="yesterday-order-manager.php?status&code=<?php echo $row['payment_code'];?>" 
                                                            class="btn btn-success buttonedit ml-2">Delivered</a></i>
                                                            <?php
                                                            }
                                                            ?>
														</td>
														
														<td>
														<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="view-order-manager.php?view&code=<?php echo $row['payment_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
															</li>
															<li class="list-inline-item">
																<a href="edit-order-manager.php?edit&code=<?php echo $row['payment_code'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
															</li>
														</ul>
														</td>
													</tr>
													<?php
													$i++;
													}}
												}												
												?>	
											</tbody>
										</table>
									</form>
									</div>
								</div>
							</div>
							<br>
						</div>
					</div>
				</div>
			</div>
		</div>
            <!-- /.container-fluid -->
			
            <!-- End of Main Content -->
			<br/>
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
<style>
#sort {
border: none;
outline: none;
background: none;
}

</style>
<script type="text/javascript">
	function filterStatus(){
		var select = document.getElementById('shipping');
		var selected = select.options[select.selectedIndex].value;

		if(selected == "Select")
			document.getElementById("filterbtn").disabled=true;
		else
			document.getElementById("filterbtn").disabled=false;
	}

</script>
<?php
if(isset($_GET['status']))
{
    $code=$_GET['code'];
	$admin=$_SESSION['id'];

	$select=mysqli_query($connect,"SELECT * FROM shipping WHERE payment_code='$code'");
    while($statusrow=mysqli_fetch_assoc($select))
    {
		$status=$statusrow['delivery_status'];
		if($status=='0')
        {
			$generate = substr(str_shuffle("0123456789"), 0, 8);
			$uniq = "T".$generate."MY";
			$update=mysqli_query($connect,"UPDATE shipping SET tracking_number='$uniq',delivery_status='1',adm_id='$admin' WHERE payment_code='$code'");
?>
<script>
	swal({
		title: "Order Status Updated!",
		type: "success"
				
		},function(isConfirm){
			alert('ok');
	});
	$('.swal2-confirm').click(function(){
		window.location.href = 'yesterday-order-manager.php';
	});
				
</script>
<?php
	}
	else if($status=='1')
	{
		$update=mysqli_query($connect,"UPDATE shipping SET delivery_status='2',adm_id='$admin' WHERE payment_code='$code'");
?>
<script>
swal({
	title: "Order Status Updated!",
	type: "success"
			
	},function(isConfirm){
		alert('ok');
});
$('.swal2-confirm').click(function(){
	window.location.href = 'yesterday-order-manager.php';
});
			
</script>
<?php
	}
	else if($status=='2')
	{
		$update=mysqli_query($connect,"UPDATE shipping SET delivery_status='3',adm_id='$admin' WHERE payment_code='$code'");
?>
<script>
swal({
	title: "Order Status Updated!",
	type: "success"
			
	},function(isConfirm){
		alert('ok');
});
$('.swal2-confirm').click(function(){
	window.location.href = 'yesterday-order-manager.php';
});
			
</script>
<?php
	}
}
}
}
mysqli_close($connect);
?>