<?php
    require_once ROOT."/Models/ProductsModel.php";
    require_once ROOT."/Models/CategoriesModel.php";
    class ProductController {
        private $model;
        private $categories_model;

        public function __construct() {
            $this->model = new ProductsModel();
            $this->categories_model = new CategoriesModel();
        }

        //hàm hiển thị danh mục sản phẩm sắp hết hàng
        public function products_information(){
            //hiển thị hết hàng
            $products_out_of_stock_list = $this->model->getProductsOutOfStockList();

            //hiển thị bán chạy
            $best_seller = $this->model->getProductsBestSeller();

            //hiển thị bán thấp
            $lowest_seller = $this->model->getProductsLowestSeller();

            //hiển thị tổng bán được
            $products_sum_sales = $this->model->getTotalSoldProducts();

            //hiển thị tổng bán được cho từng sản phẩm
            $product_list_quantity_sales = $this->model->getAllProductsSales();
            require_once ROOT."/Views/home_admin.php";
        }

        // Hàm hiển thị sản phẩm kèm danh mục
        public function showCategoriesWithProducts() {
            $product_count = $this->model->countProduct();
            $categories_and_products_list = $this->model->getCategoriesWithProducts();
            require_once ROOT.'Views/products.php';
        }

        // Hàm xử lý xoá sản phẩm
        public function deleteProduct($productId) {
            if ($this->model->deleteProduct($productId)) {
                $_SESSION['message'] = "Xoá sản phẩm thành công !";
            } else {
                $_SESSION['error'] = "Lỗi khi xoá sản phẩm !";
            }
            header("Location:Basecontroller.php?action=products_display");
            exit();
        }

        //hàm hiển thị form chỉnh sửa sản phẩm
        public function showEditProductForm($productId) {
            $product = $this->model->getProductById($productId);
            $categories = $this->model->getAllCategories();
            require_once ROOT.'/Views/edit_product.php';
        }

        //hàm cập nhật thông tin sản phẩm
        public function updateProduct($productId) {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'name' => $_POST['name'],
                    'price' => $_POST['price'],
                    'description' => $_POST['description'],
                    'image' => $_POST['image'],
                    'quantity' => $_POST['quantity'],
                    'category_id' => $_POST['category_id']
                ];

                if ($this->model->updateProduct($productId, $data)) {
                    $_SESSION['message'] = "Cập nhật sản phẩm thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật sản phẩm thất bại";
                }

                header("Location: Basecontroller.php?action=products_display");
                exit();
            }
        }

        //hàm lấy danh mục sản phẩm cho phần hiển thị thêm sản phẩm
        public function add_product_display(){
            $categories = $this->model->getAllCategories();
            require_once ROOT."/Views/add_product.php";
        }

        //hàm xử lý thêm sản phẩm
        public function add_product_confirm(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                 // Chuẩn bị dữ liệu
                $data = [
                    'name' => htmlspecialchars($_POST['name']),
                    'price' => floatval($_POST['price']),
                    'image' => $_POST["image"],
                    'description' => htmlspecialchars($_POST['description']),
                    'category_id' => intval($_POST['category_id']),
                    'product_quantity' => intval($_POST['product_quantity'])
                ];

                // Thêm vào database
                if ($this->model->addProduct($data)) {
                    $_SESSION['message'] = "Thêm sản phẩm thành công!";
                    header('Location:BaseController.php?action=add_product_display');
                } else {
                    $_SESSION['message'] = "Lỗi khi thêm sản phẩm";
                    header('Location:BaseController.php?action=add_product_display');
                }
            }
        }

        //hiển thị bình luận của người dùng theo sản phẩm
        public function comments_display(){

            // Lấy danh mục (nếu có)
            $category_id = $_GET["category_id"] ?? null;

            // Lấy danh sách danh mục cho dropdown
            $categories = $this->categories_model->getAllCategories();

            // Nếu có category_id
            if ($category_id) {
                $products = $this->model->getProductsByCategory($category_id);
            } else {
                $products = $this->model->getAllProducts();
            }

            //lấy product_id từ form
            $product_id = $_GET["product_id"] ?? null;

            //nếu có product_id , lấy bình luận của sản phẩm đó và hiển thị
            if($product_id){
                $comments = $this->model->getCommentsByProduct($product_id);
            }
            require ROOT."/Views/comments.php";
        }

        public function hidden_comment_confirm(){
            session_start(); // nếu chưa có

            //lấy product_id từ form
            $product_id = $_GET["product_id"] ?? null;
            
            // Lấy comment_id từ URL
            $comment_id = $_GET["comment_id"] ?? null;
                
            if ($comment_id && $this->model->updateHiddenComment($comment_id)) {
                $_SESSION["message"] = "✅ Bình luận #$comment_id đã được ẩn.";
            } else {
                $_SESSION["message"] = "❌ Không thể ẩn bình luận #$comment_id.";
            }
            
            // Redirect về lại trang hiển thị bình luận
            header("Location: BaseController.php?action=comments_display&product_id=$product_id");
            exit;
        }
    }
?>
