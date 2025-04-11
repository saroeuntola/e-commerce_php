<?php
$userLib = new User();
$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    header("Location: login.php");
    exit;
}

$user = $userLib->getUser($userId);

?>
    <div class="scrollbar-inner sidebar-wrapper">
    <a href="/ministore/admin/page/user/profile.php" class="flex flex-col items-center bg-white p-4 rounded-2xl shadow-md mb-4">
    <?php if (!empty($user['profile'])): ?>
        <img src="/ministore/admin/page/user/user_image/<?php echo htmlspecialchars($user['profile']); ?>"
             alt="User Avatar"
             class="w-20 h-20 rounded-full object-cover shadow" />
    <?php else: ?>
        <div class="w-15 h-15 flex items-center justify-center rounded-full bg-gray-100 shadow">
            <i class="la la-user text-3xl text-gray-400"></i>
        </div>
    <?php endif; ?>

    <div class="mt-3 text-center">
        <h6 class="text-lg font-semibold text-gray-800">
            <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
        </h6>
    </div>
</a>


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
        <a href="/ministore/admin/page/user/index.php">
            <i class="la la-bell"></i>
            <p>Users</p>
            <span class="badge badge-success">3</span>
        </a>
    </li>
</ul>


</div>