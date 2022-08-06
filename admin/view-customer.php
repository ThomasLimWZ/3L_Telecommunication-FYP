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
                        <h1 class="h3 mb-0 text-gray-800">Customer's Details</h1><?php include("connection.php"); ?>
                    </div>
					
					<?php
						if(isset($_GET["view"])){
							$id = $_GET["id"];

							$result = mysqli_query($connect, "SELECT * FROM customer WHERE cus_id = '$id'");
							$row = mysqli_fetch_assoc($result);
						}
					?>
                    <!-- Content Row -->				 
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="page-header">
								<div class="row align-items-center">
									<div class="col">
								
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12">
									<form name="updateadmin" method="post" action="" enctype="multipart/form-data">
										<br>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Name<input class="form-control" type="text" name="cus_name" value="<?php echo $row['cus_name']; ?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Phone Number<input class="form-control" type="text" name="cus_phone" value="<?php echo $row['cus_phone']; ?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Email<input class="form-control" type="email" name="cus_email" value="<?php echo $row['cus_email']; ?>" disabled></p>
												</div>
											</div>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<div class="cal-icon">
														<label>Join Date</label>
														<input type="text" class="form-control" name="cus_date" value=<?php $date = date_create($row['cus_join_date']);echo date_format($date,"d-m-Y");?> disabled>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="cal-icon">
														<label>Date of Birth</label>
														<?php 
															if(empty($row['cus_dob']) || $row['cus_dob']=="0000-00-00"){
														?>
															<input class="form-control" name="cus_dob" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<input class="form-control" name="cus_dob" value="<?php $date = date_create($row['cus_dob']);echo date_format($date,"d-m-Y");?>" disabled>
														<?php
															}
														?>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<div class="cal-icon">
														<label>Gender</label>
														<?php 
															if(empty($row['cus_gender'])){
														?>
															<input class="form-control" name="cus_gender" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<input class="form-control" name="cus_gender" value="<?php echo $row['cus_gender']; ?>" disabled>
														<?php
															}
														?>
													</div>
												</div>
											</div>
										</div>
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Address Details</h1>
											</div>
											<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
														<label>Address</label>
														<?php 
															if(empty($row['cus_address']) || $row['cus_address']==NULL){
														?>
															<input class="form-control" name="cus_address" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<textarea class="form-control validate" name="cus_address" rows="4" disabled><?php echo $row['cus_address'];?></textarea>
														<?php
															}
														?>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
														<label>City</label>
														<?php 
															if(empty($row['cus_city']) || $row['cus_city']==NULL){
														?>
															<input class="form-control" name="cus_city" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<textarea class="form-control validate" name="cus_city" rows="1" disabled><?php echo $row['cus_city'];?></textarea>
														<?php
															}
														?>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
														<label>State</label>
														<?php 
															if(empty($row['cus_state']) || $row['cus_state']==NULL){
														?>
															<input class="form-control" name="cus_state" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<textarea class="form-control validate" name="cus_state" rows="1" disabled><?php echo $row['cus_state'];?></textarea>
														<?php
															}
														?>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
														<label>Postcode</label>
														<?php 
															if(empty($row['cus_post_code']) || $row['cus_post_code']==NULL){
														?>
															<input class="form-control" name="cus_post_code" value="Customer haven't fill up" disabled>
														<?php
															}
															else{
														?>
															<textarea class="form-control validate" name="cus_post_code" rows="1" disabled><?php echo $row['cus_post_code'];?></textarea>
														<?php
															}
														?>
												</div>
											</div>
										</div>
										<br>
										<a href="all-customer.php" class="btn btn-primary buttonedit ml-2">Back to Customer List</a>
									</form>
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

</body>

</html>
<?php
	}
?>
<?php
mysqli_close($connect);
?>