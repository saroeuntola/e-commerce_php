<?php 
 include "./admin/page/library/db.php";
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <?php 
  include './navbar.php';
  ?>
  
  <!-- Main Content -->
  <main class="max-w-4xl mx-auto py-8 px-6">
  <header class="p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
      <h1 class="text-2xl font-bold text-indigo-600">Contact Us</h1>
    </div>
  </header>
    <div class="bg-white shadow-md rounded-2xl p-8">
      <h2 class="text-xl font-semibold mb-6 text-gray-700">We'd love to hear from you</h2>
      
      <form action="send_contact.php" method="POST" class="space-y-6">
        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1" for="name">Name</label>
          <input type="text" name="name" id="name" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1" for="email">Email</label>
          <input type="email" name="email" id="email" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1" for="subject">Subject</label>
          <input type="text" name="subject" id="subject"
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none">
        </div>

        <div>
          <label class="block text-sm font-medium text-gray-600 mb-1" for="message">Message</label>
          <textarea name="message" id="message" rows="5" required
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-400 focus:outline-none"></textarea>
        </div>

        <div>
          <button type="submit"
            class="w-full bg-indigo-600 text-white font-medium py-2 px-4 rounded-lg hover:bg-indigo-700 transition">Send Message</button>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <?php 
  include './footer.php';
  ?>
</body>
</html>
