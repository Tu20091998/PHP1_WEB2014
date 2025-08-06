<?php
    //nạp cơ sở dữ liệu
    require_once ROOT."/../Config/db.php";

    class ReportsModel{
        private $report_model;

        public function __construct(){
            $db = new Database();
            $this->report_model = $db->connect();
        }

        //tạo hàm thống kế danh mục theo sản phẩm
        public function countProductsByCategories(){
            try{
                $sql = "SELECT c.category_name, COUNT(p.id) AS total 
                        FROM products p 
                        JOIN categories c
                        ON p.category_id = c.category_id
                        GROUP BY c.category_name";

                $stmt = $this->report_model->query($sql);
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            catch(PDOException $e){
                error_log("Lỗi khi truy vấn thống kê sản phẩm theo danh mục !". $e->getMessage());
                return false;
            }
        }
    }
?>