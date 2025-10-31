<?php 
session_start(); 
require_once 'db_connect.php'; // Подключение к базе данных 

// Инициализация переменной $_SESSION['cart'] как массива, если она не существует
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Получение списка продуктов 
$result = $conn->query("SELECT * FROM products"); 

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
  $product_id = (int) $_POST['product_id'];

  if (in_array($product_id, $_SESSION['cart'])) {
      $_SESSION['cart'] = array_diff($_SESSION['cart'], [$product_id]);
  } else {
      $_SESSION['cart'][] = $product_id;
  }
}

?>

<html>
<head>
<title>IIF</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
      <a class="active" href="productsru.php" id="products">Товары</a>
      <?php
if (isset($_SESSION['username'])) {
    $avatar_path = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'images/user.jpg'; // Проверяем, установлен ли аватар
    echo '<a href="kor.php">Корзина (' . count($_SESSION['cart']) . ')</a>';
}
?>
      <a class="a" href="mainru.html" id="main">Главный офис</a>
      <a class="a" href="ownru.html" id="own">Про основателя Корпорации</a>
      <a class="a" href="academyru.html" style="margin-right: 20px;">IIF ACADEMY</a>
  </nav>
</header>
<section class="red-section">

  <div id="registerModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="regt2">Регистрация</p>
        <form action="register.php" method="POST">
            <!-- Поля формы регистрации -->
            <input type="text" name="username" placeholder="Ваше имя" required>
            <input type="email"  name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="submit" value="Зарегистрироваться">
        </form>
        <p class="regt">Есть аккаунт? <a href="javascript:void(0)" onclick="switchToLogin()">Войти</a></p>
    </div>
</div>

<!-- Модальное окно входа -->
<div id="loginModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p class="regt2">Вход</p>
        <form action="login.php" method="POST">
            <!-- Поля формы входа -->
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Пароль" required>
            <input type="submit" value="Войти">
        </form>
        <p class="regt">Нет аккаунта? <a href="javascript:void(0)" onclick="switchToRegister()">Зарегистрироваться</a></p>
    </div>
</div>
  <div class="moving-text30">
    <b id="we">Товары</b>
  </div>
  <div class="moving-text21">
  <?php
if (isset($_SESSION['username'])) {
    $avatar_path = isset($_SESSION['avatar']) ? $_SESSION['avatar'] : 'images/user.jpg'; // Проверяем, установлен ли аватар
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
<div class="fed">
  <div class="imp">
  <p class="red2" id="we2" align="center">Некоторые из продуктов, которые могут привлечь ваше внимание:</p>
  </div>
  <div class="photo-container">
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="photo-item">
        <img src="images/<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
        <p class="text4"><?php echo htmlspecialchars($row['name']); ?></p>
        <p class="text4">$<?php echo htmlspecialchars($row['price']); ?></p>
        <form method="post" action="productsru.php">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <button class="emer" type="submit">
                <?php
                // Проверяем, инициализирован ли массив корзины, и если текущий продукт в корзине
                if (isset($_SESSION['cart']) && in_array($row['id'], $_SESSION['cart'])) {
                    echo 'Убрать из корзины';
                } else {
                    echo 'Добавить в корзину';
                }
                ?>
            </button>
        </form>
    </div>
  <?php endwhile; ?>
</div>
</div>


<div class="fed">
  <div class="imp">
  <p class="red2" id="we2" align="center">Так же вы можете приобрести медецинскую страховку IIF Emergency:</p>
  </div>
  <div class="photo-container">
    <div class="photo-item">
      <img src="images/basic.png" alt="Фото 1">
      <p class="text3">Тариф "Basic"</p>
      <p class="text4">Базовая медицинская помощь</p>
      <p class="text4">Доступное решение для несложных случаев. Команда профессионалов оперативно прибудет на месте на оборудованном автомобиле.</p>
      <p class="text3">$29.9/месяц</p>
      <button class="emer"><a href="Emergency1.php" class="etext">Купить</a></button>
      <button class="emer2"><a href="Emore.php" class="etext">Подробнее</a></button>
    </div>
    <div class="photo-item">
    <img src="images/vip.png" alt="Фото 1">
      <p class="text3">Тариф "Emergency"</p>
      <p class="text4">Премиум-обслуживание</p>
      <p class="text4">Вертолетная помощь с лучшим оборудованием. Максимальная скорость реагирования и комфорт пациента.</p>
      <p class="text3">$99.9/месяц</p>
      <button class="emer"><a href="Emergency2.php" class="etext">Купить</a></button>
      <button class="emer2"><a href="Emore2.php" class="etext">Подробнее</a></button>
    </div>
    <div class="photo-item">
    <img src="images/extra.png" alt="Фото 1">
    <p class="text3">Тариф "Extra"</p>
      <p class="text4">Расширенная помощь</p>
      <p class="text4">Быстрая помощь с современным оборудованием и хирургическим столом. Идеальный баланс цены и качества.</p>
      <p class="text3">$39.9/месяц</p>
      <button class="emer"><a href="Emergency3.php" class="etext">Купить</a></button>
      <button class="emer2"><a href="Emore3.php" class="etext">Подробнее</a></button>
    </div>
  </div>
  <div class="content">
  <div class="text-container">
  <p id="corp" class="text3"></p>
  <p id="corp2" class="text4"></p>
  <br>
  <a href="index.html">Назад на главную страницу</a>
    </div>
  </div>
  <footer>
    <p class="last">Ⓒ IIF CORP</p>
    </footer>
  </section>
  <script src="script.js" defer></script>
</body>
</html>