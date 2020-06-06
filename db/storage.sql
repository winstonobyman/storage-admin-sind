-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Июн 02 2020 г., 00:12
-- Версия сервера: 10.1.32-MariaDB
-- Версия PHP: 7.2.5
-- DB BACKUP

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `storage`
--

-- --------------------------------------------------------

--
-- Структура таблицы `client`
--

CREATE TABLE `client` (
  `ClientID` int(10) UNSIGNED NOT NULL,
  `Company` text NOT NULL,
  `Address` text NOT NULL,
  `Phone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `client`
--

INSERT INTO `client` (`ClientID`, `Company`, `Address`, `Phone`) VALUES
(1, 'Horns2', 'Field of wonder - Поле', '032'),
(2, 'Имя новое', 'ул Ибрагимова', '912312');

-- --------------------------------------------------------

--
-- Структура таблицы `countfact`
--

CREATE TABLE `countfact` (
  `CountID` int(10) UNSIGNED NOT NULL,
  `DateStart` date NOT NULL,
  `Sum` int(11) NOT NULL,
  `Cash` tinyint(1) NOT NULL,
  `ClientID` int(10) UNSIGNED NOT NULL,
  `WorkerID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `countfact`
--

INSERT INTO `countfact` (`CountID`, `DateStart`, `Sum`, `Cash`, `ClientID`, `WorkerID`) VALUES
(1, '2019-06-29', 200, 1, 1, 2),
(2, '0000-00-00', 34124, 0, 2, 2),
(3, '0000-00-00', 34124, 0, 2, 2),
(4, '0000-00-00', 34124, 0, 2, 2),
(5, '0000-00-00', 34124, 0, 2, 2),
(6, '0000-00-00', 34124, 0, 2, 2),
(7, '0000-00-00', 34124, 0, 2, 2),
(8, '0000-00-00', 34124, 0, 2, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `good`
--

CREATE TABLE `good` (
  `GoodID` int(10) UNSIGNED NOT NULL,
  `Name` text NOT NULL,
  `International` text NOT NULL,
  `Begin` date NOT NULL,
  `End` date NOT NULL,
  `NumberYes` int(11) NOT NULL,
  `DateYes` date NOT NULL,
  `Producer` text NOT NULL,
  `Instructions` text NOT NULL,
  `Batch` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `good`
--

INSERT INTO `good` (`GoodID`, `Name`, `International`, `Begin`, `End`, `NumberYes`, `DateYes`, `Producer`, `Instructions`, `Batch`) VALUES
(1, 'Печенье \"ОРИОН\"', 'https://im0-tub-ru.yandex.net/i?id=ef6e6f6b953715da8024c4d13699634c-l&n=13', '2019-06-09', '2019-12-29', 466440, '2000-06-03', 'Хозяюшка ООО', 'Хранить долго и счастливо', 'Целлофан'),
(2, 'Валерианы настройка', 'http://www.playcast.ru/uploads/2019/01/17/26496461.png', '2019-06-02', '2019-06-29', 465443, '2011-02-12', 'Хозяюшка ООО', 'Употреблять только в растворе', 'Стекло ');

-- --------------------------------------------------------

--
-- Структура таблицы `invoicein`
--

CREATE TABLE `invoicein` (
  `InvoiceInID` int(10) UNSIGNED NOT NULL,
  `GoodID` int(11) UNSIGNED NOT NULL,
  `SellerID` int(11) UNSIGNED NOT NULL,
  `Date` date NOT NULL,
  `Price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `invoicein`
--

INSERT INTO `invoicein` (`InvoiceInID`, `GoodID`, `SellerID`, `Date`, `Price`) VALUES
(1, 1, 1, '2019-07-18', 1200),
(2, 2, 2, '0000-00-00', 1983),
(3, 2, 3, '2000-01-23', 1994),
(4, 1, 1, '0000-00-00', 1989),
(5, 1, 1, '2000-02-00', 2004),
(6, 2, 1, '0000-00-00', 1208),
(7, 2, 2, '2000-02-00', 2012);

-- --------------------------------------------------------

--
-- Структура таблицы `invoiceincountid`
--

CREATE TABLE `invoiceincountid` (
  `InvoiceInID` int(10) UNSIGNED NOT NULL,
  `CountID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `invoiceincountid`
--

INSERT INTO `invoiceincountid` (`InvoiceInID`, `CountID`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `invoiceout`
--

CREATE TABLE `invoiceout` (
  `InvoiceOutID` int(10) UNSIGNED NOT NULL,
  `CountID` int(10) UNSIGNED NOT NULL,
  `SalesmanID` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `invoiceout`
--

INSERT INTO `invoiceout` (`InvoiceOutID`, `CountID`, `SalesmanID`) VALUES
(1, 1, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `salesman`
--

CREATE TABLE `salesman` (
  `SalesManID` int(10) UNSIGNED NOT NULL,
  `SalesManName` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `salesman`
--

INSERT INTO `salesman` (`SalesManID`, `SalesManName`) VALUES
(1, 'Зиновьев'),
(2, 'Докторов'),
(3, 'ÐšÑƒÐ½Ð³ÑƒÑ€Ð¾Ð²'),
(4, 'ÐŸÐµÑ€ÐµÐ³ÑƒÐ´Ð¾Ð²');

-- --------------------------------------------------------

--
-- Структура таблицы `seller`
--

CREATE TABLE `seller` (
  `SellerId` int(11) UNSIGNED NOT NULL,
  `Name` text NOT NULL,
  `Address` text NOT NULL,
  `Phone` text NOT NULL,
  `INN` text NOT NULL,
  `Sign` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `seller`
--

INSERT INTO `seller` (`SellerId`, `Name`, `Address`, `Phone`, `INN`, `Sign`) VALUES
(1, 'Холмы и бурито', 'Москва, ул. Строителей, 12', '8(900)984-32-12', '6449013711', 1),
(2, 'Ранчо', 'Россия', '121983', '123812123', 0),
(3, 'Колбасы Беларуси', 'Республика Беларусь', '17391236', '73913817', 1),
(4, 'Ð Ð¾Ð³Ð° Ð¸ ÐºÐ¾Ð¿Ñ‹Ñ‚Ñ†Ñ‹', 'Ð›Ð¾Ð·Ð²Ñ‹', '81023891', '983491311', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `login` text NOT NULL,
  `password` text NOT NULL,
  `salt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`login`, `password`, `salt`) VALUES
('11', '21fb444d0787345b4884329efeacf7c7', '1tp'),
('i1', '8ebb0c4f829ffffd47b58b385d1f9766', 'm5y'),
('Ivan', '1c2a32940f9a44b19612e820f93f30e5', '00o');

-- --------------------------------------------------------

--
-- Структура таблицы `worker`
--

CREATE TABLE `worker` (
  `WorkerID` int(10) UNSIGNED NOT NULL,
  `Worker` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `worker`
--

INSERT INTO `worker` (`WorkerID`, `Worker`) VALUES
(1, 'Зиновьев'),
(2, 'Докторов'),
(3, 'Ð”Ð¾Ð³ÑƒÑ€Ð¾Ð²'),
(4, 'Ð”Ð¾Ñ€Ð¾Ð³Ð¾Ð²ÑÐºÐ¸Ð¹');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`ClientID`);

--
-- Индексы таблицы `countfact`
--
ALTER TABLE `countfact`
  ADD PRIMARY KEY (`CountID`),
  ADD KEY `fk_workerid` (`WorkerID`),
  ADD KEY `fk_countfact` (`ClientID`);

--
-- Индексы таблицы `good`
--
ALTER TABLE `good`
  ADD PRIMARY KEY (`GoodID`);

--
-- Индексы таблицы `invoicein`
--
ALTER TABLE `invoicein`
  ADD PRIMARY KEY (`InvoiceInID`),
  ADD KEY `fk_goodid` (`GoodID`),
  ADD KEY `fk_sellerid` (`SellerID`);

--
-- Индексы таблицы `invoiceincountid`
--
ALTER TABLE `invoiceincountid`
  ADD UNIQUE KEY `un_count` (`CountID`),
  ADD UNIQUE KEY `un_in` (`InvoiceInID`);

--
-- Индексы таблицы `invoiceout`
--
ALTER TABLE `invoiceout`
  ADD PRIMARY KEY (`InvoiceOutID`),
  ADD KEY `fk_salesman` (`SalesmanID`),
  ADD KEY `fk_out_countfact` (`CountID`);

--
-- Индексы таблицы `salesman`
--
ALTER TABLE `salesman`
  ADD PRIMARY KEY (`SalesManID`);

--
-- Индексы таблицы `seller`
--
ALTER TABLE `seller`
  ADD PRIMARY KEY (`SellerId`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`login`(20));

--
-- Индексы таблицы `worker`
--
ALTER TABLE `worker`
  ADD PRIMARY KEY (`WorkerID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `client`
--
ALTER TABLE `client`
  MODIFY `ClientID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `countfact`
--
ALTER TABLE `countfact`
  MODIFY `CountID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `good`
--
ALTER TABLE `good`
  MODIFY `GoodID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `invoicein`
--
ALTER TABLE `invoicein`
  MODIFY `InvoiceInID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `invoiceout`
--
ALTER TABLE `invoiceout`
  MODIFY `InvoiceOutID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `salesman`
--
ALTER TABLE `salesman`
  MODIFY `SalesManID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `seller`
--
ALTER TABLE `seller`
  MODIFY `SellerId` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `worker`
--
ALTER TABLE `worker`
  MODIFY `WorkerID` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `countfact`
--
ALTER TABLE `countfact`
  ADD CONSTRAINT `fk_countfact` FOREIGN KEY (`ClientID`) REFERENCES `client` (`ClientID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_workerid` FOREIGN KEY (`WorkerID`) REFERENCES `worker` (`WorkerID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `invoicein`
--
ALTER TABLE `invoicein`
  ADD CONSTRAINT `fk_goodid` FOREIGN KEY (`GoodID`) REFERENCES `good` (`GoodID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_sellerid` FOREIGN KEY (`SellerID`) REFERENCES `seller` (`SellerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `invoiceincountid`
--
ALTER TABLE `invoiceincountid`
  ADD CONSTRAINT `count_fk` FOREIGN KEY (`CountID`) REFERENCES `countfact` (`CountID`),
  ADD CONSTRAINT `in_fk` FOREIGN KEY (`InvoiceInID`) REFERENCES `invoicein` (`InvoiceInID`);

--
-- Ограничения внешнего ключа таблицы `invoiceout`
--
ALTER TABLE `invoiceout`
  ADD CONSTRAINT `fk_out_countfact` FOREIGN KEY (`CountID`) REFERENCES `countfact` (`CountID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_salesman` FOREIGN KEY (`SalesmanID`) REFERENCES `salesman` (`SalesManID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
