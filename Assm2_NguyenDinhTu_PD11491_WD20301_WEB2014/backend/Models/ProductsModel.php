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

        //tạo hàm lấy toàn bộ sản phẩm
        public function getAllProducts(){
            try{
                $sql = "SELECT * FROM products";
                $stmt = $this->model->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                error_log("Lỗi khi lấy toàn bộ sản phẩm từ database !". $e->getMessage());
                return false;
            }
        }

        //tạo hàm lấy bình luận theo sản phẩm
        public function getCommentsByProduct($product_id){
            try{
                $sql = "SELECT c.*, u.fullname
                        FROM comments c
                        JOIN users u ON c.user_id = u.id
                        WHERE product_id = :product_id AND is_hidden = 0
                        ORDER BY created_at DESC";
                $stmt = $this->model->prepare($sql);
                $stmt->execute([":product_id" => $product_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                error_log("Lỗi khi lấy bình luận theo sản phẩm từ database !" . $e->getMessage());
                return false;
            }
        }

        //tạo hàm cập nhật ẩn bình luận
        public function updateHiddenComment($comment_id){
            try{
                $sql = "UPDATE comments 
                        SET is_hidden = 1
                        WHERE comment_id = :comment_id";

                $stmt = $this->model->prepare($sql);
                $stmt->execute([":comment_id" => $comment_id]);
                
                return true;
            }
            catch(PDOException $e){
                error_log("Lỗi khi ẩn bình luận của người dùng !" .$e->getMessage());
                return false;
            }
        }


        //tạo hàm xử lý danh mục sản phẩm hết hàng
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
                    HAVING total_sold >= 4
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

        //hàm lấy tất cả sản phẩm có lượt mua thấp
        public function getProductsLowestSeller(){
            $sql = "SELECT p.image, p.name, p.price, SUM(odt.quantity) AS total_sold
                    FROM products p JOIN order_detail odt ON p.id = odt.product_id
                    GROUP BY odt.product_id
                    HAVING total_sold <= 3
                    ORDER BY total_sold ASC
                    ";
            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy tổng số lượng sản phẩm đã bán được
        public function getTotalSoldProducts() {
            $sql = "SELECT SUM(quantity) AS total_all_sold 
                    FROM order_detail";

            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total_all_sold'] ?? 0; // Trả về 0 nếu không có dữ liệu
        }

        //hàm lấy danh sách sản phẩm kèm theo số lượng bán được từng sản phẩm
        public function getAllProductsSales() {
            $sql = "SELECT 
                        p.id,
                        p.image,
                        p.name,
                        p.price,
                        COALESCE(SUM(od.quantity), 0) AS total_sold
                    FROM 
                        products p
                    LEFT JOIN 
                        order_detail od ON p.id = od.product_id
                    GROUP BY 
                        p.id
                    ORDER BY 
                        total_sold DESC";

            $stmt = $this->model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm lấy sản phẩm theo danh mục
        public function getProductsByCategory($category_id){
            try{
                $sql = "SELECT * 
                        FROM products 
                        WHERE category_id = :category_id";
                $stmt = $this->model->prepare($sql);
                $stmt->execute([":category_id" => $category_id]);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                error_log("Lỗi khi lấy sản phẩm theo danh mục". $e->getMessage());
                return false;
            }
        }
    }
?>