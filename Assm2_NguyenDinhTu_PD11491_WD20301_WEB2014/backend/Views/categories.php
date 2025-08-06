<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục kèm sản phẩm</title>
    <link rel="stylesheet" href="../Css/products.css">
</head>
<body>
    <h1 style="text-align: center;">Danh mục</h1>
    <h2 style="text-align: center;">Tổng số lượng danh mục là: <?php echo $categories_count?> danh mục</h2>

    <div class="add-product">
        <a href="../Controllers/BaseController.php?action=add_categories_display" class="add-btn">+ Thêm danh mục</a>
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
            <th>STT</th>
            <th>ID danh mục</th>
            <th>Tên danh mục</th>
            <th>Thao tác</th>
        </tr>
        <?php $stt = 1; ?>
        <?php foreach ($categories_list as $c): ?>
        <tr>
            <td><?= $stt++ ?></td>
            <td><?= htmlspecialchars($c['category_id']) ?></td>
            <td><?= htmlspecialchars($c['category_name']) ?></td>
            <td class="action-buttons">
                <a href="../Controllers/BaseController.php?action=edit_category_display&category_id=<?php echo $c['category_id'] ?>" class="edit-btn">Sửa</a>
                <a href="../Controllers/BaseController.php?action=delete_category_confirm&category_id=<?php echo $c['category_id'] ?>" class="delete-btn" 
                    onclick="return confirm('Bạn có chắc muốn xoá danh mục này?');">Xoá</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>