<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";
    
    //nạp trang xử lý giỏ hàng
    require_once ROOT."/Models/CartModel.php";

    //nạp trang xử lý sản phẩm
    require_once ROOT."/Models/ProductModel.php";

    //class xử lý dữ liệu của bảng order
    class OrderModel{
        private $order_model;
        public function __construct(){
            $db = new Database();
            $this->order_model = $db->connect();
        }

         // Tạo đơn hàng mới từ giỏ hàng
        public function createOrder($user_id) {
            try {
                $this->order_model->beginTransaction();

                // 1. Lấy thông tin giỏ hàng
                $cartModel = new CartModel();
                $cartItems = $cartModel->getCartByUserId($user_id);

                if (empty($cartItems)) {
                    throw new Exception("Giỏ hàng trống");
                }

                // 2. Tính tổng giá trị đơn hàng
                $productModel = new ProductModel();
                $totalAmount = 0;

                foreach ($cartItems as $item) {
                    $product = $productModel->getProductById($item['product_id']);
                    $totalAmount += $product['price'] * $item['quantity'];
                }

                // 3. Tạo đơn hàng chính
                $stmt = $this->order_model->prepare(
                    "INSERT INTO orders (user_id, order_date, total_amount) 
                    VALUES (:user_id, NOW(), :total_amount)"
                );
                $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
                $stmt->bindParam(":total_amount", $totalAmount);
                $stmt->execute();

                $order_id = $this->order_model->lastInsertId();

                // 4. Thêm chi tiết đơn hàng
                foreach ($cartItems as $item) {
                    $product = $productModel->getProductById($item['product_id']);

                    $stmt = $this->order_model->prepare(
                        "INSERT INTO order_detail 
                        (order_id, product_id, quantity, unit_price, subtotal) 
                        VALUES (:order_id, :product_id, :quantity, :unit_price, :subtotal)"
                    );

                    $subtotal = $product['price'] * $item['quantity'];

                    $stmt->bindParam(":order_id", $order_id, PDO::PARAM_INT);
                    $stmt->bindParam(":product_id", $item['product_id'], PDO::PARAM_INT);
                    $stmt->bindParam(":quantity", $item['quantity'], PDO::PARAM_INT);
                    $stmt->bindParam(":unit_price", $product['price']);
                    $stmt->bindParam(":subtotal", $subtotal);
                    $stmt->execute();
                }

                // 5. Xóa giỏ hàng
                $cartModel->removeCart($user_id);

                $this->order_model->commit();
                return $order_id;

            } catch (Exception $e) {
                $this->order_model->rollBack();
                throw $e;
            }
        }
        
        // Lấy đơn hàng theo user_id
        public function getOrdersByUser($user_id) {
            $stmt = $this->order_model->prepare(
                "SELECT o.order_id, o.order_date, o.total_amount, o.status
                FROM orders o
                WHERE o.user_id = :user_id
                ORDER BY o.order_date DESC"
            );
            $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
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