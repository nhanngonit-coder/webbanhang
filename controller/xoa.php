<?php
require_once __DIR__ . '/../model/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../index.php');
    exit;
}

$id = filter_var($_POST['id_sp'] ?? 0, FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    $_SESSION['message'] = 'Mã sản phẩm không hợp lệ.';
    header('Location: ../index.php');
    exit;
}

try {
    $db = new Database();
    $db->deleteProduct($id);
    $_SESSION['message'] = 'Xóa sản phẩm thành công.';
} catch (Throwable $e) {
    $_SESSION['message'] = 'Không thể xóa sản phẩm: ' . $e->getMessage();
}

header('Location: ../index.php');
exit;
