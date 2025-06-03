<?php
session_start();

if (isset($_POST['index'], $_POST['action']) && isset($_SESSION['cart'][$_POST['index']])) {
    $index = (int)$_POST['index'];
    $action = $_POST['action'];

    if ($action === 'increase') {
        $_SESSION['cart'][$index]['quantity'] += 1;
    } elseif ($action === 'decrease') {
        $_SESSION['cart'][$index]['quantity'] -= 1;
        if ($_SESSION['cart'][$index]['quantity'] <= 0) {
            unset($_SESSION['cart'][$index]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
    }
}

exit;
