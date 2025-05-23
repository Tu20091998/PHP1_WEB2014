<?php
    //tạo hằng số cho đường dẫn tuyệt đối
    define("ROOT",__DIR__);

    //hiển thị phần đầu trang
    require_once ROOT."/Views/header.php";

    //hiển thị phần giao diện quản trị admin
    require_once ROOT."/Controller/AdminController.php";
    $admin = new AdminController();
    $admin->index();

    //hiển thị phần cuối trang
    require_once ROOT. "/Views/footer.php";
?>