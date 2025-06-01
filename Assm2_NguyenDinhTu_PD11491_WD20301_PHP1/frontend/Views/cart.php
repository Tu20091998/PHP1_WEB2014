<?php
$carts = [
    [
        "cart_id" => 1,
        "user_id" => 101,
        "product_id" => "P001",
        "quantity" => 2,
        "date_added" => "2025-05-27",
        "name" => "Cà phê sữa đá",
        "price" => 25000,
        "image" => "https://suckhoedoisong.qltns.mediacdn.vn/324455921873985536/2024/10/11/ca-phe-17286625880331663375860.png",
        "description" => "Ly cà phê sữa đá đậm đà, thơm ngon."
    ],
    [
        "cart_id" => 2,
        "user_id" => 101,
        "product_id" => "P002",
        "quantity" => 1,
        "date_added" => "2025-05-28",
        "name" => "Trà đào cam sả",
        "price" => 30000,
        "image" => "https://lypham.vn/wp-content/uploads/2024/09/cach-lam-tra-dao-cam-sa.jpg",
        "description" => "Trà đào thanh mát với vị cam sả dễ chịu."
    ],
    [
        "cart_id" => 3,
        "user_id" => 101,
        "product_id" => "P003",
        "quantity" => 3,
        "date_added" => "2025-05-28",
        "name" => "Bánh ngọt socola",
        "price" => 20000,
        "image" => "https://cdn.tgdd.vn/Files/2020/05/23/1257853/cach-lam-banh-chiffon-socola-bong-mem-chuan-vi-d-12-760x367.jpg",
        "description" => "Bánh mềm mịn với lớp socola tan chảy."
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link rel="stylesheet" href="../Css/cart.css">
</head>
<body>
    <h1>🛒 Danh sách giỏ hàng của người dùng</h1>
    <?php if (empty($carts)) : ?>
        <p>Danh sách trống</p>
    <?php else : ?>
        <table>
            <thead>
                <tr>
                    <th>Mã giỏ</th>
                    <th>Người dùng</th>
                    <th>Mã SP</th>
                    <th>Số lượng</th>
                    <th>Ngày thêm</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá</th>
                    <th>Hình ảnh</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php $totalPrice = 0; ?>
                <?php foreach ($carts as $cart) : ?>
                    <tr>
                        <td><?php echo $cart["cart_id"]; ?></td>
                        <td><?php echo $cart["user_id"]; ?></td>
                        <td><?php echo $cart["product_id"]; ?></td>
                        <td>
                            <form method="POST" >
                                <input type="hidden" name="cart_id" value="<?php echo $cart['cart_id']; ?>">
                                <button type="submit" name="decrease">➖</button>
                                <span style="margin: 0 10px;"><?php echo $cart["quantity"]; ?></span>
                                <button type="submit" name="increase">➕</button>
                            </form>
                        </td>
                        <td><?php echo $cart["date_added"]; ?></td>
                        <td><?php echo $cart["name"]; ?></td>
                        <td><?php echo number_format($cart["price"], 0, ',', '.') . ' ₫'; ?></td>
                        <?php $totalPrice += $cart["price"] * $cart["quantity"]; ?>
                        <td><img src="<?php echo $cart["image"]; ?>" alt="Hình ảnh"></td>
                        <td><?php echo $cart["description"]; ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="delete_id" value="<?php echo $cart["cart_id"]; ?>">
                                <button type="submit" name="delete_cart" onclick="return confirm('Bạn có chắc muốn xoá không?')">🗑️ Xoá</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p class="total-price"><strong>Tổng tiền: </strong><?php echo number_format($totalPrice, 0, ',', '.'); ?> ₫</p>

        <form method="POST" style="text-align: right;">
            <input type="hidden" name="user_id" value="<?php echo $_SESSION["user_id"]; ?>">
            <button type="submit" class="confirm-btn" name="order_confirm" onclick="return confirm('Bạn có chắc chắn muốn đặt hàng?')">
                ✅ Đặt hàng
            </button>
        </form>
        
    <?php endif; ?>
</body>
</html>

