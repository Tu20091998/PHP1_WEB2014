<?php
    //tạo đường dẫn gốc
    define("ROOT",__DIR__);

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    $action = $_GET["action"] ?? "";

    switch($action){
        case "search":
            $product = new ProductController();
            $product->product_search();
        break;

        case "list":
            $product = new ProductController();
            $product->product_list_paginated();
        break;

        default:
            $product = new ProductController();
            $product->product_search();
        break;
    }

?>