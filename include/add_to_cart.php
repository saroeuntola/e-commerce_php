<?php
session_start();
header('Content-Type: application/json');

include '../admin/page/library/db.php';
include '../admin/page/library/product_lib.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $productId = intval($_POST['product_id']);
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

    $productObj = new Product();
    $product = $productObj->getProductById($productId);

    if ($product) {
        $item = [
            'id' => $product['id'],
            'name' => $product['name'],
            'price' => $product['price'],
            'image' => $product['image'],
            'description'=> $product['description'],
            'quantity' => $quantity,
        ];

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $found = false;
        foreach ($_SESSION['cart'] as &$cartItem) {
            if ($cartItem['id'] == $item['id']) {
                $cartItem['quantity'] += $quantity;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $_SESSION['cart'][] = $item;
        }

        echo json_encode(['success' => true, 'message' => 'Item added to cart!']);
        exit;
    } else {
        echo json_encode(['success' => false, 'message' => 'Product not found.']);
        exit;
    }
}
