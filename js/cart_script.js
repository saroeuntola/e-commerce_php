document.querySelectorAll(".add-to-cart-form").forEach((form) => {
  form.addEventListener("submit", async function (e) {
    e.preventDefault();
    const productId = form.getAttribute("data-product-id");
    const formData = new FormData();
    formData.append("product_id", productId);
    formData.append("quantity", 1); // Default quantity

    try {
      const response = await fetch("ministore/include/add_to_cart.php", {
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
      } else {
        Swal.fire({
          icon: "error",
          title: "Oops!",
          text: result.message,
          timer: 2000,
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
