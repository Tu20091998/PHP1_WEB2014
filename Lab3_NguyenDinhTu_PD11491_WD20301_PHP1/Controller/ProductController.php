<?php
    class ProductController{
        public function index(){
            require_once ROOT."/Model/ProductModel.php";
            $model = new ProductModel();
            $product = $model->getAll();
            require_once ROOT."/Views/product.php";
        }
    }
?>