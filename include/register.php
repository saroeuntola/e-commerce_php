<?php
include('../admin/page/library/auth.php');
$userAuth = new Auth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sex = $_POST['sex']; 
    $role_id = $_POST['role'];  

    // Call the register function
    if ($userAuth->register($username, $email, $password, $sex, $role_id)) {
        echo "Registration successful!";
        header("Location: login.php");
        exit;
    } else {
        echo "Error occurred during registration.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- Link to Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Register</h2>

        <!-- Registration Form -->
        <form action="register.php" method="POST">
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Gender -->
            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                <div class="flex items-center space-x-4 mt-2">
                    <label class="inline-flex items-center">
                        <input type="radio" id="male" name="sex" value="male" class="form-radio text-indigo-600" required>
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" id="female" name="sex" value="female" class="form-radio text-indigo-600" required>
                        <span class="ml-2">Female</span>
                    </label>
                </div>
            </div>

            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                <select id="role" name="role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="1">Admin</option>
                    <option value="2">User</option>
                </select>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Register
                </button>
            </div>
        </form>
    </div>
</body>
</html>
