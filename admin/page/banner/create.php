<?php
include('../library/banner_lib.php');
include('../library/checkroles.php');
 protectPathAccess();
$banner = new Banner();
// $category = new Category();
// $categories = $category->getCategories();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $bannerName = $_POST['title'];
    $bannerLink = $_POST['link'];
    // $price = $_POST['price'];
    // $stock = $_POST['stock'];
    // $categoryId = $_POST['category_id'];

    // Handle Image Upload
    $imagePath = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = "banner_image/";
        $imagePath = $uploadDir . basename($_FILES["image"]["name"]);
        move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
    }

    if ($banner->createBanner($bannerName, $imagePath, $bannerLink)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Banner could not be created.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Banner</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Create Banner</h2>

        <form action="create.php" method="POST" enctype="multipart/form-data">
            <!-- Banner Title -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Banner Title</label>
                <input type="text" name="title" required class="w-full px-3 py-2 border rounded-md">
            </div>

<!-- Banner Image -->
<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Upload Image</label>
    <?php if (!empty($bannerData['image'])): ?>
        <img id="bannerPreviewImage" src="<?= htmlspecialchars($bannerData['image']) ?>" alt="Current Banner Image"
            class="h-24 w-24 object-cover rounded-full mb-3 border border-gray-300 shadow-sm">
    <?php else: ?>
        <img id="bannerPreviewImage" src="https://via.placeholder.com/100" alt="Banner Preview"
            class="h-24 w-24 object-cover rounded-full mb-3 border border-gray-300 shadow-sm">
    <?php endif; ?>
    <input type="file" name="image" accept="image/*" onchange="previewBannerImage(event)"
           class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm 
           file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
</div>

<script>
    function previewBannerImage(event) {
        const image = document.getElementById('bannerPreviewImage');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                image.src = e.target.result;
            };
            reader.readAsDataURL(file);
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
                Create Banner
            </button>
        </form>
    </div>
</body>
</html>
