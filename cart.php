<?php include("header-login.php"); ?>
		
		<main class="main">
        	<div class="container" style="text-align:center;">
				<br>
				<hr class="mb-2">
				<h1><b>Shopping Cart</b></h1>
				<hr class="mb-2">
				<br>
			</div>

            <div class="page-content">
            	<div class="cart">
	                <div class="container">
	                	<div class="row">
							<?php
							$check_res = mysqli_query($connect,"SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
							$check_count = mysqli_num_rows($check_res);

							if($check_count != 0){
							?>
	                		<div class="col-md-9">
	                			<table class="table table-cart table-mobile">
									<thead>
										<tr style="text-align:center;">
											<th><b>Products</b></th>
											<th><b>Capacity / Size</b></th>
											<th><b>Color</b></th>
											<th><b>Price</b></th>
											<th><b>Quantity</b></th>
											<th style="width:100px;"><b>Subtotal</b></th>
											<th></th>
										</tr>
									</thead>

									<tbody>
										<?php
											$total = 0;
											$result = mysqli_query($connect, "SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
											while($row = mysqli_fetch_assoc($result)){
												$pcode = $row['product_code'];
												$detail_code = $row['product_detail_code'];
												$cap_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail_code'");
												$cap_row = mysqli_fetch_assoc($cap_res);
												$prod_result = mysqli_query($connect, "SELECT * FROM product JOIN product_image ON product.product_code=product_image.product_code WHERE product.product_code='$pcode'");
												$prod_row = mysqli_fetch_assoc($prod_result);
										?>
										<tr style="text-align:center;">
											<td class="product-col" width="250px" style="text-align:left;">
												<div class="product">
													<figure class="product-media">
														<?php
															if($row['product_color'] === $prod_row['product_color1']){
																$checkStock = $cap_row['product_stock1'];
														?>
																<img src="admin/product/<?=$prod_row['product_img1']?>" alt="product">
														<?php
															}
															else if($row['product_color'] === $prod_row['product_color2']){
																$checkStock = $cap_row['product_stock2'];
														?>
																<img src="admin/product/<?=$prod_row['product_img2']?>" alt="product">
														<?php 
															}
															else if($row['product_color'] === $prod_row['product_color3']){
																$checkStock = $cap_row['product_stock3'];
														?>
																<img src="admin/product/<?=$prod_row['product_img3']?>" alt="product">
														<?php
															}
															else if($row['product_color'] === $prod_row['product_color4']){
																$checkStock = $cap_row['product_stock4'];
														?>
																<img src="admin/product/<?=$prod_row['product_img4']?>" alt="product">
														<?php
															}
															else if($row['product_color'] === $prod_row['product_color5']){
																$checkStock = $cap_row['product_stock5'];
														?>
																<img src="admin/product/<?=$prod_row['product_img5']?>" alt="product">
														<?php
															}
															else{
																$checkStock = $cap_row['product_stock6'];
														?>
																<img src="admin/product/<?=$prod_row['product_img6']?>" alt="product">
														<?php
															}
														?>
													</figure>

													<h3 class="product-title">
														<a href="product-details-login.php?view&code=<?php echo $row['product_code']; ?>" class="product-title">
															<?php echo $prod_row['product_name'];?>
														</a>
													</h3><!-- End .product-title -->
												</div><!-- End .product -->
											</td>
											<?php
											if($prod_row['cat_name'] == 'Audio' || $prod_row['cat_name'] == 'Accessories'){
											?>
												<td class="price-col" name="prod_cap">-</td>
											<?php
											}
											else{
											?>
											<td class="price-col" name="prod_cap"><?php echo $cap_row['product_capacity']; ?></td>
											<?php
											}
											?>
											<td class="price-col" name="prod_color"><?php echo $row['product_color']; ?></td>
											<td class="price-col" name="prod_price">RM <?php echo $row['product_price']; ?></td>
											<td class="quantity-col" align="center">
                                                <div class="cart-product-quantity">
                                                    <input type="number" onkeydown="return false" class="form-control" min="1" max="<?php echo $checkStock;?>" value="<?php echo $row['quantity']; ?>" style="text-align:center;" onchange="chgqty(<?php echo $row['cart_code'];?>,<?php echo $row['product_price'];?>,this.value);">
                                                </div><!-- End .cart-product-quantity -->
											</td>
											<td class="total-col" id="subtotal-<?php echo $row['cart_code'];?>">RM <?php echo number_format($row['cart_subtotal'],2);?></td>
											<td class="remove-col"><a href="cart.php?remove&code=<?php echo $row['product_code'];?>&cap=<?php echo $row['product_detail_code'];?>&color=<?php echo $row['product_color'];?>" class="btn-remove" onclick="return confirmation()"><i class="icon-close"></i></a></td>
										</tr>
										<?php
											$total += $row['cart_subtotal'];
										}
										?>
									</tbody>
								</table><!-- End .table table-wishlist -->
	                		</div><!-- End .col-lg-9 -->
							
							
	                		<aside class="col-md-3">
	                			<div class="summary summary-cart">
	                				<h3 class="summary-title">Cart Total</h3><!-- End .summary-title -->

	                				<table class="table table-summary">
	                					<tbody>
	                						<tr class="summary-total">
	                							<td>Total:</td>
	                							<td>RM <?php echo number_format($total,2); ?></td>
	                						</tr><!-- End .summary-total -->
	                					</tbody>
	                				</table><!-- End .table table-summary -->

	                				<a href="checkout.php" class="btn btn-outline-primary-2 btn-order btn-block">PROCEED TO CHECKOUT</a>
	                			</div><!-- End .summary -->

		            			<a href="index-login.php" class="btn btn-outline-dark-2 btn-block mb-3"><span>CONTINUE SHOPPING</span><i class="icon-refresh"></i></a>
	                		</aside><!-- End .col-md-3 -->
							
							<?php
							}
							else{
							?>
								<div style="text-align:center; margin:auto;">
									<h3>Your cart currently is empty.</h3><br>
									<a href="index-login.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;"><i class="fa fa-shopping-cart"></i>Shop</a>
								</div>
							<?php
							}
							?>
	                	</div><!-- End .row -->
	                </div><!-- End .container -->
                </div><!-- End .cart -->
            </div><!-- End .page-content -->
        </main><!-- End .main -->
		
<?php include("footer-login.php"); ?>
<script type="text/javascript">
function chgqty(cart_code,product_price,quantity){
	var code = cart_code;
	var price = product_price;
	var qty = quantity;
	
	$.ajax({
		type:'post',
		url:'cart-subtotal-onchange.php',
		data: {
			cart_code:code,
			product_price:price,
			quantity:qty
		},
		success:function(data){
			document.getElementById('subtotal-'+code).innerHTML="RM "+data;
			console.log(data);
		}
	})
}
</script>
<script>
function confirmation(){
	var option;
	option = confirm("Do you want to remove this product from your cart?");
	return option;
}	
</script>
<?php
if(isset($_GET['remove'])){
	$code = $_GET['code'];
	$color = $_GET['color'];
	$cap = $_GET['cap'];
	
	mysqli_query($connect,"DELETE FROM cart WHERE product_code='$code' AND product_detail_code='$cap' AND product_color='$color' AND cus_email='$cus_email' AND cart_status=1");
?>
<script>
	swal({
		title: 'Done removed.',
		icon: 'success',
		button: 'OK',
		}).then(function(){window.location.href='cart.php';});
</script>
<?php
}
mysqli_close($connect);
?>
