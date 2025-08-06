<?php
    //nạp xử lý database
    require_once ROOT."/Models/ProductModel.php";
    require_once ROOT."/Models/CategoriesModel.php";
    require_once ROOT."/Models/UserModel.php";

    //tạo class tương tác với dữ liệu và hiển thị
    class ProductController{
        private $model;
        private $categories_model;

        private $user_model;
        //tạo hàm trả về giá trị class
        public function __construct(){
            $this->model = new ProductModel();
            $this->categories_model = new CategoriesModel();
            $this->user_model = new UserModel();
        }

        //hàm điều khiển hiển thị phân trang danh sách sản phẩm
        public function products_list_pagisnated(){
            //gọi để hiển thị thông báo thêm hay cập nhật sản phẩm
            session_start();

            //nhận id danh mục từ form
            $category_id = isset($_GET['category_id']) ? intval($_GET['category_id']) : null;

            //phân trang
            $limit = 6;
            $page = isset($_GET["page"]) ? max(1,intval($_GET["page"])): 1;
            $offset = ($page - 1) * $limit;
            

            //đẩy ra danh sách danh mục
            $categories_list = $this->categories_model->getCategoriesList();

            //lấy ra tổng đếm sản phẩm
            $total = $this->model->countProduct($category_id);

            //tổng số trang
            $totalPages = ceil($total / $limit);

            //đẩy ra kết quả danh sách sản phẩm
            $products = $this->model->getProductByCategoryPagisnated($category_id,$limit,$offset);
            
            require_once ROOT."/Views/product.php";
        }

        //hàm để hiển thị chi tiết sản phẩm
        public function products_detail($id){
            $product_detail = $this->model->getProductById($id);
            $comments = $this->user_model->getUserCommentsByProductId($id);
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
    }
?>