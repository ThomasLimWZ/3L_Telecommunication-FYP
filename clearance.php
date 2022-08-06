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
		<div class="container" style="text-align:center;">
			<br>
			<hr class="mb-2">
			<h1><b>Clearance Products</b></h1>
            <h5>Get your dream product at a lower price.</h5>
			<hr class="mb-2">
            
			<ul class="sorting" id="sort_ul">
				<li class="sort_child"><h6 style="display: block; text-align: center; padding: 14px 16px; text-decoration: none;">Sort By:</h6></li>
				<li id="child1" class="sort_child"><h6><a class="child_link" id="link1" href="clearance.php">Latest</a></h6></li>
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
					window.location.href = 'clearance.php?sortName&sort_type=<?php echo $new_sort_type;?>';
				});
			});
			$(function() {
				$('#link3').click(function() {
					window.location.href = 'clearance.php?sortPrice&sortPrice_type=<?php echo $new_sortPrice_type;?>';
				});
			});
		</script>

        <?php
		if(isset($_GET['sortName'])){
			echo "<script>document.getElementById('link2').style.color='#39f'; 
			document.getElementById('child2').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sort_type'];
			$result = mysqli_query($connect, "SELECT * FROM clearance JOIN product ON clearance.clearance_product_code=product.product_code WHERE clearance_product_status = 1 ORDER BY product.product_name ".$type);
		}
		else if(isset($_GET['sortPrice'])){
			echo "<script>document.getElementById('link3').style.color='#39f'; 
			document.getElementById('child3').style.borderBottom = '1px solid #39f';</script>";
			$type = $_GET['sortPrice_type'];
			$result = mysqli_query($connect, "SELECT * FROM clearance JOIN product ON clearance.clearance_product_code=product.product_code WHERE clearance_product_status = 1 ORDER BY clearance.clearance_product_start_price ".$type);
		}
		else{
			echo "<script>document.getElementById('link1').style.color='#39f'; 
			document.getElementById('child1').style.borderBottom = '1px solid #39f';</script>";
			$result = mysqli_query($connect, "SELECT * FROM clearance JOIN product ON clearance.clearance_product_code=product.product_code WHERE clearance_product_status = 1 ORDER BY clearance.clearance_product_code DESC");
		}
		?>

		<?php
			$count = mysqli_num_rows($result);
            $i = 0;
			if($count != 0){
		?>
		<div class="container">
			<div class="products">
				<div class="row justify-content-center">
					<?php
                    while($row = mysqli_fetch_assoc($result)){
                        $code = $row['clearance_product_code'];
                        $img = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$code'");
                        while($imgrow = mysqli_fetch_assoc($img)){
                            $detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$code'");
                            $price = array();
                            $sum_stock = array();
                            while($detail_row = mysqli_fetch_assoc($detail_result)){
                                $price[] = $detail_row['product_price'];
                                $sum_stock[] = $detail_row['product_stock1']+$detail_row['product_stock2']+$detail_row['product_stock3']+$detail_row['product_stock4']+$detail_row['product_stock5']+$detail_row['product_stock6'];
                            }
                            $max = $price[0];
                            foreach($price as $key => $val){
                                if($max < $val){
                                    $max = $val;
                                }
                            }
                            $total_stock = array_sum($sum_stock);
                            if($total_stock != 0){
					?>
					<div class="col-6 col-md-4 col-lg-3">
						<div class="product product-2">
							<figure class="product-media">
								<a href="product-details.php?view&code=<?php echo $row['product_code']; ?>">
									<img src="admin/product/<?=$imgrow['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
								</a>
							</figure><!-- End .product-media -->

                            <div class="product-body">
								<div class="product-cat">
									<?php echo $row['brand_name']." · ".$row['cat_name']; ?>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product-details.php?view&code=<?php echo $row['product_code']; ?>"><?php echo $row['product_name']; ?></a></h3><!-- End .product-title -->
                                <div class="product-price" style="font-size:13pt;">
									<b><br>RM  
									<?php 
										if(count($price) > 1){
											echo $price[0]." - RM ".$max;
										}
										else{
											echo $price[0];
										}
									?>
									</b>
                                </div><!-- End .product-price -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
					<?php
                            }
                            else{
                                mysqli_query($connect,"UPDATE clearance SET clearance_product_status=0 WHERE clearance_product_code='$code' AND clearance_product_status=1");
                                $i++;
                            }
                        }
                    }
					?>
				</div><!-- End .row -->
            </div><!-- End .products -->
		</div>
		<?php
			}
			else{
				echo "<script>document.getElementById('sort_ul').style.display='none';</script>";
        ?>
                <h3 style="text-align:center;">Coming Soon!</h3>
				<div style="text-align:center; margin:auto;">
					<a href="index.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;">Back to home</a>
				</div>
				<br>
        <?php
            }

            if($i != 0){
        ?>
                <h3 style="text-align:center;">Coming Soon!</h3>
				
				<div style="text-align:center; margin:auto;">
					<a href="index.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;">Back to home</a>
				</div>
				<br>
        <?php
            }
            else{}
		?>
		
<?php include("footer.php"); ?>