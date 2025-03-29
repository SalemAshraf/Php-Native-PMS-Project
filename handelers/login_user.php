<?php

include "../core/validations.php";
include "../core/functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = trim($_POST['password']);

    $error = validateLogin($email, $password);

    if(!empty($error)){
        setMessages('danger',$error);
        header("Location: ../form_employee.php");
        exit;
    }
    
    if(loginUser($email, $password)){
        setMessages('success', "Login sucessfully");
        header("Location: ../index.php");
        exit;
    }else{
        setMessages('danger',"Invaild email or password");
        header("Location: ../login.php");
        exit;
    }
}
