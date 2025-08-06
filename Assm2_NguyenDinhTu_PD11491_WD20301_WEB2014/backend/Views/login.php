
<!DOCTYPE html>
<html>
<head>
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="../Css/login.css">
    <link rel="stylesheet" href="../Css/common.css">

</head>
<body>
    <div class="login-container">
        <form class="login-form" method="POST" action="../Controllers/BaseController.php?action=login_confirm">
            <h2>Đăng nhập Admin</h2>

            <?php if (isset($_SESSION['message'])): ?>
                <div class="<?= strpos($_SESSION['message'], 'thất bại') !== false ? 'alert-error' : 'alert-success' ?>">
                    <?= $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <div class="input-group">
                <label for="username">Tên đăng nhập:</label>
                <input type="text" name="user_name" id="username" required>
            </div>

            <div class="input-group">
                <label for="password">Mật khẩu:</label>
                <input type="password" name="password" id="password" required>
            </div>

            <button class="btn-login" type="submit">Đăng nhập</button>
            
            <!--Lỗi kiểm form sẽ hiển thị ở đây-->
            <div id="login-error" style="color:red; margin-top: 10px; text-align:center;"></div>
        </form>
    </div>
    <script src="../Js/login.js"></script>
</body>
</html>