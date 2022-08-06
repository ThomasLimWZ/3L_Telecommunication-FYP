<?php
session_start();
include("connection.php");
$error = "";

if(isset($_GET["login"])){
	if(empty($_GET["admin_id"]) || empty($_GET["admin_pass"])){
		$error = "ID or Password is empty";
	}
	else{
		$id = $_GET["admin_id"];
		$pass = $_GET["admin_pass"];
		
		$id = mysqli_real_escape_string($connect,$id);
		$pass = mysqli_real_escape_string($connect,$pass);
		
		$result = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id='$id' AND adm_pass='$pass'");
		$check = mysqli_query($connect,"SELECT * FROM admin WHERE adm_id='$id' AND adm_status=1");
		$count = mysqli_num_rows($result);
		$checkrow = mysqli_num_rows($check);

       
		if($count == 1 && $checkrow==1){
			$row = mysqli_fetch_assoc($result);
			$_SESSION["id"] = $row["adm_id"];
            if($id == $row["adm_id"] && $pass == $row["adm_pass"]){
                $_SESSION["position"]=$row['adm_position'];
                // $position = $row['adm_position'];
                if($_SESSION["position"] == "Manager"){
                    header("location:index-manager.php");
                }
                else{
                    header("location:index.php");
                }
            }
            else{
                $error = "Username OR Password is INVALID";
            }
		}
        else if($count ==1 && $checkrow==0)
        {
            $error="This admin account is INACTIVE";
        }
		else{
			$error = "Username OR Password is INVALID";
		}
	}
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3L Admin - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .input-icons i {
            cursor:pointer;
            margin-top:-32px;
            margin-left:300px;
            position:absolute;
		}
			
		#comment{
			color:grey;
			font-style:bold;
			
        }
    </style>
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
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome!</h1>
                                    </div>
                                     <form class="user" method="GET" autocomplete="off">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="exampleInputID" name="admin_id" value="<?php echo isset($_GET["admin_id"]) ? $_GET["admin_id"] : ''; ?>" placeholder="Admin ID">
                                        </div>
                                        <div class="form-group">
                                        <div class="input-icons">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="admin_pass" placeholder="Password">
                                            <i class="fa fa-eye-slash" id="togglePassword"></i>
                                        </div>
                                        </div>
										<span style="margin-left:55px; font-size:15px; color:red;"> <?php echo $error;?></span>
                                         
										<input type="submit" name="login" value="Login" class="btn btn-primary btn-user btn-block">
                                        
                                    </form>
                                    <hr>
                                    <div class="text-center">
										<a class="small" href="forgot-id.php">Forgot ID?</a>
										<a  id="comment"> | </a>
                                        <a class="small" href="forgot-password.php">Forgot Password?</a>
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
<script>
  //current password
 const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#exampleInputPassword");

        togglePassword.addEventListener("click", function () {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
             // toggle the eye icon
            this.classList.toggle('fa-eye-slash');
            this.classList.toggle('fa-eye');
        });

        
        
</script>