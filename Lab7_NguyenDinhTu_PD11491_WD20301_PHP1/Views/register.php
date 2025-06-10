<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form đăng ký</title>
</head>
<body>
    <h2>Đăng ký tài khoản</h2>

    <?php if (!empty($_SESSION['message'])): ?>
        <p style="color: green;"><?= $_SESSION['message'] ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="index.php?action=register_confirm" method="POST">
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Mật khẩu:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Mật khẩu xác nhận:</label><br>
        <input type="password_confirm" name="password_confirm" required><br><br>

        <button type="submit">Đăng ký</button>
    </form>
    <a href="index.php?action=login_display">Về trang đăng nhập</a>
</body>
</html>