<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User_profile</title>
    <link rel="stylesheet" href="../Css/common.css">
    <link rel="stylesheet" href="../Css/user_profile.css">
</head>
<body>
    <div class="profile-form">
        <h2>Thông tin tài khoản của bạn</h2>
        
        <?php if (isset($_SESSION['message'])): ?>
            <p style="color: green; text-align: center;"><?= $_SESSION['message'] ?></p>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form method="post" action="../Controllers/BaseController.php?action=user_profile_update_confirm">
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>

            <div class="form-group">
                <label>Điện thoại:</label>
                <input type="text" name="phone" value="<?= htmlspecialchars($user['phone']) ?>">
            </div>

            <div class="form-group">
                <label>Giới tính:</label>
                <select name="gender">
                    <option value="Nam" <?= $user['gender'] == 'Nam' ? 'selected' : '' ?>>Nam</option>
                    <option value="Nữ" <?= $user['gender'] == 'Nữ' ? 'selected' : '' ?>>Nữ</option>
                    <option value="Khác" <?= $user['gender'] == 'Khác' ? 'selected' : '' ?>>Khác</option>
                </select>
            </div>

            <div class="form-group">
                <label>Ngày sinh:</label>
                <input type="date" name="birthdate" value="<?= htmlspecialchars($user['birthdate']) ?>">
            </div>

            <div class="form-group">
                <label>Địa chỉ:</label>
                <textarea name="address"><?= htmlspecialchars($user['address']) ?></textarea>
            </div>

            <div class="form-group">
                <label>Ngày đăng ký:</label>
                <input type="text" value="<?= htmlspecialchars($user['register_date']) ?>" disabled>
            </div>

            <div class="form-group">
                <label>Vai trò:</label>
                <input type="text" value="<?= htmlspecialchars($user['role']) ?>" disabled>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-submit">Cập nhật</button>
            </div>
            <div class="form-group">
                <button class="btn-submit"><a href="../Controllers/BaseController.php?action=logout_confirm">Đăng xuất</a></button>
            </div>
        </form>
        
    </div>
</body>
</html>