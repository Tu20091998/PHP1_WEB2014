<?php
    //nạp trang database
    require_once ROOT."/Model/Database.php";

    //nạp class cha
    require_once ROOT."/Controller/BaseController.php";
    
    class HomeController extends BaseController{
        public function index(){
            //nạp trang chủ để hiển thị
            require_once ROOT."/Views/home.php";
        }
    }
?>