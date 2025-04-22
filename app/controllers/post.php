<?php
class post extends DController{
    //Khởi tạo
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->add_category();
    }
    //Khởi tạo danh mục bài viết
    public function add_category(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/post/add_category');
        $this->load->view('cpanel/footer');
    }
    //Thêm danh mục bài viết
    public function insert_category(){
        $title = $_POST['title_category_post'];
        $desc = $_POST['desc_category_post'];
        $table = "tbl_category_post";
        $data = array(
            'title_category_post' => $title,
            'desc_category_post' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->insertcategory_post($table, $data);
        if($result == 1){
            $message['msg'] = "Thêm danh mục bài viết thành công";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Thêm danh mục bài viết thất bại";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Thêm danh sách bài viết
    public function list_category(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table = "tbl_category_post";
        $categorymodel = $this->load->model('categorymodel');
        $data['category'] = $categorymodel->post_category($table);

        $this->load->view('cpanel/post/list_category', $data);
        $this->load->view('cpanel/footer');
    }
    //Xóa danh sách bài viết
    public function delete_category($id){
        $table = "tbl_category_post";
        $cond = "id_category_post='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->deletecategory_post($table, $cond);
        if($result == 1){
            $message['msg'] = "Xóa danh mục bài viết thành công";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Xóa danh mục bài viết thất bại";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Chỉnh sửa danh sách bài viết
    public function edit_category($id){
        $table = "tbl_category_post";
        $cond = "id_category_post='$id'";
        $categorymodel = $this->load->model('categorymodel');
        $data['categorybyid'] = $categorymodel->categorybyid_post($table, $cond);
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/post/edit_category', $data);
        $this->load->view('cpanel/footer');
    }
    //Cập nhật danh sách bài viết
    public function update_category_post($id){
        $table = "tbl_category_post";
        $cond = "id_category_post='$id'";

        $title = $_POST['title_category_post'];
        $desc = $_POST['desc_category_post'];

        $data = array(
            'title_category_post' => $title,
            'desc_category_post' => $desc
        );
        $categorymodel = $this->load->model('categorymodel');
        $result = $categorymodel->updatecategory_post($table, $data, $cond);
        if($result == 1){
            $message['msg'] = "Cập nhật danh mục bài viết thành công";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Cập nhật danh mục bài viết thất bại";
            header('Location:'.BASE_URL."post/list_category?msg=".urlencode(serialize($message)));
        }
    }
    //Thêm bài viết
    public function add_post(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $postmodel = $this->load->model('postmodel');
        $table = "tbl_category_post";
        $data['category'] = $postmodel->category_post($table);
        $this->load->view('cpanel/post/add_post', $data);
        $this->load->view('cpanel/footer');
    }
    //Thêm bài viết vào database
    public function insert_post(){
        $title = $_POST['title_post'];
        $content = $_POST['content_post'];
        $image = $_FILES['image_post']['name'];
        $tmp_image = $_FILES['image_post']['tmp_name'];

        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;

        $path_uploads = "public/upload/post/".$unique_image;

        $category = $_POST['category_post'];
        $table = "tbl_post";
        $data = array(
            'title_post' => $title,
            'content_post' => $content,
            'image_post' => $unique_image,
            'id_category_post' => $category
        );
        $postmodel = $this->load->model('postmodel');
        $result = $postmodel->insertpost($table, $data);
        if($result == 1){
            move_uploaded_file($tmp_image, $path_uploads);
            $message['msg'] = "Thêm bài viết thành công";
            header('Location:'.BASE_URL."post/add_post?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Thêm bài viết thất bại";
            header('Location:'.BASE_URL."post/add_post?msg=".urlencode(serialize($message)));
        }
    }
    //Liệt kê bài viết
    public function list_post(){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');

        $table_post = "tbl_post";
        $table_category_post = "tbl_category_post";

        // Get posts per page from GET parameter or use default
        $per_page = isset($_GET['per_page']) ? (int)$_GET['per_page'] : 10;
        $per_page = in_array($per_page, [10, 25, 50]) ? $per_page : 10;

        // Get category filter - handle empty string as null
        $category_id = isset($_GET['category']) && $_GET['category'] !== '' ? (int)$_GET['category'] : null;

        // Pagination settings
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $per_page;
        
        // Get total number of posts
        $postmodel = $this->load->model('postmodel');
        $total_posts = $postmodel->count_posts($table_post, $category_id);
        $total_pages = ceil($total_posts / $per_page);
        
        // Get posts for current page
        $data['post'] = $postmodel->post($table_post, $table_category_post, $offset, $per_page, $category_id);
        
        // Get all categories for the filter dropdown
        $data['categories'] = $postmodel->category_post($table_category_post);
        
        // Pass pagination data to view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['per_page'] = $per_page;

        $this->load->view('cpanel/post/list_post', $data);
        $this->load->view('cpanel/footer');
    }
    //Xóa bài viết
    public function delete_post($id){
        $table_post = "tbl_post";
        $cond = "id_post='$id'";
        $postmodel = $this->load->model('postmodel');
        $result = $postmodel->deletepost($table_post, $cond);
        if($result == 1){
            $message['msg'] = "Xóa bài viết thành công";
            header('Location:'.BASE_URL."post/list_post?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Xóa bài viết thất bại";
            header('Location:'.BASE_URL."post/list_post?msg=".urlencode(serialize($message)));
        }
    }
    //Chỉnh sửa bài viết
    public function edit_post($id){
        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $cond = "id_post='$id'";
        $postmodel = $this->load->model('postmodel');
        $table = "tbl_category_post";
        $table_post = "tbl_post";
        $data['category'] = $postmodel->category_post($table);
        $data['postbyid'] = $postmodel->postbyid($table_post, $cond);
        $this->load->view('cpanel/post/edit_post', $data);
        $this->load->view('cpanel/footer');
    }
    //Cập nhật bài viết
    public function update_post($id){
        $table = "tbl_post";
        $cond = "id_post='$id'";
        $title = $_POST['title_post'];
        $content = $_POST['content_post'];
        $category = $_POST['category_post'];
        $image = $_FILES['image_post']['name'];
        $postmodel = $this->load->model('postmodel');

        $tmp_image = $_FILES['image_post']['tmp_name'];
        $div = explode('.', $image);
        $file_ext = strtolower(end($div));
        $unique_image = $div[0].time().'.'.$file_ext;
        $path_uploads = "public/upload/post/".$unique_image;

        if($image){
            $data['postbyid'] = $postmodel->postbyid($table, $cond);
            foreach($data['postbyid'] as $key => $value){
                $path_unlink = "public/upload/post/";
                unlink($path_unlink.$value['image_post']);
            }
            $data = array(
                'title_post' => $title,
                'content_post' => $content,
                'image_post' => $unique_image,
                'id_category_post' => $category
            );
            move_uploaded_file($tmp_image, $path_uploads);
        }
        else{
            $data = array(
                'title_post' => $title,
                'content_post' => $content,
                'id_category_post' => $category
            );
        }
        $result = $postmodel->updatepost($table, $data, $cond);
        if($result == 1){
            $message['msg'] = "Cập nhật bài viết thành công";
            header('Location:'.BASE_URL."post/list_post?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Cập nhật bài viết thất bại";
            header('Location:'.BASE_URL."post/list_post?msg=".urlencode(serialize($message)));
        }
    }
}
?>