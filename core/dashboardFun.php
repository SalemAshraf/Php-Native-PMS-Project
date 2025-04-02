<?php

session_start();

$ordersfile = realpath(__DIR__ . "/../data/orders.json");

function getOrdersData()
{
    $orderDatajson = $GLOBALS['ordersfile'];
    return file_exists($orderDatajson) ? json_decode(file_get_contents($orderDatajson), true) : [];
}

function getOrderById($id) {
    $orders = getOrdersData();
    foreach ($orders as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}