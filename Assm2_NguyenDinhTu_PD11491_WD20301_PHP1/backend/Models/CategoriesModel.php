<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    //tạo class xử lý danh mục sản phẩm
    class CategoriesModel{
        private $model;

        public function __construct(){
            $db = new Database();
            $this->model = $db->connect();
        }

        //tạo hàm xử lý danh mục sản phẩm
        public function getCategoriesList(){
            $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.category_id";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>