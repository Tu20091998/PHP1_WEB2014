<?php
    // Bắt đầu phiên làm việc (bắt buộc để dùng $_SESSION)
    session_start();

    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__.'/../');

    //nạp trang điều khiển admin
    require_once ROOT."/Controllers/AdminController.php";

    //nạp trang điều khiển người dùng
    require_once ROOT."/Controllers/UserController.php";

    //nạp trang điều khiển hiển thị sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    //nạp trang điều khiển hiển thị đơn hàng
    require_once ROOT."/Controllers/OrderController.php";

    $action = $_GET["action"] ?? "home_display";

    switch($action){

        //điều khiển người quản trị
        case "home_display":
            //thông tin sản phẩm hết hàng
            $products = new ProductController();
            $products->products_information();
        break;

        case "login_display":
            $login_display = new AdminController();
            $login_display->login_display();
        break;

        case "login_confirm":
            $login_confirm = new AdminController();
            $login_confirm->login_confirm();
        break;
        
        case "logout_confirm":
            $logout_confirm = new AdminController();
            $logout_confirm->logout_confirm();
        break;

        //điều khiển hiển thị xử lý người dùng
        case "users_display":
            $users_display = new UserController();
            $users_display->users_display();
        break;

        case "user_delete":
            $user_delete = new UserController();
            $user_delete->user_delete();
        break;
        
        //xử lý điều khiển sản phẩm
        case "products_display":
            $products_display = new ProductController();
            $products_display->showCategoriesWithProducts();
        break;

        case 'delete_product':
            $delete_product = new ProductController();
            if (isset($_GET['id'])) {
                $delete_product->deleteProduct($_GET['id']);
            }
        break;

        case 'edit_product':
            $edit_product = new ProductController();
            if (isset($_GET['id'])) {
                $edit_product->showEditProductForm($_GET['id']);
            }
        break;

        case 'update_product':
            $update_product = new ProductController();
            if (isset($_GET['id'])) {
                $update_product->updateProduct($_GET['id']);
            }
        break;

        case "order_display":
            $order_display = new OrderController();
            $order_display->order_display();
        break;
    }
?>