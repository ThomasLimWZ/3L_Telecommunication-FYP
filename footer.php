<footer class="footer">
			<div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url(assets/images/demos/bg-5.jpg);">
				<div class="container">
					<div class="row justify-content-center">
						<div class="col-md-10 col-lg-9 col-xl-7">
                            <div class="row no-gutters flex-column flex-sm-row align-items-sm-center">
                                <div class="col">
                                    <h3 class="cta-title text-white">If You Have More Questions</h3><!-- End .cta-title -->
                                </div><!-- End .col -->

                                <div class="col-auto">
                                    <a href="https://wa.link/uo5xxq" class="btn btn-primary" type="submit" target="_blank" style="border-radius:10px;"><span style="color:white;"><i class="icon-phone"></i>CONTACT US<i class="icon-long-arrow-right"></i></span></a>
                                </div><!-- End .col-auto -->
                            </div><!-- End .row no-gutters -->
                        </div><!-- End .col-md-10 col-lg-9 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .cta -->
				
			<div class="footer-middle">
				<div class="container">
					<div class="row">
						<div class="col-sm-6 col-lg-3">
							<div class="widget widget-about">
								<img src="assets/images/demos/logo.png" class="footer-logo" alt="Footer Logo" width="62" height="50">
								<h6>3L TELECOMMUNICATION</h6>
								<div class="social-icons">
	            					<a href="https://www.facebook.com/weezheng.weezheng/" class="social-icon" title="Facebook" target="_blank"><i class="icon-facebook-f"></i></a>
	            					<a href="https://www.instagram.com/wee_zheng/" class="social-icon" title="Instagram" target="_blank"><i class="icon-instagram"></i></a>
	            					<a href="https://www.youtube.com/channel/UC7tsepq8SJhD9q-peIOGzxA" class="social-icon" title="Youtube" target="_blank"><i class="icon-youtube"></i></a>
	            				</div><!-- End .soial-icons -->
							</div><!-- End .widget about-widget -->
						</div><!-- End .col-sm-6 col-lg-3 -->

						<div class="col-sm-6 col-lg-3">
							<div class="widget">
								<h4 class="widget-title">Company</h4><!-- End .widget-title -->

								<ul class="widget-list">
									<li><a href="about.php">About 3L</a></li>
									<li><a href="service.php">Our Services</a></li>
									<li><a href="contact-us.php">Contact us</a></li>
								</ul><!-- End .widget-list -->
							</div><!-- End .widget -->
						</div><!-- End .col-sm-6 col-lg-3 -->

						<div class="col-sm-6 col-lg-3">
							<div class="widget">
								<h4 class="widget-title">Customer Services</h4><!-- End .widget-title -->

								<ul class="widget-list">
									<li><a href="shipping.php">Shipping</a></li>
									<li><a href="t&c.php">Terms and conditions</a></li>
									<li><a href="privacy-policy.php">Privacy Policy</a></li>
									<li><a href="warranty.php">Warranty</a></li>
									<li><a href="faq.php">FAQ</a></li>
								</ul><!-- End .widget-list -->
							</div><!-- End .widget -->
						</div><!-- End .col-sm-6 col-lg-3 -->
					</div><!-- End .row -->
				</div><!-- End .container -->
			</div><!-- End .footer-middle -->

			<div class="footer-bottom">
				<div class="container">
					<p class="footer-copyright">Copyright &copy 2021 3L Telecommunication. All Rights Reserved.</p><!-- End .footer-copyright -->
					<figure class="footer-payments">
						<img src="assets/images/demos/card.png" alt="Payment methods" width="272" style="width:95px; height:30px;">
					</figure><!-- End .footer-payments -->
				</div><!-- End .container -->
			</div><!-- End .footer-bottom -->
		</footer><!-- End .footer -->
	</div><!-- End .page-wrapper -->
	<button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>
	
	<!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill nav-border-anim" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin" role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel" aria-labelledby="signin-tab">
                                    <form method="GET" action="" autocomplete="off">
                                        <div class="form-group">
                                            <label for="singin-email">Email Address <span style="color:red;">*</span></label>
                                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ''; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" style="width:450px;" required>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="singin-password">Password <span style="color:red;">*</span></label>
                                            <input type="password" class="form-control" id="pswd" name="password" minlength="8" maxlength="15" style="width:450px; float:left;" minlength="8" maxlength="15" required><br>
                                            <i class="fa fa-eye-slash" id="togglePassword" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
                                        </div><!-- End .form-group -->
										
										
                                        <div class="form-footer">
                                            <button type="submit" name="login" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <a href="forgot-password.php" class="forgot-link">Forgot Your Password?</a>
                                        </div><!-- End .form-footer -->
                                        <style>
                                          .clear_underline:hover{text-decoration:underline;}
                                        </style>
                                        <div style="text-align:center; font-size:12pt;">
                                          <a href="#" class="clear_underline" onclick="clearLogin()">Clear All</a>
                                        </div>
                                    </form>
                                </div><!-- .End .tab-pane -->
                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab" style="width:450px;">
                                    <form action="#" method="POST" autocomplete="off">
									                      <div class="form-group">
                                            <label for="register-name">Your Name <span style="color:red;">*</span></label>
                                            <input type="text" class="form-control" id="register_name" name="register_name" value="<?php echo isset($_POST["register_name"]) ? $_POST["register_name"] : ''; ?>" required>
                                        </div><!-- End .form-group -->
										
										                    <div class="form-group">
                                            <label for="register-phone">Your Phone Number <span style="color:red;">*</span></label>
                                            <input type="tel" class="form-control" id="register_phone" name="register_phone" placeholder="01xxxxxxxxx" value="<?php echo isset($_POST["register_phone"]) ? $_POST["register_phone"] : ''; ?>" minlength="10" maxlength="11" pattern="(01)[0-9]{8,9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
                                        </div><!-- End .form-group -->
										
                                        <div class="form-group">
                                            <label for="register-email">Your Email Address <span style="color:red;">*</span></label>
                                            <input type="email" class="form-control" id="register_email" name="register_email" value="<?php echo isset($_POST["register_email"]) ? $_POST["register_email"] : ''; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" required>
                                            <span id="checkExist" style="color:red;"></span>
                                        </div><!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password <span style="color:red;">*</span></label>
                                            <input type="password" class="form-control" id="reg_pswd" minlength="8" style="float:left;" name="register_password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-]).{8,}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-.,]).{8,}" title="Must contain number, uppercase, special characters and lowercase letter, and at least 8 or more characters" required><br>
											                      <i class="fa fa-eye-slash" id="togglePassword1" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
                                        </div><!-- End .form-group -->
										
										                    <div class="form-group"><br>
                                            <label for="register-confirm-password">Confirm Password <span style="color:red;">*</span></label>
                                            <input type="password" class="form-control" id="reg_cfpswd" minlength="8" style="float:left;" onkeyup="checkPass()" name="register_confirm" required><br>
											                      <i class="fa fa-eye-slash" id="togglePassword2" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
                                            <br><span id="checkPass" style="color:red;"></span>
                                        </div><!-- End .form-group -->
                                        
                                        <br>
                                        <div id="message">
                                          <h5>Password must contain the following:</h5>
                                          <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
                                          <p id="capital" class="invalid">A <b>uppercase</b> letter</p>
                                          <p id="number" class="invalid">A <b>number</b></p>
                                          <p id="special" class="invalid">A <b>special character</b></p>
                                          <p id="length" class="invalid">Minimum <b>8 characters</b></p>
                                        </div>
                                        <div class="form-footer">
                                            <button type="submit" id="regbtn" class="btn btn-outline-primary-2" name="registerbtn" disabled> 
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>
                                            <div class="custom-control custom-checkbox">
                                              <input type="checkbox" class="custom-control-input" id="register-policy" required>
                                              <label class="custom-control-label" for="register-policy">I agree to the <a href="privacy-policy.php">privacy policy</a> <span style="color:red;">*</span></label>
                                            </div>
                                        </div><!-- End .form-footer -->
                                        <div style="text-align:center; font-size:12pt;">
                                          <a href="#" class="clear_underline" onclick="clearRegister()">Clear All</a>
                                        </div>
                                        <script>
                                          function clearLogin(){
                                            document.getElementById('email').value='';
                                            document.getElementById('pswd').value='';
                                          }
                                          function clearRegister(){
                                            document.getElementById('register_name').value='';
                                            document.getElementById('register_phone').value='';
                                            document.getElementById('register_email').value='';
                                            document.getElementById('reg_pswd').value='';
                                            document.getElementById('reg_cfpswd').value='';
                                            document.getElementById('register-policy').checked = false;
                                          }
                                        </script>
                                    </form>
                                </div><!-- .End .tab-pane -->
                            </div><!-- End .tab-content -->
                        </div><!-- End .form-tab -->
                    </div><!-- End .form-box -->
                </div><!-- End .modal-body -->
            </div><!-- End .modal-content -->
        </div><!-- End .modal-dialog -->
    </div><!-- End .modal -->
	
	<!-- Plugins JS File -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/jquery.waypoints.min.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
	<!-- Main JS File -->
    <script src="assets/js/main.js"></script>
