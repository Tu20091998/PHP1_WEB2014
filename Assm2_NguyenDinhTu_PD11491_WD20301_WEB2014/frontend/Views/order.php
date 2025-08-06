
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bảng lịch sử đơn hàng</title>
    <link rel="stylesheet" href="../Css/orders.css">
</head>
<body>
    <div class="container mt-4">
    <h2 class="mb-4">Lịch sử đơn hàng</h2>
    
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (empty($orders)): ?>
        <div class="alert alert-info">Bạn chưa có đơn hàng nào</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['order_id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                        <td><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                        <td>
                            <?= $order['status'] ?>
                        </td>
                        <td>
                            <a href="../Controllers/BaseController.php?action=order_detail&id=<?= $order['order_id'] ?>" 
                                class="action-btn detail-btn">
                                Xem chi tiết
                            </a>
                            <br>
                            <a href="../Controllers/BaseController.php?action=order_cancer&id=<?= $order['order_id'] ?>" 
                                class="action-btn cancel-btn"
                                onclick="return confirm('Bạn có chắc chắn muốn hủy đơn hàng này?')">
                                Huỷ đơn hàng
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>