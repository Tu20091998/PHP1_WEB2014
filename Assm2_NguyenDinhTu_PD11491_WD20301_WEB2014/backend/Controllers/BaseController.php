<?php
    // Bắt đầu phiên làm việc (bắt buộc để dùng $_SESSION)
    session_start();

    //tạo đường dẫn tuyệt đối
    define("ROOT",__DIR__.'/../');

    //nạp trang điều khiển admin
    require_once ROOT."/Controllers/AdminController.php";

    //nạp trang điều khiển người dùng
    require_once ROOT."/Controllers/UserController.php";

    //nạp trang điều khiển hiển thị sản phẩm
    require_once ROOT."/Controllers/ProductController.php";

    //nạp trang điều khiển hiển thị đơn hàng
    require_once ROOT."/Controllers/OrderController.php";

    //nạp trang điều khiển hiển thị danh mục
    require_once ROOT."/Controllers/CategoriesController.php";

    //nạp trang điều khiển hiển thị thống kê
    require_once ROOT."/Controllers/ReportsController.php";

    $action = $_GET["action"] ?? "home_display";

    switch($action){

        //điều khiển người quản trị
        case "home_display":

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            //thông tin tình hình chung của shop
            $products = new ProductController();
            $products->products_information();
        break;

        case "login_display":
            $login_display = new AdminController();
            $login_display->login_display();
        break;

        case "login_confirm":
            $login_confirm = new AdminController();
            $login_confirm->login_confirm();
        break;
        
        case "logout_confirm":
            $logout_confirm = new AdminController();
            $logout_confirm->logout_confirm();
        break;

        //điều khiển hiển thị xử lý người dùng
        case "users_display":

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $users_display = new UserController();
            $users_display->users_display();
        break;

        case "user_delete":
            $user_delete = new UserController();
            $user_delete->user_delete();
        break;

        
        //xử lý điều khiển sản phẩm và danh mục
        case "products_display":

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $products_display = new ProductController();
            $products_display->showCategoriesWithProducts();
        break;

        case 'delete_product':
            $delete_product = new ProductController();
            if (isset($_GET['id'])) {
                $delete_product->deleteProduct($_GET['id']);
            }
        break;

        case 'edit_product':
            $edit_product = new ProductController();
            if (isset($_GET['id'])) {
                $edit_product->showEditProductForm($_GET['id']);
            }
        break;

        case 'update_product':
            $update_product = new ProductController();
            if (isset($_GET['id'])) {
                $update_product->updateProduct($_GET['id']);
            }
        break;

        case 'add_product_display':
            $add_product_display = new ProductController();
            $add_product_display->add_product_display();
        break;

        case "add_product_confirm":
            $add_product_confirm = new ProductController();
            $add_product_confirm->add_product_confirm();
        break;
        
        //xử lý bình luận của sản phẩm
        case "comments_display":
            $comments_display = new ProductController();
            $comments_display->comments_display();
        break;

        case "hidden_comment_confirm":
            $hidden_comment_confirm = new ProductController();
            $hidden_comment_confirm->hidden_comment_confirm();
        break;

        //xử lý phần danh mục
        case "categories_display":
            $categories_display = new CategoriesController();
            $categories_display->categories_display();
        break;

        case 'add_categories_display':
            $add_categories_display = new CategoriesController();
            $add_categories_display->add_categories_display();
        break;

        case 'add_category_confirm':
            $add_categories_confirm = new CategoriesController();
            $add_categories_confirm->add_categories_confirm();
        break;

        case 'delete_category_confirm':
            $delete_categories_confirm = new CategoriesController();
            $delete_categories_confirm->delete_category_confirm();
        break;

        case "edit_category_display":
            $edit_category_display = new CategoriesController();
            $edit_category_display->edit_category_display();
        break;

        case "update_category_confirm":
            $update_category_confirm = new CategoriesController();
            $update_category_confirm->update_category_confirm();
        break;

        //xử lý yêu cầu đặt hàng
        case "order_display":
            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            $order_display = new OrderController();
            $order_display->order_display();
        break;

        case "order_confirm":
            $order_confirm = new OrderController();
            $order_confirm->order_confirm();
        break;

        case "order_detail":
            $order_detail = new OrderController();
            $order_detail->order_detail_display();
        break;

        case "order_cancer":
            $order_cancer = new OrderController();
            $order_cancer->cancel_order();
        break;

        //xử lý hiển thị thống kê
        case "reports_display":
            $reports_display = new ReportsController();
            $reports_display->chart_category_distribution();
        break;

        default:

            if (!isset($_SESSION['admin_id'])) {
                $_SESSION["message"] = "Bạn cần đăng nhập để thực hiện các chức năng !";
                header('Location:BaseController.php?action=login_display');
                exit;
            }

            //thông tin sản phẩm hết hàng
            $products = new ProductController();
            $products->products_information();
        break;
    }
?>