<?php include("header-login.php"); ?>
		
		<main class="main">
			<form method="POST" action="">
			<div class="container" style="text-align:center;">
				<hr class="mb-2">
				<h1><b>Checkout</b></h1>
				<hr class="mb-2">
				<br>
			</div>
			
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index-login.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </div><!-- End .container -->
			
            <div class="page-content">
            	<div class="checkout">
	                <div class="container">
            			<form method="POST" action="" autocomplete="off">
		                	<div class="row">
		                		<div class="col-lg-5">
		                			<h2 class="checkout-title">Shipping Address</h2><!-- End .checkout-title -->
		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Receiver Name <span style="color:red;">*</span></label>
		                						<input type="text" name="receiver" id="receiver" class="form-control"  autocomplete="off" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

	            						<label>Address <span style="color:red;">*</span></label>
	            						<input type="text" id="address" name="address" class="form-control" placeholder="House number & Street name" autocomplete="off" required>

	            						<div class="row">
		                					<div class="col-sm-6">
		                						<label>Town / City <span style="color:red;">*</span></label>
		                						<input type="text" id="city" name="city" class="form-control" placeholder="e.g. Melaka Tengah" autocomplete="off" required>
		                					</div><!-- End .col-sm-6 -->

		                					<div class="col-sm-6">
		                						<label>State <span style="color:red;">*</span></label>
		                						<select class="form-control" id="state" name="state" required>
													<option disabled selected value="">Select State</option>
													<option>Melaka</option>
													<option>Johor</option>
													<option>Selangor</option>
													<option>Negeri Sembilan</option>
													<option>Pulau Pinang</option>
													<option>Kedah</option>
													<option>Kelantan</option>
													<option>Pahang</option>
													<option>Perlis</option>
													<option>Perak</option>
													<option>Sabah</option>
													<option>Sarawak</option>
													<option>Terengganu</option>
												</select>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

		                				<div class="row">
		                					<div class="col-sm-6">
		                						<label>Postcode / ZIP <span style="color:red;">*</span></label>
		                						<input type="text" id="postcode" name="postcode" class="form-control" placeholder="e.g. 71000" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" minlength="5" maxlength="5" autocomplete="off" required>
		                					</div><!-- End .col-sm-6 -->
										</div><!-- End .row -->

										<?php
										$mail = $_SESSION['email'];
										$email_check = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$mail'");
										$email_row = mysqli_fetch_assoc($email_check);

										if(!empty($email_row['cus_address']) && !empty($email_row['cus_city']) && !empty($email_row['cus_state']) && !empty($email_row['cus_post_code'])){
										?>
										<div class="row">
		                					<div class="col-sm-6">
												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-control-input" id="auto_fill" onclick="autofillAddress()">
													<label class="custom-control-label" for="auto_fill">Deliver to my address</label>
												</div><!-- End .custom-checkbox -->
											</div>
										</div><!-- End .row -->
										<?php
										}
										else{}
										?>
										<h2 class="checkout-title">Contact Information</h2>
										
										<div class="row">
		                					<div class="col-sm-6">
		                						<label>Phone <span style="color:red;">*</span></label>
		                						<input type="tel" name="phone" id="phone_field" class="form-control" pattern="(01)[0-9]{8,9}" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" placeholder="e.g. 01xxxxxxxxx" minlength="10" maxlength="11" required>
		                					</div><!-- End .col-sm-6 -->
		                				</div><!-- End .row -->

										<script>
											function autofillAddress(){
												var checkBox = document.getElementById("auto_fill");
												var email = '<?php echo $_SESSION['email'];?>';
												if(checkBox.checked == true){
													$.ajax({
														type:'post',
														url:'autofill-address.php',
														data: {
															cus_email:email
														},
														success:function(data){
															var result = $.parseJSON(data);
															document.getElementById('address').value=result[0];
															document.getElementById('city').value=result[1];
															document.getElementById('state').value=result[2];
															document.getElementById('postcode').value=result[3];
															document.getElementById('phone_field').value=result[4];
															document.getElementById('receiver').value=result[5];
														}
													})
												}
												else{
													document.getElementById('address').value='';
													document.getElementById('city').value='';
													document.getElementById('state').value='';
													document.getElementById('postcode').value='';
													document.getElementById('phone_field').value='';
													document.getElementById('receiver').value='';
												}
											}
										</script>

	                					<label>Special notes (Optional)</label>
	        							<textarea class="form-control" name="notes" cols="30" rows="4" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
		                		</div><!-- End .col-lg-6 -->
								
		                		<aside class="col-lg-7">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
													<th>Product</th>
													<th style="width:100px;">Capacity</th>
													<th style="width:100px;">Color</th>
													<th style="width:100px;">Price</th>
		                							<th style="width:50px;">Subtotal</th>
		                						</tr>
		                					</thead>

		                					<tbody>
											<?php
												$total = 0;
												$result = mysqli_query($connect, "SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
												while($row = mysqli_fetch_assoc($result)){
													$pcode = $row['product_code'];
													$cart = $row['product_detail_code'];
													$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_detail_code='$cart'");
													$detail_row = mysqli_fetch_assoc($detail_result);
													$prod_result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
													while($prod_row = mysqli_fetch_assoc($prod_result)){
														$img_result = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code='$pcode'");
														while($img_row = mysqli_fetch_assoc($img_result)){
											?>
		                						<tr>
		                							<td><?php echo $prod_row['product_name']; ?></td>
													<?php
													if($prod_row['cat_name'] == 'Audio' || $prod_row['cat_name'] == 'Accessories'){
													?>
														<td>-</td>
													<?php
													}
													else{
													?>
		                								<td><?php echo $detail_row['product_capacity']; ?></td>
													<?php
													}
													?>
		                							<td><?php echo $row['product_color']; ?></td>
		                							<td><?php echo $row['quantity']; ?> x <?php echo $row['product_price']; ?></td>
													<td>RM <?php echo $row['cart_subtotal']; ?></td>
		                						</tr>
											<?php
															$total += $row['cart_subtotal'];
														}
													}
												}
											?>
		                						<tr>
		                							<td>Shipping:</td>
													<td colspan="4">Free shipping</td>
		                						</tr>
		                						<tr class="summary-total">
		                							<td>Total : </td>
		                							<td colspan="4"><b>RM <?php echo number_format($total,2); ?></b></td>
		                						</tr><!-- End .summary-total -->
		                					</tbody>
		                				</table><!-- End .table table-summary -->

		                				<button type="submit" name="checkoutbtn" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Proceed to Payment</span>
		                					<span class="btn-hover-text">Proceed to Payment</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-6 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .checkout -->
            </div><!-- End .page-content -->
			</form>
        </main><!-- End .main -->
		
<?php include("footer-login.php"); ?>


<?php
if(isset($_POST['checkoutbtn'])){
	$name = $_POST['receiver'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$postcode = $_POST['postcode'];
	$phone = $_POST['phone'];
	$notes = $_POST['notes'];
	
	mysqli_query($connect,"INSERT INTO shipping (receiver_name,address,city,state,post_code,contact_phone,special_notes,delivery_status,cus_email) VALUES ('$name','$address','$city','$state','$postcode','$phone','$notes',0,'$cus_email')");
?>
<script>
window.location = "payment.php";
</script>
<?php
}
mysqli_close($connect);
?>