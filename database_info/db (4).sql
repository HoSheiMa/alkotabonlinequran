-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 25 يوليو 2019 الساعة 06:35
-- إصدار الخادم: 5.7.24
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- بنية الجدول `admininfo`
--

DROP TABLE IF EXISTS `admininfo`;
CREATE TABLE IF NOT EXISTS `admininfo` (
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `admininfo`
--

INSERT INTO `admininfo` (`email`, `permission`) VALUES
('admin@admin.co', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]'),
('', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]'),
('testadmin@admin.co', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]'),
('testadmin@admin.co', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]'),
('VSS@vss.co', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]'),
('VSSADMIN@admin.co', '[\"Dashboard\",\"Students\",\"Teachers\",\"Meets\", \"Admins-Access\", \"money-Cashing\", \"Deals\", \"Links\"]');

-- --------------------------------------------------------

--
-- بنية الجدول `deals`
--

DROP TABLE IF EXISTS `deals`;
CREATE TABLE IF NOT EXISTS `deals` (
  `id` text COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `info` text COLLATE utf8_unicode_ci NOT NULL,
  `Salary` text COLLATE utf8_unicode_ci NOT NULL,
  `hours` text COLLATE utf8_unicode_ci NOT NULL,
  `json_data` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `deals`
--

INSERT INTO `deals` (`id`, `title`, `info`, `Salary`, `hours`, `json_data`) VALUES
('id_43985141', 'new', 'new', 'new', 'new', '[]'),
('id_95707327', 'title2', 'info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2info2 info2', '2', '20', '[]');

-- --------------------------------------------------------

--
-- بنية الجدول `meets`
--

DROP TABLE IF EXISTS `meets`;
CREATE TABLE IF NOT EXISTS `meets` (
  `IDTeacter` text COLLATE utf8_unicode_ci NOT NULL,
  `IDFrom` text COLLATE utf8_unicode_ci NOT NULL,
  `state` text COLLATE utf8_unicode_ci NOT NULL,
  `TimZone` text COLLATE utf8_unicode_ci NOT NULL,
  `Time` text COLLATE utf8_unicode_ci NOT NULL,
  `Day` text COLLATE utf8_unicode_ci NOT NULL,
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  `DateOFNow` text COLLATE utf8_unicode_ci NOT NULL,
  `ID` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- بنية الجدول `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE IF NOT EXISTS `menu` (
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `id` text COLLATE utf8_unicode_ci NOT NULL,
  `type` text COLLATE utf8_unicode_ci NOT NULL,
  `code` text COLLATE utf8_unicode_ci NOT NULL,
  `visible` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `menu`
--

INSERT INTO `menu` (`title`, `id`, `type`, `code`, `visible`, `keywords`, `description`) VALUES
('google', 'id_2314225104', 'External_link', 'https://www.google.com', 'on', 'google', 'google'),
('new', 'id_692577282', 'Internal_link', '<h1><u>Write You contents here!</u></h1><p>sadasjfoasfas  sadasjfoasfas fas fasojfoas sadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoassadasjfoasfas fas fasojfoasfas fasojfoas</p>', 'on', 'new', 'new');

-- --------------------------------------------------------

--
-- بنية الجدول `recovery`
--

DROP TABLE IF EXISTS `recovery`;
CREATE TABLE IF NOT EXISTS `recovery` (
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `key` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `recovery`
--

INSERT INTO `recovery` (`email`, `key`) VALUES
('testlogin@gmail.com', 'key5cf03dd0a65f65.71776075'),
('qandilafa@gmail.com', 'key5cf041b765b2a2.72216219');

-- --------------------------------------------------------

--
-- بنية الجدول `rooms`
--

DROP TABLE IF EXISTS `rooms`;
CREATE TABLE IF NOT EXISTS `rooms` (
  `Rooms_link` text COLLATE utf8_unicode_ci NOT NULL,
  `Teacher` text COLLATE utf8_unicode_ci NOT NULL,
  `standen` text COLLATE utf8_unicode_ci NOT NULL,
  `ID_Meet` text COLLATE utf8_unicode_ci NOT NULL,
  `teacherPeerId` text COLLATE utf8_unicode_ci NOT NULL,
  `studentPeerId` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `rooms`
--

INSERT INTO `rooms` (`Rooms_link`, `Teacher`, `standen`, `ID_Meet`, `teacherPeerId`, `studentPeerId`) VALUES
('http://localhost/project5/liveroom/?roomId=6d0bhyv7adg00000&Teacher=sfa2d@aw.sf&idmeet=id_73072592', 'sfa2d@aw.sf', 'testlogin@gmail.com', 'id_73072592', 'y2zztncddbs00000', 'tu12jn6r12p00000'),
('http://localhost/project5/liveroom/?roomId=qyntfeiyyjl00000&Teacher=sfa2d@aw.sf&idmeet=id_34271923', 'sfa2d@aw.sf', 'testlogin@gmail.com', 'id_34271923', '6gkl85icvv000000', 'tp3c16mhtpi00000');

-- --------------------------------------------------------

--
-- بنية الجدول `toucherinfo`
--

DROP TABLE IF EXISTS `toucherinfo`;
CREATE TABLE IF NOT EXISTS `toucherinfo` (
  `ID` text COLLATE utf8_unicode_ci NOT NULL,
  `TimeactFrom` text COLLATE utf8_unicode_ci NOT NULL,
  `TimeactTo` text COLLATE utf8_unicode_ci NOT NULL,
  `ActWeek` text COLLATE utf8_unicode_ci NOT NULL,
  `Info` text COLLATE utf8_unicode_ci NOT NULL,
  `star` text COLLATE utf8_unicode_ci NOT NULL,
  `TimeZone` text COLLATE utf8_unicode_ci NOT NULL,
  `cv_images` text COLLATE utf8_unicode_ci NOT NULL,
  `Salary` text COLLATE utf8_unicode_ci NOT NULL,
  `TotalSalaryHaveNowFRomMeets` text COLLATE utf8_unicode_ci NOT NULL,
  `TotalSalaryDoneTake` text COLLATE utf8_unicode_ci NOT NULL,
  `SalaryHistoryTakeFromWeb` text COLLATE utf8_unicode_ci NOT NULL,
  `stars_history` text COLLATE utf8_unicode_ci NOT NULL,
  `Total_salary_history` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `toucherinfo`
--

INSERT INTO `toucherinfo` (`ID`, `TimeactFrom`, `TimeactTo`, `ActWeek`, `Info`, `star`, `TimeZone`, `cv_images`, `Salary`, `TotalSalaryHaveNowFRomMeets`, `TotalSalaryDoneTake`, `SalaryHistoryTakeFromWeb`, `stars_history`, `Total_salary_history`) VALUES
('Toc@gmail.com', '0am', '11pm', '[1,2,3]', 'Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..Info about teacher .. ! ..', '5', 'America/New_York', '[\"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\", \"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\", \"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\", \"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\", \"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\", \"https://ridgeway.church/wp-content/uploads/2014/12/full-bg-4.jpg\"]', '10', '40', '70', '[{\"DATE\":\"07-06-2019\",\"SalaryUsed\":\"15\"},{\"DATE\":\"08-06-2019\",\"SalaryUsed\":\"85\"},{\"DATE\":\"09-06-2019\",\"SalaryUsed\":\"115\"},{\"DATE\":\"11-06-2019\",\"SalaryUsed\":\"45\"},{\"DATE\":\"17-06-2019\",\"SalaryUsed\":\"75\"}]', '', '[{\"DATE\":\"17-06-2019\",\"SalaryTaked\":\"10\"}]'),
('sfa2d@aw.sf', '0am', '11pm', '[1,2,3,4,5,6,7]', 'sfa2d@aw.sf', '0', 'Africa/Cairo', '[\"./assets/5cee6d3d6435a8.60546683.jpg\",\"./assets/5cee6d3d646ba8.59769916.jpg\"]', '21', '105', '15', '[{\"DATE\":\"07-06-2019\",\"SalaryUsed\":\"15\"},{\"DATE\":\"08-06-2019\",\"SalaryUsed\":\"85\"},{\"DATE\":\"09-06-2019\",\"SalaryUsed\":\"115\"},{\"DATE\":\"11-06-2019\",\"SalaryUsed\":\"45\"},{\"DATE\":\"17-06-2019\",\"SalaryUsed\":\"75\"}]', '[]', '[{\"DATE\":\"17-06-2019\",\"SalaryTaked\":\"21\"},{\"DATE\":\"18-06-2019\",\"SalaryTaked\":\"21\"},{\"DATE\":\"18-06-2019\",\"SalaryTaked\":\"21\"},{\"DATE\":\"08-07-2019\",\"SalaryTaked\":\"21\"},{\"DATE\":\"08-07-2019\",\"SalaryTaked\":\"21\"}]');

-- --------------------------------------------------------

--
-- بنية الجدول `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `pass` text COLLATE utf8_unicode_ci NOT NULL,
  `name` text COLLATE utf8_unicode_ci NOT NULL,
  `profile_img` text COLLATE utf8_unicode_ci NOT NULL,
  `BLOCK_STATE` text COLLATE utf8_unicode_ci NOT NULL,
  `freeCoursestrial` text COLLATE utf8_unicode_ci,
  `BuyHoursInDeal` text COLLATE utf8_unicode_ci NOT NULL,
  `permission` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `users`
--

INSERT INTO `users` (`email`, `pass`, `name`, `profile_img`, `BLOCK_STATE`, `freeCoursestrial`, `BuyHoursInDeal`, `permission`) VALUES
('admin@admin.co', '12345678', 'ADMIN', './assets/5cf468458aa0c4.10671275.jpg', 'false', '[]', '0', '{ \"permission\" : \"admin-permission\" }'),
('testlogin@gmail.com', '12345678', 'testlogin', 'assets/default.png', 'false', '[\"Toc@gmail.com\",\"sfa2d@aw.sf\"]', '94', '{\"permission\" : \"No-admin-permission\" }'),
('Toc@gmail.com', '12345678', 'Toc', 'assets/default.png', 'false', '[]', '0', '{\"permission\" : \"Toucher-permission\" }'),
('sfa2d@aw.sf', 'sfa2d@aw.sf', 'sfa2d@aw.sf', 'assets/default.png', 'false', '[]', '0', '{\"permission\" : \"Toucher-permission\" }'),
('qandilafa@gmail.com', 'qandilafa@gmail.com', 'qandilafa@gmail.com', 'default.png', 'false', '[]', '0', '{\"permission\" : \"No-admin-permission\" }'),
('VSS@vss.co', 'VSS@vss.co', 'VSS@vss.co', 'assets/default.png', 'false', '[]', '0', '{\"permission\" : \"admin-permission\" }'),
('newadmin@admin.com', 'newadmin@admin.com', 'newadmin@admin.com', 'assets/default.png', 'false', '[]', '0', '{\"permission\" : \"admin-permission\" }'),
('VSSADMIN@admin.co', 'VSSADMIN@admin.co', 'ADMIN', 'assets/default.png', 'false', '[]', '0', '{ \"permission\" : \"admin-permission\" }');

-- --------------------------------------------------------

--
-- بنية الجدول `userslogin`
--

DROP TABLE IF EXISTS `userslogin`;
CREATE TABLE IF NOT EXISTS `userslogin` (
  `date` text COLLATE utf8_unicode_ci NOT NULL,
  `UserLoginToday` text COLLATE utf8_unicode_ci NOT NULL,
  `TeacherLoginToday` text COLLATE utf8_unicode_ci NOT NULL,
  `SalaryTakedTodayFromStudents` text COLLATE utf8_unicode_ci NOT NULL,
  `SalaryTakedTodayFromWebToTeachers` text COLLATE utf8_unicode_ci NOT NULL,
  `BookedMeetsToday` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `userslogin`
--

INSERT INTO `userslogin` (`date`, `UserLoginToday`, `TeacherLoginToday`, `SalaryTakedTodayFromStudents`, `SalaryTakedTodayFromWebToTeachers`, `BookedMeetsToday`) VALUES
('27-05-2019', '7', '0', '0', '0', '0'),
('28-05-2019', '2', '0', '0', '0', '0'),
('2019-05-28', '1', '0', '0', '0', '0'),
('29-05-2019', '1', '0', '0', '0', '0'),
('30-05-2019', '0', '1', '0', '0', '0'),
('31-05-2019', '2', '0', '0', '0', '0'),
('01-06-2019', '3', '0', '0', '0', '0'),
('02-06-2019', '4', '0', '0', '0', '0'),
('07-06-2019', '5', '0', '0', '0', '0'),
('10-06-2019', '3', '2', '0', '0', '0'),
('12-06-2019', '0', '1', '0', '0', '0'),
('16-06-2019', '1', '0', '0', '0', '0'),
('17-06-2019', '4', '3', '0', '0', '0'),
('18-06-2019', '3', '0', '0', '0', '0'),
('19-06-2019', '2', '0', '0', '0', '0'),
('08-07-2019', '1', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- بنية الجدول `web`
--

DROP TABLE IF EXISTS `web`;
CREATE TABLE IF NOT EXISTS `web` (
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `keywords` text COLLATE utf8_unicode_ci NOT NULL,
  `WebTitle` text COLLATE utf8_unicode_ci NOT NULL,
  `WebState` text COLLATE utf8_unicode_ci NOT NULL,
  `ico` text COLLATE utf8_unicode_ci NOT NULL,
  `Views` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- إرجاع أو استيراد بيانات الجدول `web`
--

INSERT INTO `web` (`description`, `keywords`, `WebTitle`, `WebState`, `ico`, `Views`) VALUES
('descriptionsad', 'keywords', 'title1', 'off', './assets/5cf345bbb35dc3.25213856.jpg', '[{\"date\":\"01-06-2019\",\"Views\":17},{\"date\":\"29-05-2019\",\"Views\":66},{\"date\":\"02-06-2019\",\"Views\":33},{\"date\":\"07-06-2019\",\"Views\":6},{\"date\":\"10-06-2019\",\"Views\":6},{\"date\":\"12-06-2019\",\"Views\":5},{\"date\":\"16-06-2019\",\"Views\":2},{\"date\":\"17-06-2019\",\"Views\":8},{\"date\":\"18-06-2019\",\"Views\":6},{\"date\":\"19-06-2019\",\"Views\":28},{\"date\":\"20-06-2019\",\"Views\":6},{\"date\":\"06-07-2019\",\"Views\":1},{\"date\":\"08-07-2019\",\"Views\":2},{\"date\":\"15-07-2019\",\"Views\":23}]');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
