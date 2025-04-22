<?php
    class categorymodel extends DModel{
        //Khởi tạo
        function __construct(){
            parent::__construct();
        }
        //Đưa ra danh mục ở Admin
        public function category($table){
            $sql = "SELECT * FROM $table ORDER BY id_category_product DESC";
            return $this->db->select($sql);
        }
        //Đưa ra danh mục ở Website
        public function category_home($table){
            $sql = "SELECT * FROM $table ORDER BY id_category_product DESC";
            return $this->db->select($sql);
        }
        //Đưa ra danh mục theo ID ở Website    
        public function categorybyid_home($table, $table_product, $id){
            $sql = "SELECT * FROM $table, $table_product WHERE $table.id_category_product 
            =$table_product.id_category_product AND $table_product.id_category_product ='$id' ORDER BY $table_product.id_product DESC";
            return $this->db->select($sql);
        }
        //Đưa ra danh mục theo ID ở Admin
        public function categorybyid($table, $cond){
            $sql = "SELECT * FROM $table WHERE $cond";
            return $this->db->select($sql);
        }
        //Thêm danh mục
        public function insertcategory($table_category_product, $data){
            return $this->db->insert($table_category_product, $data);
        }
        //Cập nhật danh mục
        public function updatecategory($table_category_product, $data, $cond){
            return $this->db->update($table_category_product, $data, $cond);
        }
        //Xóa danh mục
        public function deletecategory($table_category_product, $cond){
            return $this->db->delete($table_category_product, $cond);
        }
        //Thêm danh mục bài viết
        public function insertcategory_post($table, $data){
            return $this->db->insert($table, $data);
        }
        //Đưa ra danh mục bài viết admin
        public function post_category($table){
            $sql = "SELECT * FROM $table ORDER BY id_category_post DESC";
            return $this->db->select($sql);
        }
        //Sắp xếp bài viết theo danh mục bài viết Homepage
        public function postbyid_home($table_cate_post, $table_post, $id){
            $sql = "SELECT * FROM $table_cate_post, $table_post WHERE $table_cate_post.id_category_post 
            =$table_post.id_category_post AND $table_post.id_category_post ='$id' ORDER BY $table_post.id_post DESC";
            return $this->db->select($sql);
        }
        //Đưa ra danh mục bài viết Homepage
        public function categorypost_home($table){
            $sql = "SELECT * FROM $table ORDER BY id_category_post DESC";
            return $this->db->select($sql);
        }
        //Xóa danh mục bài viết
        public function deletecategory_post($table_category_product, $cond){
            return $this->db->delete($table_category_product, $cond);
        }
        //Đưa ra danh mục bài viết theo ID
        public function categorybyid_post($table, $cond){
            $sql = "SELECT * FROM $table WHERE $cond";
            return $this->db->select($sql);
        }
        //Cập nhật danh mục bài viết
        public function updatecategory_post($table_category_product, $data, $cond){
            return $this->db->update($table_category_product, $data, $cond);
        }
        //Đưa ra danh sách sản phẩm
        public function list_product_home($table_product, $offset = 0, $limit = 12){
            $sql = "SELECT * FROM $table_product ORDER BY $table_product.id_product DESC LIMIT $offset, $limit";
            return $this->db->select($sql);
        }
        //Đưa ra danh sách sản phẩm theo thư mục
        public function list_product_index($table_product){
            $sql = "SELECT * FROM $table_product ORDER BY $table_product.id_product DESC";
            return $this->db->select($sql);
        }
        //Thêm sản phẩm
        public function insertproduct($table, $data){
            return $this->db->insert($table, $data);
        }
        //Khởi tạo sản phẩm
        public function product($table_product, $table_category){
            $sql = "SELECT * FROM $table_product, $table_category WHERE $table_product.id_category_product
            =$table_category.id_category_product ORDER BY $table_product.id_product DESC";
            return $this->db->select($sql);
        }
        //Xóa sản phẩm
        public function deleteproduct($table_product, $cond){
            return $this->db->delete($table_product, $cond);
        }
        //Sắp xếp sản phẩm theo ID
        public function productbyid($table, $cond){
            $sql = "SELECT * FROM $table WHERE $cond";
            return $this->db->select($sql);
        }
        //Cập nhật sản phẩm
        public function updateproduct($table_category_product, $data, $cond){
            return $this->db->update($table_category_product, $data, $cond);
        }
        //Đưa ra sản phẩm chi tiết ở Homepage
        public function details_product_home($table, $table_product, $cond){
            $sql = "SELECT * FROM $table_product,$table WHERE $cond";
            return $this->db->select($sql);
        }
        //Đưa ra sản phẩm liên quan ở Homepage
        public function related_product_home($table, $table_product, $cond2){
            $sql = "SELECT * FROM $table, $table_product WHERE $cond2";
            return $this->db->select($sql);
        }
        //Đưa ra bài viết chi tiết ở Homepage
        public function details_post_home($table_category_post, $table_post, $cond){
            $sql = "SELECT * FROM $table_category_post, $table_post WHERE $cond ORDER BY $table_post.id_post DESC";
            return $this->db->select($sql);
        }
        //Đưa ra bài viết liên quan ở Homepage
        public function related_post_home($post, $table_post, $cond2){
            $sql = "SELECT * FROM $table_post, $post WHERE $cond2 ORDER BY $post.id_post DESC";
            return $this->db->select($sql);
        }
        //Giới hạn các bài viết xuất hiện trong 1 trang
        public function post_index($table_post){
            $sql = "SELECT * FROM $table_post ORDER BY $table_post.id_post DESC LIMIT 5";
            return $this->db->select($sql);
        }
        //Đếm số lượng sản phẩm
        public function count_products($table_product){
            $sql = "SELECT COUNT(*) as total FROM $table_product";
            $result = $this->db->select($sql);
            return $result[0]['total'];
        }
    }
?>