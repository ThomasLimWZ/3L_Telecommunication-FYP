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
                        <h1 class="h3 mb-0 text-gray-800">All Customer</h1>
                    </div>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
					
							<div class="row">
								<div class="col-sm-12">
									<div class="card card-table">
									<div class="card-body">
										<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
										<?php
													$result = mysqli_query($connect, "SELECT * FROM customer");
                                                    $i=1;
											?>
													<thead>
														<tr>
															<th>No</th>
															<th>Name</th>
															<th>Phone Number</th>
															<th>Email</th>
															<th>Join Date</th>
															<th>Actions</th>
														</tr>
													</thead>
											<?php
													while($row = mysqli_fetch_assoc($result)){
														
												?>		
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row ["cus_name"];?></td>
														<td><?php echo $row ["cus_phone"];?></td>
														<td><?php echo $row ["cus_email"];?></td>
														<td><?php $date = date_create($row['cus_join_date']);echo date_format($date,"d-m-Y");?></td>
														<td>
														<a href="view-customer.php?view&id=<?php echo $row['cus_id'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
														</td>
													</tr>
													<?php
													$i++;
													}
																							
												?>	
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
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

</body>

</html>

<?php
	}
	mysqli_close($connect);
?>