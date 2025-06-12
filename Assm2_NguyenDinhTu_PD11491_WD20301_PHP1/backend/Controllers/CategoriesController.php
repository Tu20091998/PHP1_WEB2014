<?php
    //nạp trang xử lý dữ liệu trả về
    require_once ROOT."/Models/CategoriesModel.php";

    //tạo class xử lý dữ liệu danh mục trả về
    class CategoriesController{
        private $categories_model;
        public function __construct(){
            $this->categories_model = new CategoriesModel();
        }

        //hàm hiển thị danh mục sản phẩm
        public function categories_display(){
            $categories_list = $this->categories_model->getCategoriesList();
            require_once ROOT."/Views/home_admin.php";
        }
    }
?>