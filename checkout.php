<?php
// checkout.php — Обработка покупки товаров

require_once 'db_connect.php'; // Подключение к базе данных
session_start(); // Старт сессии

// Убедитесь, что пользователь авторизован
if (!isset($_SESSION['user_id'])) {
    die('Пожалуйста, войдите в аккаунт, чтобы оформить заказ.');
}

// Проверяем, есть ли товары в корзине
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    $user_id = $_SESSION['user_id']; // Получаем ID пользователя
    $cart_ids = $_SESSION['cart'];

    // Начинаем транзакцию
    $conn->begin_transaction();

    try {
        // Проходим по всем товарам в корзине
        foreach ($cart_ids as $product_id) {
            // Добавляем запись в таблицу orders
            $stmt = $conn->prepare("INSERT INTO orderss (user_id, product_id, quantity) VALUES (?, ?, ?)");
            $quantity = 1; // Количество товара, можно изменить в зависимости от логики
            $stmt->bind_param("iii", $user_id, $product_id, $quantity);

            if (!$stmt->execute()) {
                throw new Exception("Ошибка при добавлении заказа: " . $stmt->error);
            }
        }

        // Завершаем транзакцию
        $conn->commit();

        // Очищаем корзину
        unset($_SESSION['cart']);

        echo "Ваш заказ успешно оформлен!";
    } catch (Exception $e) {
        // Откатываем транзакцию в случае ошибки
        $conn->rollback();
        echo "Произошла ошибка при оформлении заказа: " . $e->getMessage();
    }
} else {
    echo "Ваша корзина пуста!";
}

$conn->close();
?>

<html>
<head>
<title>IIF</title>
<link rel="stylesheet" type="text/css" href="style.css"/>
<meta charset="utf-8">
</head>
<body> 
<header class="t">
<div class="left-content">
    <img src="images/logo1.png" width="80px" height="75px" class="logo">
    <p class="iif"><b>IIF CORP</b></p>
    </div>
  <nav class="nav-links">
    
      <a class="a" href="index.html" id="index">Главная страница</a>
      <a class="a" href="productsru.php" id="products">Товары</a>
      <a class="a" href="mainru.html" id="main">Главный офис</a>
      <a class="a" href="ownru.html" id="own">Про основателя Корпорации</a>
      <a class="a" href="academyru.html" style="margin-right: 20px;">IIF ACADEMY</a>
  </nav>
</header>
<section class="red-section">
</section>
<section class="black-section">
<div class="fed2">
  <div class="form-container">
    <p class="red09">Ваша заявка отправлена, ответ прийдёт на Ваш E-mail</p>
    <form action="" method="POST">
      <button><a href="index.html">Назад на главную страницу</a></button>
    </form>
  </div>
  </div>
  <footer>
    <p class="last">Ⓒ IIF CORP</p>
    </footer>
  </section>
  <script src="script.js" defer></script>
</body>
</html>

