<?php
    class Database{
        //tạo các biến để lưu các giá trị kết nối dữ liệu
        private $db_host;
        private $db_name;
        private $db_user;
        private $db_password;
        private $connection;

        //tạo hàm để truyền tham số vào đối tượng
        public function __construct($db_host,$db_name,$db_user,$db_password){
            $this->db_host = $db_host;
            $this->db_name = $db_name;
            $this->db_user = $db_user;
            $this->db_password = $db_password;
        }
        //tạo hàm để kết nối cơ sở dữ liệu
        public function connect(){
            try{
                //có thể kết nối với hệ quản trị khác
                $this->connection = new PDO("mysql:host=$this->db_host;name=$this->db_name",$this->db_user,$this->db_password);

                //đặt thuộc tính trả về lỗi và dừng chương trình
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                echo "Kết nối cơ sở dữ liệu thành công";
            }catch(PDOException $e){
                echo "Kết nối lỗi: ". $e->getMessage(). "\n";
            }
        }

        //tạo hàm để ngắt kết nối
        public function disconnect(){
            $this->connection = null;
        }

        //tạo hàm để tự ngắt khi không còn truy cập đến đối tượng
        public function __destruct(){
            $this->disconnect();
        }
    }
?>