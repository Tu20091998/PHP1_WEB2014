<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="../Css/users.css">
</head>
<body>

    <h2>Danh sách người dùng</h2>
    <h4>Số lượng người dùng: <?php echo $users_count?></h4>
    <?php if (isset($_SESSION['message'])): ?>
            <div class="message <?= strpos($_SESSION['message'], 'thất bại') !== false ? 'error' : '' ?>">
                <?= $_SESSION['message']; ?>
            </div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Ngày đăng ký</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['password']) ?></td>
            <td><?= htmlspecialchars($user['register_date']) ?></td>
            <td>
                <form method="POST" action="../Controllers/BaseController.php?action=user_delete" onsubmit="return confirm('Bạn có chắc muốn xóa người dùng này?');">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                    <button type="submit" class="delete-button">Xóa</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a class="back-btn" href="../Controllers/BaseController.php?action=admin_home">← Về trang chủ Admin</a>
</body>
</html>