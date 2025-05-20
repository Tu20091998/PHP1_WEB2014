<?php
    //đây là file dùng để điều hướng các trang
    //kiểm tra action trên đường dẫn
    $action = isset($_GET["action"])? $_GET["action"]:"home";

    //kiểm tra các điều kiện để chuyển hướng trang
    switch($action){
        //điều hướng tới thư mục điều khiển sản phẩm
        case "home":
            require "./controllers/homeController.php";
        break;
        
        //điều hướng tới thư mục điều khiển sản phẩm
        case "product":
            require "./controllers/productController.php";
        break;

        //nếu giá trị khác thì báo lỗi
        default:
            echo "404 - Trang không tồn tại";
    }
?>