</body>
</html>
<style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background-color:#f2f2f2;
  width:450px;
  height:250px;
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
var myInput = document.getElementById("reg_pswd");
var confirm = document.getElementById("reg_cfpswd");
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
  if(myInput.value == confirm.value){
		document.getElementById('regbtn').disabled=false;
		document.getElementById("reg_cfpswd").style.border = "2px solid green";
	}
	else{
		document.getElementById('regbtn').disabled=true;
		document.getElementById("reg_cfpswd").style.border = "2px solid red";
	}
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
  var specials = /[#?!@$%^&*-]/g;
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

function checkPass(){
	var pass = document.getElementById('reg_pswd');
	var cfpass = document.getElementById('reg_cfpswd');

	if(pass.value == cfpass.value){
		document.getElementById('regbtn').disabled=false;
		document.getElementById("reg_cfpswd").style.border = "2px solid green";
    document.getElementById('checkPass').innerHTML="";
	}
	else{
		document.getElementById('regbtn').disabled=true;
		document.getElementById("reg_cfpswd").style.border = "2px solid red";
    document.getElementById('checkPass').innerHTML="•	Password not matched.";
	}
}
const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#pswd');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye icon
	  this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
const togglePassword1 = document.querySelector('#togglePassword1');
  const password1 = document.querySelector('#reg_pswd');

  togglePassword1.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    // toggle the eye icon
	  this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#reg_cfpswd');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye icon
	this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
</script>
<?php
if(isset($_POST["registerbtn"])){
	$reg_name = $_POST['register_name'];
	$reg_phone = $_POST['register_phone'];
	$reg_email = $_POST['register_email'];
	$reg_pass = $_POST['register_password'];
	$reg_cpass = $_POST['register_confirm'];
	
	$register = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email = '$reg_email'");
	$reg_count = mysqli_num_rows($register);
	
	if($reg_pass === $reg_cpass){
		if($reg_count != 0){
?>

<script>
    swal({
          title: 'The customer email is already in use. Please change.',
          icon: 'error',
          button: 'OK',
          });
    $('#signin-modal').modal({backdrop: 'static'})
    $(document).ready(function(){
    $('#register-tab').tab('show')});
    document.getElementById('checkExist').innerHTML="•	The email has already been taken.";
</script>

<?php
		}
		else{
			mysqli_query($connect,"INSERT INTO customer(cus_name, cus_phone, cus_email, cus_pass) VAlUES ('$reg_name','$reg_phone','$reg_email','$reg_pass')");

			$subject = "Registration Successful!";
			$message = "Dear ".$reg_name.",\n\nWelcome to 3L Telecommunication! Thank you for register an account at our website.\n\nTo sign in to your account, please visit http://localhost/3L_Telecommunication/index.php. Thank you. \n\nRegards,\n3L Telecommunication";
			$headers = "From: 3L Telecommunication" . "\r\n";
			
			if(mail($reg_email,$subject,$message,$headers)) {
?>
				<script>
          
          document.getElementById('register_name').value='';
          document.getElementById('register_phone').value='';
          document.getElementById('register_email').value='';
          document.getElementById('reg_pswd').value='';
          document.getElementById('reg_cfpswd').value='';
          document.getElementById('register-policy').checked = false;
          swal({title:"Register successfully.",
            icon:"success",
            text:"Welcome to 3L Telecommunication!" ,
            button:"Ok"});
          $('#signin-modal').modal({backdrop: 'static'})
				</script>
</script>
<?php
			}
			else {
        echo  "<script>swal({
          title: 'Sorry, unable to send mail...',
          icon: 'error',
          button: 'OK',
          });</script>";
			}
		}
	}
	else{
?>

<script>
  swal({
          title: 'Both passwords are not same ! Please type again.',
          icon: 'error',
          button: 'OK',
          });
    $('#signin-modal').modal({backdrop: 'static'})
    $(document).ready(function(){
    $('#register-tab').tab('show')});
</script>
<?php
	}
}
?>