<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Danh sách người dùng</h2>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Password</th>
            <th>Ngày đăng ký</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['password'] ?></td>
            <td><?= $user['register_date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php?action=products_out_of_stock_display">Đến danh sách sản phẩm hết hàng</a>
</body>
</html>