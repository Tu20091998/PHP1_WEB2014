<?php
    //tạo 1 class có kết nối chung
    class BaseController{
        protected $db;

        //tạo hàm để nhận tham số từ bên ngoài
        public function __construct($db){
            $this->db = $db;
        }
    }
?>