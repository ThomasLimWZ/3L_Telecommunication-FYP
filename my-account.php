<?php include("header-login.php"); ?>
		
		<main class="main">
			<div class="container" style="text-align:center;">
				<hr class="mb-2">
				<h1><b>My Account</b></h1>
				<hr class="mb-2">
				<br>
			</div>
			
			<div class="page-content">
            	<div class="payment">
	                <div class="container"">
		                <div class="row">
		                	<div class="col-lg-7">
            					<form action="#" method="POST" id="myForm" autocomplete="off">
		                			<h2 class="acc-title" style="font-size:13pt;"><br>Profile Infomations</h2><!-- End .acc-title -->
									<br>
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Name</label>
		                						<input type="text" class="form-control" name="name" value="<?php echo $row['cus_name']; ?>" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
										
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Phone</label>
		                						<input type="tel" class="form-control" name="phone" value="<?php echo $row['cus_phone']; ?>" placeholder="01xxxxxxxxx" minlength="10" maxlength="11" pattern="(01)[0-9]{8,9}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Email Address</label>
		                						<input type="email" class="form-control" name="email" value="<?php echo $row['cus_email']; ?>" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" disabled>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
										
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Gender <?php if(empty($row['cus_gender']) || $row['cus_gender'] == ""){echo "(Optional)";}?></label>
		                						<select class="form-control" name="gender" <?php if(empty($row['cus_gender']) || $row['cus_gender'] == ""){}else{echo "disabled";}?>>
													<option disabled selected value="">Select gender</option>
													<option value="Male" <?php if($row['cus_gender'] == "Male") echo "selected";?> >
														Male
													</option>
													<option value="Female" <?php if($row['cus_gender'] == "Female") echo "selected";?> >
														Female
													</option>
												</select>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>Date of Birth <?php if(empty($row['cus_dob']) || $row['cus_dob'] == "0000-00-00"){echo "(Optional)";}?></label>
		                						<input type="date" class="form-control" name="dob"  max="<?php echo date("Y-m-d"); ?>" value="<?php echo $row['cus_dob']; ?>" <?php if(empty($row['cus_dob']) || $row['cus_dob'] == "0000-00-00"){}else{echo "disabled";}?>>
		                					</div><!-- End .col-sm-6 -->
											
											<?php
											?>
											<div class="col-sm-12">
		                						<label>Address <span id="changeOpt1">(Optional)</span></label>
		                						<input type="text" class="form-control" id="address" name="address" value="<?php echo $row['cus_address']; ?>" placeholder="Your address" onkeyup="checkAddress()">
		                					</div>

		                					<div class="col-sm-6">
		                						<label>City <span id="changeOpt2">(Optional)</span></label>
		                						<input type="text" class="form-control" id="city" name="city" value="<?php echo $row['cus_city']; ?>" placeholder="Your city" onkeyup="checkAddress()">
		                					</div><!-- End .col-sm-6 -->

											<div class="col-sm-6">
		                						<label>State <span id="changeOpt3">(Optional)</span></label>
		                						<select class="form-control" id="state" name="state" onchange="checkAddress()"><i class="fa fa-x"></i>
													<option id="enableBack" selected value="">Select State</option>
													<option <?php if($row['cus_state'] == "Melaka") echo "selected";?>>Melaka</option>
													<option <?php if($row['cus_state'] == "Johor") echo "selected";?>>Johor</option>
													<option <?php if($row['cus_state'] == "Selangor") echo "selected";?>>Selangor</option>
													<option <?php if($row['cus_state'] == "Negeri Sembilan") echo "selected";?>>Negeri Sembilan</option>
													<option <?php if($row['cus_state'] == "Pulau Pinang") echo "selected";?>>Pulau Pinang</option>
													<option <?php if($row['cus_state'] == "Kedah") echo "selected";?>>Kedah</option>
													<option <?php if($row['cus_state'] == "Kelantan") echo "selected";?>>Kelantan</option>
													<option <?php if($row['cus_state'] == "Pahang") echo "selected";?>>Pahang</option>
													<option <?php if($row['cus_state'] == "Perlis") echo "selected";?>>Perlis</option>
													<option <?php if($row['cus_state'] == "Perak") echo "selected";?>>Perak</option>
													<option <?php if($row['cus_state'] == "Sabah") echo "selected";?>>Sabah</option>
													<option <?php if($row['cus_state'] == "Sarawak") echo "selected";?>>Sarawak</option>
													<option <?php if($row['cus_state'] == "Terengganu") echo "selected";?>>Terengganu</option>
												</select>
		                					</div><!-- End .col-sm-6 -->

											<div class="col-sm-6">
												<label>Postcode <span id="changeOpt4">(Optional)</span></label>
												<input type="text" class="form-control" id="postcode" name="postcode" value="<?php echo $row['cus_post_code']; ?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" pattern="[0-9]{5}" maxlength="5" placeholder="Your postcode"  onkeyup="checkAddress()">
											</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
										
										<div class="row">
											<div class="col-sm-5">
												<br>
												<button type="submit" id="checkbtn" name="update_profile" class="btn btn-outline-primary-2" disabled>
													<span class="btn-text">Update Profile Informations</span>
													<span class="btn-hover-text">Update Profile Informations</span>
												</button>
											</div>
		                				</div><!-- End .row -->
										
										<script>
											function checkAddress(){
												var address = document.getElementById("address").value;
												var city = document.getElementById("city").value;
												var state = document.getElementById("state").value;
												var postcode = document.getElementById("postcode").value;
												if(address.length != 0 || city.length != 0 || state.length != 0 || postcode.length != 0){
													document.getElementById('changeOpt1').innerHTML="*";
													document.getElementById('changeOpt2').innerHTML="*";
													document.getElementById('changeOpt3').innerHTML="*";
													document.getElementById('changeOpt4').innerHTML="*";
													document.getElementById("changeOpt1").style.color = "red";
													document.getElementById("changeOpt2").style.color = "red";
													document.getElementById("changeOpt3").style.color = "red";
													document.getElementById("changeOpt4").style.color = "red";
													$('#address').attr('required', 'true');
													$('#city').attr('required', 'true');
													$('#state').attr('required', 'true');
													$('#postcode').attr('required', 'true');
												}
												else{
													document.getElementById('changeOpt1').innerHTML="(Optional)";
													document.getElementById('changeOpt2').innerHTML="(Optional)";
													document.getElementById('changeOpt3').innerHTML="(Optional)";
													document.getElementById('changeOpt4').innerHTML="(Optional)";
													document.getElementById("changeOpt1").style.removeProperty('color');
													document.getElementById("changeOpt2").style.removeProperty('color');
													document.getElementById("changeOpt3").style.removeProperty('color');
													document.getElementById("changeOpt4").style.removeProperty('color');
													document.getElementById("address").required = false;
													document.getElementById("city").required = false;
													document.getElementById("state").required = false;
													document.getElementById("postcode").required = false;
												}
											}
										</script>
								</form>
								<form action="#" method="POST" autocomplete="off">		
									<br><br>
									<h2 class="pass-title" style="font-size:13pt;"><br>Change Password</h2><!-- End .pass-title -->
									<br>
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Old Password</label>
		                						<input type="password" class="form-control" id="current" name="oldpass" style="float:left" minlength="8" maxlength="15" onkeyup="checkCurrent()" required><br>
												<i class="fa fa-eye-slash" id="togglePassword1" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
												<span id="error" style="color:red;"></span>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
										
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>New Password</label>
		                						<input type="password" class="form-control" id="pswd" name="newpass" style="float:left;"><br>
												<i class="fa fa-eye-slash" id="togglePassword2" style="margin-left: -30px; margin-top:15px; cursor: pointer;" minlength="8" maxlength="15" required></i>
												<span id="error1" style="color:red;"></span>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->
										
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Confirm New Password</label>
		                						<input type="password" class="form-control" id="cfpswd" name="confirmpass" style="float:left;" onkeyup="checkPass()" minlength="8" maxlength="15" required><br>
												<i class="fa fa-eye-slash" id="togglePassword3" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
												<span id="error2" style="color:red;"></span>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

										<div id="message">
											<h5>Password must contain the following:</h5>
											<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
											<p id="capital" class="invalid">A <b>uppercase</b> letter</p>
											<p id="number" class="invalid">A <b>number</b></p>
											<p id="special" class="invalid">A <b>special character</b></p>
											<p id="length" class="invalid">Minimum <b>8 characters</b></p>
										</div>
										<div class="row">
											<div class="col-sm-5">
												<br>
												<button type="submit" id="updatebtn" name="update_password" class="btn btn-outline-primary-2" disabled>
													<span class="btn-text">Change Password</span>
													<span class="btn-hover-text">Change Password</span>
												</button>
											</div>
										</div>
								<f/form>
		                	</div><!-- End .col-lg-7 -->
		                </div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .payment -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
