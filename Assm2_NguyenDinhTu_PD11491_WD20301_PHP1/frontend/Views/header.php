<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link rel="stylesheet" href="Css/common.css">
    <link rel="stylesheet" href="Css/header.css">
    <link rel="stylesheet" href="Css/main.css">
    <link rel="stylesheet" href="Css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="logo">🛍️ Shopping Cart</div>

        <!-- Thêm bên trong <header> -->
        <div class="menu-toggle" id="menu-toggle">
            <i class="fa-solid fa-bars"></i>
        </div>
        
        <div class="navbar" id="navbar">
            <ul class="menu">
                <li><a href="Controllers/BaseController.php?action=products_display" target="main">Trang chủ</a></li>
                <li><a href="Controllers/BaseController.php?action=login_display" target="main">Đăng nhập</a></li>
                <li><a href="Controllers/BaseController.php?action=logout_confirm" target="main">Đăng xuất</a></li>
                <li><a href="Controllers/BaseController.php?action=order_display" target="main">Đơn hàng</a></li>
            </ul>
        </div>

        <div class="cart-container">
            <a href="Controllers/BaseController.php?action=cart_display" target="main"><i class="fa-solid fa-cart-shopping"></i></a>
        </div>

        <form method="GET" target="main" action="Controllers/BaseController.php" class="search-form"> 
            <input type="hidden" name="action" value="search_product">
            <div class="search-container">
                <input type="text" name="keyword" placeholder="Tìm sản phẩm..." 
                value="<?php echo isset($_GET['keyword']) ? htmlspecialchars($_GET['keyword']) : ''; ?>">
                <button type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </form>
    </header>

    <script>
        //js menu toggle
        const toggleBtn = document.getElementById("menu-toggle");
        const navbar = document.getElementById("navbar");

        toggleBtn.addEventListener("click", ()=>{
            navbar.classList.toggle("active");
        });
    </script>

