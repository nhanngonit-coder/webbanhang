<?php
// File tương thích với cấu trúc MVC cũ của bài.
require_once __DIR__ . '/../model/database.php';

class SanPhamController {
    private Database $model;

    public function __construct() {
        $this->model = new Database();
    }

    public function danhsach(): array {
        return $this->model->getProducts();
    }

    public function layMotSanPham(int $id): ?array {
        return $this->model->getProduct($id);
    }
}
