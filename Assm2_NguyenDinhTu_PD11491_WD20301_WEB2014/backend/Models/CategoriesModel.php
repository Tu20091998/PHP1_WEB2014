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
        public function getCategoriesListAndProducts(){
            $sql = "SELECT * FROM products JOIN categories ON products.category_id = categories.category_id";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm xử lý danh mục sản phẩm
        public function getCategoriesList(){
            $sql = "SELECT * FROM categories";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //tạo hàm đếm số lượng danh mục sản phẩm
        public function getCategoriesCount(){
            $sql = "SELECT COUNT(*) FROM categories";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            return $stmt->fetchColumn();
        }

        //hàm lấy tất cả danh mục
        public function getAllCategories() {
            $sql = "SELECT * FROM categories";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm để xác nhận thêm sản phẩm
        public function addCategories($data) {
            try {
                $sql = "INSERT INTO categories 
                        (category_name) 
                        VALUES (:category_name)";

                $stmt = $this->model->prepare($sql);
                $stmt->execute([
                    ':category_name' => $data['category_name']
                ]);
                return true;
            } catch(PDOException $e) {
                error_log("Lỗi khi thêm danh mục: " . $e->getMessage());
                return false;
            }
        }

        //hàm để xác nhận xoá sản phẩm
        public function deleteCategory($category_id) {
            try {
                $sql = "DELETE FROM categories WHERE category_id = :category_id";
                $stmt = $this->model->prepare($sql);
                $stmt->execute([
                    ':category_id' => $category_id
                ]);
                return true;
            } catch(PDOException $e) {
                error_log("Lỗi khi xoá danh mục exceptiom: " . $e->getMessage());
                return false;
            }
        }

        //hàm cập nhật danh mục
        public function updateCategory($category_id, $category_name) {
            $sql = "UPDATE categories SET 
                        category_name = :category_name
                    WHERE category_id = :category_id";

            $stmt = $this->model->prepare($sql);
            return $stmt->execute([
                ':category_name' => $category_name,
                ':category_id' => $category_id
            ]);
        }

        //hàm lấy danh mục theo id
        public function getCategoryById($category_id){
            $sql = "SELECT * 
                    FROM categories 
                    WHERE category_id = :category_id";

            $stmt = $this->model->prepare($sql);
            $stmt->execute([
                ':category_id' => $category_id
            ]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>