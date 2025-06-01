<?php
    $products = [
        ["name" => "Áo thun", "price" => 99000, "image" => "link1.jpg", "description" => "Áo cotton mềm"]
    ];

    // Lấy sản phẩm đầu tiên để hiển thị (giả lập)
    $product = $products[0];
    $id = 1; // giả lập id
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa sản phẩm</title>
    <style>
        body {
            font-family: Arial;
            padding: 30px;
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }

        form {
            width: 40vw;
            margin: auto;
            background: #f1f1f1;
            padding: 20px;
            border-radius: 10px;
        }
        label {
            display: block;
            margin-top: 15px;
        }
        input, textarea {
            width: 38vw;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
        }
        button {
            margin-top: 20px;
            padding: 15px;
            width: 39.5vw;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
        }

        button:hover{
            background-color: lightgray;
        }

        form h2{
            text-align: center;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Sửa thông tin sản phẩm</h2>
        <label>ID sản phẩm:</label>
        <input type="text" name="id" value="<?php echo $id; ?>" readonly>

        <label>Tên sản phẩm:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>">

        <label>Giá:</label>
        <input type="number" name="price" value="<?php echo $product['price']; ?>">

        <label>Ảnh URL:</label>
        <input type="text" name="image" value="<?php echo $product['image']; ?>">

        <label>Mô tả:</label>
        <textarea name="description"><?php echo $product['description']; ?></textarea>

        <button type="submit">Cập nhật</button>
    </form>
</body>
</html>