-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 25 2021 г., 12:48
-- Версия сервера: 10.3.22-MariaDB-log
-- Версия PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `immersion`
--

-- --------------------------------------------------------

--
-- Структура таблицы `login`
--

CREATE TABLE `login` (
  `id` int(10) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `alt_img` varchar(250) DEFAULT NULL,
  `name` varchar(250) DEFAULT NULL,
  `lastname` varchar(250) DEFAULT NULL,
  `edu` varchar(250) DEFAULT NULL,
  `prof` varchar(250) DEFAULT NULL,
  `phone` varchar(150) DEFAULT NULL,
  `address` varchar(150) DEFAULT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `img`, `alt_img`, `name`, `lastname`, `edu`, `prof`, `phone`, `address`, `role`) VALUES
(1, 'noc.dima.inet@gmail.com', '$2y$10$ekvRCXsUBxSiGX822m7LZ.rumVwrihRw1zzYXsC7ZS8xG.lCs1bcm', 'avatar-team-lead', 'Nosov team-lead', 'Dmitriy', 'Nosov', 'SEO Director', 'Full Stack', '+7 926-482-8153', 'Malaysia,Kuala-Lumpur', 'admin'),
(44, 'nds09@yandex.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'avatar-b', 'Oliver', 'Oliver', 'Kopyov', 'IT Director', 'Gotbootstrap Inc.', '+1 317-456-2564', '15 Charist St, Detroit, MI, 48212, USA', 'admin'),
(49, 'z@stakancik.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'avatar-e', '', 'Dr. John', 'Cook PhD', 'Human Resources', 'IT Manager', '+1 313-779-1347', '55 Smyth Rd, Detroit, MI, 48341, USA', 'user'),
(50, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-k', 'Jim Ketty', 'Jim', 'Ketty', 'Staff Orgnizer', 'Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(51, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-g', 'Dr. John', 'Dr. John', 'Oliver', 'Oncologist', 'PR Team', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(52, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-h', 'Sarah McBrook', 'Sarah', 'McBrook', 'Xray Division', 'Doctor', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(53, 'jim.ketty@google.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-i', 'Jimmy Fellan', 'Jimmy', 'Fellan', 'Accounting', 'Accoun Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(54, 'arica.grace@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-j', 'Arica Grace', 'Arica', 'Grace', 'Accounting', 'Accoun Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(59, 'nds19@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'avatar-e', 'Вася', 'Пупкин', 'Козлов', 'Senior Ruby', 'Programm', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(62, 'nds21@yandex.ru', '$2y$10$ekvRCXsUBxSiGX822m7LZ.rumVwrihRw1zzYXsC7ZS8xG.lCs1bcm', 'avatar-admin-lg', 'Марусь', 'Петруш', 'Петренко', 'Big Data', 'Manager', '+7 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'admin'),
(210, 'nds1@yandex.ru', '$2y$10$9GceS1OYtpS/vCo0Are5hOmPg86yiL5tB9u4gXM6pkgBszSXviqzW', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user_img`
--

CREATE TABLE `user_img` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `file` longblob DEFAULT NULL,
  `filename` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_img`
--

INSERT INTO `user_img` (`id`, `user_id`, `file`, `filename`) VALUES
(95, 1, NULL, 'avatar-team-lead.png'),
(96, 2, NULL, 'avatar-b.png'),
(97, 3, NULL, 'avatar-e.png'),
(98, 4, NULL, 'avatar-k.png'),
(99, 5, NULL, '60375d58edb7c.png');

-- --------------------------------------------------------

--
-- Структура таблицы `user_info`
--

CREATE TABLE `user_info` (
  `user_id` int(11) NOT NULL,
  `name` varchar(150) DEFAULT NULL,
  `lastname` varchar(150) DEFAULT NULL,
  `edu` varchar(150) DEFAULT NULL,
  `prof` varchar(150) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_info`
--

INSERT INTO `user_info` (`user_id`, `name`, `lastname`, `edu`, `prof`, `phone`, `address`) VALUES
(1, 'Dmitriy', 'Nosov', 'СEO Director', 'Full Stack', '+7 926-482-8153', 'Malaysia,Kuala-Lumpur'),
(2, 'Oliver', 'Kopyov', 'IT Director', 'Gotbootstrap Inc.', '+7 904-982-2173', '15 Charist St, Detroit, MI, 48212, USA'),
(3, 'Dr. John', 'Cook PhD', 'Human Resources', 'IT Manager', '+1 313-779-1347', '55 Smyth Rd, Detroit, MI, 48341, USA'),
(4, 'Jim', 'Ketty', 'Staff Orgnizer', 'Staff Orgnizer', '+7 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA'),
(5, 'Вася', 'Курочкин', NULL, 'Сисадмин', '2523523235', 'Сибирячиха');

-- --------------------------------------------------------

--
-- Структура таблицы `user_privacy`
--

CREATE TABLE `user_privacy` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `passwrd` varchar(150) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Отошел',
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_privacy`
--

INSERT INTO `user_privacy` (`id`, `user_id`, `email`, `passwrd`, `status`, `role`) VALUES
(85, 1, 'nds09@yandex.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'Онлайн', 'admin'),
(86, 2, 'papa@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(88, 3, 'z@stakancik.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(89, 4, 'jim.ketty@gmail.com', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'admin');

-- --------------------------------------------------------

--
-- Структура таблицы `user_smm`
--

CREATE TABLE `user_smm` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `vk` varchar(150) DEFAULT NULL,
  `teleg` varchar(150) DEFAULT NULL,
  `insta` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_smm`
--

INSERT INTO `user_smm` (`id`, `user_id`, `vk`, `teleg`, `insta`) VALUES
(115, 1, 'vk.com/go2up', 't.com/go2up', 'instagram.com/go2up'),
(116, 2, 'vk.com/kop', 't.com/kop', 'instagram.com/kop'),
(117, 3, 'vk.com/John', 't.com/John', 'instagram.com/John'),
(118, 4, 'vk.com/ketty', 't.com/ketty', 'instagram.com/ketty'),
(119, 5, 'vk.com/kur', 't.com/kur', 'instagram.com/kur');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_img`
--
ALTER TABLE `user_img`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_smm`
--
ALTER TABLE `user_smm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `login`
--
ALTER TABLE `login`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT для таблицы `user_img`
--
ALTER TABLE `user_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT для таблицы `user_info`
--
ALTER TABLE `user_info`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT для таблицы `user_smm`
--
ALTER TABLE `user_smm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=125;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
