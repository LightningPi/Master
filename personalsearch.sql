-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 
-- 伺服器版本: 5.6.21
-- PHP 版本： 5.5.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `personalsearch`
--

-- --------------------------------------------------------

--
-- 資料表結構 `ckip`
--

CREATE TABLE IF NOT EXISTS `ckip` (
`ck_id` int(255) NOT NULL,
  `ck_context` text COLLATE utf8_unicode_ci NOT NULL,
  `ck_type` int(255) NOT NULL COMMENT '1:前 2:後 3:所有字',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `re_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `ck_result`
--

CREATE TABLE IF NOT EXISTS `ck_result` (
`cr_id` int(255) NOT NULL,
  `cr_word` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `re_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `key_words`
--

CREATE TABLE IF NOT EXISTS `key_words` (
`k_id` int(255) NOT NULL,
  `k_word` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` double NOT NULL,
  `k_type` int(10) NOT NULL COMMENT '1:相關 2.不相關',
  `day` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1746 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `nkey_words`
--

CREATE TABLE IF NOT EXISTS `nkey_words` (
`nk_id` int(255) NOT NULL,
  `nk_word` text COLLATE utf8_unicode_ci NOT NULL,
  `day` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `rate_count`
--

CREATE TABLE IF NOT EXISTS `rate_count` (
`ra_id` int(255) NOT NULL,
  `ra_word` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `rate` float NOT NULL,
  `ra_type` int(10) NOT NULL COMMENT '1:相關 2:不相關 3:權重',
  `day` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=327258 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `result_ck`
--

CREATE TABLE IF NOT EXISTS `result_ck` (
`rc_id` int(255) NOT NULL,
  `rc_word` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=460809 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `result_order`
--

CREATE TABLE IF NOT EXISTS `result_order` (
`ro_id` int(255) NOT NULL,
  `ro_weight` int(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2030 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `result_relevance`
--

CREATE TABLE IF NOT EXISTS `result_relevance` (
`re_id` int(255) NOT NULL,
  `re_type` int(255) NOT NULL COMMENT '1:相關 2:不相關',
  `re_stage` int(10) NOT NULL COMMENT '1:紀錄排序高 2:驗證排序低',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sr_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2211 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `search_result`
--

CREATE TABLE IF NOT EXISTS `search_result` (
`sr_id` int(255) NOT NULL,
  `sr_title` text COLLATE utf8_unicode_ci,
  `sr_context` text COLLATE utf8_unicode_ci,
  `sr_url` text COLLATE utf8_unicode_ci,
  `day` date NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_id` int(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5956 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `user_feature`
--

CREATE TABLE IF NOT EXISTS `user_feature` (
`u_id` int(255) NOT NULL,
  `account` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `u_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `u_sex` int(10) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `ckip`
--
ALTER TABLE `ckip`
 ADD PRIMARY KEY (`ck_id`);

--
-- 資料表索引 `ck_result`
--
ALTER TABLE `ck_result`
 ADD PRIMARY KEY (`cr_id`), ADD KEY `cr_word` (`cr_word`,`re_id`), ADD KEY `re_id` (`re_id`);

--
-- 資料表索引 `key_words`
--
ALTER TABLE `key_words`
 ADD PRIMARY KEY (`k_id`);

--
-- 資料表索引 `nkey_words`
--
ALTER TABLE `nkey_words`
 ADD PRIMARY KEY (`nk_id`);

--
-- 資料表索引 `rate_count`
--
ALTER TABLE `rate_count`
 ADD PRIMARY KEY (`ra_id`), ADD KEY `ra_word` (`ra_word`), ADD KEY `u_id,day,ra_type` (`u_id`,`day`,`ra_type`);

--
-- 資料表索引 `result_ck`
--
ALTER TABLE `result_ck`
 ADD PRIMARY KEY (`rc_id`), ADD KEY `rc_word` (`rc_word`), ADD KEY `sr_id` (`sr_id`);

--
-- 資料表索引 `result_order`
--
ALTER TABLE `result_order`
 ADD PRIMARY KEY (`ro_id`), ADD KEY `sr_id` (`sr_id`);

--
-- 資料表索引 `result_relevance`
--
ALTER TABLE `result_relevance`
 ADD PRIMARY KEY (`re_id`), ADD KEY `sr_id` (`sr_id`);

--
-- 資料表索引 `search_result`
--
ALTER TABLE `search_result`
 ADD PRIMARY KEY (`sr_id`), ADD KEY `u_id,day` (`u_id`,`day`);

--
-- 資料表索引 `user_feature`
--
ALTER TABLE `user_feature`
 ADD PRIMARY KEY (`u_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `ckip`
--
ALTER TABLE `ckip`
MODIFY `ck_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=69;
--
-- 使用資料表 AUTO_INCREMENT `ck_result`
--
ALTER TABLE `ck_result`
MODIFY `cr_id` int(255) NOT NULL AUTO_INCREMENT;
--
-- 使用資料表 AUTO_INCREMENT `key_words`
--
ALTER TABLE `key_words`
MODIFY `k_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1746;
--
-- 使用資料表 AUTO_INCREMENT `nkey_words`
--
ALTER TABLE `nkey_words`
MODIFY `nk_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- 使用資料表 AUTO_INCREMENT `rate_count`
--
ALTER TABLE `rate_count`
MODIFY `ra_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=327258;
--
-- 使用資料表 AUTO_INCREMENT `result_ck`
--
ALTER TABLE `result_ck`
MODIFY `rc_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=460809;
--
-- 使用資料表 AUTO_INCREMENT `result_order`
--
ALTER TABLE `result_order`
MODIFY `ro_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2030;
--
-- 使用資料表 AUTO_INCREMENT `result_relevance`
--
ALTER TABLE `result_relevance`
MODIFY `re_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2211;
--
-- 使用資料表 AUTO_INCREMENT `search_result`
--
ALTER TABLE `search_result`
MODIFY `sr_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5956;
--
-- 使用資料表 AUTO_INCREMENT `user_feature`
--
ALTER TABLE `user_feature`
MODIFY `u_id` int(255) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- 已匯出資料表的限制(Constraint)
--

--
-- 資料表的 Constraints `ck_result`
--
ALTER TABLE `ck_result`
ADD CONSTRAINT `re_id` FOREIGN KEY (`re_id`) REFERENCES `result_relevance` (`re_id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
