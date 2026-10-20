<?php
require_once __DIR__ . '/../model/database.php';

$db = new Database();
$products = $db->getProducts();
$categories = $db->getCategories();

$selectedCategory = filter_input(INPUT_GET, 'category', FILTER_VALIDATE_INT);
if ($selectedCategory) {
    $products = $db->getProducts($selectedCategory);
}

require __DIR__ . '/../view/home.php';
