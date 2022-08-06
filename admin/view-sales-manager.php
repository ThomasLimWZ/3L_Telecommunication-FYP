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
                        <h1 class="h3 mb-0 text-gray-800">Sales Details</h1>
                    </div>
					
					<?php
						if(isset($_GET["view"])){
							$code = $_GET["code"];
							
							$payment_res = mysqli_query($connect,"SELECT * FROM payment WHERE payment_code='$code'");
							$pay_row = mysqli_fetch_assoc($payment_res);
							
							$pay_email=$pay_row['cus_email'];

							$customer_result = mysqli_query($connect, "SELECT * FROM customer WHERE cus_email='$pay_email'");
							$cus_row = mysqli_fetch_assoc($customer_result);
							
							$ship_result = mysqli_query($connect, "SELECT * FROM shipping WHERE payment_code='$code'");
							$ship_row = mysqli_fetch_assoc($ship_result);
							
							if($ship_row['delivery_status']==0)
							{ $status="Preparing";}
						
							else if($ship_row['delivery_status']==1)
							{$status="Shipped Out";}

							else if($ship_row['delivery_status']==2)
							{$status="Delivery in Progress";}
							
							else
							{$status="Completed";}
							
					?>
                    
					<!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
									<form name="vieworder" method="post" action="" enctype="multipart/form-data">
										<div class="row formtype">
											<div class="col-md-4">
												<div class="form-group">
													<p>Order Code<input class="form-control" type="text" name="order_code" value="<?php echo $pay_row['payment_code'];?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Customer Name<input class="form-control" type="text" name="cus_name" value="<?php echo $cus_row['cus_name'];?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Customer Email<input class="form-control" type="text" name="cus_name" value="<?php echo $cus_row['cus_email'];?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Order Date & Time <input class="form-control" type="text" name="order_date" value="<?php $date = date_create($pay_row['payment_date']);echo date_format($date,"d-m-Y H:i:s");?>" disabled></p>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<p>Order Status <input class="form-control" type="text" name="order_status" value="<?php echo $status;?>" disabled></p>
												</div><br>
											</div>
											<?php
											if(empty($ship_row['adm_id'])){ 
												?>
											<div class="col-md-4">
												<div class="form-group">
														<p>Admin ID<input class="form-control" type="text" name="adm_id" value="NULL" disabled></p>
												</div>
											</div>
											<?php
											}
											else{
											?>
											<div class="col-md-4">
													<div class="form-group">
														<p>Admin ID<input class="form-control" type="text" name="adm_id" value="<?php echo $ship_row['adm_id'];?>" disabled></p>
													</div>
											</div>
											<?php
											}
											?>
										</div>
										</div>
										<br/>
										
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
											<h1 class="h3 mb-0 text-gray-800">Shipping Details</h1>
										</div>
										<div class="row formtype">
											<div class="col-md-4">
														<div class="form-group">
														<p>Receiver Name<input class="form-control" type="text" name="ship_name" value="<?php echo $ship_row['receiver_name'];?>" disabled></p>
														</div>
											</div>
											<div class="col-md-4">
														<div class="form-group">
														<p>Contact_Number<input class="form-control" type="text" name="ship_phone" value="<?php echo $ship_row['contact_phone'];?>" disabled></p>
														</div>
											</div>
											<div class="col-md-4">
											<div class="form-group">
														<p><b>Tracking Number<input class="form-control" type="text" name="ship_track" value="<?php echo $ship_row['tracking_number'];?>" disabled></b></p>
														</div>
											</div>
											<div class="col-md-4">
														<div class="form-group">
															<label>Address</label>
															<textarea class="form-control validate" name="ship_address" rows="4" disabled><?php echo $ship_row['address'];?></textarea>
														</div>
											</div>
											<div class="col-md-4">
														<div class="form-group">
														<p>City<input class="form-control" type="text" name="ship_city" value="<?php echo $ship_row['city'];?>" disabled></p>
														</div>
														<div class="form-group">
														<p>State<input class="form-control" type="text" name="ship_state" value="<?php echo $ship_row['state'];?>" disabled></p>
														</div>
											</div>
											
											<div class="col-md-4">
														<div class="form-group">
														<p>Postcode<input class="form-control" type="text" name="ship_postcode" value="<?php echo $ship_row['post_code'];?>" disabled></p>
														</div><br/>
											</div>
											<?php
											if(empty($ship_row['special_notes'])){}
											else{
											?>
											<div class="col-md-4">
														<div class="form-group">
															<label>Special Notes</label>
															<textarea class="form-control validate" name="ship_note" rows="4" disabled><?php echo $ship_row['special_notes'];?></textarea>
														</div><br>
											</div>
											<?php
											}
											?>
										</div>
										<br/>
										
										<div class="d-sm-flex align-items-center justify-content-between mb-4">
										<h1 class="h3 mb-0 text-gray-800"><br/>Order Products </h1>
										</div>
										<div class="row formtype">
										<div class="col-md-8">
										<table style="margin:auto; border-collapse:separate; border:solid black 1px; border-radius:6px;">
										
										<tr style="background-color:#f2f2f2;">
										
											<th width="100px" style="font-weight:bold; text-align:center; padding:5px; border-top: none; border-left: none; border-right: solid black 1px;">No.</th>
											<th width="600px" style="font-weight:bold; text-align:center; padding:5px; border-top:none; border-left: none;">Order Products</th>
											<th width="120px" style="font-weight:bold; text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Capacity/Size</th>
											<th width="160px" style="font-weight:bold; text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Color</th>
											<th width="120px" style="font-weight:bold; text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Quantity</th>
											<th width="180px" style="font-weight:bold; text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Unit Price</th>
											<th width="180px" style="font-weight:bold; text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Subtotal</th>
											
										</tr>
										<?php 
											$prod_res = mysqli_query($connect,"SELECT * FROM cart JOIN product ON cart.product_code=product.product_code WHERE payment_code='$code'");
											
											$i=1;
											while($prod_row = mysqli_fetch_assoc($prod_res)){
												$detail = $prod_row['product_detail_code'];
												$pcode = $prod_row['product_code'];
												$detail_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail'");
												$detail_row = mysqli_fetch_assoc($detail_res);
										?>
										<tr style="background-color:#fff;">
											<td style="text-align:center; padding:5px; border-top:solid black 1px; border-left: none; border-right: solid black 1px;"><?php echo $i; ?></td>
											<td style="padding:5px; border-top:solid black 1px; border-left: none;">
												<?php echo $prod_row['product_name']; ?>
											</td>
											<td style="text-align:center; padding:5px; border-left:solid black 1px; border-top:solid black 1px;">
												<?php
												if($detail_row['product_capacity'] == NULL){
													echo "-";
												}
												else{
													echo $detail_row['product_capacity']; 
												}
												?>
											</td>
											<td style="text-align:center; padding:5px; border-left:solid black 1px; border-top:solid black 1px;"><?php echo $prod_row['product_color']; ?></td>
											<td style="text-align:center; padding:5px; border-left:solid black 1px; border-top:solid black 1px;"><?php echo $prod_row['quantity']; ?></td>
											<td style="padding:5px; border-left:solid black 1px; border-top:solid black 1px;">RM <?php echo $prod_row['product_price']; ?></td>
											<td style="padding:5px; border-left:solid black 1px; border-top:solid black 1px;">RM <?php echo $prod_row['cart_subtotal']; ?></td>
											
										</tr>
										<?php 	
											$i++;
											}
										?>
										<tr style="background-color:#fff;">
											<td style="border-top:solid black 1px;"></td>
											<td style="border-top:solid black 1px;"></td>
											<td style="border-top:solid black 1px;"></td>
											<td style="border-top:solid black 1px;"></td>
											<td style="border-top:solid black 1px;"></td>
											<td style="border-top:solid black 1px;"></td>
											<td style="font-weight:bold; color:black;padding:5px; border-top:solid black 1px;">RM <?php echo $pay_row['payment_total']; ?></td>
										</tr>
										</table>
										</div>
										</div>	
										</div>
										<br/>
										<button class="btn btn-primary buttonedit ml-2" onclick="window.history.go(-1); return false;">Back to Sales List</button>
									</form>
									
								</div>
							</div>
						</div>
					</div>
				
                
            <!-- End of Main Content -->
			<br>
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
<?php
	}
}
mysqli_close($connect);
?>