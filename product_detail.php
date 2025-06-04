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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<?php include 'navbar.php'; ?>

<main class="container mx-auto px-20 py-12">
  <div class="grid lg:grid-cols-2 gap-12 items-start">

    <!-- Product Image -->
    <div class="w-full flex justify-center items-center">
      <?php if (!empty($product['image'])): ?>
        <img 
          src="<?= '/ministore/admin/page/product/' . htmlspecialchars($product['image']) ?>" 
          alt="<?= htmlspecialchars($product['name']) ?>" 
          class="w-90 h-[400px] md:h-[500px] object-cover object-center rounded-3xl transition-transform duration-300 hover:scale-105"
        >
      <?php else: ?>
        <div class="w-80 h-[400px] bg-gray-200 flex items-center justify-center text-gray-500 rounded-3xl">
          No Image Available
        </div>
      <?php endif; ?>
    </div>

    <!-- Product Details -->
    <div class="space-y-6 mt-4">
      <h1 class="text-4xl font-extrabold text-gray-900"><?= htmlspecialchars($product['name']) ?></h1>
      <p class="text-sm text-gray-500">Category: <span class="capitalize"><?= htmlspecialchars($product['category_name']) ?></span></p>
      <div class="text-3xl font-bold text-blue-600">$<?= htmlspecialchars(number_format($product['price'], 2)) ?></div>
      <p class="text-gray-700 leading-relaxed text-base max-w-prose break-words">
        <?= nl2br(htmlspecialchars($product['description'])) ?>
      </p>

      <?php if ($product['stock'] > 0): ?>
        <form class="add-to-cart-form" data-product-id="<?= $product['id'] ?>">
          <button 
            type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-full font-semibold shadow-lg transition duration-300 w-full sm:w-auto">
            Add to Cart
          </button>
        </form>
      <?php else: ?>
        <div class="text-red-500 font-semibold text-lg mt-4">Out of Stock</div>
      <?php endif; ?>
    </div>

  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
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

          const cartCountEl = document.getElementById("cart-count");
          if (cartCountEl && result.cartCount !== undefined) {
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
      }
    });
  });
});
</script>

</body>
</html>
