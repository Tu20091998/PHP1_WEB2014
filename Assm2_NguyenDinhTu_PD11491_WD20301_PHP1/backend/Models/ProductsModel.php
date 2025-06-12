<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

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
        public function getProductsBestSeller(){
            $sql = "SELECT p.image, p.name, p.price, SUM(od.quantity) AS total_sold
                    FROM orders od JOIN products p ON od.product_id = p.id
                    GROUP BY od.product_id
                    ORDER BY total_sold DESC
                    ";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Lấy sản phẩm theo danh mục và tên đầy đủ
        public function getCategoriesWithProducts() {
            $sql = "SELECT c.category_id, c.category_name, 
                            p.id, p.name, p.price, p.image, p.description, p.product_quantity
                    FROM products p
                    JOIN categories c ON p.category_id = c.category_id
                    ORDER BY c.category_name, p.name";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Xoá sản phâm
        public function deleteProduct($productId) {
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            return $stmt->execute();
        }

        //hàm lấy sản phẩm theo id 
        public function getProductById($productId) {
            $sql = "SELECT p.*, c.name as category_name 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.id 
                    WHERE p.id = :id";
            $stmt = $this->model->prepare($sql);
            $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        //hàm cập nhật sản phẩm
        public function updateProduct($productId, $data) {
            $sql = "UPDATE products SET 
                    name = :name,
                    price = :price,
                    description = :description,
                    image = :image,
                    product_quantity = :quantity,
                    category_id = :category_id
                    WHERE id = :id";

            $stmt = $this->model->prepare($sql);
            return $stmt->execute([
                ':name' => $data['name'],
                ':price' => $data['price'],
                ':description' => $data['description'],
                ':image' => $data['image'],
                ':quantity' => $data['quantity'],
                ':category_id' => $data['category_id'],
                ':id' => $productId
            ]);
        }

        public function getAllCategories() {
            $sql = "SELECT * FROM categories ORDER BY name ASC";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>