<?php
ob_start(); // Start output buffering to prevent header issues
include('../library/brand_lib.php');
include('../library/checkroles.php');

protectPathAccess();

$brand = new Brand();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $brandData = $brand->getBrandById($id);
    if (!$brandData) {
        die("Brand not found");
    }
} else {
    die("Invalid brand ID");
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $brandName = $_POST['brand_name'];
    $link = $_POST['link'];

    // Handle Image Upload
    $imagePath = $brandData['brand_image'] ?? ''; // Default to the existing image
    if (isset($_FILES['brand_image']) && $_FILES['brand_image']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = "brand_image/";
        
        // Ensure the upload directory exists and is writable
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }
        if (!is_writable($uploadDir)) {
            die("Upload directory is not writable: $uploadDir");
        }

        // Generate a unique filename to avoid overwriting
        $fileExtension = pathinfo($_FILES['brand_image']['name'], PATHINFO_EXTENSION);
        $uniqueFileName = uniqid('brand_', true) . '.' . $fileExtension;
        $imagePath = $uploadDir . $uniqueFileName;

        // Move the uploaded file
        if (!move_uploaded_file($_FILES['brand_image']['tmp_name'], $imagePath)) {
            echo "<p class='text-red-500'>Error: Failed to upload image.</p>";
            $imagePath = $brandData['brand_image'] ?? ''; // Revert to old image on failure
        }
    }

    // Update the brand
    if ($brand->updateBrand($id, $brandName, $imagePath, $link)) {
        header("Location: index.php");
        exit;
    } else {
        echo "<p class='text-red-500'>Error: Brand could not be updated.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Brand</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Brand</h2>

        <!-- Edit Brand Form -->
        <form action="edit.php?id=<?= htmlspecialchars($brandData['id']) ?>" method="POST" enctype="multipart/form-data">
            <!-- Brand Name -->
            <div class="mb-4">
                <label for="brand_name" class="block text-sm font-medium text-gray-700">Brand Name</label>
                <input type="text" name="brand_name" value="<?= htmlspecialchars($brandData['brand_name']) ?>" required
                       class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Brand Image -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700">Brand Image</label>
                <?php if (!empty($brandData['brand_image'])): ?>
                    <img id="brandPreviewImage" src="<?= htmlspecialchars($brandData['brand_image']) ?>" alt="Current Brand Image"
                        class="h-20 w-20 object-cover rounded-md mb-3 border border-gray-300 shadow-sm">
                <?php else: ?>
                    <img id="brandPreviewImage" src="https://via.placeholder.com/100" alt="Brand Preview"
                        class="h-20 w-20 object-cover rounded-md mb-3 border border-gray-300 shadow-sm">
                <?php endif; ?>
                <input type="file" name="brand_image" accept="image/*" onchange="previewBrandImage(event)"
                       class="block w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm 
                       file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 mt-2">
            </div>

            <script>
                function previewBrandImage(event) {
                    const image = document.getElementById('brandPreviewImage');
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

            <!-- Brand Link -->
            <div class="mb-4">
                <label for="link" class="block text-sm font-medium text-gray-700">Link</label>
                <textarea name="link" rows="3" required
                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"><?= htmlspecialchars($brandData['link']) ?></textarea>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Update Brand
                </button>
            </div>
        </form>
    </div>
</body>
</html>
<?php ob_end_flush(); // Flush the output buffer ?>