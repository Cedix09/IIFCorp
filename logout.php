<?php
session_start();
session_unset(); // Удалить все переменные сессии
session_destroy(); // Уничтожить сессию
header("Location: productsru.php"); // Перенаправить на главную страницу
exit();
?>
