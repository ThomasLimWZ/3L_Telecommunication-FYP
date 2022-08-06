<?php include("header-login.php"); ?>
		
		<main class="main">
			<div class="container" style="text-align:center;">
				<hr class="mb-2">
				<h1><b>Payment</b></h1>
				<hr class="mb-2">
				<br>
			</div>
			
			<div class="container">
				<ol class="breadcrumb">
					<li class="breadcrumb-item"><a href="index-login.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="cart.php">Cart</a></li>
					<li class="breadcrumb-item"><a href="#" onclick="history.back()">Checkout</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Payment</li>
                </ol>
            </div><!-- End .container -->

			<form method="POST" action="" autocomplete="off" name="paymentfrm" onsubmit="return validateForm()">
			<div class="page-content">
            	<div class="payment">
	                <div class="container">
            			<form action="#">
		                	<div class="row">
		                		<div class="col-lg-5">
		                			<h2 class="payment-title" style="font-size:13pt;"><br>Payment Details</h2><!-- End .payment-title -->
		                			<img src="assets/images/demos/card.png" id="card_img" style="height:35px; object-fit:contain;">
									<br>
										<div class="row">
		                					<div class="col-sm-7">
		                						<label>Card Holder <span style="color:red;">*</span></label>
		                						<input type="text" id="card_holder" name="card_holder" class="form-control" required>
		                					</div><!-- End .col-sm-7 -->
		                				</div><!-- End .row -->

	            						<div class="row">
		                					<div class="col-sm-7">
		                						<label>Card Number <span style="color:red;">*</span></label>
		                						<input style="float:left;" type="text" name="card_num" class="form-control" id="card" onkeypress='validate(event)' onkeyup="checkcard(this.value);" placeholder="xxxx xxxx xxxx xxxx" pattern="[4-5]{1}[0-9]{3}\s[0-9]{4}\s[0-9]{4}\s[0-9]{4}" maxlength="19" required>
												<span id="card_error" style="color:red"></span>
		                					</div><!-- End .col-sm-7 -->
		                				</div><!-- End .row -->
										
										<label>Expiry Date <span style="color:red;">*</span></label>
		                				<div class="row">
											<div class="col-sm-4">
		                						<select name="expiry_month" class="form-control" id="month" required>
													<option value="" disabled selected>Month</option>
													<option value="01">January</option>
													<option value="02">February</option>
													<option value="03">March</option>
													<option value="04">April</option>
													<option value="05">May</option>
													<option value="06">June</option>
													<option value="07">July</option>
													<option value="08">August</option>
													<option value="09">September</option>
													<option value="10">October</option>
													<option value="11">November</option>
													<option value="12">December</option>
												</select>
		                					</div><!-- End .col-sm-4 -->
											<div class="col-sm-3">
		                						<select name="expiry_year" class="form-control" id="year" required>
													<option disabled selected>Year</option>
													<option value="2022">2022</option>
													<option value="2023">2023</option>
													<option value="2024">2024</option>
													<option value="2025">2025</option>
													<option value="2026">2026</option>
													<option value="2027">2027</option>
													<option value="2028">2028</option>
													<option value="2029">2029</option>
													<option value="2030">2030</option>
												</select>
												<span id="error2" style="color:red"></span>
		                					</div><!-- End .col-sm-3 -->
										</div><!-- End .row -->
										
										<div class="row">
											<div class="col-sm-3">
		                						<label>CVV <span style="color:red;">*</span></label>
		                						<input type="text" id="ccv" name="ccv" class="form-control" placeholder="xxx" pattern="[0-9]{3}" maxlength="3" oninput="this.value = this.value.replace(/[^0-9.]/g, '');" required>
		                					</div><!-- End .col-sm-2 -->
										</div><!-- End .row -->
		                		</div><!-- End .col-lg-7 -->
								
		                		<aside class="col-lg-7">
		                			<div class="summary">
		                				<h3 class="summary-title">Your Order</h3><!-- End .summary-title -->

		                				<table class="table table-summary">
		                					<thead>
		                						<tr>
		                							<th>Product</th>
													<th style="width:100px;">Capacity</th>
													<th style="width:100px;">Color</th>
													<th></th>
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
		                							<td><?php echo $row['quantity']; ?> x RM <?php echo $row['product_price']; ?></td>
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

		                				<button type="submit" id="paymentbtn" name="paymentbtn" class="btn btn-outline-primary-2 btn-order btn-block">
		                					<span class="btn-text">Place Order</span>
		                					<span class="btn-hover-text">Place Order</span>
		                				</button>
		                			</div><!-- End .summary -->
		                		</aside><!-- End .col-lg-5 -->
		                	</div><!-- End .row -->
            			</form>
	                </div><!-- End .container -->
                </div><!-- End .payment -->
            </div><!-- End .page-content -->
			</form>
        </main><!-- End .main -->
		
<?php include("footer-login.php"); ?>

