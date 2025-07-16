<?php

    //nạp xử lý database
    require_once ROOT."/Models/CartModel.php";

    //tạo class tương tác 2 bên
    class CartController{
        private $cart_model;
        public function __construct(){
            $this->cart_model = new CartModel();
        }

        //hàm điều khiển hiển thị giỏ hàng
        public function show_cart(){
            //gọi phiên làm việc của người dùng
            session_start();

            if (!isset($_SESSION["user_id"])) {
                $_SESSION['login_message'] = 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng';
                header("Location: BaseController.php?action=login_display");
                exit(); // Luôn dùng exit() sau header Location
            }

            $user_id = $_SESSION["user_id"];

            $cartItems = $this->cart_model->getCartItems($user_id);

            require_once ROOT."/Views/cart.php";
        }

        //hàm điều khiển thêm sản phâm vào giỏ hàng
        public function add_cart(){
            // Kiểm tra xem user đã đăng nhập chưa
            session_start();

            if (!isset($_SESSION["user_id"])) {
                $_SESSION['login_message'] = 'Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng';
                header("Location: BaseController.php?action=login_display");
                exit();
            }
            
            $user_id = $_SESSION["user_id"] ?? 1;
            $product_id = $_POST["product_id"] ?? 1;

            $cartAdd = $this->cart_model->addtoCart($user_id,$product_id);

            // Trong controller khi xử lý thêm giỏ hàng
            if ($cartAdd === "inserted") {
                $_SESSION['flash_message'] = ['type' => 'success', 'message' => 'Đã thêm vào giỏ hàng'];
            } elseif ($cartAdd === "updated") {
                $_SESSION['flash_message'] = ['type' => 'info', 'message' => 'Đã cập nhật giỏ hàng'];
            } else {
                $_SESSION['flash_message'] = ['type' => 'error', 'message' => 'Có lỗi xảy ra'];
            }

            header("Location: BaseController.php?action=products_display");
            exit;
        }

        //hàm điều khiển xoá sản phẩm
        public function remove_item(){
            session_start();
            //kiểm tra đăng nhập
            if (!isset($_SESSION["user_id"])) {
                header("Location:BaseController.php?action=login_display");
                echo "<script>alert('Bạn cần đăng nhập để xoá sản phẩm khỏi giỏ hàng')</script>";
                return;
            }

            $user_id = $_SESSION["user_id"];
            $product_id = $_POST["product_id"];

            if ($this->cart_model->removeItem($user_id, $product_id)) {
                $_SESSION['success'] = "Đã xóa sản phẩm khỏi giỏ hàng";
            } else {
                $_SESSION['error'] = "Xóa sản phẩm thất bại";
            }

            header("Location: BaseController.php?action=cart_display");
            exit();
        }
    }

?>