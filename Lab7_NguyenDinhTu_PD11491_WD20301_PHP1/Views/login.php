
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form đăng nhập</title>
</head>
<body>
    <?php 
        if(isset($_SESSION["success"])){
            echo $_SESSION['success'];
        }
    ?>
    <form method="POST" action="index.php?action=login_confirm">
    <label>Email:</label>
    <input type="text" name="email" required><br>

    <label>Mật khẩu:</label>
    <input type="password" name="password" required><br>

    <button type="submit">Đăng nhập</button>
</form>
<a href="index.php?action=register_display">Đến trang đăng ký</a>
</body>
</html>