<?php
class csdl {
    protected mysqli $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "lab1");
        if ($this->conn->connect_error) {
            die("Lỗi kết nối cơ sở dữ liệu: " . $this->conn->connect_error);
        }
        $this->conn->set_charset("utf8mb4");
    }
}
