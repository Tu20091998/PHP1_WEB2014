<?php
    class Student{
        private $name;
        private $age;

        public function __construct($name,$age){
            $this->name = $name;
            $this->age = $age;
        }

        //hàm để lấy tên sinh viên
        public function getName(){
            return $this->name;
        }

        //hàm để lấy tuổi sinh viên
        public function getAge(){
            return $this->age;
        }

        //hàm hiển thị
        public function display(){
            echo "Name: ".$this->name."\n";
            echo "Age: ".$this->age."\n";
        }
    }

    //tạo đối tượng sinh viên 
    $student1 = new Student("Tú",26);
    $student2 = new Student("Duy",20);
    
    //gọi hàm để chạy
    $student1->display();
    $student2->display();
?>