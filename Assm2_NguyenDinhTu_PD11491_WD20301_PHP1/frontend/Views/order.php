<?php
$orders = [
    [
        "order_id" => 1,
        "user_id" => 101,
        "order_date" => "2025-05-25",
        "product_name" => "Cà phê sữa đá",
        "quantity" => 2
    ],
    [
        "order_id" => 1,
        "user_id" => 101,
        "order_date" => "2025-05-25",
        "product_name" => "Trà đào cam sả",
        "quantity" => 1
    ],
    [
        "order_id" => 2,
        "user_id" => 102,
        "order_date" => "2025-05-26",
        "product_name" => "Bạc xỉu",
        "quantity" => 3
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách đơn hàng đã đặt</title>
    <link rel="stylesheet" href="../Css/order.css">
</head>

<body>
    <h2>📦 Danh sách đơn hàng đã đặt</h2>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Mã đơn hàng</th>
                <th>Người dùng</th>
                <th>Ngày đặt</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order) : ?>
                <tr>
                    <td><?php echo $order["order_id"]; ?></td>
                    <td><?php echo $order["user_id"]; ?></td>
                    <td><?php echo $order["order_date"]; ?></td>
                    <td><?php echo $order["product_name"]; ?></td>
                    <td><?php echo $order["quantity"]; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

