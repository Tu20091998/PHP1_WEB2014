<?php
    //tạo hằng số cho đường dẫn tuyệt đối
    define("ROOT",__DIR__);

    //hiển thị phần đầu trang
    require_once ROOT."/Views/header.php";

    //Nhận tham số đường dẫn
    $action = isset($_GET["action"]) ? $_GET["action"]: "home";

    switch($action){
        //chuyển đến điều khiển trang chủ
        case "home":
            require_once ROOT."/Controller/HomeController.php";
            $home = new HomeController();
            $home->index();
        break;

        //chuyển đến trang điều khiển sản phẩm
        case "product":
            require_once ROOT."/Controller/ProductController.php";
            $products = new ProductController();
            $products->index();
        break;

        //nếu sai giá trị thì hiển thị lỗi
        default: 
            require_once ROOT."/Views/404.php";
    }

    //hiển thị phần cuối trang
    require_once ROOT. "/Views/footer.php";
?>