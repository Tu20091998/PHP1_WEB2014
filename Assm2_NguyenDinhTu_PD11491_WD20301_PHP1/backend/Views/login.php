<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../Css/login.css">
</head>
<body>
    <div class="login-container">
        <h2>Đăng nhập Admin</h2>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= strpos($_SESSION['message'], 'thất bại') !== false ? 'error' : '' ?>">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form method="POST" action="../Controllers/BaseController.php?action=login_confirm">
            <label for="username">Tên đăng nhập:</label>
            <input type="text" name="user_name" id="username" required>

            <label for="password">Mật khẩu:</label>
            <input type="password" name="password" id="password" required>

            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>