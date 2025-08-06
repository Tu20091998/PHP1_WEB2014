<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="Css/header.css">
    <link rel="stylesheet" href="Css/common.css">
</head>
<body>
    <div class="menu">
    <div class="logo">🛍️ Trang quản trị 
        <strong>Shopping_Cart</strong>
    </div>
    <div class="nav-links">
        <a href="Controllers/BaseController.php?action=home_display" target="main">🏠 Trang chủ admin</a>
        <a href="Controllers/BaseController.php?action=users_display" target="main">👤 Người dùng</a>
        <a href="Controllers/BaseController.php?action=products_display" target="main">📦 Sản phẩm</a>
        <a href="Controllers/BaseController.php?action=categories_display" target="main">📁 Danh mục SP</a>
        <a href="Controllers/BaseController.php?action=order_display" target="main">🧾 Đơn hàng</a>
        <a href="Controllers/BaseController.php?action=reports_display" target="main">📊 Thống kê</a>
        <a href="Controllers/BaseController.php?action=comments_display" target="main">💬 Bình luận</a>
        <a href="Controllers/BaseController.php?action=logout_confirm" target="main" class="logout-link">🚪 Đăng xuất</a>
    </div>
</div>
