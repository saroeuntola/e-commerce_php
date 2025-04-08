
	
	<div class="scrollbar-inner sidebar-wrapper">
					<div class="user">
						<div class="photo">
							
						</div>
						<div class="info">
							<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $_SESSION['username']; ?>
									<span class="user-level">Administrator</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>

							<div class="collapse in" id="collapseExample" aria-expanded="true" style="">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">My Profile</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Edit Profile</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Settings</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
<ul class="nav">
    <!-- Dashboard Link -->
    <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == '/ministore/admin/index.php') ? 'active' : ''; ?>">
        <a href="/ministore/admin/index.php">
            <i class="la la-dashboard"></i>
            <p>Dashboard</p>
            <span class="badge badge-count">5</span>
        </a>
    </li>

    <!-- Products Link -->
    <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'page/product/index.php') !== false) ? 'active' : ''; ?>">
        <a href="/ministore/admin/page/product/index.php">
            <i class="la la-table"></i>
            <p>Products</p>
            <span class="badge badge-count">14</span>
        </a>
    </li>

    <!-- Categories Link -->
    <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'page/category/index.php') !== false) ? 'active' : ''; ?>">
        <a href="/ministore/admin/page/category/index.php">
            <i class="la la-keyboard-o"></i>
            <p>Category</p>
            <span class="badge badge-count">50</span>
        </a>
    </li>

    <!-- Banner Link -->
    <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'banner') !== false) ? 'active' : ''; ?>">
        <a href="/ministore/admin/page/banner/index.php">
            <i class="la la-th"></i>
            <p>Banner</p>
            <span class="badge badge-count">6</span>
        </a>
    </li>

    <!-- Brand Link -->
    <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'brand') !== false) ? 'active' : ''; ?>">
        <a href="/ministore/admin/page/brand/index.php">
            <i class="la la-th"></i>
            <p>Brand</p>
            <span class="badge badge-count">6</span>
        </a>
    </li>

    <!-- Users Link -->
    <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'users') !== false) ? 'active' : ''; ?>">
        <a href="#">
            <i class="la la-bell"></i>
            <p>Users</p>
            <span class="badge badge-success">3</span>
        </a>
    </li>
</ul>


</div>