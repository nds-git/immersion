-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 27 2021 г., 21:51
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
(2, 'nds09@yandex.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'avatar-b', 'Oliver', 'Oliver', 'Kopyov', 'IT Director', 'Gotbootstrap Inc.', '+1 317-456-2564', '15 Charist St, Detroit, MI, 48212, USA', 'admin'),
(3, 'z@stakancik.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'avatar-e', '', 'Dr. John', 'Cook PhD', 'Human Resources', 'IT Manager', '+1 313-779-1347', '55 Smyth Rd, Detroit, MI, 48341, USA', 'user'),
(4, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-k', 'Jim Ketty', 'Jim', 'Ketty', 'Staff Orgnizer', 'Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(5, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-g', 'Dr. John', 'Dr. John', 'Oliver', 'Oncologist', 'PR Team', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(6, 'jim.ketty@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-h', 'Sarah McBrook', 'Sarah', 'McBrook', 'Xray Division', 'Doctor', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(7, 'jim.ketty@google.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-i', 'Jimmy Fellan', 'Jimmy', 'Fellan', 'Accounting', 'Accoun Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(8, 'arica.grace@smartadminwebapp.com', '$2y$10$d6Rnhb1KdYDJHLdUm9nF7OgBbRHKdAqUZPEE.XdeUJzxcDXvivc2W', 'avatar-j', 'Arica Grace', 'Arica', 'Grace', 'Accounting', 'Accoun Manager', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(9, 'nds19@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'avatar-e', 'Вася', 'Пупкин', 'Козлов', 'Senior Ruby', 'Programm', '+1 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'user'),
(10, 'nds21@yandex.ru', '$2y$10$ekvRCXsUBxSiGX822m7LZ.rumVwrihRw1zzYXsC7ZS8xG.lCs1bcm', 'avatar-admin-lg', 'Марусь', 'Петруш', 'Петренко', 'Big Data', 'Manager', '+7 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA', 'admin'),
(11, 'nds1@yandex.ru', '$2y$10$jWFwiXi7GujvXZllpAt.1e2oYmfnSwcxWMK3Y9tRYnfjlH2n/2bda', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user'),
(12, 'lavrov@ministr.ru', '$2y$10$INznCy06EJKLUBperlrfB.WmIZC2ZzfgMqlgLoh2hIuWAHWV7UK7e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user'),
(13, 'rypa@google.com', '$2y$10$Q37Y7BwusfoLOe4Sw7CSBOpf8fwDzs9bxrn9I9hX618g7tVyzn5Zq', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user'),
(14, 'dad@rambler.ru', '$2y$10$drM2tibKmoO6Rv1f6.QK5es60fqfSpHVkP7Z6gLfR2XArx0vJC23.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user'),
(15, 'people@yandex.ru', '$2y$10$drM2tibKmoO6Rv1f6.QK5es60fqfSpHVkP7Z6gLfR2XArx0vJC23.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'user');

-- --------------------------------------------------------

--
-- Структура таблицы `user_img`
--

CREATE TABLE `user_img` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `filename` varchar(150) DEFAULT 'avatar-m.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_img`
--

INSERT INTO `user_img` (`id`, `user_id`, `filename`) VALUES
(1, 1, 'avatar-team-lead.png'),
(2, 2, '60392dd68a901.png'),
(3, 3, 'avatar-e.png'),
(4, 4, 'avatar-k.png'),
(5, 5, '60392fa6acde9.png'),
(6, 6, '60392fb484f1b.png'),
(7, 7, '603777c6b61af.png'),
(8, 8, '603778ee3509c.png'),
(9, 9, '6039c53a678b1.png');

-- --------------------------------------------------------

--
-- Структура таблицы `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `user_info` (`id`, `user_id`, `name`, `lastname`, `edu`, `prof`, `phone`, `address`) VALUES
(1, 1, 'Dmitriy', 'Nosov', 'СEO Director', 'Full Stack', '+7 926-482-8153', 'Malaysia,Kuala-Lumpur'),
(2, 2, 'Олег', 'Kopyov', 'IT Director', 'Gotbootstrap Inc.', '+7 904-982-2173', 'Одинцово, М.Неделина, д.15'),
(3, 3, 'Dr. John', 'Cook PhD', 'Human Resources', 'IT Manager', '+1 313-779-1347', '69 Smyth Rd, Detroit, MI, 48341, USA'),
(4, 4, 'Jim', 'Ketty', 'Staff Orgnizer', 'Staff Orgnizer', '+7 313-779-1347', '34 Tasy Rd, Detroit, MI, 48212, USA'),
(5, 5, 'Миша', 'Носов', 'Агротехническое', 'Фермер', '2523523235', 'Сибирячиха'),
(6, 6, 'Ангелина', 'Колокольчик', 'ПТУ', 'Помощник директора', '4567890', 'Восточные Королевства, Штормград 15'),
(7, 7, 'Сергей', 'Лавров', 'МГИМО', 'Министр', '7808789798', 'Подрезки'),
(8, 8, 'Ряпушек', 'Наталья', 'Гнесинка', 'Пивец', '56789', 'Малайзия'),
(9, 9, 'Некто', 'Граждинин Н', '', '', '34645756868', '');

-- --------------------------------------------------------

--
-- Структура таблицы `user_privacy`
--

CREATE TABLE `user_privacy` (
  `user_id` int(11) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `passwrd` varchar(150) DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Отошел',
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_privacy`
--

INSERT INTO `user_privacy` (`user_id`, `email`, `passwrd`, `status`, `role`) VALUES
(1, 'nds09@yandex.ru', '$2y$10$P..Vik6KkwrnmybrPEbW0eMZnb/FBg8.EK3ZaNQ0f2fZld6URzaLC', 'Онлайн', 'admin'),
(2, 'papa@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(3, 'z@stakancik.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(4, 'jim.ketty@gmail.com', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'admin'),
(5, 'nds1@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(6, 'lavrov@ministr.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(7, 'rypa@google.com', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(8, 'dad@rambler.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user'),
(9, 'people@yandex.ru', '$2y$10$KXFmta8hm7WhZXIsnyGp2u/b4sBchd1KY/xCpvLY/ydOiijKxryla', 'Онлайн', 'user');

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
(1, 1, 'vk.com/go2up', 't.com/go2up', 'instagram.com/go2up'),
(2, 2, 'vk.com/kop', 't.com/kop', 'instagram.com/kop'),
(3, 3, 'vk.com/John', 't.com/John', 'instagram.com/John'),
(4, 4, 'vk.com/ketty', 't.com/ketty', 'instagram.com/ketty'),
(5, 5, 'vk.com/kur', 't.com/kur', 'instagram.com/kur'),
(6, 6, 'vk.com/kur', 't.com/kur', 'instagram.com/kur'),
(7, 7, 'vk.com/kur', 't.com/kur', 'instagram.com/kur'),
(8, 8, 'vk.com/kur', 't.com/kur', 'instagram.com/kur'),
(9, 9, 'vk.com/kur', 't.com/kur', 'instagram.com/kur');

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
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  ADD PRIMARY KEY (`user_id`);

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
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `user_img`
--
ALTER TABLE `user_img`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_privacy`
--
ALTER TABLE `user_privacy`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `user_smm`
--
ALTER TABLE `user_smm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
