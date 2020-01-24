-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 22 2020 г., 13:32
-- Версия сервера: 10.3.13-MariaDB-log
-- Версия PHP: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zadolz`
--

-- --------------------------------------------------------

--
-- Структура таблицы `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacherid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `class`
--

INSERT INTO `class` (`id`, `number`, `type`, `teacherid`) VALUES
(1, 1, 'а', 6),
(2, 2, 'а', 3),
(3, 1, 'б', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `controlall`
--

CREATE TABLE `controlall` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `topic` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `controlobj`
--

CREATE TABLE `controlobj` (
  `id` int(11) NOT NULL,
  `day` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `type` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lesson`
--

INSERT INTO `lesson` (`id`, `name`) VALUES
(1, 'История'),
(2, 'Математика'),
(3, 'Русский'),
(4, 'Английский');

-- --------------------------------------------------------

--
-- Структура таблицы `lessonteacher`
--

CREATE TABLE `lessonteacher` (
  `id` int(11) NOT NULL,
  `lessonid` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `classid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `lessonteacher`
--

INSERT INTO `lessonteacher` (`id`, `lessonid`, `teacherid`, `classid`) VALUES
(1, 1, 3, 1),
(2, 1, 3, 2),
(3, 2, 3, 1),
(4, 2, 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pass`
--

CREATE TABLE `pass` (
  `id` int(11) NOT NULL,
  `studid` int(11) NOT NULL,
  `teacherid` int(11) NOT NULL,
  `leasonid` int(11) NOT NULL,
  `value` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tire` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pass`
--

INSERT INTO `pass` (`id`, `studid`, `teacherid`, `leasonid`, `value`, `tire`, `date`) VALUES
(3, 9, 3, 1, 'н', 0, '2020-01-03'),
(5, 10, 6, 2, 'н', 0, '2020-01-24'),
(6, 10, 6, 2, 'н', 0, '2020-01-01'),
(7, 10, 6, 2, '2', 0, '2020-01-08');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Директор'),
(3, 'Педагог'),
(4, 'Родитель'),
(5, 'Обучающийся');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `fio` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `userid` int(11) NOT NULL,
  `classid` int(11) NOT NULL,
  `parenthid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id`, `fio`, `userid`, `classid`, `parenthid`) VALUES
(9, 'Хренова Полина Олеговна', 5, 1, 4),
(10, 'Плосков Владислав Иванович', 7, 2, 4),
(11, 'Бряхин Олег Олегович', 8, 1, 9),
(12, 'Александр Велсиком Андоралович', 9, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `patronymic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `role`, `name`, `surname`, `patronymic`) VALUES
(1, 'alexey', 'a4a23c4141b4b238a02ec479603fef08', 1, 'Алексей', 'Алексеев', 'Алексеевич'),
(2, 'sheshin', 'd66a44875b30f88448bb2ee71e280a78', 2, 'Владислав', 'Шешин', 'Олегович'),
(3, 'sharovoateacher', '85fa86f052ecace097e75ec3505aa2af', 3, 'Остап', 'Шаров', 'Авксентьевич'),
(4, 'svirindaparent', '71b559e747af2e9f60e38da24eac11f4', 4, 'Дмитрий', 'Свирин', 'Александрович'),
(5, 'nikishinapostudent', '8e76e394a0d005cf1ea0e3487f3d8896', 5, 'Полина', 'Хренова', 'Олеговна'),
(6, 'khodjaevamstudent', 'd732736d4646d71017776e2ffcebf5b2', 3, 'Анвар', 'Ходжаев', 'Магомедович'),
(7, 'ploskovvistudent', '8cdeca67292ccd93a9a61b45bed5294a', 5, 'Владислав', 'Плосков', 'Иванович');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `controlall`
--
ALTER TABLE `controlall`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `controlobj`
--
ALTER TABLE `controlobj`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `lessonteacher`
--
ALTER TABLE `lessonteacher`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `pass`
--
ALTER TABLE `pass`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `controlall`
--
ALTER TABLE `controlall`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `controlobj`
--
ALTER TABLE `controlobj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `lessonteacher`
--
ALTER TABLE `lessonteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pass`
--
ALTER TABLE `pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
