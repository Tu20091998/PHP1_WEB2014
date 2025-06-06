<?php
    //nạp kết quả trả về tìm kiếm trong database
    require_once ROOT."/Models/ProductModel.php";

    //tạo class để điều khiển hiển thị sản phẩm
    class ProductController{
        private $model;
        
        public function __construct(){
            $this->model = new ProductModel();
        }

        //hàm để hiển thị kết quả tìm kiếm sản phẩm
        public function product_search(){
            if(isset($_GET["keyword"])){
                $keyword = $_GET["keyword"];
                $product_search = $this->model->getProductByName($keyword);
                require_once ROOT."/Views/search_result.php";
            }
            else{
                require_once ROOT."/Views/search_form.php";
            }
        }

        //hàm hiển thị form tìm kiếm
        public function showSearchForm() {
            require ROOT."/Views/search_form.php";
        }

        //hàm tính toán để hiển thị phân trang
        public function product_list_paginated(){
            $limit = 4;
            $page = isset($_GET["page"]) ? max(1, intval($_GET["page"])) : 1;
            $offset = ($page - 1) * $limit;

            $products = $this->model->getProductsPaginated($limit,$offset);
            $total = $this->model->countProduct();
            $totalPages = ceil($total / $limit);

            require_once ROOT."/Views/products_paginated.php";
        }

    }
?>