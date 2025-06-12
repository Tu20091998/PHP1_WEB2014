<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    //tạo class xử lý bảng giỏ hàng
    class CartModel{
        //tạo biến kết nối
        private $conn;
        //hàm trả về kết nối database
        public function __construct(){
            $database = new Database($db_host = "",$db_name="",$db_user="",$db_password="");
            $this->conn = $database->connect();
        }

        //tạo hàm để xử lý hiển thị giỏ hàng
        public function getCartItems($user_id){
            $sql = "SELECT * 
                    FROM cart 
                    JOIN products 
                    ON cart.product_id = products.id 
                    WHERE cart.user_id = :user_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        //hàm thêm sản phẩm theo số lượng
        public function addtoCart($user_id,$product_id){

            //kiểm tra sản phẩm có trong giỏ hay không?
            $sql = "SELECT quantity 
                    FROM cart 
                    WHERE user_id = :user_id 
                    AND product_id = :product_id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            $stmt->bindParam(":product_id",$product_id,PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //xét dòng trả về
            if($row){
                //nếu sản phẩm có trong giỏ thì cập nhật số lượng
                $new_quantity = $row["quantity"] + 1;
                $update_quantity = $this->conn->prepare(
                    "UPDATE cart 
                            SET quantity = :quantity 
                            WHERE user_id = :user_id 
                            AND product_id = :product_id");
                $update_quantity->bindParam(":quantity",$new_quantity,PDO::PARAM_INT);
                $update_quantity->bindParam(":user_id",$user_id,PDO::PARAM_INT);
                $update_quantity->bindParam(":product_id",$product_id,PDO::PARAM_INT);
                $update_quantity->execute();
                return "updated";
            }
            else{
                //nếu sản phẩm không tồn tại trong giỏ hàng thì thêm mới
                $insert_sql = "INSERT
                                INTO cart(user_id, product_id, quantity, date_added) 
                                VALUES(:user_id, :product_id, 1,NOW())";
                $insert_stmt = $this->conn->prepare($insert_sql);
                $insert_stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
                $insert_stmt->bindParam(":product_id",$product_id,PDO::PARAM_INT);
                $insert_stmt->execute();
                return "inserted";
            }
        }

        //hàm xoá sản phẩm trong giỏ hàng
        public function removeItem($user_id,$product_id){
            $sql = "DELETE
                    FROM cart 
                    WHERE user_id = :user_id 
                    AND product_id = :product_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            $stmt->bindParam(":product_id",$product_id,PDO::PARAM_INT);
            return $stmt->execute();
        }

        //hàm xoá toàn bộ sản phẩm trong giỏ hàng theo id của người dùng
        public function removeCart($user_id){
            $sql = "DELETE
                    FROM cart 
                    WHERE user_id = :user_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            return $stmt->execute();
        }

        //hàm lấy ra toàn bộ sản phẩm trong giỏ hàng theo id người dùng
        public function getCartByUserId($user_id){
            $sql = "SELECT * 
                    FROM cart 
                    WHERE user_id = :user_id";

            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(":user_id",$user_id,PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

    }
?>