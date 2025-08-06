<?php
    require_once ROOT. '/../Config/db.php';
    class ProductModel{
        private $conn;
        public function __construct() {
            $database = new Database($db_host = "",$db_name="",$db_user="",$db_password="");
            $this->conn = $database->connect();
        }

        //hàm lấy toàn bộ sản phẩm
        public function getAllProducts(){
            $sql = "SELECT * FROM products";
            $stmt = $this->conn->query($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm để lấy ra thông tin chi tiết sản phẩm
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

        //tạo hàm để tìm kiếm sản phẩm
        public function getProductByName($keyword){
            $sql = "SELECT * FROM products WHERE name LIKE :keyword";
            $stmt = $this->conn->prepare($sql);

            //tạo câu lệnh chèn
            $keyword = "%".$keyword."%";
            $stmt->bindParam(":keyword",$keyword,PDO::PARAM_STR);
            $stmt->execute();

            //trả về tất cả các kết quả tìm kiếm
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm để phân trang sản phẩm theo danh mục
        public function getProductByCategoryPagisnated($category_id=null,$limit,$offset){
            if($category_id !== null && $category_id > 0){
                $sql = "SELECT * 
                        FROM products 
                        WHERE category_id = :category_id
                        LIMIT :limit 
                        OFFSET :offset";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":category_id",$category_id,PDO::PARAM_INT);
            }
            else{
                $sql = "SELECT * 
                    FROM products 
                    LIMIT :limit 
                    OFFSET :offset";
                $stmt = $this->conn->prepare($sql);
            }
            $stmt->bindValue(":limit",$limit,PDO::PARAM_INT);
            $stmt->bindValue(":offset",$offset,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm lấy tổng số sản phẩm trong cơ sở dữ liệu
        public function countProduct($category_id=null){
            if($category_id !== null){
                $sql = "SELECT COUNT(*) FROM products WHERE category_id = :category_id";
                $stmt = $this->conn->prepare($sql);
                $stmt->bindValue(":category_id",$category_id, PDO::PARAM_INT);
            }
            else{
                $sql = "SELECT COUNT(*) FROM products";
                $stmt = $this->conn->prepare($sql);
            }
            
            $stmt->execute();

            //trả về 1 cột chứa số đếm
            return $stmt->fetchColumn();
        }
    }
?>