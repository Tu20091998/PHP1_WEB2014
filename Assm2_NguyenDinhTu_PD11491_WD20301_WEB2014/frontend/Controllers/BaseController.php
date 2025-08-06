<?php
    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__.'/../');

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    //nạp trang điều khiển người dùng
    require_once ROOT."/Controllers/UserController.php";

    //nạp trang điều khiển giỏ hàng
    require_once ROOT."/Controllers/CartController.php";
    
    //nạp trang điều khiển đặt hàng
    require_once ROOT."/Controllers/OrderController.php";

    //xét giá trị trả về của đường dẫn
    $action = $_GET["action"] ?? "products_display";

    //xét giá trị của đường dẫn sản phẩm
    switch($action){

        //xử lý trả về yêu cầu sản phẩm đã được phân trang
        case "products_display":
            $products_display = new ProductController();
            $products_display->products_list_pagisnated();
        break;

        case "product_detail":
            $product_detail = new ProductController();
            $id = $_GET["id"] ?? null;
            $product_detail->products_detail($id);
        break;

        case "search_product":
            $search_product_confirm = new ProductController();
            $search_product_confirm->product_search();
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

        case "forgot_password_display":
            $forgot_password_display = new UserController();
            $forgot_password_display->showChangeProduct();
        break;

        case "forgot_password_confirm":
            $forgot_password_confirm = new UserController();
            $forgot_password_confirm->handleChangePassword();
        break;

        case "contact_display":
            $contact_display = new UserController();
            $contact_display->contact_display();
        break;

        case "user_profile_display":
            $user_profile_display = new UserController();
            $user_profile_display->user_profile_display();
        break;

        case "user_profile_update_confirm":
            $user_profile_update_confirm = new UserController();
            $user_profile_update_confirm->user_profile_update_confirm();
        break;

        //xử lý bình luận
        case "comment_add_confirm":
            $comment_add_confirm = new UserController();
            $comment_add_confirm->comment_add_confirm();
        break;

        //xử lý trả về giỏ hàng
        case "cart_display":
            $cart_display = new CartController();
            $cart_display->show_cart();
        break;

        case "cart_add_confirm":
            $cart_add_confirm = new CartController();
            $cart_add_confirm->add_cart();
        break;

        case "cart_remove_confirm":
            $cart_remove_confirm = new CartController();
            $cart_remove_confirm->remove_item();
        break;

        //xử lý yêu cầu đặt hàng
        case "order_display":
            $order_display = new OrderController();
            $order_display->order_display();
        break;

        case "order_confirm":
            $order_confirm = new OrderController();
            $order_confirm->order_confirm();
        break;

        case "order_detail":
            $order_detail = new OrderController();
            $order_detail->order_detail_display();
        break;

        case "order_cancer":
            $order_cancer = new OrderController();
            $order_cancer->cancel_order();
        break;
        
        default:
            $products_display = new ProductController();
            $products_display->products_list_pagisnated();
        break;

    }
?>