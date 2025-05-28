<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding:0;
    }

    body{
        background: linear-gradient(to right, #4facfe, #00f2fe);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
    }

    .register-container{
        background: white;
        padding: 50px;
        border-radius: 10px;
        box-shadow: 0 5px 16px;
        width: 400px;
    }

    .register-form{
        text-align: center;
        margin-bottom: 24px;
    }

    .input-group{
        margin-top: 10px;
    }

    .input-group label{
        font-size: 18px;
        color: #333;
    }

    .input-group input{
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .input-group input:focus{
        border-color: #00f2fe;
        outline: none;
    }

    .btn-register{
        width: 100%;
        padding:12px;
        border: none;
        background-color: lightgray;
        color: #4facfe;
        border-radius: 10px;
        font-size: 18px;
        cursor: pointer;
        margin-bottom: 10px;
    }

    button:hover{
        background-color: #00f2fe;
    }

    .signup-link{
        color: #4facfe;
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .form-links{
        margin-top: 10px;
        text-align: center;
    }

    .form-links button{
        padding:8px;
        border: none;
        background-color: lightgray;
        color: #4facfe;
        border-radius: 10px;
        font-size: 20px;
        cursor: pointer;
    }

    .form-links a {
        padding:8px;
        border: none;
        background-color: lightgray;
        color: #4facfe;
        border-radius: 10px;
        font-size: 15px;
        cursor: pointer;
        text-decoration: none;
    }       

    .form-links a:hover {
        background-color: #00f2fe;
        color: white;
    }
</style>
<body>
    <div class="register-container">
        <form class="register-form">
            <h2>Đăng ký</h2>
            <div class="input-group">
                <label for="email">Email đăng ký</label>
                <input type="text" id="email" name="email" placeholder="Nhập email đăng ký" required>
            </div>

            <div class="input-group">
                <label for="email">Mật khẩu đăng ký</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu đăng ký" required>
            </div>

            <div class="input-group">
                <label for="confirm-password">Xác nhận mật khẩu</label>
                <input type="password" id="confirm-password" name="confirm-password" placeholder="Nhập mật khẩu xác nhận" required>
            </div>
            <br>
            <button type="submit" class="btn-register">Đăng nhập ngay</button>
        </form>
        <div class="form-links">
            <button><a href="#">Quay về trang đăng nhập</a></button>
        </div>
    </div>
</body>
</html>