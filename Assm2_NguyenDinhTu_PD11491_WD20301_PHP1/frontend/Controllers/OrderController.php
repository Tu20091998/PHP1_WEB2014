<?php
    //nạp trang xử lý dữ liệu giỏ hàng
    require_once ROOT."/Models/CartModel.php";

    //nạp trang xử lý dữ liệu đặt hàng
    require_once ROOT."/Models/OrderModel.php";

    //tạo class xử lý đặt hàng
    class OrderController{
        //hàm điều khiển xử lý trả về đặt hàng
        public function order_confirm() {
            session_start();

            if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["order_confirm"])) {
                $user_id = $_POST["user_id"] ?? null;

                if (!$user_id) {
                    $_SESSION["error"] = "Vui lòng đăng nhập để đặt hàng";
                    header("Location: BaseController.php?action=login_display");
                    exit;
                }

                try {
                    $orderModel = new OrderModel();
                    $order_id = $orderModel->createOrder($user_id);

                    if ($order_id) {
                        $_SESSION["success"] = "Đặt hàng thành công! Mã đơn hàng: #" . $order_id;

                        // Lấy thông tin đơn hàng vừa tạo để hiển thị
                        $orderDetails = $orderModel->getOrderDetails($order_id);
                        $_SESSION["last_order"] = $orderDetails;

                        header("Location: BaseController.php?action=order_detail&id=" . $order_id);
                        exit;
                    }
                } catch (Exception $e) {
                    $_SESSION["error"] = "Lỗi khi đặt hàng: " . $e->getMessage();
                    header("Location: BaseController.php?action=cart_display");
                    exit;
                }
            }
        }

        //hiển thị lịch sử đơn hàng
        public function order_display() {
            session_start();
            
            // Kiểm tra đăng nhập
            if (!isset($_SESSION['user_id'])) {
                $_SESSION["login_message"] = "Vui lòng đăng nhập trước khi xem lịch sử đơn hàng !";
                header("Location: BaseController.php?action=login_display");
                exit;
            }

            $user_id = $_SESSION['user_id'];
            $orderModel = new OrderModel();

            // Lấy danh sách đơn hàng của người dùng hiện tại
            $orders = $orderModel->getOrdersByUser($user_id);
            require_once ROOT."/Views/order.php";
        }

        //hiển thị chi tiết đơn hàng
        public function order_detail_display() {

            $order_id = $_GET['id'];
            
            $orderModel = new OrderModel();

            // Lấy chi tiết đơn hàng
            $orderDetails = $orderModel->getOrderDetails($order_id);
            
            require_once ROOT."/Views/order_detail.php";
        }

        public function cancel_order() {
            session_start();

            if (!isset($_SESSION['user_id'])) {
                header("Location: BaseController.php?action=login_display");
                exit;
            }
        
            $order_id = $_GET['id'] ?? null;
            $user_id = $_SESSION['user_id'];
        
            $orderModel = new OrderModel();

            // Kiểm tra đơn hàng có thuộc về user này không
            $userOrders = $orderModel->getOrdersByUser($user_id);
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