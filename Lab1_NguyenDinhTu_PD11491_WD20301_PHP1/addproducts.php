<?php
    //Thực hiện khai báo các biến kết nối với cơ sở dữ liệu
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "shopping_cart";

    //thực hiện kết nối với cơ sở dữ liệu
    $connect = new mysqli("localhost","root","","shopping_cart");

    if($connect -> connect_error){
        die("Ngừng kết nối!!!" . $connect -> connect_error);
    }
?>
<?php
session_start();
    //lấy yêu cầu thêm sản phẩm từ người dùng
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //kiểm tra nhấn nút tên của form đó
        if(isset($_POST["submit_product"])){
            //lấy các thông tin của sản phẩm được yêu cầu thêm vào
            $name = $_POST["name"];
            $price = $_POST["price"];
            $image = $_POST["image"];
            $description = $_POST["description"];
            
            //kiểm tra nếu trống thì sai
            if(empty($name) || empty($price) || empty($image) || empty($description)){
                echo "Vui lòng nhập giá trị sản phẩm hợp lệ!!!";
            }
            else{
                //sử dụng câu lệnh truy vấn
                $sql = "INSERT INTO products(name,price,image,description) VALUES (?,?,?,?)";
                
                //chuẩn bị câu lệnh
                $stmt = mysqli_prepare($connect, $sql);
                
                //gắn các giá trị vào câu lệnh
                $stmt->bind_param("ssss", $name, $price, $image, $description);
                
                //nếu thực thi được thì lưu vào session 
                if(mysqli_stmt_execute($stmt)){
                    echo "<script>alert('Bạn đã thêm sản phẩm thành công!!!');</script>";
                } else {
                    echo "<script>alert('Bạn đã thêm sản phẩm thất bại! Vui lòng kiểm tra lại!');</script>";
                }
                //chuyển hướng để tránh thêm lại lần nữa
                header("Location: addproducts.php");
            }
        }
        else{
            echo "Không tìm thấy yêu cầu của bạn!!";
        }
    }
    $connect->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 20px;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        background-color: #ffffff;
        border: 1px solid #dc3545; /* viền đỏ */
        border-radius: 6px;
        padding: 20px 25px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.05);
    }

    h1 {
        font-size: 24px;
        margin-bottom: 20px;
    }

    form {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    label {
        width: 100%;
        font-weight: bold;
    }

    select,
    input[type="text"],
    input[type="number"],
    textarea {
        width: 100%;
        padding: 8px 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    textarea {
        resize: vertical;
    }

    button {
        padding: 10px 20px;
        background-color: #28a745; /* xanh lá */
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    button:hover {
        background-color: #218838;
    }
</style>
<body>
    <div class="container">
        <h1>Thêm mặt hàng mới</h1>
        <form method="POST">
            <label for="name">Tên sản phẩm:</label>
            <select name="name" id="name" type="text" required>
                <option value="tablet">Tablet</option>
                <option value="phone">Phone</option>
                <option value="destop">Destop</option>
                <option value="laptop">Laptop</option>
            </select>

            <label for="price">Giá sản phẩm:</label>
            <input type="number" name="price" id="price" required>

            <label for="image">Hình ảnh (URL):</label>
            <input type="text" name="image" id="image" required>

            <label for="description">Mô tả sản phẩm:</label>
            <textarea name="description" id="description" placeholder="nhập vào mô tả"></textarea>

            <button type="submit" name="submit_product">Thêm sản phẩm</button>
        </form>
    </div>
</body>
</html>




