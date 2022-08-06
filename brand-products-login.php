<?php include("header-login.php"); ?>
<style>
	ul.sorting {
	list-style-type: none;
	overflow: hidden;
	border-bottom: 1px solid #e8e8e8;
	}
	li.sort_child {
	float: left;
	}
	a.child_link {
	display: block;
	color: black;
	text-align: center;
	padding: 14px 16px;
	text-decoration: none;
	}
	a.child_link:hover {
	color: #39f;
	}
	li.sort_child:hover {
	color: #39f;
	border-bottom: 1px solid #39f;
	}
	li.sort_child:hover {
	color: #39f;
	border-bottom: 1px solid #39f;
	}
	li.sort_child:first-child:hover {
	border-bottom: 0;
	}
</style>	
		<?php
			if(isset($_GET["view"])){
				$brand_name = $_GET["brand"];
				
				$result = mysqli_query($connect, "SELECT * FROM brand WHERE brand_name='$brand_name'");
				$row = mysqli_fetch_assoc($result);
				
				$product = mysqli_query($connect,"SELECT * FROM product WHERE brand_name='$brand_name' AND product_status=1");
				$brand_count = mysqli_num_rows($product);
			}
		?>

		<div class="container" style="text-align:center;">
			<br>
			<hr class="mb-2">
			<h1><b>Shop by</b></h1>
			<img src="Admin/brand/<?=$row['brand_image']?>" style="height:50px; object-fit:contain; margin:auto;">
            <br><h3>Authorised Reseller</h3>
			<hr class="mb-2">
			
			<ul class="sorting" id="sort_ul">
				<li class="sort_child"><h6 style="display: block; text-align: center; padding: 14px 16px; text-decoration: none;">Sort By:</h6></li>
				<li id="child1" class="sort_child"><h6><a class="child_link" id="link1" href="brand-products-login.php?view&brand=<?php echo $brand_name;?>">Latest</a></h6></li>
				<li id="child2" class="sort_child"><h6><a class="child_link" id="link2" href="#"><i id="sortIcon1"></i> &nbsp;Name</a></h6></li>
				<li id="child3" class="sort_child"><h6><a class="child_link" id="link3" href="#"><i id="sortIcon2"></i> &nbsp;Price</a></h6></li>
			</ul>
			<br>
		</div>
		
		<?php
		$new_sort_type="ASC";
		if(isset($_REQUEST['sort_type'])){
			$sort_type = $_REQUEST['sort_type'];
			if($sort_type == 'ASC'){
				$new_sort_type = 'DESC';
			}

			if($sort_type == 'ASC')
				echo "<script>document.getElementById('sortIcon1').className='fas fa-sort-down';</script>";
			else
				echo "<script>document.getElementById('sortIcon1').className='fas fa-sort-up';</script>";
		}
		$new_sortPrice_type="ASC";
		if(isset($_REQUEST['sortPrice_type'])){
			$sort_type = $_REQUEST['sortPrice_type'];
			if($sort_type == 'ASC'){
				$new_sortPrice_type = 'DESC';
			}

			if($sort_type == 'ASC')
				echo "<script>document.getElementById('sortIcon2').className='fas fa-sort-down';</script>";
			else
				echo "<script>document.getElementById('sortIcon2').className='fas fa-sort-up';</script>";
		}
		?>
		<script>
			$(function() {
				$('#link2').click(function() {
					window.location.href = 'brand-products-login.php?view&brand=<?php echo $brand_name;?>&sortName&sort_type=<?php echo $new_sort_type;?>';
				});
			});
			$(function() {
				$('#link3').click(function() {
					window.location.href = 'brand-products-login.php?view&brand=<?php echo $brand_name;?>&sortPrice&sortPrice_type=<?php echo $new_sortPrice_type;?>';
				});
			});
		</script>
		
		<?php
		if(isset($_GET['sortName'])){
			echo "<script>document.getElementById('link2').style.color='#39f'; 
			document.getElementById('child2').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sort_type'];
			$presult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Phone' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_name ".$type);
			$tresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Tablet' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_name ".$type);
			$wresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Watch' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_name ".$type);
			$aresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Audio' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_name ".$type);
			$sresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Accessories' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_name ".$type);
		}
		else if(isset($_GET['sortPrice'])){
			echo "<script>document.getElementById('link3').style.color='#39f'; 
			document.getElementById('child3').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sortPrice_type'];
			$presult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Phone' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_start_price ".$type);
			$tresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Tablet' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_start_price ".$type);
			$wresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Watch' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_start_price ".$type);
			$aresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Audio' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_start_price ".$type);
			$sresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Accessories' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_start_price ".$type);
		}
		else{
			echo "<script>document.getElementById('link1').style.color='#39f'; 
			document.getElementById('child1').style.borderBottom = '1px solid #39f';</script>";
			$presult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Phone' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_code DESC");
			$tresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Tablet' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_code DESC");
			$wresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Watch' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_code DESC");
			$aresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Audio' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_code DESC");
			$sresult = mysqli_query($connect, "SELECT * FROM product WHERE cat_name = 'Accessories' AND brand_name = '$brand_name' AND product_status = 1 ORDER BY product_code DESC");
		}
		?>

	
	<?php
		if($brand_count != 0){
			$pcount = mysqli_num_rows($presult);
			if($pcount != 0){
	?>
		<div class="container">
			<br>
			<h3><b>Phones</b></h3>
			<div class="products">
				<div class="row justify-content-center">
					<?php
						while($prow = mysqli_fetch_assoc($presult)){
							$pcode = $prow['product_code'];
							$pimg = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
							while($pimgrow = mysqli_fetch_assoc($pimg)){
								$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
								$price = array();
								while($detail_row = mysqli_fetch_assoc($detail_result)){
									$price[] = $detail_row['product_price'];
								}
								$max = $price[0];
								$min = $price[0];
								foreach($price as $key => $val){
									if($max < $val){
										$max = $val;
									}
								}
								foreach($price as $key => $val){
									if($min > $val){
										$min = $val;
									}
								}
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details-login.php?view&code=<?php echo $prow['product_code']; ?>">
									<img src="admin/product/<?=$pimgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
								</a>
							</figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $prow['brand_name']." · ".$prow['cat_name']; ?>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $prow['product_code']; ?>"><?php echo $prow['product_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price" style="font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $min." - RM ".$max;
										}
										else{
											echo $min;
										}
									?>
									</b>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
							}
						}
					?>
				</div><!-- End .row -->
            </div><!-- End .products -->
		</div>
		<?php
			}
			else{}
		?>
		
		<?php
			$tcount = mysqli_num_rows($tresult);
			if($tcount != 0){
		?>
		<div class="container">
			<br>
			<h3><b>Tablets</b></h3>
			<div class="products">
				<div class="row justify-content-center">
					<?php
						while($trow = mysqli_fetch_assoc($tresult)){
							$pcode = $trow['product_code'];
							$timg = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
							while($timgrow = mysqli_fetch_assoc($timg)){
								$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
								$price = array();
								while($detail_row = mysqli_fetch_assoc($detail_result)){
									$price[] = $detail_row['product_price'];
								}
								$max = $price[0];
								$min = $price[0];
								foreach($price as $key => $val){
									if($max < $val){
										$max = $val;
									}
								}
								foreach($price as $key => $val){
									if($min > $val){
										$min = $val;
									}
								}
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details-login.php?view&code=<?php echo $trow['product_code']; ?>">
									<img src="admin/product/<?=$timgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $trow['brand_name']." · ".$trow['cat_name']; ?>
								</div><!-- End .product-cat -->
								<h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $trow['product_code']; ?>"><?php echo $trow['product_name']; ?></a></h3><!-- End .product-title -->
								<div class="product-price" style="font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $min." - RM ".$max;
										}
										else{
											echo $min;
										}
									?>
									</b>
								</div><!-- End .product-price -->
							</div><!-- End .product-body -->
						</div><!-- End .product -->
					</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
							}
						}
					?>
				</div><!-- End .row -->
			</div><!-- End .products -->
		</div>
		<?php
			}
			else{}
		?>
		
		<?php
			$wcount = mysqli_num_rows($wresult);
			if($wcount != 0){
		?>
		<div class="container">
			<br>
			<h3><b>Watches</b></h3>
			<div class="products">
				<div class="row justify-content-center">
					<?php
						while($wrow = mysqli_fetch_assoc($wresult)){
							$pcode = $wrow['product_code'];
							$wimg = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
							while($wimgrow = mysqli_fetch_assoc($wimg)){
								$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
								$price = array();
								while($detail_row = mysqli_fetch_assoc($detail_result)){
									$price[] = $detail_row['product_price'];
								}
								$max = $price[0];
								$min = $price[0];
								foreach($price as $key => $val){
									if($max < $val){
										$max = $val;
									}
								}
								foreach($price as $key => $val){
									if($min > $val){
										$min = $val;
									}
								}
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details-login.php?view&code=<?php echo $wrow['product_code']; ?>">
									<img src="admin/product/<?=$wimgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
									<?php echo $wrow['brand_name']." · ".$wrow['cat_name']; ?>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $wrow['product_code']; ?>"><?php echo $wrow['product_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price" style="font-weight:bold; font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $min." - RM ".$max;
										}
										else{
											echo $min;
										}
									?>
									</b>
								</div><!-- End .product-price -->
							</div><!-- End .product-body -->
						</div><!-- End .product -->
					</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
							}
						}
					?>
				</div><!-- End .row -->
			</div><!-- End .products -->
		</div>
		<?php
			}
			else{}
		?>
		
		<?php
			$acount = mysqli_num_rows($aresult);
			if($acount != 0){
		?>
		<div class="container">
			<br>
			<h3><b>Audio's</b></h3>
			<div class="products">
				<div class="row justify-content-center">
					<?php
						while($arow = mysqli_fetch_assoc($aresult)){
							$pcode = $arow['product_code'];
							$aimg = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
							while($aimgrow = mysqli_fetch_assoc($aimg)){
								$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
								$price = array();
								while($detail_row = mysqli_fetch_assoc($detail_result)){
									$price[] = $detail_row['product_price'];
								}
								$max = $price[0];
								$min = $price[0];
								foreach($price as $key => $val){
									if($max < $val){
										$max = $val;
									}
								}
								foreach($price as $key => $val){
									if($min > $val){
										$min = $val;
									}
								}
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details-login.php?view&code=<?php echo $arow['product_code']; ?>">
									<img src="admin/product/<?=$aimgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $arow['brand_name']." · ".$arow['cat_name']; ?>
								</div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $arow['product_code']; ?>"><?php echo $arow['product_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price" style="font-weight:bold; font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $min." - RM ".$max;
										}
										else{
											echo $min;
										}
									?>
									</b>
								</div><!-- End .product-price -->
							</div><!-- End .product-body -->
						</div><!-- End .product -->
					</div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
							}
						}
					?>
				</div><!-- End .row -->
			</div><!-- End .products -->
		</div>
		<?php
			}
			else{}
		?>
		
		<?php
			$scount = mysqli_num_rows($sresult);
			if($scount != 0){
		?>
		<div class="container">
			<br>
			<h3><b>Accessories</b></h3>
			<div class="products">
				<div class="row justify-content-center">
					<?php
							while($srow = mysqli_fetch_assoc($sresult)){
								$pcode = $srow['product_code'];
								$simg = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
								while($simgrow = mysqli_fetch_assoc($simg)){
									$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
									$price = array();
									while($detail_row = mysqli_fetch_assoc($detail_result)){
										$price[] = $detail_row['product_price'];
									}
									$max = $price[0];
									$min = $price[0];
									foreach($price as $key => $val){
										if($max < $val){
											$max = $val;
										}
									}
									foreach($price as $key => $val){
										if($min > $val){
											$min = $val;
										}
									}
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details-login.php?view&code=<?php echo $srow['product_code']; ?>">
									<img src="admin/product/<?=$simgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                </a>
                            </figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $srow['brand_name']." · ".$srow['cat_name']; ?>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $srow['product_code']; ?>"><?php echo $srow['product_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price" style="font-weight:bold; font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $min." - RM ".$max;
										}
										else{
											echo $min;
										}
									?>
									</b>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
							}
						}
					?>
				</div><!-- End .row -->
            </div><!-- End .products -->
		</div>
		<?php
			}
			else{}
		}
		else{
			echo "<script>document.getElementById('sort_ul').style.display='none';</script>";
		?>
			<h3 style="text-align:center;">Coming Soon!</h3>
				<div style="text-align:center; margin:auto;">
					<a href="index-login.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;">Back to home</a>
				</div>
				<br>
		<?php
		}
		?>
<?php include("footer-login.php"); ?>