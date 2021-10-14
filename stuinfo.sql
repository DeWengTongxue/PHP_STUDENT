-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1:3306
-- 生成日期： 2021-10-10 12:36:23
-- 服务器版本： 5.7.31
-- PHP 版本： 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `stuinfo`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(20) NOT NULL COMMENT '账号',
  `password` varchar(20) CHARACTER SET latin1 NOT NULL COMMENT '密码',
  `administrator` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`, `administrator`) VALUES
(1, 'admin', 'admin', 1),
(2, 'root', '123456', 1),
(3, 'lzb', '010203', 1),
(8, 'lll', '123456', 0),
(37, 'llx', '123456', 1),
(50, 'qwer', 'qwer', 0);

-- --------------------------------------------------------

--
-- 表的结构 `stuinfo`
--

DROP TABLE IF EXISTS `stuinfo`;
CREATE TABLE IF NOT EXISTS `stuinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(5) DEFAULT NULL,
  `sex` char(1) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `phone_number` char(11) DEFAULT NULL,
  `birthday` date NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `student_id` int(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `student_id` (`student_id`)
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stuinfo`
--

INSERT INTO `stuinfo` (`id`, `name`, `sex`, `age`, `phone_number`, `birthday`, `time`, `student_id`) VALUES
(9, '谭杰', '女', 15, '15312345678', '2000-06-01', '2021-08-27 07:20:22', 1),
(10, '周怡', '女', 18, '13342540233', '2000-06-02', '2021-07-28 05:44:53', 1),
(12, '吴源辉', '女', 17, '17674724758', '2000-06-02', '2021-08-11 11:48:51', 1),
(13, '曾勇', '女', 17, '15913907442', '2000-06-02', '2021-08-11 11:49:04', 1),
(14, '李玉', '女', 17, '12345678910', '2000-06-02', '2021-07-28 05:44:53', 1),
(16, '李蔓琳', '女', 18, '19974731646', '2000-06-02', '2021-07-28 05:44:53', 1),
(17, '毛良文', '男', 17, '15576737599', '2000-06-02', '2021-07-28 05:44:53', 1),
(19, '李文彬', '男', 17, '15512345678', '2000-06-02', '2021-07-28 05:44:53', 1),
(20, '黄伟', '男', 18, '12345678916', '2000-06-02', '2021-07-28 05:44:53', 1),
(97, '廖某某', '男', 15, '15913907442', '2021-08-06', '2021-07-28 16:14:27', 1),
(98, '廖某某', '男', 11, '15913907442', '2021-07-09', '2021-07-28 16:16:31', 1),
(99, '廖某某', '女', 15, '15312345678', '2000-06-01', '2021-08-27 07:32:17', 8),
(100, '廖槟', '女', 15, '15913907442', '2021-08-12', '2021-08-27 07:04:55', 1);

--
-- 限制导出的表
--

--
-- 限制表 `stuinfo`
--
ALTER TABLE `stuinfo`
  ADD CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
