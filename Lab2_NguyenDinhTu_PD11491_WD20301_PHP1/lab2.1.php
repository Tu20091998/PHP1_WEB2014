<?php
    //Bài 1: Thiết kế một lớp "Person" để biểu diễn thông tin về một người. 
    class Person{
        //tạo 3 biến có thể tham chiếu từ bên ngoài
        public $name;
        public $age;
        public $address;

        //tạo hàm để gán tham số cho tên
        public function setName($name){
            $this->name = $name;
        }

        //tạo hàm để gán tham số cho tuổi
        public function setAge($age){
            $this->age = $age;
        }

        //tạo hàm để gán tham số địa chỉ
        public function setAddress($address){
            $this->address = $address;
        }

        //tạo hàm để hiển thị thông tin đối tượng
        public function getInfo(){
            return  "Name: ".$this->name."<br>".
                    "Age: ".$this->age."<br>".
                    "Address: ".$this->address."<br>";
        }

        //tạo hàm xét đủ 18 tuổi thì có thể bỏ phiếu
        public function canVote(){
            if($this->age >= 18){
                return true;
            }
            else{
                return false;
            }
        }
    }

    //tạo 1 đối tượng
    $person = new Person();
    
    //truyền tham số là tên, tuổi , địa chỉ vào phương thức của đối tượng 
    $person->setName("Nguyễn Đình Tú");
    $person->setAge("26");
    $person->setAddress("93 Nguyễn Văn Tỵ - Cẩm lệ - Đà Nẵng");

    //hiển thị thông tin của đối tượng bằng phương thức
    echo $person->getInfo()."<br>";

    //kiểm tra xem có đủ tuổi để bỏ phiếu hay không?
    if($person->canVote()){
        echo "Đã đủ tuổi bỏ phiếu tranh cử !";
    }
    else{
        echo "Không đủ tuổi để bỏ phiếu !";
    }

?>