<?php include("header.php"); ?>
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
<script>
document.getElementById("cat").classList.add('active');
</script>
		
		<?php
			if(isset($_GET["view"])){
				$brand = $_GET["brand"];
				$cat = $_GET["cat"];
				
				$result = mysqli_query($connect, "SELECT * FROM product WHERE brand_name='$brand' AND cat_name='$cat'");
				$row = mysqli_fetch_assoc($result);
			}
		?>
		<div class="container" style="text-align:center;">
			<br>
			<hr class="mb-2">
			<h1><b>Shop by <?php echo $row['brand_name']; ?> · <?php echo $row['cat_name']; ?></b></h1>
			<hr class="mb-2">

			<ul class="sorting">
				<li class="sort_child"><h6 style="display: block; text-align: center; padding: 14px 16px; text-decoration: none;">Sort By:</h6></li>
				<li id="child1" class="sort_child"><h6><a class="child_link" id="link1" href="brand-category.php?view&brand=<?php echo $brand;?>&cat=<?php echo $cat;?>">Latest</a></h6></li>
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
					window.location.href = 'brand-category.php?view&brand=<?php echo $brand;?>&cat=<?php echo $cat;?>&sortName&sort_type=<?php echo $new_sort_type;?>';
				});
			});
			$(function() {
				$('#link3').click(function() {
					window.location.href = 'brand-category.php?view&brand=<?php echo $brand;?>&cat=<?php echo $cat;?>&sortPrice&sortPrice_type=<?php echo $new_sortPrice_type;?>';
				});
			});
		</script>
		
		<?php
		if(isset($_GET['sortName'])){
			echo "<script>document.getElementById('link2').style.color='#39f'; 
			document.getElementById('child2').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sort_type'];
			$result1 = mysqli_query($connect, "SELECT * FROM product WHERE brand_name='$brand' AND cat_name='$cat' AND product_status=1 ORDER BY product_name ".$type);
		}
		else if(isset($_GET['sortPrice'])){
			echo "<script>document.getElementById('link3').style.color='#39f'; 
			document.getElementById('child3').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sortPrice_type'];
			$result1 = mysqli_query($connect, "SELECT * FROM product WHERE brand_name='$brand' AND cat_name='$cat' AND product_status=1 ORDER BY product_start_price ".$type);
		}
		else{
			echo "<script>document.getElementById('link1').style.color='#39f'; 
			document.getElementById('child1').style.borderBottom = '1px solid #39f';</script>";
			$result1 = mysqli_query($connect, "SELECT * FROM product WHERE brand_name='$brand' AND cat_name='$cat' AND product_status=1 ORDER BY product_code DESC");
		}
		?>

		<div class="container">
			<br>
			<div class="products">
				<div class="row justify-content-center">
					<?php
						while($row1 = mysqli_fetch_assoc($result1)){
							$code = $row1['product_code'];
							$img = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$code'");
							while($imgrow = mysqli_fetch_assoc($img)){
								$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$code'");
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
								<a href="product-details.php?view&code=<?php echo $row1['product_code']; ?>">
									<img src="admin/product/<?=$imgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
								</a>
							</figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $row1['brand_name']." · ".$row1['cat_name']; ?>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details.php?view&code=<?php echo $row1['product_code']; ?>"><?php echo $row1['product_name']; ?></a></h3><!-- End .product-title -->
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
		
<?php include("footer.php"); ?>