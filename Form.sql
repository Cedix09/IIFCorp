-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 09 2025 г., 21:11
-- Версия сервера: 10.5.17-MariaDB
-- Версия PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `Form`
--

-- --------------------------------------------------------

--
-- Структура таблицы `emergency`
--

CREATE TABLE `emergency` (
  `id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contry` varchar(12) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contry` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Products` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `name`, `email`, `phone_number`, `contry`, `city`, `Products`) VALUES
(1, 'Сурков Михаил', 'mihailsur09@gmail.com', '+77770016666', 'KZ', 'Saran', ''),
(2, 'Андрей Буланков', 'ab846978@gmail.com', '87755341320', 'UA', 'Kyiv', 'Клинки богомола V5.4'),
(3, 'Андрей Буланков', 'ab846978@gmail.com', '87755341320', 'UA', 'Kyiv', 'Кибер руки V2.0'),
(4, 'Андрей Буланков', 'ab846978@gmail.com', '87755341320', 'UA', 'Kyiv', 'Кибер оптика V1.7'),
(22, 'none_0', '2143@cc', '222222225321451252', 'KZ', 'Lviv', 'Клинки богомола V5.4');

-- --------------------------------------------------------

--
-- Структура таблицы `orderss`
--

CREATE TABLE `orderss` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `order_date` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orderss`
--

INSERT INTO `orderss` (`order_id`, `user_id`, `product_id`, `quantity`, `order_date`) VALUES
(1, 1, 1, 1, '2025-01-22 10:19:29'),
(2, 1, 2, 1, '2025-01-22 10:19:29'),
(3, 1, 2, 1, '2025-01-22 10:21:55'),
(4, 1, 1, 1, '2025-01-22 10:21:55'),
(14, 1, 2, 1, '2025-12-02 17:40:15');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Клинки богомола V5.4', '2500.00', 'clinok.png'),
(2, 'Кибер руки V2.0', '5000.00', 'hands.png'),
(3, 'Кибер оптика V1.7', '1700.00', 'glasses.png');

-- --------------------------------------------------------

--
-- Структура таблицы `Student`
--

CREATE TABLE `Student` (
  `id` int(11) NOT NULL,
  `name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contry` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `postal_code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `Student`
--

INSERT INTO `Student` (`id`, `name`, `email`, `phone_number`, `contry`, `city`, `postal_code`, `program`) VALUES
(3, 'Седых Юрий', 'yura09e@gmail.com', '87771095576', 'UA', 'Шахан', '101606', 'IT and AI'),
(4, 'Шишканов Николай', 'shisha@gmail.com', '+77771005533', 'KZ', 'Караганда', '100029', 'Juridical'),
(5, 'Азазот Азазотавичь', 'azazot@mail.ru', '+77776665533', 'KZ', 'Пустота', '002200', 'Biotech'),
(6, 'none_0', '2143@cc', 'Alexei', 'UA', 'kharkov', 'kharkov', 'IT and AI'),
(7, 'none_0', '2143@cc', 'Alexei', 'UA', 'kharkov', 'kharkov', 'IT and AI'),
(8, 'none_0', 'yura@gmail.com', '325', 'KZ', 'Харьков', '214', 'Juridical'),
(9, 'none_0', 'yura@gmail.com', '325', 'KZ', 'Харьков', '214', 'Juridical'),
(10, 'none_0', 'yura@gmail.com', '325', 'KZ', 'Харьков', '214', 'Juridical'),
(11, 'none_0', '2143@cc', 'Alexei', 'KZ', 'kharkov', 'kharkov', 'Nano tech'),
(12, 'none_0', '2143@cc', '211111111', 'UA', 'Киев', '2436', 'Mechanic'),
(13, 'Сурков Юрий Александрович', 'yura09e@gmail.com', '87771095576', 'UA', 'Шахан', '101606', 'IT and AI');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `avatar`) VALUES
(1, 'Юрий', '$2y$10$gO3BAEeFdNpvM16sDPW4BeVooJgi2GPZquMldQAc0metNovyAreo6', 'yura@gmail.com', 'uploads/avatars/678f7a4a7c8b0-677d8c2d7bfdb-photo.png'),
(2, 'Бебр', '$2y$10$fY0raibipX9rVG1kTNGVSO2J4tWAjk7JOGe8GUxbFmvU1X/axzH36', 'bebr@gmail.com', ''),
(3, 'Лох', '$2y$10$tZ1xyg6g66Fmf91e7dZQzuoXUmNOj1LCU9G6FCZbFc0W8c7H2EgMu', 'lox@gmail.com', ''),
(4, '2', '$2y$10$H9Rd/CHg7L5QeXdL1mi/Aex.T0ngTHWJXXLRRlcGsOt.LN6JRFDH.', '2@gmail.com', 'uploads/avatars/677da402119f6-photo.png'),
(5, '5', '$2y$10$KLQll.sDaVaxihGY1aoBXeAcIgHXriJdjBBHM7v5ock3mdf7f4miC', '5@gmail.com', 'user.jpg'),
(6, '6', '$2y$10$wam2lQeXEUCxI9nDfJltCeql7Y8v8N9SumK8UBKDDqdDOYCC.h3gC', '6@gmail.com', 'user.jpg'),
(7, '7', '$2y$10$jlnbL6DCV/O8jRqcD4WcdO4ErK.eLNVqbAgNSVasRTQYdVn4xyQJy', '7@gmail.com', 'user.jpg'),
(8, '8', '$2y$10$Rc882jI15XKiNqszE42Tre0K4dEdRC0l0Q0bcNniv7SXIy4aKcuM.', '8@gmail.com', 'uploads/user.jpg'),
(9, '9', '$2y$10$CYxzv6n7bUXrDC5o9/Xnh.er1x4WFgK.Zlk7DvrTMg81q0pjaZIJO', '9@gmail.com', 'uploads/avatars/677da5ab5d763-photo.png'),
(10, '10', '$2y$10$.DPxjnBY84F.2wkAAgxcbe83wEOo8oF/tA8fzI2Cpo6lb4obZ9gMS', '10@gmail.com', 'uploads/avatars/user.jpg'),
(11, 'Андрей', '$2y$10$FybnALh707OfZdyhPap.suijmABMVkYuwdkBi/ZcpoW1GPzwKVkN2', 'andre@gmail.com', 'uploads/avatars/user.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `emergency`
--
ALTER TABLE `emergency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orderss`
--
ALTER TABLE `orderss`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `emergency`
--
ALTER TABLE `emergency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT для таблицы `orderss`
--
ALTER TABLE `orderss`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `Student`
--
ALTER TABLE `Student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `orderss`
--
ALTER TABLE `orderss`
  ADD CONSTRAINT `orderss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `orderss_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
