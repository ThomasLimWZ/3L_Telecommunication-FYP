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
                        <h1 class="h3 mb-0 text-gray-800">Add Admin</h1>
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
									<form method="post" action="" name="myform" enctype="multipart/form-data" autocomplete="off" onsubmit="return validation()">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Admin ID <span style="color:red;">*</span><input class="form-control" type="text" name="admin_id" maxlength="6" pattern="([A]{1})([D]{1})([M]{1})([0-9]{3})" placeholder="ADMxxx" title="Must contain 'adm' alphabet and wtih any three number" value="<?php echo isset($_POST["admin_id"]) ? $_POST["admin_id"] : ''; ?>" required></p>
												</div>																			
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Name <span style="color:red;">*</span><input class="form-control" placeholder="Enter admin name" type="text" name="admin_name" value="<?php echo isset($_POST["admin_name"]) ? $_POST["admin_name"] : ''; ?>" required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Profile Image (Optional)</label>
														<input type="file"  name="adm_profile_pic" value="<?php if (isset($_POST["adm_profile_pic"])) { echo $_POST["adm_profile_pic"];} ?>">
														<br><label>Choose image</label>
												</div>
											</div>
                    </div>
                      <div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Email <span style="color:red;">*</span><input class="form-control" type="email"  placeholder="Enter admin email" name="admin_email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" title="Much with a correct email format." value="<?php echo isset($_POST["admin_email"]) ? $_POST["admin_email"] : ''; ?>" required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Phone Number <span style="color:red;">*</span><input class="form-control" type="text" name="admin_phone"  pattern="(01)[0-9]{8,9}" minlength="10" maxlength="11" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="01xxxxxxxxx" value="<?php echo isset($_POST["admin_phone"]) ? $_POST["admin_phone"] : ''; ?>" required></p>
												</div>
											</div>
										</div>
  
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<label>Join Date <span style="color:red;">*</span></label>
													<div class="cal-icon">
														<input type="date" class="form-control datetimepicker" name="admin_date" min="<?php echo date("Y-m-d"); ?>" value="<?php echo isset($_POST["admin_date"]) ? $_POST["admin_date"] : ''; ?>" required>
													</div>
												</div>
											</div>
										<div class="col-md-4">
												<div class="form-group">
													<label>Position <span style="color:red;">*</span></label>
													<select class="form-control" name="admin_position" id="admin_position" required>
                            <option value="" disabled selected>Select</option>
														<option value="Manager">Manager</option>
														<option value="Staff">Staff</option>
													</select>
												</div>
											</div>
                   </div>
                  <script>
                    document.getElementById('admin_position').value = "<?php echo $_POST['admin_position'];?>";
                  </script>
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
                        <div class="input-icons">
                        <label>Password <span style="color:red;">*</span>&nbsp; <i style="color:black;" class="fa fa-edit" onclick="randomPassword(15);"></i>
                        &emsp;<i class="fa fa-eye-slash" id="togglePassword"></i></label></div>
                          <input class="form-control" type="password" id="admin_pass" name="admin_pass" minlength="10" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-.,]).{8,}" value="<?php echo isset($_POST["admin_pass"]) ? $_POST["admin_pass"] : ''; ?>"required>
                          
                        </div>
											</div></div>
										
										<br>
										<input type="submit" name="savebtn" value="Add Admin" id="regbtn" class="btn btn-primary buttonedit ml-2">
										<a href="all-admin-manager.php" class="btn btn-primary buttonedit ml-2">Back to Admin List</a>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
</body>

</html>
<?php
	}
?>

<style>

.input-icons i {
  cursor:pointer;
}

