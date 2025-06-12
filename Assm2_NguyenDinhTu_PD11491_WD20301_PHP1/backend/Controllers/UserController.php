<?php
    //nạp trang dữ liệu admin
    require_once ROOT."/Models/UsersModel.php";

    //class xử lý thông tin người dùng
    class UserController{
        private $model;
        public function __construct(){
            $this->model = new UsersModel();
        }

        //hàm hiển thị thông tin người dùng
        public function users_display(){
            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $users = $this->model->getAllUsers();
            require_once ROOT."/Views/users.php";
        }

        public function user_delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
            $userId = $_POST['user_id'];

            $result = $this->model->deleteUserById($userId);

            if ($result) {
                $_SESSION['message'] = "Xóa người dùng thành công.";
            } else {
                $_SESSION['message'] = "Xóa thất bại hoặc ID không tồn tại.";
            }

            // Chuyển hướng về lại trang danh sách
            header("Location:BaseController.php?action=users_display");
            exit;
        }
    }
    }
?>