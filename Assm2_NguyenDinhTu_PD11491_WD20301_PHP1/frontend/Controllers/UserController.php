<?php
    
    //nạp trang lấy kết quả đăng ký từ cơ sở dữ liệu
    require_once ROOT."/Models/UserModel.php";

    //class chứa xử lý đăng ký, tương tác với cơ sở dữ liệu và màn hình
    class UserController{

        private $user_model;

        public function __construct(){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $this->user_model = new UserModel();
        }

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
                    $_SESSION['register_error'] = 'Mật khẩu không khớp !';
                    header("Location: BaseController.php?action=register_display");
                    exit;
                }

                //gọi đối tượng xử lý đăng ký ở database và lấy kết quả
                $result = $this->user_model->RegisterUserModel($email,$password);

                //xét trả về kết quả ở màn hình
                if($result === true){
                    //nếu đăng ký được thì thông báo đăng ký thành công
                    $_SESSION['register_success'] = 'Đăng ký thành công! Vui lòng đăng nhập'; 
                    header("Location: BaseController.php?action=login_display");
                }
                else{
                    //nếu lỗi đăng ký thì gán lỗi và về trang đăng ký
                    $_SESSION['register_error'] = 'Đăng ký thất bại. Vui lòng thử lại';
                    header("Location: BaseController.php?action=register_display");
                }
                exit;
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
                $user = $this->user_model->LoginUserModel($email,$password);

                //xét trả về kết quả của database
                if($user){
                    //gọi session để lưu tiến trình đăng nhập
                    session_start();

                    //lưu biến user vào phiên làm việc
                    $_SESSION["user_id"] = $user["id"];

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

        public function logout_confirm() {
            // Bắt buộc gọi session_start() đầu tiên
            session_start();

            // Kiểm tra nếu chưa đăng nhập thì không cần đăng xuất
            if (!isset($_SESSION["user_id"])) {
                header("Location: BaseController.php?action=login_display");
                exit();
            }
        
            // Lưu thông báo vào session TRƯỚC KHI hủy
            $_SESSION['login_message'] = 'Bạn đã đăng xuất thành công!';
        
            // Hủy toàn bộ session (kể cả login_message nếu không dùng session_regenerate_id)
            session_destroy();
        
            // Tạo session mới chỉ để chứa thông báo
            session_start();
            $_SESSION['login_message'] = 'Bạn đã đăng xuất thành công!';
        
            // Chuyển hướng về trang đăng nhập
            header("Location: BaseController.php?action=login_display");
            exit();
        }

        //hàm hiển thị form đổi mật khẩu
        public function showChangeProduct(){
            require_once ROOT."/Views/forgot_password.php";
        }

        //hàm xử lý đổi mật khẩu
        public function handleChangePassword(){
            //nhận yêu cầu người dùng
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                session_start();
                $user_id = $_SESSION["user_id"] ?? null;
                $old_password = $_POST["old_password"] ?? "";
                $new_password = $_POST["new_password"] ?? "";

                //kiểm tra đăng nhập hay chưa?
                if (!isset($_SESSION["user_id"])) {
                    $_SESSION['login_message'] = 'Bạn cần đăng nhập để đổi mật khẩu';
                    header("Location: BaseController.php?action=login_display");
                    exit(); // Luôn dùng exit() sau header Location
                }

                //kiểm tra mật khẩu cũ
                if(!$this->user_model->verifyPassword($user_id,$old_password)){
                    $_SESSION['error'] = 'Mật khẩu cũ không đúng';
                    header("Location: BaseController.php?action=forgot_password_display");
                    exit;
                }

                //cập nhật mật khẩu mới
                if($this->user_model->updatePassword($user_id,$new_password)){
                    $_SESSION["success"] = "Đổi mật khẩu thành công !";
                }
                else{
                    $_SESSION["error"] = "Có lỗi xảy ra !";
                }

                header("Location: BaseController.php?action=forgot_password_display");
                exit(); // Luôn dùng exit() sau header Location
            }
        }
    }
?>