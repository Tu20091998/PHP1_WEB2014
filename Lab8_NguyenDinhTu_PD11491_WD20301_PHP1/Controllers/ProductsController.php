<?php
    //nạp trang xử lý dữ liệu trả về
    require_once ROOT."/Models/ProductsModel.php";

    //tạo class xử lý dữ liệu danh mục trả về
    class ProductsController{
        private $products_model;
        public function __construct(){
            $this->products_model = new ProductsModel();
        }

        //hàm hiển thị danh mục sản phẩm
        public function products_out_of_stock_display(){
            $products_out_of_stock_list = $this->products_model->getProductsOutOfStockList();
            require_once ROOT."/Views/out_of_stock.php";
        }
    }
?>