<script type="text/javascript">
 $('#card').on('keyup', function(e){         
    var val = $(this).val();         
    var newval = '';         
    val = val.replace(/\s/g, ''); 
    
    // iterate to letter-spacing after every 4 digits   
    for(var i = 0; i < val.length; i++) {             
      if(i%4 == 0 && i > 0) newval = newval.concat(' ');             
      newval = newval.concat(val[i]);         
    }        

    // format in same input field 
    $(this).val(newval);     
});  
function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

<script>
function checkcard(val){
	var visa = /^4(\d{3})\s(\d{4})\s(\d{4})\s(\d{4})?$/;
	var master = /^5(\d{3})\s(\d{4})\s(\d{4})\s(\d{4})?$/;

	if(val.match(visa)){
		document.getElementById("card_img").src="assets/images/demos/visa.png";
		document.getElementById("card_error").innerHTML="";
		document.getElementById("paymentbtn").disabled = false;
	}
	else if(val.match(master)){
		document.getElementById("card_img").src="assets/images/demos/master.png";
		document.getElementById("card_error").innerHTML="";
		document.getElementById("paymentbtn").disabled = false;
	}
	else if(!val.match(visa) || !val.match(master)){
		document.getElementById("card_error").innerHTML=" [Invalid Card Number]";
		document.getElementById("card_img").src="assets/images/demos/card.png";
		document.getElementById("paymentbtn").disabled = true;
	}
}
function validateForm(){
	var exMonth = document.getElementById("month").value;
	var exYear = document.getElementById("year").value;

	var today = new Date();
	var someday = new Date();
	someday.setFullYear(exYear, exMonth, 1);

	if (someday < today) {
		swal({
		title: "This card already expired. Please change a card, thank you.",
		icon: "error",
		button: "OK",
		});
		return false;
	}
}
</script>

