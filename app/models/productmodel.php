<?php
    class productmodel extends DModel {
        public function __construct(){
            parent::__construct();
        }

        public function getProductsByCategory(){
            $sql = "SELECT c.title_category_product as category_name, COUNT(p.id_product) as product_count 
                   FROM tbl_category_product c 
                   LEFT JOIN tbl_product p ON c.id_category_product = p.id_category_product 
                   GROUP BY c.id_category_product, c.title_category_product";
            $result = $this->db->select($sql);
            return $result;
        }

        public function list_product($table_product, $table_category, $offset = 0, $limit = 10, $category_id = null){
            $sql = "SELECT * FROM $table_product, $table_category WHERE $table_product.id_category_product = $table_category.id_category_product";
            
            if($category_id !== null) {
                $sql .= " AND $table_product.id_category_product = :category_id";
            }
            
            $sql .= " ORDER BY $table_product.id_product DESC LIMIT :offset, :limit";
            
            $stmt = $this->db->prepare($sql);
            
            if($category_id !== null) {
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            }
            
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function getTotalProducts($category_id = null){
            $sql = "SELECT COUNT(*) as total FROM tbl_product";
            
            if($category_id !== null) {
                $sql .= " WHERE id_category_product = :category_id";
            }
            
            $stmt = $this->db->prepare($sql);
            
            if($category_id !== null) {
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }
    }
?> 