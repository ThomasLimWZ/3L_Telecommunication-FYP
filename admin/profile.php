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

<style> 
.circle{position:relative;
		width:150px;
		height:150px;
		border-radius:50%;
		overflow: hidden;
		margin:auto;}
.image{position:absolute;
	   top:0;
	   left:0;
	   width:100%;
	   height:100%;
	   background: rgb(0,0,0,0.3);
	   color:#ffffff;
	   font-family:'Quicksand';
	   font-size:10px;
	   display:flex;
	   flex-drrection:column;
	   align-items:center;
	   justify-content:center;
	   opacity: 0;
	   transition: opacity 0.25s;
	   cursor:pointer;}

.image > * {transform: translateY(20px);
			transition: transform 0.25s;}

.image:hover { opacity: 1;}

.image:hover > * {transform: translateY(0);}

.image_title { font-size: 2em;
			   font-weight: bold;}
</style>
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
                        <h1 class="h3 mb-0 text-gray-800">Profile</h1>
                    </div>

                    <!-- Content Row -->
					<br>
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="container-fluid p-0">
								<div class="row">
									<div class="col-md-3 col-xl-2">
										<div class="card">
											<div class="card-header">
												<h5 class="card-title mb-0">Profile Settings</h5>
											</div>

											<div class="list-group list-group-flush" role="tablist">
												<a class="list-group-item list-group-item-action active" href="profile.php">
													Account
												</a>
												<a class="list-group-item list-group-item-action" href="password.php">
													Password
												</a>
											</div>
										</div>
									</div>

									<div class="col-md-9 col-xl-10">
										<div class="tab-content">
											<div class="tab-pane fade show active">

												<div class="card">
													<div class="card-header">
														<h5 class="card-title mb-0">Personal Details</h5>
													</div>
													<div class="card-body">
														<h5 class="card-title d-flex justify-content-between">
															<div class="col-auto profile-btn"></div>
															<a href="edit-profile.php"><i class="fa fa-edit mr-1"></i>Edit</a>
														</h5>
														<div class="text-center">
														<?php
															$adm_id = $_SESSION['id'];
															$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id = '$adm_id'");
															$row = mysqli_fetch_assoc($result);
														?>
															<a href="update-profilepic.php">
																<div class ="circle">
																	<?php
																	if(empty($row['adm_profile_pic'])){
																	?>
																			<img class="rounded-circle img-responsive" src="img/undraw_profile.svg" alt="Admin Image"  width="150px" height="150px">
																	<?php
																		}
																		else{
																	?>
																		<img class="rounded-circle img-responsive" src="admin-profile-pic/<?=$row['adm_profile_pic']?>" alt="Admin Image" width="150px" height="150px">
																	<?php
																		}
																	?>
																	
																	<div class="image">
																		<div class="image_title"><i class="fa">&#xf03e;</i> Select</div>
																	</div>
																</div>
															</a>
															<br><br>
															<table align="center" width="50%" style="text-align:left;">
																<tr>
																	<td>Admin ID : </td>
																	<td><?php echo $row['adm_id']; ?></td>
																</tr>
																	
																<tr>
																	<td>Name : </td>
																	<td><?php echo $row['adm_name']; ?></td>
																</tr>
																
																
																<tr>
																	<td>Position : </td>
																	<td><?php echo $row['adm_position']; ?></td>
																</tr>
																
																<tr>
																	<td>Email : </td>
																	<td><?php echo $row['adm_email']; ?></td>
																</tr>
	
																<tr>
																	<td>Phone Number : </td>
																	<td><?php echo $row['adm_phone']; ?></td>
																</tr>


																<tr>
																	<td>Join Date :  </td>
																	<td><?php 
																		$date = date_create($row['adm_join_date']);
																		echo date_format($date,"d-m-Y");
																	?></td>
																</tr>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<br><br><br>
            <!-- End of Main Content -->

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