<?php
    class Fruit{
        public $name;
        public $color;

        //tạo hàm khởi tạo 2 tham số
        public function __construct($name= "Apple", $color = "Red"){
            $this->name = $name;
            $this->color = $color;
        }

        //tạo hàm lấy chi tiết mô tả
        public function getDescription(){
            return "The {$this->name} is {$this->color}";
        }

        //khởi tạo hàm huỷ 
        public function __destruct(){
            echo "The {$this->name} is being destroyed <br>";
        }
    }

    //truyền tham số khi đã có tham số
    $apple = new Fruit("Apple","Red");
    $apple = new Fruit();

    //truyền tham số khác và hiển thị
    $banana = new Fruit("Banana","Yellow");
    echo $apple->getDescription()."<br>";
    echo $banana->getDescription()."<br>";

    //thay đổi giá trị của biến bên trong đối tượng sau đó in ra
    $apple->name = "Green Apple";
    $apple->color = "Green";

    echo $apple->getDescription()."<br>";
?>