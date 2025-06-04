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
    <section class="container mx-auto px-16 py-12">
  
  <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
    <?php foreach ($products as $product): ?>
      <?php $categorySlug = strtolower(preg_replace('/\s+/', '', $product['category_name'])); ?>
      <div class="product-card <?= htmlspecialchars($categorySlug) ?> group bg-white rounded-2xl shadow-md hover:shadow-xl overflow-hidden transition duration-300 relative">
        
        <!-- Image and Hover Buttons -->
        <div class="relative">
          <?php if (!empty($product['image'])): ?>
            <img src="<?= '/ministore/admin/page/product/' . htmlspecialchars($product['image']) ?>" 
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

          <?php if ($product['stock'] > 0): ?>
            <!-- Hover buttons inside image -->
            <div class="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 group-hover:opacity-100 transition-all duration-300">
  <div class="flex gap-3">
  <form class="add-to-cart-form" data-product-id="<?= $product['id'] ?>">
      <button type="submit" class="bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-semibold shadow hover:bg-blue-600 hover:text-white transition">
        Add to Cart
      </button>
    </form>
    <a href="product_detail.php?id=<?= $product['id'] ?>" class="bg-white text-blue-600 px-4 py-2 rounded-full text-sm font-semibold shadow hover:bg-blue-600 hover:text-white transition">
      View
    </a>
  </div>
</div>

          <?php endif; ?>
        </div>

        <!-- Product Info -->
        <div class="p-5">
          <h3 class="text-lg font-semibold mb-1"><?= htmlspecialchars($product['name']) ?></h3>
          <p class="text-gray-500 text-sm mb-3 capitalize"><?= htmlspecialchars($product['description']) ?></p>
          <div class="text-blue-600 font-bold text-lg mb-3">$<?= htmlspecialchars(number_format($product['price'], 2)) ?></div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- JS for Filter -->
  <script>

document.addEventListener('DOMContentLoaded', () => {
  // Handle Add to Cart submission
  document.querySelectorAll(".add-to-cart-form").forEach((form) => {
    form.addEventListener("submit", async function (e) {
      e.preventDefault();

      const productId = this.getAttribute("data-product-id");
      const formData = new FormData();
      formData.append("product_id", productId);
      formData.append("quantity", 1);

      try {
        const response = await fetch("./include/add_to_cart.php", {
          method: "POST",
          body: formData,
        });

        const result = await response.json();

        if (result.success) {
          Swal.fire({
            icon: "success",
            title: "Added to Cart!",
            text: result.message,
            timer: 1500,
            showConfirmButton: false,
          });

          // Update cart count
          const cartCountEl = document.getElementById("cart-count");
          if (cartCountEl && typeof result.cartCount !== "undefined") {
            cartCountEl.textContent = result.cartCount;
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Oops!",
            text: result.message,
          });
        }
      } catch (error) {
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "Could not add to cart.",
        });
        console.error("Add to cart failed:", error);
      }
    });
  });

  // Filter logic
  const filterButtons = document.querySelectorAll('.filter-btn');
  const productCards = document.querySelectorAll('.product-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      const filter = button.getAttribute('data-filter');

      // Toggle active class
      filterButtons.forEach(btn => btn.classList.remove('bg-blue-600', 'text-white'));
      button.classList.add('bg-blue-600', 'text-white');

      // Show/Hide products
      productCards.forEach(card => {
        if (filter === 'all' || card.classList.contains(filter)) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });
});

  </script>
</main>

</body>
</html>

