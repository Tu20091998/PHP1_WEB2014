<?php
    class ProductModel{
        //giả lập dữ liệu trong cơ sở dữ liệu
        public function getAll(){
            return [
                ["name"=>"Cà phê", "price"=>20000],
                ["name"=>"Sinh Tố", "price"=>10000],
                ["name"=>"Trà sữa", "price"=>30000],
            ];
        }
    }
?>