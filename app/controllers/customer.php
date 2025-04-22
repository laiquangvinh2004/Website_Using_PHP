<?php
    class customer extends DController{
        //khởi tạo
        public function __construct(){
            parent::__construct();
        }
        //danh sách khách hàng
        public function list_customer(){
            $customerModel = $this->load->model('customermodel');
            $table = 'tbl_customer';
            $data['customer'] = $customerModel->list_customers();
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/customer/list_customer', $data);
            $this->load->view('cpanel/footer');
        }
        //xóa khách hàng
        public function delete_customer($id){
            $customerModel = $this->load->model('customermodel');
            $table = 'tbl_customer';
            $cond = "customer_id='$id'";
            
            // Check if the deleted customer is the currently logged in user
            Session::init();
            $current_customer_id = Session::get('customer_id');
            
            $result = $customerModel->deletecustomer($table, $cond);
            if($result == 1){
                // If the deleted customer is the currently logged in user, log them out
                if($current_customer_id == $id){
                    Session::destroy();
                    $message['msg'] = "Tài khoản của bạn đã bị xóa. Vui lòng đăng nhập lại.";
                    header('Location:'.BASE_URL."khachhang/dangnhap?msg=".urlencode(serialize($message)));
                } else {
                    header("Location:".BASE_URL."customer/list_customer");
                }
            }else{
                header("Location:".BASE_URL."customer/list_customer");
            }
        }
        //Cập nhật khách hàng    
        public function edit_customer($id){
            $customerModel = $this->load->model('customermodel');
            $table = 'tbl_customer';
            $cond = "customer_id='$id'";
            $data['customerbyid'] = $customerModel->customerbyid($cond);
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/customer/edit_customer', $data);
            $this->load->view('cpanel/footer');
        }
        //cập nhật khách hàng 2
        public function update_customer($id){
            $customerModel = $this->load->model('customermodel');
            $table = 'tbl_customer';
            $cond = "customer_id='$id'";
            
            $name = $_POST['customer_name'];
            $phone = $_POST['customer_phone'];
            $email = $_POST['customer_email'];
            $password = $_POST['customer_password'];
            $address = $_POST['customer_address'];

            $data = array(
                'customer_name' => $name,
                'customer_phone' => $phone,
                'customer_email' => $email,
                'customer_password' => $password,
                'customer_address' => $address
            );

            $result = $customerModel->updatecustomer($table, $data, $cond);
            if($result == 1){
                header("Location:".BASE_URL."customer/list_customer");
            }else{
                header("Location:".BASE_URL."customer/list_customer");
            }
        }
    }
?> 