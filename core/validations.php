<?php

function validateRequired($value, $fieldName)
{
    return empty($value) ? "$fieldName is required" : null;
}

function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? null : "Invaild email";;
}

function validatePassword($password)
{
    if (strlen($password) < 6) {
        return "Password must be 6 char";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must contain uppercase";
    }
    if (!preg_match("/[a-z]/", $password)) {
        return "Password must contain lowercase";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password must contain number";
    }
    return null;
}

function validatePasswordMatch($password, $confirm_password)
{
    return $password === $confirm_password ? null : "Password do not match";
}

function validateRegister($name, $email, $password, $confirm_password)
{
    $fields = [
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'confirm_password' => $confirm_password,
    ];

    foreach ($fields as $fieldName => $value) {
        if ($error = validateRequired($value, $fieldName)) {
            return $error;
        }
    }

    if ($error = validateEmail($email)) {
        return $error;
    }

    if ($error = validatePassword($password)) {
        return $error;
    }

    if ($error = validatePasswordMatch($password, $confirm_password)) {
        return $error;
    }
}

function validateLogin($email, $password)
{
    $fields = [
        'email' => $email,
        'password' => $password,
    ];

    foreach ($fields as $fieldName => $value) {
        if ($error = validateRequired($value, $fieldName)) {
            return $error;
        }
    }

    if ($error = validateEmail($email)) {
        return $error;
    }

    return null;
}
