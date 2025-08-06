<?php
    //nạp trang truy vấn thống kê
    require_once ROOT."/Models/ReportsModel.php";


    //class xử lý hiển thị thống kê
    class ReportsController{
        private $report_model;

        public function __construct(){
            $this->report_model = new ReportsModel();
        }

        //tạo hàm xử lý hiển thị thống kê sản phẩm theo danh mục
        public function chart_category_distribution(){

            //dữ liệu thống kế sản phẩm theo danh mục
            $data = $this->report_model->countProductsByCategories();

            require_once ROOT."/Views/charts.php";
        }
    }

?>