<?php
if(isset($_POST['paymentbtn'])){
	$generate = substr(str_shuffle("0123456789"), 0, 6);
	$uniq = "INV".$generate;
	$holder = $_POST['card_holder'];
	
	$convertkName = strtolower($holder);
	$birth_res = mysqli_query($connect,"SELECT * FROM customer WHERE LOWER(cus_name)='$convertkName'");
	$birth_row = mysqli_fetch_assoc($birth_res);
	$birth_date = $birth_row["cus_dob"];

	date_default_timezone_set("Asia/Kuala_Lumpur");
	$date = date('Y-m-d H:i:s');

	if(empty($birth_row['cus_dob']) || $birth_row['cus_dob'] == "0000-00-00"){
		mysqli_query($connect,"INSERT INTO payment (payment_code,card_holder,payment_total,cus_email) VALUES ('$uniq','$holder','$total','$cus_email')");
		$cart_result = mysqli_query($connect, "SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
			
		mysqli_query($connect,"UPDATE shipping SET payment_date='$date' WHERE cus_email='$cus_email' ORDER BY shipping_code DESC LIMIT 1");
		
		while($cart_row = mysqli_fetch_assoc($cart_result)){
			$cart_product = $cart_row['product_code'];
			$cart_product_cap = $cart_row['product_detail_code'];
			mysqli_query($connect,"UPDATE cart SET cart_status=0,payment_date='$date' WHERE cart_status=1 AND product_code='$cart_product' AND cus_email='$cus_email'");
			
			$pay_result = mysqli_query($connect,"SELECT * FROM payment WHERE cus_email='$cus_email' AND payment_date='$date'");
			$pay_row = mysqli_fetch_assoc($pay_result);
			$pay_code = $pay_row['payment_code'];
			mysqli_query($connect,"UPDATE cart SET payment_code='$pay_code' WHERE product_code='$cart_product' AND cus_email='$cus_email' AND payment_date='$date'");
			mysqli_query($connect,"UPDATE shipping SET payment_code='$pay_code' WHERE cus_email='$cus_email' AND payment_date='$date'");
			
			$prod_res = mysqli_query($connect,"SELECT * FROM product JOIN product_image ON product.product_code=product_image.product_code WHERE product_image.product_code='$cart_product'");
			$prod_row = mysqli_fetch_assoc($prod_res);
	
			$stock_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$cart_product_cap'");
			$stock_row = mysqli_fetch_assoc($stock_res);
	
			if($cart_row['product_color'] == $prod_row['product_color1']){
				$stock = $stock_row['product_stock1'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock1 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
			else if($cart_row['product_color'] == $prod_row['product_color2']){
				$stock = $stock_row['product_stock2'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock2 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
			else if($cart_row['product_color'] == $prod_row['product_color3']){
				$stock = $stock_row['product_stock3'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock3 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
			else if($cart_row['product_color'] == $prod_row['product_color4']){
				$stock = $stock_row['product_stock4'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock4 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
			else if($cart_row['product_color'] == $prod_row['product_color5']){
				$stock = $stock_row['product_stock5'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock5 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
			else if($cart_row['product_color'] == $prod_row['product_color6']){
				$stock = $stock_row['product_stock6'];
				$deduct_stock = $stock - $cart_row['quantity'];
				mysqli_query($connect,"UPDATE product_detail SET product_stock6 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
			}
		}
		$customer = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$cus_email'");
		$customer_row = mysqli_fetch_assoc($customer);
		$customerName = $customer_row['cus_name'];
	
		$subject = "Your invoice from 3L Telecommunication";
		$message = "Dear ".$customerName.",\n\nThank you for shopping at 3L Telecommunication. We hope you enjoy your purchases.\nBelow is the invoice attachment.\n\nhttp://localhost/3l_telecommunication/order-details-receipt.php?details&code=".$pay_code."&email=".$cus_email."\n\nThank you. \n\nRegards,\n3L Telecommunication";
		$headers = "From: 3L Telecommunication" . "\r\n";
	
		mail($cus_email,$subject,$message,$headers);
	?>
	
	<script>
		 swal({
			title: "Payment Successful!",
			icon: "success",
			button: "OK",
			}).then(function(){window.location.href="my-orders.php";});
	</script>
	<?php
	}
	else{
		$diff = date_diff(date_create($birth_date), date_create($date));
		if($diff->format('%y') >= 18){
			mysqli_query($connect,"INSERT INTO payment (payment_code,card_holder,payment_total,cus_email) VALUES ('$uniq','$holder','$total','$cus_email')");
			$cart_result = mysqli_query($connect, "SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
				
			mysqli_query($connect,"UPDATE shipping SET payment_date='$date' WHERE cus_email='$cus_email' ORDER BY shipping_code DESC LIMIT 1");
			
			while($cart_row = mysqli_fetch_assoc($cart_result)){
				$cart_product = $cart_row['product_code'];
				$cart_product_cap = $cart_row['product_detail_code'];
				mysqli_query($connect,"UPDATE cart SET cart_status=0,payment_date='$date' WHERE cart_status=1 AND product_code='$cart_product' AND cus_email='$cus_email'");
				
				$pay_result = mysqli_query($connect,"SELECT * FROM payment WHERE cus_email='$cus_email' AND payment_date='$date'");
				$pay_row = mysqli_fetch_assoc($pay_result);
				$pay_code = $pay_row['payment_code'];
				mysqli_query($connect,"UPDATE cart SET payment_code='$pay_code' WHERE product_code='$cart_product' AND cus_email='$cus_email' AND payment_date='$date'");
				mysqli_query($connect,"UPDATE shipping SET payment_code='$pay_code' WHERE cus_email='$cus_email' AND payment_date='$date'");
				
				$prod_res = mysqli_query($connect,"SELECT * FROM product JOIN product_image ON product.product_code=product_image.product_code WHERE product_image.product_code='$cart_product'");
				$prod_row = mysqli_fetch_assoc($prod_res);
		
				$stock_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$cart_product_cap'");
				$stock_row = mysqli_fetch_assoc($stock_res);
		
				if($cart_row['product_color'] == $prod_row['product_color1']){
					$stock = $stock_row['product_stock1'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock1 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
				else if($cart_row['product_color'] == $prod_row['product_color2']){
					$stock = $stock_row['product_stock2'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock2 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
				else if($cart_row['product_color'] == $prod_row['product_color3']){
					$stock = $stock_row['product_stock3'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock3 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
				else if($cart_row['product_color'] == $prod_row['product_color4']){
					$stock = $stock_row['product_stock4'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock4 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
				else if($cart_row['product_color'] == $prod_row['product_color5']){
					$stock = $stock_row['product_stock5'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock5 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
				else if($cart_row['product_color'] == $prod_row['product_color6']){
					$stock = $stock_row['product_stock6'];
					$deduct_stock = $stock - $cart_row['quantity'];
					mysqli_query($connect,"UPDATE product_detail SET product_stock6 = '$deduct_stock' WHERE product_detail_code='$cart_product_cap'");
				}
			}
			$customer = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email='$cus_email'");
			$customer_row = mysqli_fetch_assoc($customer);
			$customerName = $customer_row['cus_name'];
		
			$subject = "Your invoice from 3L Telecommunication";
			$message = "Dear ".$customerName.",\n\nThank you for shopping at 3L Telecommunication. We hope you enjoy your purchases.\nBelow is the invoice attachment.\n\nhttp://localhost/3l_telecommunication/order-details-receipt.php?details&code=".$pay_code."&email=".$cus_email."\n\nThank you. \n\nRegards,\n3L Telecommunication";
			$headers = "From: 3L Telecommunication" . "\r\n";
		
			mail($cus_email,$subject,$message,$headers);
		?>
		
		<script>
			swal({
				title: "Payment Successful!",
				icon: "success",
				button: "OK",
				}).then(function(){window.location.href="my-orders.php";});
		</script>
		<?php
		}
		else{
	?>
			<script>
			swal({
				title: "Age is under 18, unable to make payment. Thank you.",
				icon: "error",
				button: "OK",
				});
			document.getElementById('card_holder').value = "<?php echo $_POST['card_holder'];?>";
			document.getElementById('card').value = "<?php echo $_POST['card_num'];?>";
			document.getElementById('month').value = "<?php echo $_POST['expiry_month'];?>";
			document.getElementById('year').value = "<?php echo $_POST['expiry_year'];?>";
			document.getElementById('ccv').value = "<?php echo $_POST['ccv'];?>";
			</script>
	<?php
		}
	}
}
?>