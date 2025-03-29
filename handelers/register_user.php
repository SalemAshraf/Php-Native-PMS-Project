<?php

include "../core/validations.php";
include "../core/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    $error = validateRegister($name, $email, $password, $confirm_password);

    if (!empty($error)) {
        setMessages('danger', $error);
        header("Location: ../register.php");
        exit;
    }

    if(registerUser($name, $email, $password)){
        setMessages('success', "User Reqister sucessfully");
        header("Location: ../index.php");
        exit;
    }else{
        setMessages('danger',"Fail Reqister User");
        header("Location: ../register.php");
        exit;
    }
}