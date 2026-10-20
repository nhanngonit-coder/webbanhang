<?php
session_start();
require_once __DIR__ . '/db.php';

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'home':
        require __DIR__ . '/controller/index.php';
        break;
    case 'danhmuc':
        require __DIR__ . '/controller/danhmuc.php';
        break;
    case 'sanpham':
        require __DIR__ . '/controller/sanpham.php';
        break;
    case 'xoa_sanpham':
        require __DIR__ . '/controller/xoa.php';
        break;
    default:
        require __DIR__ . '/controller/index.php';
}
