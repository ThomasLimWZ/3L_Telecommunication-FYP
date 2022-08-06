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

	<!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h1 class="h3 mb-0 text-gray-800">All Sales</h1>
                                    <div class="dropdown mb-4">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Generate Report
                                        </button>
                                        <div class="dropdown-menu animated--fade-in"
                                            aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="generate_pdf_allsales.php" target="_blank">Product Sales</a>
                                            <a class="dropdown-item" href="generate_pdf_yearsales.php" target="_blank">Yearly Sales</a>
                                            <a class="dropdown-item" href="generate_pdf_monthsales.php" target="_blank">Monthly Sales</a>
                                        </div>
                        </div>
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
												<label>Show Sales From&nbsp;</label> <a href="all-sales.php"><i style="color:black;" class="fa">&#xf021;</i></a>
												<input type="date" name="duration1" class="form-control" id="duration1" value="<?php if(isset($_GET['duration1'])){echo $_GET['duration1'];}?>" required>
											</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
												<label>To</label>
												<input type="date" name="duration2" class="form-control" id="duration2" value="<?php if(isset($_GET['duration2'])){echo $_GET['duration2'];}?>" required>
												
													</div>
													</div>
												<div class="col-md-3">
												<div class="form-group">
													<label>Filter</label> 
													<input type="submit" value="Search" id="filterbtn" name="filterbtn" class="btn btn-success btn-block mt-0 search_button">
													
												</div>
											</div></div>
										</form>
									
								</div>
							</div>
							<div class="row">
							<div class="col-sm-12">
								<div class="card card-table">
									<div class="card-body">
									<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
									<thead>
										<tr>
											<th>No.</th>
											<th>Customer Name</th>
											<th>Order Date & Time</th>
											<th>Grand Total (RM)</th>
											<th>Actions</th>
										</tr>
									</thead>										
										<tbody>
							
							<?php
							if(isset($_GET['filterbtn'])){

							$from=$_GET['duration1'];
							$to=$_GET['duration2'];
							$start=$from."00:00:00";
							$end=$to."23:59:59";
							$date1 = date("Y-m-d H:i:s", strtotime($start));
							$date2 = date("Y-m-d H:i:s", strtotime($end));
							?>
						
							<div>
							<h5>
							<?php
							if($date2 < $date1)	
							{
								echo "<h5><b>";	
								echo 'The to date must bigger than from date';	
								echo "</b></h5>";
							}	
							else
							{
								
									echo "<h5><b>";		
									echo $date1;
									echo " until ";
									echo $date2;
									echo "</b></h5>";
							?>
							</h5>
										

										<?php
										$no=1;
										
										$query = mysqli_query($connect, "SELECT * FROM payment INNER JOIN customer ON payment.cus_email=customer.cus_email WHERE payment.payment_date BETWEEN '$date1' AND '$date2' ORDER BY payment.payment_date");
										while($row = mysqli_fetch_assoc($query)){
											$pay_code=$row['payment_code'];
											
											$ship = mysqli_query($connect, "SELECT * FROM shipping WHERE payment_code='$pay_code' AND delivery_status=3");
											while($srow = mysqli_fetch_assoc($ship)){	
									?>
											<tr>
												<td><?php echo $no;?></td>
												<td><?php echo $row ["cus_name"];?></td>
												<td><?php 
													$date = date_create($row['payment_date']);
													echo date_format($date,"d-m-Y H:i:s");
												?></td>
												<td><?php echo $row ["payment_total"];?></td>
												<td>
												<!-- Call to action buttons -->
												<ul class="list-inline m-0">
												<li class="list-inline-item">
													<a href="view-sales.php?view&code=<?php echo $row['payment_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
												</li>
												<li class="list-inline-item">
													<a href="generate_pdf_sales.php?pdf&code=<?php echo $row['payment_code'];?>"  target="_blank"><button class="btn btn-success btn-sm rounded-0" type="button" title="Generate Invoice"><i class="fa fa-file-pdf"></i></button></a>
												</li>
												</ul>
												</td>
											</tr>
										<?php
												$no++;
												}	}							
										}}
									else{
													$i=1;
													$result = mysqli_query($connect, "SELECT * FROM payment INNER JOIN customer ON payment.cus_email=customer.cus_email ORDER BY payment.payment_date");	
													
													while($row = mysqli_fetch_assoc($result)){
														$pay_code=$row['payment_code'];
														$ship = mysqli_query($connect, "SELECT * FROM shipping WHERE payment_code='$pay_code' AND delivery_status=3");
														
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
														<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="view-sales.php?view&code=<?php echo $row['payment_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
															</li>
															<li class="list-inline-item">
																<a href="generate_pdf_sales.php?pdf&code=<?php echo $row['payment_code'];?>"  target="_blank"><button class="btn btn-success btn-sm rounded-0" type="button" title="Generate Invoice"><i class="fa fa-file-pdf"></i></button></a>
															</li>
														</ul>
														</td>
													</tr>
													<?php
													$i++;
													}
												}	}											
												?>	
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<br/>
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

<?php
	}
mysqli_close($connect);
?>