-- phpMyAdmin SQL Dump
-- http://www.phpmyadmin.net
--
-- 生成日期: 2013 年 09 月 07 日 11:43

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- 数据库: `XWZGJnvbcLIPuatgrMBl`
--

-- --------------------------------------------------------

--
-- 表的结构 `alipay_order_list`
--

CREATE TABLE IF NOT EXISTS `alipay_order_list` (
  `id` int(10) NOT NULL auto_increment,
  `trade_id` varchar(32) NOT NULL,
  `trade_time` varchar(32) NOT NULL,
  `trade_title` varchar(128) NOT NULL,
  `trade_amout` double NOT NULL,
  `trade_buyer` varchar(64) NOT NULL,
  `trade_buyer_name` varchar(32) NOT NULL,
  `trade_hash` varchar(32) NOT NULL,
  `notify_time` timestamp NOT NULL default CURRENT_TIMESTAMP,
  `processed` tinyint(4) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=gbk AUTO_INCREMENT=22 ;