<script>
var form = document.getElementById("myForm");

form.addEventListener("input", function () {
    console.log("Form has changed!");
	document.getElementById('checkbtn').disabled=false;
});
</script>
<style>
/* The message box is shown when the user clicks on the password field */
#message {
  display:none;
  background-color:#f2f2f2;
  width:400px;
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
function checkCurrent(){
	var pass = document.getElementById('current');

	if(pass.value == "<?php echo $row['cus_pass'];?>"){
		document.getElementById("current").style.border = "2px solid green";
	}
	else{
		document.getElementById("current").style.border = "2px solid red";
	}
}

var pass = document.getElementById('current');
var myInput = document.getElementById("pswd");
var confirm = document.getElementById("cfpswd");
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
	if(myInput.value == "<?php echo $row['cus_pass']; ?>"){
		document.getElementById("pswd").style.border = "2px solid red";
		document.getElementById("error1").innerHTML = "Cannot same with current password.";
	}
	else{
		document.getElementById("pswd").style.border = "2px solid green";
		document.getElementById("error1").innerHTML = "";
	}
	
  if(myInput.value == confirm.value){
		document.getElementById('updatebtn').disabled=false;
		document.getElementById("cfpswd").style.border = "2px solid green";
	}
	else{
		document.getElementById('updatebtn').disabled=true;
		document.getElementById("cfpswd").style.border = "2px solid red";
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
	var current = document.getElementById('current');
	var pass = document.getElementById('pswd');
	var cfpass = document.getElementById('cfpswd');

	if(pass.value == cfpass.value && current.value == "<?php echo $row['cus_pass'];?>"){
		document.getElementById('updatebtn').disabled=false;
		document.getElementById("cfpswd").style.border = "2px solid green";
	}
	else if(pass.value == cfpass.value){
		document.getElementById('updatebtn').disabled=true;
		document.getElementById("cfpswd").style.border = "2px solid green";
	}
	else{
		document.getElementById('updatebtn').disabled=true;
		document.getElementById("cfpswd").style.border = "2px solid red";
	}
}
const togglePassword1 = document.querySelector('#togglePassword1');
  const password1 = document.querySelector('#current');

  togglePassword1.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password1.getAttribute('type') === 'password' ? 'text' : 'password';
    password1.setAttribute('type', type);
    // toggle the eye icon
	this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
