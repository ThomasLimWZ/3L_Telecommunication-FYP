<!DOCTYPE html>
<html>
<head></head>
<body>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index-manager.php">
                <div class="sidebar-brand-icon">
                    <img src="css/logo_trans.png" alt="3L Logo" width="80px">
                </div>
                <div class="sidebar-brand-text mx-3">3L Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index-manager.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo">
                    <i class="fas fa-fw fa-address-card"></i>
                    <span>Admin</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-admin-manager.php">All Admin</a>
						<a class="collapse-item" href="add-admin-manager.php">Add Admin</a>
                    </div>
                </div>
            </li>
            
             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#brand_page">
                    <i class="fab fa-apple"></i>
                    <span>Brand</span>
                </a>
                <div id="brand_page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-brand-manager.php">All Brand</a>
						<a class="collapse-item" href="add-brand-manager.php">Add Brand</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#product_page">
                    <i class="far fa-keyboard"></i>
                    <span>Product</span>
                </a>
                <div id="product_page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-product-manager.php">All Product</a>
						<a class="collapse-item" href="add-product-manager.php">Add Product</a>
						<a class="collapse-item" href="all-deletedproduct-manager.php">Deleted Product Bin</a>
                    </div>
                </div>
            </li>

             <!-- Nav Item - Utilities Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#clearance_page">
                    <i class="fas fa-window-close"></i>
                    <span>Clearance</span>
                </a>
                <div id="clearance_page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-clearance-manager.php">All Clearance</a>
						<a class="collapse-item" href="all-deletedclearance-manager.php">Deleted Clearance Bin</a>
                    </div>
                </div>
            </li>
           

			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#customer_page">
                    <i class="fas fa-user"></i>
                    <span>Customer</span>
                </a>
                <div id="customer_page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
						<a class="collapse-item" href="all-customer-manager.php">All Customer</a>
                    </div>
                </div>
            </li>
		
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#order_page">
                    <i class="fas fa-file-invoice">
					</i><span>&nbsp; Order</span>
                </a>
                <div id="order_page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-order-manager.php">All Order</a>
                    </div>
                </div>
            </li>
			
			<li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#sale-page">
                    <i class="fas fa-file-invoice-dollar">
					</i><span>&nbsp; Sales</span>
                </a>
                <div id="sale-page" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="all-sales-manager.php">All Sales</a>
                    </div>
                </div>
            </li>
			
			
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Others
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            
			<li class="nav-item">
                <a class="nav-link collapsed" href="profile-manager.php">
                    <i class="fas fa-folder"></i>
                    <span>Profile</span>
                </a>
            </li>
        </ul>
</body>
</html>