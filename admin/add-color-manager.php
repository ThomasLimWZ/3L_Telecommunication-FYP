<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id'])|| $_SESSION["position"] != "Manager"){
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  

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
                <?php
						if(isset($_GET["add"])){
							$pcode = $_GET["code"];
                            $color = $_GET["color"];

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);
							
							$color_result = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code='$pcode'");
							$color_row = mysqli_fetch_assoc($color_result);
                            $imgcode = $color_row['product_img_code'];
						}
					?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add Color for <b><?php echo $row['product_name'];?></b></h1>
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
													<p>Color<span style="color:red;">*</span><input class="form-control" type="text" name="prod_color" value="<?php echo isset($_POST["prod_color"]) ? $_POST["prod_color"] : ''; ?>" required></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Color Image <span style="color:red;">*</span></label>
														<br><input type="file" name="color_img" required>
														<br><label>Choose image</label>
													</div>
												</div>
											
										</div>
										<br>
										<input type="submit" name="savebtn" value="Add Color" class="btn btn-primary buttonedit ml-2">
										<a href="edit-product-manager.php?edit&code=<?php echo $pcode;?>" class="btn btn-primary buttonedit ml-2">Back to Edit Product</a>
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
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
<script>

	var img=document.forms['myform']["color_img"];
	
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
if(isset($_POST["savebtn"])){
	$colorname = $_POST['prod_color'];
	
	$checkName = strtolower($colorname);

    if($color=="product_color2")
    {
        $result1 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color1) = '$checkName' AND product_img_code='$imgcode'");
	    $count1 = mysqli_num_rows($result1);
        $result3 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color3) = '$checkName' AND product_img_code='$imgcode'");
	    $count3 = mysqli_num_rows($result3);
        $result4 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color4) = '$checkName' AND product_img_code='$imgcode'");
	    $count4 = mysqli_num_rows($result4);
        $result5 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color5) = '$checkName' AND product_img_code='$imgcode'");
	    $count5 = mysqli_num_rows($result5);
        $result6 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color6) = '$checkName' AND product_img_code='$imgcode'");
	    $count6 = mysqli_num_rows($result6);

        if(isset($_FILES["color_img"])){
            $pic_name = $_FILES["color_img"]["name"];
            $pic_size = $_FILES["color_img"]["size"];
            $tmp_name = $_FILES["color_img"]["tmp_name"];
            $error = $_FILES["color_img"]["error"];
                
            if($error === 0){
                if($pic_size > 1250000){
                    $alert = "Sorry, file too large";
                }
                else{
                    $pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ex_lc = strtolower($pic_ex);
                        
                    $allowed_exs = array("jpg","jpeg","png");
                        
                    if($count1 != 0 || $count3 != 0 || $count4 != 0 || $count5 != 0 || $count6 != 0){
    ?>
                        <script>
                            swal({title:"This color is existing.Pls change",
                                    type:"error"});
                        </script>
    <?php
                    }
                    else{
                        if(in_array($pic_ex_lc, $allowed_exs)){
                            $new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
                            $pic_upload_path = 'product/'.$new_pic_name;
                            move_uploaded_file($tmp_name, $pic_upload_path);}
                            
                            mysqli_query($connect,"UPDATE product_image SET product_color2='$colorname',product_img2='$new_pic_name' WHERE product_code='$pcode'");
    ?>
    <script>
        swal({
        title: "Record saved.",
        type: "success"
      },function(isConfirm){
                    alert('ok');
              });
              $('.swal2-confirm').click(function(){
                    window.location.href = 'edit-product-manager.php?edit&code=<?php echo $pcode;?>';
              });
    </script>
    <?php
                    }
                }
            }
         }
    }
	else if($color=="product_color3")
    {
        $result1 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color1) = '$checkName' AND product_img_code='$imgcode'");
	    $count1 = mysqli_num_rows($result1);
        $result2 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color2) = '$checkName' AND product_img_code='$imgcode'");
	    $count2 = mysqli_num_rows($result2);
        $result4 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color4) = '$checkName' AND product_img_code='$imgcode'");
	    $count4 = mysqli_num_rows($result4);
        $result5 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color5) = '$checkName' AND product_img_code='$imgcode'");
	    $count5 = mysqli_num_rows($result5);
        $result6 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color6) = '$checkName' AND product_img_code='$imgcode'");
	    $count6 = mysqli_num_rows($result6);
        if(isset($_FILES["color_img"])){
            $pic_name = $_FILES["color_img"]["name"];
            $pic_size = $_FILES["color_img"]["size"];
            $tmp_name = $_FILES["color_img"]["tmp_name"];
            $error = $_FILES["color_img"]["error"];
                
            if($error === 0){
                if($pic_size > 1250000){
                    $alert = "Sorry, file too large";
                }
                else{
                    $pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ex_lc = strtolower($pic_ex);
                        
                    $allowed_exs = array("jpg","jpeg","png");
                        
                    if($count1 != 0 || $count2 != 0 || $count4 != 0 || $count5 != 0 || $count6 != 0){
    ?>
                        <script>
                            swal({title:"This color is existing.Pls change",
                                    type:"error"});
                        </script>
    <?php
                    }
                    else{
                        if(in_array($pic_ex_lc, $allowed_exs)){
                            $new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
                            $pic_upload_path = 'product/'.$new_pic_name;
                            move_uploaded_file($tmp_name, $pic_upload_path);}
                            
                            mysqli_query($connect,"UPDATE product_image SET product_color3='$colorname',product_img3='$new_pic_name' WHERE product_code='$pcode'");
    ?>
    <script>
        swal({
        title: "Record saved.",
        type: "success"
      },function(isConfirm){
                    alert('ok');
              });
              $('.swal2-confirm').click(function(){
                window.location.href = 'edit-product-manager.php?edit&code=<?php echo $pcode;?>';
              });
    </script>
    <?php
                    }
                }
            }
         }
    }
    else if($color=="product_color4")
    {
        $result1 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color1) = '$checkName' AND product_img_code='$imgcode'");
	    $count1 = mysqli_num_rows($result1);
        $result3 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color3) = '$checkName' AND product_img_code='$imgcode'");
	    $count3 = mysqli_num_rows($result3);
        $result2 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color2) = '$checkName' AND product_img_code='$imgcode'");
	    $count2 = mysqli_num_rows($result2);
        $result5 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color5) = '$checkName' AND product_img_code='$imgcode'");
	    $count5 = mysqli_num_rows($result5);
        $result6 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color6) = '$checkName' AND product_img_code='$imgcode'");
	    $count6 = mysqli_num_rows($result6);

        if(isset($_FILES["color_img"])){
            $pic_name = $_FILES["color_img"]["name"];
            $pic_size = $_FILES["color_img"]["size"];
            $tmp_name = $_FILES["color_img"]["tmp_name"];
            $error = $_FILES["color_img"]["error"];
                
            if($error === 0){
                if($pic_size > 1250000){
                    $alert = "Sorry, file too large";
                }
                else{
                    $pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ex_lc = strtolower($pic_ex);
                        
                    $allowed_exs = array("jpg","jpeg","png");
                        
                    if($count1 != 0 || $count3 != 0 || $count2 != 0 || $count5 != 0 || $count6 != 0){
    ?>
                        <script>
                            swal({title:"This color is existing.Pls change",
                                    type:"error"});
                        </script>
    <?php
                    }
                    else{
                        if(in_array($pic_ex_lc, $allowed_exs)){
                            $new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
                            $pic_upload_path = 'product/'.$new_pic_name;
                            move_uploaded_file($tmp_name, $pic_upload_path);}
                            
                            mysqli_query($connect,"UPDATE product_image SET product_color4='$colorname',product_img4='$new_pic_name' WHERE product_code='$pcode'");
    ?>
    <script>
        swal({
        title: "Record saved.",
        type: "success"
      },function(isConfirm){
                    alert('ok');
              });
              $('.swal2-confirm').click(function(){
                window.location.href = 'edit-product-manager.php?edit&code=<?php echo $pcode;?>';
              });
    </script>
    <?php
                    }
                }
            }
         }
    }
    else if($color=="product_color5")
    {
        $result1 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color1) = '$checkName' AND product_img_code='$imgcode'");
	    $count1 = mysqli_num_rows($result1);
        $result3 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color3) = '$checkName' AND product_img_code='$imgcode'");
	    $count3 = mysqli_num_rows($result3);
        $result4 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color4) = '$checkName' AND product_img_code='$imgcode'");
	    $count4 = mysqli_num_rows($result4);
        $result2 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color2) = '$checkName' AND product_img_code='$imgcode'");
	    $count2 = mysqli_num_rows($result2);
        $result6 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color6) = '$checkName' AND product_img_code='$imgcode'");
	    $count6 = mysqli_num_rows($result6);

        if(isset($_FILES["color_img"])){
            $pic_name = $_FILES["color_img"]["name"];
            $pic_size = $_FILES["color_img"]["size"];
            $tmp_name = $_FILES["color_img"]["tmp_name"];
            $error = $_FILES["color_img"]["error"];
                
            if($error === 0){
                if($pic_size > 1250000){
                    $alert = "Sorry, file too large";
                }
                else{
                    $pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ex_lc = strtolower($pic_ex);
                        
                    $allowed_exs = array("jpg","jpeg","png");
                        
                    if($count1 != 0 || $count3 != 0 || $count4 != 0 || $count2 != 0 || $count6 != 0){
    ?>
                        <script>
                            swal({title:"This color is existing.Pls change",
                                    type:"error"});
                        </script>
    <?php
                    }
                    else{
                        if(in_array($pic_ex_lc, $allowed_exs)){
                            $new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
                            $pic_upload_path = 'product/'.$new_pic_name;
                            move_uploaded_file($tmp_name, $pic_upload_path);}
                            
                            mysqli_query($connect,"UPDATE product_image SET product_color5='$colorname',product_img5='$new_pic_name' WHERE product_code='$pcode'");
    ?>
    <script>
        swal({
        title: "Record saved.",
        type: "success"
      },function(isConfirm){
                    alert('ok');
              });
              $('.swal2-confirm').click(function(){
                window.location.href = 'edit-product-manager.php?edit&code=<?php echo $pcode;?>';
              });
    </script>
    <?php
                    }
                }
            }
         }
    }
    else 
    {
        $result1 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color1) = '$checkName' AND product_img_code='$imgcode'");
	    $count1 = mysqli_num_rows($result1);
        $result3 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color3) = '$checkName' AND product_img_code='$imgcode'");
	    $count3 = mysqli_num_rows($result3);
        $result4 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color4) = '$checkName' AND product_img_code='$imgcode'");
	    $count4 = mysqli_num_rows($result4);
        $result5 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color5) = '$checkName' AND product_img_code='$imgcode'");
	    $count5 = mysqli_num_rows($result5);
        $result2 = mysqli_query($connect,"SELECT * FROM product_image WHERE LOWER(product_color2) = '$checkName' AND product_img_code='$imgcode'");
	    $count2 = mysqli_num_rows($result2);

        if(isset($_FILES["color_img"])){
            $pic_name = $_FILES["color_img"]["name"];
            $pic_size = $_FILES["color_img"]["size"];
            $tmp_name = $_FILES["color_img"]["tmp_name"];
            $error = $_FILES["color_img"]["error"];
                
            if($error === 0){
                if($pic_size > 1250000){
                    $alert = "Sorry, file too large";
                }
                else{
                    $pic_ex = pathinfo($pic_name, PATHINFO_EXTENSION);
                    $pic_ex_lc = strtolower($pic_ex);
                        
                    $allowed_exs = array("jpg","jpeg","png");
                        
                    if($count1 != 0 || $count3 != 0 || $count4 != 0 || $count5 != 0 || $count2 != 0){
    ?>
                        <script>
                            swal({title:"This color is existing.Pls change",
                                    type:"error"});
                        </script>
    <?php
                    }
                    else{
                        if(in_array($pic_ex_lc, $allowed_exs)){
                            $new_pic_name = uniqid("IMG-", true).'.'.$pic_ex_lc;
                            $pic_upload_path = 'product/'.$new_pic_name;
                            move_uploaded_file($tmp_name, $pic_upload_path);}
                            
                        mysqli_query($connect,"UPDATE product_image SET product_color6='$colorname',product_img6='$new_pic_name' WHERE product_code='$pcode'");
    ?>
    <script>
        swal({
        title: "Record saved.",
        type: "success"
      },function(isConfirm){
                    alert('ok');
              });
              $('.swal2-confirm').click(function(){
                window.location.href = 'edit-product-manager.php?edit&code=<?php echo $pcode;?>';
              });
    </script>
    <?php
                    }
                }
            }
         }
    }
}
mysqli_close($connect);
?>