<?php
    class customermodel extends DModel{
        function __construct(){
            parent::__construct();
        }
        // public function category($table){
        //     $sql = "SELECT * FROM $table ORDER BY id_category_product DESC";
        //     return $this->db->select($sql);
        // }
        // public function category_home($table){
        //     $sql = "SELECT * FROM $table ORDER BY id_category_product DESC";
        //     return $this->db->select($sql);
        // }

        // public function categorybyid_home($table, $table_product, $id){
        //     $sql = "SELECT * FROM $table, $table_product WHERE $table.id_category_product 
        //     =$table_product.id_category_product AND $table_product.id_category_product ='$id' ORDER BY $table_product.id_product DESC";
        //     return $this->db->select($sql);
        // }

        // public function categorybyid($table, $cond){
        //     $sql = "SELECT * FROM $table WHERE $cond";
        //     return $this->db->select($sql);
        // }

        public function list_customers($offset = 0, $limit = 10){
            $sql = "SELECT * FROM tbl_customer ORDER BY customer_id ASC LIMIT :offset, :limit";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function customerbyid($cond){
            $sql = "SELECT * FROM tbl_customer WHERE $cond";
            return $this->db->select($sql);
        }

        public function insertcustomer($table, $data){
            return $this->db->insert($table, $data);
        }

        public function updatecustomer($table, $data, $cond){
            return $this->db->update($table, $data, $cond);
        }

        public function deletecustomer($table, $cond){
            return $this->db->delete($table, $cond);
        }

        public function login($table_customer, $username, $password){
            $sql = "SELECT * FROM $table_customer WHERE customer_email=? AND customer_password=? ";
            return $this->db->affectedRows($sql, $username, $password);
        }
        public function getLogin($table_customer, $username, $password){
            $sql = "SELECT * FROM $table_customer WHERE customer_email=? AND customer_password=? ";
            return $this->db->selectUser($sql, $username, $password);
        }
        // public function updatecategory($table_category_product, $data, $cond){
        //     return $this->db->update($table_category_product, $data, $cond);
        // }

        // public function deletecategory($table_category_product, $cond){
        //     return $this->db->delete($table_category_product, $cond);
        // }

        public function checkEmailExists($email) {
            $sql = "SELECT COUNT(*) as count FROM tbl_customer WHERE customer_email = ?";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([$email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'] > 0;
        }

        public function getTotalCustomers(){
            $sql = "SELECT COUNT(*) as total FROM tbl_customer";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }
    }
?>