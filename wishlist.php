<?php include("header-login.php"); ?>
		
        <main class="main">
                <div class="container" style="text-align:center;"> 
                        <br>
                        <hr class="mb-2">
                        <h1 style="text-align:center;"><b>Wishlist</b></h1>
                        <hr class="mb-2">
                        <br>
                </div>

                <div class="page-content">
            	        <div class="container">
			        <table class="table table-wishlist table-mobile">
                                <?php
                                $wish_res = mysqli_query($connect,"SELECT * FROM wishlist WHERE cus_email='$cus_email'");
                                $count = mysqli_num_rows($wish_res);
                                if($count != 0){
                                ?>
					<thead>
					        <tr style="text-align:center;">
							<th width="300px" style="font-weight:bold;">Product</th>
                                                        <th style="font-weight:bold;">Capacity / Size</th>
                                                        <th style="font-weight:bold;">Color</th>
							<th style="font-weight:bold;">Price</th>
							<th width="200px" style="font-weight:bold;">Stock Status</th>
							<th style="font-weight:bold;">Action</th>
							<th></th>
						</tr>
					</thead>

					<tbody>
                                        <?php
                                                while($wish_row = mysqli_fetch_assoc($wish_res)){
                                                        $product = $wish_row['product_code'];
                                                        $prod_detail = $wish_row['product_detail_code'];
                                                        $prod_res = mysqli_query($connect,"SELECT * FROM product WHERE product_code='$product'");
                                                        $prod_row = mysqli_fetch_assoc($prod_res);
                                                        $img_result = mysqli_query($connect,"SELECT * FROM product_image WHERE product_code='$product'");
                                                        $img_row = mysqli_fetch_assoc($img_result);
                                                        $detailresult = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_detail_code='$prod_detail'");
                                                        $detail_row = mysqli_fetch_assoc($detailresult);
                                        ?>
						<tr>
							<td class="product-col">
								<div class="product">
									<figure class="product-media">
                                                                        <?php
									if($wish_row['product_color'] === $img_row['product_color1']){
									?>
										<img src="admin/product/<?=$img_row['product_img1']?>" alt="product">
									<?php
									}
									else if($wish_row['product_color'] === $img_row['product_color2']){
									?>
										<img src="admin/product/<?=$img_row['product_img2']?>" alt="product">
									<?php 
									}
									else if($wish_row['product_color'] === $img_row['product_color3']){
									?>
										<img src="admin/product/<?=$img_row['product_img3']?>" alt="product">
									<?php
									}
									else if($wish_row['product_color'] === $img_row['product_color4']){
									?>
										<img src="admin/product/<?=$img_row['product_img4']?>" alt="product">
									<?php
									}
									else if($wish_row['product_color'] === $img_row['product_color5']){
									?>
										<img src="admin/product/<?=$img_row['product_img5']?>" alt="product">
									<?php
									}
                                                                        else{
                                                                        ?>
                                                                                <img src="admin/product/<?=$img_row['product_img6']?>" alt="product">
                                                                        <?php
                                                                        }
									?>
									</figure>

									<h3 class="product-title">
                                                                                <a href="product-details-login.php?view&code=<?php echo $wish_row['product_code']; ?>" name="product" value=" <?php echo $wish_row['product_code'];?>">
                                                                                        <?php echo $prod_row['product_name'];?>
                                                                                </a>
									</h3><!-- End .product-title -->
								</div><!-- End .product -->
							</td>
                                                        <td style="text-align:center;" name="color"><?php echo $detail_row['product_capacity']; ?></td>
                                                        <td style="text-align:center;" name="color"><?php echo $wish_row['product_color']; ?></td>
							<td class="price-col" style="text-align:center;" name="price">RM <?php echo $detail_row['product_price'];?></td>
							<td class="stock-col" style="text-align:center;">
                                                                <?php
								if($wish_row['product_color'] === $img_row['product_color1']){
                                                                        $stock = $detail_row['product_stock1'];
                                                                        if($stock >= 5){
								?>
                                                                                <span style="color:green"><b>In stock</b></span>
								<?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                                <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                 <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color2']){
                                                                        $stock = $detail_row['product_stock2'];
                                                                        if($stock >= 5){
                                                                ?>
                                                                                <span style="color:green"><b>In stock</b></span>
                                                                <?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                                <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
								}
								else if($wish_row['product_color'] === $img_row['product_color3']){
                                                                        $stock = $detail_row['product_stock3'];
                                                                        if($stock >= 5){
                                                                ?>
                                                                                <span style="color:green"><b>In stock</b></span>
                                                                <?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                        <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                        <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
								}
								else if($wish_row['product_color'] === $img_row['product_color4']){
                                                                        $stock = $detail_row['product_stock4'];
                                                                        if($stock >= 5){
                                                                ?>
                                                                                <span style="color:green"><b>In stock</b></span>
                                                                <?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                                <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color5']){
                                                                        $stock = $detail_row['product_stock5'];
                                                                        if($stock >= 5){
                                                                ?>
                                                                                <span style="color:green"><b>In stock</b></span>
                                                                <?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                                <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                <?php
                                                                }
                                                                else{
                                                                ?>
                                                                        <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
                                                                }
                                                                else{
                                                                        $stock = $detail_row['product_stock6'];
                                                                        if($stock >= 5){
                                                                ?>
                                                                                <span style="color:green"><b>In stock</b></span>
                                                                <?php
                                                                        }
                                                                        else if($stock < 5 && $stock > 0){
                                                                ?>
                                                                                <span style="color:#ffcc00"><b>Left a few stock only</b></span>
                                                                <?php
                                                                }
                                                                else{
                                                                ?>
                                                                        <span style="color:red"><b>Out of stock</b></span>
                                                                <?php
                                                                        }
                                                                }
                                                                 ?>
                                                        </td>
                                                        <td class="action-col" style="text-align:center;">
                                                                <?php
                                                                if($wish_row['product_color'] === $img_row['product_color1']){
                                                                        $stock = $detail_row['product_stock1'];
                                                                        if($stock == 0){
                                                                ?>
                                                                                <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color2']){
                                                                        $stock = $detail_row['product_stock2'];
                                                                        if($stock == 0){
                                                                 ?>
									        <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button>
                                                                <?php
                                                                         }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color3']){
                                                                        $stock = $detail_row['product_stock3'];
                                                                        if($stock == 0){
                                                                ?>
                                                                                <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button></a>
                                                                <?php
                                                                }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color4']){
                                                                        $stock = $detail_row['product_stock4'];
                                                                        if($stock == 0){
                                                                ?>
                                                                                <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                else if($wish_row['product_color'] === $img_row['product_color5']){
                                                                        $stock = $detail_row['product_stock5'];
                                                                        if($stock == 0){
                                                                ?>
                                                                                <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                else{
                                                                        $stock = $detail_row['product_stock6'];
                                                                        if($stock == 0){
                                                                ?>
                                                                                <button class="btn btn-block btn-outline-primary-2" disabled>OUT OF STOCK</button>
                                                                <?php
                                                                        }
                                                                        else{
                                                                ?>
                                                                                <a href="wishlist.php?cart&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>&price=<?php echo $wish_row['product_price'];?>"class="btn btn-block btn-outline-primary-2" name="addcart"><i class="icon-cart-plus"></i>Add to Cart</a>
                                                                <?php
                                                                        }
                                                                }
                                                                ?>
                                                                </td>
							<td class="remove-col"><a href="wishlist.php?remove&code=<?php echo $wish_row['product_code'];?>&cap=<?php echo $wish_row['product_detail_code'];?>&color=<?php echo $wish_row['product_color'];?>" class="btn-remove" onclick="return confirmation()"><i class="icon-close"></i></a></td>
                                                </tr>
                                                <?php
                                                }
                                                ?>
						</tbody>
                                        <?php
                                        }
                                        else{
                                        ?>
                                                <h3 style="text-align:center;">You haven't add any product in your wishlist yet.</h3>
                                                <br>
                                                <div style="text-align:center; margin:auto;">
                                                        <a href="index-login.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;"><i class="fa fa-shopping-cart"></i>Shop</a>
                                                </div>
                                        <?php
                                        }
                                        ?>
				</table><!-- End .table table-wishlist -->
            	        </div><!-- End .container -->
                </div><!-- End .page-content -->
        </main><!-- End .main -->
		
<?php include("footer-login.php"); ?>
<script>
function confirmation(){
	var option;
	option = confirm("Do you want to remove this product from your wishlist?");
	return option;
}	
</script>
<?php
if(isset($_GET['cart'])){
        $code = $_GET['code'];
	$capacity = $_GET['cap'];
        $color = $_GET['color'];
        $price = $_GET['price'];

        
        $cartRes = mysqli_query($connect,"SELECT * FROM cart WHERE cus_email='$cus_email' AND product_code='$code' AND product_color='$color' AND product_detail_code='$capacity' AND cart_status=1");
	$countCartRes = mysqli_num_rows($cartRes);
        if($countCartRes == 0){
                mysqli_query($connect,"INSERT INTO cart (product_code,product_detail_code,product_color,quantity,product_price,cart_subtotal,cus_email) VALUES ('$code','$capacity','$color',1,'$price','$price','$cus_email')");
                mysqli_query($connect,"DELETE FROM wishlist WHERE product_code='$code' AND product_color='$color' AND product_detail_code='$capacity' AND cus_email='$cus_email'");
?>
        <script>
               function wishPage(){window.location.href = 'wishlist.php';}
			function cartPage(){window.location.href = 'cart.php';}
			swal({
			title: "Updated your cart.",
			icon: "success",
			buttons: {
				cart: {
					text: "View Cart",
					value: "cart",
				},
				product: {
					text: "OK",
					value: "product",
				}
			},
			}).then((value) => {
				switch(value){
					case "product": wishPage();
					break;
					case "cart": cartPage();
					break;
					default: wishPage();
				}
			});
        </script>
<?php
        }
        else{
                $checkCart_row = mysqli_fetch_assoc($cartRes);
		$currentQty = $checkCart_row['quantity'];
		$addQty = $currentQty + 1;
		$subtotal = $price * $addQty;

		mysqli_query($connect,"UPDATE cart SET quantity='$addQty', cart_subtotal='$subtotal' WHERE cus_email='$cus_email' AND product_code='$code' AND product_color='$color' AND product_detail_code='$capacity' AND cart_status=1");
                mysqli_query($connect,"DELETE FROM wishlist WHERE product_code='$code' AND product_color='$color' AND product_detail_code='$capacity' AND cus_email='$cus_email'");
?>
                <script>
			function wishPage(){window.location.href = 'wishlist.php';}
			function cartPage(){window.location.href = 'cart.php';}
			swal({
			title: "Updated your cart.",
			icon: "success",
			buttons: {
				cart: {
					text: "View Cart",
					value: "cart",
				},
				product: {
					text: "OK",
					value: "product",
				}
			},
			}).then((value) => {
				switch(value){
					case "product": wishPage();
					break;
					case "cart": cartPage();
					break;
					default: wishPage();
				}
			});
		</script>
<?php
        }
}
if(isset($_GET['remove'])){
	$code = $_GET['code'];
	$color = $_GET['color'];
	$cap = $_GET['cap'];
	mysqli_query($connect,"DELETE FROM wishlist WHERE product_code='$code' AND product_detail_code='$cap' AND product_color='$color' AND cus_email='$cus_email'");
?>
<script>
        swal({
        title: "Done removed.",
        icon: "success",
        button: "OK",
        }).then(function(){window.location.href="wishlist.php";});
</script>
<?php
}
mysqli_close($connect);
?>