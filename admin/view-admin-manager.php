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
                        <h1 class="h3 mb-0 text-gray-800">View Admin</h1>
                    </div>
					
					<?php
						if(isset($_GET["view"])){
							$id = $_GET["id"];

							$result = mysqli_query($connect, "SELECT * FROM admin WHERE adm_id = '$id'");
							$row = mysqli_fetch_assoc($result);
						}
					?>
                    <!-- Content Row -->				 
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form method="post" action="" enctype="multipart/form-data">
										<div class="row formtype">
											<?php
												if(empty($row['adm_profile_pic'])){
											?>
													<img class="rounded-circle img-responsive mt-2" src="img/undraw_profile.svg" alt="Admin Image" width="150px" height="150px"></a>
											<?php
												}
												else{
											?>
												<img src="admin-profile-pic/<?=$row['adm_profile_pic']?>" class="rounded-circle img-responsive mt-2" width="150" height="150">
											<?php
												}
											?>
										</div>
										<br>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Admin ID<input class="form-control" type="text" name="admin_id" value="<?php echo $row['adm_id']; ?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Name<input class="form-control" type="text" name="admin_name" value="<?php echo $row['adm_name']; ?>" disabled></p>
												</div>
											</div>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Email<input class="form-control" type="email" name="admin_email" value="<?php echo $row['adm_email']; ?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Phone Number<input class="form-control" type="text" name="admin_phone" value="<?php echo $row['adm_phone']; ?>" disabled></p>
												</div>
											</div>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Join Date<input class="form-control" type="text" name="admin_join_date" value="<?php $date = date_create($row['adm_join_date']);echo date_format($date,"d-m-Y");?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Position<input class="form-control" type="text" name="admin_role" value="<?php echo $row['adm_position'];?>" disabled></p>
												</div>
											</div>
											</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Status<input class="form-control" type="text" name="admin_status" value="<?php if($row['adm_status'] == 1)echo "Active";else echo "Inactive";?>" disabled></p>
												</div>
											</div>
										</div>
										<br>
										<a href="all-admin-manager.php" class="btn btn-primary buttonedit ml-2">Back to Admin List</a>
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
<?php
	}
?>