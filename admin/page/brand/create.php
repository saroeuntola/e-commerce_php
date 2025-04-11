<?php
include('../library/brand_lib.php');
include('../library/checkroles.php');
 protectPathAccess();
$brand = new Brand();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brand_name'];
    $brandLink = $_POST['link'];
    // $price = $_POST['price'];
    // $stock = $_POST['stock'];
    // $categoryId = $_POST['category_id'];

    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['brand_image']) && $_FILES['brand_image']['error'] == 0) {
        $uploadDir = "brand_image/";
        $imagePath = $uploadDir . basename($_FILES["brand_image"]["name"]);
        move_uploaded_file($_FILES["brand_image"]["tmp_name"], $imagePath);
    }

    if ($brand->createBrand($brandName, $imagePath, $brandLink)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Brand could not be created.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Brand</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Create Brand</h2>

        <form action="create.php" method="POST" enctype="multipart/form-data">
            <!-- Brand Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Brand Name</label>
                <input type="text" name="brand_name" required class="w-full px-3 py-2 border rounded-md">
            </div>

<!-- Brand Image -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Upload Image</label>
    <?php if (!empty($brandData['brand_image'])): ?>
        <img id="previewImage" src="<?= htmlspecialchars($brandData['brand_image']) ?>" alt="Current Brand Image"
            class="h-24 w-24 object-cover rounded-full mb-3 border border-gray-300 shadow-sm">
    <?php else: ?>
        <img id="previewImage" src="https://via.placeholder.com/100" alt="Brand Preview"
            class="h-24 w-24 object-cover rounded-full mb-3 border border-gray-300 shadow-sm">
    <?php endif; ?>
    <input type="file" name="brand_image" accept="image/*" onchange="previewBrandImage(event)"
           class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm 
           file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
</div>

<script>
    function previewBrandImage(event) {
        const image = document.getElementById('previewImage');
        const file = event.target.files[0];

        if (file) {
            image.src = URL.createObjectURL(file);
        }
    }
</script>

            <!-- Link -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Link</label>
                <textarea name="link" rows="3" class="w-full px-3 py-2 border rounded-md"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md hover:bg-indigo-700">
                Create Brand
            </button>
        </form>
    </div>
</body>
</html>
