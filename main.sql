-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 15 2024 г., 10:36
-- Версия сервера: 10.3.39-MariaDB-0ubuntu0.20.04.2
-- Версия PHP: 7.4.3-4ubuntu2.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `main`
--

-- --------------------------------------------------------

--
-- Структура таблицы `anime`
--

CREATE TABLE `anime` (
  `id` int(11) NOT NULL,
  `prev` text NOT NULL,
  `banner` text NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `country` int(11) NOT NULL DEFAULT 0,
  `origname` text NOT NULL,
  `genre` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `year` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT 0,
  `watchyear` int(11) NOT NULL,
  `trailer` text DEFAULT NULL,
  `teaser` text DEFAULT NULL,
  `link` text NOT NULL,
  `type` int(11) DEFAULT 1,
  `status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `anime`
--

INSERT INTO `anime` (`id`, `prev`, `banner`, `name`, `description`, `country`, `origname`, `genre`, `year`, `rating`, `watchyear`, `trailer`, `teaser`, `link`, `type`, `status`) VALUES
(2, '1696076464.png', '1697476312.png', 'Мастера меча онлайн', 'Опытному геймеру Кирито повезло поучаствовать в бета-тестировании самой ожидаемой компьютерной игры нового поколения - Sword Art Online.', 1, 'Sword Art Online', '[{\"idgenre\":\"34\",\"namegenre\":\"Боевик\"},{\"idgenre\":\"42\",\"namegenre\":\"Драма\"},{\"idgenre\":\"69\",\"namegenre\":\"Приключения\"},{\"idgenre\":\"73\",\"namegenre\":\"Романтика\"},{\"idgenre\":\"87\",\"namegenre\":\"Фэнтези\"}]', 2012, 7.9, 16, '', '', 'sword-art-online', 1, 1),
(16, '1697468163.png', '1697468171.png', ' Синий экзорцист', 'Рин Окимура и его брат Юкио — сироты, росшие в храме священника и экзорциста Фудзимото. Рин — парень неплохой, но вспыльчивый, придурковатый и постоянно ввязывающийся в драки. Юкио же наоборот, умный, прилежный и мечтающий стать врачом (и лечение извечных ссадин брата ему в этом лишь помогает).', 1, 'Ao no ekusoshisuto', '[{\"idgenre\":\"34\",\"namegenre\":\"Боевик\"},{\"idgenre\":\"42\",\"namegenre\":\"Драма\"},{\"idgenre\":\"50\",\"namegenre\":\"Комедия\"},{\"idgenre\":\"57\",\"namegenre\":\"Мистика\"},{\"idgenre\":\"87\",\"namegenre\":\"Фэнтези\"}]', 2011, 7.6, 16, NULL, NULL, 'ao-no-ekusoshisuto', 1, 1),
(17, '1698095111.png', '1698095773.png', 'Моя геройская академия', 'В некоем мире больший процент населения человечества рождается с необычными способностями, которые называются причудами. Но наш герой в этот процент не попал. Но парень упорно пытается достичь небывалой силы и приблизиться к своей мечте стать супергероем.', 1, 'Boku no hiro akademia', '[]', 2016, 7.5, 12, NULL, NULL, 'boku-no-hiro-akademia', 1, 1),
(18, '1701240293.png', '1701240707.png', 'Блич: Глава из ада', 'Ад - место, где черные от грехов души предаются смертным мукам и ужасным пыткам за совершенные при жизни преступления. Шинигами запрещено связываться с Адом и на этот запрет есть много причин... Но даже в Аду все не так хорошо. ', 0, 'Bleach Movie 4: Jigoku-hen', '[{\"idgenre\":\"69\",\"namegenre\":\"Приключения\"},{\"idgenre\":\"29\",\"namegenre\":\"Сёнэн\"},{\"idgenre\":\"87\",\"namegenre\":\"Фэнтези\"},{\"idgenre\":\"90\",\"namegenre\":\"Экшен\"}]', 2010, 7.6, 12, NULL, NULL, 'bleach-movie-4:-jigoku-hen', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `blockip`
--

CREATE TABLE `blockip` (
  `id` int(11) NOT NULL,
  `blockip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `blockip`
--

INSERT INTO `blockip` (`id`, `blockip`) VALUES
(33, '84.54.51.66'),
(45, '89.208.104.205'),
(46, '91.92.244.214'),
(47, '81.3.141.64'),
(48, '85.196.214.95'),
(49, '31.129.206.27'),
(52, '45.128.232.156'),
(54, '143.42.206.215'),
(55, '143.42.206.215'),
(56, '143.42.206.215'),
(57, '45.142.182.76'),
(58, '91.92.242.207'),
(59, '143.42.63.237'),
(60, '143.42.63.237'),
(61, '143.42.63.237'),
(62, '146.19.191.205'),
(63, '185.150.26.205'),
(64, '172.233.58.223'),
(65, '91.92.251.33'),
(66, '5.142.41.209'),
(67, '31.42.91.130'),
(68, '85.113.129.209'),
(69, '172.233.57.157'),
(70, '172.233.57.157'),
(71, '141.98.10.86'),
(72, '89.190.156.61'),
(73, '141.98.7.8'),
(74, '89.190.156.225'),
(75, '91.92.242.74'),
(76, '141.98.11.107'),
(77, '179.43.178.234'),
(78, '94.156.66.159'),
(79, '141.98.7.195'),
(80, '45.142.182.85'),
(81, '194.48.250.32'),
(82, '141.98.7.186'),
(83, '188.35.131.242'),
(84, '141.98.7.28'),
(85, '45.128.232.215'),
(86, '185.150.26.251'),
(87, '91.43.126.118'),
(88, '31.220.3.140'),
(89, '5.254.242.118'),
(90, '89.190.156.234'),
(91, '164.92.205.247'),
(92, '172.233.57.39'),
(93, '172.233.57.39'),
(94, '172.233.57.39'),
(95, '172.233.57.39'),
(96, '51.20.99.57'),
(97, '51.20.99.57'),
(98, '185.210.219.106'),
(99, '62.133.61.69'),
(100, '45.128.232.90'),
(101, '5.45.75.18'),
(102, '178.35.73.161'),
(103, '45.90.97.172'),
(104, '45.144.28.227'),
(105, '45.144.28.227'),
(106, '79.110.62.195'),
(107, '185.196.8.198'),
(108, '5.16.125.82'),
(109, '37.157.255.50'),
(110, '91.191.246.48'),
(111, '94.156.8.110'),
(112, '185.196.10.155'),
(113, '173.249.5.74'),
(114, '45.135.232.119'),
(115, '185.191.126.213'),
(116, '109.252.136.102'),
(117, '80.251.153.235'),
(118, '185.196.11.177'),
(119, '139.162.142.167'),
(120, '139.162.142.167'),
(121, '5.8.177.112'),
(122, '185.172.108.29'),
(123, '95.139.136.139'),
(124, '77.105.152.42'),
(125, '147.78.103.190'),
(126, '141.98.11.55'),
(128, '37.204.113.241'),
(129, '185.244.36.206'),
(130, '145.239.154.85'),
(131, '31.162.3.240'),
(132, '185.224.128.74'),
(133, '217.107.115.120'),
(134, '145.239.154.82'),
(135, '212.87.212.46'),
(136, '91.247.239.255'),
(137, '2.94.77.140'),
(138, '46.19.143.27'),
(139, '212.127.78.133');

-- --------------------------------------------------------

--
-- Структура таблицы `borders`
--

CREATE TABLE `borders` (
  `idbor` int(11) NOT NULL,
  `src` text NOT NULL,
  `position` text NOT NULL,
  `small_pos` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `borders`
--

INSERT INTO `borders` (`idbor`, `src`, `position`, `small_pos`) VALUES
(1, '1.png', 'width: 180px;height: 180px;margin: -10px;', 'width: 55px;height: 55px;margin: -5px;'),
(2, '2.png', 'width: 180px;height: 180px;margin: -10px;', 'width: 55px;height: 55px;margin: -5px;'),
(3, '3.png', 'width: 180px;height: 180px;margin: -10px;', 'width: 55px;height: 55px;margin: -5px;'),
(4, '4.png', 'width: 185px;height: 185px;margin: -12px;', 'width: 55px;height: 55px;margin: -5px;'),
(5, '5.png', 'width: 185px;height: 185px;margin: -12px;', 'width: 50px;height: 50px;margin: -3px;'),
(6, '6.png', 'width: 176px;height: 182px;margin: -12px;', 'width: 50px;height: 50px;margin: -3px;'),
(7, '7.png', 'width: 176px;height: 182px;margin: -12px;', 'width: 50px;height: 50px;margin: -3px;');

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `txtmsg` text NOT NULL,
  `attch` text DEFAULT NULL,
  `typeattch` text DEFAULT NULL,
  `datemsg` int(11) DEFAULT NULL,
  `delmsg` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `chat`
--

INSERT INTO `chat` (`id`, `userid`, `txtmsg`, `attch`, `typeattch`, `datemsg`, `delmsg`) VALUES
(1, 1, 'Привет всем', NULL, NULL, 1698696679, 0),
(2, 2, 'Семиуровневая модель OSI расшифровывается как Open Systems Interconnection. Это базовая иерархическая модель взаимодействия открытых систем. То есть основополагающая модель, описывающая структуру передачи данных от одного приложения другому.', NULL, NULL, 1698696689, 0),
(10, 1, ' ', 'sticker', '1', 1698736017, 0),
(77, 1, '', 'sticker', '4', 1698780613, 0),
(78, 1, '', 'sticker', '13', 1698780982, 0),
(81, 1, '', 'sticker', '4', 1698841088, 1),
(83, 1, '', 'sticker', '6', 1699458329, 1),
(84, 5, '', 'sticker', '14', 1699459328, 0),
(85, 5, '', 'sticker', '21', 1699467769, 1),
(86, 5, '', 'sticker', '9', 1699467849, 0),
(87, 1, '', 'sticker', '10', 1699467854, 0),
(88, 5, '', 'sticker', '15', 1699467861, 0),
(89, 1, '', 'sticker', '24', 1702541172, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `checkddos`
--

CREATE TABLE `checkddos` (
  `id` int(200) NOT NULL,
  `ip` text NOT NULL,
  `lastreq` int(11) NOT NULL,
  `page` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `checkddos`
--


-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `reply_id` int(11) NOT NULL DEFAULT 0,
  `reply_to_id` int(11) NOT NULL DEFAULT 0,
  `text` text NOT NULL,
  `iduser` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `idanime`, `season`, `episode`, `reply_id`, `reply_to_id`, `text`, `iduser`, `date`) VALUES
(22, 2, 1, 1, 0, 0, 'о, мне понравилось!', 1, 1699106012),
(29, 2, 1, 1, 0, 0, 'такс', 1, 1699106378),
(30, 2, 1, 1, 22, 1, 'ezh, Это хорошо', 2, 1699111807),
(34, 2, 1, 1, 22, 2, 'AnimeGanUser1, согласен', 1, 1699430976),
(37, 16, 1, 1, 0, 0, 'Ниче такое аниме', 5, 1699458041),
(38, 2, 1, 1, 29, 1, 'ezhe, v', 5, 1699464532),
(53, 16, 1, 1, 37, 7, 'Papanya, asdasd', 1, 1701102068),
(54, 16, 1, 1, 37, 7, 'Papanya, на изичах', 7, 1701102084),
(57, 18, 0, 0, 0, 0, 'Обожаю блича', 1, 1701249453),
(70, 2, 1, 2, 0, 0, 'Топ', 7, 1703419048);

-- --------------------------------------------------------

--
-- Структура таблицы `comments_rating`
--

CREATE TABLE `comments_rating` (
  `id` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `fromuser` int(11) NOT NULL,
  `toidcomm` int(11) NOT NULL,
  `uservalue` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments_rating`
--

INSERT INTO `comments_rating` (`id`, `idanime`, `season`, `episode`, `fromuser`, `toidcomm`, `uservalue`) VALUES
(33, 2, 1, 1, 5, 29, -1),
(49, 16, 1, 1, 7, 53, 1),
(76, 18, 0, 0, 1, 57, 1),
(79, 16, 1, 1, 1, 37, 1),
(83, 2, 1, 1, 1, 29, 1),
(86, 2, 1, 1, 1, 38, 1),
(89, 2, 1, 1, 1, 22, 1),
(90, 2, 1, 1, 1, 30, 1),
(91, 2, 1, 1, 1, 34, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `episodes`
--

CREATE TABLE `episodes` (
  `id` int(11) NOT NULL,
  `id_anime` int(11) NOT NULL,
  `season` int(11) NOT NULL DEFAULT 0,
  `episode` int(11) NOT NULL DEFAULT 0,
  `fullmovie` int(11) NOT NULL DEFAULT 0,
  `name` text NOT NULL,
  `link` text NOT NULL,
  `poster` text DEFAULT NULL,
  `sections` longtext DEFAULT NULL,
  `hide` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `episodes`
--

INSERT INTO `episodes` (`id`, `id_anime`, `season`, `episode`, `fullmovie`, `name`, `link`, `poster`, `sections`, `hide`) VALUES
(2, 2, 2, 1, 0, 'w', 'http://SITE/sys/upload/files/7c8d13c4be943a8c0fd04de0704c56aa-master.m3u8', NULL, '', 0),
(4, 2, 1, 3, 0, 'aaaw', '', '', '[]', 0),
(5, 2, 2, 2, 0, 'dx', '', '', '[]', 0),
(6, 2, 2, 3, 0, 'Воспоминания крови', 'ss', NULL, '', 1),
(8, 16, 1, 1, 0, 'Демоны живут в наших сердцах', 'http://SITE/sys/upload/files/4ea2f6748e5c48aedeacf9792aa0fa01-master.m3u8', '', '[]', 0),
(9, 17, 1, 1, 0, 'Izuku Midoriya: Origin', '', NULL, '', 0),
(24, 2, 1, 1, 0, 'Мир мечей', 'http://SITE/sys/upload/files/3cb2abc1aa9db8716ebd810847b3a79d/master.m3u8', 'http://SITE/sys/upload/files/3cb2abc1aa9db8716ebd810847b3a79d/poster.jpg', '[{\"type\":\"intro\",\"start\":\"0.0\",\"end\":\"16.22\",\"skip\":true,\"title\":\"\"},{\"type\":\"titler\",\"start\":\"1306.26\",\"end\":\"1422\",\"skip\":true,\"title\":\"\"}]', 0),
(25, 2, 1, 2, 0, 'Битер', 'http://SITE/sys/upload/files/71965254f3dee86870d0339ee3827b29/master.m3u8', 'http://SITE/sys/upload/files/71965254f3dee86870d0339ee3827b29/poster.jpg', '[{\"type\":\"intro\",\"start\":\"40.409802\",\"end\":\"130.349335\",\"skip\":true,\"title\":\"\"},{\"type\":\"titler\",\"start\":\"1325\",\"end\":\"1422.899496\",\"skip\":true,\"title\":\"\"}]', 0),
(26, 18, 0, 0, 1, '', 'http://SITE/sys/upload/files/dd89fcf34a973b50058b1e52edf3a270/master.m3u8', 'http://SITE/sys/upload/files/dd89fcf34a973b50058b1e52edf3a270/poster.jpg', '[{\"type\":\"intro\",\"start\":\"0.0\",\"end\":\"20.227891\",\"skip\":true,\"title\":\"\"},{\"type\":\"titler\",\"start\":\"5367.681394\",\"end\":\"5636.694155\",\"skip\":true,\"title\":\"\"}]', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `favorite`
--

CREATE TABLE `favorite` (
  `idfav` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `favorite`
--

INSERT INTO `favorite` (`idfav`, `idanime`, `iduser`) VALUES
(36, 2, 5),
(37, 16, 5),
(196, 18, 1),
(198, 16, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `friends`
--

CREATE TABLE `friends` (
  `idfr` int(11) NOT NULL,
  `idsend` int(11) NOT NULL,
  `idto` int(11) NOT NULL,
  `type` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `friends`
--

INSERT INTO `friends` (`idfr`, `idsend`, `idto`, `type`) VALUES
(30, 1, 7, 1),
(35, 1, 5, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `genre`
--

CREATE TABLE `genre` (
  `idgenre` int(11) NOT NULL,
  `namegenre` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genre`
--

INSERT INTO `genre` (`idgenre`, `namegenre`) VALUES
(26, 'Кодомо'),
(27, 'Сёдзё'),
(28, 'Дзёсэй'),
(29, 'Сёнэн'),
(30, 'Сэйнэн'),
(31, 'Апокалиптика'),
(32, 'Безумие'),
(33, 'Биопанк'),
(34, 'Боевик'),
(35, 'Боевые искусства'),
(36, 'Вампиры'),
(37, 'Военные'),
(38, 'Гарем'),
(39, 'Демоны'),
(40, 'Детектив'),
(41, 'Добуцу'),
(42, 'Драма'),
(43, 'Игры'),
(44, 'Идолы'),
(45, 'Икудзи'),
(46, 'Исэкай'),
(47, 'Исторический'),
(48, 'Кайто'),
(49, 'Киберпанк'),
(50, 'Комедия'),
(51, 'Космическая опера'),
(52, 'Космос'),
(53, 'Магия'),
(54, 'Махо-сёдзё'),
(55, 'Машины'),
(56, 'Меха'),
(57, 'Мистика'),
(58, 'Моэ'),
(59, 'Музыка'),
(60, 'Мыльная опера'),
(61, 'Отаку'),
(62, 'Парапсихология'),
(63, 'Пародия'),
(64, 'Паропанк/Стимпанк'),
(65, 'Повседневность'),
(66, 'Полицейский боевик'),
(67, 'Полиция'),
(68, 'Постапокалиптика'),
(69, 'Приключения'),
(70, 'Психологический'),
(71, 'Психологический триллер'),
(72, 'Реверс-гарем'),
(73, 'Романтика'),
(74, 'Самураи'),
(75, 'Самурайский боевик (тямбара)'),
(76, 'Сверхъестественное'),
(77, 'Сёдзё-ай'),
(78, 'Сёнэн-ай'),
(79, 'Сказка'),
(80, 'Спокон'),
(81, 'Суперсила'),
(82, 'Сэнтай'),
(83, 'Токусацу'),
(84, 'Триллер'),
(85, 'Ужасы'),
(86, 'Фантастика'),
(87, 'Фэнтези'),
(88, 'Школа'),
(89, 'Школьный детектив'),
(90, 'Экшен');

-- --------------------------------------------------------

--
-- Структура таблицы `history_view`
--

CREATE TABLE `history_view` (
  `idhis` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `season` int(11) NOT NULL,
  `episode` int(11) NOT NULL,
  `time` float NOT NULL DEFAULT 0,
  `duration` float NOT NULL DEFAULT 0,
  `iduser` int(11) NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `history_view`
--

INSERT INTO `history_view` (`idhis`, `idanime`, `season`, `episode`, `time`, `duration`, `iduser`, `date`) VALUES
(22, 2, 1, 1, 150.99, 1422.39, 1, 1721117087),
(23, 2, 1, 2, 1256.81, 1422.89, 1, 1721117002),
(24, 2, 1, 1, 803.403, 1422.39, 7, 1701157149),
(25, 2, 1, 2, 1263.54, 1422.89, 7, 1701101711),
(27, 18, 0, 0, 240.744, 5636.67, 1, 1721116950),
(28, 18, 0, 0, 5308.12, 5636.67, 7, 1703425587),
(29, 2, 1, 2, 1256.81, 1422.89, 1, 1721117002),
(30, 2, 1, 2, 1256.81, 1422.89, 1, 1721117002),
(31, 2, 1, 2, 1256.81, 1422.89, 1, 1721117002),
(32, 2, 1, 2, 1256.81, 1422.89, 1, 1721117002);

-- --------------------------------------------------------

--
-- Структура таблицы `myview`
--

CREATE TABLE `myview` (
  `divi` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `myview`
--

INSERT INTO `myview` (`divi`, `idanime`, `iduser`) VALUES
(124, 18, 1),
(158, 16, 7),
(159, 18, 7),
(160, 17, 7),
(161, 2, 1),
(162, 16, 1),
(163, 17, 1),
(164, 2, 7);

-- --------------------------------------------------------

--
-- Структура таблицы `rec_anime`
--

CREATE TABLE `rec_anime` (
  `id` int(11) NOT NULL,
  `id_anime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `rec_anime`
--

INSERT INTO `rec_anime` (`id`, `id_anime`) VALUES
(1, 18),
(2, 16),
(3, 17);

-- --------------------------------------------------------

--
-- Структура таблицы `stickers`
--

CREATE TABLE `stickers` (
  `id` int(11) NOT NULL,
  `name_pack` text NOT NULL,
  `source` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `stickers`
--

INSERT INTO `stickers` (`id`, `name_pack`, `source`) VALUES
(1, 'hasket', '/imgs/stickers/hasket/1.png'),
(2, 'hasket', '/imgs/stickers/hasket/2.png'),
(3, 'hasket', '/imgs/stickers/hasket/3.png'),
(4, 'hasket', '/imgs/stickers/hasket/4.png'),
(5, 'hasket', '/imgs/stickers/hasket/5.png'),
(6, 'hasket', '/imgs/stickers/hasket/6.png'),
(7, 'hasket', '/imgs/stickers/hasket/7.png'),
(8, 'hasket', '/imgs/stickers/hasket/8.png'),
(9, 'hasket', '/imgs/stickers/hasket/9.png'),
(10, 'hasket', '/imgs/stickers/hasket/10.png'),
(11, 'hasket', '/imgs/stickers/hasket/11.png'),
(12, 'hasket', '/imgs/stickers/hasket/12.png'),
(13, 'hasket', '/imgs/stickers/hasket/13.png'),
(14, 'hasket', '/imgs/stickers/hasket/14.png'),
(15, 'hasket', '/imgs/stickers/hasket/15.png'),
(16, 'hasket', '/imgs/stickers/hasket/16.png'),
(17, 'hasket', '/imgs/stickers/hasket/17.png'),
(18, 'hasket', '/imgs/stickers/hasket/18.png'),
(19, 'hasket', '/imgs/stickers/hasket/19.png'),
(20, 'hasket', '/imgs/stickers/hasket/20.png'),
(21, 'hasket', '/imgs/stickers/hasket/21.png'),
(22, 'hasket', '/imgs/stickers/hasket/22.png'),
(23, 'hasket', '/imgs/stickers/hasket/23.png'),
(24, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/1.png'),
(25, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/2.png'),
(26, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/3.png'),
(27, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/4.png'),
(28, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/5.png'),
(29, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/6.png'),
(30, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/7.png'),
(31, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/8.png'),
(32, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/9.png'),
(33, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/10.png'),
(34, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/11.png'),
(35, 'Kimetsu no Yaiba', '/imgs/stickers/KIMETSU NO YAIBA/12.png');

-- --------------------------------------------------------

--
-- Структура таблицы `support_dialog`
--

CREATE TABLE `support_dialog` (
  `id` int(11) NOT NULL,
  `idtheme` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `msg` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `support_dialog`
--

INSERT INTO `support_dialog` (`id`, `idtheme`, `iduser`, `msg`, `date`) VALUES
(2, 15, 0, 'В данный момент платежная система не подключена к сайту, приносим свои извинения за предоставленные неудобства!', 1702112571),
(3, 15, 1, 'Понял, спасибо', 1702112581),
(10, 20, 0, 'v!', 1702839689);

-- --------------------------------------------------------

--
-- Структура таблицы `support_themes`
--

CREATE TABLE `support_themes` (
  `id` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `nametheme` text NOT NULL,
  `question` text NOT NULL,
  `iduser` int(11) NOT NULL,
  `closed` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `support_themes`
--

INSERT INTO `support_themes` (`id`, `section`, `nametheme`, `question`, `iduser`, `closed`, `date`) VALUES
(15, 0, 'проблема с балансом', 'Не могу пополнить баланс', 1, 0, 1702112571),
(20, 4, 'Sherwood', 'Когда?', 7, 0, 1702839687),
(21, 0, 'sad', 'asdasd', 1, 0, 1703151595);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `ban` int(11) NOT NULL DEFAULT 0,
  `avatar` text NOT NULL DEFAULT 'default.jpg',
  `banner` text NOT NULL DEFAULT 'default.png',
  `money` int(11) NOT NULL DEFAULT 0,
  `login` text NOT NULL,
  `name` text DEFAULT NULL,
  `birth` int(11) DEFAULT 0,
  `city` text DEFAULT NULL,
  `vk` text NOT NULL,
  `ip` text NOT NULL,
  `date` int(11) NOT NULL,
  `lastact` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT 0,
  `moder_lvl` int(11) NOT NULL DEFAULT 0,
  `subscribe` int(11) NOT NULL DEFAULT 0,
  `typesubs` int(11) NOT NULL DEFAULT 0,
  `border` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `ban`, `avatar`, `banner`, `money`, `login`, `name`, `birth`, `city`, `vk`, `ip`, `date`, `lastact`, `is_admin`, `moder_lvl`, `subscribe`, `typesubs`, `border`) VALUES
(1, 0, '1.png', '', 17670, 'Ryuzaki', 'a', 1515531600, 'a', '', '', 1697883995, 1722630846, 1, 0, 1829274169, 1, 1),
(2, 0, '2.png', '2.png', 0, 'Makima', '', -10000000, '', '', '', 1695805160, 1703661247, 0, 0, 0, 0, 0),
(5, 0, '5.png', '5.png', 0, 'Omikudje', 'Руслан', 723589200, 'Ростов-на-Дону', '', '', 1699457944, 1699467869, 1, 0, 0, 0, 0),
(7, 0, '7.png', 'default.png', 7510, 'Robingood', 'Илья Рыбалка. ', 1699995600, 'Moscow', '', '', 1700062189, 1703948633, 0, 0, 1796442812, 1, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `user_follow_anime`
--

CREATE TABLE `user_follow_anime` (
  `id` int(11) NOT NULL,
  `idanime` int(11) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_follow_anime`
--

INSERT INTO `user_follow_anime` (`id`, `idanime`, `iduser`) VALUES
(1, 2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_notice`
--

CREATE TABLE `user_notice` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `msg` text NOT NULL,
  `attch` int(11) DEFAULT 0,
  `saw` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_notice`
--

INSERT INTO `user_notice` (`id`, `iduser`, `type`, `msg`, `attch`, `saw`, `date`) VALUES
(1, 1, 0, 'Добро пожаловать на сайт', 0, 1, 1699822808),
(2, 1, 0, 'Прочтите правила', 0, 1, 1699822809),
(3, 1, 0, 'Уведомление', 0, 1, 1699822810),
(10, 7, 0, 'Добро пожаловать на сайт', 0, 1, 1700062189),
(11, 7, 1, 'хочет добавить Вас в друзья', 1, 1, 1700062337),
(16, 5, 1, 'хочет добавить Вас в друзья', 1, 0, 1701108443);

-- --------------------------------------------------------

--
-- Структура таблицы `user_notice_social`
--

CREATE TABLE `user_notice_social` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL DEFAULT 0,
  `vk` text NOT NULL DEFAULT '0',
  `tg` text NOT NULL DEFAULT '0',
  `vkstatus` int(11) NOT NULL DEFAULT 0,
  `tgstatus` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_notice_social`
--

INSERT INTO `user_notice_social` (`id`, `iduser`, `vk`, `tg`, `vkstatus`, `tgstatus`) VALUES
(1, 1, '', '0', 1, 0),
(4, 2, '', '0', 1, 0),
(9, 0, '345345', '0', 0, 0),
(10, 3, '0', '32423', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_notice_social_cron`
--

CREATE TABLE `user_notice_social_cron` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `vk` int(11) NOT NULL DEFAULT 0,
  `tg` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `user_privacy`
--

CREATE TABLE `user_privacy` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `name` int(11) NOT NULL DEFAULT 0,
  `date` int(11) NOT NULL DEFAULT 0,
  `city` int(11) NOT NULL DEFAULT 0,
  `profile` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user_privacy`
--

INSERT INTO `user_privacy` (`id`, `iduser`, `name`, `date`, `city`, `profile`) VALUES
(3, 1, 1, 1, 1, 0),
(5, 7, 1, 1, 1, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `anime`
--
ALTER TABLE `anime`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `blockip`
--
ALTER TABLE `blockip`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `borders`
--
ALTER TABLE `borders`
  ADD PRIMARY KEY (`idbor`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `checkddos`
--
ALTER TABLE `checkddos`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments_rating`
--
ALTER TABLE `comments_rating`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `episodes`
--
ALTER TABLE `episodes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`idfav`);

--
-- Индексы таблицы `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`idfr`);

--
-- Индексы таблицы `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`idgenre`);

--
-- Индексы таблицы `history_view`
--
ALTER TABLE `history_view`
  ADD PRIMARY KEY (`idhis`);

--
-- Индексы таблицы `myview`
--
ALTER TABLE `myview`
  ADD PRIMARY KEY (`divi`);

--
-- Индексы таблицы `rec_anime`
--
ALTER TABLE `rec_anime`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `stickers`
--
ALTER TABLE `stickers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `support_dialog`
--
ALTER TABLE `support_dialog`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `support_themes`
--
ALTER TABLE `support_themes`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_follow_anime`
--
ALTER TABLE `user_follow_anime`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_notice`
--
ALTER TABLE `user_notice`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_notice_social`
--
ALTER TABLE `user_notice_social`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_notice_social_cron`
--
ALTER TABLE `user_notice_social_cron`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `anime`
--
ALTER TABLE `anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `blockip`
--
ALTER TABLE `blockip`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=140;

--
-- AUTO_INCREMENT для таблицы `borders`
--
ALTER TABLE `borders`
  MODIFY `idbor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `checkddos`
--
ALTER TABLE `checkddos`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87819;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT для таблицы `comments_rating`
--
ALTER TABLE `comments_rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT для таблицы `episodes`
--
ALTER TABLE `episodes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT для таблицы `favorite`
--
ALTER TABLE `favorite`
  MODIFY `idfav` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT для таблицы `friends`
--
ALTER TABLE `friends`
  MODIFY `idfr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `genre`
--
ALTER TABLE `genre`
  MODIFY `idgenre` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `history_view`
--
ALTER TABLE `history_view`
  MODIFY `idhis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `myview`
--
ALTER TABLE `myview`
  MODIFY `divi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=165;

--
-- AUTO_INCREMENT для таблицы `rec_anime`
--
ALTER TABLE `rec_anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `stickers`
--
ALTER TABLE `stickers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT для таблицы `support_dialog`
--
ALTER TABLE `support_dialog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `support_themes`
--
ALTER TABLE `support_themes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=861;

--
-- AUTO_INCREMENT для таблицы `user_follow_anime`
--
ALTER TABLE `user_follow_anime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `user_notice`
--
ALTER TABLE `user_notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=870;

--
-- AUTO_INCREMENT для таблицы `user_notice_social`
--
ALTER TABLE `user_notice_social`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user_notice_social_cron`
--
ALTER TABLE `user_notice_social_cron`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
