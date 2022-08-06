<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id']) || $_SESSION["position"] != "Manager"){
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
<?php error_reporting(0); ?>
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
        <?php include("sidebar-manager.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <?php include("topbar-manager.php");?>
                <!-- End of Topbar -->
					<?php
						if(isset($_GET["view"])){
							$pcode = $_GET["code"];

                            $clearance = mysqli_query($connect, "SELECT * FROM clearance WHERE clearance_product_code='$pcode'");
							$clearancerow = mysqli_fetch_assoc($clearance);

							$result = mysqli_query($connect, "SELECT * FROM product WHERE product_code='$pcode'");
							$row = mysqli_fetch_assoc($result);

                            $capacity_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_code='$pcode'");
							$cap_row = mysqli_fetch_assoc($capacity_result);
						}
					?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800"><?php echo $clearancerow['clearance_product_name'];?></h1>
                    </div>
					<br>
                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-sm-8">
									<form method="GET" action="">
										<div class="card card-table">
                                            <?php
                                                $detail_res = mysqli_query($connect,"SELECT * FROM product_detail WHERE product_code='$pcode'");
                                                $i=1;
                                            ?>
											<table class="datatable table table-stripped table table-hover table-center mb-0">
												<thead>
													<tr>
														<th>No.</th>
                                                        <?php 
                                                        if($row['cat_name'] == 'Audio' || $row['cat_name'] == 'Accessories'){}
                                                        else if($row['cat_name']=='Watch')
                                                        {
                                                        ?>
                                                        <th>Case Size</th>
                                                        <?php
                                                        }
                                                        else{
                                                        ?>
														<th>RAM + ROM</th>
                                                        <?php
                                                        }
                                                        ?>
														<th>Price (RM)</th>
                                                        <th>Stock Status</th>
														<th>Actions</th>
													</tr>
												</thead>
												<tbody>
                                                <?php
                                                    while($detail_row = mysqli_fetch_assoc($detail_res)){
                                                        $code = $detail_row['product_detail_code'];
                                                        $stock_result = mysqli_query($connect, "SELECT * FROM product_detail WHERE product_detail_code='$code'");
                                                        $price = array();
                                                        $stock = array();
                                                        while($stock_row = mysqli_fetch_assoc($stock_result)){
                                                            $price[] = $stock_row['product_price'];
                                                            $stock[] = $stock_row['product_stock1']+$stock_row['product_stock2']+$stock_row['product_stock3']+$stock_row['product_stock4']+$stock_row['product_stock5']+$stock_row['product_stock6'];
                                                        }
                                                        $total_stock = array_sum($stock);
                                                ?>
													<tr>
														<td><?php echo $i;?></td>
                                                        <?php 
                                                        if($row['cat_name'] == 'Audio' || $row['cat_name'] == 'Accessories'){}
                                                        else{
                                                        ?>
														    <td><?php echo $detail_row['product_capacity'];?></td>
                                                        <?php
                                                        }
                                                        ?>
														<td><?php echo $detail_row['product_price'];?></td>
                                                        <td>
															<b>
																<?php if($total_stock > 5){
																		echo '<span style="color:green;">Sufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																	else{
																		echo'<span style="color:red;">Insufficient</span>';
																		echo ' ('.$total_stock.')';
																	}
																?>
															</b>
														</td>
														<td>	
															<ul class="list-inline m-0">
																<li class="list-inline-item">
																	<a href="view-clearance-details-manager.php?view&code=<?php echo $detail_row['product_detail_code'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
																</li>
															</ul>
														</td>
													</tr>
                                                <?php
                                                        $i++;
                                                    }
                                                ?>
												</tbody>
											</table>
										</div>
									</form>
								</div>
							</div>
						</div>
                        <br><br>
                        <a href="all-clearance-manager.php" class="btn btn-primary buttonedit ml-2">Back to Clearance List</a>
					</div>
				</div>
			</div>
            <!-- /.container-fluid -->
            <!-- End of Main Content -->
			<br>
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

</body>

</html>
<?php
	}
?>


