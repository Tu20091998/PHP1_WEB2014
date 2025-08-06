<?php
// Bắt buộc phải có ở đầu file view
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <link rel="stylesheet" href="../Css/register.css">
    <link rel="stylesheet" href="../Css/common.css">
</head>
<body>
    <div class="register-container">
        <div class="announce">
            <!-- Hiển thị thông báo lỗi -->
            <?php if (isset($_SESSION['register_error'])): ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($_SESSION['register_error']) ?>
                </div>
                <?php unset($_SESSION['register_error']); ?>
            <?php endif; ?>
        </div>

        <form class="register-form" method="post" action="../Controllers/BaseController.php?action=register_confirm">
            <h2>Đăng ký</h2>

            <div class="input-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" id="fullname" name="fullname" placeholder="Nhập họ tên" required>
            </div>

            <div class="input-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Nhập email đăng ký" required>
            </div>

            <div class="input-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>

            <div class="input-group">
                <label>Giới tính:</label>
                <label><input type="radio" name="gender" value="Nam" required> Nam</label>
                <label><input type="radio" name="gender" value="Nữ"> Nữ</label>
                <label><input type="radio" name="gender" value="Khác"> Khác</label>
            </div>

            <div class="input-group">
                <label for="birthdate">Ngày sinh:</label>
                <input type="date" id="birthdate" name="birthdate" required>
            </div>

            <div class="input-group">
                <label for="address">Địa chỉ:</label>
                <input type="text" id="address" name="address" placeholder="Nhập địa chỉ" required>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu đăng ký" required>
            </div>

            <div class="input-group">
                <label for="confirm_password">Mật khẩu xác nhận:</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Nhập lại mật khẩu" required>
            </div>

            <br>
            <button type="submit" class="btn-register">Đăng ký ngay</button>

            <div id="register-error" style="color:red; text-align:center; margin-top: 10px;"></div>
        </form>
    </div>
    <script src="../Js/register.js"></script>
</body>
</html>