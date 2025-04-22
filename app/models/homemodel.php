<?php
    class homemodel extends DModel{
        function __construct(){
            parent::__construct();
        }
        /*public function getProduct($tableProduct, $condition){
            $sql = "SELECT * $tableProduct WHERE product_id = '$condition'";
            return $this->query->select($sql);
        }*/
    }
?>