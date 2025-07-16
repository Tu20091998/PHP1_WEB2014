<?php
    require_once ROOT."/Models/ProductsModel.php";
    class ProductController {
        private $model;

        public function __construct() {
            $this->model = new ProductsModel();
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
            $categories_list = $this->model->getCategoriesWithProducts();
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
    }
?>
