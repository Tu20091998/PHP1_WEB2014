<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form thêm sản phẩm</title>
    <link rel="stylesheet" href="../Css/add_product.css">
</head>
<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert error"><?= $_SESSION['message'] ?></div>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <form action="../Controllers/BaseController.php?action=add_category_confirm" method="post" enctype="multipart/form-data">
        <label>Tên danh mục:</label>
        <input type="text" name="category_name" required>

        <button type="submit">Thêm danh mục</button>
    </form>

    <a href="../Controllers/BaseController.php?action=categories_display" target="main">Quay về trang danh mục sản phẩm</a>
</body>
</html>