const togglePassword2 = document.querySelector('#togglePassword2');
  const password2 = document.querySelector('#pswd');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye icon
	this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
const togglePassword3 = document.querySelector('#togglePassword3');
  const password3 = document.querySelector('#cfpswd');

  togglePassword3.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password3.getAttribute('type') === 'password' ? 'text' : 'password';
    password3.setAttribute('type', type);
    // toggle the eye icon
	this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
</script>
<?php include("footer-login.php"); ?>

<?php
if(isset($_POST["update_profile"])){
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$gender = $_POST["gender"];
	$dob = $_POST["dob"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$state = $_POST["state"];
	$postcode = $_POST["postcode"];
	
	if(!empty($name)){
		mysqli_query($connect,"UPDATE customer SET cus_name='$name' WHERE cus_email='$cus_email'");
	}

	if(!empty($phone)){
		mysqli_query($connect,"UPDATE customer SET cus_phone='$phone' WHERE cus_email='$cus_email'");
	}

	if(!empty($gender)){
		mysqli_query($connect,"UPDATE customer SET cus_gender='$gender' WHERE cus_email='$cus_email'");
	}

	if(!empty($dob)){
		mysqli_query($connect,"UPDATE customer SET cus_dob='$dob' WHERE cus_email='$cus_email'");
	}

	if(empty($address) && empty($city) && empty($state) && empty($postcode)){
		mysqli_query($connect,"UPDATE customer SET cus_address=NULL, cus_city=NULL, cus_state=NULL, cus_post_code=NULL WHERE cus_email='$cus_email'");
	}
	else{
		mysqli_query($connect,"UPDATE customer SET cus_address='$address', cus_city='$city', cus_state='$state', cus_post_code='$postcode' WHERE cus_email='$cus_email'");
	}
?>
<script>
	swal({
        title: "Record updated.",
        icon: "success",
        button: "OK",
        }).then(function(){window.location.href="my-account.php";});
</script>
<?php
}
?>

<?php
if(isset($_POST['update_password'])){
	$current = $_POST['oldpass'];
	$new = $_POST['newpass'];
	$confirm = $_POST['confirmpass'];
	
	if($current != $row['cus_pass']){
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
		else{
			if($current != $confirm){
				if($new === $confirm){
					mysqli_query($connect, "UPDATE customer SET cus_pass = '$new' WHERE cus_email = '$cus_email'");
?>
					<script>
							swal({
							title: "Password updated. Please login again, Thank you.",
							icon: "success",
							button: "OK",
							}).then(function(){window.location.href="logout.php";});
					</script>
<?php
				}
				else{
?>
					<script>
						document.getElementById("error2").innerHTML="Both passwords are not same.";
					</script>
<?php
				}
			}
			else{
?>
				<script>
					document.getElementById("error2").innerHTML="New password cannot same with current password.";
				</script>
<?php	
			}
		}
	}
}
mysqli_close($connect);
?>