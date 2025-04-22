<?php

class AdminModel {
    private $db;
    //Hàm kiểm tra đăng nhập
    public function __construct() {
        $this->db = new Database();
    }

    public function checkUsername($username) {
        $sql = "SELECT * FROM admin WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createAdmin($data) {
        $sql = "INSERT INTO admin (username, password, email, created_at) VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("ssss", 
            $data['username'],
            $data['password'],
            $data['email'],
            $data['created_at']
        );
        return $stmt->execute();
    }
} 