-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Май 26 2022 г., 13:01
-- Версия сервера: 8.0.27
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `site_test1`
--
CREATE DATABASE IF NOT EXISTS `site_test1` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `site_test1`;

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `etst` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT T.surname, T.name, T.last_name, IFNULL(COUNT(T.id_lesson),0) as 'count' FROM selectteachers T 
WHERE T.date BETWEEN date_start and date_end
GROUP BY T.surname, T.name, T.last_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `GroupOnStud` (IN `student` INT)  BEGIN
 
SELECT G.id_group, G.number from `groups` G
JOIN `accounting` A on A.id_group = G.id_group
JOIN `students` S on A.id_student = S.id_student
WHERE S.id_student = student;
 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_students` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT S.id_student, S.surname, S.name, S.last_name, COUNT(V.id_visit) as 'count' FROM students S
LEFT JOIN visit V on S.id_student = V.id_student
WHERE V.date BETWEEN date_start and date_end
GROUP BY s.id_student, S.surname, S.name, S.last_name;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `proc_teachers` (IN `date_start` DATE, IN `date_end` DATE)  BEGIN

SELECT T.id_teacher, T.surname, T.name, T.last_name, IFNULL(COUNT(L.id_lesson),0) as 'count' FROM teachers T 
LEFT JOIN lessons L on T.id_teacher = L.id_teacher
WHERE L.date BETWEEN date_start and date_end
GROUP BY T.id_teacher, T.surname, T.name, T.last_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectLessonsGroupInWeek` (IN `id_group` INT, IN `date_start` DATE, IN `date_end` DATE, IN `les` INT)  SELECT * FROM `selectlessons` L
WHERE L.date BETWEEN date_start and date_end and L.id_group = id_group and L.name_l = les ORDER BY L.date, L.name_l$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectLessonsTeachInWeek` (IN `id_teacher` INT, IN `date_start` DATE, IN `date_end` DATE, IN `les` INT)  SELECT * FROM `selectlessons` L
WHERE L.date BETWEEN date_start and date_end and L.id_teacher = id_teacher and L.name_l = les ORDER BY L.date, L.name_l$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectStudInG` (IN `groupID` INT)  BEGIN  
       
SELECT DISTINCT S.id_student, S.surname, S.name, S.last_name, a.id_accounting, v.id_visit, v.id_lesson, l.id_timetable
from `students` S 
join `accounting` A on S.id_student = A.id_student
join `groups` G on A.id_group = G.id_group
left join `visit` V on S.id_student = V.id_student
left join `lessons` L on L.id_lesson = V.id_lesson
WHERE G.id_group = groupID;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectStudInNotG` (IN `id_group` INT)  BEGIN  
       
SELECT S.id_student, S.surname, S.name, S.last_name, A.id_accounting
from `students` S 
left join `accounting` A on S.id_student = A.id_student
WHERE A.id_group is null;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `selectTimeTeacher` (IN `id_teacher` INT)  SELECT TW.time FROM teachers T
JOIN `time_work` TW ON T.id_time_work = TW.id_time_work
WHERE T.id_teacher = id_teacher$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `accounting`
--

CREATE TABLE `accounting` (
  `id_accounting` int NOT NULL,
  `id_student` int NOT NULL,
  `id_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `accounting`
--

INSERT INTO `accounting` (`id_accounting`, `id_student`, `id_group`) VALUES
(103, 15, 2),
(108, 22, 2),
(110, 24, 2),
(117, 16, 2),
(118, 1, 2),
(126, 18, 31),
(127, 19, 31),
(128, 21, 31),
(129, 25, 31),
(130, 12, 2),
(131, 59, 33);

