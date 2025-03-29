<?php
require_once('inc/header.php');
require_once('core/functions.php');
session_start();
?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Buy now Pay Later with Valu</h1>
            <p class="lead fw-normal text-white-50 mb-0">Secure Online Payment | Enjoy Free delivery</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-3 justify-content-center">
            <?php
            foreach (getProductData() as $product) {
                echo '<div class="col mb-5">
                    <div class="card h-100">
                        <img class="card-img-top" src="' . $product['image'] . '" />
                        <div class="card-body p-4">
                            <div class="text-center">
                                <h5 class="fw-bolder">' . $product['name'] . '</h5>
                                ' .  "EGP" . $product['price'] . '
                            </div>
                        </div>
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <a class="btn btn-outline-dark mt-auto" href="cart.php?action=add&id=' . $product['id'] . ' ">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>
    </div>
</section>
<?php require_once('inc/footer.php'); ?>