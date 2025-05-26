<?php
    //tạo hằng số đường dẫn tuyệt đối
    define("ROOT",__DIR__);

    //nạp vào các hằng số để kết nối với cơ sở dữ liệu
    require_once ROOT."/config.php";

    //nạp vào xử lý database
    require_once ROOT. "/Model/Database.php";

    //gọi đối tượng để kết nối dữ liệu
    $db = new Database(DB_HOST,DB_NAME,DB_USER,DB_PASS);
    $db->connect();


    //gọi phần đầu trang
    require_once ROOT."/Views/header.php";

    //xét đường dẫn get
    $action = isset($_GET["action"]) ? $_GET["action"]:"home";

    //xét hiển thị phần giữa trang
    switch($action){
        case "home":
            require_once ROOT."/Controller/HomeController.php";
            $home = new HomeController($db);
            $home->index();
        break;

        case "product":
            require_once ROOT."/Controller/ProductController.php";
            $products = new ProductController($db);
            $products->index();
        break;

        default: 
            require_once ROOT."/Views/404.php";
    }

    //gọi phần cuối trang
    require_once ROOT."/Views/footer.php";
?>