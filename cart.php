<?php
session_start();
require_once 'db_connect.php'; // Подключение к базе данных

$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Проверка, есть ли продукт уже в корзине
if (isset($_SESSION['cart'][$product_id])) {
    // Обновление количества
    $_SESSION['cart'][$product_id] += $quantity;
} else {
    // Добавление нового продукта в корзину
    $_SESSION['cart'][$product_id] = $quantity;
}

header('Location: productsru.php');
?>
