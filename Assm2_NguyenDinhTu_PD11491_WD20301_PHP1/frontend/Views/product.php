<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../Css/common.css">
    <link rel="stylesheet" href="../Css/product.css">
</head>
<body>
    <?php
        // Trong view (cart_display)
        if (isset($_SESSION['flash_message'])) {
            $flash = $_SESSION['flash_message'];
            echo htmlspecialchars($flash['message']);
            echo "</div>";
            unset($_SESSION['flash_message']); // Xóa message sau khi hiển thị
        }
    ?>
    <h1>🛍️ Danh sách sản phẩm</h1>
    <h3 class="total_product_display">Tổng số sản phẩm: <?php echo $total?> sản phẩm</h3>
    <?php if (empty($products)) : ?>
        <p class="empty-message">Danh sách trống</p>
    <?php else : ?>
        <div class="product-container">
            <?php foreach ($products as $product) : ?>
                <div class="product-box" onclick="window.location.href='../Controllers/BaseController.php?action=product_detail&id=<?php echo $product['id']; ?>'">
                    <img src="<?php echo $product["image"]; ?>" alt="Ảnh sản phẩm">
                    <h3 class="product-name"><?php echo $product["name"]; ?></h3>
                    <p class="product-price">Giá: <?php echo number_format($product["price"], 0, ',', '.') . ' ₫'; ?></p>
                    <p title="<?php echo $product["description"]; ?>" class="product-description"><?php echo $product["description"]; ?></p>
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
