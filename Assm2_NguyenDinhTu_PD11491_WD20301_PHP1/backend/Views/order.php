<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý đơn hàng - Admin</title>
    <link rel="stylesheet" href="../Css/orders.css"> <!-- CSS riêng cho admin -->
</head>
<body>
    <div class="container">
        <h2>Quản lý đơn hàng</h2> <!-- Đổi tiêu đề -->
        
        <!-- Phần thông báo (giữ nguyên) -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert success"><?= $_SESSION['success'] ?></div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (empty($orders)): ?>
            <div class="alert info">Không có đơn hàng nào</div>
        <?php else: ?>
            <table class="order-table">
                <thead>
                    <tr>
                        <th>Mã đơn</th>
                        <th>Ngày đặt</th>
                        <th>Tổng tiền</th>
                        <th>Trạng thái</th>
                        <th>Khách hàng</th> <!-- Thêm cột mới -->
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td>#<?= $order['order_id'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($order['order_date'])) ?></td>
                        <td><?= number_format($order['total_amount'], 0, ',', '.') ?>đ</td>
                        <td class="status-<?= strtolower($order['status']) ?>">
                            <?= $order['status'] ?>
                        </td>
                        <td><?= htmlspecialchars($order['user_id'] ?? 'Khách vãng lai') ?></td> <!-- Hiển thị tên KH -->
                        <td class="actions">
                            <a href="../Controllers/AdminController.php?action=order_detail&id=<?= $order['order_id'] ?>" 
                                class="btn detail">Chi tiết</a>
                            
                            <!-- Chỉ cho phép hủy nếu đơn ở trạng thái chờ xử lý -->
                            <?php if ($order['status'] == 'Chờ xử lý'): ?>
                                <a href="../Controllers/AdminController.php?action=cancel_order&id=<?= $order['order_id'] ?>" 
                                    class="btn cancel"
                                    onclick="return confirm('Xác nhận hủy đơn #<?= $order['order_id'] ?>?')">
                                    Hủy
                                </a>
                            <?php endif; ?>
                            
                            <!-- Thêm nút cập nhật trạng thái -->
                            <select onchange="updateStatus(this, <?= $order['order_id'] ?>)">
                                <option value="Đã huỷ" <?= $order['status'] == 'Đã huỷ' ? 'selected' : '' ?>>Đã huỷ</option>
                                <option value="Chờ xử lý" <?= $order['status'] == 'Chờ xử lý' ? 'selected' : '' ?>>Chờ xử lý</option>
                                <option value="Đang xử lý" <?= $order['status'] == 'Đang xử lý' ? 'selected' : '' ?>>Đang xử lý</option>
                                <option value="Hoàn thành" <?= $order['status'] == 'Hoàn thành' ? 'selected' : '' ?>>Hoàn thành</option>
                            </select>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</body>
</html>