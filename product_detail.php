<?php 
  include "./admin/page/library/product_lib.php";
  include "./admin/page/library/db.php";

  if (!isset($_GET['id'])) {
    echo "Product ID not provided.";
    exit;
  }

  $productObj = new Product();
  $product = $productObj->getProductById($_GET['id']);

  if (!$product) {
    echo "Product not found.";
    exit;
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?= htmlspecialchars($product['name']) ?> | Product Detail</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
<?php include 'navbar.php' ?>
  <main class="container mx-auto px-4 py-12">
    <div class="grid md:grid-cols-2 gap-10 items-start">
      
      <!-- Product Image -->
      <div class="w-full overflow-hidden rounded-2xl shadow">
        <?php if (!empty($product['image'])): ?>
          <img src="<?= '/ministore/admin/page/product/product_image/' . htmlspecialchars($product['image']) ?>" 
               alt="<?= htmlspecialchars($product['name']) ?>" 
               class="w-full h-[400px] object-cover">
        <?php else: ?>
          <div class="w-full h-[400px] bg-gray-200 flex items-center justify-center text-gray-400">
            No Image
          </div>
        <?php endif; ?>
      </div>

      <!-- Product Info -->
      <div>
        <h1 class="text-3xl font-bold mb-3"><?= htmlspecialchars($product['name']) ?></h1>
        <p class="text-gray-500 text-sm mb-2">Category: <span class="capitalize"><?= htmlspecialchars($product['category_name']) ?></span></p>
        <p class="text-blue-600 text-2xl font-semibold mb-4">$<?= htmlspecialchars(number_format($product['price'], 2)) ?></p>
        
        <p class="text-gray-700 mb-6"><?= htmlspecialchars($product['description']) ?></p>

        <?php if ($product['stock'] > 0): ?>
          <button class="bg-blue-600 text-white px-6 py-3 rounded-full shadow hover:bg-blue-700 transition">
            Add to Cart
          </button>
        <?php else: ?>
          <div class="text-red-500 font-bold">Out of Stock</div>
        <?php endif; ?>
      </div>
    </div>
  </main>

</body>
</html>
