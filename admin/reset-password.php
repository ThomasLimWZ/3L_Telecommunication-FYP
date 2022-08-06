<!DOCTYPE html>
<?php include('connection.php'); ?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Forgot Password</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
</head>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Reset Password</h1>
                                        <p class="mb-4">Please fill up below. Thank you.</p>
                                    </div>
                                    <form class="user" method="POST" autocomplete="off">
                                        <div class="form-group">
                                        <label class="form-label">Email &nbsp;</label><span id='email' style="font-weight:bold;color:red;"></span>
                                            <input name="email" placeholder="Your Email Address" class="form-control"  type="email"  value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required>
                                        </div>
										<div class="form-group">
                                        <div class="input-icons">
                                        <label class="form-label">New password</label>
                                            <input name="pass" id="pass" placeholder="Your New Password" class="form-control"  type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-.,]).{8,}" title="Must contain number, uppercase, special characters and lowercase letter, and at least 8 or more characters" required>
                                            <i class="fa fa-eye-slash" id="togglePassword"></i>
                                        </div>
                                        </div>
                                        <div id="message">
										    <h5>Password must contain the following:</h5>
											<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
											<p id="capital" class="invalid">A <b>uppercase</b> letter</p>
											<p id="number" class="invalid">A <b>number</b></p>
											<p id="special" class="invalid">A <b>special character</b></p>
									    	<p id="length" class="invalid">Minimum <b>8 characters</b></p>
										</div>
										<div class="form-group">
                                        <div class="input-icons">
                                        <label class="form-label">Confirm password &nbsp;</label><span id='msg' style="font-weight:bold;"></span>
                                            <input name="confirm_pass" id="cfpass" placeholder="Confirm New Password" class="form-control"  type="password" required>
                                            <i class="fa fa-eye-slash" id="toggle"></i>
                                        </div>
                                        </div>
										<br>
                                        <input type="submit" name="reset" value="Reset Password" class="btn btn-primary btn-user btn-block">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<style>
.input-icons i {
    cursor:pointer;
    margin-top:-28px;
    margin-left:780px;
    position:absolute;
}
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
</style>
<script>
//new password
        const passwordEle = document.getElementById('pass');
        const toggleEle = document.getElementById('togglePassword');

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
        const confirm = document.getElementById('cfpass');
        const toggle = document.getElementById('toggle');
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
var myInput = document.getElementById("pass");
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

$('#pass, #cfpass').on('keyup', function () {
  if ($('#pass').val() == $('#cfpass').val()) {
    $('#msg').html('Matching').css('color', 'green');
    document.getElementById('reset').disabled = false;
  } else{
    $('#msg').html('Not Matching').css('color', 'red');
    document.getElementById('reset').disabled = true;
  }
	return false;
});

</script>
<?php
if(isset($_POST['reset'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$cpass = $_POST['confirm_pass'];
	
	$checkEmail = mysqli_query($connect,"SELECT * FROM admin WHERE adm_email='$email'");
    $countEmail = mysqli_num_rows($checkEmail);
  
	if($countEmail !=0){
	if($pass === $cpass){
		mysqli_query($connect,"UPDATE admin SET adm_pass='$pass' WHERE adm_email='$email'");
?>
<script>
	
	swal({
    title: "Reset successfully. Please log in again.",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'login.php';
          });
	  	
</script>
<?php
	}
	else{
?>

<script>
	
	swal({
    title: "Both passwords are not same ! Please type again.",
	type: "error"
 
    
	});
 
</script>
<?php
	}
  }
  else{
?>
<script>
    swal({
        title: "This email address is not exists in our record.",
        type: "error",
        });
        document.getElementById('email').innerHTML="< Pls use existing email >";
</script>	  
<?php	  
	  
	}
}
mysqli_close($connect);
?>