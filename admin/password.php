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
												<a class="list-group-item list-group-item-action" href="profile.php">
													Account
												</a>
												<a class="list-group-item list-group-item-action active" href="password.php">
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
														<h5 class="card-title mb-0">Password</h5>
													</div>
													<div class="card-body">
													<?php
															$adm_id = $_SESSION['id'];
															$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id = '$adm_id'");
															$row = mysqli_fetch_assoc($result);
														?>
														<form method="POST" action="" name="password">
															<div class="mb-3">
                              <div class="input-icons">
																<label class="form-label">Current password &nbsp;</label><span id="error" style="color:red; font-weight:bold;"></span>
																<i class="fa fa-eye-slash" id="togglePassword"></i><input type="password" id="current" class="form-control" name="current_pass"></div>
															</div>
                              
															<div class="mb-3">
                              <div class="input-icons">
																<label class="form-label">New password</label> &nbsp;<span id='passmsg' style="font-weight:bold;"></span>
																<i class="fa fa-eye-slash" id="toggle"></i>
                                <input type="password" class="form-control" id="psw" name="new_pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-.,]).{8,}" title="Must contain number, uppercase, special characters and lowercase letter, and at least 8 or more characters"></div>
                                <span id="error1" style="color:red;"></span>
                              </div>
															
															<div id="message">
																<h5>Password must contain the following:</h5>
																<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
																<p id="capital" class="invalid">A <b>uppercase</b> letter</p>
																<p id="number" class="invalid">A <b>number</b></p>
																<p id="special" class="invalid">A <b>special character</b></p>
																<p id="length" class="invalid">Minimum <b>8 characters</b></p>
															</div><br>
															<div class="mb-3">
                              <div class="input-icons">
																<label class="form-label">Confirm password &nbsp;</label><span id='msg' style="font-weight:bold;"></span>
																<i class="fa fa-eye-slash" id="togglecf"></i><input type="password" class="form-control" id="cfpsw" name="confirm_new_pass" palceholder="Must same with new password" ></div>
                                <span id="error2" style="color:red;"></span>
															</div>
															<br>
															<input type="submit" id="regbtn" name="savebtn" value="Save Password" class="btn btn-primary buttonedit ml-2" disabled>
														</form>	
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
<style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background: #f1f1f1;
  width:400px;
  height:300px;
  color: #000;
  padding: 20px;
  margin-top: 10px;
}

#message p {
  padding: 5px 35px;
  font-size: 15px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}

.input-icons i {
   cursor:pointer;
}
</style>
<script>
  //current password
 const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#current");

        togglePassword.addEventListener("click", function (a) {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
               // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        //new password
        const passwordEle = document.getElementById('psw');
        const toggleEle = document.getElementById('toggle');

        toggleEle.addEventListener('click', function (b) {
            const type = passwordEle.getAttribute('type');

        passwordEle.setAttribute(
            'type',
            // Switch it to a text field if it's a password field
            // currently, and vice versa
            type === 'password' ? 'text' : 'password'
           );
            // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        //confirm pass
        const confirm = document.getElementById('cfpsw');
        const toggle = document.getElementById('togglecf');
        toggle.addEventListener('click', function (c) {
            const type = confirm.getAttribute('type');

            confirm.setAttribute(
            'type',
            // Switch it to a text field if it's a password field
            // currently, and vice versa
            type === 'password' ? 'text' : 'password'
            );
            // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });
        
</script>
<script>
var myInput = document.getElementById("psw");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");
var special = document.getElementById("special");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
  document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
  document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }

  // Validate special char
  var specials = /[#?!@$%^&*-.,]/g;
  if(myInput.value.match(specials)) {  
    special.classList.remove("invalid");
    special.classList.add("valid");
  } else {
    special.classList.remove("valid");
    special.classList.add("invalid");
  }
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}


$('#psw, #cfpsw').on('keyup', function () {
  if ($('#psw').val() == $('#cfpsw').val()) {
    $('#msg').html('Matching').css('color', 'green');
    document.getElementById('regbtn').disabled = false;
  } else{
    $('#msg').html('Not Matching With New Password').css('color', 'red');
    document.getElementById('regbtn').disabled = true;
  }
	return false;
});

$('#current').on('keyup', function () {
  if ($('#current').val() == '<?php echo $row['adm_pass'];?>') {
    $('#error').html('Matching').css('color', 'green');
    document.getElementById('regbtn').disabled = true;
  } else{
    $('#error').html('Not Matching').css('color', 'red');
    document.getElementById('regbtn').disabled = true;
  }
	return false;
});

$('#current, #psw').on('keyup', function () {
  if ($('#psw').val() != $('#current').val()) {
    $('#passmsg').html('').css('color', 'green');
    document.getElementById('regbtn').disabled = false;
  } else{
    $('#passmsg').html('New password cannot same with current password!').css('color', 'red');
    document.getElementById('regbtn').disabled = true;
  }
	return false;
});
</script>
<?php
	}
?>

<?php
if(isset($_POST['savebtn'])){
	$current = $_POST['current_pass'];
	$new = $_POST['new_pass'];
	$confirm = $_POST['confirm_new_pass'];
	
	if($current != $row['adm_pass']){
?>
		<script>
			document.getElementById("error").innerHTML="The provided password does not match your current password.<br>";
		</script>
<?php
		if(empty($new)){
?>
			<script>
				document.getElementById("error1").innerHTML="Please fill up new password.";
			</script>
<?php
		}
	}
	else{
		if(empty($new)){
?>
			<script>
				document.getElementById("error1").innerHTML="Please fill up new password.";
			</script>
<?php
		}
		else if($new==$current)
		{
?>
			<script>
		
    document.getElementById("error1").innerHTML="New password is same with current password!";
			</script>
<?php
		}
		else{
			if($new === $confirm){
				mysqli_query($connect, "UPDATE admin SET adm_pass = '$new' WHERE adm_id = '$adm_id'");
?>
				<script>
					swal({
    title: "Password Updated! Pls login again with new password.",
	type: "success"
	
	},function(isConfirm){
					alert('ok');
			});
			$('.swal2-confirm').click(function(){
					window.location.href = 'logout.php';
			});
				</script>
<?php
			}
			else{
?>
				<script>
					document.getElementById("error2").innerHTML="Both passwords not same.";
				</script>
<?php
			}
		}
	}
}
?>