<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/Config/db.php";

    //xử lý lấy dữ liệu từ database
    class UserModel{
        private $model;
        public function __construct(){
            $db = new Database();
            $this->model = $db->connect();
        }

        //hàm xử lý đăng nhập
        public function LoginUserModel($email,$password){
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();
            //lấy 1 dòng trả về
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //kiểm tra mật khẩu đã mã hoá và mật khẩu nhập vào
            if($user && password_verify($password,$user["password"])){
                return true;
            }
            else{
                return false;
            }
        }

        //hàm xử lý đăng ký
        public function RegisterUserModel($email,$password){
            //kiểm tra xem tài khoản có tồn tại trong cơ sở dữ liệu hay không
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                return false;
            }

            //nếu email chưa tồn tại thì mã hoá mật khẩu đưa vào
            $password_hashed = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO users(email,password) VALUES(:email,:password)";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->bindParam(":password",$password_hashed,PDO::PARAM_STR);
            
            //xét kết quả thực thi đăng ký
            if($stmt->execute()){
                return true;
            }
            else{
                return "Đăng ký thất bại";
            }

        }
    }
?>