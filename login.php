<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Проверка пользователя
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Отладочная информация
                echo "User ID при входе: " . $user['user_id'] . "<br>";

                $_SESSION['username'] = $user['username']; // Сохраняем имя пользователя в сессии
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['avatar'] = $user['avatar'];

                echo "User ID сохранён в сессии: " . $_SESSION['user_id'] . "<br>";

                header("Location: productsru.php"); // Перенаправление на главную страницу
                exit();
            } else {
                echo "Неверный пароль.";
            }
        } else {
            echo "Пользователь с таким email не найден.";
        }
        $stmt->close();
    } else {
        echo "Все поля обязательны для заполнения.";
    }
    $conn->close();
}
?>
