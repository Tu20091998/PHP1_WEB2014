<!DOCTYPE html>
<html>
<head><title>Kết quả tìm kiếm</title></head>
<body>
    <h2>Kết quả tìm kiếm cho: <em><?php echo htmlspecialchars($_GET['keyword']); ?></em></h2>

    <?php if (!empty($product_search)): ?>
        <ul>
            <?php foreach ($product_search as $product): ?>
                <li><?php echo htmlspecialchars($product['name']); ?> - <?php echo number_format($product['price']); ?> đ</li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>
</body>
</html>