<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm kiếm sản phẩm</title>
    <link rel="stylesheet" href="../Css/common.css">
    <link rel="stylesheet" href="../Css/product.css">
</head>
<body>
    <h1>🔍 Tìm kiếm sản phẩm</h1>

    <!-- Hiển thị từ khóa tìm kiếm -->
    <div class="result text-center">
        <?php if (!empty($_GET['keyword'])) : ?>
            <h2>Kết quả tìm kiếm cho: <em><?= htmlspecialchars($_GET['keyword']) ?></em></h2>
        <?php endif; ?> 
    </div>

    <!-- Nếu không có kết quả -->
    <?php if (empty($product_search)) : ?>
        <p class="empty-message">😔 Không tìm thấy sản phẩm nào phù hợp.</p>
    <?php else : ?>
        <div class="product-container">
            <?php foreach ($product_search as $product) : ?>
                <div class="product-box" onclick="window.location.href='../Controllers/BaseController.php?action=product_detail&id=<?php echo $product['id']; ?>'">
                    <img src="<?= $product["image"] ?>" alt="Ảnh sản phẩm">
                    <h3 class="product-name"><?= $product["name"] ?></h3>
                    <p class="product-price">Giá: <?= number_format($product["price"], 0, ',', '.') ?> ₫</p>
                    <p title="<?= $product["description"] ?>" class="product-description">
                        <?= $product["description"] ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>