<?php
class category extends DController{
    //khởi tạo
    public function __construct(){
        $data = array();
        $message = array();
        parent::__construct();
    }
    //đưa ra danh sách danh mục sản phẩm ở trang Admin
    public function list_category(){
        $this->load->view('header');
        $categorymodel = $this->load->model('categorymodel');
        $table_category_product = 'tbl_category_product';
        $data['category'] = $categorymodel->category($table_category_product);
        $this->load->view('category', $data);
        $this->load->view('footer');
    }
    //sắp xếp danh mục sản phẩm theo ID
    public function catebyid(){
        $this->load->view('header');
        $categorymodel = $this->load->model('categorymodel');
        $id = 2;
        $table_category_product = 'tbl_category_product';
        $data['categorybyid'] = $categorymodel->categorybyid($table_category_product, $id);
        $this->load->view('categorybyid', $data);
        $this->load->view('footer');
    }
    //Thêm danh mục sản phẩm
    public function addcategory(){
        $this->load->view('addcategory');
    }
    //Đưa danh mục sản phẩm vào bảng
    public function insertcategory(){
        $categorymodel = $this->load->model('categorymodel');
        $table_category_product = 'tbl_category_product';

        $title = $_POST['title'];
        $desc = $_POST['desc'];

        $data = array(
            'title_category_product' => $title,
            'desc_category_product' => $desc
        );
        $result = $categorymodel->insertcategory($table_category_product, $data);

        if($result == 1){
            $message['msg'] = "Thêm dữ liệu thành công";
        }
        else{
            $message['msg'] = "Thêm dữ liệu thất bại";
        }
        $this->load->view('addcategory', $message);
    }
    //Cập nhật danh mục sản phẩm
    public function updatecategory(){
        $categorymodel = $this->load->model('categorymodel');
        $table_category_product = 'tbl_category_product';

        //$title = $_POST['title'];
        //$desc = $_POST['desc'];

        $id = 2;
        $cond = "tbl_category_product.id_category_product = '$id'";
        $data = array(
            'title_category_product' => 'Macbook Pro',
            'desc_category_product' => 'Macbook Air Pro'
        );
        $result = $categorymodel->updatecategory($table_category_product, $data, $cond);

        if($result == 1){
            echo "Cập nhật dữ liệu thành công";
        }
        else{
            echo "Cập nhật dữ liệu thất bại";
        }
    }
    //Xóa danh mục sản phẩm
    public function deletecategory(){
        $categorymodel = $this->load->model('categorymodel');
        $table_category_product = 'tbl_category_product';

        //$title = $_POST['title'];
        //$desc = $_POST['desc'];

        $cond = "id_category_product = 11";
        $data = array(
            'title_category_product' => 'Macbook Pro',
            'desc_category_product' => 'Macbook Air Pro'
        );
        $result = $categorymodel->deletecategory($table_category_product, $cond);

        if($result == 1){
            echo "Xóa dữ liệu thành công";
        }
        else{
            echo "Xóa dữ liệu thất bại";
        }
    }
}
?>