<?php
    //nạp trang xử lý dữ liệu trả về
    require_once ROOT."/Models/CategoriesModel.php";

    //tạo class xử lý dữ liệu danh mục trả về
    class CategoriesController{
        private $categories_model;
        public function __construct(){
            $this->categories_model = new CategoriesModel();
        }

        //hàm hiển thị danh mục sản phẩm và danh sách sản phẩm
        public function categories_display(){

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $categories_list = $this->categories_model->getCategoriesList();
            $categories_count = $this->categories_model->getCategoriesCount();
            require_once ROOT."/Views/categories.php";
        }

        //hàm hiển thị form thêm danh mục
        public function add_categories_display(){
            $categories = $this->categories_model->getAllCategories();
            require_once ROOT."/Views/add_categories.php";
        }

        //hàm xử lý thêm danh mục
        public function add_categories_confirm(){
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                 // Chuẩn bị dữ liệu
                $data = [
                    'category_name' => htmlspecialchars($_POST['category_name'])
                ];

                // Thêm vào database
                if ($this->categories_model->addCategories($data)) {
                    $_SESSION['message'] = "Thêm danh mục thành công!";
                    header('Location:BaseController.php?action=add_categories_display');
                } else {
                    $_SESSION['message'] = "Lỗi khi thêm danh mục";
                    header('Location:BaseController.php?action=add_categories_display');
                }
            }
        }

        //hàm xử lý xoá danh mục
        public function delete_category_confirm(){
            if($_SERVER["REQUEST_METHOD"] == "GET"){
                //nhận yêu cầu và id danh mục
                $category_id = $_GET["category_id"] ?? null;

                if ($this->categories_model->deleteCategory($category_id)) {
                    $_SESSION['message'] = "Xoá danh mục thành công!";
                    header('Location:BaseController.php?action=categories_display');
                } else {
                    $_SESSION['message'] = "Lỗi khi xoá danh mục";
                    header('Location:BaseController.php?action=categories_display');
                }
            }
        }

        //hàm xử lý hiển thị form chỉnh sửa danh mục
        public function edit_category_display(){
            $category_id = $_GET["category_id"] ?? null;

            $category_update = $this->categories_model->getCategoryById($category_id);
            require_once ROOT."/Views/edit_category.php";
        }

        //hàm xử lý cập nhật danh mục
        public function update_category_confirm(){
            $category_id = $_GET["category_id"];

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $category_name = $_POST["category_name"];

                if ($this->categories_model->updateCategory($category_id, $category_name)) {
                    $_SESSION['message'] = "Cập nhật danh mục thành công";
                } else {
                    $_SESSION['error'] = "Cập nhật danh mục thất bại";
                }

                header("Location: Basecontroller.php?action=categories_display");
                exit();
            }
        }
    }
?>