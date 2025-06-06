<?php
    //nạp database
    require_once ROOT."/Config/db.php";

    //tạo class chứa xử lý
    class ProductModel{
        private $conn;
        public function __construct(){
            $database = new Database($db_host = "",$db_name="",$db_user="",$db_password="");
            $this->conn = $database->connect();
        }

        //tạo hàm chứa xử lý tìm kiếm
        public function getProductByName($keyword){
            $sql = "SELECT * FROM products WHERE name LIKE :keyword";
            $stmt = $this->conn->prepare($sql);

            //tạo câu lệnh chèn
            $keyword = "%".$keyword. "%";
            $stmt->bindParam(":keyword",$keyword,PDO::PARAM_STR);
            $stmt->execute();

            //trả về tất cả kết quả tìm kiếm
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm chứa xử lý phân trang
        public function getProductsPaginated($limit,$offset){
            $sql = "SELECT * FROM products LIMIT :limit OFFSET :offset";
            $stmt = $this->conn->prepare($sql);

            //binvalue để trả về giá trị số nguyên
            $stmt->bindValue(":limit",$limit,PDO::PARAM_INT);
            $stmt->bindValue(":offset",$offset,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy tổng số đếm của toàn bộ sản phẩm
        public function countProduct(){
            $sql = "SELECT COUNT(*) FROM products";
            $stmt = $this->conn->prepare(query: $sql);
            $stmt->execute();

            //trả về cột có chứa dữ liệu và lấy ở hàng đầu tiên
            return $stmt->fetchColumn();
        }
    }
?>