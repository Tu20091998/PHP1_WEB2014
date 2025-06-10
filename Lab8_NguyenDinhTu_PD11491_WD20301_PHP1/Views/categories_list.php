<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục kèm sản phẩm</title>
</head>
<body>
    <h1>Danh mục kèm sản phẩm</h1>
    <table border="1">
        <tr>
            <th>ID SP</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>ID danh mục</th>
            <th>Tên danh mục</th>
        </tr>
        <?php foreach ($categories_list as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= number_format($p['price']) ?> đ</td>
            <td><img src="<?= $p['image'] ?>" width="60"></td>
            <td><?= $p['description'] ?></td>
            <td><?= $p['product_quantity'] ?></td>
            <td><?= $p['category_id'] ?></td>
            <td><?= $p['category_name'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php?action=users_display">Đến danh sách người dùng</a>
</body>
</html>