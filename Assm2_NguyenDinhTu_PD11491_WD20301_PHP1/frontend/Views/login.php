<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>
    <div class="login-container">
        <form class="login-form" method="post" action="../Controllers/BaseController.php?action=login_confirm">
            <h2>Đăng nhập</h2>
            <div class="input-group">
                <label for="email">Email đăng nhập</label>
                <input type="text" id="email" name="email" placeholder="Nhập email đăng nhập" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <br>
            <button type="submit" class="btn-login">Đăng nhập ngay</button>
            <p class="signup-link">Bạn chưa có tài khoản</p>
        </form>

        <div class="form-links">
            <button><a href="../Controllers/BaseController.php?action=register_display">Đăng ký ngay</a></button>
            <button><a href="forgot_password.php">Quên mật khẩu</a></button>
        </div>
        <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    </div>
</body>
</html>

