<h2>Danh sách sản phẩm</h2>
<ul>
    <?php foreach($product as $p)://hiển thị danh sách tên sản phẩm kèm giá?>
        <li><?php echo $p["name"]. "-" . number_format($p["price"]). "VNĐ";?></li>
    <?php endforeach;?>
</ul>