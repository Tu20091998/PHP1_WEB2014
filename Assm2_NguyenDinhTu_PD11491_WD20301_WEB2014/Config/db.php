<?php
    class Database {
    private $conn = null;

    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=localhost:3307;dbname=shopping_cart;charset=utf8", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }

    //tạo hàm để ngắt kết nối
    public function disconnect(){
        $this->conn = null;
    }

    //tạo hàm để tự ngắt khi không còn truy cập đến đối tượng
    public function __destruct(){
        $this->disconnect();
    }
}
?>