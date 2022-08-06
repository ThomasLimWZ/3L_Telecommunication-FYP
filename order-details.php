<?php include("header-login.php"); ?>
		
		<?php
			if(isset($_GET["details"])){
				$pay_code = $_GET["code"];

				$result = mysqli_query($connect, "SELECT * FROM cart WHERE payment_code='$pay_code'");
				$row = mysqli_fetch_assoc($result);
				
				$ship_res = mysqli_query($connect,"SELECT * FROM shipping WHERE payment_code='$pay_code'");
				$ship_row = mysqli_fetch_assoc($ship_res);
				
				$pay_res = mysqli_query($connect,"SELECT * FROM payment WHERE payment_code='$pay_code'");
				$pay_row = mysqli_fetch_assoc($pay_res);
			}
		?>
		
		<div class="container">
			<br>
			<hr class="mb-2">
			<h1 style="text-align:center;"><b>Order Details</b></h1>
			<hr class="mb-2">
			<br>
			
			<label>Purchase Date Time:</label>
			<h6><?php
				$date = date_create($row['payment_date']);
				echo date_format($date,"d-m-Y H:i:s");
			?></h6>
			<label>Sold to:</label>
			<h6><?php echo $ship_row['receiver_name'];?></h6>
			<h6><?php echo $ship_row['contact_phone']; ?></h6>
			<h6><?php echo $ship_row['address'];?>, <?php echo $ship_row['city'];?>, <?php echo $ship_row['state'];?>, <?php echo $ship_row['post_code'];?>, Malaysia.</h6>
			
			<?php
			if(!empty($ship_row['tracking_number'])){
			?>
				<p>Tracking Number: <b><?php echo $ship_row['tracking_number'];?></b></p>
			<?php
			}
			else{}
			?>
			
			
			<br>
			<table style="margin:auto; border-collapse:separate; border:solid black 1px; border-radius:6px; font-size:12pt;">
				<tr style="background-color:#f2f2f2;">
					<th width="100px" style="text-align:center; padding:5px; border-top: none; border-left: none;">No.</th>
					<th width="40%" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Product</th>
					<th width="200px" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Capacity</th>
					<th width="200px" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Color</th>
					<th width="120px" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Quantity</th>
					<th width="150px" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Unit Price</th>
					<th width="150px" style="text-align:center; padding:5px; border-left:solid black 1px; border-top: none;">Subtotal</th>
				</tr>
				<?php
					$i = 1;
					$prod_res = mysqli_query($connect,"SELECT * FROM cart JOIN product ON cart.product_code=product.product_code WHERE payment_code='$pay_code'");
					while($prod_row = mysqli_fetch_assoc($prod_res)){
						$detail = $prod_row['product_detail_code'];
						$pcode = $prod_row['product_code'];
						$detail_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail'");
						$detail_row = mysqli_fetch_assoc($detail_res);
						$img_res = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code='$pcode'");
						$img_row = mysqli_fetch_assoc($img_res);
				?>
				<tr>
					<td style="text-align:center; padding:5px; border-top:solid black 1px; border-left: none;"><?php echo $i; ?></td>
					<td style="padding:5px; border-left:solid black 1px; border-top:solid black 1px; text-align:left; display:flex; align-items:center;">
						<?php
						if($prod_row['product_color'] == $img_row['product_color1']){
						?>
							<img src="admin/product/<?=$img_row['product_img1']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						else if($prod_row['product_color'] == $img_row['product_color2']){
						?>
							<img src="admin/product/<?=$img_row['product_img2']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						else if($prod_row['product_color'] == $img_row['product_color3']){
						?>
							<img src="admin/product/<?=$img_row['product_img3']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						else if($prod_row['product_color'] == $img_row['product_color4']){
						?>
							<img src="admin/product/<?=$img_row['product_img4']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						else if($prod_row['product_color'] == $img_row['product_color5']){
						?>
							<img src="admin/product/<?=$img_row['product_img5']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						else{
						?>
							<img src="admin/product/<?=$img_row['product_img6']?>" width="100px" alt="product" style="float:left;">
						<?php
						}
						?>
						<div style="padding-left: 20px;"><?php echo $prod_row['product_name']; ?></div>
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
						<tr>
							<td style="border-top:solid black 1px;"></td>
							<td style="border-top:solid black 1px;"></td>
							<td style="border-top:solid black 1px;"></td>
							<td style="border-top:solid black 1px;"></td>
							<td style="border-top:solid black 1px;"></td>
							<td style="border-top:solid black 1px;"></td>
							<td style="font-weight:bold; padding:5px; border-left:none; border-top:solid black 1px;">RM <?php echo $pay_row['payment_total']; ?></td>
						</tr>
			</table>
			<br><br>
			<a href="order-details-receipt.php?details&code=<?php echo $pay_row['payment_code'];?>&email=<?php echo $cus_email;?>" class="btn btn-primary" target="_blank"><i class="fas fa-file-pdf fa-lg"></i>Print PDF</a>&ensp;
			<a href="my-orders.php" class="btn btn-primary" >Back</a>
			<br><br>
		</div>
		
<?php include("footer-login.php"); ?>