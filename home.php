<?php 
  include "./admin/page/library/product_lib.php";
  include "./admin/page/library/category_lib.php";
  include "./admin/page/library/banner_lib.php";
  $productObj = new Product();
  $categoryObj = new Category();
  $bannerObj = new Banner();
  $categories = $categoryObj->getCategories();
  $products = $productObj->getProducts();
  $banners = $bannerObj->getBanner();
?>

<main>
 <!-- Banner Slideshow -->
<section class="relative w-full h-[400px] overflow-hidden">
  <div id="slide-container" class="w-full h-full relative">
    <?php if (!empty($banners)): ?>
      <img src="<?= '/ministore/admin/page/banner/' . htmlspecialchars($banners[0]['image']) ?>" class="w-full h-full object-cover" id="slide-image">
    <?php else: ?>
      <div class="w-full h-full bg-gray-300 flex items-center justify-center text-gray-700 text-lg">
        No Banner Available
      </div>
    <?php endif; ?>
  </div>

  <!-- Prev Button -->
  <button id="prevBtn"
    class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow transition">
    <i class="fas fa-chevron-left"></i>
  </button>

  <!-- Next Button -->
  <button id="nextBtn"
    class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-2 rounded-full shadow transition">
    <i class="fas fa-chevron-right"></i>
  </button>
</section>


  <!-- Features -->
  <section class="container mx-auto px-4 py-12 text-center">
    <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-6">
      <div>
        <i class="fas fa-truck fa-2x text-blue-600 mb-2"></i>
        <h4 class="font-bold">Fast Delivery</h4>
        <p class="text-sm text-gray-600">Get your products in no time.</p>
      </div>
      <div>
        <i class="fas fa-credit-card fa-2x text-blue-600 mb-2"></i>
        <h4 class="font-bold">Secure Payments</h4>
        <p class="text-sm text-gray-600">Safe and encrypted checkout.</p>
      </div>
      <div>
        <i class="fas fa-tags fa-2x text-blue-600 mb-2"></i>
        <h4 class="font-bold">Best Deals</h4>
        <p class="text-sm text-gray-600">Affordable prices guaranteed.</p>
      </div>
      <div>
        <i class="fas fa-headset fa-2x text-blue-600 mb-2"></i>
        <h4 class="font-bold">24/7 Support</h4>
        <p class="text-sm text-gray-600">Always here to help.</p>
      </div>
    </div>
  </section>

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
  <p class="mb-3 text-xl font-semibold">Popular Products</p>
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



</main>

<!-- Filter Script -->
<script>
  const filterButtons = document.querySelectorAll('.filter-btn');
  const productCards = document.querySelectorAll('.product-card');

  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      const filter = button.getAttribute('data-filter');

      filterButtons.forEach(btn => btn.classList.remove('bg-blue-600', 'text-white'));
      button.classList.add('bg-blue-600', 'text-white');

      productCards.forEach(card => {
        if (filter === 'all' || card.classList.contains(filter)) {
          card.classList.remove('hidden');
        } else {
          card.classList.add('hidden');
        }
      });
    });
  });

  document.querySelectorAll(".add-to-cart-form").forEach((form) => {
  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const productId = form.getAttribute("data-product-id");
    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("quantity", 1); // Default quantity

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
        if (result.success) {
  Swal.fire({
    icon: "success",
    title: "Added to Cart!",
    text: result.message,
    timer: 1500,
    showConfirmButton: false,
  });

  // ✅ Update cart count dynamically
  const cartCountEl = document.getElementById("cart-count");
  if (cartCountEl && result.cartCount !== undefined) {
    cartCountEl.textContent = result.cartCount;
  }
}

      }
    } catch (error) {
      Swal.fire({
        icon: "error",
        title: "Error!",
        text: "Could not add to cart.",
      });
    }
  });
});


const banners = <?= json_encode(array_column($banners, 'image')) ?>;
  const slideImage = document.getElementById("slide-image");

  let currentIndex = 0;

  function showSlide(index) {
    if (banners.length === 0) return;
    slideImage.src = "/ministore/admin/page/banner/" + banners[index];
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % banners.length;
    showSlide(currentIndex);
  }

  function prevSlide() {
    currentIndex = (currentIndex - 1 + banners.length) % banners.length;
    showSlide(currentIndex);
  }

  document.getElementById("nextBtn").addEventListener("click", nextSlide);
  document.getElementById("prevBtn").addEventListener("click", prevSlide);

  // Auto slide every 5 seconds
  setInterval(nextSlide, 5000);



</script>

