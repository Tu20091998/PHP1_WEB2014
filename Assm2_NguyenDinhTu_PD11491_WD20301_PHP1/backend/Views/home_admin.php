<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục kèm sản phẩm</title>
    <link rel="stylesheet" href="../Css/home_admin.css">
</head>
<body>
    <h1>Tình hình chung của Shopping_Cart</h1>
    <h2>Danh mục và sản phẩm đã hết hàng</h2>
    <table border="1">
        <tr>
            <th>ID SP</th>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Mô tả</th>
            <th>Số lượng</th>
            <th>ID danh mục</th>
            <th>Tên danh mục</th>
        </tr>
        <?php foreach ($products_out_of_stock_list as $p): ?>
        <tr>
            <td><?= $p['id'] ?></td>
            <td><?= $p['name'] ?></td>
            <td><?= number_format($p['price']) ?> đ</td>
            <td><img src="<?= $p['image'] ?>" width="60"></td>
            <td><?= $p['description'] ?></td>
            <td><?= $p['product_quantity'] ?></td>
            <td><?= $p['category_id'] ?></td>
            <td><?= $p['category_name'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <hr>
    <h2>Danh sách sản phẩm bán chạy</h2>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Đã bán</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1;
            foreach ($best_seller as $product): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="80"></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= number_format($product['price']) ?> VND</td>
                    <td><?= $product['total_sold'] ?> sản phẩm</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <h2>Danh sách sản phẩm có lượt bán thấp</h2>
    
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Đã bán</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $stt = 1;
            foreach ($lowest_seller as $product): ?>
                <tr>
                    <td><?= $stt++ ?></td>
                    <td><img src="<?= $product['image'] ?>" alt="<?= $product['name'] ?>" width="80"></td>
                    <td><?= $product['name'] ?></td>
                    <td><?= number_format($product['price']) ?> VND</td>
                    <td><?= $product['total_sold'] ?> sản phẩm</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <hr>
    <h2>Tổng số sản phẩm đã bán được: <?php echo $products_sum_sales ?></h2>
    <h2>Danh sách sản phẩm và số lượng đã bán</h2>
    <table border="1">
        <thead>
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng đã bán</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $stt = 1;
                
                foreach ($product_list_quantity_sales as $product): 
            ?>
                <tr>
                    <td><?php echo $stt++; ?></td>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img src="<?php echo htmlspecialchars($product['image']); ?>" width="60">
                        <?php else: ?>
                            <span>No image</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                    <td><?php echo number_format($product['price'], 0, ',', '.'); ?> VND</td>
                    <td><?php echo $product['total_sold']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>