<?php
    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__);
    
    //nạp đầu trang
    require_once ROOT."/Views/header.php";

    //nạp trang main
    require_once ROOT."/Views/main.php";


    //nạp cuối trang
    require_once ROOT."/Views/footer.php";
?>