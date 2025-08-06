<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa danh mục</title>
    <link rel="stylesheet" href="../Css/edit_product.css">
</head>
<body>
    <div class="form-container">
        <h1>Sửa danh mục</h1>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../Controllers/BaseController.php?action=update_category_confirm&category_id=<?php echo $category_update["category_id"] ?? ''?>" method="post">
            <div class="form-group">
                <label for="category_name">Tên danh mục:</label>
                <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category_update['category_name'] ?? '')  ?>" required>
            </div>
            
            <button type="submit" class="btn">Cập nhật</button>
            <a href="../Controllers/BaseController.php?action=categories_display" class="btn" style="background-color: #6c757d;">Hủy</a>
        </form>
    </div>
</body>
</html>