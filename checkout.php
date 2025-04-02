<?php
session_start();
require_once('inc/header.php');
?>

<!-- Header -->
<header class="bg-dark py-5">
    <div class="container text-center text-white">
        <h1 class="display-4 fw-bolder">Checkout</h1>
        <p class="lead fw-normal text-white-50 mb-0">Complete your order</p>
    </div>
</header>

<!-- Checkout Form -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- عرض المنتجات في السلة -->
            <div class="col-4">
                <div class="border p-2">
                    <h4>Order Summary</h4>
                    <ul class="list-unstyled">
                        <?php 
                        $total = 0;
                        if (!empty($_SESSION['cart'])) {
                            foreach ($_SESSION['cart'] as $item): 
                                $subtotal = $item['price'] * $item['quantity'];
                                $total += $subtotal;
                        ?>
                        <li class="border p-2 my-1">
                            <?= htmlspecialchars($item['name']); ?> - 
                            <span class="text-success"><?= $item['quantity']; ?> x $<?= number_format($item['price'], 2); ?></span>
                        </li>
                        <?php endforeach; } else { ?>
                        <li class="border p-2 my-1 text-danger">Your cart is empty.</li>
                        <?php } ?>
                    </ul>
                    <h3>Total: $<?= number_format($total, 2); ?></h3>
                </div>
            </div>

            <!-- نموذج إدخال بيانات العميل -->
            <div class="col-8">
                <form action="./core/process_order.php" method="POST" class="border p-3">
                    <div class="mb-3">
                        <label>Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Notes</label>
                        <input type="text" name="notes" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>
