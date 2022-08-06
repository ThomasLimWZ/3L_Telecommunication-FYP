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
<script>
function display(e){
	if(e.files[0]){
		var reader = new FileReader();
		
		reader.onload = function(e){
			document.querySelector('#profileDis').setAttribute('src',e.target.result);
		}
		reader.readAsDataURL(e.files[0]);
	}
}
</script>
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
                        <h1 class="h3 mb-0 text-gray-800">Select New Profile Image</h1>
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
							<?php
								$adm_id = $_SESSION['id'];
								$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id = '$adm_id'");
								$row = mysqli_fetch_assoc($result);
							?>
								<?php
									if(empty($row['adm_profile_pic'])){
								?>
									<img class="rounded-circle img-responsive" src="img/undraw_profile.svg" alt="Admin Image"  width="150px" height="150px">
								<?php
									}
									else{
								?>
									<img class="rounded-circle img-responsive" src="admin-profile-pic/<?=$row['adm_profile_pic']?>" id="profileDis" alt="Admin Image" width="150px" height="150px">
								<?php
									}
								?>
								
								<div class="col-lg-12">
								<form method="post" name="myform" onsubmit="return validation()" action="" enctype="multipart/form-data">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<br>
														<input type="file" onchange="display(this)"  name="adm_profile_pic"><br>
												
												</div>
											</div>
										</div>
										<br>
										<input type="submit" name="savebtn" value="Save" class="btn btn-primary buttonedit ml-2">
										<a href="profile.php" class="btn btn-primary buttonedit ml-2">Discard</a>
									</form>
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
</body>

</html>

<script>
	var img=document.forms['myform']['adm_profile_pic'];
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
if(isset($_POST['savebtn'])){
	if(isset($_FILES["adm_profile_pic"])){
		$pic_name = $_FILES["adm_profile_pic"]["name"];
		$pic_size = $_FILES["adm_profile_pic"]["size"];
		$tmp_name = $_FILES["adm_profile_pic"]["tmp_name"];
		$error = $_FILES["adm_profile_pic"]["error"];
			
		if($error === 0){
			if($pic_size > 1250000){
				$alert = "Sorry, file too large";
			}
			else{
				$pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
				$pic_ex_lc = strtolower($pic_ex);
					
				$allowed_exs = array("jpg","jpeg","png");
					
				if(in_array($pic_ex_lc, $allowed_exs)){
					$new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
					$pic_upload_path = 'admin-profile-pic/'.$new_pic_name;
					move_uploaded_file($tmp_name, $pic_upload_path);}
						
				mysqli_query($connect,"UPDATE admin SET adm_profile_pic='$new_pic_name' WHERE adm_id='$adm_id'");
?>
<script>
	swal({
    title: "Record updated.",
	type: "success"
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'profile.php';
          });
</script>
<?php
			}
		}
	}
}
?>