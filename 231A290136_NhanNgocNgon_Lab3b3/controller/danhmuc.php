<?php
require_once __DIR__ . '/../model/database.php';
$db = new Database();

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $type = $_POST['type'] ?? '';
        $id = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);
        $name = trim($_POST['ten_danh_muc'] ?? '');
        $desc = trim($_POST['mo_ta'] ?? '');

        if ($type !== 'delete' && $name === '') {
            throw new Exception('Tên danh mục không được để trống.');
        }

        if ($type === 'add') {
            $db->addCategory($name, $desc);
            $_SESSION['message'] = 'Thêm danh mục thành công.';
        } elseif ($type === 'edit' && $id > 0) {
            $db->updateCategory($id, $name, $desc);
            $_SESSION['message'] = 'Cập nhật danh mục thành công.';
        } elseif ($type === 'delete' && $id > 0) {
            $db->deleteCategory($id);
            $_SESSION['message'] = 'Xóa danh mục thành công.';
        }
        header('Location: index.php?action=danhmuc');
        exit;
    } catch (Throwable $e) {
        $error = $e->getMessage();
    }
}

$edit = null;
$editId = filter_input(INPUT_GET, 'edit', FILTER_VALIDATE_INT);
if ($editId > 0) {
    $edit = $db->getCategory($editId);
}

$categories = $db->getCategories();
require __DIR__ . '/../view/danhmuc/index.php';
