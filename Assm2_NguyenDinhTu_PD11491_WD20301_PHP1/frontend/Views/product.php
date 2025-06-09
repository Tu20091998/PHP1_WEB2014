<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../Css/product.css">
</head>
<body>
    <h1>🛍️ Danh sách sản phẩm</h1>
    <h3 class="total_product_display">Tổng số sản phẩm: <?php echo $total?> sản phẩm</h3>
    <?php if (empty($products)) : ?>
        <p class="empty-message">Danh sách trống</p>
    <?php else : ?>
        <div class="product-container">
            <?php foreach ($products as $product) : ?>
                <div class="product-box">
                    <img src="<?php echo $product["image"]; ?>" alt="Ảnh sản phẩm">
                    <h3 class="product-name"><?php echo $product["name"]; ?></h3>
                    <p class="product-price">Giá: <?php echo number_format($product["price"], 0, ',', '.') . ' ₫'; ?></p>
                    <p title="<?php echo $product["description"]; ?>" class="product-description"><?php echo $product["description"]; ?></p>
                    <div class="btn-process">
                        <form method="POST" class="product-add" action="../Controllers/BaseController.php?action=cart_add_confirm">
                            <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                            <button type="submit" name="addCart">Thêm vào giỏ 🛒</button>
                        </form>
                        <a href="../Controllers/BaseController.php?action=product_detail&id=<?php echo $product['id']; ?>" class="view-detail-button" target="main">Xem chi tiết 🔍</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="page_pagisnated">
        <?php for($i = 1; $i <= $totalPages; $i++):?>
            <a href="../Controllers/BaseController.php?action=products_display&page=<?php echo $i?>"><?php echo $i?></a>
        <?php endfor;?>
    </div>
</body>
</html>
