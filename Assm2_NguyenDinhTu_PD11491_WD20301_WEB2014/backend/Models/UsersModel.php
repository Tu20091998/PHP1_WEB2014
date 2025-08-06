<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

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

        //hàm xoá người dùng theo id
        public function deleteUserById($userId) {
            $stmt = $this->model->prepare("DELETE FROM users WHERE id = :id");
            return $stmt->execute([':id' => $userId]);
        }

        //hàm đếm số lượng người dùng
        public function countUsers(){
            $sql = "SELECT COUNT(*) FROM users";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            //trả về 1 cột chứa số đếm
            return $stmt->fetchColumn();
        }
    }
?>