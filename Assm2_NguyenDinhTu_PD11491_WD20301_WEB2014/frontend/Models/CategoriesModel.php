<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    //tạo class xử lý danh mục sản phẩm
    class CategoriesModel{
        private $conn;
        public function __construct() {
            $database = new Database($db_host = "",$db_name="",$db_user="",$db_password="");
            $this->conn = $database->connect();
        }

        //tạo hàm xử lý danh mục sản phẩm
        public function getCategoriesList(){
            $sql = "SELECT * FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm đếm số lượng danh mục sản phẩm
        public function getCategoriesCount(){
            $sql = "SELECT COUNT(*) FROM categories";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();

            return $stmt->fetchColumn();
        }

        //hàm lấy danh mục theo id
        public function getCategoryById($category_id){
            $sql = "SELECT * 
                    FROM categories 
                    WHERE category_id = :category_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':category_id' => $category_id
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>