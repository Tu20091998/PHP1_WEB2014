<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";
    class AdminModel {
        private $model;

        public function __construct(){
            $db = new Database();
            $this->model = $db->connect();
        }

        //tạo hàm xử lý đăng nhập
        public function LoginAdminModel($username,$password){
            $sql = "SELECT * FROM admins WHERE username = :username";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(":username",$username,PDO::PARAM_STR);
            $stmt->execute();

            //lấy 1 dòng trả về
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            //kiểm tra mật khẩu đã mã hoá và mật khẩu nhập vào
            if($admin && password_verify($password,$admin["password"])){
                return $admin;
            }
            return false;
        }

        
    }
?>