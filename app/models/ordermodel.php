<?php
    class ordermodel extends DModel{
        public function __construct(){
            parent::__construct();
        }
        public function insert_order($table_order, $data_order){
            return $this->db->insert($table_order, $data_order);
        }
        public function insert_order_detail($table_order_detail, $data){
            return $this->db->insert($table_order_detail, $data);
        }
        public function list_order($table_order){
            $sql = "SELECT * FROM $table_order ORDER BY order_id DESC";
            return $this->db->select($sql);
        }
        public function list_order_detail($table_product, $table_order, $cond){
            $sql = "SELECT * FROM $table_order, $table_product WHERE $cond";
            return $this->db->select($sql);
        }
        public function list_info($table_order, $cond_info){
            $sql = "SELECT * FROM $table_order WHERE $cond_info LIMIT 1";
            return $this->db->select($sql);
        }
        public function order_confirm($table_order, $data, $cond){
            return $this->db->update($table_order, $data, $cond);
        }
        
        public function getTotalOrders(){
            $sql = "SELECT COUNT(*) as total FROM tbl_order";
            $result = $this->db->select($sql);
            return isset($result[0]['total']) ? $result[0]['total'] : 0;
        }

        public function getTotalRevenue(){
            $sql = "SELECT SUM(od.product_quantity * p.price_product) as total_revenue 
                   FROM tbl_order_detail od 
                   JOIN tbl_product p ON od.product_id = p.id_product";
            $result = $this->db->select($sql);
            return isset($result[0]['total_revenue']) ? number_format($result[0]['total_revenue'], 0, '', ',') : '0';
        }

        public function getProcessedOrdersCount(){
            $sql = "SELECT COUNT(*) as processed_count FROM tbl_order WHERE order_status = 1";
            $result = $this->db->select($sql);
            return isset($result[0]['processed_count']) ? $result[0]['processed_count'] : 0;
        }

        public function getProcessedOrders(){
            $sql = "SELECT * FROM tbl_order WHERE order_status = 1 ORDER BY order_date DESC LIMIT 5";
            return $this->db->select($sql);
        }

        public function delete_order($table_order, $cond){
            return $this->db->delete($table_order, $cond);
        }

        public function list_order_by_customer($table_order, $cond){
            $sql = "SELECT * FROM $table_order WHERE $cond ORDER BY order_date DESC";
            return $this->db->select($sql);
        }

        public function get_orders_by_email($email){
            $sql = "SELECT o.*, od.*, p.price_product as product_price 
                   FROM tbl_order o 
                   INNER JOIN tbl_order_detail od ON o.order_code = od.order_code 
                   INNER JOIN tbl_product p ON od.product_id = p.id_product
                   WHERE od.email = :email 
                   ORDER BY o.order_date DESC";
            return $this->db->select($sql, array(':email' => $email));
        }
    }
?>