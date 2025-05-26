<h2>Danh sách sản phẩm</h2>
<p>Dưới đây là danh sách sản phẩm của người dùng</p>

<table border="1" cellpadding="10" cellspacing="10">
    <tr>
        <th>Tên sản phẩm</th>
        <th>Giá sản phẩm</th>
    </tr>
    <?php foreach($product as $p): ?>
        <tr>
            <td><?php echo $p["name"]; ?></td>
            <td><?php echo number_format($p["price"]) . " VNĐ"; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
