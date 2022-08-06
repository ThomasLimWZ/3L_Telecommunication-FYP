<!DOCTYPE html>
<html>

<?php
include('connection.php');

if(isset($_GET['reset'])){
	$email = $_GET['email'];

	$res = mysqli_query($connect,"select adm_email,adm_pass,adm_name from admin where adm_email='$email'");
	$row = mysqli_fetch_array($res);
	
	if($row != 0){ 
		$receiver = $row['adm_email'];
		$fname = $row['adm_name'];
		$subject = "Reset your password";
		$password = $row['adm_pass'];
		$message = "Dear ".$fname.",\n\nPlease click the link below to reset your password.\n\nhttp://localhost/3L_Telecommunication/admin/reset-password.php";
		$headers = "From: 3L Telecommunication" . "\r\n";
		
		if(mail($receiver,$subject,$message,$headers)) {
?>
			<script>
				alert("The reset link already sent to <?php echo $receiver ?>");
			</script>
<?php
		}
		else {
		   echo  "<script>swal('Sorry, unable to send mail...');</script>";
		}
	}
	else{
?>		
		
			<script>
			
				alert("This email haven't register to our website.");
				
		</script>
<?php		
	}
}
?>
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

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <br/><br/><br/><br/>
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Password?</h1>
                                        <p class="mb-4">Enter your email to get reset password link!</p>
                                    </div>
                                    <form class="user" autocomplete="off")>
                                        <div class="form-group">
                                            <input id="email" name="email" placeholder="Your Email Address" class="form-control"  type="email" required>
                                        </div>
                                        <input type="submit" name="reset" value="Reset Password" class="btn btn-primary btn-user btn-block">
                                    </form>
                                    <br>
                                    <div class="text-center">
                                        <a class="small" href="logout.php"> Back to Login!</a>
                                    </div>
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