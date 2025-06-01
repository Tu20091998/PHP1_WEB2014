<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
</head>
<style>
    body{
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        width: 100%;
        height: 100%;
    }

    .menu{
        background-color: lightgray;
        display: flex;
        padding: 20px;
        justify-content: space-between;
        overflow: hidden;
    }

    .menu .logo{
        color: black;
        font-size: 24px;
        font-weight: bold;
        padding: 10px;
    }

    .menu .nav-links{
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .menu a{
        color: black;
        text-decoration: none;
        padding: 14px;
        display: block;
        font-size: 20px;
    }

    .menu a:hover {
        background-color: lightblue;
    }

    .menu form{
        display: flex;
        align-items: center;
    }

    .menu input[type="text"]{
        padding: 6px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
    }

    .menu button {
        padding: 10px;
        margin-left: 5px;
        font-size: 16px;
        border: none;
        background-color: #00bcd4;
        color: white;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .menu button:hover {
        background-color: #0097a7;
    }

    iframe {
        width: 100%;
        height: 600px;
        border: none;
    }

    .footer {
        background-color:lightgray;
        padding: 10px;
        text-align: center;
        color: #333;
    }
</style>
<body>
    <div class="menu">
        <div class="logo">🛍️ Shopping Cart</div>
        <div class="nav-links">
            <a href="product.php" target="content">Trang chủ</a>
            <a href="add_product.php" target="content">Thêm sản phẩm</a>
            <a href="user.php" target="content">Tài khoản người dùng</a>
            <a href="order.php" target="content">🛒 Đơn hàng</a>
            <a href="login.php" target="content">Đăng xuất</a>
        </div>
        <form method="GET" action="" target="content">
            <input type="text" name="keyword" placeholder="Tìm sản phẩm...">
            <button type="submit">🔍</button>
        </form>
    </div>

    <iframe src="product.php" name="content"></iframe>

    <div class="footer">
        <p>Cảm ơn bạn đã đến với trang web của tôi ❤️</p>
    </div>
</body>
</html>