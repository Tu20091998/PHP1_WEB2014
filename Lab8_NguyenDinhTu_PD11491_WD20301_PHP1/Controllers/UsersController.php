<?php
    //nạp trang xử lý dữ liệu người dùng
    require_once ROOT."/Models/UsersModel.php";

    class UsersController{
        
        private $user_model;
        public function __construct(){
            $this->user_model = new UsersModel();
        }

        //hàm xử lý hiển thị thông tin người dùng
        public function users_display(){
            $users = $this->user_model->getAllUsers();
            require_once ROOT."/Views/users_list.php";
        }
    }
?>