<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết sản phẩm</title>
    <link rel="stylesheet" href="../Css/product_detail.css">
</head>
<body>
    <?php if (!isset($product)) : ?>
    <h2 style="text-align:center; color: red;">Không tìm thấy sản phẩm</h2>
    <?php else : ?>
    <div class="container">
        <div class="product-image">
            <img src="<?php echo $product["image"]; ?>" alt="Ảnh sản phẩm">
        </div>
        <h2 class="product-name"><?php echo $product["name"]; ?></h2>
        <p class="product-price">Giá: <?php echo number_format($product["price"], 0, ',', '.') . ' ₫'; ?></p>
        <p class="product-description"><?php echo $product["description"]; ?></p>
        <form method="POST">
            <a href="BaseController.php?action=products" target="main" class="return_page">← Quay lại danh sách</a>
            <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
            <button type="submit" name="addCart">Thêm vào giỏ hàng 🛒</button>
        </form>
    </div>
<?php endif; ?>
</body>
</html>