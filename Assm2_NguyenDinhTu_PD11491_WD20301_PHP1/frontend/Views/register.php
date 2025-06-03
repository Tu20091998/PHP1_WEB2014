<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../Css/register.css">
</head>
<body>
    <div class="register-container">
        <form class="register-form" method="post" action="../Controllers/BaseController.php?action=register_confirm">
            <h2>Đăng ký</h2>
            <div class="input-group">
                <label for="email">Email đăng ký</label>
                <input type="text" id="email" name="email" placeholder="Nhập email đăng ký" required>
            </div>

            <div class="input-group">
                <label for="email">Mật khẩu đăng ký</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu đăng ký" required>
            </div>

            <div class="input-group">
                <label for="confirm_password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập mật khẩu xác nhận" required>
            </div>
            <br>
            <button type="submit" class="btn-register">Đăng ký ngay</button>
        </form>
        <div class="form-links">
            <button><a href="login.php">Quay về trang đăng nhập</a></button>
        </div>
        <br>
        <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
    </div>
</body>
</html>