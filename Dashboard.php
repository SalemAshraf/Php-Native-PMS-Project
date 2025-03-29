<?php
require_once('inc/header.php');
require_once('core/functions.php');
require_once('core/DashboardFun.php');
session_start();
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم - الطلبات</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4 text-center"> Your Dashboard </h2>

        <div class="card">
            <div class="card-header bg-primary text-white">
                Orders
            </div>
            <div class="card-body">
                <table class="table table-bordered text-center">
                    <thead class="table-dark">
                        <tr>
                        <th>رقم الطلب</th>
            <th>العميل</th>
            <th>المنتجات</th>
            <th>المجموع</th>
            <th>التاريخ</th>
            <th>الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
            foreach (getOrdersData() as $order) {
                $productNames = array_map(function($item) {
                    return $item['name'];
                }, $order['items']);
    
                $productsString = implode(", ", $productNames);
    
                echo "<tr>
                    <td>{$order['id']}</td>
                    <td>{$order['name']}</td>
                    <td>{$productsString}</td>
                    <td>{$order['total']}</td>
                    <td>{$order['date']}</td>
                    <td><span class='badge bg-success'>مكتمل</span></td>
                </tr>";
            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>

        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php require_once('inc/footer.php'); ?>
