<?php //Mẫu Chèn thêm các mặt hàng vào cơ sở dữ liệu ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }

        .container {
            width: 50vw;
            margin: 50px auto;
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            margin-top: 20px;
            padding: 12px;
            background-color:gray;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color:white;
            color: black;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Thêm mặt hàng mới</h1>
        <form method="POST" action="../backend/addproduct.php">
            <label for="name">Tên sản phẩm:</label>
            <input type="text" name="name" id="name" required>

            <label for="price">Giá sản phẩm:</label>
            <input type="number" name="price" id="price" required>

            <label for="image">Hình ảnh (URL):</label>
            <input type="text" name="image" id="image" required>

            <label for="description">Mô tả sản phẩm:</label>
            <input type="text" name="description" id="description" required>

            <button type="submit" name="submit_product">Thêm sản phẩm</button>
        </form>
    </div>
</body>
</html>
