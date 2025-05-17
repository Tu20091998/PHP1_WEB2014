<?php
    //Bài 2: Thiết kế lớp để quản lý sản phẩm (Product) 
    class Product{
        //tạo các biến chứa thuộc tính của sản phẩm
        public $name;
        public $price;
        public $quantity;

        //tạo phương thức cho tên sản phẩm
        public function setName($name){
            $this->name = $name;
        }

        //tạo phương thức cho giá sản phẩm
        public function setPrice($price){
            $this->price = $price;
        }

        //tạo phương thức cho số lượng sản phẩm
        public function setQuantity($quantity){
            $this->quantity = $quantity;
        }

        //tạo phương thức để hiển thị thông tin của sản phẩm
        public function getInfo(){
            return "Tên sản phẩm: ". $this->name. "<br>".
                    "Giá sản phẩm: ".$this->price. "<br>".
                    "Số lượng sản phẩm: ".$this->quantity. "<br>";
        }

        //tạo phương thức để tính toán tổng tiền của sản phẩm = (giá * số lượng)
        public function calculateTotal(){
            return $this->price * $this->quantity;
        }
    }

    //tạo đối tượng và truyền tham số là tên, giá, số lượng sản phẩm
    $product = new Product();
    $product->setName("Máy tính Dell");
    $product->setPrice(20000000);//20 triệu
    $product->setQuantity(20);

    //hiển thị thông tin sản phẩm và hiển thị tổng giá trị của sản phẩm
    echo $product->getInfo()."<br>";
    echo "Total: ". $product->calculateTotal(). "<br>";

?>