--
-- Триггеры `accounting`
--
DELIMITER $$
CREATE TRIGGER `setCountStudentAdd` BEFORE INSERT ON `accounting` FOR EACH ROW UPDATE `groups`
SET `count_students` = `count_students` + 1
WHERE id_group = NEW.id_group
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setCountStudentDel` BEFORE DELETE ON `accounting` FOR EACH ROW UPDATE `groups`
SET `count_students` = `count_students` - 1
WHERE id_group = OLD.id_group
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `admins`
--

CREATE TABLE `admins` (
  `id_admin` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `admins`
--

INSERT INTO `admins` (`id_admin`, `name`, `surname`, `last_name`, `login`, `password`) VALUES
(1, 'Admin', 'Super', 'root', 'root', '$2y$10$Ny.T1fjHDJN/Nrg.TfnhruS/X8TQSh.tl/cgdhWPMnpsZDlQDsND2');

-- --------------------------------------------------------

--
-- Структура таблицы `courses`
--

CREATE TABLE `courses` (
  `id_course` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(300) DEFAULT NULL,
  `count_groups` int DEFAULT '0',
  `price` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `courses`
--

INSERT INTO `courses` (`id_course`, `name`, `description`, `count_groups`, `price`) VALUES
(1, 'Конструирование', 'УЕНЦНЦГШШ', 4, 23),
(2, 'Компьютерная графика', NULL, 2, 32),
(3, 'Схемотехника', 'Какое-то описание', 0, 10),
(5, 'Программирование', NULL, 2, 21),
(18, 'Моделирование', 'Какое-то описание', 0, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

CREATE TABLE `groups` (
  `id_group` int NOT NULL,
  `number` varchar(5) NOT NULL,
  `count_students` int DEFAULT '0',
  `id_course` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`id_group`, `number`, `count_students`, `id_course`) VALUES
(2, '609', 6, 5),
(31, '278', 4, 1),
(33, '930', 1, 1),
(34, '877', 0, 2),
(35, '629', 0, 1),
(36, '297', 0, 5);

--
-- Триггеры `groups`
--
DELIMITER $$
CREATE TRIGGER `delAccountingForGroups` AFTER DELETE ON `groups` FOR EACH ROW DELETE FROM `accounting`
WHERE `id_group` = OLD.id_group
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setCount` BEFORE INSERT ON `groups` FOR EACH ROW UPDATE `courses`
SET `count_groups` = `count_groups` + 1
WHERE id_course = NEW.id_course
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setCountDel` AFTER DELETE ON `groups` FOR EACH ROW UPDATE `courses`
SET `count_groups` = `count_groups` - 1
WHERE id_course = OLD.id_course
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `lessons`
--

CREATE TABLE `lessons` (
  `id_lesson` int NOT NULL,
  `date` date NOT NULL,
  `id_timetable` int NOT NULL,
  `id_teacher` int NOT NULL,
  `id_group` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `lessons`
--

INSERT INTO `lessons` (`id_lesson`, `date`, `id_timetable`, `id_teacher`, `id_group`) VALUES
(84, '2022-05-25', 3, 22, 2),
(85, '2022-05-27', 1, 22, 2),
(86, '2022-05-24', 5, 24, 31),
(87, '2022-05-26', 6, 24, 31),
(88, '2022-04-09', 5, 22, 34),
(90, '2022-04-21', 1, 22, 33),
(91, '2022-05-26', 1, 27, 31),
(92, '2022-05-27', 2, 27, 33),
(93, '2022-04-27', 6, 27, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `pay`
--

CREATE TABLE `pay` (
  `id_pay` int NOT NULL,
  `date` date NOT NULL,
  `number_doc` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `summary` int NOT NULL,
  `id_student` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `pay`
--

INSERT INTO `pay` (`id_pay`, `date`, `number_doc`, `summary`, `id_student`) VALUES
(2, '2022-03-18', '3241', 12, 1),
(4, '2022-03-18', 'rwe', 1, 12),
(5, '2022-03-18', '2131', 213, 12),
(7, '2022-03-19', '2143', 10, 12),
(8, '2022-03-19', '123412', 1, 12),
(9, '2022-03-19', '12354', 21, 1),
(10, '2022-03-19', '2132', 100, 1),
(13, '2022-03-20', '123423', 32, 15),
(14, '2022-03-20', '23141412', 75, 16),
(16, '2022-03-20', '3214123123', 3, 18),
(17, '2022-03-20', '323435', 80, 19),
(18, '2022-03-20', '3243232', 56, 21),
(19, '2022-03-20', '222222', 22, 22),
(21, '2022-03-20', '21441', 102, 24),
(22, '2022-03-20', '21324', 55, 25),
(27, '2022-03-21', '2q3eweq', 50, 12),
(28, '2022-03-27', '3243354', 1000, 1),
(29, '2022-04-05', '34567', 300, 18),
(30, '2022-04-05', 'tyeruwio', 100, 1),
(31, '2022-04-10', 'ewrq', 5, 1),
(32, '2022-04-17', '32412', 123, 1),
(33, '2022-04-17', '1233333', 111, 1),
(34, '2022-04-17', '123123123123123', 11, 1),
(35, '2022-04-17', 'укуцкц', 33, 1);

--
-- Триггеры `pay`
--
DELIMITER $$
CREATE TRIGGER `setBalance` BEFORE INSERT ON `pay` FOR EACH ROW UPDATE `students`
SET `balance`= `balance` + NEW.summary
WHERE `id_student` = NEW.id_student
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `selectlessons`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `selectlessons` (
`date` date
,`id_group` int
,`id_lesson` int
,`id_teacher` int
,`last_name` varchar(30)
,`name` varchar(30)
,`name_l` int
,`name_t` varchar(30)
,`number` varchar(5)
,`surname` varchar(30)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `selectstudents`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `selectstudents` (
`count` bigint
,`id_student` int
,`last_name` varchar(50)
,`name` varchar(30)
,`surname` varchar(50)
);

-- --------------------------------------------------------

--
-- Дублирующая структура для представления `selectteachers`
-- (См. Ниже фактическое представление)
--
CREATE TABLE `selectteachers` (
`count` bigint
,`id_teacher` int
,`last_name` varchar(30)
,`name` varchar(30)
,`surname` varchar(30)
);

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

CREATE TABLE `students` (
  `id_student` int NOT NULL,
  `name` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `surname` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `balance` int DEFAULT '0',
  `phone` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `photo` varchar(80) DEFAULT NULL,
  `login` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`id_student`, `name`, `surname`, `last_name`, `balance`, `phone`, `mail`, `photo`, `login`, `password`) VALUES
(1, 'Даниил', 'Неретин', 'Александрович', 1348, '+375445753201', 'dneretin01@gmail.com', NULL, 'nertti', '$2y$10$pr3bBuVxWkIjduCxI8clpO2uC4RvLuqtBZq.JBvhWR4/m68Xw2VJi'),
(12, 'Анна', 'Титова', 'Дмитриевна', 244, '', '', NULL, 'tanntann', '$2y$10$baD/B47Jj4GCHVQhhusO8.l2t1MJV8z/36njoEcaZOtNZFVZbQK9S'),
(15, 'Денис', 'Кулак', 'Олегович', 11, 'Отсутствует', 'Отсутствует', NULL, 'lowr', '$2y$10$eT7M7xDRq3yfdVS0FCGmkORDDTz4r0dRWeJyZhCna6KlqQhmJU3rW'),
(16, 'Олег', 'Шидловский', 'Даниилович', 75, 'Отсутствует', 'Отсутствует', NULL, '3521', '$2y$10$hTyPa3b5CEDfIftUUtlgau8XJZYoXfN3KuKoYykipQ7yenrHOPpwS'),
(18, 'Глеб', 'Фролов', 'Валентинович', 280, 'Отсутствует', 'Отсутствует', NULL, '123123123', '$2y$10$YmUDnRunLcyvsD2YMNl1BeKqBbQ.rbKGwv722eIxD7DYw2Xfx89F.'),
(19, 'Дмитрий', 'Губин', 'Владиславович', 57, 'Отсутствует', 'Отсутствует', NULL, '234цкцуф', '$2y$10$3Ow708k0kcDmq2s0lzV1MOaHGLvZg36WLvMbgUzZUw7SrOamMcCCW'),
(21, 'Евгений', 'Котляренко', 'Сергеевич', 33, 'Отсутствует', 'Отсутствует', NULL, '123', '$2y$10$wWClKlnn1Pv.RKbX2GErduRbHpMGdlEZlB5z.IA1zfCOfC.zrckTG'),
(22, 'Валентин', 'Говако', 'Генадьевич', 1, 'Отсутствует', 'Отсутствует', NULL, 'шыгпуа', '$2y$10$2KZLikA6RSCs23E7En2xeeH6ArueNfn5l0uiD9Ptzbw3M1agEjhW6'),
(24, 'Кристина', 'Щекова', 'Ивановна', 102, 'Отсутствует', 'Отсутствует', NULL, 'выаполодлв', '$2y$10$4dZ7rMtzKF9qMTLrJG5E5.jDvSMM3/NyVZzZACnZ5vqI6vyR73MHG'),
(25, 'Мирослава', 'Тиханович', 'Ильична', 32, 'Отсутствует', 'Отсутствует', NULL, 'укцкгнфцл', '$2y$10$s7sFO8OjTI3OKFXmVFQvlOJ5KNm/A7fdpUbVBHahNSun3wLrCLGt6'),
(59, 'Эльвира', 'Шапокляк', 'Александровна', 0, NULL, NULL, NULL, 'цйуйуйу', '$2y$10$WG1kqJYONEXzSXz92EVXluZdRubzliDA6Rndp15.fjTBXOUHW8HBi');

--
-- Триггеры `students`
--
DELIMITER $$
CREATE TRIGGER `delPayStud` BEFORE DELETE ON `students` FOR EACH ROW DELETE FROM `pay`
WHERE `id_student` = OLD.id_student
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setCountStudentDelStudent` BEFORE DELETE ON `students` FOR EACH ROW DELETE FROM `accounting`
WHERE `id_student` = OLD.id_student
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

