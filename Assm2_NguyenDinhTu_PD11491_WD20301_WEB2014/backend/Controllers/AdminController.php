<?php
    //nạp trang dữ liệu admin
    require_once ROOT."/Models/AdminModel.php";

    class AdminController{
        private $admin_model;

        public function __construct(){
            $this->admin_model = new AdminModel();
        }

        //hàm xử lý hiển thị trang chủ admin
        public function home_display(){
            require_once ROOT."/Views/home_admin.php";
        }
        
        //hàm xử lý hiển thị form đăng nhập
        public function login_display(){
            require_once ROOT."/Views/login.php";
        }

        //hàm xử lý đăng nhập
        public function login_confirm(){
            
            if($_SERVER["REQUEST_METHOD"] === "POST"){
                //nhận dữ liệu từ người dùng
                $username = $_POST["user_name"] ?? "";
                $password = $_POST["password"] ?? "";

                //gọi database để lấy kết quả xử lý
                $admin = $this->admin_model->LoginAdminModel($username,$password);

                //xét trả về kết quả của database
                if($admin){
                    //gọi session để lưu tiến trình đăng nhập
                    session_start();

                    //lưu biến user vào phiên làm việc
                    $_SESSION["admin_id"] = $admin["id"];

                    //lưu biến để hiển thị kết quả
                    $_SESSION["message"] = "Đăng nhập thành công !";

                    //chuyển hướng vào trang chủ , sau đó thoát
                    header("Location:BaseController.php?action=login_display");
                    exit;
                }
                else{
                    $_SESSION["message"] = "Đăng nhập thất bại !";
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
            if (!isset($_SESSION["admin_id"])) {
                header("Location: BaseController.php?action=login_display");
                exit();
            }
        
            // Lưu thông báo vào session TRƯỚC KHI hủy
            $_SESSION['message'] = 'Bạn đã đăng xuất thành công!';
        
            // Hủy toàn bộ session (kể cả login_message nếu không dùng session_regenerate_id)
            session_destroy();
        
            // Tạo session mới chỉ để chứa thông báo
            session_start();
            $_SESSION['message'] = 'Bạn đã đăng xuất thành công!';
        
            // Chuyển hướng về trang đăng nhập
            header("Location: BaseController.php?action=login_display");
            exit();
        }
    }
?>