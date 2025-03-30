<?php
include('../admin/page/library/auth.php');
$auth = new Auth();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember = isset($_POST['remember']) ? true : false;

    if ($auth->login($username, $password, $remember)) {
        $result = dbSelect('users', 'role_id', "username='$username'");
        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            if ($user['role_id'] == 1) {
                header('Location: ../admin/index.php');
                exit();
            } 
            if ($user['role_id'] == 2) {
                header('Location: ../index.php');
                exit();
            } 
        }
    } else {
        echo "<p class='text-red-500'>Invalid username or password!</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link to Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <!-- Login Form -->
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Login</h2>

        <!-- Login Form -->
        <form action="login.php" method="POST">
            <!-- Username -->
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <input type="text" id="username" name="username" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>

            <!-- Remember Me Checkbox -->
            <div class="flex items-center mb-4">
                <input type="checkbox" id="remember" name="remember" class="form-checkbox h-5 w-5 text-indigo-600" />
                <label for="remember" class="ml-2 text-sm text-gray-600">Remember Me</label>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-center">
                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    Login
                </button>
            </div>

            <!-- Error message -->
            <?php if (isset($error_message)): ?>
                <div class="mt-4 text-center text-red-500">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>

