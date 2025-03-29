<?php 
require_once('inc/header.php');
session_start();
require_once('core/functions.php');
require_once('core/cartFun.php');

?>

<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop homepage template</p>
        </div>
    </div>
</header>

<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row">
            <div class="col-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if (!empty($_SESSION['cart'])):
                            $totalPrice = 0;
                            $count = 1;
                            foreach ($_SESSION['cart'] as $id => $item):
                                $subtotal = $item['price'] * $item['quantity'];
                                $totalPrice += $subtotal;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $count++; ?></th>
                            <td><?php echo $item['name']; ?></td>
                            <td>$<?php echo number_format($item['price'], 2); ?></td>
                            <td>
                                <form action="cart.php" method="GET">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" min="1" onchange="this.form.submit()">
                                </form>
                            </td>
                            <td>$<?php echo number_format($subtotal, 2); ?></td>
                            <td>
                                <a href="cart.php?action=delete&id=<?= $id; ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4"><strong>Total Price</strong></td>
                            <td colspan="1"><h3>$<?php echo number_format($totalPrice, 2); ?></h3></td>
                            <td><a href="checkout.php" class="btn btn-primary">Checkout</a></td>
                        </tr>
                        <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty!</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php require_once('inc/footer.php'); ?>
