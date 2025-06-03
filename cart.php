<?php
session_start();
$cart = $_SESSION['cart'] ?? [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Your Cart</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
  <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6 text-gray-800">🛒 Your Shopping Cart</h2>

    <?php if (empty($cart)): ?>
      <p class="text-gray-500">No items in cart.</p>
    <?php else: ?>
      <div class="space-y-6">
        <?php foreach ($cart as $index => $item): ?>
          <div class="flex flex-col md:flex-row items-center md:items-start justify-between gap-4 border-b pb-4">
            <img src="<?= '/ministore/admin/page/product/product_image/' . htmlspecialchars($item['image']) ?>" 
                 alt="<?= htmlspecialchars($item['name']) ?>" 
                 class="w-24 h-24 object-cover rounded-lg border">

            <div class="flex-1">
              <h3 class="text-lg font-semibold text-gray-800"><?= htmlspecialchars($item['name']) ?></h3>
              <p class="text-sm text-gray-500 mt-1">Price: $<?= number_format($item['price'], 2) ?></p>

              <!-- Quantity Controls -->
              <div class="mt-3 flex items-center gap-2">
              <form onsubmit="updateCartQuietly(event, <?= $index ?>, 'decrease')" class="flex items-center gap-1">
  <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 text-xl">−</button>
</form>


                <span class="px-3 py-1 border rounded-md bg-gray-100"><?= $item['quantity'] ?></span>

                <form onsubmit="updateCartQuietly(event, <?= $index ?>, 'increase')" class="flex items-center gap-1">
  <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-full bg-gray-200 hover:bg-gray-300 text-xl">+</button>
</form>

              </div>
            </div>

            <!-- Total for this item -->
            <div class="text-blue-600 font-bold text-lg">
              $<?= number_format($item['price'] * $item['quantity'], 2) ?>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

    <!-- Cart Total -->
<div class="mt-6 text-right text-xl font-bold text-gray-700">
  Total: $
  <?= number_format(array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart)), 2) ?>
</div>

<!-- Action Buttons -->
<div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
  <a href="index.php" class="px-6 py-3 rounded-full bg-gray-200 text-gray-700 hover:bg-gray-300 transition text-sm font-semibold">
    ← Back to Home
  </a>
  
  <a href="checkout.php" class="px-6 py-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition text-sm font-semibold">
    Proceed to Checkout →
  </a>
</div>

    <?php endif; ?>
  </div>

  <script>
function updateCartQuietly(event, index, action) {
  event.preventDefault();

  fetch('./include/update_cart.php', {
    method: 'POST',
    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
    body: `index=${index}&action=${action}`
  })
  .then(() => {
    window.location.reload();
  });
}
</script>
</body>
</html>
