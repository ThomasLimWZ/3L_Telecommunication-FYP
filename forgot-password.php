<?php include("header.php"); ?>
<?php 
if(isset($_GET['reset'])){
	$email = $_GET['email'];

	$res = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$email'");
	$row = mysqli_fetch_array($res);
	
	if($row != 0){ 
		$receiver = $row['cus_email'];
		$fname = $row['cus_name'];
		$subject = "Reset Password";
		$message = "Dear ".$fname.",\n\nYou are receiving this email because we received a password reset request for your account. Please click the link below to reset your password. Thank you\n\nhttp://localhost/3L_Telecommunication/reset-password.php\n\nRegards,\n3L Telecommunication";
		$headers = "From: 3L Telecommunication" . "\r\n";
		
		if(mail($receiver,$subject,$message,$headers)) {
?>
			<script>
				swal({
					title: 'The reset link already sent to <?php echo $receiver ?>',
					icon: 'success',
					button: 'OK',
					});
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
	else{
?>
		<script>
			swal({
				title: "This email haven't register to our website.",
				icon: "error",
				button: "OK",
				});
		</script>
<?php
	}
}
?>
		<div class="container" style="text-align:center;">
			<br>
			<hr class="mb-2">
			<h3><b>Forgot your password?</b></h3>
			<p>No problem. Just let us know your email address and we will email you a password reset link via email.</p>
			<hr class="mb-2">
			<br>
		</div>
		
		
		<div class="wrapper" style="margin:auto;">
			<form action="#" method="GET" autocomplete="off">
				<div class="form-group" style="width:400px;">
					<label><b>Your Email Address</b></label>
					<input type="email" class="form-control" name="email" placeholder="Email Address" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-z]{2,}$" required autofocus="">
				</div><!-- End .form-group -->
				<button class="btn btn-lg btn-primary btn-block" type="submit" name="reset">EMAIL PASSWORD RESET LINK</button>
				<br>
			</form>
			<br>
		</div>
<?php include("footer.php"); ?>