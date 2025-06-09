<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <link rel="stylesheet" href="../Css/forgot_password.css">
</head>
<style>
    .announce{
        text-align: center;
    }
</style>
<body>
    <div class="forgot-container" >
        <div class="announce">
            <?php session_start()?>
            <?php if (isset($_SESSION['error'])): ?>
                <div><?= $_SESSION['error'] ?></div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['success'])): ?>
                <div><?= $_SESSION['success'] ?></div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>
        </div>
        
        <form class="forgot-form" method="post" action="../Controllers/BaseController.php?action=forgot_password_confirm">
            <h2>Quên mật khẩu</h2>
            <div class="input-group">
                <label for="password">Mật khẩu cũ</label>
                <input type="password" id="password" name="old_password" placeholder="Nhập mật khẩu cũ" required>
            </div>
            <div class="input-group">
                <label for="password">Xác nhận lại mật khẩu mới</label>
                <input type="password" id="password" name="new_password" placeholder="Nhập mật khẩu mới" required>
            </div>
            <br>
            <button type="submit" class="btn-forgot">Đổi mật khẩu</button>
        </form>

        <div class="form-links">
            <button><a href="../Controllers/BaseController.php?action=login_display">Quay về trang đăng nhập</a></button>
        </div>
</body>
</html>