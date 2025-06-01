<?php
    require_once ROOT. '/../Config/db.php';
    class ProductModel{
        private $conn;
        public function __construct() {
            $database = new Database($db_host = "",$db_name="",$db_user="",$db_password="");
            $this->conn = $database->connect();
        }

        //tạo hàm lấy sản phẩm
        public function getAllProducts(){
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm lấy sản phẩm theo id
        public function getProductById($id){
            if(!is_numeric($id)){
                return null;
            }

            $sql = "SELECT * FROM products WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":id",$id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>