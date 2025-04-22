<?php
    class khachhang extends DController{
        //Khởi tạo
        public function __construct(){
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->khachhang();
        }
        //Đăng ký
        public function login_customer(){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $table_customer = 'tbl_customer';
            $customermodel = $this->load->model('customermodel');

            $count = $customermodel->login($table_customer, $username, $password);

            if($count == 0){
                $message['msg'] = "Username or Password wrong";
                header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
            }
            else{
                $result = $customermodel->getLogin($table_customer, $username, $password);
                Session::init();
                Session::set('customer', true);
                Session::set('customer_name', $result[0]['customer_name']);
                Session::set('customer_id', $result[0]['customer_id']);
                Session::set('customer_email', $result[0]['customer_email']);
                $message['msg'] = "Username or Password true";
                header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
            }
        }
        //Đăng nhập
        public function dangnhap(){
            //$table = 'tbl_customer';
            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $table_product = 'tbl_product';
            $categorymodel = $this->load->model('categorymodel');
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);
            $data['product_home'] = $categorymodel->list_product_index($table_product);
            Session::init();
            $this->load->view('header', $data);
            $this->load->view('customer_login', $data);
            $this->load->view('footer');
        }
        //Đăng xuất
        public function dangxuat(){
            Session::init();
            Session::destroyCustomer();
            $message['msg'] = "Đăng xuất thành công";
            header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
        }
        //Đưa dữ liệu khách hàng đăng ký vào database
        public function insert_dangky(){
            $name = $_POST['txtHoTen'];
            $email = $_POST['txtEmail'];
            $phone = $_POST['txtDienThoai'];
            $address = $_POST['txtDiaChi'];
            $password = $_POST['txtPassword'];
            
            $table = "tbl_customer";

            $data = array(
                'customer_name' => $name,
                'customer_email' => $email,
                'customer_phone' => $phone,
                'customer_address' => $address,
                'customer_password' => $password,
            );
            $customermodel = $this->load->model('customermodel');
            $result = $customermodel->insertcustomer($table, $data);
            if($result == 1){
                $message['msg'] = "Đăng ký thành công";
                header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
            }
            else{
                $message['msg'] = "Đăng ký thất bại";
                header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
            }
        }
        //Check lịch sử đơn hàng của khách hàng
        public function lichsudonhang(){
            Session::init();
            // Check if customer is logged in
            if(!Session::get('customer')){
                $message['msg'] = "Vui lòng đăng nhập để xem lịch sử đơn hàng";
                header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
                return;
            }

            $table = 'tbl_category_product';
            $table_post = 'tbl_category_post';
            $categorymodel = $this->load->model('categorymodel');
            $ordermodel = $this->load->model('ordermodel');

            // Get categories for menu
            $data['category'] = $categorymodel->category_home($table);
            $data['category_post'] = $categorymodel->categorypost_home($table_post);

            // Get customer's orders
            $customer_email = Session::get('customer_email');
            $data['orders'] = $ordermodel->get_orders_by_email($customer_email);

            // Load views
            $this->load->view('header', $data);
            $this->load->view('customer_order_history', $data);
            $this->load->view('footer');
        }
    }
?>