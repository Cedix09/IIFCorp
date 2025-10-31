<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Проверка уникальности email
        $checkQuery = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($checkQuery);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Пользователь с таким email уже существует.";
        } else {
            // Вставка данных в базу
            $sql = "INSERT INTO users (username, email, password, avatar) VALUES (?, ?, ?, 'uploads/avatars/user.jpg')";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sss', $username, $email, $password);

            if ($stmt->execute() === TRUE) {
                // Получение ID нового пользователя
                $user_id = $stmt->insert_id;

                // Сохранение данных в сессии
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['avatar'] = 'uploads/avatars/user.jpg';

                echo "User ID зарегистрирован в сессии: " . $_SESSION['user_id'] . "<br>";

                header("Location: productsru.php"); // Перенаправление на главную страницу
                exit;
            } else {
                echo "Ошибка: " . $stmt->error;
            }
        }
        $stmt->close();
    } else {
        echo "Все поля обязательны для заполнения.";
    }
    $conn->close();
}
?>
