<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - EraaSoft PMS Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#">
                <img src="assets/images/logo-black.svg" alt="EraaSoft PMS Logo" height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                </ul>
                <form class="d-flex" action="cart.php">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <?php if (isset($_SESSION['user'])): ?>
                            <li class="nav-item"><a class="nav-link" href="handelers/logout.php">Logout</a></li>
                            <?php if ($_SESSION['user']['role'] == 'admin') : ?>
                                <li class="nav-item"><a class="nav-link" href="Dashboard_Admin.php">Dashboard</a></li>
                            <?php elseif ($_SESSION['user']['role'] == 'vendor'): ?>
                                <li class="nav-item"><a class="nav-link" href="Dashboard_vendor.php">Dashboard</a></li>
                            <?php else: ?>
                                <li class="nav-item"><a class="nav-link" href="Dashboard.php">Dashboard</a></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li class="nav-item"><a class="nav-link" aria-current="page" href="SignUp.php">SignUp</a></li>
                            <li class="nav-item"><a class="nav-link" href="LogIn.php">LogIn</a></li>
                        <?php endif; ?>
                    </ul>
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <?php
                        $cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
                        ?>
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?= $cart_count; ?></span>
                    </button>
                </form>
            </div>
        </div>
    </nav>