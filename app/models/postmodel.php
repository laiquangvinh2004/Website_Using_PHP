<?php
    class postmodel extends DModel{
        function __construct(){
            parent::__construct();
        }
        public function category_post($table){
            $sql = "SELECT * FROM $table ORDER BY id_category_post DESC";
            return $this->db->select($sql);
        }

        public function postbyid($table, $cond){
            $sql = "SELECT * FROM $table WHERE $cond";
            return $this->db->select($sql);
        }

        public function insertpost($table, $data){
            return $this->db->insert($table, $data);
        }

        public function post($table_post, $table_category, $offset = 0, $limit = 10, $category_id = null){
            $sql = "SELECT * FROM $table_post, $table_category WHERE $table_post.id_category_post = $table_category.id_category_post";
            
            if($category_id !== null) {
                $sql .= " AND $table_post.id_category_post = :category_id";
            }
            
            $sql .= " ORDER BY $table_post.id_post DESC LIMIT :offset, :limit";
            
            $stmt = $this->db->prepare($sql);
            
            if($category_id !== null) {
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            }
            
            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function list_post_home($table_post, $offset = 0, $limit = 8){
            $sql = "SELECT * FROM $table_post ORDER BY $table_post.id_post DESC LIMIT $offset, $limit";
            return $this->db->select($sql);
        }

        public function count_posts($table_post, $category_id = null){
            $sql = "SELECT COUNT(*) as total FROM $table_post";
            
            if($category_id !== null) {
                $sql .= " WHERE id_category_post = :category_id";
            }
            
            $stmt = $this->db->prepare($sql);
            
            if($category_id !== null) {
                $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
            }
            
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }

        public function updatepost($table, $data, $cond){
            return $this->db->update($table, $data, $cond);
        }

        public function deletepost($table_post, $cond){
            return $this->db->delete($table_post, $cond);
        }

        public function getTotalPosts(){
            $sql = "SELECT COUNT(*) as total FROM tbl_post";
            $result = $this->db->select($sql);
            return isset($result[0]['total']) ? $result[0]['total'] : 0;
        }

        public function getPostsByCategory(){
            $sql = "SELECT c.title_category_post as category_name, COUNT(p.id_post) as post_count 
                   FROM tbl_category_post c 
                   LEFT JOIN tbl_post p ON c.id_category_post = p.id_category_post 
                   GROUP BY c.id_category_post, c.title_category_post";
            $result = $this->db->select($sql);
            return $result;
        }
    }
?>