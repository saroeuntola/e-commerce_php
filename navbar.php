<?php 
session_start(); 
$cart = $_SESSION['cart'] ?? [];
$cartCount = array_sum(array_column($cart, 'quantity'));
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!-- NAVBAR -->
<nav class="bg-green-600 shadow border-gray-200">
    <div class="container mx-auto px-16 py-4 flex items-center justify-between">
        <!-- Logo -->
        <a href="index.php" class="text-2xl font-bold text-white">MyStore</a>

        <!-- Desktop menu -->
        <div class="hidden lg:flex items-center space-x-6">
        <a href="index.php" class="<?= $currentPage === 'index.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Home</a>

<a href="product.php" class="<?= $currentPage === 'product.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Products</a>

<a href="about.php" class="<?= $currentPage === 'about.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">About</a>

<a href="contact.php" class="<?= $currentPage === 'contact.php' ? 'text-blue-800 border-b-2 border-blue-800 font-semibold' : 'text-white hover:text-blue-800' ?>">Contact</a>

            <!-- Search bar -->
            <form action="search.php" method="GET" class="relative">
    <input type="text" name="q" placeholder="Search..."
           class="pl-3 pr-10 py-2 border border-white rounded-full focus:outline-none focus:ring focus:border-blue-400 w-64">

    <button type="submit" class="absolute right-1 top-1/2 transform -translate-y-1/2 bg-blue-500 p-2 rounded-full text-white hover:bg-blue-600 focus:outline-none">
        <i class="fas fa-search"></i>
    </button>
</form>


            <!-- Cart Icon -->
<a href="cart.php" class="text-white hover:text-blue-500 relative">
  <i class="fas fa-shopping-cart text-lg"></i>
  <?php if ($cartCount > 0): ?>
    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs w-5 h-5 flex items-center justify-center rounded-full">
      <?= $cartCount ?>
    </span>
  <?php endif; ?>
</a>

            <!-- Auth Section -->
            <?php if (isset($_SESSION['user_id'])): ?>
                <div class="relative">
                    <button id="profileMenuBtn" class="text-white hover:text-blue-600 flex items-center gap-2 focus:outline-none">
                        <img src="/ministore/admin/page/user/profile_image/<?php echo htmlspecialchars($_SESSION['profile_image'] ?? 'default.png'); ?>"
                             alt="Profile"
                             title="<?php echo htmlspecialchars($_SESSION['username']); ?>"
                             class="w-8 h-8 rounded-full object-cover border-2 border-white">
                        <i class="fas fa-chevron-down text-sm"></i>
                    </button>
                    <div id="profileDropdown" class="absolute right-0 mt-2 w-40 bg-white text-gray-700 rounded-md shadow-md hidden z-50">
                        <a href="/ministore/admin/page/user/profile.php" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <a href="settings.php" class="block px-4 py-2 hover:bg-gray-100">Settings</a>
                        <a href="./include/logout.php" class="block px-4 py-2 text-red-500 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="./include/login.php" class="text-white hover:text-blue-500">Login</a>
            <?php endif; ?>
        </div>

        <!-- Mobile menu toggle -->
        <button id="menu-toggle" class="lg:hidden text-white focus:outline-none">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden px-4 pb-4 space-y-2">
        <a href="index.php" class="block text-white hover:text-blue-500">Home</a>
        <a href="products.php" class="block text-white hover:text-blue-500">Products</a>
        <a href="about.php" class="block text-white hover:text-blue-500">About</a>
        <form action="search.php" method="GET" class="mt-2">
            <input type="text" name="q" placeholder="Search..."
                   class="w-full pl-3 pr-10 py-1 border border-white rounded-full focus:outline-none focus:ring focus:border-blue-400">
        </form>
        <a href="cart.php" class="block text-white hover:text-blue-500">Cart</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="/ministore/admin/page/user/profile.php" class="block text-white hover:text-blue-300">Profile</a>
            <a href="settings.php" class="block text-white hover:text-blue-300">Settings</a>
            <a href="./include/logout.php" class="block text-white hover:text-red-400">Logout</a>
        <?php else: ?>
            <a href="./include/login.php" class="block text-white hover:text-blue-500">Login</a>
        <?php endif; ?>
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
            e.stopPropagation(); // Prevent closing immediately
            profileDropdown.classList.toggle('hidden');
        });

        document.addEventListener('click', (e) => {
            if (!profileMenuBtn.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    }
</script>
