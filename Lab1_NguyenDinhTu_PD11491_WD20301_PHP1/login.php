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
    //gọi để thực thi phiên người dùng
    session_start();

    //nhận yêu cầu từ người dùng
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        //loại bỏ khoảng trắng của email
        $email = trim($_POST["email"]);
        $password = $_POST["password"];

        //chuẩn bị câu lệnh truy vấn xem email có tồn tại hay không
        $sql = "SELECT id , password FROM users WHERE email = ?";

        //chuẩn bị câu lệnh và gắn email người dùng nhập vào để kiểm tra
        $stmt = $connect->prepare($sql);
        $stmt-> bind_param("s",$email);
        
        //chạy lệnh truy vấn và lưu vào bộ nhớ để xử lý sau này
        $stmt->execute();
        $stmt->store_result();

        //nếu có dòng trả về thì email có tồn tại trong database
        if($stmt->num_rows > 0){
            //tạo 2 biến để lưu kết quả truy vấn được
            $stmt->bind_result($id, $hashed_password);

            //đưa kết quả truy vấn vào 2 biến vừa tạo
            $stmt->fetch();

            //kiểm tra mật khẩu nếu đúng thì cho đăng nhập tiếp
            if(password_verify($password,$hashed_password)){
                $_SESSION["user_id"] = $id;
                $_SESSION["email"] = $email;

                echo "<script>
                alert('Đăng nhập thành công!');
                window.location.href = 'products.php';
                </script>";
                exit();
            }
            else{
                echo "Sai mật khẩu!";
            }
        }
        else{
            echo "Email không tồn tại";
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
    body{
        font-family: Arial, Helvetica, sans-serif;
        justify-items: center;
    }

    h2{
        text-align: center;
    }

    form{
        border: 1px solid green;
        padding: 20px;
        gap: 20px;
        font-size: 20px;
        background-color: #28a745;
        border-radius: 5px;
        width: 600px;
    }

    input[type="email"],
    input[type="password"]{
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        border-radius: 5px;
        border: none;
        font-size: 20px;
    }

    button{
        padding: 15px;
        border-radius: 5px;
        border: none;
        background-color: lightgreen;
    }

    button:hover{
        background-color: aqua;
    }
</style>
<body>
    <form method="POST">
        <h2>Đăng nhập</h2>
        Email: <input type="email" name="email" required><br><br>
        Mật khẩu: <input type="password" name="password" required><br><br>
        <button type="submit">Đăng nhập ngay</button>
    </form>
</body>
</html>