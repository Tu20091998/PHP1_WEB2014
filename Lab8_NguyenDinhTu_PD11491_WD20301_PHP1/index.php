<?php
    //tạo đường dẫn gốc
    define("ROOT",__DIR__);

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/CategoriesController.php";

    //nạp trang điều khiến người dùng
    require_once ROOT."/Controllers/UsersController.php";

    //nạp trang điều khiến sản phẩm
    require_once ROOT."/Controllers/ProductsController.php";

    $action = $_GET["action"] ?? "";

    switch($action){
        //xử lý danh mục
        case "categories_display":
            $categories_display = new CategoriesController();
            $categories_display->categories_display();
        break;
        
        //xử lý người dùng
        case "users_display":
            $users_display = new UsersController();
            $users_display->users_display();
        break;

        //xử lý sản phẩm
        case "products_out_of_stock_display":
            $products_out_of_stock_display = new ProductsController();
            $products_out_of_stock_display->products_out_of_stock_display();
        break;

        default:
            $categories_display = new CategoriesController();
            $categories_display->categories_display();
        break;
    }
?>