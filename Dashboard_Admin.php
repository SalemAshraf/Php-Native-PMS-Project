<?php
require_once('inc/header.php');
require_once('core/functions.php');
require_once('core/DashboardFun.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <div class="container mt-4">
        <h2 class="text-center mb-4">Admin Dashboard</h2>
        <!-- Tabs Navigation -->
        <ul class="nav nav-tabs" id="adminTabs">
            <li class="nav-item">
                <a class="nav-link active" id="users-tab" data-bs-toggle="tab" href="#users">Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="products-tab" data-bs-toggle="tab" href="#products">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders">Orders</a>
            </li>
        </ul>

        <!-- Tabs Content -->
        <div class="tab-content mt-3">
            <div class="tab-pane fade show active" id="users">
                <h3>User List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            foreach(getUsersData() as $user){
                                echo "<tr>
                            <td>{$user['id']}</td>
                            <td>{$user['name']}</td>
                            <td>{$user['email']}</td>
                            <td>{$user['role']}</td>
                        </tr>";
                            }
                        ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="products">
                <h3>Product List</h3>
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
                        <?php
                        foreach(getProductData() as $product){
                            echo "<tr>
                            <td>{$product['id']}</td>
                            <td>{$product['name']}</td>
                            <td>{$product['price']}</td>
                            <td>Electronics</td>
                        </tr>";
                        }
                         ?>
                        
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="orders">
                <h3>Order List</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Customer</th>
                            <th>Product</th>
                            <th>Total</th>
                            <th>Date</th>
                            <th>Status</th>
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

</body>
</html>
