<?php
include('../library/banner_lib.php');
include('../library/users_lib.php');
include('../library/checkroles.php');

protectPathAccess();
$banner = new Banner();
$banners = $banner->getBanner();
?>


<!DOCTYPE html>
<html>
    <head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">
	<link rel="stylesheet" href="../assets/css/style.css">
     <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="wrapper">
        <div class="main-header">
            <div class="logo-header">
                <a href="#" class="logo">
                    Dashboard
                </a>
                <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>

            <!-- navbar -->
            </div>
            <!-- Corrected path for navbar.php -->
            <?php include "../include/navbar.php"; ?>
        </div>

        <!-- sidebar -->
        <div class="sidebar">
            <!-- Corrected path for sidebar.php -->
            <?php include "../include/sidebar.php"; ?>
        </div>

<!-- page content  -->
        <div class="main-panel" id="content">
             <div class="w-full max-w-6xl bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Banner List</h2>

        <!-- Create Product Button -->
        <div class="flex justify-end mb-4">
            <a href="create.php" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">+ Add Banner</a>
        </div>

        <!-- Product Table -->
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg shadow-md">
                <thead>
                    <tr class="text-left text-sm font-medium text-gray-600 bg-gray-50">
                        <th class="px-4 py-3 border-b">Image</th>
                        <th class="px-4 py-3 border-b">Title</th>
                        <th class="px-4 py-3 border-b">Link</th>
                        <th class="px-4 py-3 border-b">Created At</th>
                        <th class="px-4 py-3 border-b">Actions</th>
                    </tr>
                </thead>
               <tbody>
         <?php if (!empty($banners)): ?>
    <?php foreach ($banners as $row): ?>
        <tr class="text-gray-700 hover:bg-gray-50 transition">
            <td class="px-4 py-3 border-b">
                <img src="<?= htmlspecialchars($row['image']) ?>" alt="Banner" class="h-12 w-12 object-cover rounded-md">
            </td>
            <td class="px-4 py-3 border-b"><?= htmlspecialchars($row['title']) ?></td>
            <td class="px-4 py-3 border-b"><?= htmlspecialchars($row['link']) ?></td>
            <td class="px-4 py-3 border-b"><?= date("Y-m-d", strtotime($row['created_at'])) ?></td>
            <td class="px-4 py-3 border-b">
                <a href="edit.php?id=<?= $row['id'] ?>" class="bg-yellow-500 text-white px-3 py-1 rounded-md hover:bg-yellow-600 mr-2">Edit</a>
                <a href="delete.php?id=<?= $row['id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded-md hover:bg-red-700" onclick="return confirm('Are you sure you want to delete this banners?');">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr>
        <td colspan="8" class="px-4 py-3 text-center text-gray-500">No banners found</td>
    </tr>
<?php endif; ?>

</tbody>

            </table>
        </div>
    </div>

    </div>

            <!-- 
            <footer class="footer">
                
            </footer> 
            -->
        </div>
    </div>
</div>
</body>

<!-- Corrected path for js.php -->
<?php include "../include/js.php"; ?>

</body>
</html>
