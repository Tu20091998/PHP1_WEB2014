<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    //class xử lý dữ liệu của bảng order
    class OrderModel{
        private $order_model;
        public function __construct(){
            $db = new Database();
            $this->order_model = $db->connect();
        }

        //tạo hàm xử lý dữ liệu , lấy thông tin bảng order
        public function getAllOrder(){
            $sql = "SELECT od.order_id, od.user_id, od.product_id, p.name, p.image , od.quantity, od.order_date 
            FROM orders od 
            JOIN products p 
            ON od.product_id = p.id";

            $stmt = $this->order_model->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>