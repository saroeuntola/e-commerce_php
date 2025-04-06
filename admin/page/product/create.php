<?php
include('../library/product_lib.php');
include('../library/category_lib.php');
include('../library/checkroles.php');
 protectPathAccess();
$product = new Product();
$category = new Category();
$categories = $category->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $categoryId = $_POST['category_id'];

    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "product_image/";
        $imagePath = $uploadDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    if ($product->createProduct($productName, $imagePath, $description, $price, $stock, $categoryId)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Product could not be created.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Create Product</h2>

        <form action="create.php" method="POST" enctype="multipart/form-data">
            <!-- Product Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Product Name</label>
                <input type="text" name="name" required class="w-full px-3 py-2 border rounded-md">
            </div>

            <!-- Product Image -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" name="image" accept="image/*" class="w-full px-3 py-2 border rounded-md">
            </div>

            <!-- Description -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Description</label>
                <textarea name="description" rows="3" class="w-full px-3 py-2 border rounded-md"></textarea>
            </div>

            <!-- Price -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Price ($)</label>
                <input type="number" name="price" step="0.01" required class="w-full px-3 py-2 border rounded-md">
            </div>

            <!-- Stock -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Stock Quantity</label>
                <input type="number" name="stock" required class="w-full px-3 py-2 border rounded-md">
            </div>

            <!-- Category Dropdown -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Category</label>
                <select name="category_id" required class="w-full px-3 py-2 border rounded-md">
                    
                    <option value="">Select Category</option>
                        <?php
                        foreach ($categories as $categorys) {
                            echo "<option value='{$categorys['id']}'>{$categorys['name']}</option>";
                        }
                        ?>   
                   
                </select>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Create Product
            </button>
        </form>
    </div>
</body>
</html>
