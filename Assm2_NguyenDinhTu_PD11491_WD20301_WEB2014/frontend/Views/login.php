
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="stylesheet" href="../Css/login.css">
    <link rel="stylesheet" href="../Css/common.css">
</head>
<body>
    <?php
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    ?>
    
    <?php
        if (isset($_SESSION['login_message'])) {
        echo "<script>alert('" . $_SESSION['login_message'] . "')</script>";
        unset($_SESSION['login_message']); // Xóa message sau khi hiển thị
    }
    ?>
    <div class="login-container">
        <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
        <!-- Hiển thị thông báo thành công từ đăng ký -->
        <?php if (isset($_SESSION['register_success'])): ?>
            <div class="alert alert-success">
                <?= htmlspecialchars($_SESSION['register_success']) ?>
            </div>
            <?php unset($_SESSION['register_success']); ?>
        <?php endif; ?>

        <form class="login-form" method="post" action="../Controllers/BaseController.php?action=login_confirm">
            <h2 style="text-align: center;">Đăng nhập</h2>
            <div class="input-group">
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" placeholder="Nhập email đăng nhập" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <br>
            <button type="submit" class="btn-login">Đăng nhập ngay</button>

            <div id="login-error" style="color:red; text-align:center; margin-top: 10px;"></div>

            <p class="signup-link">Bạn chưa có tài khoản ?</p>

        </form>

        <div class="form-links">
            <button><a href="../Controllers/BaseController.php?action=register_display">Đăng ký ngay</a></button>
            <button><a href="../Controllers/BaseController.php?action=forgot_password_display">Quên mật khẩu</a></button>
        </div>
    </div>

    <script src="../Js/login.js"></script>
</body>
</html>

