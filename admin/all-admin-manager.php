<?php
	include("connection.php");
	session_start();
	if(!isset($_SESSION['id']) || $_SESSION["position"] != "Manager"){
?>
<script>
	alert("Please log in");
</script>
<style>
.btn-success {background-color: #65B688;
			  border-color: #65B688;}
.btn-danger {color: #fff;
		     background-color: #d9534f;
		     border-color: #d43f3a;}
</style>
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

	<!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
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

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Admin</h1><a href="add-admin-manager.php" class="btn btn-primary float-right veiwbutton">Add Admin</a>
                    </div>

                    <!-- Content Row -->
					<div class="page-wrapper">
						<div class="content container-fluid">
							<div class="row">
								<div class="col-lg-12">
								<form method="GET" action="">
										<div class="row formtype">
											<div class="col-md-3">
												<div class="form-group">
													<label>Admin Status &nbsp;</label> <a href="all-admin-manager.php"><i style="color:black;" class="fa">&#xf021;</i></a>
													<select class="form-control" name="status" id="status" onchange="filterStatus()">
														<option disabled selected>Select</option>
														<option value="0" >Inactive</option>
														<option value="1" >Active</option>
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label>Filter</label> <button type="submit" id="filterbtn" name="filterbtn" class="btn btn-success btn-block mt-0 search_button" disabled> Search </button> 
												</div>
											</div>
										</div>
									</form>
								</div>
							</div>
							<br/>
							<div class="row">
								<div class="col-sm-12">
									<div class="card card-table">
									<div class="card-body">
											<table class="datatable table table-stripped table table-hover table-center mb-0" id="dataTable" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Admin ID</th>
													<th>Name</th>
													<th style="width:50px;">Picture</th>
													<th>Phone Number</th>
													<th>Position</th>
													<th>Join Date</th>
													<th>Status</th>
													<th>Actions</th>
												</tr>
											</thead>
											<tbody>
											<?php
												if(isset($_GET["filterbtn"])){
													$adm_filter = $_GET["status"];
													$result = mysqli_query($connect, "SELECT * FROM admin WHERE adm_status='$adm_filter'");
														
													while($row = mysqli_fetch_assoc($result)){
											?>
												<tr>
													<td><?php echo $row['adm_id']; ?></td>
													<td><?php echo $row['adm_name']; ?></td>
													<td style="text-align: center;">
														<?php
															if(empty($row['adm_profile_pic'])){
														?>
																<a class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="img/undraw_profile.svg" alt="Admin Image" width="50px" height="50px"></a>
														<?php
															}
															else{
														?>
															<a class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="admin-profile-pic/<?=$row['adm_profile_pic']?>" alt="Admin Image" width="50px" height="50px"></a>
														<?php
															}
														?>
													</td>
													<td><?php echo $row['adm_phone']; ?></td>
													<td><?php echo $row['adm_position']; ?></td>
													<td><?php $date = date_create($row['adm_join_date']);echo date_format($date,"d-m-Y");?></td>
													<td>
													<?php
                                                            if(($row['adm_status'])=='0')
                                                            {
                                                            ?>
                                                            <i><a href="all-admin-manager.php?status&id=<?php echo $row['adm_id'];?>" 
                                                            class="btn btn-danger buttonedit ml-2"  onclick="return confirm('Are u sure to activate <?php echo $row['adm_id']?>?');"> Inactive </a></i>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <i><a href="all-admin-manager.php?status&id=<?php echo $row['adm_id'];?>" 
                                                            class="btn btn-success buttonedit ml-2" onclick="return confirm('Are u sure to de-activate <?php echo $row['adm_id']?>?');">Avtive</a></i>
                                                            <?php
                                                            }
                                                            ?>
													</td>
													<td>
													<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="view-admin-manager.php?view&id=<?php echo $row['adm_id'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
															</li>
															<li class="list-inline-item">
																<a href="edit-admin-manager.php?edit&id=<?php echo $row['adm_id'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
															</li>
														</ul>
													</td>
												</tr>
												<?php
													}
												}
												else{
													$result = mysqli_query($connect, "SELECT * FROM admin");
														
													while($row = mysqli_fetch_assoc($result)){
														$adm_id = $row['adm_id'];
														$adm = mysqli_query($connect, "SELECT * FROM admin WHERE adm_id = '$adm_id'");
												?>
												<tr>
													<td><?php echo $row['adm_id']; ?></td>
													<td><?php echo $row['adm_name']; ?></td>
													<td style="text-align: center;">
														<?php
															if(empty($row['adm_profile_pic'])){
														?>
																<a class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="img/undraw_profile.svg" alt="Admin Image" width="50px" height="50px"></a>
														<?php
															}
															else{
														?>
															<a class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="admin-profile-pic/<?=$row['adm_profile_pic']?>" alt="Admin Image" width="50px" height="50px"></a>
														<?php
															}
														?>
													</td>
													<td><?php echo $row['adm_phone']; ?></td>
													<td><?php echo $row['adm_position']; ?></td>
													<td><?php $date = date_create($row['adm_join_date']);echo date_format($date,"d-m-Y");?></td>
													<td>
													<?php
                                                            if(($row['adm_status'])=='0')
                                                            {
                                                            ?>
                                                            <i><a href="all-admin-manager.php?status&id=<?php echo $row['adm_id'];?>" 
                                                            class="btn btn-danger buttonedit ml-2"  onclick="return confirm('Are u sure to activate <?php echo $row['adm_id']?>?');"> Inactive </a></i>
                                                            <?php
                                                            }
                                                            else
                                                            {
                                                            ?>
                                                            <i><a href="all-admin-manager.php?status&id=<?php echo $row['adm_id'];?>" 
                                                            class="btn btn-success buttonedit ml-2" onclick="return confirm('Are u sure to de-activate <?php echo $row['adm_id']?>?');">Active</a></i>
                                                            <?php
                                                            }
                                                            ?>
													</td>
													<td>
													<!-- Call to action buttons -->
														<ul class="list-inline m-0">
															<li class="list-inline-item">
																<a href="view-admin-manager.php?view&id=<?php echo $row['adm_id'];?>"><button class="btn btn-primary btn-sm rounded-0" type="button" title="View"><i class="fa fa-eye"></i></button></a>
															</li>
															<li class="list-inline-item">
																<a href="edit-admin-manager.php?edit&id=<?php echo $row['adm_id'];?>"><button class="btn btn-success btn-sm rounded-0" type="button" title="Edit"><i class="fa fa-edit"></i></button></a>
															</li>
														</ul>
													</td>
												</tr>
												<?php
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
				</div>
			</div>
		</div>
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

	<!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>  
	
</body>

</html>


<script type="text/javascript">
	function filterStatus(){
		var select = document.getElementById('status');
		var selected = select.options[select.selectedIndex].value;

		if(selected == "Select")
			document.getElementById("filterbtn").disabled=true;
		else
			document.getElementById("filterbtn").disabled=false;
	}

</script>
<?php
if(isset($_GET['status']))
{
    $id=$_GET['id'];
    $select=mysqli_query($connect,"SELECT * FROM admin where adm_id='$id'");
    while($row=mysqli_fetch_assoc($select))
    {
        $status=$row['adm_status'];
        if($status=='0')
        {
            $update=mysqli_query($connect,"UPDATE admin SET adm_status='1' where adm_id='$id' ");?>
<script>
	
	swal({
    title: "Status Updated!",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
	  	
</script>
<?php
        }
        else
        {
			if($id==$_SESSION['id']){
?>
<script>
	
	swal({
    title: "Deactivate own status is disallowed!",
	type: "warning"
	
 
	},function(isConfirm){
					alert('ok');
			});
			$('.swal2-confirm').click(function(){
					window.location.href = 'all-admin-manager.php';
			});
	  	
</script>
<?php
		
			}else
            {	$update=mysqli_query($connect,"UPDATE admin SET adm_status='0' where adm_id='$id'");
    	
?>
<script>
	
	swal({
    title: "Status Updated!",
	type: "success"
 
    
  },function(isConfirm){
                alert('ok');
          });
          $('.swal2-confirm').click(function(){
                window.location.href = 'all-admin-manager.php';
          });
	  	
</script>
<?php
        }
	}
       
    }
}}
mysqli_close($connect);
?>
