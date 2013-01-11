-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 01 月 09 日 19:56
-- 服务器版本: 5.5.24-log
-- PHP 版本: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `library`
--

-- --------------------------------------------------------

--
-- 表的结构 `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `bnumber` varchar(20) NOT NULL,
  `bname` varchar(20) NOT NULL,
  `status` enum('avail.','unavail.') CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `bamount` int(4) NOT NULL,
  `writer` varchar(20) NOT NULL,
  `press` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`bnumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `book`
--

INSERT INTO `book` (`bnumber`, `bname`, `status`, `bamount`, `writer`, `press`, `type`) VALUES
('11111', 'MySQL', 'avail.', 4, 'John', 'Tuling', '1');

-- --------------------------------------------------------

--
-- 表的结构 `borrow`
--

CREATE TABLE IF NOT EXISTS `borrow` (
  `reader_name` varchar(20) NOT NULL,
  `book_num` varchar(20) NOT NULL,
  `date_borrow` date NOT NULL,
  `date_return` date NOT NULL,
  KEY `book_num` (`book_num`),
  KEY `reader_name` (`reader_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `borrow`
--

INSERT INTO `borrow` (`reader_name`, `book_num`, `date_borrow`, `date_return`) VALUES
('zcc', '11111', '2013-01-10', '2013-01-17');

-- --------------------------------------------------------

--
-- 表的结构 `reader`
--

CREATE TABLE IF NOT EXISTS `reader` (
  `rname` varchar(20) NOT NULL,
  `rnumber` varchar(10) CHARACTER SET utf16 COLLATE utf16_unicode_ci NOT NULL,
  `ramount` int(4) NOT NULL,
  `rpass` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  KEY `ix_reader_name` (`rname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `reader`
--

INSERT INTO `reader` (`rname`, `rnumber`, `ramount`, `rpass`) VALUES
('zcc', '20106613', 15, '1234'),
('echo', '20101234', 8, '12345'),
('eva', '11111', 15, '1234');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `type` enum('1','2') NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`name`, `password`, `type`) VALUES
('abc', '1234', '1');

--
-- 限制导出的表
--

--
-- 限制表 `borrow`
--
ALTER TABLE `borrow`
  ADD CONSTRAINT `borrow_ibfk_1` FOREIGN KEY (`book_num`) REFERENCES `book` (`bnumber`),
  ADD CONSTRAINT `borrow_ibfk_3` FOREIGN KEY (`reader_name`) REFERENCES `reader` (`rname`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
