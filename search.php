<?php
include "./admin/page/library/product_lib.php";
include "./admin/page/library/db.php";

$productObj = new Product();

// Check if search query exists
$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$products = $query ? $productObj->searchProducts($query) : [];
?>

 <!-- Adjust this to your layout -->
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

<?php include 'navbar.php'; ?>
<main>
  <!-- Banner -->
  <section class="bg-gradient-to-r from-blue-700 to-blue-500 text-white text-center py-14">
    <h1 class="text-4xl font-bold">Search Results</h1>
    <p class="text-lg mt-2">Showing results for: <span class="font-semibold"><?= htmlspecialchars($query) ?></span></p>
  </section>

  <!-- Results -->
  <section class="container mx-auto px-4 py-12">
    <?php if ($query && count($products) > 0): ?>
      <div class="grid gap-8 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
        <?php foreach ($products as $product): ?>
          <div class="group bg-white rounded-2xl shadow hover:shadow-xl overflow-hidden transition relative">
            <!-- Product Image -->
            <?php if (!empty($product['image'])): ?>
              <img src="<?= '/ministore/admin/page/product/product_image/' . htmlspecialchars($product['image']) ?>"
                   alt="<?= htmlspecialchars($product['name']) ?>"
                   class="w-full h-52 object-cover">
            <?php else: ?>
              <div class="w-full h-52 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
            <?php endif; ?>

            <!-- Out of Stock Label -->
            <?php if ($product['stock'] == 0): ?>
              <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full">
                Out of Stock
              </div>
            <?php endif; ?>

            <!-- Product Info -->
            <div class="p-5 relative">
              <h3 class="text-lg font-semibold"><?= htmlspecialchars($product['name']) ?></h3>
              <p class="text-gray-500 text-sm capitalize"><?= htmlspecialchars($product['category_name']) ?></p>
              <div class="text-blue-600 font-bold text-lg mt-2">$<?= number_format($product['price'], 2) ?></div>

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
    <?php elseif ($query): ?>
      <div class="text-center text-gray-600">
        <p class="text-lg">No products found for "<strong><?= htmlspecialchars($query) ?></strong>".</p>
        <a href="index.php" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">Back to Products</a>
      </div>
    <?php else: ?>
      <p class="text-center text-gray-500 text-lg">Please enter a search query.</p>
    <?php endif; ?>
  </section>
</main>

</body>
</html>

