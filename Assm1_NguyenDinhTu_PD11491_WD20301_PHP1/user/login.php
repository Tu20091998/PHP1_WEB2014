<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập tài khoản</title>
</head>
<style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body{
        background: linear-gradient(to right, #4facfe, #00f2fe);
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: Arial, Helvetica, sans-serif;
    }

    .login-container{
        background: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 16px;
        width: 500px;
    }

    .login-form{
        text-align: center;
        margin-bottom: 24px;
        color: #333;
    }

    .input-group label{
        font-size: 20px;
        color: #333;
    }

    .input-group{
        margin-top: 10px;
    }

    .input-group input{
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 8px;
    }

    .input-group input:focus{
        border-color: #00f2fe;
        outline:none;
    }

    .btn-login{
        width: 100%;
        padding:12px;
        border: none;
        background-color: lightgray;
        color: #4facfe;
        border-radius: 10px;
        font-size: 18px;
        cursor: pointer;
    }

    .btn-login:hover{
        background-color: #00f2fe;
    }

    .signup-link{
        margin-top: 20px;
        margin-bottom: 10px;
    }

    .form-links{
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
    }

    .form-links button{
        padding:8px;
        border: none;
        background-color: lightgray;
        color: #4facfe;
        border-radius: 10px;
        font-size: 18px;
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
    <div class="login-container">
        <form class="login-form">
            <h2>Đăng nhập</h2>
            <div class="input-group">
                <label for="email">Email đăng nhập</label>
                <input type="text" id="email" name="email" placeholder="Nhập email đăng nhập" required>
            </div>
            <div class="input-group">
                <label for="password">Mật khẩu</label>
                <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
            </div>
            <br>
            <button type="submit" class="btn-login">Đăng nhập ngay</button>
            <p class="signup-link">Bạn chưa có tài khoản</p>
        </form>

        <div class="form-links">
            <button><a href="#">Đăng ký ngay</a></button>
            <button><a href="#">Quên mật khẩu</a></button>
        </div>
    </div>
</body>
</html>

