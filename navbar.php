<?php 
session_start(); 
include('./admin/page/library/users_lib.php');
include('./admin/page/library/brand_lib.php');
$cart = $_SESSION['cart'] ?? [];
$cartCount = array_sum(array_column($cart, 'quantity'));
$currentPage = basename($_SERVER['PHP_SELF']);

$brandLib = new Brand();
$brands = $brandLib->getBrand();
$userLib = new User();
$userId = $_SESSION['user_id'] ?? null;

$user = $userLib->getUserByID($userId);

// Safely resolve profile image path
$profileImage = $user['profile'] ?? 'default.png';
$profilePath = '/ministore/admin/page/user/user_image/' . htmlspecialchars($profileImage);

// Check if file exists
$fullPath = $_SERVER['DOCUMENT_ROOT'] . $profilePath;
if (!file_exists($fullPath)) {
    $profilePath = '/ministore/admin/page/user/user_image/default.png';
}
?>
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- NAVBAR -->
<nav class="bg-green-600 shadow border-gray-200">
  <div class="container mx-auto px-4 lg:px-16 flex items-center justify-between py-4">

    <!-- Brand section: show on all screens -->
    <?php if (!empty($brands)): ?>
      <div class="flex items-center gap-3">
        <?php foreach ($brands as $brand): ?>
          <a href="<?= htmlspecialchars((string) $brand['link']) ?>" class="flex items-center gap-2">
            <img src="/ministore/admin/page/brand/<?= htmlspecialchars((string) $brand['brand_image']) ?>" 
                 alt="<?= htmlspecialchars((string) $brand['brand_name']) ?>" 
                 class="w-10 h-10 object-cover rounded-full border-2 border-white" />
            <span class="text-xl font-semibold text-white"><?= htmlspecialchars((string) $brand['brand_name']) ?></span>
          </a>
          <?php break; // Only show first brand ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <!-- Desktop Nav Items aligned right -->
    <div class="hidden lg:flex items-center space-x-6 ml-auto">
      <a href="index.php" class="<?= $currentPage === 'index.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Home</a>
      <a href="product.php" class="<?= $currentPage === 'product.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Products</a>
      <a href="about.php" class="<?= $currentPage === 'about.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">About</a>
      <a href="contact.php" class="<?= $currentPage === 'contact.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Contact</a>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center space-x-4 ml-4">
      <!-- Search (Desktop) -->
      <form action="search.php" method="GET" class="relative hidden lg:block">
        <input type="text" name="q" placeholder="Search..."
               class="pl-3 pr-10 py-2 border border-white rounded-full focus:outline-none focus:ring focus:border-blue-400 w-64">
        <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-blue-500 p-2 rounded-full text-white hover:bg-blue-600 focus:outline-none">
          <i class="fas fa-search"></i>
        </button>
      </form>

      <!-- Cart -->
      <a href="cart.php" class="relative">
        <i class="fas fa-shopping-cart text-xl text-white"></i>
        <span id="cart-count" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1.5 py-0.5">
        <?= isset($_SESSION['cart']) ? array_sum(array_column($_SESSION['cart'], 'quantity')) : 0 ?>
        </span>
      </a>

      <!-- Profile (Desktop only) -->
      <div class="relative hidden lg:block">
        <?php if ($userId): ?>
          <button id="profileMenuBtn" class="text-white hover:text-blue-600 flex items-center gap-2 focus:outline-none">
            <img src="<?= $profilePath ?>" 
                 alt="Profile"
                 title="<?= htmlspecialchars($user['username'] ?? 'User') ?>"
                 class="w-8 h-8 object-cover rounded-full border-2 border-white">
            <i class="fas fa-chevron-down text-sm"></i>
          </button>
          <div id="profileDropdown" class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-md hidden z-50">
            <a href="/ministore/admin/page/user/profile.php" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
            <a href="./include/logout.php" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Logout</a>
          </div>
        <?php else: ?>
          <a href="./include/login.php" class="text-white hover:text-blue-600 flex items-center gap-2">
            <i class="fas fa-user text-xl"></i>
            <span>Login</span>
          </a>
        <?php endif; ?>
      </div>

      <!-- Mobile Menu Icon -->
      <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </div>
  </div>

  <!-- Mobile Menu -->
  <div id="mobile-menu" class="hidden lg:hidden px-6 pb-4 space-y-3 bg-green-600 text-white">
    <a href="index.php" class="block hover:text-blue-300">Home</a>
    <a href="product.php" class="block hover:text-blue-300">Products</a>
    <a href="about.php" class="block hover:text-blue-300">About</a>
    <a href="contact.php" class="block hover:text-blue-300">Contact</a>

    <!-- Auth -->
    <?php if ($userId): ?>
      <a href="/ministore/admin/page/user/profile.php" class="block hover:text-blue-300">Profile</a>
      <a href="./include/logout.php" class="block hover:text-red-400">Logout</a>
    <?php else: ?>
      <a href="./include/login.php" class="block hover:text-blue-300">Login</a>
    <?php endif; ?>

    
    <!-- Mobile Search -->
    <form action="search.php" method="GET" class="relative">
      <input type="text" name="q" placeholder="Search..." class="w-full pl-3 pr-10 py-2 rounded-full border border-white text-black">
      <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 text-green-700">
        <i class="fas fa-search"></i>
      </button>
    </form>

  </div>
</nav>

<!-- JavaScript for toggles -->
<script>
  // Mobile menu toggle
  const toggleBtn = document.getElementById('menu-toggle');
  const mobileMenu = document.getElementById('mobile-menu');
  toggleBtn.addEventListener('click', () => {
    mobileMenu.classList.toggle('hidden');
  });

  // Profile dropdown toggle
  const profileMenuBtn = document.getElementById('profileMenuBtn');
  const profileDropdown = document.getElementById('profileDropdown');
  if (profileMenuBtn) {
    profileMenuBtn.addEventListener('click', (e) => {
      e.stopPropagation();
      profileDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
      if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
        profileDropdown.classList.add('hidden');
      }
    });
  }
</script>
