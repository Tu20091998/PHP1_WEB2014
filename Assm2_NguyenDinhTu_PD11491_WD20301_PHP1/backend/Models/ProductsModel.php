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
            $sql = "SELECT p.image, p.name, p.price, SUM(odt.quantity) AS total_sold
                    FROM products p JOIN order_detail odt ON p.id = odt.product_id
                    GROUP BY odt.product_id
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
            $sql = "SELECT p.*, c.category_name 
                    FROM products p 
                    JOIN categories c ON p.category_id = c.category_id 
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

        //hàm lấy tất cả danh mục
        public function getAllCategories() {
            $sql = "SELECT * FROM categories";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm để xác nhận thêm sản phẩm
        public function addProduct($data) {
            try {
                $sql = "INSERT INTO products 
                        (name, price, image, description, category_id, product_quantity) 
                        VALUES (:name, :price, :image, :description, :category_id, :product_quantity)";

                $stmt = $this->model->prepare($sql);
                $stmt->execute([
                    ':name' => $data['name'],
                    ':price' => $data['price'],
                    ':image' => $data['image'],
                    ':description' => $data['description'],
                    ':category_id' => $data['category_id'],
                    ':product_quantity' => $data['product_quantity']
                ]);
                return true;
            } catch(PDOException $e) {
                error_log("Lỗi khi thêm sản phẩm: " . $e->getMessage());
                return false;
            }
        }

        //tạo hàm lấy tổng số sản phẩm trong cơ sở dữ liệu
        public function countProduct(){
            $sql = "SELECT COUNT(*) FROM products";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();

            //trả về 1 cột chứa số đếm
            return $stmt->fetchColumn();
        }
    }
?>