<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh mục kèm sản phẩm</title>
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
</body>
</html>