<?php include("header-login.php"); ?>
<script>
document.getElementById("home").classList.add('active');
</script>

        <main class="main">
            <div class="intro-slider-container mb-5">
                <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl" 
                    data-owl-options='{
                        "dots": true,
                        "nav": false, 
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>
                    <div class="intro-slide" style="background-image: url(assets/images/demos/slider/slide-1.png); margin-left:135px;">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h1 class="intro-title">Apple<br>iPad Air 5th Generation</h1><!-- End .intro-title -->
                                    

                                    <div class="intro-price">
                                        <sup>From</sup>
                                        <span class="text-third">
                                            RM 2699.00
                                        </span>
                                    </div><!-- End .intro-price -->
                                </div><!-- End .col-lg-11 offset-lg-1 -->
                            </div><!-- End .row -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->

                    <div class="intro-slide" style="background-image: url(assets/images/demos/slider/slide-2.jpg);">
                        <div class="container intro-content">
                            <div class="row justify-content-end">
                                <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                    <h3 class="intro-subtitle text-primary">&ensp;New Arrival</h3><!-- End .h3 intro-subtitle -->
                                    <h1 class="intro-title">Apple<br>iPhone 13 Pro Max </h1><!-- End .intro-title -->

                                    <div class="intro-price">
                                        <sup>From</sup>
                                        <span class="text-third">
                                            RM 5299.00
                                        </span>
                                    </div><!-- End .intro-price -->
                                </div><!-- End .col-auto col-sm-7 col-md-6 col-lg-5 -->
                            </div><!-- End .row -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
					
					<div class="intro-slide">
                        <video poster="assets/images/demos/slider/slide3.jpg" style="margin-left:300px; width:600; object-fit:fill;"controls>
							<source src="assets/images/demos/slider/slide3.mp4" type="video/mp4">
							Your browser does not support the video tag.
						</video>
                        <div class="container intro-content">
							<div class="col-auto col-sm-7 col-md-6 col-lg-10">
								<h1 class="intro-title">Samsung<br>S22 Ultra 5G</h1><!-- End .intro-title -->
										
								<div class="intro-price">
									<sup>From</sup>
									<span class="text-third">
									RM 5099.00
									</span>
								</div><!-- End .intro-price -->
							</div><!-- End .col-auto col-sm-7 col-md-6 col-lg-10 -->
                        </div><!-- End .intro-content -->
                    </div><!-- End .intro-slide -->
					
                </div><!-- End .intro-slider owl-carousel owl-simple -->

                <span class="slider-loader"></span><!-- End .slider-loader -->
            </div><!-- End .intro-slider-container -->

            <div class="container">
                <h2 class="title text-center mb-4">Explore Categories</h2><!-- End .title text-center -->
                
                <div class="cat-blocks-container">
                    <div class="row">
                        <?php 
                            $catRes = mysqli_query($connect,"SELECT * FROM category");
                            while($catRow = mysqli_fetch_assoc($catRes)){
                        ?>
                            <div class="col-6 col-sm-4 col-lg-2" style="margin:auto;">
                                <a href="category-products-login.php?view&cat=<?php echo $catRow['cat_name'];?>" class="cat-block">
                                    <figure>
                                        <span>
                                            <img src="admin/category/<?=$catRow['cat_image']?>" alt="Category image" style="height:150px;">
                                        </span>
                                    </figure>

                                    <h3 class="cat-block-title"><?php echo $catRow['cat_name'];?></h3><!-- End .cat-block-title -->
                                </a>
                            </div><!-- End .col-sm-4 col-lg-2 -->
						<?php
                            }
                        ?>
                    </div><!-- End .row -->
                </div><!-- End .cat-blocks-container -->
            </div><!-- End .container -->

            <div class="mb-4"></div><!-- End .mb-4 -->

            <div class="mb-3"></div><!-- End .mb-3 -->
            
            <div class="bg-light pt-5 pb-6">
            <div class="container new-arrivals">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">New Arrivals</h2><!-- End .title -->
                    </div><!-- End .heading-left -->
                </div><!-- End .heading -->

                <div class="tab-content tab-content-carousel just-action-icons-sm">
                    <div class="tab-pane p-0 fade show active" id="new-all-tab" role="tabpanel" aria-labelledby="new-all-link">
                        <div class="owl-carousel owl-full carousel-equal-height carousel-with-shadow" data-toggle="owl" 
                            data-owl-options='{
                                "nav": true, 
                                "dots": true,
                                "margin": 20,
                                "loop": false,
                                "responsive": {
                                    "0": {
                                        "items":2
                                    },
                                    "480": {
                                        "items":2
                                    },
                                    "768": {
                                        "items":3
                                    },
                                    "992": {
                                        "items":4
                                    },
                                    "1200": {
                                        "items":5
                                    }
                                }
                            }'>
							
							<?php

								$result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status=1 AND brand.brand_status=1 ORDER BY product.product_code DESC LIMIT 8");
								
								while($row = mysqli_fetch_assoc($result)){
									$pcode = $row['product_code'];
									$arrival_img = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode'");
									while($img_row = mysqli_fetch_assoc($arrival_img)){
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
                            <div class="product product-2">
                                <figure class="product-media">
                                    <a href="product-details-login.php?view&code=<?php echo $row['product_code']; ?>">
                                        <img src="admin/product/<?=$img_row['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                    </a>
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <?php echo $row['brand_name']." · ".$row['cat_name']; ?>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $row['product_code']; ?>"><?php echo $row['product_name']; ?></a></h3><!-- End .product-title -->
                                    <div class="product-price" style="color:#39f; font-size:10pt;">
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
							<?php
									}
								}
							?>
                        </div><!-- End .owl-carousel -->
                    </div><!-- .End .tab-pane -->
				</div><!-- End .tab-content -->
            </div><!-- End .container -->
            </div><!-- End .bg-light pt-5 pb-6 -->
			
			<div class="mb-6"></div><!-- End .mb-6 -->

            <div class="mb-5"></div><!-- End .mb-5 -->
			
            <div class="container for-you">
                <div class="heading heading-flex mb-3">
                    <div class="heading-left">
                        <h2 class="title">Recommendation For You</h2><!-- End .title -->
                    </div><!-- End .heading-left -->

                   <div class="heading-right">
                        <a href="all-products-login.php" class="title-link">View All Recommendation <i class="icon-long-arrow-right"></i></a>
                   </div><!-- End .heading-right -->
                </div><!-- End .heading -->
				
                <div class="products">
                    <div class="row justify-content-center">
						<?php
							$rec_result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status=1 AND brand.brand_status=1 ORDER BY RAND() LIMIT 12");
										
							while($rec_row = mysqli_fetch_assoc($rec_result)){
								$pcode3 = $rec_row['product_code'];
								$recommend_img = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$pcode3'");
								while($recommend_img_row = mysqli_fetch_assoc($recommend_img)){
                                    $detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode3'");
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
                                    <a href="product-details-login.php?view&code=<?php echo $rec_row['product_code']; ?>">
                                        <img src="admin/product/<?=$recommend_img_row['product_img1']?>" alt="Product image" class="product-image" style="height:300px; object-fit:contain;">
                                    </a>
                                </figure><!-- End .product-media -->

                                <div class="product-body">
                                    <div class="product-cat">
                                        <?php echo $rec_row['brand_name']." · ".$rec_row['cat_name']; ?>
                                    </div><!-- End .product-cat -->
                                    <h3 class="product-title"><a href="product-details-login.php?view&code=<?php echo $rec_row['product_code']; ?>"><?php echo $rec_row['product_name']; ?></a></h3><!-- End .product-title -->
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
            </div><!-- End .container -->

            <div class="mb-4"></div><!-- End .mb-4 -->

            <div class="container">
                <hr class="mb-0">
            </div><!-- End .container -->

            <div class="icon-boxes-container bg-transparent">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-3" style="margin:auto;">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                    <p>At all the state in Malaysia</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3" style="margin:auto;">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Get Informations</h3><!-- End .icon-box-title -->
                                    <p>of products</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-3" style="margin:auto;">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Customer Services</h3><!-- End .icon-box-title -->
                                    <p>All the time</p>
                                </div><!-- End .icon-box-content -->
                            </div><!-- End .icon-box -->
                        </div><!-- End .col-sm-6 col-lg-3 -->
                    </div><!-- End .row -->
                </div><!-- End .container -->
            </div><!-- End .icon-boxes-container -->
        </main><!-- End .main -->

<?php include("footer-login.php"); ?>