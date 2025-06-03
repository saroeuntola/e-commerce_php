<?php 
  include "./admin/page/library/product_lib.php";
  include "./admin/page/library/category_lib.php";
  include "./admin/page/library/db.php";
  $productObj = new Product();
  $categoryObj = new Category();
  $categories = $categoryObj->getCategories();
  $products = $productObj->getProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <?php include 'navbar.php' ?>
<main>
  <!-- Hero / Banner -->
  <!-- <section class="bg-gradient-to-r from-blue-700 to-blue-500 text-white text-center py-16">
    <h1 class="text-5xl font-extrabold tracking-tight">Welcome to Our Store</h1>
    <p class="text-xl mt-4 opacity-90">Discover the latest trends & best deals</p>
  </section> -->

  <!-- Category Filter -->
  <section class="container mx-auto px-4 mt-10 text-center">
    <div class="inline-flex flex-wrap justify-center gap-3">
      <button class="filter-btn active bg-blue-600 text-white px-5 py-2 rounded-full transition hover:bg-blue-700" data-filter="all">All</button>
      <?php foreach ($categories as $category): ?>
        <?php $slug = strtolower(preg_replace('/\s+/', '', $category['name'])); ?>
        <button 
          class="filter-btn bg-gray-200 px-5 py-2 rounded-full transition hover:bg-blue-600 hover:text-white" 
          data-filter="<?= htmlspecialchars($slug) ?>">
          <?= htmlspecialchars($category['name']) ?>
        </button>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- Product Grid -->
  <section class="container mx-auto px-4 py-12">
    <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
      <?php foreach ($products as $product): ?>
        <?php $categorySlug = strtolower(preg_replace('/\s+/', '', $product['category_name'])); ?>
        <div class="product-card <?= htmlspecialchars($categorySlug) ?> group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition duration-300 relative">
          
          <?php if (!empty($product['image'])): ?>
            <img src="<?= '/ministore/admin/page/product/product_image' . htmlspecialchars($product['image']) ?>" 
                 alt="<?= htmlspecialchars($product['name']) ?>" 
                 class="w-full h-52 object-cover">
          <?php else: ?>
            <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-400">
              No Image
            </div>
          <?php endif; ?>

          <?php if ($product['stock'] == 0): ?>
            <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
              Out of Stock
            </div>
          <?php endif; ?>

          <div class="p-5 relative">
            <h3 class="text-lg font-semibold mb-1"><?= htmlspecialchars($product['name']) ?></h3>
            <p class="text-gray-500 text-sm mb-3 capitalize"><?= htmlspecialchars($product['category_name']) ?></p>
            <div class="text-blue-600 font-bold text-lg mb-3">$<?= htmlspecialchars(number_format($product['price'], 2)) ?></div>

            <?php if ($product['stock'] > 0): ?>
              <div class="absolute bottom-5 left-1/2 transform -translate-x-1/2 opacity-0 translate-y-2 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300">
                <button class="bg-blue-600 text-white px-5 py-2 rounded-full text-sm shadow-lg hover:bg-blue-700">
                  Add to Cart
                </button>
              </div>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- JS for Filter -->
  <script>
    const filterButtons = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');

    filterButtons.forEach(button => {
      button.addEventListener('click', () => {
        const filter = button.getAttribute('data-filter');

        // Toggle active button styles
        filterButtons.forEach(btn => btn.classList.remove('bg-blue-600', 'text-white'));
        button.classList.add('bg-blue-600', 'text-white');

        // Filter products
        productCards.forEach(card => {
          if (filter === 'all' || card.classList.contains(filter)) {
            card.classList.remove('hidden');
          } else {
            card.classList.add('hidden');
          }
        });
      });
    });
  </script>
</main>

</body>
</html>

