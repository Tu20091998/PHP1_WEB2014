<?php
    //nạp trang xử lý dữ liệu đặt hàng
    require_once ROOT."/Models/OrderModel.php";

    //tạo class xử lý đặt hàng
    class OrderController{

        private $orderModel;
        public function __construct(){
            $this->orderModel = new OrderModel();
        }
        //hiển thị chi tiết đơn hàng
        public function order_detail_display() {

            $order_id = $_GET['id'];

            // Lấy chi tiết đơn hàng
            $orderDetails = $this->orderModel->getOrderDetails($order_id);
            
            require_once ROOT."/Views/order_detail.php";
        }

        //hiển thị lịch sử đơn hàng
        public function order_display() {

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            // Lấy danh sách đơn hàng của người dùng hiện tại
            $orders = $this->orderModel->getOrdersByAdmin();
            require_once ROOT."/Views/order.php";
        }

        // Cập nhật trạng thái đơn hàng
        public function updateOrderStatus() {
            $order_id = $_GET['id'];
            $status = $_GET['status'];

            if ($this->orderModel->updateOrderStatus($order_id, $status)) {
                $_SESSION['success'] = "Cập nhật trạng thái thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi cập nhật trạng thái";
            }
            header("Location: ../Views/orders.php");
        }

        
        public function cancel_order() {
            session_start();
            
            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $order_id = $_GET['id'] ?? null;
        
            $orderModel = new OrderModel();

            // Kiểm tra đơn hàng có thuộc về user này không
            $userOrders = $orderModel->getOrdersByUser($order_id);
            $canCancel = false;

            foreach ($userOrders as $order) {
                if ($order['order_id'] == $order_id && $order['status'] === 'Chờ xử lý') {
                    $canCancel = true;
                    break;
                }
            }
        
            if ($canCancel) {
                // Cập nhật trạng thái đơn hàng
                if ($orderModel->updateOrderStatus($order_id, 'Đã huỷ')) {
                    $_SESSION['success'] = "Đã hủy đơn hàng #".$order_id;
                } else {
                    $_SESSION['error'] = "Hủy đơn hàng thất bại";
                }
            } else {
                $_SESSION['error'] = "Không thể hủy đơn hàng này";
            }
        
            header("Location: BaseController.php?action=order_display");
            exit;
        }
    }
    
?>