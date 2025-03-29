<?php

session_start();

function setMessages($type, $message)
{
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message,
    ];
}

function showMessages()
{
    if (isset($_SESSION['message'])) {
        $type = $_SESSION['message']['type'];
        $text = $_SESSION['message']['text'];

        echo "<div class='alert alert-$type'>$text</div>";

        unset($_SESSION['message']);
    }
}

$usersJsonFile = realpath(__DIR__ . "/../data/users.json");

function registerUser($name,$email,$password) {
    $usersJson = $GLOBALS['usersJsonFile'];
    $users = file_exists($usersJson) ? json_decode(file_get_contents($usersJson), true) : [];

    if(!is_array($users)){
        $users = [];
    }

    $newId = empty($users) ? 1 : max(array_column($users,'id')) + 1;

    $hashedPassword = password_hash($password,PASSWORD_DEFAULT);

    $nameUser = [
        'id' => $newId,
        'name' => $name,
        'email' => $email,
        'password' => $hashedPassword,
    ];

    $users[] = $nameUser;
    file_put_contents($usersJson, json_encode($users, JSON_PRETTY_PRINT));

    $_SESSION['user'] = [
        'name' => $name,
        'email' => $email
    ];
    return true;
}

function loginUser($email,$password){
    $usersJson = $GLOBALS['usersJsonFile'];
    $users = file_exists($usersJson) ? json_decode(file_get_contents($usersJson), true) : [];

    if(!is_array($users)){
        $users = [];
    }

    foreach($users as $user){
        if($user['email'] == $email && password_verify($password,$user['password'])){
            $_SESSION['user'] = [
                'name' => $user['name'],
                'email' =>  $user['email'],
                'role' =>  $user['role']
            ];
            return true;
        }
    }

    return false;
}

$productDataFile = realpath(__DIR__ . "/../data/products.json");
function getProductData()
{
    $productDatajson = $GLOBALS['productDataFile'];
    return file_exists($productDatajson) ? json_decode(file_get_contents($productDatajson), true) : [];
}

function getProductById($id) {
    $products = getProductData();
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null;
}

function getUsersData()
{
    $usersDatajson = $GLOBALS['usersJsonFile'];
    return file_exists($usersDatajson) ? json_decode(file_get_contents($usersDatajson), true) : [];
}
