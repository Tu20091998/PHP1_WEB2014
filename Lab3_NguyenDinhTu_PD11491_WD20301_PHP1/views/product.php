<h2>Danh sách sản phẩm</h2>
<p>Dưới đây là danh sách sản phẩm của người dùng</p>
<ul>
    <?php foreach($product as $p):?>
        <li><?php echo "Tên sản phẩm : ". $p["name"] . " - " . "Giá sản phẩm: ". $p["price"]. "VNĐ"?></li>
    <?php endforeach;?>
</ul>
