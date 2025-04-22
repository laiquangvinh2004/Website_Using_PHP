<?php
class Session{
        public static function init(){
            session_start(); 
        }
        public static function set($key, $val){
            $_SESSION[$key] = $val;
        }
        public static function get($key){
            if(isset($_SESSION[$key])){
                return $_SESSION[$key];
            }
            else{
                return false;
            }
        }
        public static function checkSession(){
            self::init();
            if(self::get('login') == false){
                self::destroy();
                header("Location:".BASE_URL."/login");
            }
        }
        public static function checkCustomerSession(){
            self::init();
            if(self::get('customer') == false){
                self::destroy();
                header("Location:".BASE_URL."khachhang/dangnhap");
            }
        }
        public static function destroy(){
            session_destroy();
        }
        public static function unset($key){
            unset($_SESSION[$key]);
        }
        public static function destroyAdmin(){
            self::unset('login');
            self::unset('username');
            self::unset('userid');
        }
        public static function destroyCustomer(){
            self::unset('customer');
            self::unset('customer_name');
            self::unset('customer_id');
            self::unset('customer_email');
        }
    }
?>