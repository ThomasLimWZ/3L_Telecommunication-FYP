<?php include("header-login.php"); ?>	
		<?php
			if(isset($_GET["view"])){
				$prod1 = $_GET['code1'];
				$prod2 = $_GET['code2'];

				$result1 = mysqli_query($connect, "SELECT * FROM product JOIN product_specification ON product.product_code=product_specification.product_code
				JOIN product_image ON product_specification.product_code=product_image.product_code WHERE product.product_code='$prod1'");
				$row1 = mysqli_fetch_assoc($result1);
				$cat1 = $row1['cat_name'];

				$result2 = mysqli_query($connect, "SELECT * FROM product JOIN product_specification ON product.product_code=product_specification.product_code
				JOIN product_image ON product_specification.product_code=product_image.product_code WHERE product.product_code='$prod2'");
				$row2 = mysqli_fetch_assoc($result2);
				$cat2 = $row2['cat_name'];
			}
		?>
		<div class="container">
			<br>
			<hr class="mb-2">
			<h1 style="text-align:center;"><b>Compare</b></h1>
			<hr class="mb-2">
			<br>

			<form method="GET">
			<table style="margin:auto; width:100%;">
				<tr style="text-align:center;">
					<td style="width:20%; border: none;"></td>
					<td style="width:40%; border: none;">
						<select class="form-control" id="compare_prod1" name="compare_prod1" style="width:65%; display: block;margin: 0 auto;" onchange="changeProd()" required>
							<option value="<?php echo $row1['product_code'];?>"><?php echo $row1['product_name'];?></option>
							<?php
							$prod_res1 = mysqli_query($connect,"SELECT * FROM product WHERE cat_name='$cat1' EXCEPT SELECT * FROM product WHERE product_code='$prod1' OR product_code='$prod2' ORDER BY brand_name ASC");
							while($prod_row1 = mysqli_fetch_assoc($prod_res1)){
							?>
								<option value="<?php echo $prod_row1['product_code'];?>"><?php echo $prod_row1['product_name'];?></option>
							<?php
							}
							?>
						</select>
					</td>
					<td style="width:40%; border: none;">
						<select class="form-control" id="compare_prod2" name="compare_prod2" style="width:65%; display: block;margin: 0 auto;" onchange="changeProd()" required>
							<option value="<?php echo $row2['product_code'];?>"><?php echo $row2['product_name'];?></option>
							<?php
							$prod_res2 = mysqli_query($connect,"SELECT * FROM product WHERE cat_name='$cat2' EXCEPT SELECT * FROM product WHERE product_code='$prod2' OR product_code='$prod1' ORDER BY brand_name ASC");
							while($prod_row2 = mysqli_fetch_assoc($prod_res2)){
							?>
								<option value="<?php echo $prod_row2['product_code'];?>"><?php echo $prod_row2['product_name'];?></option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
			</table>
			</form>
			<script>
				function changeProd(){
					var prod1 = document.getElementById("compare_prod1");
					var prod1_selected = prod1.options[prod1.selectedIndex].value;
					
					var prod2 = document.getElementById("compare_prod2");
					var prod2_selected = prod2.options[prod2.selectedIndex].value;
					$.ajax({
						type:'post',
						url:'compare-prod-onchange-login.php',
						data: {
							prod1_selected,prod2_selected
						},
						success:function(data){
							window.location = data;
							console.log(data);
						}
					})
				}
			</script>

			<style>
			td, th{padding:2%; border-left:solid black 1px; border-top:solid black 1px;}
			th{background-color:#f2f2f2; border-left: none;}
			</style>
			<table style="margin:auto; border-collapse:separate; border:solid black 1px; border-radius:6px;">
				<tr style="text-align:center;">
					<th width="20%" style="border-top: none;">Product Name</th>
					<td width="40%" style="border-top: none;"><?php echo $row1['product_name'];?></td>
					<td width="40%" style="border-top: none;"><?php echo $row2['product_name'];?></td>
				</tr>

				<?php
				if($row1['cat_name'] == 'Phone' || $row1['cat_name'] == 'Tablet' || $row1['cat_name'] == 'Watch'){
				?>
				<tr style="text-align:center;">
					<th>Capacity & Price</th>
					<td>
						<div style="display: inline-block; text-align: left;">
						<?php
							$prod1_cap = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$prod1'");
							while($cap1_row = mysqli_fetch_assoc($prod1_cap)){
								echo $cap1_row['product_capacity']." (RM ".$cap1_row['product_price'].")<br>";
							}
						?>
						</div>
					</td>
					<td>
						<div style="display: inline-block; text-align: left;">
						<?php
							$prod2_cap = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$prod2'");
							while($cap2_row = mysqli_fetch_assoc($prod2_cap)){
								echo $cap2_row['product_capacity']." (RM ".$cap2_row['product_price'].")<br>";
							}
						?>
						</div>
					</td>
				</tr>
				<?php
				}
				else{
				?>
				<tr style="text-align:center;">
					<th>Price</th>
					<td>
						<div style="display: inline-block; text-align: left;">
						<?php
							$prod1_cap = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$prod1'");
							$cap1_row = mysqli_fetch_assoc($prod1_cap);
							
							echo "RM ".$cap1_row['product_price'];
						?>
						</div>
					</td>
					<td>
						<div style="display: inline-block; text-align: left;">
						<?php
							$prod2_cap = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$prod2'");
							$cap2_row = mysqli_fetch_assoc($prod2_cap);
							
							echo "RM ".$cap2_row['product_price'];
						?>
						</div>
					</td>
				</tr>
				<?php
				}
				?>

				<tr style="text-align:center;">
					<th>Product Image</th>
					<td style="padding-top:0; ">
						<img src="admin/product/<?=$row1['product_img1']?>" style="height:400px; margin:auto; object-fit:contain"> 
						<?php 
							echo $row1['product_color1'];
							if(!empty($row1['product_color2']))
								echo ", ".$row1['product_color2'];
							if(!empty($row1['product_color3']))
								echo ", ".$row1['product_color3'];
							if(!empty($row1['product_color4']))
								echo ", ".$row1['product_color4'];
							if(!empty($row1['product_color5']))
								echo ", ".$row1['product_color5'];
							if(!empty($row1['product_color6']))
								echo ", ".$row1['product_color6'];
						?>
					</td>
					<td style="padding-top:0;">
						<img src="admin/product/<?=$row2['product_img1']?>" style="height:400px; margin:auto; object-fit:contain">
						<?php 
							echo $row2['product_color1'];
							if(!empty($row2['product_color2']))
								echo ", ".$row2['product_color2'];
							if(!empty($row2['product_color3']))
								echo ", ".$row2['product_color3'];
							if(!empty($row2['product_color4']))
								echo ", ".$row2['product_color4'];
							if(!empty($row2['product_color5']))
								echo ", ".$row2['product_color5'];
							if(!empty($row1['product_color6']))
								echo ", ".$row1['product_color6'];
						?>
					</td>
				</tr>
				<?php
				if(!empty($row1['product_display']) && !empty($row2['product_display'])){
				?>
				<tr style="text-align:center;">
					<th>Display</th>
					<td>
						<div style="display: inline-block; text-align: left;"><?php echo $row1['product_display'];?></div>
					</td>
					<td>
						<div style="display: inline-block; text-align: left;"><?php echo $row2['product_display'];?></div>
					</td>
				</tr>
				<?php
				}

				if(!empty($row1['product_chip']) && !empty($row2['product_chip'])){
				?>
				<tr style="text-align:center;">
					<th>Chip</th>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row1['product_chip'];?></td></div>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_chip'];?></td></div>
				</tr>
				<?php
				}

				if(!empty($row1['product_back_cam']) && !empty($row2['product_back_cam'])){
				?>
				<tr style="text-align:center;">
					<th>Back Camera</th>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_back_cam'];?></td></div>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_back_cam'];?></td></div>
				</tr>
				<?php
				}

				if(!empty($row1['product_front_cam']) && !empty($row2['product_front_cam'])){
				?>
					<tr style="text-align:center;">
						<th>Front Camera</th>
						<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_front_cam'];?></td></div>
						<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_front_cam'];?></td></div>
					</tr>
				<?php
				}
				
				if(!empty($row1['product_battery']) && !empty($row2['product_battery'])){
					?>
					<tr style="text-align:center;">
						<th>Battery</th>
						<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_battery'];?></td></div>
						<td><div style="display: inline-block; text-align: left;"><?php echo $row2['product_battery'];?></td></div>
					</tr>
				<?php
				}

				if(!empty($row1['others']) && !empty($row2['others'])){
				?>
				<tr style="text-align:center;">
					<th>Others</th>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row2['others'];?></td></div>
					<td><div style="display: inline-block; text-align: left;"><?php echo $row2['others'];?></td></div>
				</tr>
				<?php
				}
				?>
			</table>
			<br>
		</div>
<?php include("footer-login.php"); ?>