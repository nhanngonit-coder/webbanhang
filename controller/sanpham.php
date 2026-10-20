<?php
require_once __DIR__ . '/../model/database.php';
$db = new Database();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$isEdit = ($id && $id > 0);
$error = '';
$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$product = $isEdit ? $db->getProduct($id) : null;
if ($isEdit && !$product) {
    die('Không tìm thấy sản phẩm.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = [
            'Name' => trim($_POST['Name'] ?? ''),
            'Price' => $_POST['Price'] ?? 0,
            'Date_import' => $_POST['Date_import'] ?? date('Y-m-d'),
            'Decribe' => trim($_POST['Decribe'] ?? ''),
            'Mount' => $_POST['Mount'] ?? 0,
            'Sale' => $_POST['Sale'] ?? 0,
            'image' => trim($_POST['image'] ?? ''),
            'id_danhmuc' => $_POST['id_danhmuc'] ?? 0
        ];

        if ($data['Name'] === '') throw new Exception('Tên sản phẩm không được để trống.');
        if (!is_numeric($data['Price']) || $data['Price'] < 0) throw new Exception('Giá không hợp lệ.');
        if (filter_var($data['Mount'], FILTER_VALIDATE_INT) === false || $data['Mount'] < 0) throw new Exception('Số lượng không hợp lệ.');
        if (!is_numeric($data['Sale']) || $data['Sale'] < 0 || $data['Sale'] > 100) throw new Exception('Giảm giá phải từ 0 đến 100%.');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['Date_import'])) throw new Exception('Ngày nhập không hợp lệ.');
        if (filter_var($data['id_danhmuc'], FILTER_VALIDATE_INT) === false || $data['id_danhmuc'] < 1) throw new Exception('Danh mục không hợp lệ.');

        if ($isEdit) {
            $db->updateProduct($id, $data);
            $_SESSION['message'] = 'Cập nhật sản phẩm thành công.';
        } else {
            $db->addProduct($data);
            $_SESSION['message'] = 'Thêm sản phẩm thành công.';
        }

        header('Location: index.php');
        exit;
    } catch (Throwable $e) {
        $error = $e->getMessage();
        $product = array_merge($product ?? [], $_POST);
    }
}

$categories = $db->getCategories();
require __DIR__ . '/../view/danhmuc/sanpham.php';
