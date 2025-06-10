<?php
    //nạp kết nối database
    require_once ROOT."/Config/db.php";

    //class xử lý dữ liệu người dùng
    class UsersModel{
        private $model;

        public function __construct(){
            $db = new Database();
            $this->model = $db->connect();
        }

        //hàm xử lý hiển thị danh sách người dùng
        public function getAllUsers(){
            $sql = "SELECT * FROM users";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>