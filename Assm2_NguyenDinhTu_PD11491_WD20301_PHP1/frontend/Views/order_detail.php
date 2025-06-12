<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng</title>
    <link rel="stylesheet" href="../Css/orders_detail.css">
</head>
<body>
    <div class="container mt-4">
        <a href="BaseController.php?action=order_display" class="back-btn">
            ← Quay lại lịch sử đơn hàng
        </a>
        
        <h2 class="mb-4">Chi tiết đơn hàng #<?= $orderDetails[0]['order_id'] ?? '' ?></h2>
        
        <?php if (!empty($orderDetails)): ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $totalAmount = 0;
                            foreach ($orderDetails as $index => $item): 
                                $subtotal = $item['quantity'] * $item['unit_price'];
                                $totalAmount += $subtotal;
                        ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= htmlspecialchars($item['name'] ?? '') ?></td>
                                <td><?= $item['quantity'] ?></td>
                                <td><?= number_format($item['unit_price'], 0, ',', '.') ?>đ</td>
                                <td><?= number_format($subtotal, 0, ',', '.') ?>đ</td>
                            </tr>
                        <?php endforeach; ?>
                        <tr class="table-active">
                            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
                            <td><strong><?= number_format($totalAmount, 0, ',', '.') ?>đ</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning">Không tìm thấy thông tin đơn hàng</div>
        <?php endif; ?>
    </div>
</body>
</html>