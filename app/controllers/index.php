<?php
    class index extends DController{
        //Khởi tạo trang index
        public function __construct(){
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->homepage();
        }
        //Khởi tạo homepage
        public function homepage(){
            $table = 'tbl_category_product';
            $table_category_post = 'tbl_category_post';
            $table_product = 'tbl_product';
            $table_post = 'tbl_post';
            $categorymodel = $this->load->model('categorymodel');
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_category_post);
            $data['product_home'] = $categorymodel->list_product_index($table_product);
            $data['post_index'] = $categorymodel->post_index($table_post);

            $this->load->view('header', $data);
            $this->load->view('slider', $data);
            $this->load->view('homepage', $data);
            $this->load->view('footer');
        }
        //Nếu link không tồn tại sẽ chuyển sang trang NOTFOUND 404
        public function notfound(){
            $this->load->view('header');
            $this->load->view('404');
            $this->load->view('footer');
        }
    }
?>