<?php
include('../library/category_lib.php');
include('../library/checkroles.php');
protectPathAccess();
$category = new Category();

if (isset($_GET['id'])) {
    $category_id = $_GET['id'];

    // Fetch the category by ID
    $categoryData = $category->getCategory($category_id);

    if ($categoryData) {
        $category_name = $categoryData['name'];
    } else {
        echo "<p class='text-red-500'>Category not found!</p>";
        exit;
    }
} else {
    echo "<p class='text-red-500'>Invalid category ID!</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];

    // Update the category
    if ($category->updateCategory($category_id, $name)) {
        echo "<p class='text-green-500'>Category updated successfully!</p>";
        header('Location: index.php');
        exit;
    } else {
        echo "<p class='text-red-500'>Failed to update category!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Edit Category</h2>

        <!-- Edit Category Form -->
        <form action="edit.php?id=<?php echo $category_id; ?>" method="POST">
            <!-- Category Name -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Category Name</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($category_name); ?>" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Update Category
                </button>
            </div>
        </form>
    </div>
</body>

</html>
