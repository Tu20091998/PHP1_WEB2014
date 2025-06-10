<?php
    // nạp trang xử lý dữ liệu
    require_once ROOT."/Models/UserModel.php";

    //class tương tác người dùng
    class UserController{
        private $user_model;
        public function __construct(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }

            $this->user_model = new UserModel();
        }

        //hàm xử lý hiển thị form đăng nhập
        public function login_display(){
            require_once ROOT."/Views/login.php";
        }

        //hàm xử lý trả về đăng nhập
        public function login_confirm(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                $email = $_POST["email"] ?? "";
                $password = $_POST["password"] ?? "";

                //kiểm tra các tham số truyền vào
                $user = $this->user_model->LoginUserModel($email,$password);

                //xét kết quả trả về của hàm xử lý
                if($user){
                    //lưu vào phiên làm việc
                    $_SESSION["success"] = "Chúc mừng bạn đã đăng nhập thành công !";
                    require_once ROOT."/Views/login.php";
                }
                else{
                    $_SESSION["success"] = "Email hoặc mật khẩu không đúng !";
                    require_once ROOT."/Views/login.php";
                }
            }
        }

        //hàm xử lý hiển thị đăng ký
        public function register_display(){
            require_once ROOT."/Views/register.php";
        }

        //hàm xử lý đăng ký
        public function register_confirm(){
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                //lấy dữ liệu từ form
                $email = $_POST["email"];
                $password = $_POST["password"];
                $password_confirm = $_POST["password_confirm"];

                //xét mật khẩu xác nhận và mật khẩu có khớp hay không?
                if($password !== $password_confirm){
                    $_SESSION["message"] = "Mật khẩu và mật khẩu xác nhận không khớp !";
                    header("Location:index.php?action=register_display");
                    exit;
                }

                //gọi xử lý trả về kết quả đăng ký
                $resutl = $this->user_model->RegisterUserModel($email,$password);

                //xét kết quả trả về
                if($resutl){
                    $_SESSION["message"] = "Bạn đã đăng ký thành công !";
                    header("Location:index.php?action=register_display");
                }
                else{
                    $_SESSION["message"] = "Đăng ký thất bại ! Tài khoản đã tồn tại";
                    header("Location:index.php?action=register_display");
                }
                exit;
            }
        }
    }

?>