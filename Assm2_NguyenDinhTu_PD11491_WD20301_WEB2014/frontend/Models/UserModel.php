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

        //lấy toàn bộ thông tin của người dùng
        public function getAllUsers() {
            $sql = "SELECT * FROM users";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm xử lý đăng ký
        public function RegisterUserModel($fullname,$email,$phone,$gender,$birthdate,$address,$password){

            //mã hoá mật khẩu
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

        //tạo hàm hiển thị thông tin người dùng
        public function getUserProfileById($user_id){
            $sql = "SELECT * 
                    FROM users 
                    WHERE id = :user_id";
                    
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //tạo hàm cập nhật thông tin người dùng
        public function updateUserProfileById($data,$user_id){
            try{
                $sql = "UPDATE users 
                        SET fullname = :fullname,
                            email = :email,
                            phone = :phone,
                            gender = :gender,
                            birthdate = :birthdate,
                            address = :address
                        WHERE id = :user_id";
            
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ":fullname" => $data["fullname"],
                    ":email" => $data["email"],
                    ":phone" => $data["phone"],
                    ":gender" => $data["gender"],
                    ":birthdate" => $data["birthdate"],
                    ":address" => $data["address"],
                    ":user_id" => $user_id
                ]);
                return true;
            }catch(PDOException $e){
                error_log("Lỗi cập nhật thông tin người dùng !". $e ->getMessage());
                return false;
            }
        }

        //tạo hàm thêm bình luận của người dùng
        public function addUserComments($user_id,$product_id,$data){
            try{
                $sql = "INSERT INTO comments(product_id,user_id,comment,rating,created_at) 
                        VALUES(:product_id, :user_id, :comment, :rating, NOW())";
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ":user_id" => $user_id,
                    ":product_id" => $product_id,
                    ":comment" => $data["comment"],
                    ":rating" => $data["rating"]
                ]);
                
                return true;
            }catch(PDOException $e){
                error_log("Lỗi khi thêm bình luận của bạn !" . $e->getMessage());
                return false;
            }
        }

        //tạo hàm hiển thị bình luận của người dùng
        public function getUserCommentsByProductId($id){
            try{
                $sql = "SELECT u.fullname, c.rating, c.comment, c.created_at
                        FROM comments c 
                        JOIN users u ON c.user_id = u.id
                        WHERE product_id = :product_id
                        ORDER BY created_at DESC";
                        
                $stmt = $this->conn->prepare($sql);
                $stmt->execute([
                    ":product_id" => $id
                ]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }catch(PDOException $e){
                error_log("Lỗi khi lấy bình luận từ database !" . $e->getMessage());
                return false;
            }
        }
    }
?>