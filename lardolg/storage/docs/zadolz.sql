-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 03 2020 г., 17:39
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
-- Структура таблицы `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `questionid` int(11) NOT NULL,
  `text` text NOT NULL,
  `include` text NOT NULL,
  `correct` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `answers`
--

INSERT INTO `answers` (`id`, `questionid`, `text`, `include`, `correct`) VALUES
(49, 21, 'fasd', '', 0),
(50, 21, 'afsd', '', 1),
(51, 22, 'Да', '', 1),
(52, 22, 'Нет', '', 0),
(53, 23, 'Да нет', '', 0),
(54, 23, 'Нет да', '', 1),
(55, 24, '1', '', 1),
(56, 24, '2', '', 0),
(57, 25, '3', '', 1),
(58, 25, '5', '', 0),
(59, 25, '4', '', 0),
(60, 26, '2', '', 1),
(61, 26, '4', '', 0),
(62, 27, 'н', 'cod.jpg', 1),
(63, 27, 'а', '', 0),
(64, 28, 'рп', '', 0),
(65, 28, 'ра', '', 1),
(66, 29, 'ичм', '', 0),
(67, 29, 'ичсм', '', 0),
(68, 29, 'исчм', 'halo.jpg', 1),
(69, 30, 'афыва', '', 0),
(70, 30, 'аы', '', 1),
(71, 31, 'пыва', '', 1),
(72, 32, 'фыва', '', 0),
(73, 32, 'фыва', '', 1),
(74, 33, 'ва', '', 0),
(75, 33, 'авф', '', 1),
(76, 34, 'афыв', '', 0),
(77, 34, 'фыва', '', 0);

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
(4, 'Английский'),
(5, 'Литература');

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
  `why` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `testid` int(11) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pass`
--

INSERT INTO `pass` (`id`, `studid`, `teacherid`, `leasonid`, `value`, `tire`, `why`, `testid`, `date`) VALUES
(54, 11, 3, 1, '2', 2, '', 0, '2020-03-03'),
(55, 11, 3, 1, 'н', 0, 'фывфы', 23, '2020-03-04'),
(56, 11, 3, 1, 'н', 1, 'афывафаф', 27, '2020-03-11');

-- --------------------------------------------------------

--
-- Структура таблицы `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `quality` text NOT NULL,
  `include` text NOT NULL,
  `testid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `questions`
--

INSERT INTO `questions` (`id`, `question`, `quality`, `include`, `testid`) VALUES
(21, 'ffasd', '3', '', 23),
(22, 'В чем смысл?', '3', 'cod.jpg', 24),
(23, 'Ты да?', '3', 'cod.jpg', 24),
(24, 'Дада я', '3', 'cod.jpg', 24),
(25, 'Кто ты?', '3', 'cod.jpg', 24),
(26, '1+1', '3', 'cod.jpg', 24),
(27, 'Ну и че ', '3', 'prey.jpg', 24),
(28, 'фыв', '3', 'prey.jpg', 24),
(29, 'ичми', '3', 'prey.jpg', 24),
(30, 'ывап', '3', 'prey.jpg', 24),
(31, 'пыва', '3', 'prey.jpg', 24),
(32, 'афыв', '3', '', 25),
(33, 'ячсм', '3', '', 26),
(34, 'фаыв', '3', '', 27);

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
(11, 'Бряхин Олег Олегович', 11, 1, 9),
(12, 'Александр Велсиком Андоралович', 9, 3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `teacherid` int(11) NOT NULL,
  `lessonid` int(11) NOT NULL,
  `include` text NOT NULL,
  `theme` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tests`
--

INSERT INTO `tests` (`id`, `name`, `teacherid`, `lessonid`, `include`, `theme`) VALUES
(23, 'dadada', 3, 1, 'zelda.jpg', 'dadada'),
(24, 'Первый серьезный', 1, 2, '', 'Блабламатика'),
(25, 'фыва', 1, 4, '', 'аыв'),
(26, 'аывф', 1, 5, '', 'фыва'),
(27, 'афыв', 1, 1, '', 'ываф');

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
(7, 'ploskovvistudent', '8cdeca67292ccd93a9a61b45bed5294a', 5, 'Владислав', 'Плосков', 'Иванович'),
(11, 'student9', '7c8cd5da17441ff04bf445736964dd16', 5, 'Олег ', 'Бряхин', 'Олегович');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

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
-- Индексы таблицы `questions`
--
ALTER TABLE `questions`
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
-- Индексы таблицы `tests`
--
ALTER TABLE `tests`
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
-- AUTO_INCREMENT для таблицы `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `lessonteacher`
--
ALTER TABLE `lessonteacher`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `pass`
--
ALTER TABLE `pass`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
-- AUTO_INCREMENT для таблицы `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
