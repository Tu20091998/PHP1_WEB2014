<?php
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect("localhost", "root", "", "shopping_cart");
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn danh sách người dùng
$sql = "SELECT * FROM users";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách người dùng</title>
    <link rel="stylesheet" href="../Css/user.css">
</head>
<body>
    <h2>Danh sách người dùng</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Xác nhận mật khẩu</th>
            <th>Ngày đăng ký</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['confirm_password']; ?></td>
                <td><?php echo $row['register_date']; ?></td>
            </tr>
        <?php endwhile; ?>

    </table>
</body>
</html>