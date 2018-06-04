-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Чрв 04 2018 р., 19:51
-- Версія сервера: 10.1.28-MariaDB
-- Версія PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `api_db`
--

-- --------------------------------------------------------

--
-- Структура таблиці `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(256) NOT NULL,
  `tag` varchar(64) NOT NULL,
  `content` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `notes`
--

INSERT INTO `notes` (`id`, `title`, `tag`, `content`, `created`, `modified`) VALUES
(1, 'Vehicles', '', 'Cars and everething relation with cars', '2018-06-01 00:35:07', '2018-08-30 15:34:33'),
(2, 'Electronics', '', 'Gadgets, drones and more.', '2018-06-01 00:35:07', '2018-05-30 15:34:33'),
(3, 'Motors', '', 'Motor sports and more', '2018-06-01 00:35:07', '2018-05-30 15:34:54'),
(5, 'Movies', '', 'Movie products.', '0000-00-00 00:00:00', '2018-01-08 12:27:26'),
(6, 'Books', '', 'Books, audio books and more.', '0000-00-00 00:00:00', '2018-01-08 12:27:47');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;