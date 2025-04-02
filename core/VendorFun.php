<?php
require_once('core/functions.php');
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$vendor_id = $_SESSION['user']['id']; 

function getVendorProducts($vendor_id)
{
    $filePath = __DIR__ . "/../data/products.json";

    if (!file_exists($filePath)) {
        file_put_contents($filePath, json_encode([]));
    }

    $productsJson = file_get_contents($filePath);
    $products = json_decode($productsJson, true) ?? [];

    return array_filter($products, function ($product) use ($vendor_id) {
        return isset($product['user_id']) && $product['user_id'] == $vendor_id;
    });
}

function getVendorOrders($vendor_id)
{
    $filePath = __DIR__ . "/../data/orders.json";

    if (!file_exists($filePath)) {
        file_put_contents($filePath, json_encode([]));
    }

    $ordersJson = file_get_contents($filePath);
    $orders = json_decode($ordersJson, true) ?? [];

    return array_filter($orders, function ($order) use ($vendor_id) {
        foreach ($order['items'] as $item) {
            if ($item['user_id'] == $vendor_id) {
                return true;
            }
        }
        return false;
    });
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["add_product"])) {

    $filePath = realpath(__DIR__ . "/../data/products.json");

    if (!file_exists($filePath)) {
        file_put_contents($filePath, json_encode([]));
        if (!file_exists($filePath)) {
            die("Error: products.json not found at $filePath");
        }
        if (!is_writable($filePath)) {
            die("Error: Cannot write to products.json. Check file permissions.");
        }
    }

    $productsJson = file_get_contents($filePath);
    $products = json_decode($productsJson, true) ?? [];

    $newId = empty($products) ? 1 : max(array_column($products,column_key: 'id')) + 1;


    $newProduct = [
        "id" => $newId,
        "user_id" => $vendor_id,
        "name" => $_POST["name"],
        "price" => $_POST["price"],
        "category" => $_POST["category"]
    ];

    $products[] = $newProduct;
    file_put_contents($filePath, json_encode($products, JSON_PRETTY_PRINT));

}