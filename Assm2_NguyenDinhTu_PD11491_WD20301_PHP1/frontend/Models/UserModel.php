<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    //class đăng ký cho người dùng
    class UserModel{
        private $conn;
        //tạo hàm trả về kết nối
        public function __construct(){
            $db = new Database();
            $this->conn = $db->connect();
        }

        //tạo hàm xử lý đăng ký
        public function RegisterUserModel($fullname,$email,$phone,$gender,$birthdate,$address,$password){

            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':email',$email,PDO::PARAM_STR);
            $stmt->execute();
            
            if($stmt->rowCount() > 0){
                return "Email đã tồn tại !";
            }

            $password_hashed = password_hash($password,PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (fullname, email, phone, gender, birthdate, address, password) 
                    VALUES (:fullname, :email, :phone, :gender, :birthdate, :address, :password)";

            $stmt = $this->conn->prepare($sql);

            $stmt->bindParam(':fullname', $fullname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
            $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
            $stmt->bindParam(':birthdate', $birthdate, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hashed, PDO::PARAM_STR);

            //xét kết quả trả về của đăng ký
            if($stmt->execute()){
                return true;
            }
            else{
                return "Đăng ký thất bại";
            }
        }

        //tạo hàm xử lý đăng nhập
        public function LoginUserModel($email,$password){
            $sql = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":email",$email,PDO::PARAM_STR);
            $stmt->execute();

            //lấy 1 dòng trả về
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            //kiểm tra mật khẩu đã mã hoá và mật khẩu nhập vào
            if($user && password_verify($password,$user["password"])){
                return $user;
            }
            return false;
        }

        //hàm xử lý kiểm tra mật khẩu cũ
        public function verifyPassword($email,$old_password){
            $stmt = $this->conn->prepare("SELECT password FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            return password_verify($old_password, $user["password"]);
        }

        //hàm xử lý cập nhật mật khẩu mới
        public function updatePassword($email, $new_password){
            $hashedPassword = password_hash($new_password,PASSWORD_DEFAULT);
            $stmt = $this->conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            return $stmt->execute([$hashedPassword,$email]);
        }  
    }
?>