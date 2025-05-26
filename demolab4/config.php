<?php
    //tạo đối tượng để kết nối cơ sở dữ liệu
    class Database{
        //tạo các biến để truyền tham số kết nối dữ liệu
        private $db_host;
        private $db_name;
        private $db_user;
        private $db_password;
        private $connection;

        //tạo hàm truyền tham số vào đối tượng
        public function __construct($db_host,$db_name,$db_user,$db_password){
            $this->db_host = $db_host;
            $this->db_name = $db_name;
            $this->db_user = $db_user;
            $this->db_password = $db_password;
        }

        //tạo hàm để kết nối cơ sở dữ liệu
        public function connect(){
            try{
                //Cú pháp chuẩn để kết nối cơ sở dữ liệu và hệ quản trị khác
                $this->connection = new PDO("mysql:host=$this->db_host;dbname=$this->db_name",$this->db_user,$this->db_password);

                //đặt thuộc tính để trả về lỗi và dừng chương trình
                $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                return true;
            }
            catch(PDOException $e){
                echo "Kết nối lỗi : ". $e->getMessage() . "\n";
            }
        }

        //tạo hàm để ngắt kết nối cơ sở dữ liệu
        public function disconnect(){
            $this->connection = null;
        }
    }

    //tạo đối tượng và truyền các tham số
    $conn = new Database("localhost","shopping_cart","root","");

    //gọi hàm để thực hiện kết nối
    $result = $conn->connect();

    //xét điều kiện trả về thực thi kết nối
    if($result == true){
        echo "Kết nối thành công";
    }
    else{
        echo "Kết nối lỗi: $result";
    }

    //gọi hàm để ngắt kết nối
    $conn->disconnect();
?>