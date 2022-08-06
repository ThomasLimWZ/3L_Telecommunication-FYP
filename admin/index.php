<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id']) || $_SESSION["position"] != "Staff"){
?>
<script>
	alert("Please log in");
</script>
<?php
		header("refresh:0.5; url = login.php");
		exit();
	}
	else{
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>3L Admin Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
	
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <?php include("sidebar.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
               <?php include("topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>
					<br/>

                     <!-- Content Row -->
                    <div class="row">
					
                        <!-- Total Order -->
						<?php
						$order=mysqli_query($connect,"SELECT * FROM payment INNER JOIN shipping ON payment.payment_code=shipping.payment_code
											WHERE shipping.delivery_status!=3");
						$row_order=mysqli_num_rows($order);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-success h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-clipboard fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Order</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $row_order; ?> </div>
								</div>
								<a class="card-footer clearfix small z-1" href="all-order.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
						
						<!-- Total User -->
						
						<?php
						$user=mysqli_query($connect,"SELECT * FROM customer");
						$row_user=mysqli_num_rows($user);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-primary h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-user fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $row_user; ?> </div>
								</div>
								<a class="card-footer clearfix small z-1" href="all-customer.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>

                        <!-- Total brand -->
						<?php
						$brand=mysqli_query($connect,"SELECT * FROM brand");
						$row_brand=mysqli_num_rows($brand);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-info h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-server fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Brand</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $row_brand; ?> </div>
								</div>
								<a class="card-footer clearfix small z-1" href="all-brand.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>

                        <!-- Total Product -->
						<?php
						$prod=mysqli_query($connect,"SELECT * FROM product INNER JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status=1 AND brand.brand_status=1");
						$row_prod=mysqli_num_rows($prod);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-warning h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-cube fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Products</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $row_prod; ?> </div>
								</div>
								<a class="card-footer clearfix small z-1" href="all-product.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
					<!-- Total Sales in current year -->
						<?php
						$total=mysqli_query($connect,"SELECT SUM(payment_total) FROM payment INNER JOIN shipping ON payment.payment_code=shipping.payment_code 
						WHERE YEAR(payment.payment_date)=YEAR(CURDATE()) AND shipping.delivery_status=3");
						$row_total=mysqli_fetch_array($total);
						$current=mysqli_query($connect,"SELECT YEAR(CURDATE()) AS currentyear");
						$rowcurrent = mysqli_fetch_assoc($current);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-danger h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Sales in <?php echo $rowcurrent['currentyear']?></div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">RM<?php echo number_format((float)$row_total[0],2);?></div>
								</div>
								<a class="card-footer clearfix small z-1" href="all-sales-currentyear.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
						
					<!-- Total ORDER past 7 days -->
						<?php
						$total_seven=mysqli_query($connect,"SELECT sum(payment_total) from payment JOIN shipping ON payment.payment_code=shipping.payment_code 
															WHERE date(payment.payment_date)>=(DATE(NOW()) - INTERVAL 7 DAY) AND shipping.delivery_status!=3");
						$row_total_seven=mysqli_fetch_array($total_seven);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-secondary h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-muted text-uppercase mb-1">Last 7 Days Order</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">RM<?php echo number_format((float)$row_total_seven[0],2);?></div>
								</div>
								<a class="card-footer clearfix small z-1" href="seven-order.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
						
						<!-- Yestersay Order -->
						<?php
						$yes=mysqli_query($connect,"SELECT sum(payment_total) FROM payment JOIN shipping ON payment.payment_code=shipping.payment_code WHERE date(payment.payment_date)=CURDATE()-1 
                        AND shipping.delivery_status!=3");
						$row_yes=mysqli_fetch_array($yes);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
							<div class="card text-white bg-white o-hidden border-left-warning h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Yestersay's Order</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">RM<?php echo number_format((float)$row_yes[0],2);?></div>
								</div>
								<a class="card-footer clearfix small z-1" href="yesterday-order.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
						
						<!-- Today Order -->
						<?php
						$today=mysqli_query($connect,"SELECT sum(payment_total) FROM payment JOIN shipping ON payment.payment_code=shipping.payment_code WHERE date(payment.payment_date)=CURDATE() 
                        AND shipping.delivery_status!=3");

						$row_today=mysqli_fetch_array($today);
						?>
                        <div class="col-xl-3 col-sm-6 mb-3">
						<div class="card text-white bg-white o-hidden border-left-primary h-100">
								<div class="card-body">
									<div class="card-body-icon">
										<span class="float-right">
											<i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
										</span>
									</div>
									<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Today's Order</div>
									<div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">RM<?php echo number_format((float)$row_today[0],2);?></div>
								</div>
								<a class="card-footer clearfix small z-1" href="today-order.php">
									<span class="float-left">View Details</span>
									<span class="float-right">
										<i class="fa fa-angle-right"></i>
									</span>
								</a>
							</div>
						</div>
					</div>
					<!-- Top Sales Table -->
					<div class="row">
                        <div class="col-xl-8 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Top Sales</h6>
                                    
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
								<div class="col-sm-12">
									<div class="card card-table">
										<table class="datatable table table-stripped table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>No.</th>
													<th>Customer Name</th>
													<th>Order Date</th>
													<th>Grand Total (RM)</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php
													$i=1;
													$result = mysqli_query($connect, "SELECT * FROM payment INNER JOIN customer ON payment.cus_email=customer.cus_email ORDER BY payment.payment_total DESC LIMIT 7");	
													while($row = mysqli_fetch_assoc($result)){
														$paycode = $row ["payment_code"];
														$complete = mysqli_query($connect,"SELECT * FROM shipping WHERE delivery_status=3 AND payment_code='$paycode'");
														while($comprow = mysqli_fetch_assoc($complete)){
												?>		
													<tr>
														<td><?php echo $i;?></td>
														<td><?php echo $row ["cus_name"];?></td>
														<td><?php 
															$date = date_create($row['payment_date']);
															echo date_format($date,"d-m-Y H:i:s");
														?></td>
														<td><?php echo $row ["payment_total"];?></td>
														<td>
														<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="generate_pdf_sales.php?pdf&code=<?php echo $row['payment_code'];?>"  target="_blank"><button class="btn btn-success btn-sm rounded-0" type="button" title="Generate Invoice"><i class="fa fa-file-pdf"></i></button></a>
															</li>
														</ul>
														</td>
													</tr>

													<?php
													$i++;
													
												}}												
												?>	
											</tbody>
											</table>
                                </div>
                            </div>
                        </div>
					</div>
				</div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Categories of Products</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                       <canvas id="pieChart" style="height:650px"></canvas>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color:#f56954"></i> Phone
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color:#00a65a"></i> Tablet
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color:#f39c12"></i> Watch
                                        </span>
										<br/>
										<span class="mr-2">
                                            <i class="fas fa-circle" style="color:#00c0ef"></i> Audio
                                        </span>
										<span class="mr-2">
                                            <i class="fas fa-circle" style="color:#3c8dbc"></i> Accessories
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
                    <div class="col-xl-8 col-lg-7">
                            
                    <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Product Less Stock Alert &nbsp; <i class="fas fa-exclamation-triangle" style="font-size:20px;color:red"></i></h6>
                                </div>
                                <div class="card-body">
                                <table class="datatable table table-stripped table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>No.</th>
														<th>Name</th>
														<th>Brand</th>
														<th>Category</th>
														<th>Price (RM) </th>
														<th>Stock</th>
														<th>Add</th>
													</tr>
													<tbody>
                                                    <?php
                                                	$result = mysqli_query($connect, "SELECT * FROM product JOIN brand ON product.brand_name=brand.brand_name WHERE product.product_status = 1 AND brand.brand_status=1");
													$i=1;
												
												    while($row = mysqli_fetch_assoc($result)){
                                                        $prod_code = $row['product_code'];
														$detail_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$prod_code'");
														$price = array();
														$stock = array();
														while($detail_row = mysqli_fetch_assoc($detail_result)){
															$price[] = $detail_row['product_price'];
															$stock[] = $detail_row['product_stock1']+$detail_row['product_stock2']+$detail_row['product_stock3']+$detail_row['product_stock4']+$detail_row['product_stock5']+$detail_row['product_stock6'];
															
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
														$total_stock = array_sum($stock);
														$alert_stock = mysqli_query($connect, "SELECT * FROM product_image WHERE product_code = '$prod_code' AND '$total_stock'<=5");
                                                        while($arow = mysqli_fetch_assoc($alert_stock)){
												?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $row['product_name']; ?></td>
														<td><?php echo $row['brand_name']; ?></td>
														<td><?php echo $row['cat_name']; ?></td>
														<td><?php 
																if(count($price) > 1){
																	echo $min." - ".$max;
																}
																else{
																	echo $min;
																}
															?></td>
														<td>
															<b>
															 <span style="color:red;"><?php echo $total_stock ?></span>
															</b>
														</td>	
														<td>	
															<!-- Call to action buttons -->
															<ul class="list-inline m-0">
																<li class="list-inline-item">
																	<a href="index-product-details.php?detail&code=<?php echo $row['product_code'];?>"><button class="btn btn-warning btn-sm rounded-0" type="button" title="Restock"><i class="fa fa-plus"></i></button></a>
																</li>
															</ul>
														</td>
													</tr>
												<?php
													$i++;
                                                   }
												}
												?>
												</tbody>
											</table>
                                    </div>
                                </div>
                            </div>
						</div> 

					</div>
					<!-- /.container-fluid -->
				</div>
				<!-- End of Main Content -->
				<!-- Footer -->
				<footer class="sticky-footer bg-white">
					<div class="container my-auto">
						<div class="copyright text-center my-auto">
							<span>3L Telecommunication</span>
						</div>
					</div>
				</footer>
				<!-- End of Footer -->
			</div>
        <!-- End of Content Wrapper -->
		</div>
	<!-- End of Page Wrapper -->

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<?php include("logout-model.php");?>
		
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/Chart.js"></script>

</body>

</html>
<?php
	}

include('piedata.php');
 ?>
<script>
  $(function () {
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : <?php echo $phone; ?>,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Phone'
      },
      {
        value    : <?php echo $tablet; ?>,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Tablet'
      },
      {
        value    : <?php echo $watch; ?>,
        color    : '#f39c12',
        highlight: '#f39c12',
        label    : 'Watch'
      },
      {
        value    : <?php echo $audio; ?>,
        color    : '#00c0ef',
        highlight: '#00c0ef',
        label    : 'Audio'
      },
      {
        value    : <?php echo $accessories; ?>,
        color    : '#3c8dbc',
        highlight: '#3c8dbc',
        label    : 'Accessories'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
 
  })
</script>