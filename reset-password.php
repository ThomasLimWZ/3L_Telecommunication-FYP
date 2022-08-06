<?php include("header.php"); ?>
		<div class="container" style="text-align:center;">
			<br>
			<hr class="mb-2">
			<h3><b>Reset password</b></h3>
			<p>Please fill up the email address and new password for your account.</p>
			<hr class="mb-2">
			<br>
		</div>
		
		<div class="wrapper" style="margin:auto;">
			<form action="#" method="POST" autocomplete="off">
				<div class="form-group" style="width:400px;">
					<label><b>Email Address</b></label>
					<input type="text" class="form-control" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" required autofocus=""><br>
					<label><b>Password</b></label>
					<input name="pass" class="form-control" id="res_pswd" type="password" style="float:left;" minlength="8" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-]).{8,}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#?!@$%^&*-.,]).{8,}" title="Must contain number, uppercase, special characters and lowercase letter, and at least 8 or more characters" required><br>
					<i class="fa fa-eye-slash" id="restogglePassword" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
					<br><br><label><b>Confirm Password</b></label>
					<input name="confirm_pass" id="res_cfpswd" class="form-control" style="float:left;" minlength="8" type="password" required><br>
					<i class="fa fa-eye-slash" id="restogglePassword1" style="margin-left: -30px; margin-top:15px; cursor: pointer;"></i>
					<br><br>
					<div id="message1">
						<h5>Password must contain the following:</h5>
						<p id="letter1" class="invalid">A <b>lowercase</b> letter</p>
						<p id="capital1" class="invalid">A <b>uppercase</b> letter</p>
						<p id="number1" class="invalid">A <b>number</b></p>
						<p id="special1" class="invalid">A <b>special character</b></p>
						<p id="length1" class="invalid">Minimum <b>8 characters</b></p>
					</div>
				</div><!-- End .form-group -->
				<button class="btn btn-lg btn-primary btn-block" id="savebtn" type="submit" name="reset" disabled>RESET PASSWORD</button>
				<br>
			</form>
			<br>
		</div>
<style>
/* The message box is shown when the user clicks on the password field */
#message1 {
  display:none;
  background-color:#f2f2f2;
  width:400px;
  height:250px;
  color: #000;
  padding: 20px;
  margin-top: 10px;
}

#message1 p {
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
var myInput1 = document.getElementById("res_pswd");
var confirm1 = document.getElementById("res_cfpswd");
var letter1 = document.getElementById("letter1");
var capital1 = document.getElementById("capital1");
var number1 = document.getElementById("number1");
var length1 = document.getElementById("length1");
var special1 = document.getElementById("special1");

// When the user clicks on the password field, show the message box
myInput1.onfocus = function() {
  document.getElementById("message1").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput1.onblur = function() {
  document.getElementById("message1").style.display = "none";
}

// When the user starts to type something inside the password field
myInput1.onkeyup = function() {
  confirm1.onkeyup = function() {
    if(myInput1.value == confirm1.value){
      document.getElementById('savebtn').disabled=false;
      document.getElementById("res_cfpswd").style.border = "2px solid green";
    }
    else{
      document.getElementById('savebtn').disabled=true;
      document.getElementById("res_cfpswd").style.border = "2px solid red";
    }
  }
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput1.value.match(lowerCaseLetters)) {  
    letter1.classList.remove("invalid");
    letter1.classList.add("valid");
  } else {
    letter1.classList.remove("valid");
    letter1.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput1.value.match(upperCaseLetters)) {  
    capital1.classList.remove("invalid");
    capital1.classList.add("valid");
  } else {
    capital1.classList.remove("valid");
    capital1.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput1.value.match(numbers)) {  
    number1.classList.remove("invalid");
    number1.classList.add("valid");
  } else {
    number1.classList.remove("valid");
    number1.classList.add("invalid");
  }

  // Validate special char
  var specials = /[#?!@$%^&*-]/g;
  if(myInput1.value.match(specials)) {  
    special1.classList.remove("invalid");
    special1.classList.add("valid");
  } else {
    special1.classList.remove("valid");
    special1.classList.add("invalid");
  }
  // Validate length
  if(myInput1.value.length >= 8) {
    length1.classList.remove("invalid");
    length1.classList.add("valid");
  } else {
    length1.classList.remove("valid");
    length1.classList.add("invalid");
  }
}
const restogglePassword = document.querySelector('#restogglePassword');
  const respassword = document.querySelector('#res_pswd');

  restogglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = respassword.getAttribute('type') === 'password' ? 'text' : 'password';
    respassword.setAttribute('type', type);
    // toggle the eye slash icon
	  this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});
const restogglePassword1 = document.querySelector('#restogglePassword1');
  const respassword1 = document.querySelector('#res_cfpswd');

  restogglePassword1.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = respassword1.getAttribute('type') === 'password' ? 'text' : 'password';
    respassword1.setAttribute('type', type);
    // toggle the eye slash icon
	  this.classList.toggle('fa-eye-slash');
    this.classList.toggle('fa-eye');
});

</script>


<?php include("footer.php"); ?>

<?php
if(isset($_POST['reset'])){
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$cpass = $_POST['confirm_pass'];
	
  $checkEmail = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$email'");
  $countEmail = mysqli_num_rows($checkEmail);

  if($countEmail != 0){
    if($pass === $cpass){
      mysqli_query($connect,"UPDATE customer SET cus_pass='$pass' WHERE cus_email='$email'");
?>
<script>
    swal({
          title: "Reset successfully Please log in again.",
          icon: "success",
          button: "OK",
          }).then(function(){window.location.href="index.php";});
</script>
<?php
    }
    else{
?>
<script>
    swal({
        title: "Both passwords are not same ! Please type again.",
        icon: "error",
        button: "OK",
        });
</script>
<?php
    }
  }
  else{
?>
<script>
    swal({
        title: "This email address are not exists in our record.",
        icon: "error",
        button: "OK",
        });
</script>
<?php
  }
}
mysqli_close($connect);
?>