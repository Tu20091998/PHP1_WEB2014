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

        // Lấy đơn hàng theo order_id
        public function getOrdersByAdmin() {
            $stmt = $this->order_model->prepare(
                "SELECT o.order_id, o.order_date, o.total_amount, o.status,o.user_id
                FROM orders o
                ORDER BY o.order_date DESC"
            );
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //lấy ra thông tin của chi tiết đơn hàng
        public function getOrderDetails($order_id) {
            $stmt = $this->order_model->prepare(
        "SELECT od.*, p.name, p.image
                FROM order_detail od
                JOIN products p ON od.product_id = p.id
                WHERE od.order_id = :order_id"
            );
            $stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm cập nhật trạng thái đơn hàng
        public function updateOrderStatus($order_id, $status) {
            $stmt = $this->order_model->prepare(
                "UPDATE orders SET status = :status WHERE order_id = :order_id"
            );
            $stmt->bindParam(":status", $status);
            $stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
            return $stmt->execute();
        }
    }
?>