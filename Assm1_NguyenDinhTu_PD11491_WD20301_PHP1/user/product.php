<?php
    $results = [
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ86GdUR7JKLInBHH0M7JlI-m7sU1n_ekhJRg&s", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
        ["id" => 1, "name" => "Áo thun", "price" => 99000, "image" => "https://hoaviet247.com/wp-content/uploads/2024/07/bo-hoa-tuoi-bh008-hong-do.webp", "description" => "Áo cotton mềm mại"],
    ];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
</head>
<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        background: linear-gradient(to right, #4facfe, #00f2fe);
        margin: 0;
        padding: 20px;
    }

    h1{
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    .product-container{
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        width: 100%;
        height: 100%;
    }

    .product-box{
        display: block;
        background-color: white;
        border-radius: 10px;
        box-shadow: 0 5px 10px;
        padding: 15px;
        width: 20%;
        text-align: center;
        height: 50%;
    }

    .product-box img{
        width: 100%;
        height: 150px;
        border-radius: 5px;
        object-fit: contain;
    }

    .product-box .product-name{
        font-size: clamp(20px,2vw,25px);
        margin: 10px;
        color: #2c3e50;
        max-height: 24px;
    }

    .product-box .product-price{
        margin: 10px;
        color: gray;
        max-height: 24px;
        font-size: clamp(10px,1.2vw,20px);
    }

    .product-box .product-add{
        margin-top: 10px;
        height: 50px
    }

    .product-box .product-description{
        font-size: clamp(10px,1.2vw,20px);
        margin: 10px;
        color: gray;
        height: 24px;
        text-overflow: ellipsis;
        overflow: hidden;
        white-space: nowrap;
        width: 70%;
        display: inline-block;
    }

    .product-box form button{
        padding: 10px;
        background-color: lightblue;
        cursor: pointer;
        font-size: clamp(10px,1.2vw,20px);
        color: blue;
        border-radius: 10px;
    }
</style>
<body>
    <h1>🛍️ Danh sách sản phẩm</h1>

    <?php if (empty($results)) : ?>
        <p class="empty-message">Danh sách trống</p>
    <?php else : ?>
        <div class="product-container">
            <?php foreach ($results as $product) : ?>
                <div class="product-box">
                    <img src="<?php echo $product["image"]; ?>" alt="Ảnh sản phẩm">
                    <h3 class="product-name"><?php echo $product["name"]; ?></h3>
                    <p class="product-price">Giá: <?php echo number_format($product["price"], 0, ',', '.') . ' ₫'; ?></p>
                    <p title="<?php echo $product["description"]; ?>" class="product-description"><?php echo $product["description"]; ?></p>
                    <form method="POST" class="product-add">
                        <input type="hidden" name="product_id" value="<?php echo $product["id"]; ?>">
                        <button type="submit" name="addCart">Thêm vào giỏ 🛒</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</body>
</html>