<?php
class DModel{
    protected $db = array(); 
    public function __construct(){
        $connect = 'mysql:dbname=pdo_blogs_ecommerce; host=localhost; charset=utf8';
        $user = 'root';
        $pass = '1234';
        $this->db = new Database($connect, $user, $pass);
    }
}
?>