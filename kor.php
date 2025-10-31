<?php
// cart.php — Страница корзины

require_once 'db_connect.php';  // Подключаем базу данных
session_start();  // Начинаем сессию

// Инициализация общей стоимости
$total_price = 0;
$pic = [];
if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
    // Преобразуем элементы массива в целые числа для безопасности
    $cart_ids = implode(',', array_map('intval', $_SESSION['cart']));
    if (!empty($cart_ids)) {
        $sql = "SELECT id, name, price, image FROM products WHERE id IN ($cart_ids)"; // Исправлено поле id
        $result = $conn->query($sql);

        if ($result === false) {
            // Обработка ошибки запроса
            echo "Ошибка выполнения запроса: " . $conn->error;
        } else {
            while ($row = $result->fetch_assoc()) {
                $pic[] = $row;
                // Добавляем цену товара к общей стоимости
                $total_price += $row['price'];
            }
        }
    }
} else {
    // Вместо echo на странице отображайте сообщение в HTML (для консистентности)
    $cart_is_empty = true; // Флаг для отображения в HTML
}

$conn->close();
?>



<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина - IIF</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header class="t">
    <div class="left-content">
        <img src="images/logo1.png" width="80px" height="75px" class="logo">
        <p class="iif"><b>IIF CORP</b></p>
    </div>
    <nav class="nav-links">
        <a class="a" href="index.html">Главная страница</a>
        <a class="a" href="productsru.php">Товары</a>
        <a class="a" href="mainru.html">Главный офис</a>
        <a class="a" href="ownru.html">Про основателя</a>
        <a class="a" href="academyru.html" style="margin-right: 20px;">IIF ACADEMY</a>
    </nav>
</header>
<section class="red-section">
    <div class="moving-text30">
        <p style="margin-bottom: 0;">Корзина</p>
    </div>
    <div class="moving-text21">
        <?php
        if (isset($_SESSION['username'])) {
            $avatar_path = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'images/user.jpg';
            echo '<span class="user2">' . '<img src="' . htmlspecialchars($avatar_path) . '" width="50px" height="50px" class="user">' . '<a href="#" id="editProfileLink" class="edit">' . htmlspecialchars($_SESSION['username']) . '</a>' . '!</span>';
            echo '<button id="editProfileBtn" class="set"><img src="images/set.png" width="30px" height="30px"></button>';
            echo '<a href="logout.php" class="regg2">Выйти</a>';
        } else {
            echo '<button id="openModalBtn" class="regg">Регистрация</button>';
        }
        ?>
    </div>

    <div id="editProfileModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeEditProfileModal">&times;</span>
            <p class="regt2">Редактировать профиль</p>
            <form action="profile_update.php" method="POST" enctype="multipart/form-data">
                <label for="username"><p class="regt3">Имя пользователя:</p></label>
                <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
                <label for="avatar"><p class="regt3">Загрузить аватар:</p></label>
                <input type="file" name="avatar" id="avatar" accept="image/*">
                <button type="submit">Сохранить изменения</button>
            </form>
        </div>
    </div>
</section>

<section class="black-section">
    <div class="cart-container">
    <?php if (isset($cart_is_empty) && $cart_is_empty): ?>
        <p class="text3">Ваша корзина пуста.</p>
    <?php else: ?>
        <p class="text3">Товары в корзине</p>
        <div class="cart-items-container">
            <?php foreach ($pic as $product): ?>
                <div class="cart-item">
                    <img src="images/<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="info">
                        <p class="text3"><?php echo htmlspecialchars($product['name']); ?></p>
                        <p class="text3">Цена: $<?php echo htmlspecialchars($product['price']); ?></p>
                    </div>
                    <a href="remove_from_cart.php?products_id=<?php echo $product['id']; ?>" class="remove-btn">Удалить</a>
                </div>
            <?php endforeach; ?>
        </div>
        <p class="text3">Общая стоимость: $<?php echo round($total_price, 2); ?></p>
        <button class="emer"><a href="checkout.php">Купить</a></button>
    <?php endif; ?>
    </div>
</section>

<footer>
    <p class="last">Ⓒ IIF CORP</p>
</footer>
<script src="script.js" defer></script>
</body>
</html>
