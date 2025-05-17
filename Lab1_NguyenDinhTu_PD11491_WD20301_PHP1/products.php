<?php
    //Thực hiện khai báo các biến kết nối với cơ sở dữ liệu
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "shopping_cart";

    //thực hiện kết nối với cơ sở dữ liệu
    $connect = new mysqli("localhost","root","","shopping_cart");

    if($connect -> connect_error){
        die("Ngừng kết nối!!!" . $connect -> connect_error);
    }
?>

<?php
    session_start();
    //nếu người dùng chưa đăng nhập thì quay về trang đăng nhập
    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }
    //truy vấn lấy ra hết sản phẩm và giỏ hàng của người dùng
    $sql = "SELECT * FROM cart JOIN products ON cart.product_id = products.id";

    //truy vấn nhanh
    $result = mysqli_query($connect, $sql);

    //nếu tồn tại thì lấy ra đầy đủ thông tin có chứa khoá ngoại của 2 bảng
    if(mysqli_num_rows($result) > 0){
        $results = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <style>
        .product-list{
            display: flex;
            flex-wrap: wrap;
            gap: 16px;
            border-radius: 10px;
            padding: 10px;
            width: 100%;
        }

        .product{
            display: flex;
            width: 30%;
            margin: auto
        }

        .product img{
            width: 150px;
            height: 150px;
        }
    </style>
</head>
<body>

    <h1>🛍️ Danh sách các mặt hàng</h1>

    <?php if (empty($results)) : ?>
        <p>Danh sách trống</p>
    <?php else : ?>
        <div class="product-list">
            <?php foreach ($results as $product) : ?>
                <div class="product">
                    <img src="<?php echo $product["image"]; ?>" alt="Ảnh sản phẩm">
                    <div class="product-info">
                        <h3><?php echo $product["name"]; ?></h3>
                        <p><strong>ID:</strong> <?php echo $product["id"]; ?></p>
                        <p><strong>Giá:</strong> <?php echo number_format($product["price"], 0, ',', '.') . ' ₫'; ?></p>
                        <p><strong>Mô tả:</strong> <?php echo $product["description"]; ?></p>
                        <form method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                            <button type="submit" name="addCart">Thêm vào giỏ 🛒</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

</body>
</html>