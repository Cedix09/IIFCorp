<?php
session_start();
require 'db_connect.php'; // Подключение к базе данных

// Проверяем, авторизован ли пользователь
if (!isset($_SESSION['username'])) {
    die("Вы должны быть авторизованы для редактирования профиля.");
}

// Проверка наличия данных в POST
if (isset($_POST['username']) && isset($_FILES['avatar'])) {
    $username = $_POST['username'];
    $avatar = $_FILES['avatar'];
} else {
    die("Все поля обязательны для заполнения.");
}

$user_id = $_SESSION['user_id']; // Предполагается, что ID пользователя хранится в сессии

// Проверяем, что имя пользователя не пустое
if (empty($username)) {
    die("Имя пользователя не может быть пустым.");
}

// Обработка загрузки аватара
$avatar_path = $_SESSION['avatar']; // Сохраняем текущий аватар, если новый не загружен

if ($avatar['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/avatars/';
    // Создаем уникальное имя для файла, чтобы избежать перезаписи
    $avatar_name = uniqid() . '-' . basename($avatar['name']);
    $avatar_path = $upload_dir . $avatar_name;

    // Проверяем, является ли файл изображением
    $image_info = getimagesize($avatar['tmp_name']);
    if ($image_info === false) {
        die("Загруженный файл не является изображением.");
    }

    // Перемещаем файл в папку
    if (!move_uploaded_file($avatar['tmp_name'], $avatar_path)) {
        die("Ошибка загрузки аватара.");
    }
}

// Отладочная информация
echo "Session User ID: " . $_SESSION['user_id'] . "<br>";
$user_id = $_SESSION['user_id'];
echo "User ID: " . $user_id . "<br>"; // Добавим эту строку перед использованием $user_id

if (empty($user_id)) {
    die("User ID не установлен.");
}

// Обновляем данные пользователя в базе данных
$stmt = $conn->prepare("UPDATE users SET username = ?, avatar = ? WHERE user_id = ?");
if ($stmt === false) {
    die("Ошибка подготовки запроса: " . $conn->error);
}
$stmt->bind_param('ssi', $username, $avatar_path, $user_id);

if ($stmt->execute()) {
    // Обновляем данные в сессии
    $_SESSION['username'] = $username;
    $_SESSION['avatar'] = $avatar_path;

    echo "Профиль успешно обновлён."; // Добавлено сообщение об успешном обновлении

    // Перенаправляем на страницу профиля
    header("Location: productsru.php"); // Временно закомментировано для отладки
    exit();
} else {
    echo "Ошибка обновления профиля: " . $stmt->error; // Изменён вывод ошибки
}

$stmt->close();
$conn->close();
?>
