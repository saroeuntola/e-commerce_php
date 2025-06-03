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
    <!-- Profile Block -->
    <a href="/ministore/admin/page/user/profile.php" class="flex flex-col items-center bg-white p-4 rounded-2xl shadow-md mb-4">
        <?php if (!empty($user['profile'])): ?>
            <img src="/ministore/admin/page/user/user_image/<?php echo htmlspecialchars($user['profile']); ?>"
                 alt="User Avatar"
                 class="w-20 h-20 rounded-full object-cover shadow" />
        <?php else: ?>
            <div class="w-20 h-20 flex items-center justify-center rounded-full bg-gray-100 shadow">
                <i class="la la-user text-3xl text-gray-400"></i>
            </div>
        <?php endif; ?>

        <div class="mt-3 text-center">
            <h6 class="text-lg font-semibold text-gray-800">
                <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>
            </h6>
        </div>
    </a>

    <!-- Navigation -->
    <ul class="nav">
        <li class="nav-item <?php echo (basename($_SERVER['REQUEST_URI']) == 'index.php') ? 'active' : ''; ?>">
            <a href="/ministore/admin/index.php">
                <i class="la la-dashboard"></i>
                <p>Dashboard</p>
                <span class="badge badge-count">5</span>
            </a>
        </li>

        <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'page/product/index.php') !== false) ? 'active' : ''; ?>">
            <a href="/ministore/admin/page/product/index.php">
                <i class="la la-table"></i>
                <p>Products</p>
                <span class="badge badge-count">14</span>
            </a>
        </li>

        <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'page/category/index.php') !== false) ? 'active' : ''; ?>">
            <a href="/ministore/admin/page/category/index.php">
                <i class="la la-keyboard-o"></i>
                <p>Category</p>
                <span class="badge badge-count">50</span>
            </a>
        </li>

        <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'banner') !== false) ? 'active' : ''; ?>">
            <a href="/ministore/admin/page/banner/index.php">
                <i class="la la-th"></i>
                <p>Banner</p>
                <span class="badge badge-count">6</span>
            </a>
        </li>

        <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'brand') !== false) ? 'active' : ''; ?>">
            <a href="/ministore/admin/page/brand/index.php">
                <i class="la la-tags"></i>
                <p>Brand</p>
                <span class="badge badge-count">6</span>
            </a>
        </li>

        <li class="nav-item <?php echo (strpos($_SERVER['REQUEST_URI'], 'user/index.php') !== false) ? 'active' : ''; ?>">
            <a href="/ministore/admin/page/user/index.php">
                <i class="la la-users"></i>
                <p>Users</p>
                <span class="badge badge-success">3</span>
            </a>
        </li>

        <!-- Logout Link -->
        <li class="nav-item">
            <a href="/ministore/include/logout.php">
                <i class="la la-sign-out"></i>
                <p>Logout</p>
            </a>
        </li>
    </ul>
</div>
