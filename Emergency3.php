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
    <h2 class="col">Оформление страховки</h2>
    <form action="emer1.php" method="POST">
      <label for="name">Ваше ФИО:</label>
      <input type="text" id="name" name="name" required>

      <label for="email">Ваш Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="phone">Номер телефона:</label>
      <input type="tel" id="phone_number" name="phone_number" required>

      <label for="contry">Страна:</label>
      <select id="contry" name="contry" required>
        <option value="UA">Украина</option>
        <option value="RU">Россия</option>
        <option value="KZ">Казахстан</option>
      </select>

      <input type="submit" value="Отправить заявку">
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

