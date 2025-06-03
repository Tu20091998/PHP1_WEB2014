<?php
    
    //nạp trang lấy kết quả đăng ký từ cơ sở dữ liệu
    require_once ROOT."/Models/UserModel.php";

    //class chứa xử lý đăng ký, tương tác với cơ sở dữ liệu và màn hình
    class UserController{

        //hàm xử lý hiển thị form đăng ký
        public function register_display(){
            require_once ROOT."/Views/register.php";
        }

        //hàm xử lý đăng ký
        public function register_confirm(){
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //xét kết quả nhận được từ form người dùng đăng ký
                $email = $_POST['email'] ?? '';
                $password = $_POST['password'] ?? '';
                $confirm_password = $_POST['confirm_password'] ?? '';

                //xét mật khẩu và mật khẩu xác nhận không khớp
                if($password !== $confirm_password){
                    $error = 'Mật khẩu không khớp';
                    require_once ROOT.'/Views/register.php';
                    return;
                }

                //gọi đối tượng xử lý đăng ký ở database và lấy kết quả
                $user_model = new UserModel();
                $result = $user_model->RegisterUserModel($email,$password);

                //xét trả về kết quả ở màn hình
                if($result === true){
                    //nếu đăng ký được thì chuyển hướng về trang đăng nhập và thoát
                    $error = "Đăng ký thành công";
                    header('Location:BaseController.php?action=register_display');
                    exit;
                }
                else{
                    //nếu lỗi đăng ký thì gán lỗi và về trang đăng ký
                    $error = $result;
                    require_once ROOT.'/Views/register.php';
                }
            }
            //nếu phương thức khác post thì trả về trang báo lỗi
            else{
                require_once ROOT.'/Views/404.php';
            }
        }

        //hàm xử lý hiển thị form đăng nhập
        public function login_display(){
            require_once ROOT."/Views/login.php";
        }

        //hàm xử lý đăng nhập
        public function login_confirm(){
            
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                //nhận dữ liệu từ người dùng
                $email = $_POST["email"] ?? "";
                $password = $_POST["password"] ?? "";

                //gọi database để lấy kết quả xử lý
                $user_model = new UserModel();
                $user = $user_model->LoginUserModel($email,$password);

                //xét trả về kết quả của database
                if($user){
                    //gọi session để lưu tiến trình đăng nhập
                    session_start();

                    //lưu biến user vào phiên làm việc
                    $_SESSION["user"] = $user;

                    //chuyển hướng vào trang chủ , sau đó thoát
                    header("Location:BaseController.php?action=products_display");
                    exit;
                }
                else{
                    $error = "Bạn nhập sai email hoặc mật khẩu";
                    require_once ROOT."/Views/login.php";
                }
            }
            else{
                //nếu không phải phương thức post thì về trang đăng nhập
                require_once ROOT."/Views/login.php";
            }
        }

        //tạo hàm để đăng xuất khỏi tài khoản hiện tại
        public function logout_confirm(){
            //gọi phiên làm việc
            session_start();

            //huỷ phiên làm việc 
            session_destroy();

            //quay về lại trang đăng nhập
            header("Location:BaseController.php?action=login_display");
        }
    }
?>