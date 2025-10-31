<?php
		$host = 'localhost'; 
		$user = 'root'; 
		$password = ''; 
		$db_name = 'Form';
		
		$conn = new mysqli($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}
echo "Подключение успешно!";
?>