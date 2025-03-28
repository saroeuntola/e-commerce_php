<!DOCTYPE html>
<html lang="zxx">

<?php include "./include/head.php" ?>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Offcanvas Menu Begin -->
    <div class="offcanvas-menu-overlay"></div>
    <?php include "./include/offcanvas_menu.php" ?>
    <!-- Offcanvas Menu End -->

    <!-- Header Section Begin -->
    <?php include "./include/header.php" ?>
    <!-- Header Section End -->

    <!-- Categories Section Begin -->
    <?php include "./include/category.php" ?>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <?php include "./include/product.php" ?>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <?php include "./include/banner.php" ?>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
        <?php include "./include/trend.php" ?>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    <section class="discount">
        <?php include "./include/discount.php" ?>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <?php include "./include/service.php" ?>
    </section>
    <!-- Services Section End -->

    <!-- Instagram Begin -->
    <div class="instagram">
        <?php include "./include/ig.php" ?>
    </div>
    <!-- Instagram End -->

    <!-- Footer Section Begin -->
    <footer class="footer">
        <?php include "./include/footer.php" ?>
    </footer>
    <!-- Footer Section End -->

    <!-- Search Begin -->
    <div class="search-model">
        <?php include "./include/search.php" ?>
    </div>
    <!-- Search End -->

    <!-- Js Plugins -->
    <?php include "./include/js.php" ?>
</body>

</html>