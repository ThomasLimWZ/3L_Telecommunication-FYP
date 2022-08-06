<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<?php
	include("admin/connection.php");
	session_start();
	if(!isset($_SESSION['email'])){
?>
<script>
	alert("Please log in");
</script>
<?php
		header("refresh:0.5; url = index.php");
		exit();
	}
	else{
		$cus_email = $_SESSION['email'];
		$result = mysqli_query($connect,"SELECT * FROM customer WHERE cus_email = '$cus_email'");
		$row = mysqli_fetch_assoc($result);
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>3L Telecommunication</title>
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/plugins/owl-carousel/owl.carousel.css">
    <!-- Main CSS File -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/skins/skin-demo-4.css">
    <link rel="stylesheet" href="assets/css/demos/demo-4.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link href="admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head> 
<?php error_reporting(0); ?>
<body>
    <div class="page-wrapper">
        <header class="header header-intro-clearance header-4">
            <div class="header-top" style="padding:10px;">
                <div class="container">
                    <div class="header-right">
                        <ul class="top-menu">
                            <a href="#" data-toggle="dropdown" style="font-size:15pt;"><img src="assets/images/demos/profile.png" width="35px" height="35px">&nbsp;<?php echo $row['cus_name'];?></a>
							<div class="dropdown-menu" style="width:10%; font-size:10pt;">
								<a class="dropdown-item" href="my-account.php" style="padding:5px;">My Account</a>
								<a class="dropdown-item" href="my-orders.php" style="padding:5px;">My Orders</a>
								<a class="dropdown-item" href="<?php $checkLink = $_SERVER['REQUEST_URI'];
																	$search = preg_quote("&", "&");$pattern = "/$search/";
																	if(preg_match($pattern, $checkLink)){
																		echo $_SERVER['REQUEST_URI']."&logout";
																	}
																	else{echo $_SERVER['REQUEST_URI']."?logout";}?>" onclick="return logoutConfirm();" style="padding:5px; color:red;">Log Out</a>
							</div><!-- End .dropdown-menu -->
						</ul><!-- End .top-menu -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-top -->
			<script>
			function logoutConfirm(){
				var option;
				option = confirm("Are you sure to log out?");
				return option;
			}	
			</script>
			<?php
			if(isset($_GET['logout'])){
				unset($_SESSION["cus_email"]);
				session_destroy();
				echo "<script> swal({
					title: 'Log out successful.',
					icon: 'success',
					button: 'OK',
					}).then(function(){window.location.href='index.php';});</script>";
			}
			?>
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <a href="index-login.php" class="logo">
                            <img src="assets/images/demos/logo.png" alt="3L Logo" width="124px" height="100px">
                        </a>
                    </div><!-- End .header-left -->

					<style>
						.autocomplete-items {
						position: absolute;
						border: 1px solid #d4d4d4;
						border-bottom: none;
						border-top: none;
						z-index: 99;
						top: 100%;
						left: 0;
						right: 0;
						}
						.autocomplete-items div {
						padding: 10px;
						cursor: pointer;
						background-color: #fff; 
						border-bottom: 1px solid #d4d4d4; 
						}
						.autocomplete-items div:hover {
						background-color: #e9e9e9; 
						}
						#findProd{
							background-color: transparent; 
						}
						#findProd:hover{
							cursor:pointer;
						}
					</style>

                    <div class="header-center">
						<div class="header-search header-search-extended header-search-visible d-none d-lg-block">
							<a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
							<form method="get" autocomplete="off">
								<div class="autocomplete" style="position:relative; display: inline-block;">
									<div class="header-search-wrapper search-wrapper-wide">
										<label for="searchProd" class="sr-only">Search</label>
										<button class="btn btn-primary" name="searchbtn" type="submit"><i class="icon-search"></i></button>
										<input type="search" class="form-control" name="searchProd" id="searchProd" placeholder="Search product . . ." required>
									</div><!-- End .header-search-wrapper -->
								</div>
							</form>
							<?php
							if(isset($_GET['searchbtn'])){
								$search_product = $_GET['searchProd'];
							?>	
								<script>
									window.location = "search-products-login.php?search&searchResult=<?php echo $search_product;?>";
								</script>
							<?php
							}
							?>
							<script>
								var searchThings = document.getElementById("searchProd");
								var result;
								$(document).ready(function(){
									$("#searchProd").keyup(function(){
										$.ajax({
										type: "POST",
										url: "find-product-database.php",
										data:'keyword='+$(this).val(),
										success: function(data){
											function autocomplete(inp, arr, n) {
												var currentFocus;
												inp.addEventListener("input", function(e) {
													var a, b, i, val = this.value;
													closeAllLists();
													if (!val) { return false;}
													currentFocus = -1;
													a = document.createElement("DIV");
													a.setAttribute("id", this.id + "autocomplete-list");
													a.setAttribute("class", "autocomplete-items");
													this.parentNode.appendChild(a);
													var filter = val.toUpperCase();
													for (i = 0; i < n; i++) {
														if (arr[i].toUpperCase().indexOf(filter) > -1) {
															b = document.createElement("DIV");
															b.innerHTML += "<input class='form-control' id='findProd' type='text' value='" + arr[i] + "'>";
															b.addEventListener("click", function(e) {
																inp.value = this.getElementsByTagName("input")[0].value;
																var prodName = inp.value;
																$.ajax({
																	type:'post',
																	url:'return-product-code.php',
																	data: {
																		prodName
																	},
																	success:function(data){
																		window.location = 'product-details-login.php?view&code='+data;
																	}
																})
																closeAllLists();
															});
															a.appendChild(b);
														}
													}
												});
												function closeAllLists(elmnt) {
													var x = document.getElementsByClassName("autocomplete-items");
													for (var i = 0; i < x.length; i++) {
													if (elmnt != x[i] && elmnt != inp) {
														x[i].parentNode.removeChild(x[i]);
													}
													}
												}
												document.addEventListener("click", function (e) {
													closeAllLists(e.target);
												});
											}
												
											result = $.parseJSON(data);
											console.log(result);
											var n =  Object.keys(result).length;
											autocomplete(searchThings, result, n);
											}
										});
									});
								});
							</script>
						</div><!-- End .header-search -->
                    </div>

                    <div class="header-right">
					<div class="dropdown compare-dropdown">
							<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Track Shipping Status" aria-label="Track Shipping">
								<div class="icon">
									<i class="icon-truck"></i>
								</div>
								<p>Shipping</p>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
							<form action="" method="GET" autocomplete="off">
								<label>Type Tracking Number</label>
								<input type="text" id="trackShipping" name="trackShipping" class="form-control" placeholder="e.g. T12345678MY" required>
								<div class="compare-actions">
									<a href="#" class="action-link" onclick="clearTracknum()">Clear</a>
									<button type="submit" id="trackbtn" name="trackbtn" class="btn btn-outline-primary-2"><span>Track</span><i class="icon-long-arrow-right"></i></button>
								</div>
								<script>
									function clearTracknum(){
										document.getElementById('trackShipping').value='';
									}
								</script>
							</form>
							<?php
							if(isset($_GET['trackbtn'])){
								$track = $_GET['trackShipping'];

								$track_res = mysqli_query($connect,"SELECT * FROM shipping WHERE tracking_number='$track'");
								$track_count = mysqli_num_rows($track_res);

								if($track_count == 0){
							?>
									<script>
										swal({
										title: "This tracking number doesn't existing.",
										icon: "error",
										button: "OK",
										}).then(function(){window.location.href="<?php echo $_SERVER['HTTP_REFERER'];?>";});
									</script>
							<?php
								}
								else{
							?>
									<script>
										window.location = 'track-shipping-login.php?view&trackNum=<?php echo $track;?>';
									</script>
							<?php
								}
							}
							?>
							</div><!-- End .dropdown-menu -->
						</div><!-- End .shipping-dropdown -->

                        <div class="dropdown compare-dropdown">
							<a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Compare Products" aria-label="Compare Products">
								<div class="icon">
									<i class="icon-random"></i>
								</div>
								<p>Compare</p>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
							<form action="" method="GET" autocomplete="off">
								<ul class="compare-products">
									<li class="compare-product">
										<select class="form-control" id="compare_cat1" name="compare_cat1" onchange="compareCat()" required>
											<option selected disabled value="">Choose a Product</option>
											<?php
											$prod_res = mysqli_query($connect,"SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status=1 AND brand.brand_status=1 ORDER BY product.brand_name, product.cat_name ASC");
											while($prod_row = mysqli_fetch_assoc($prod_res)){
											?>
												<option value="<?php echo $prod_row['product_code'];?>"><?php echo $prod_row['product_name'];?></option>
											<?php
											}
											?>
										</select>
									</li>
									<li class="compare-product">
										<select class="form-control" id="compare_cat2" name="compare_cat2" onchange="compareCat()" required>
											<option selected disabled value="">Choose a Product</option>
											<?php
											$prod_res = mysqli_query($connect,"SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status=1 AND brand.brand_status=1 ORDER BY product.brand_name, product.cat_name ASC");
											while($prod_row = mysqli_fetch_assoc($prod_res)){
											?>
												<option value="<?php echo $prod_row['product_code'];?>"><?php echo $prod_row['product_name'];?></option>
											<?php
											}
											?>
										</select>
										<span id="error_msg" style="color:red"></span>
									</li>
								</ul>
								<div class="compare-actions">
									<a href="#" class="action-link" onclick="clearSelection()">Clear All</a>
									<button type="submit" id="comparebtn" name="comparebtn" class="btn btn-outline-primary-2"><span>Compare</span><i class="icon-long-arrow-right"></i></button>
								</div>
								<script>
									function compareCat(){
										var prod1 = document.getElementById("compare_cat1");
										var prod1_selected = prod1.options[prod1.selectedIndex].value;
										var prod2 = document.getElementById("compare_cat2");
										var prod2_selected = prod2.options[prod2.selectedIndex].value;

										if(prod1_selected == prod2_selected){
											document.getElementById('comparebtn').disabled=true;
											document.getElementById("error_msg").innerHTML = "Cannot compare same product.";
											document.getElementById("compare_cat1").style.border = "1px solid red";
											document.getElementById("compare_cat2").style.border = "1px solid red";
										}
										else{
											$.ajax({
												type:'post',
												url:'checkCompare.php',
												data: {
													prod1_selected,prod2_selected
												},
												success:function(data){
													if(data == 1){
														document.getElementById('comparebtn').disabled=true;
														document.getElementById("error_msg").innerHTML = "Cannot compare different category of products.";
														document.getElementById("compare_cat1").style.border = "1px solid red";
														document.getElementById("compare_cat2").style.border = "1px solid red";
													}
													else{
														document.getElementById('comparebtn').disabled=false;
														document.getElementById("error_msg").innerHTML = "";
														document.getElementById("compare_cat1").style.border = "";
														document.getElementById("compare_cat2").style.border = "";
													}
												}
											})
										}
									}
									function clearSelection(){
										document.getElementById('compare_cat1').value='';
										document.getElementById('compare_cat2').value='';
										document.getElementById('comparebtn').disabled=false;
										document.getElementById("error_msg").innerHTML = "";
										document.getElementById("compare_cat1").style.border = "";
										document.getElementById("compare_cat2").style.border = "";
									}
								</script>
							</form>
							<?php
							if(isset($_GET['comparebtn'])){
								$compareProd1 = $_GET['compare_cat1'];
								$compareProd2 = $_GET['compare_cat2'];

								$checkCat1_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$compareProd1'");
								$checkCat1_row = mysqli_fetch_assoc($checkCat1_res);

								$checkCat2_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$compareProd2'");
								$checkCat2_row = mysqli_fetch_assoc($checkCat2_res);

								if($checkCat1_row['cat_name'] != $checkCat2_row['cat_name']){
							?>
									<script>
										swal({
										title: "Unable to compare different category of products.",
										icon: "error",
										button: "OK",
										}).then(function(){window.location.href="<?php echo $_SERVER['HTTP_REFERER'];?>";});
									</script>
							<?php
								}
								else{
							?>
									<script>
										window.location = 'compare-login.php?view&code1=<?php echo $compareProd1;?>&code2=<?php echo $compareProd2;?>';
									</script>
							<?php
								}
							}
							?>
							</div><!-- End .dropdown-menu -->
						</div><!-- End .compare-dropdown -->
						
						<div class="wishlist">
                            <a href="wishlist.php" title="Wishlist">
								<?php
									$wishlist_res = mysqli_query($connect, "SELECT * FROM wishlist WHERE cus_email='$cus_email'");
									$wish_count = mysqli_num_rows($wishlist_res);
									while($wishlist_row = mysqli_fetch_assoc($wishlist_res)){
										$prodcode = $wishlist_row['product_code'];
										$prod_result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$prodcode'");
										$prod_row = mysqli_fetch_assoc($prod_result);
										$prod_status = $prod_row['product_status'];
										if($prod_status == 0){
											mysqli_query($connect,"DELETE FROM wishlist WHERE product_code='$prodcode' AND cus_email='$cus_email'");
								?>
											<script>
												swal({title:"A Gentle Reminder",
												icon:"warning",
												text:"<?php echo $prod_row['product_name']." is no longer available.";?>" ,
												button:"Ok"}).then(function(){location.reload()});
											</script>
								<?php
										}
									}
								?>
                                <div class="icon">
                                    <i class="icon-heart-o"></i>
                                    <span class="wishlist-count badge"><?php echo $wish_count; ?></span>
                                </div>
                                <p>Wishlist</p>
                            </a>
                        </div><!-- End .wishlist-dropdown -->

                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
								<?php
									$result = mysqli_query($connect, "SELECT * FROM cart WHERE cus_email='$cus_email' AND cart_status=1");
									$count = mysqli_num_rows($result);
								?>
                                <div class="icon">
                                    <i class="icon-shopping-cart"></i>
                                    <span class="cart-count"><?php echo $count; ?></span>
                                </div>
                                <p>Cart</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products">
									<?php
										$total = 0;
										while($cart_row = mysqli_fetch_assoc($result)){
											$total += $cart_row['cart_subtotal'];
											$pcode = $cart_row['product_code'];
											$detail = $cart_row['product_detail_code'];

											$prod_result = mysqli_query($connect, "SELECT * FROM product JOIN product_image ON product.product_code=product_image.product_code WHERE product.product_code='$pcode'");
											$prod_row = mysqli_fetch_assoc($prod_result);
											$prod_status = $prod_row['product_status'];

											$prod_detail = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$detail'");
											$detail_row = mysqli_fetch_assoc($prod_detail);

											if($prod_status == 0){
												mysqli_query($connect,"DELETE FROM cart WHERE product_code='$pcode' AND cus_email='$cus_email' AND cart_status=1");
									?>
												<script>
												swal({title:"A Gentle Reminder",
												icon:"warning",
												text:"<?php echo $prod_row['product_name']." is no longer available.";?>" ,
												button:"Ok"}).then(function(){location.reload()});
												</script>
									<?php
											}
											$clear_result = mysqli_query($connect, "SELECT * FROM clearance WHERE clearance_product_code='$pcode'");
											$clear_count = mysqli_num_rows($clear_result);
											if($clear_count != 0){
												$clear_row = mysqli_fetch_assoc($clear_result);
												$clear_prod_status = $clear_row['clearance_product_status'];
												if($clear_prod_status == 0){
													mysqli_query($connect,"DELETE FROM cart WHERE product_code='$pcode' AND cus_email='$cus_email' AND cart_status=1");
									?>
													<script>
													swal({title:"A Gentle Reminder",
													icon:"warning",
													text:"<?php echo $prod_row['product_name']." is no longer available.";?>" ,
													button:"Ok"}).then(function(){location.reload()});
													</script>
									<?php
												}
											}

									?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                               <?php echo $prod_row['product_name']."<br>".$detail_row['product_capacity']." (".$cart_row['product_color'].")"; ?>
                                            </h4>

                                            <span class="cart-product-info">
                                                <span class="cart-product-qty"><?php echo $cart_row['quantity']; ?></span>
                                                x RM <?php echo $cart_row['product_price']; ?>
                                            </span>
                                        </div><!-- End .product-cart-details -->

                                        <figure class="product-image-container">
											<?php
												if($cart_row['product_color'] === $prod_row['product_color1']){
											?>
													<img src="admin/product/<?=$prod_row['product_img1']?>" alt="product">
											<?php
												}
												else if($cart_row['product_color'] === $prod_row['product_color2']){
											?>
													<img src="admin/product/<?=$prod_row['product_img2']?>" alt="product">
											<?php 
												}
												else if($cart_row['product_color'] === $prod_row['product_color3']){
											?>
													<img src="admin/product/<?=$prod_row['product_img3']?>" alt="product">
											<?php
												}
												else if($cart_row['product_color'] === $prod_row['product_color4']){
											?>
													<img src="admin/product/<?=$prod_row['product_img4']?>" alt="product">
											<?php
												}
												else if($cart_row['product_color'] === $prod_row['product_color5']){
											?>
													<img src="admin/product/<?=$prod_row['product_img5']?>" alt="product">
											<?php
												}
												else{
											?>
													<img src="admin/product/<?=$prod_row['product_img6']?>" alt="product">
											<?php
												}
											?>
										</figure>
                                    </div><!-- End .product -->
									<?php
										if($cart_row['product_color'] == $prod_row['product_color1']){
											$color = $prod_row['product_color1'];
											$stock = $detail_row['product_stock1'];
										}
										else if($cart_row['product_color'] == $prod_row['product_color2']){
											$color = $prod_row['product_color2'];
											$stock = $detail_row['product_stock2'];
										}
										else if($cart_row['product_color'] == $prod_row['product_color3']){
											$color = $prod_row['product_color3'];
											$stock = $detail_row['product_stock3'];
										}
										else if($cart_row['product_color'] == $prod_row['product_color4']){
											$color = $prod_row['product_color4'];
											$stock = $detail_row['product_stock4'];
										}
										else if($cart_row['product_color'] == $prod_row['product_color5']){
											$color = $prod_row['product_color5'];
											$stock = $detail_row['product_stock5'];
										}
										else{
											$color = $prod_row['product_color6'];
											$stock = $detail_row['product_stock6'];
										}

										if($stock == 0){
											mysqli_query($connect,"DELETE FROM cart WHERE product_code='$pcode' AND product_detail_code='$detail' AND product_color='$color' AND cus_email='$cus_email' AND cart_status=1");
									?>
												<script>
												swal({title:"Out of Stock!",
												icon:"error",
												text:"<?php echo $prod_row['product_name']." ".$detail_row['product_capacity'];?> [<?php echo $color;?>]" ,
												button:"Ok"}).then(function(){location.reload()});
												</script>
									<?php
										}
										else if($stock - $cart_row['quantity'] < 0){
											$updateSub = $cart_row['product_price'] * $stock;
											mysqli_query($connect,"UPDATE cart SET quantity='$stock',cart_subtotal='$updateSub' WHERE product_code='$pcode' AND product_detail_code='$detail' AND product_color='$color' AND cus_email='$cus_email' AND cart_status=1");
									?>
											<script>
												swal({title:"Not enough stock availablity for the quantity you want.",
												icon:"error",
												text:"<?php echo $prod_row['product_name']." ".$detail_row['product_capacity'];?> [<?php echo $color;?>] left <?php echo $stock;?> only." ,
												button:"Ok"}).then(function(){location.reload()});
											</script>
									<?php
										}
									
									}
									?>
                                </div><!-- End .cart-product -->

                                <div class="dropdown-cart-total">
                                    <span>Total</span>

                                    <span class="cart-total-price">RM <?php echo number_format($total,2); ?></span>
                                </div><!-- End .dropdown-cart-total -->

                                <div class="dropdown-cart-action">
									<style>#viewcart:hover{color:#39f;}</style>
                                    <a href="cart.php" id="viewcart" class="btn btn-primary">View Cart</a>
								<?php
								if($count != 0){
								?>
                                    <a href="checkout.php" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
								<?php
								}
								else{
								?>
									<button class="btn btn-outline-primary-2" disabled><span>Checkout</span><i class="icon-long-arrow-right"></i></button>
								<?php
								}
								?>
                                </div><!-- End .dropdown-cart-action -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .cart-dropdown -->
                    </div><!-- End .header-right -->
                </div><!-- End .container -->
            </div><!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-left">
                        <div class="dropdown category-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                                Browse Brands <i class="icon-angle-down"></i>
                            </a>

                            <div class="dropdown-menu">
                                 <nav class="side-nav">
                                    <ul class="menu-vertical sf-arrows">
										<?php
										$brand_res = mysqli_query($connect,"SELECT * FROM brand WHERE brand_status=1");
										while($brand_row = mysqli_fetch_assoc($brand_res)){
										?>
											<li><a href="brand-products-login.php?view&brand=<?php echo $brand_row['brand_name'];?>"><?php echo $brand_row['brand_name'];?></a></li>
										<?php
										}
										?>
                                    </ul><!-- End .menu-vertical -->
                                </nav><!-- End .side-nav -->
                            </div><!-- End .dropdown-menu -->
                        </div><!-- End .category-dropdown -->
                    </div><!-- End .header-left -->

                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li id="home">
									<a href="index-login.php" class="megamenu-container active" class="sf-with-ul">Home</a>
								</li>
                                <li id="cat">
									<a href="#" class="sf-with-ul" style="pointer-events: none;">Categories</a>

									<div class="megamenu megamenu-md">
										<div class="row no-gutters">
											<div class="col-md-8">
												<div class="menu-col">
												<div class="row">
														<div class="col-md-4">
															<?php
																	$cat = array();
																	$category_result = mysqli_query($connect,"SELECT * FROM category");
																	while($category_row = mysqli_fetch_assoc($category_result)){
																		$cat[] = $category_row['cat_name'];
																	}

																	$phone = mysqli_query($connect,"SELECT DISTINCT brand.brand_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = '$cat[0]' AND brand.brand_status=1 AND product.product_status=1");
																	$phone_count = mysqli_num_rows($phone);
																	if($phone_count != 0){
															?>
															<div class="menu-title"><a href="category-products-login.php?view&cat=<?php echo $cat[0];?>">Phones</a></div><!-- End .menu-title -->
															<ul>
																<?php
																		while($phone_row = mysqli_fetch_assoc($phone)){
																?>
																			<li><a href="brand-category-login.php?view&brand=<?php echo $phone_row['brand_name'];?>&cat=Phone"><?php echo $phone_row['brand_name']; ?></a></li>
																<?php
																		}
																?>
															</ul>
															<?php
																}
																else{}
															?>
															
															<?php
																$tablet = mysqli_query($connect,"SELECT DISTINCT brand.brand_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = '$cat[1]' AND brand.brand_status=1 AND product.product_status=1");
																$tablet_count = mysqli_num_rows($tablet);
																if($tablet_count != 0){
															?>
															<div class="menu-title"><a href="category-products-login.php?view&cat=<?php echo $cat[1];?>">Tablets</a></div><!-- End .menu-title -->
															<ul>
																<?php
																		while($tablet_row = mysqli_fetch_assoc($tablet)){
																?>
																			<li><a href="brand-category-login.php?view&brand=<?php echo $tablet_row['brand_name'];?>&cat=Tablet"><?php echo $tablet_row['brand_name']; ?></a></li>
																<?php
																		}
																?>
															</ul>
															<?php
																}
																else{}
															?>
														</div><!-- End .col-md-4 -->

														<div class="col-md-4">
															<?php
																$watch = mysqli_query($connect,"SELECT DISTINCT brand.brand_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = '$cat[2]' AND brand.brand_status=1 AND product.product_status=1");
																$watch_count = mysqli_num_rows($watch);
																if($watch_count != 0){
															?>
															<div class="menu-title"><a href="category-products-login.php?view&cat=<?php echo $cat[2];?>">Watches</a></div><!-- End .menu-title -->
															<ul>
																<?php
																		while($watch_row = mysqli_fetch_assoc($watch)){
																?>
																			<li><a href="brand-category-login.php?view&brand=<?php echo $watch_row['brand_name'];?>&cat=Watch"><?php echo $watch_row['brand_name']; ?></a></li>
																<?php
																		}
																?>
															</ul>
															<?php
																}
																else{}
															?>
															
															<?php
																$audio = mysqli_query($connect,"SELECT DISTINCT brand.brand_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = '$cat[3]' AND brand.brand_status=1 AND product.product_status=1");
																$audio_count = mysqli_num_rows($audio);
																if($audio_count != 0){
															?>
															<div class="menu-title"><a href="category-products-login.php?view&cat=<?php echo $cat[3];?>">Audio's</a></div><!-- End .menu-title -->
															<ul>
																<?php
																		while($audio_row = mysqli_fetch_assoc($audio)){
																?>
																			<li><a href="brand-category-login.php?view&brand=<?php echo $audio_row['brand_name'];?>&cat=Audio"><?php echo $audio_row['brand_name']; ?></a></li>
																<?php
																		}
																?>
															</ul>
															<?php
																}
																else{}
															?>
														</div><!-- End .col-md-4 -->
														<div class="col-md-4">
															<?php
																$accessories = mysqli_query($connect,"SELECT DISTINCT brand.brand_name FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.cat_name = '$cat[4]' AND brand.brand_status=1 AND product.product_status=1");
																$accessories_count = mysqli_num_rows($accessories);
																if($accessories_count != 0){
															?>
															<div class="menu-title"><a href="category-products-login.php?view&cat=<?php echo $cat[4];?>">Accessories</a></div><!-- End .menu-title -->
															<ul>
																<?php
																		while($accessories_row = mysqli_fetch_assoc($accessories)){
																?>
																			<li><a href="brand-category-login.php?view&brand=<?php echo $accessories_row['brand_name'];?>&cat=Accessories"><?php echo $accessories_row['brand_name']; ?></a></li>
																<?php
																		}
																?>
															</ul>
															<?php
																}
																else{}
															?>
														</div><!-- End .col-md-4 -->
													</div><!-- End .row -->
												</div><!-- End .menu-col -->
											</div><!-- End .col-md-8 -->
												
											<div class="col-md-4">
												<div class="banner banner-overlay">
													<img src="assets/images/demos/banners/banner-5.jpg" alt="Banner">
												</div><!-- End .banner banner-overlay -->
											</div><!-- End .col-md-4 -->
												
										</div><!-- End .row -->
									</div><!-- End .megamenu megamenu-md -->
                                </li>
								<li id="clearance">
									<a href="clearance-login.php" class="megamenu-container active" class="sf-with-ul">Clearance</a>
								</li>
                            </ul><!-- End .menu -->
                        </nav><!-- End .main-nav -->
                    </div><!-- End .header-center -->
					
					<div class="header-right">
                        <i class="la la-lightbulb-o"></i><p><b>FREE SHIPPING</b> in Malaysia</p>
                    </div>
                </div><!-- End .container -->
            </div><!-- End .header-bottom -->
        </header><!-- End .header -->