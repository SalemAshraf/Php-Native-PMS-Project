<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $file = realpath(__DIR__ . "/../data/orders.json");

    $orders = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $newId = empty($orders) ? 1 : max(array_column($orders, 'id')) + 1;

    $order = [
        "id"    => $newId,
        "name"    => $_POST["name"],
        "email"   => $_POST["email"],
        "address" => $_POST["address"],
        "phone"   => $_POST["phone"],
        "notes"   => $_POST["notes"],
        "items"   => $_SESSION["cart"] ?? [], 
        "total"   => array_reduce($_SESSION["cart"] ?? [], function($sum, $item) {
            return $sum + ($item["price"] * $item["quantity"]);
        }, 0), 
        "date"    => date("Y-m-d H:i:s") 
    ];

    $orders[] = $order;

    file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT));

    unset($_SESSION["cart"]);
    
    if ($_SESSION['user']['role'] == 'admin'){
        header("Location: ../Dashboard_Admin.php");
    } elseif($_SESSION['user']['role'] == 'vendor'){
        header("Location: ../Dashboard_vendor.php");
    } else {
        header("Location: ../Dashboard.php");
    }
    
    exit();
} else {
    header("Location: ../checkout.php");
    exit();
}
