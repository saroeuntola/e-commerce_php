<?php

include('../library/users_lib.php');
include('../library/checkroles.php');
$user = new User();
protectPathAccess();
$users = $user -> getUsers();


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
           <div class="mt-5">
        <h2 class="text-2xl font-bold mb-6">User List</h2>
        <a href="create.php" class='text-white bg-blue-600 px-3 py-2 rounded-md '>Create User</a>
 <table class="min-w-full bg-white border border-gray-200 rounded-lg mt-3 shadow-md">
    <thead>
        <tr class="text-left text-sm font-medium text-gray-600 bg-gray-50">
            <th class="px-6 py-4 border-b">ID</th>
            <th class="px-6 py-4 border-b">Username</th>
            <th class="px-6 py-4 border-b">Email</th>
            <th class="px-6 py-4 border-b">Role</th>
            <th class="px-6 py-4 border-b">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($users && count($users) > 0) {
            foreach ($users as $userRow) {
                echo "<tr class='text-gray-600 hover:bg-gray-50 transition duration-150 ease-in-out'>";
                echo "<td class='px-6 py-4 border-b'>{$userRow['id']}</td>";
                echo "<td class='px-6 py-4 border-b'>{$userRow['username']}</td>";
                echo "<td class='px-6 py-4 border-b'>{$userRow['email']}</td>";
                echo "<td class='px-6 py-4 border-b'>
    <span class='bg-blue-600 text-white text-sm px-3 py-1 rounded-full shadow-sm'>
        {$userRow['name']}
    </span>
</td>";

                echo "<td class='px-6 py-4 border-b'>";
                echo "<a href='edit.php?id={$userRow['id']}' class='text-white bg-blue-500 me-2 px-3 py-2 rounded-md text-sm'>Edit</a>";
                echo "<a href='delete.php?id={$userRow['id']}' class='text-white bg-red-500 hover:text-red-800 px-3 py-2 rounded-md text-sm' onclick='return confirm(\"Are you sure you want to delete this user?\");'>Delete</a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='px-6 py-4 border-b text-center text-gray-500'>No users found</td></tr>";
        }
        ?>
    </tbody>
</table>


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
