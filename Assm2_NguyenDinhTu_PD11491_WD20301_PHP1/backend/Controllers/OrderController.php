<?php
    //nạp trang xử lý dữ liệu đặt hàng
    require_once ROOT."/Models/OrderModel.php";

    //tạo class xử lý đặt hàng
    class OrderController{

        //hàm xử lý trả về hiển thị lịch sử đơn hàng
        public function order_display(){
            $order_display = new OrderModel();
            $orders = $order_display->getAllOrder();
            require_once ROOT."/Views/order.php";
        }
    }
?>