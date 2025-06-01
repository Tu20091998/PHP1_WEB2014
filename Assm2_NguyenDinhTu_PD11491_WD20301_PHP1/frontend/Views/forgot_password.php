<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../Css/forgot_password.css">
</head>
<body>
    <div class="forgot-container">
        <form class="forgot-form">
            <h2>Quên mật khẩu</h2>
            <div class="input-group">
                <label for="email">Email khôi phục</label>
                <input type="text" id="email" name="email" placeholder="Nhập tên đăng nhập" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu khôi phục</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu khôi phục" required>
            </div>
            <div class="input-group">
                <label for="password">Xác nhận mật khẩu khôi phục</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu xác nhận" required>
            </div>
            <br>
            <button type="submit" class="btn-forgot">Đổi mật khẩu</button>
        </form>

        <div class="form-links">
            <button><a href="login.php">Quay về trang đăng nhập</a></button>
        </div>
</body>
</html>