<?php
    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__.'/../');

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    //xét giá trị trả về của đường dẫn
    $action = $_GET["action"] ?? "products";
    switch($action){
        case "products":
            $controller = new ProductController();
            $controller->show_products_list();
        break;
        case "detail":
            $controller = new ProductController();
            $id = $_GET["id"] ?? null;
            $controller->products_detail($id);
        break;
        default:
            echo "Trang không tồn tại !"; 
        break;
    }
?>