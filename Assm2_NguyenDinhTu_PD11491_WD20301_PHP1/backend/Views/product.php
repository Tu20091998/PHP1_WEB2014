<?php
    $results = [
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ86GdUR7JKLInBHH0M7JlI-m7sU1n_ekhJRg&s", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
    ];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý sản phẩm - Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(to right, #4facfe, #00f2fe);
        margin: 0;
        padding: 20px;
    }

    h1 {
        text-align: center;
        color: #2c3e50;
        margin-bottom: 30px;
    }

    .product-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
    }

    .product-box {
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        padding: 15px;
        width: 22%;
        text-align: center;
    }

    .product-box img {
        width: 100%;
        height: 150px;
        border-radius: 5px;
        object-fit: contain;
    }

    .product-name {
        font-size: 20px;
        margin: 10px 0;
        color: #2c3e50;
    }

    .product-price {
        color: #666;
        margin: 5px 0;
    }

    .product-id {
        font-size: 14px;
        color: #999;
    }

    .product-description {
        font-size: 14px;
        color: #666;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .admin-actions {
        margin-top: 15px;
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .admin-actions a {
        padding: 8px 12px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 14px;
        color: white;
    }

    .edit-btn {
        background-color: #3498db;
    }

    .delete-btn {
        background-color: #e74c3c;
    }

    .empty-message {
        text-align: center;
        font-size: 18px;
        color: #fff;
    }
</style>
<body>
    <h1>📦 Quản lý sản phẩm</h1>

    <?php if (empty($results)) : ?>
        <p class="empty-message">Không có sản phẩm nào.</p>
    <?php else : ?>
        <div class="product-container">
            <?php foreach ($results as $product) : ?>
                <div class="product-box">
                    <img src="<?= $product["image"] ?>" alt="Ảnh sản phẩm">
                    <p class="product-id">Mã sản phẩm: <?= $product["id"] ?></p>
                    <h3 class="product-name"><?= $product["name"] ?></h3>
                    <p class="product-price">Giá: <?= number_format($product["price"], 0, ',', '.') ?> ₫</p>
                    <p class="product-description" title="<?= $product["description"] ?>"><?= $product["description"] ?></p>

                    <div class="admin-actions">
                        <a href="edit_product.php?id=<?= $product["id"] ?>" class="edit-btn">✏️ Sửa</a>
                        <a href="delete_product.php?id=<?= $product["id"] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc muốn xoá sản phẩm này?');">Xoá</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>