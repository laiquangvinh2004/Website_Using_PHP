<?php
class order extends DController{
    //Khởi tạo
    public function __construct(){
        Session::checkSession();
        parent::__construct();
    }
    public function index() {
        $this->order();
    }
    //Khởi tạo đơn hàng
    public function order(){
        $ordermodel = $this->load->model('ordermodel');
        $table_order = "tbl_order";

        // Pagination settings
        $orders_per_page = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $orders_per_page;
        
        // Get total number of orders
        $total_orders = $ordermodel->getTotalOrders();
        $total_pages = ceil($total_orders / $orders_per_page);
        
        // Get orders for current page
        $data['order'] = $ordermodel->list_order($table_order, $offset, $orders_per_page);
        
        // Pass pagination data to view
        $data['current_page'] = $page;
        $data['total_pages'] = $total_pages;
        $data['orders_per_page'] = $orders_per_page;

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/order/order', $data);
        $this->load->view('cpanel/footer');
    }
    //Khởi tạo chi tiết đơn hàng
    public function order_detail($order_code){
        $ordermodel = $this->load->model('ordermodel');
        $table_order = "tbl_order_detail";
        $table_product = "tbl_product";
        $cond = "$table_product.id_product = $table_order.product_id AND 
            $table_order.order_code = '$order_code'";
        $cond_info = "$table_order.order_code = '$order_code'";
        $data['order_detail'] = $ordermodel->list_order_detail($table_product, $table_order, $cond);
        $data['order_info'] = $ordermodel->list_info($table_order, $cond_info);

        $this->load->view('cpanel/header');
        $this->load->view('cpanel/menu');
        $this->load->view('cpanel/order/order_detail', $data);
        $this->load->view('cpanel/footer');
    }
    //Xác nhận đơn hàng
    public function order_confirm($order_code){
        $ordermodel = $this->load->model('ordermodel');
        $table_order = "tbl_order";
        $cond = "$table_order.order_code='$order_code'";
        $data = array(
            'order_status' => 1
        );
        $result = $ordermodel->order_confirm($table_order, $data, $cond);
        if($result == 1){
            $message['msg'] = "Đã xử lý đơn hàng thành công";
            header('Location:'.BASE_URL."order?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Đã xử lý đơn hàng thất bại";
            header('Location:'.BASE_URL."order?msg=".urlencode(serialize($message)));
        }
    }
    //Xóa đơn hàng
    public function delete_order($order_code){
        $ordermodel = $this->load->model('ordermodel');
        $table_order = "tbl_order";
        $cond = "order_code='$order_code'";
        $result = $ordermodel->delete_order($table_order, $cond);
        if($result == 1){
            $message['msg'] = "Xóa đơn hàng thành công";
            header('Location:'.BASE_URL."order?msg=".urlencode(serialize($message)));
        }
        else{
            $message['msg'] = "Xóa đơn hàng thất bại";
            header('Location:'.BASE_URL."order?msg=".urlencode(serialize($message)));
        }
    }
}
?>