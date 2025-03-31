<?php
include('../library/product_lib.php');
include('../library/checkroles.php');
protectPathAccess();
$product = new product();
if (isset($_GET['id'])) {
    $productId = intval($_GET['id']);
    if ($product->deleteproduct($productId)) {
        echo "<script>alert('product deleted successfully!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: Unable to delete product!'); window.location.href='index.php';</script>";
    }
} else {
    echo "<script>alert('Invalid request!'); window.location.href='index.php';</script>";
}
?>