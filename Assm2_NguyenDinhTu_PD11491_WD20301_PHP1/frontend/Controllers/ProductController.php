<?php
    //nạp xử lý database
    require_once ROOT."/Models/ProductModel.php";

    //tạo class tương tác với dữ liệu và hiển thị
    class ProductController{
        private $model;
        //tạo hàm trả về giá trị class
        public function __construct(){
            $this->model = new ProductModel();
        }

        //hàm điều khiển hiển thị phân trang danh sách sản phẩm
        public function products_list_pagisnated(){
            //gọi để hiển thị thông báo thêm hay cập nhật sản phẩm
            session_start();
            $limit = 3;
            $page = isset($_GET["page"]) ? max(1,intval($_GET["page"])): 1;
            $offset = ($page - 1) * $limit;

            //gọi xử lý dữ liệu
            $products = $this->model->getProductPagisnated($limit,$offset);
            $total = $this->model->countProduct();
            $totalPages = ceil($total / $limit);
            require_once ROOT."/Views/product.php";
        }

        //hàm để hiển thị chi tiết sản phẩm
        public function products_detail($id){
            $product_detail = $this->model->getProductById($id);
            require_once ROOT."/Views/product_detail.php";
        }

        //hàm để hiển thị kết quả tìm kiếm sản phẩm
        public function product_search(){
            if(isset($_GET["keyword"])){
                $keyword = $_GET["keyword"];
                $product_search = $this->model->getProductByName($keyword);
                require_once ROOT."/Views/product_search.php";
            }
            else{
                require_once ROOT."/Views/product_search.php";
            }
        }

        //hàm đếm số sản phẩm có danh mục là đồ điện tử
        
    }
?>