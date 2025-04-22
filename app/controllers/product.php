<?php
class product extends DController{
    //Khởi tạo
    public function __construct(){
        parent::__construct();
    }
    public function index() {
        $this->add_category();
    }
    //Thêm danh sách sản phẩm
    public function add_category(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/add_category');
        $this->load->view('cpanel/footer');
    }
    //Thêm sản phẩm
    public function add_product(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $table = "tbl_category_product";
        $categorymodel = $this->load->model('categorymodel');
        $data['category'] = $categorymodel->category($table);
        $this->load->view('cpanel/product/add_product', $data);
        $this->load->view('cpanel/footer');
    }
    //Đưa sản phẩm vào database
    public function insert_product(){
        $title = $_POST['title_product'];
        $desc = $_POST['desc_product'];
        $price = $_POST['price_product'];
        $quantity = $_POST['quantity_product'];
        $hot = $_POST['product_hot'];

        $image = $_FILES['image_product']['name'];
        $tmp_image = $_FILES['image_product']['tmp_name'];

        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads = "public/upload/product/".$unique_image;

        $category = $_POST['category_product'];
        $table = "tbl_product";
        $data = array(
            'title_product' => $title,
            'desc_product' => $desc,
            'price_product' => $price,
            'quantity_product' => $quantity,
            'image_product' => $unique_image,
            'product_hot' => $hot,
            'id_category_product' => $category
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->insertproduct($table, $data);
        if($result == 1){
            move_uploaded_file($tmp_image, $path_uploads);
            $message['msg'] = "Thêm sản phẩm thành công";
            header('Location:'.BASE_URL."product/add_product?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Thêm sản phẩm thất bại";
            header('Location:'.BASE_URL."product/add_product?msg=".urlencode(serialize($message)));
        }
    }
    //Đưa danh sách sản phẩm vào Database
    public function insert_category(){
        $title = $_POST['title_category_product'];
        $desc = $_POST['desc_category_product'];
        $table = "tbl_category_product";
        $data = array(
            'title_category_product' => $title,
            'desc_category_product' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->insertcategory($table, $data);
        if($result == 1){
            $message['msg'] = "Thêm danh mục thành công";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Thêm danh mục thất bại";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Liệt kê danh sách sản phẩm
    public function list_product(){
        $productmodel = $this->load->model('productmodel');
        $categorymodel = $this->load->model('categorymodel');
        $table_product = "tbl_product";
        $table_category = "tbl_category_product";

        // Get products per page from GET parameter or use default
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $per_page = in_array($per_page, [10, 25, 50]) ? $per_page : 10;

        // Get category filter - handle empty string as null
        $category_id = isset($_GET['category']) && $_GET['category'] !== '' ? (int)$_GET['category'] : null;

        // Pagination settings
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $per_page;
        
        // Get total number of products
        $total_products = $productmodel->getTotalProducts($category_id);
        $total_pages = ceil($total_products / $per_page);
        
        // Get products for current page
        $data['product'] = $productmodel->list_product($table_product, $table_category, $offset, $per_page, $category_id);
        
        // Get all categories for the filter dropdown
        $data['categories'] = $categorymodel->category($table_category);
        
        // Pass pagination data to view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['per_page'] = $per_page;

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/list_product', $data);
        $this->load->view('cpanel/footer');
    }
    //Liệt kê danh sách sản phẩm
    public function list_category(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_category_product";
        $categorymodel = $this->load->model('categorymodel');
        $data['category'] = $categorymodel->category($table);

        $this->load->view('cpanel/product/list_category', $data);
        $this->load->view('cpanel/footer');
    }
    //Xóa sản phẩm
    public function delete_product($id){
        $table = "tbl_product";
        $cond = "id_product='$id'";
        $categorymodel = $this->load->model('categorymodel');
        
        // Get the product image path before deleting
        $product_data = $categorymodel->productbyid($table, $cond);
        $image_path = "public/upload/product/";
        
        // Delete the product from database
        $result = $categorymodel->deletecategory($table, $cond);
        
        if($result == 1){
            // Delete the product image file
            if(!empty($product_data)){
                foreach($product_data as $key => $value){
                    if(file_exists($image_path.$value['image_product'])){
                        unlink($image_path.$value['image_product']);
                    }
                }
            }
            
            // Remove product from all active sessions
            if(isset($_SESSION['cart'])){
                foreach($_SESSION['cart'] as $key => $value){
                    if($value['id_product'] == $id){
                        unset($_SESSION['cart'][$key]);
                    }
                }
                // Reindex the array to maintain sequential keys
                $_SESSION['cart'] = array_values($_SESSION['cart']);
            }
            
            $message['msg'] = "Xóa sản phẩm thành công";
            header('Location:'.BASE_URL."product/list_product?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Xóa sản phẩm thất bại";
            header('Location:'.BASE_URL."product/list_product?msg=".urlencode(serialize($message)));
        }
    }
    //Xóa danh sách sản phẩm
    public function delete_category($id){
        $table = "tbl_category_product";
        $cond = "id_category_product='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->deletecategory($table, $cond);
        if($result == 1){
            $message['msg'] = "Xóa danh mục thành công";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Xóa danh mục thất bại";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Cập nhật sản phẩm
    public function edit_product($id){
        $table = "tbl_product";
        $table_category = "tbl_category_product";
        $cond = "id_product='$id'";
        $categorymodel = $this->load->model('categorymodel');

        $data['productbyid'] = $categorymodel->productbyid($table, $cond);
        $data['category'] = $categorymodel->category($table_category);

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/edit_product', $data);
        $this->load->view('cpanel/footer');
    }
    //Cập nhật danh sách sản phẩm
    public function edit_category($id){
        $table = "tbl_category_product";
        $cond = "id_category_product='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $data['categorybyid'] = $categorymodel->categorybyid($table, $cond);
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/product/edit_category', $data);
        $this->load->view('cpanel/footer');
    }
    //Sau khi cập nhật danh mục sản phẩm sẽ đưa vào database
    public function update_category_product($id){
        $table = "tbl_category_product";
        $cond = "id_category_product='$id'";

        $title = $_POST['title_category_product'];
        $desc = $_POST['desc_category_product'];

        $data = array(
            'title_category_product' => $title,
            'desc_category_product' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->updatecategory($table, $data, $cond);
        if($result == 1){
            $message['msg'] = "Cập nhật danh mục thành công";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Cập nhật danh mục thất bại";
            header('Location:'.BASE_URL."product/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Cập nhật sản phẩm
    public function update_product($id){
        $table = "tbl_product";
        $categorymodel = $this->load->model('categorymodel');
        $title = $_POST['title_product'];
        $desc = $_POST['desc_product'];
        $price = $_POST['price_product'];
        $quantity = $_POST['quantity_product'];
        $category = $_POST['category_product'];
        $hot = $_POST['product_hot'];
        $cond = "id_product='$id'";
        $image = $_FILES['image_product']['name'];
        $tmp_image = $_FILES['image_product']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads = "public/upload/product/".$unique_image;
        if($image){
            $data['productbyid'] = $categorymodel->productbyid($table, $cond);
            foreach($data['productbyid'] as $key => $value){
                $path_unlink = "public/upload/product/";
                unlink($path_unlink.$value['image_product']);
            }
            $data = array(
                'title_product' => $title,
                'desc_product' => $desc,
                'price_product' => $price,
                'product_hot' => $hot,
                'quantity_product' => $quantity,
                'image_product' => $unique_image,
                'id_category_product' => $category
            );
            move_uploaded_file($tmp_image, $path_uploads);
        }else{
            $data = array(
                'title_product' => $title,
                'desc_product' => $desc,
                'price_product' => $price,
                'product_hot' => $hot,
                'quantity_product' => $quantity,
                'id_category_product' => $category
            );
        }
        $result = $categorymodel->updateproduct($table, $data, $cond);
        if($result == 1){
            $message['msg'] = "Cập nhật sản phẩm thành công";
            header('Location:'.BASE_URL."product/list_product?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Cập nhật sản phẩm thất bại";
            header('Location:'.BASE_URL."product/list_product?msg=".urlencode(serialize($message)));
        }
    }
}
?>