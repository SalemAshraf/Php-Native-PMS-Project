<?php
require_once('inc/header.php');
require_once('core/functions.php');
require_once('core/VendorFun.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h2 class="text-center">Vendor Dashboard</h2>

    <!-- إضافة منتج جديد -->
    <div class="card p-3 mb-3">
        <h4>Add New Product</h4>
        <form method="POST">
            <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required>
            <input type="number" name="price" class="form-control mb-2" placeholder="Price" required>
            <input type="text" name="category" class="form-control mb-2" placeholder="Category" required>
            <button type="submit" name="add_product" class="btn btn-primary">Add</button>
        </form>
    </div>

    <!-- قائمة المنتجات -->
    <h4>Our Products</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Category</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getVendorProducts($vendor_id) as $product): ?>
                <tr>
                    <td><?= $product['id'] ?></td>
                    <td><?= htmlspecialchars($product['name']) ?></td>
                    <td><?= htmlspecialchars($product['price']) ?></td>
                    <td><?= htmlspecialchars($product['category']) ?></td>
                </tr>
            <?php endforeach; ?>
            
        </tbody>
    </table>

    <!-- قائمة الطلبات -->
    <h4>Orders List</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Client</th>
                <th>Products</th>
                <th>Total</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach (getVendorOrders($vendor_id) as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                    <td>
                        <?php 
                            $productNames = array_map(fn($item) => $item['name'], $order['items']);
                            echo implode(", ", $productNames);
                        ?>
                    </td>
                    <td><?= htmlspecialchars($order['total']) ?></td>
                    <td><?= htmlspecialchars($order['date']) ?></td>
                    <td><span class="badge bg-success">مكتمل</span></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
</body>
</html>

<?php require_once('inc/footer.php'); ?>
