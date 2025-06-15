<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link rel="stylesheet" href="../Css/edit_product.css">
</head>
<body>
    <div class="form-container">
        <h1>Sửa sản phẩm</h1>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="message error"><?= $_SESSION['error'] ?></div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form action="../Controllers/BaseController.php?action=update_product&id=<?php echo $product["id"] ?>" method="post">
            <div class="form-group">
                <label for="name">Tên sản phẩm:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="price">Giá:</label>
                <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="description">Mô tả:</label>
                <textarea id="description" name="description" required><?php echo htmlspecialchars($product['description']) ?></textarea>
            </div>
            
            <div class="form-group">
                <label for="image">Đường dẫn ảnh:</label>
                <input type="text" id="image" name="image" value="<?= htmlspecialchars($product['image']) ?>" required>
                <?php if ($product['image']): ?>
                    <img src="<?= htmlspecialchars($product['image']) ?>" alt="Ảnh sản phẩm" width="100" style="margin-top: 10px;">
                <?php endif; ?>
            </div>
            
            <div class="form-group">
                <label for="quantity">Số lượng:</label>
                <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($product['product_quantity']) ?>" required>
            </div>

            <div class="form-group">
                <label for="category_id">Danh mục:</label>
                <select name="category_id" required>
                    <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['category_id'] ?>" <?= $cat['category_id'] == $product['category_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['category_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <button type="submit" class="btn">Cập nhật</button>
            <a href="../Controllers/BaseController.php?action=product_display" class="btn" style="background-color: #6c757d;">Hủy</a>
        </form>
        
    </div>
</body>
</html>