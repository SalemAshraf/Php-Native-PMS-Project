<?php
session_start();
require_once('core/functions.php');

if (isset($_GET['action']) && $_GET['action'] == "add") {
    $product_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    $product = getProductById($product_id);

    if ($product) {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['quantity']++;
        } else {
            $_SESSION['cart'][$product_id] = [
                'name' => $product['name'],
                "user_id" => $_SESSION['user']['id'],
                'price' => $product['price'],
                'image' => $product['image'],
                'quantity' => 1
            ];
        }
    }

    header("Location: cart.php");
    exit();
}

if (isset($_GET['action']) && $_GET['action'] == "delete") {
    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

    if (isset($_SESSION['cart'][$id])) {
        unset($_SESSION['cart'][$id]);
    }

    header("Location: cart.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == "POST" || isset($_GET['action']) && $_GET['action'] == "update") {
    $id = isset($_POST['id']) ? filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT) : filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $quantity = isset($_POST['quantity']) ? filter_input(INPUT_POST, 'quantity', FILTER_SANITIZE_NUMBER_INT) : filter_input(INPUT_GET, 'quantity', FILTER_SANITIZE_NUMBER_INT);

    if ($quantity > 0 && isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    }

    header("Location: cart.php");
    exit();
}

?>
