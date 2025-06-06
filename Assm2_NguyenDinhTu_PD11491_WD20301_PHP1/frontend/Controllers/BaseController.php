<?php
    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__.'/../');

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    //nạp trang điều khiển người dùng
    require_once ROOT."/Controllers/UserController.php";
    
    //xét giá trị trả về của đường dẫn
    $action = $_GET["action"] ?? "products";

    //xét giá trị của đường dẫn sản phẩm
    switch($action){

        //xử lý trả về yêu cầu sản phẩm
        case "products_display":
            $products_display = new ProductController();
            $products_display->show_products_list();
        break;

        case "product_detail":
            $product_detail = new ProductController();
            $id = $_GET["id"] ?? null;
            $product_detail->products_detail($id);
        break;
        
        //xử lý trả về yêu cầu tài khoản
        case "register_display":
            $register_display = new UserController();
            $register_display->register_display();
        break;

        case "register_confirm":
            $register_confirm = new UserController();
            $register_confirm->register_confirm();
        break;
        
        case "login_display":
            $login_display = new UserController();
            $login_display->login_display();
        break;

        case "login_confirm":
            $login_confirm = new UserController();
            $login_confirm->login_confirm();
        break;

        case "logout_confirm":
            $login_confirm = new UserController();
            $login_confirm->logout_confirm();
        break;

        case "search_product":
            $search_product_confirm = new ProductController();
            $search_product_confirm->product_search();
        break;
        
        default:
            echo "Trang không tồn tại !"; 
        break;
    }
?>