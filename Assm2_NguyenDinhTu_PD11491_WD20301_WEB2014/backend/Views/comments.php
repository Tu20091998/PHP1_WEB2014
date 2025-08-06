<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý bình luận theo sản phẩm</title>
    <link rel="stylesheet" href="../Css/common.css">
    <link rel="stylesheet" href="../Css/comments.css">
</head>
<body>
    <div class="page-wrapper">
        <h2 style="color: var(--primary-color); text-align:center; margin-bottom: 1.5rem;">Quản lý bình luận theo sản phẩm</h2>

        
        <?php 
             if (isset($_SESSION['message'])): //thông báo?>
            <div class="message success"><?= $_SESSION['message'] ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <!-- FORM CHỌN SẢN PHẨM và danh mục -->
        <form method="GET" action="../Controllers/BaseController.php" class="product-filter-form">
            <input type="hidden" name="action" value="comments_display">

            <!-- Chọn danh mục -->
            <label for="category">📂 Chọn danh mục:</label>
            <select name="category_id" id="category" onchange="this.form.submit()">
                <option value="">-- Tất cả danh mục --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['category_id'] ?>" <?= isset($_GET['category_id']) && $_GET['category_id'] == $cat['category_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['category_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label for="product">🛒 Chọn sản phẩm:</label>
            <select name="product_id" id="product" onchange="this.form.submit()">
                <option value="">-- Chọn sản phẩm --</option>
                <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>" <?= isset($_GET['product_id']) && $_GET['product_id'] == $p['id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($p['name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <!-- DANH SÁCH BÌNH LUẬN -->
        <?php if ($product_id && !empty($comments)): ?>
            <table class="comments-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Bình luận</th>
                        <th>Ngày</th>
                        <th>Đánh giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $c): ?>
                        <tr>
                            <td data-label="ID"><?= $c['comment_id'] ?></td>
                            <td data-label="Người dùng"><?= htmlspecialchars($c['fullname']) ?></td>
                            <td data-label="Bình luận"><?= nl2br(htmlspecialchars($c['comment'])) ?></td>
                            <td data-label="Ngày"><?= $c['created_at'] ?></td>
                            <td data-label="Đánh giá"><?= $c['rating'] ?> ⭐</td>
                            <td data-label="Hành động">
                                <a class="action-button" href="../Controllers/BaseController.php?action=hidden_comment_confirm&comment_id=<?= $c['comment_id'] ?>&product_id=<?= $c["product_id"]?>" onclick="return confirm('Ẩn bình luận này?')">Ẩn</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif ($product_id): ?>
            <p class="no-comments">Không có bình luận nào cho sản phẩm này.</p>
        <?php endif; ?>
    </div>
</body>
</html>