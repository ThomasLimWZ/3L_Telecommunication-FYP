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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

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
                        <h1 class="h3 mb-0 text-gray-800">Edit Profile</h1>
                    </div>

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
									<form method="POST" action="">
										<div class="row formtype">
											<div class="col-md-4">
												<?php
													$adm_id = $_SESSION['id'];
													$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id = '$adm_id'");
													$row = mysqli_fetch_assoc($result);
												?>
												<div class="form-group">
													<p>Admin ID <input class="form-control" type="text" name="admin_id" value="<?php echo $row['adm_id']; ?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Name<input class="form-control" type="text" name="admin_name" value="<?php echo $row['adm_name']; ?>" required></p>
												</div>
											</div>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Email <input class="form-control" type="email" name="admin_email" value="<?php echo $row['adm_email']; ?>"required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
                                                    Phone Number <input type="tel" class="form-control" name="admin_phone" placeholder="01xxxxxxxxx" value="<?php echo $row['adm_phone']; ?>" minlength="10" maxlength="11" pattern="(01)[0-9]{8,9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
												</div>
											</div>
										</div>
										<input type="submit" name="savebtn" value="Update Profile" class="btn btn-primary buttonedit ml-2">
                                        <a href="profile-manager.php" class="btn btn-primary buttonedit ml-2">Back to Profile</a>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> 
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
<?php
	}
?>

<?php
if(isset($_POST["savebtn"])){
	$name = $_POST["admin_name"];
	$email = $_POST["admin_email"];
	$phone = $_POST["admin_phone"];
	
    $checkMail = strtolower($email);
    $result = mysqli_query($connect,"SELECT * FROM admin WHERE LOWER(adm_email) = '$checkMail' AND LOWER(adm_email) NOT IN ('$checkMail')");
    $count = mysqli_num_rows($result);
    if($count != 0){
?>
<script>
		swal({title:"This email is already in used.",type:"warning"});
</script>
<?php
    }
    else if($checkMail==$row['adm_email'])
		{
?>
			<script>
			swal({title:"This email is same with current email.",type:"warning"});
			</script>
<?php
		}
    else{
	    mysqli_query($connect,"UPDATE admin SET adm_name='$name', adm_email='$email', adm_phone='$phone' WHERE adm_id='$adm_id'");
?>
<script>
	swal({
    title: "Record updated.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'profile-manager.php';
          });
	  	
</script>
<?php
    }
}
mysqli_close($connect);
?>