-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Апр 10 2024 г., 22:43
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `onlytest`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auto`
--

CREATE TABLE `auto` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `auto`
--

INSERT INTO `auto` (`id`, `name`, `category`, `driver_id`, `created_at`, `updated_at`) VALUES
(1, 'sadasdas', 1, 1, '2024-04-08 17:07:25', '2024-04-08 17:07:25'),
(2, 'sadasdas', 5, 2, '2024-04-08 17:09:19', '2024-04-08 17:09:19'),
(3, 'sadasdas', 3, NULL, '2024-04-08 17:59:35', '2024-04-08 17:59:35'),
(4, 'Олег', 5, 3, '2024-04-08 18:00:40', '2024-04-08 18:00:40'),
(5, 'Олег', 5, NULL, '2024-04-08 18:00:45', '2024-04-08 18:00:45');

-- --------------------------------------------------------

--
-- Структура таблицы `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `driver`
--

INSERT INTO `driver` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'sadasdasasd', '2024-04-08 17:31:07', '2024-04-08 17:31:07'),
(2, 'sadasdas', '2024-04-08 17:31:13', '2024-04-08 17:31:13'),
(3, 'asddssa', '2024-04-08 17:33:32', '2024-04-08 17:33:32');

-- --------------------------------------------------------

--
-- Структура таблицы `rent_car`
--

CREATE TABLE `rent_car` (
  `id` int(11) NOT NULL,
  `auto_id` int(11) NOT NULL,
  `worker_id` int(11) NOT NULL,
  `rent_from` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `rent_before` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rent_car`
--

INSERT INTO `rent_car` (`id`, `auto_id`, `worker_id`, `rent_from`, `rent_before`, `created_at`, `updated_at`) VALUES
(1, 2, 3, '2024-04-10 20:37:49', '2024-04-10 20:37:49', '2024-04-09 07:12:54', '2024-04-09 07:12:54'),
(2, 2, 3, '2024-04-10 20:37:51', '2024-04-10 20:37:51', '2024-04-09 09:14:21', '2024-04-09 04:14:21'),
(5, 2, 3, '2024-04-10 20:37:53', '2024-04-10 20:37:53', '2024-04-09 17:55:41', '2024-04-09 17:55:41'),
(8, 4, 3, '2024-04-09 14:33:32', '2024-04-09 16:55:00', '2024-04-10 17:42:00', '2024-04-10 17:42:00');

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `id` int(11) NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `category` int(11) NOT NULL DEFAULT 1,
  `api_token` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`id`, `login`, `password`, `category`, `api_token`, `created_at`, `updated_at`) VALUES
(3, 'asdasdsad', '$2y$12$ac3tXu8FzCpWZmSkHXmDTep2hNkRL976WRw2YfjW4l2sZH6Nj9pHm', 5, 'VJyfjTee1LtoNisy83BaYNM2wIhCaxJ9tXRbnoCGcZPJzwLxvwEMbbED8vlVwMH9WoDubDhlPBhalDB09iYfUr9E6wAKcyzpW0Pc', '2024-04-09 08:08:51', '2024-04-09 08:08:51'),
(4, 'asdasdsads', '$2y$12$gfb9ifqgBE2xpOBLSUmTIeKrMxys.ec6Pf6M.1fpwMo0Dtwd6HkXC', 5, 'P0E1cYnyhhWU4XYq9n9MIqrxGcHDzkAOztLpk8Wv8bIKXFZsGVpIsQIr30LEkaNW4Z5kS67o21RQJBQ6ZAZUDkZSGURHe3Lpyp23', '2024-04-09 08:09:24', '2024-04-09 08:09:24'),
(5, 'asdasdsadsw', '$2y$12$OYNpzw.fPVRADiTqVo41yuadT.RwFgv8M.utepe7EfocKuk64ti2O', 5, 'LRqzyIo8xfMi49fhL2I21JnT4qdBpTEF7KknZ3pb8zhfeLVUE17Hd0ymzSKq2vozetmkrrKzXQJJo2gUYfwuRcLPPYDqG0XWziDf', '2024-04-09 08:13:51', '2024-04-09 08:13:51');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auto`
--
ALTER TABLE `auto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Индексы таблицы `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `rent_car`
--
ALTER TABLE `rent_car`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auto_id` (`auto_id`);

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `auto`
--
ALTER TABLE `auto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `rent_car`
--
ALTER TABLE `rent_car`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `worker`
--
ALTER TABLE `worker`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auto`
--
ALTER TABLE `auto`
  ADD CONSTRAINT `auto_ibfk_1` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `rent_car`
--
ALTER TABLE `rent_car`
  ADD CONSTRAINT `rent_car_ibfk_1` FOREIGN KEY (`auto_id`) REFERENCES `auto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
