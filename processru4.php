<?php
// Подключаемся к базе данных
include('db_connect.php'); // Если подключение в отдельном файле

$name = $_POST['name'];
$email = $_POST['email'];
$phone_number = $_POST['phone_number'];
$contry = $_POST['contry'];
$city = $_POST['city'];

// Вставка данных в таблицу
$sql = "INSERT INTO orders (name, email, phone_number, contry, city, products) VALUES ('$name', '$email', '$phone_number', '$contry', '$city', 'Кибер оптика V1.7')";

if ($conn->query($sql) === TRUE) {
    echo "Новые данные успешно добавлены!";
} else {
    echo "Ошибка: " . $sql . "<br>" . $conn->error;
}

// Закрытие подключения
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
    <p class="red09">Ваша заявка отправлена, с вами свяжется наш менеджер для уточнения деталей.</p>
    <form action="indexru.html" method="POST">
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

