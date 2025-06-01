<?php
    //nạp xử lý database
    require_once ROOT."/Models/ProductModel.php";

    //tạo class tương tác với dữ liệu và hiển thị
    class ProductController{
        private $model;
        //tạo hàm trả về giá trị class
        public function __construct(){
            $this->model = new ProductModel();
        }

        //tạo hàm để hiển thị danh sách sản phẩm
        public function show_products_list(){
            $results = $this->model->getAllProducts();
            require_once ROOT."/Views/product.php";
        }

        //hàm để hiển thị chi tiết sản phẩm
        public function products_detail($id){
            $product = $this->model->getProductById($id);
            require_once ROOT."/Views/product_detail.php";
        }
    }
?>