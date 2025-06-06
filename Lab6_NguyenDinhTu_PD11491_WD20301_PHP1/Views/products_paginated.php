<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm có phân trang</title>
</head>
<body>
    <h1>Danh sách sản phẩm</h1>
    <p>Tổng số : <?php echo $total?> sản phẩm</p>
    <table border="1">
        <tr>
            <th>Tên sản phẩm</th>
            <th>Giá</th>
        </tr>
        <?php foreach ($products as $p): ?>
            <tr>
                <td><?php echo htmlspecialchars($p['name']); ?></td>
                <td><?php echo number_format($p['price']); ?> đ</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?action=list&page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>