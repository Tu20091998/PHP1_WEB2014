<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục kèm sản phẩm</title>
    <link rel="stylesheet" href="../Css/products.css">
</head>
<body>
    <h1>Danh mục kèm sản phẩm</h1>
    
    <div class="add-product">
        <a href="../Controllers/BaseController.php?action=add_product_display" class="add-btn">+ Thêm sản phẩm</a>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="message success"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="message error"><?= $_SESSION['error'] ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <table>
        <tr>
            <th>ID danh mục</th>
            <th>Tên danh mục</th>
            <th>ID SP</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>Thao tác</th>
        </tr>
        <?php foreach ($categories_list as $p): ?>
        <tr>
            <td><?= htmlspecialchars($p['category_id']) ?></td>
            <td><?= htmlspecialchars($p['category_name']) ?></td>
            <td><?= htmlspecialchars($p['id']) ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= number_format($p['price'], 0, ',', '.') ?> đ</td>
            <td><img src="<?= htmlspecialchars($p['image']) ?>" alt="<?= htmlspecialchars($p['name']) ?>"></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
            <td><?= htmlspecialchars($p['product_quantity']) ?></td>
            <td class="action-buttons">
                <a href="../Controllers/BaseController.php?action=edit_product&id=<?php echo $p['id'] ?>" class="edit-btn">Sửa</a>
                <a href="../Controllers/BaseController.php?action=delete_product&id=<?php echo $p['id'] ?>" class="delete-btn" 
                    onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?');">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>