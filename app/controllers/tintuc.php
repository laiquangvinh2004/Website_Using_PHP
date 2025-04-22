<?php
    class tintuc extends DController{
        //Khởi tạo
        public function __construct(){
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->danhmuc();
        }
        //Đưa ra danh sách tất cả bài viết
        public function tatca(){
            $table = 'tbl_category_product';
            $table_category_post = 'tbl_category_post';
            $post = 'tbl_post';

            $categorymodel = $this->load->model('categorymodel');
            $postmodel = $this->load->model('postmodel');

            // Pagination settings
            $posts_per_page = 8; // Number of posts per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $posts_per_page;
            
            // Get total number of posts
            $total_posts = $postmodel->count_posts($post);
            $total_pages = ceil($total_posts / $posts_per_page);
            
            // Get posts for current page
            $data['list_post'] = $postmodel->list_post_home($post, $offset, $posts_per_page);
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_category_post);
            
            // Pass pagination data to view
            $data['current_page'] = $page;
            $data['total_pages'] = $total_pages;
            $data['posts_per_page'] = $posts_per_page;

            $this->load->view('header', $data);
            $this->load->view('list_post', $data);
            $this->load->view('footer');
        }
        //Đưa ra bài viết theo danh mục
        public function danhmuc($id){
            $table = 'tbl_category_product';
            $table_category_post = 'tbl_category_post';
            $table_post = 'tbl_post';

            $categorymodel = $this->load->model('categorymodel');
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_category_post);
            $data['postbyid'] = $categorymodel->postbyid_home($table_category_post, $table_post, $id);

            $this->load->view('header', $data);
            $this->load->view('categorypost', $data);
            $this->load->view('footer');
        }
        //Đưa ra chi tiết bài viết
        public function chitiettin($id){
            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $post = 'tbl_post';
            $cond = "$table_post.id_category_post = $post.id_category_post
                AND $post.id_post = '$id'";

            $categorymodel = $this->load->model('categorymodel');
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);
            $data['postbyid'] = $categorymodel->postbyid_home($table_post, $post, $id);
            $data['details_post'] = $categorymodel->details_post_home($table_post, $post, $cond);

            foreach($data['details_post'] as $key => $cate){
                $id_post = $cate['id_category_post'];
            }
            $cond2 = "$table_post.id_category_post=$post.id_category_post AND
                $table_post.id_category_post='$id_post' AND 
                $post.id_post NOT IN('$id')";
            $data['related'] = $categorymodel->related_post_home($post, $table_post, $cond2);

            $this->load->view('header', $data);
            $this->load->view('details_post', $data);
            $this->load->view('footer');
        }
    }
?>