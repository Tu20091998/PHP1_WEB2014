<?php
    //tạo đường dẫn gốc
    define("ROOT",__DIR__);

    //nạp trang điều khiển sản phẩm
    require_once ROOT."/Controllers/UserController.php";

    $action = $_GET["action"] ?? "";

    switch($action){
        //đăng nhập
        case "login_display":
            $login_display = new UserController();
            $login_display->login_display();
        break;

        case "login_confirm":
            $login_confirm = new UserController();
            $login_confirm->login_confirm();
        break;

        //đăng ký
        case "register_display":
            $register_display = new UserController();
            $register_display->register_display();
        break;

        case "register_confirm":
            $register_confirm = new UserController();
            $register_confirm->register_confirm();
        break;


        default:
            $login_display = new UserController();
            $login_display->login_display();
        break;
    }
?>