<?php
    class sanpham extends DController{
        //Khởi tạo
        public function __construct(){
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->danhmuc();
        }
        //Đưa ra danh sách tất cả sản phẩm
        public function tatca(){
            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $table_product ='tbl_product';
            $categorymodel = $this->load->model('categorymodel');
            
            // Pagination settings
            $products_per_page = 12; // Number of products per page
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $products_per_page;
            
            // Get total number of products
            $total_products = $categorymodel->count_products($table_product);
            $total_pages = ceil($total_products / $products_per_page);
            
            // Get products for current page
            $data['list_product'] = $categorymodel->list_product_home($table_product, $offset, $products_per_page);
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);
            
            // Pass pagination data to view
            $data['current_page'] = $page;
            $data['total_pages'] = $total_pages;
            $data['products_per_page'] = $products_per_page;

            $this->load->view('header', $data);
            $this->load->view('list_product', $data);
            $this->load->view('footer');
        }
        //Đưa ra danh sách sản phẩm theo danh mục
        public function danhmuc($id){
            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $table_product ='tbl_product';
            $categorymodel = $this->load->model('categorymodel');
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);
            $data['category_by_id'] = $categorymodel->categorybyid_home($table, $table_product, $id);

            $this->load->view('header', $data);
            $this->load->view('categoryproduct', $data);
            $this->load->view('footer');
        }
        //Đưa ra chi tiết sản phẩm
        public function chitietsanpham($id){
            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $table_product ='tbl_product';
            $cond = "$table_product.id_category_product=$table.id_category_product AND $table_product.id_product='$id'";
            $categorymodel = $this->load->model('categorymodel');

            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);
            $data['details_product'] = $categorymodel->details_product_home($table, $table_product, $cond);
            

            foreach($data['details_product'] as $key => $cate){
                $id_cate = $cate['id_category_product'];
            }
            $cond2 = "$table_product.id_category_product=$table.id_category_product AND
                $table.id_category_product = '$id_cate' AND
                $table_product.id_product NOT IN('$id')";
            $data['related'] = $categorymodel->related_product_home($table, $table_product, $cond2);
            $this->load->view('header', $data);
            $this->load->view('details_product', $data);
            $this->load->view('footer');
        }
    }
?>