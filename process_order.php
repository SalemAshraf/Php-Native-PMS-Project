<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $order = [
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

    $file = realpath(__DIR__ . "/orders.json");

    $orders = file_exists($file) ? json_decode(file_get_contents($file), true) : [];

    $orders[] = $order;

    file_put_contents($file, json_encode($orders, JSON_PRETTY_PRINT));

    unset($_SESSION["cart"]);

    header("Location: Dashboard.php");
    exit();
} else {
    header("Location: checkout.php");
    exit();
}
?>