CREATE TABLE `teachers` (
  `id_teacher` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `description` varchar(500) DEFAULT NULL,
  `phone` varchar(13) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `photo` varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `id_time_work` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`id_teacher`, `name`, `surname`, `last_name`, `description`, `phone`, `photo`, `login`, `password`, `id_time_work`) VALUES
(22, 'Сергей', 'Денисов', 'Михайлович', 'OPISANIE', '+375445753201', NULL, 'den3201', '$2y$10$6yTGaezNoy2SVNQdbChkW.hAG9//QtTQfcv/DrsuoHBrbzxeK2DTG', 1),
(24, 'Иван', 'Чародеев', 'Андреевич', NULL, '+375295753201', NULL, 'char01', '$2y$10$oZmx0Wa1Af5INOTHrOXv3Oe8UgDbmUFJqS/1N1/DgYLdD/Om93Qha', 2),
(26, 'Алексей', 'Петрович', 'Александрович', NULL, '+375445754444', NULL, 'petr123', '$2y$10$0Zg3dVwcuQMAhiRpCGZskO7Z5BJEsLErdsHr1e03a1uycbkioLKCe', 2),
(27, 'Владислав', 'Грач', 'Андреевич', NULL, '', NULL, 'qwerty', '$2y$10$27Bft4i.6/eCj3r3ogVs8OUk8GBlzO51A1zOHGkBycI1MxGKiZVve', 1),
(28, 'Сергей', 'Шнуров', 'Иванович', NULL, '', NULL, 'цйуйцу', '$2y$10$OmjifhLBUajamrcSWJ7zAO5t9xRid3L8MH3K6mZ1UxBpl49bHPUBG', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `timetable`
--

CREATE TABLE `timetable` (
  `id_timetable` int NOT NULL,
  `name` int NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `timetable`
--

INSERT INTO `timetable` (`id_timetable`, `name`, `time_start`, `time_end`) VALUES
(1, 1, '10:00:00', '11:00:00'),
(2, 2, '11:00:00', '12:00:00'),
(3, 3, '13:30:00', '14:30:00'),
(4, 4, '14:30:00', '15:30:00'),
(5, 5, '16:00:00', '17:00:00'),
(6, 6, '17:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `time_work`
--

CREATE TABLE `time_work` (
  `id_time_work` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `time` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `time_work`
--

INSERT INTO `time_work` (`id_time_work`, `name`, `time`) VALUES
(1, 'Полставки', 6),
(2, 'Ставка', 12);

-- --------------------------------------------------------

--
-- Структура таблицы `visit`
--

CREATE TABLE `visit` (
  `id_visit` int NOT NULL,
  `date` date NOT NULL,
  `id_lesson` int NOT NULL,
  `id_student` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `visit`
--

INSERT INTO `visit` (`id_visit`, `date`, `id_lesson`, `id_student`) VALUES
(119, '2022-05-26', 87, 18),
(120, '2022-05-26', 87, 19),
(121, '2022-05-26', 87, 21),
(122, '2022-05-26', 87, 25);

--
-- Триггеры `visit`
--
DELIMITER $$
CREATE TRIGGER `setBalanceVisit` AFTER INSERT ON `visit` FOR EACH ROW UPDATE `students` S
JOIN `visit` V on S.id_student = V.id_student
JOIN `lessons` L on V.id_lesson = L.id_lesson
JOIN `groups` G on L.id_group = G.id_group
JOIN `courses` C on G.id_course = 
C.id_course
SET `balance`= `balance` - C.price
WHERE S.id_student = NEW.id_student
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `setBalanceVisitDel` BEFORE DELETE ON `visit` FOR EACH ROW UPDATE `students` S
JOIN `visit` V on S.id_student = V.id_student
JOIN `lessons` L on V.id_lesson = L.id_lesson
JOIN `groups` G on L.id_group = G.id_group
JOIN `courses` C on G.id_course = 
C.id_course
SET `balance`= `balance` + C.price
WHERE S.id_student = OLD.id_student
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура для представления `selectlessons`
--
DROP TABLE IF EXISTS `selectlessons`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `selectlessons`  AS SELECT `l`.`id_lesson` AS `id_lesson`, `c`.`name` AS `name`, `j`.`name` AS `name_l`, `g`.`id_group` AS `id_group`, `g`.`number` AS `number`, `l`.`date` AS `date`, `t`.`id_teacher` AS `id_teacher`, `t`.`surname` AS `surname`, `t`.`name` AS `name_t`, `t`.`last_name` AS `last_name` FROM ((((`lessons` `l` join `groups` `g` on((`l`.`id_group` = `g`.`id_group`))) join `courses` `c` on((`g`.`id_course` = `c`.`id_course`))) join `teachers` `t` on((`l`.`id_teacher` = `t`.`id_teacher`))) join `timetable` `j` on((`l`.`id_timetable` = `j`.`id_timetable`))) ;

-- --------------------------------------------------------

--
-- Структура для представления `selectstudents`
--
DROP TABLE IF EXISTS `selectstudents`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `selectstudents`  AS SELECT `s`.`id_student` AS `id_student`, `s`.`surname` AS `surname`, `s`.`name` AS `name`, `s`.`last_name` AS `last_name`, count(`v`.`id_visit`) AS `count` FROM (`students` `s` left join `visit` `v` on((`s`.`id_student` = `v`.`id_student`))) GROUP BY `s`.`id_student`, `s`.`surname`, `s`.`name`, `s`.`last_name` ;

-- --------------------------------------------------------

--
-- Структура для представления `selectteachers`
--
DROP TABLE IF EXISTS `selectteachers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `selectteachers`  AS SELECT `t`.`id_teacher` AS `id_teacher`, `t`.`surname` AS `surname`, `t`.`name` AS `name`, `t`.`last_name` AS `last_name`, count(`l`.`id_lesson`) AS `count` FROM (`teachers` `t` left join `lessons` `l` on((`t`.`id_teacher` = `l`.`id_teacher`))) GROUP BY `t`.`id_teacher`, `t`.`surname`, `t`.`name`, `t`.`last_name` ;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD PRIMARY KEY (`id_accounting`),
  ADD KEY `id_groups` (`id_group`),
  ADD KEY `id_student` (`id_student`);

--
-- Индексы таблицы `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id_course`),
  ADD UNIQUE KEY `UQ_name_course` (`name`);

--
-- Индексы таблицы `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id_group`),
  ADD UNIQUE KEY `UQ_number_group` (`number`),
  ADD KEY `id_course` (`id_course`);

--
-- Индексы таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id_lesson`),
  ADD KEY `id_groups` (`id_group`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `id_timetable` (`id_timetable`);

--
-- Индексы таблицы `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`),
  ADD KEY `id_student` (`id_student`);

--
-- Индексы таблицы `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD UNIQUE KEY `login` (`login`);

--
-- Индексы таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id_teacher`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `teachers_ibfk_1` (`id_time_work`);

--
-- Индексы таблицы `timetable`
--
ALTER TABLE `timetable`
  ADD PRIMARY KEY (`id_timetable`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `time_work`
--
ALTER TABLE `time_work`
  ADD PRIMARY KEY (`id_time_work`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `visit`
--
ALTER TABLE `visit`
  ADD PRIMARY KEY (`id_visit`),
  ADD KEY `id_lesson` (`id_lesson`),
  ADD KEY `id_student` (`id_student`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `accounting`
--
ALTER TABLE `accounting`
  MODIFY `id_accounting` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT для таблицы `admins`
--
ALTER TABLE `admins`
  MODIFY `id_admin` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `courses`
--
ALTER TABLE `courses`
  MODIFY `id_course` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT для таблицы `groups`
--
ALTER TABLE `groups`
  MODIFY `id_group` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id_lesson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT для таблицы `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT для таблицы `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT для таблицы `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id_teacher` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT для таблицы `timetable`
--
ALTER TABLE `timetable`
  MODIFY `id_timetable` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `time_work`
--
ALTER TABLE `time_work`
  MODIFY `id_time_work` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `visit`
--
ALTER TABLE `visit`
  MODIFY `id_visit` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `accounting`
--
ALTER TABLE `accounting`
  ADD CONSTRAINT `accounting_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `accounting_ibfk_2` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`id_course`) REFERENCES `courses` (`id_course`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id_group`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_ibfk_2` FOREIGN KEY (`id_teacher`) REFERENCES `teachers` (`id_teacher`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lessons_ibfk_3` FOREIGN KEY (`id_timetable`) REFERENCES `timetable` (`id_timetable`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pay`
--
ALTER TABLE `pay`
  ADD CONSTRAINT `pay_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_ibfk_1` FOREIGN KEY (`id_time_work`) REFERENCES `time_work` (`id_time_work`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ограничения внешнего ключа таблицы `visit`
--
ALTER TABLE `visit`
  ADD CONSTRAINT `visit_ibfk_2` FOREIGN KEY (`id_lesson`) REFERENCES `lessons` (`id_lesson`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `visit_ibfk_3` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
