<?php
    
    //nạp trang lấy kết quả đăng ký từ cơ sở dữ liệu
    require_once ROOT."/Models/UserModel.php";

    //class chứa xử lý người dùng, tương tác với cơ sở dữ liệu và màn hình
    class UserController{

        private $user_model;
        private $product_model;

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
                //gọi model lấy thông tin email
                $getAllUsers = $this->user_model->getAllUsers();

                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $gender = $_POST['gender'];
                $birthdate = $_POST['birthdate'];
                $address = $_POST['address'];
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];

                //kiểm tra nếu email và số điện thoại đã tồn tại trong database
                foreach($getAllUsers as $user){
                    if($user["email"] === $email){
                        $_SESSION["register_error"] = "Email đã tồn tại !";
                        header("Location: BaseController.php?action=register_display");
                        exit;
                    }
                    
                    if($user["phone"] === $phone){
                        $_SESSION["register_error"] = "Số điện thoại đã tồn tại !";
                        header("Location: BaseController.php?action=register_display");
                        exit;
                    }
                }

                //nếu mật khẩu nhập vào không giống mật khẩu xác nhận
                if($password !== $confirm_password){
                    $_SESSION['register_error'] = 'Mật khẩu không khớp !';
                    header("Location: BaseController.php?action=register_display");
                    exit;
                }

                $result = $this->user_model->RegisterUserModel($fullname,$email,$phone,$gender,$birthdate,$address,$password);

                if($result === true){
                    $_SESSION['register_success'] = 'Đăng ký thành công! Vui lòng đăng nhập'; 
                    header("Location: BaseController.php?action=login_display");
                }
                else{
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
                $email = $_POST["email"] ?? null;
                $old_password = $_POST["old_password"] ?? "";
                $new_password = $_POST["new_password"] ?? "";

                //kiểm tra mật khẩu cũ
                if(!$this->user_model->verifyPassword($email,$old_password)){
                    $_SESSION['error'] = 'Mật khẩu cũ không đúng';
                    header("Location: BaseController.php?action=forgot_password_display");
                    exit;
                }

                //cập nhật mật khẩu mới
                if($this->user_model->updatePassword($email,$new_password)){
                    $_SESSION["success"] = "Đổi mật khẩu thành công !";
                }
                else{
                    $_SESSION["error"] = "Có lỗi xảy ra !";
                }

                header("Location: BaseController.php?action=forgot_password_display");
                exit(); // Luôn dùng exit() sau header Location
            }
        }

        //hàm hiển thị phần liên hệ
        public function contact_display(){
            require_once ROOT."/Views/contact.php";
        }

        //hàm xử lý hiển thị thông tin người dùng
        public function user_profile_display(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){

                //kiểm tra đăng nhập hay chưa?
                if (!isset($_SESSION["user_id"])) {
                    $_SESSION['login_message'] = 'Bạn cần đăng nhập để xem thông tin cá nhân của bạn !';
                    header("Location: BaseController.php?action=login_display");
                    exit();
                }

                $user_id = $_SESSION["user_id"];

                $user = $this->user_model->getUserProfileById($user_id);

                require_once ROOT."/Views/user_profile.php";
            }
        }

        //hàm xử lý cập nhật thông tin người dùng
        public function user_profile_update_confirm(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $user_id = $_SESSION["user_id"];

                //nhận thông tin từ form
                $data = [
                    "fullname" => $_POST["fullname"],
                    "email" => $_POST["email"],
                    "phone" => $_POST["phone"],
                    "gender" => $_POST["gender"],
                    "birthdate" => $_POST["birthdate"],
                    "address" => $_POST["address"]
                ];

                //xét cập nhật thông tin
                if($this->user_model->updateUserProfileById($data,$user_id)){
                    $_SESSION["message"] = "Bạn đã cập nhật thông tin thành công !";
                    $user = $this->user_model->getUserProfileById($user_id);
                    require_once ROOT."/Views/user_profile.php";
                }
                else{
                    $_SESSION["message"] = "Đã có lỗi cập nhật thông tin của bạn !";
                    $user = $this->user_model->getUserProfileById($user_id);
                    require_once ROOT."/Views/user_profile.php";
                }
            }
        }

        //hàm xử lý thêm bình luận của người dùng
        public function comment_add_confirm(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                //lấy id người dùng từ phiên đăng nhập
                $user_id = $_SESSION["user_id"];
                $product_id = $_POST["product_id"];

                //nhận dữ liệu đánh giá và bình luận của người dùng
                $data = [
                    "rating" => $_POST["rating"],
                    "comment" => $_POST["comment"]
                ];

                //xét thêm bình luận và đánh giá
                if($this->user_model->addUserComments($user_id,$product_id,$data)){
                    $_SESSION["message"] = "Bạn đã thêm đánh giá và bình luận thành công!";
                }
                else{
                    $_SESSION["message"] = "Lỗi khi thêm đánh giá và bình luận !";
                }

                header("Location: BaseController.php?action=product_detail&id=$product_id");
                exit;
            }
        }

    }
?>