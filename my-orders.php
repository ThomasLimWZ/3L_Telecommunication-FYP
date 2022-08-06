<?php include("header-login.php"); ?>	
<style>
.card {
  transition: box-shadow .3s;
}
.card:hover {
  box-shadow: 0 0 11px rgba(33,33,33,.2); 
}
</style>
		<div class="container">
			<br>
			<hr class="mb-2">
			<h1 style="text-align:center;"><b>My Orders</b></h1>
			<hr class="mb-2">
			<br>
			
			
			<?php
				$payment_res = mysqli_query($connect,"SELECT * FROM payment WHERE cus_email='$cus_email' ORDER BY payment_date DESC");
				$count = mysqli_num_rows($payment_res);
				if($count != 0){
					while($payment_row = mysqli_fetch_assoc($payment_res)){
						$pay_code = $payment_row['payment_code'];
						$ship_res = mysqli_query($connect,"SELECT * FROM shipping WHERE payment_code='$pay_code'");
						$ship_row = mysqli_fetch_assoc($ship_res);
						$order_res = mysqli_query($connect,"SELECT * FROM cart WHERE payment_code='$pay_code'");
						$cart_count = mysqli_num_rows($order_res);

						$date = date_create($payment_row['payment_date']);
						$dateFormat = date_format($date,"d-m-Y H:i:s");
			?>
				<div class="card shadow-0 border mb-4">
					<div class="card-body">
						<div class="row" style="padding-top:10px; font-size:18pt;">
							<div class="col-md-2">
								<h4 class="text-muted mb-0">INVOICE #<?php echo $payment_row['payment_code'];?></h4>
							</div>
							<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
								<p class="text-muted mb-0"></p>
							</div>
							<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
								<p class="text-muted mb-0 small"></p>
							</div>
							<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
								<p class="text-muted mb-0 small"></p>
							</div>
							<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
								<p class="text-muted mb-0 small"></p>
							</div>
							<div class="col-md-2 text-center d-flex justify-content-center align-items-center">
								<p class="text-muted mb-0 small"><b>RM <?php echo $payment_row['payment_total'];?></b></p>

							</div>
						</div>
						<div class="row" style="padding-top:10px; font-size:18pt;">
							<div class="col-md-2">
								<p class="text-muted mb-0">Created:<br> <b><?php echo $payment_row['payment_date'];?></b></p>
							</div>
							<div class="col-md-10" style="text-align:right;">
								<a href="order-details.php?details&code=<?php echo $payment_row['payment_code'];?>" class="btn btn-primary" style="border-radius:10px; color:white;">Show Details</a>
							</div>
						</div>
						<hr class="mb-2" style="background-color: #e0e0e0; opacity: 1;">
						<div class="row d-flex align-items-center">
						<?php
						if($ship_row['delivery_status'] == 0){
						?>
							<div class="col-md">
								<div class="progress" style="height: 6px; border-radius: 16px;">
									<div class="progress-bar"
										role="progressbar"
										style="width: 3%; border-radius: 20px; background-color: #39f;">
									</div>
								</div>
								<div class="d-flex">
									<p class="text-muted mt-1 mb-0 medium ms-xl-5" style="padding-right:260px;">Preparing</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5" style="padding-right:260px;">Shipped Out</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5" style="padding-right:260px;">Out of Delivering</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Delivered</p>
								</div>
							</div>
						<?php
						}
						else if($ship_row['delivery_status'] == 1){
						?>
							<div class="col-md">
								<div class="progress" style="height: 6px; border-radius: 16px;">
									<div class="progress-bar"
										role="progressbar"
										style="width: 36%; border-radius: 20px; background-color: #39f;">
									</div>
								</div>
								<div class="d-flex justify-content-around mb-1">
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Preparing</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Shipped Out</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Out of Delivering</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Delivered</p>
								</div>
							</div>
						<?php
						}
						else if($ship_row['delivery_status'] == 2){
						?>
							<div class="col-md">
								<div class="progress" style="height: 6px; border-radius: 16px;">
									<div class="progress-bar"
										role="progressbar"
										style="width: 65%; border-radius: 20px; background-color: #39f;">
									</div>
								</div>
								<div class="d-flex justify-content-around mb-1">
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Preparing</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Shipped Out</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Out of Delivering</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Delivered</p>
								</div>
							</div>
						<?php
						}
						else if($ship_row['delivery_status'] == 3){
						?>
							<div class="col-md">
								<div class="progress" style="height: 6px; border-radius: 16px;">
									<div class="progress-bar"
										role="progressbar"
										style="width: 100%; border-radius: 20px; background-color: #39f;">
									</div>
								</div>
								<div class="d-flex justify-content-around mb-1">
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Preparing</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Shipped Out</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Out of Delivering</p>
									<p class="text-muted mt-1 mb-0 medium ms-xl-5">Delivered</p>
								</div>
							</div>
						<?php
						}
						?>
						</div>
					</div>
            	</div>
			<?php
					}
				}
				else{
				?>
					<div style="text-align:center; margin:auto;">
						<h4>No history orders.</h4>
						<a href="index-login.php" class="btn btn-primary" style="border-radius:10px; color:white; font-size:12pt;"><i class="fa fa-shopping-cart"></i>Shop</a>
					</div>
				<?php
				}
				?>
			<br><br>
		</div>
		
<?php include("footer-login.php"); ?>