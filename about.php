<?php include './admin/page/library/db.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>About Us</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 text-gray-800">
<?php include 'navbar.php'; ?>
<main class="pt-10 pb-16 px-4 md:px-10">

  <!-- Hero Section -->
  <section class="text-center mb-12">
    <h1 class="text-4xl font-bold text-blue-600 mb-2">About Us</h1>
    <p class="text-lg text-gray-600">Learn more about our mission, values, and team.</p>
  </section>

  <!-- Company Overview -->
  <section class="max-w-5xl mx-auto bg-white p-6 md:p-10 rounded-xl shadow">
    <h2 class="text-2xl font-semibold text-blue-700 mb-4">Who We Are</h2>
    <p class="text-gray-700 leading-relaxed mb-4">
      We are a passionate team dedicated to delivering high-quality products at affordable prices.
      Our goal is to make online shopping easy, fun, and reliable. From tech gadgets to daily essentials,
      we offer a wide range of products to meet your needs.
    </p>
    <p class="text-gray-700 leading-relaxed">
      Customer satisfaction is at the core of everything we do. We continuously improve our services,
      expand our catalog, and listen closely to your feedback to serve you better.
    </p>
  </section>

  <!-- Mission, Vision, Values -->
  <section class="max-w-5xl mx-auto mt-12 grid gap-6 md:grid-cols-3">
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
      <h3 class="text-xl font-bold text-blue-600 mb-2"><i class="fas fa-bullseye mr-2"></i> Our Mission</h3>
      <p class="text-gray-700">To provide customers with an exceptional online shopping experience through convenience, value, and trust.</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
      <h3 class="text-xl font-bold text-blue-600 mb-2"><i class="fas fa-eye mr-2"></i> Our Vision</h3>
      <p class="text-gray-700">To become the most loved and trusted online store for quality products and outstanding service.</p>
    </div>
    <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
      <h3 class="text-xl font-bold text-blue-600 mb-2"><i class="fas fa-heart mr-2"></i> Our Values</h3>
      <ul class="text-gray-700 list-disc list-inside">
        <li>Customer-first mindset</li>
        <li>Transparency & integrity</li>
        <li>Innovation & growth</li>
        <li>Teamwork & respect</li>
      </ul>
    </div>
  </section>

  <!-- Team (Optional Section) -->
  <!-- <section class="max-w-5xl mx-auto mt-16 text-center">
    <h2 class="text-2xl font-semibold text-blue-700 mb-4">Meet Our Team</h2>
    <p class="text-gray-600">We’re a group of passionate creators, developers, and dreamers.</p>
    <div class="mt-6 grid sm:grid-cols-2 md:grid-cols-3 gap-6">
      <div class="bg-white p-4 rounded-lg shadow">
        <img src="https://via.placeholder.com/100" alt="Team Member" class="mx-auto rounded-full mb-3">
        <h4 class="font-semibold">John Doe</h4>
        <p class="text-sm text-gray-500">Founder & CEO</p>
      </div>
      <!-- Add more team cards here -->
    <!-- </div>
  </section> -->

</main>

<?php include 'footer.php'; ?>
</body>
</html>
