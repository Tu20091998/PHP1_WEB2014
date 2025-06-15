<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form thêm sản phẩm</title>
    <link rel="stylesheet" href="../Css/add_product.css">
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert error"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="../Controllers/BaseController.php?action=add_product_confirm" method="post" enctype="multipart/form-data">
        <label>Tên sản phẩm:</label>
        <input type="text" name="name" required>

        <label>Giá:</label>
        <input type="number" name="price" required>

        <label>Ảnh sản phẩm (URL):</label>
        <input type="text" name="image" placeholder="Nhập URL ảnh">

        <label>Mô tả:</label>
        <textarea name="description"></textarea>

        <label>Danh mục:</label>
        <div class="form-group">
            <select name="category_id" required>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>">
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <label>Số lượng:</label>
        <input type="number" name="product_quantity" min="0" required>

        <button type="submit">Thêm sản phẩm</button>
    </form>
</body>
</html>