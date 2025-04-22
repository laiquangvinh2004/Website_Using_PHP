<?php
    class login extends DController{
        //Khởi tạo
        public function __construct(){
            $message = array();
            $data = array();
            parent::__construct();
        }
        public function index(){
            $this->login();
        }
        //Đăng nhập admin
        public function login(){
            Session::init();
            Session::get("login") == true;
            if(Session::get("login") == true){
                header("Location:".BASE_URL."login/dashboard");
                //Session::get("login") == true;
            }
            $this->load->view('cpanel/login');
        }
        //Khởi tạo dashboard admin
        public function dashboard(){
            Session::checkSession();
            $this->load->view('cpanel/header');
            $this->load->view('cpanel/menu');
            $this->load->view('cpanel/dashboard');
            $this->load->view('cpanel/footer');
        }
        //Kiểm tra hàm đăng nhập admin
        public function authentication_login(){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $table_admin = 'tbl_admin';
            $loginmodel = $this->load->model('loginmodel');

            $count = $loginmodel->login($table_admin, $username, $password);

            if($count == 0){
                $message['msg'] = "Username or Password wrong";
                header("Location:".BASE_URL."login");
            }
            else{
                $result = $loginmodel->getLogin($table_admin, $username, $password);
                Session::init();
                Session::set('login', true);
                Session::set('username', $result[0]['username']);
                Session::set('userid', $result[0]['admin_id']);
                header("Location:".BASE_URL."login/dashboard");
            }
        }
        //Đăng xuất Admin
        public function logout(){
            Session::init();
            Session::destroyAdmin();
            $message['msg'] = "Đăng xuất thành công";
            header('Location:'.BASE_URL."login?msg=".urlencode(serialize($message)));
        }
    }
?>