</style>
<script>
  //current password
 const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#admin_pass");

        togglePassword.addEventListener("click", function (a) {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
               // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

	//upload file alert box
	
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
	}
	

function randomPassword(length) {
  const alpha = 'abcdefghijklmnopqrstuvwxyz';
  const calpha = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  const num = '1234567890';
  const specials = '#?!@$%^&*-.,';
  const options = [alpha, alpha, alpha, specials, calpha,calpha, calpha,calpha,num,num,num, num,num,num, specials];
  let opt, choose;
  let pass = "";
  for ( let i = 0; i < length; i++ ) {
    opt = Math.floor(Math.random() * options.length);
    choose = Math.floor(Math.random() * (options[opt].length));
    pass = pass + options[opt][choose];
    options.splice(opt, 1);
  }
    myform.admin_pass.value = pass;
}
</script>


<?php
if(isset($_POST["savebtn"])){
	$id = $_POST['admin_id'];
	$name = $_POST['admin_name'];
	$email = $_POST['admin_email'];
	$phone = $_POST['admin_phone'];
  $position=$_POST['admin_position'];
	$date = $_POST['admin_date'];
	$pass = $_POST['admin_pass'];
	
	$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id = '$id'");
	$count = mysqli_num_rows($result);
  $resultemail = mysqli_query($connect,"SELECT * FROM admin WHERE adm_email = '$email'");
	$countemail = mysqli_num_rows($resultemail);

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
							
					if($count != 0 || $countemail!=0){
?>
<script>
					var count = '<?php echo $count?>';
              var counte = '<?php echo $countemail?>';
              if(count!=0 && counte!=0)
              {
                swal({title:"The both admin id and email is already in use. Please change.",
									type:"error"});
              }
              else if(count!=0)
              {
                swal({title:"The admin id is already in use. Please change.",
									type:"error"});
              }
						else{
              swal({title:"The email is already in use. Please change.",
									type:"error"});
            }
</script>
<?php              
					}
					else{
						if(in_array($pic_ex_lc, $allowed_exs))
						{
							$new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
							$pic_upload_path = 'admin-profile-pic/'.$new_pic_name;
							move_uploaded_file($tmp_name, $pic_upload_path);
						}
				
						mysqli_query($connect,"INSERT INTO admin(adm_id,adm_name,adm_profile_pic,adm_email,adm_phone,adm_pass,adm_position,adm_join_date) VALUES ('$id','$name','$new_pic_name','$email','$phone','$pass','$position','$date')");
              
            $subject = "Welcome to be part of our team!";
            $message = "Dear ".$name.",\n\nWelcome to 3L Telecommunication!\n\nPlease use below admin ID and password to login. You may change password after you login. \nAdmin ID: ".$id."\nPassword: ".$pass."\nPosition: ".$position."\n\nThank you.\n\nRegards,\n3L Telecommunication";
            $headers = "From: 3L Telecommunication" . "\r\n";

            if(mail($email,$subject,$message,$headers)) {
?>
<script>
swal({
    title: "Record saved.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
</script>
<?php
            }
            else {
				
                      ?>
<script>
swal({
    title: "Record saved.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
</script>
<?php
            }
					}
				}
			}
			else{
				if($count != 0  || $countemail!=0){
?>
<script>
							var count = '<?php echo $count?>';
              var counte = '<?php echo $countemail?>';
              if(count!=0 && counte!=0)
              {
                swal({title:"The both admin id and email is already in use. Please change.",
									type:"error"});
              }
              else if(count!=0)
              {
                swal({title:"The admin id is already in use. Please change.",
									type:"error"});
              }
						else{
              swal({title:"The email is already in use. Please change.",
									type:"error"});
            }
</script>
<?php
				}
				else{
					mysqli_query($connect,"INSERT INTO admin(adm_id,adm_name,adm_email,adm_phone,adm_pass,adm_position,adm_join_date) VALUES ('$id','$name','$email','$phone','$pass','$position','$date')");
           
          $subject = "Welcome to be part of our team!";
          $message = "Dear ".$name.",\n\nWelcome to 3L Telecommunication!\n\nPlease use below admin ID and password to login. You may change password after you login. \nAdmin ID: ".$id."\nPassword: ".$pass."\nPosition: ".$position."\n\nThank you.\n\nRegards,\n3L Telecommunication";
          $headers = "From: 3L Telecommunication" . "\r\n";

          if(mail($email,$subject,$message,$headers)) {
?>
<script>
	swal({
    title: "Record saved.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
</script>
<?php
          }
          else {
                   ?>
				   <script>
	swal({
    title: "Record saved.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
</script>
<?php
          }
				}
			}
		}
}
mysqli_close($connect);
?>
