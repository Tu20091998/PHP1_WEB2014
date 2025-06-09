<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="Css/header.css">
</head>
<body>
    <div class="menu">
        <div class="logo">🛍️ Shopping Cart</div>
        <div class="nav-links">
            <a href="Controllers/BaseController.php?action=products_display" target="main">Trang chủ</a>
            <a href="Controllers/BaseController.php?action=login_display" target="main">Tài khoản</a>
            <a href="Controllers/BaseController.php?action=cart_display" target="main">🛒 Giỏ hàng</a>
            <a href="Controllers/BaseController.php?action=logout_confirm" target="main">Đăng xuất</a>
            <a href="" target="main">Lịch sử đơn hàng</a>
        </div>
        <form method="GET" target="main" action="Controllers/BaseController.php">
            <input type="hidden" name="action" value="search_product">
            <input type="text" name="keyword" placeholder="Tìm sản phẩm..." 
                value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
            <button type="submit">🔍</button>
        </form>
    </div>
