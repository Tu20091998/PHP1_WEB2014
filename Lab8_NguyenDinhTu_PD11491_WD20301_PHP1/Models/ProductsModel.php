<?php
    //nạp kết nối database
    require_once ROOT."/Config/db.php";

    //tạo class xử lý danh mục sản phẩm
    class ProductsModel{
        private $model;

        public function __construct(){
            $db = new Database();
            $this->model = $db->connect();
        }

        //tạo hàm xử lý danh mục sản phẩm
        public function getProductsOutOfStockList(){
            $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.category_id WHERE products.product_quantity = 0";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm lấy danh sách sản phẩm bán chạy
        
    }
?>