-- phpMyAdmin SQL Dump
-- version 4.6.0
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2017 at 07:56 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `avjunky_vr`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text,
  `view_privilege` text NOT NULL,
  `modify_privilege` text NOT NULL,
  `delete_privilege` text NOT NULL,
  `special_privilege` text NOT NULL,
  `user_privilege` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`, `view_privilege`, `modify_privilege`, `delete_privilege`, `special_privilege`, `user_privilege`) VALUES
(1, 'Super Admin', 'Has all the capacity to update all the settings and it has no permission', 'category,common,errors,extension,inquiry,localisation,option,products,system,user_group,users,videos', 'category,common,errors,extension,inquiry,localisation,option,products,system,user_group,users,videos', 'category,common,errors,extension,inquiry,localisation,option,products,system,user_group,users,videos', 'category,common,errors,extension,inquiry,localisation,option,products,system,user_group,users,videos', 'user_group'),
(2, 'Public', 'Limited access only', 'clients,common,errors,products,system,user_group,users', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(12, 'users', 'Module to manage user'),
(25, 'contracts', 'Contract Module'),
(26, 'system', 'System Setting Module'),
(28, 'reports', 'reports module'),
(29, 'service', 'Project service management');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_system_variables`
--

CREATE TABLE `aauth_system_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `last_login_attempt` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `login_attempts` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `name`, `banned`, `last_login`, `last_activity`, `last_login_attempt`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `login_attempts`) VALUES
(1, 'admin@admin.com', '16cc30c777899db7c312e4c6fb09a15ee31cef16a1d8b9d13499d93df3ea134e', 'FLX', 0, NULL, NULL, '2016-04-20 11:00:00', NULL, NULL, NULL, '123456789', NULL, NULL, 1),
(2, 'rochellecanale11@gmail.com', '2946d64b4f742dcf6e56e60fd4642fad100c8954b0c159cb41e9f436357e412a', 'rycanale', 0, '2016-11-11 10:33:19', '2016-11-11 10:33:19', '2016-11-11 10:00:00', NULL, '2016-11-14 00:00:00', 'd0erLaQigA7Wu2jF', NULL, NULL, '10.0.0.43', NULL),
(21, 'jolo@flax.ph', '19734ea8719b37129c26f140278c3f33842e8670805bb607b7ec69c9a63fa677', 'jolowafu', 0, '2017-01-16 12:40:58', '2017-01-16 12:40:58', '2017-01-16 12:00:00', NULL, '2017-01-19 00:00:00', 'BA3kpPmZDNtsl4jY', NULL, NULL, '10.0.0.223', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users_info`
--

CREATE TABLE `aauth_users_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `contact_1` varchar(15) NOT NULL,
  `contact_2` varchar(15) DEFAULT NULL,
  `address_1` text NOT NULL,
  `address_2` text,
  `status` tinyint(4) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_users_info`
--

INSERT INTO `aauth_users_info` (`id`, `user_id`, `firstname`, `lastname`, `birthday`, `contact_1`, `contact_2`, `address_1`, `address_2`, `status`) VALUES
(1, 1, 'Rochelle', 'Canale', '2016-02-26', '5845454', '541545', 'Manila', 'Makati', 1),
(2, 2, 'Jewell', 'Canale', '2016-02-26', '54545442', '8454545', 'Cebu', 'Pampanga', 1),
(3, 14, 'Jerielle', 'Canale', '2015-11-23', '123123123', '234123423', 'Tondo Manila', 'Nepomuceno Quiapo', 1),
(4, 15, 'Jerielle', 'Canale', '2016-03-16', '312312321', '123133123', 'manila', 'cebu', 1),
(5, 16, 'Mary Jewell', 'Canale', '2016-03-06', '564545641', '564564564', 'Manila', 'Cebu', 1),
(6, 11, 'Symfony', 'Canale', '2016-03-16', '1231231232', '2131312', 'Manila1', 'Cebu Mactan', 1),
(7, 9, 'Rochelle', 'Canale', '2016-03-18', '1212121', '121212112', 'Manila', 'Cebu', 1),
(8, 17, 'Rochelle', 'Canale', '2016-03-16', '21431434', '423423434', 'Manila', 'Cebu', 1),
(9, 19, 'Miki', 'Terada', '2016-04-13', '324324234', '234234444', 'Manila', '', 1),
(10, 20, 'Maria Teresa ', 'Bernabe', '2016-04-30', '34234234', '23434443', 'Manila', 'Cebu', 1),
(11, 21, 'Ma. Reda Arlene ', 'Lintag', '2016-04-21', '312423423', '342343434', 'Manila', 'Cebu', 1),
(12, 22, 'Lilian ', 'Herrera', '2016-04-25', '2323432', '24323423', 'Manila', 'Cebu', 1),
(13, 23, ' Aileen', 'Manalo', '2016-04-27', '234234324', '234234324', 'Manila', 'Cebu', 1),
(14, 24, 'Mariel', 'Bermundo', '2016-04-19', '2324234', '2423423', 'Manila', 'Cebu', 1),
(15, 25, 'Melanie', 'Rodriquez', '2016-04-26', '2234234', '2342344', 'Manila', 'cebu', 1),
(16, 26, 'Kaori', 'Koda', '2016-04-23', '12312323', '12312323', 'Manila', 'Japan', 1),
(17, 27, 'Harrel', 'Lastomen', '2016-04-23', '2312312', '1231232', 'Manila', 'Cebu', 1),
(18, 28, 'Yukako', 'Sato', '2016-04-13', '23423423', '23423432', 'Manila 1', 'Cebu', 1),
(19, 29, 'Francesca Ezra', 'Gallo', '2016-04-30', '3324234', '3423434', 'Manila', 'Cebu', 1),
(20, 30, 'Jenefer', 'Masankay', '2016-04-30', '423423432', '324233444', 'Manila', 'Cebu', 1),
(21, 31, 'Christian Paul', 'Peralta', '2016-04-21', '23131233', '12312323', 'Manila', 'Cebu', 1),
(22, 21, 'Jolo', 'Peterson', '0000-00-00', '', '', '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(14, 2),
(15, 38),
(21, 1);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `actress`
--

CREATE TABLE `actress` (
  `id` int(11) NOT NULL,
  `category` text NOT NULL,
  `cover_image` varchar(255) NOT NULL,
  `ranking` int(11) NOT NULL,
  `view_count` int(11) NOT NULL,
  `is_featured` tinyint(4) NOT NULL,
  `status` int(11) NOT NULL,
  `artist_since` date NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actress`
--

INSERT INTO `actress` (`id`, `category`, `cover_image`, `ranking`, `view_count`, `is_featured`, `status`, `artist_since`, `date_added`, `date_modified`) VALUES
(1, '4', 'Images/test2.png', 2, 19, 1, 1, '0000-00-00', '0000-00-00 00:00:00', '2016-11-08 12:59:39'),
(2, '4', 'Images/test.png', 3, 6, 0, 1, '0000-00-00', '0000-00-00 00:00:00', '2016-11-11 17:57:14'),
(3, '0', 'Images/test2.png', 0, 0, 0, 1, '2016-10-07', '2016-10-07 12:29:15', '2016-10-27 12:34:51'),
(4, '89', 'Images/test.png', 0, 0, 0, 1, '2016-10-07', '2016-10-07 12:29:51', '2016-10-27 12:33:29');

-- --------------------------------------------------------

--
-- Table structure for table `actress_detail`
--

CREATE TABLE `actress_detail` (
  `actress_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `meta_description` text NOT NULL,
  `meta_tags` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actress_detail`
--

INSERT INTO `actress_detail` (`actress_id`, `language_id`, `name`, `description`, `meta_description`, `meta_tags`) VALUES
(1, 1, 'IKU SAKURAGI', '', '', ''),
(1, 2, '桜木郁', '', '', ''),
(2, 1, 'Kanon Yumesaki', '<p>Kanon Yumesaki</p>', '', ''),
(2, 2, '夢咲かのん', '<p>夢咲かのん</p>', '', ''),
(3, 1, 'Katrina Halili Jr', '', '', ''),
(3, 2, 'Jatrina Halili Jr', '', '', ''),
(4, 1, 'Katrina Halili', '', '', ''),
(4, 2, 'Jatrina Halili', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `actress_gallery`
--

CREATE TABLE `actress_gallery` (
  `id` int(11) NOT NULL,
  `actress_id` int(11) NOT NULL,
  `image` varchar(225) NOT NULL,
  `text_label` varchar(125) NOT NULL,
  `status` int(11) NOT NULL,
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `actress_gallery`
--

INSERT INTO `actress_gallery` (`id`, `actress_id`, `image`, `text_label`, `status`, `sort_order`) VALUES
(3, 4, 'mickey-mouse.jpg', 'adad', 0, 2),
(4, 2, 'Images/960pc.png', '', 1, 0),
(5, 2, 'Images/960.png', '', 1, 0),
(6, 2, 'Images/960px.png', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `av_category`
--

CREATE TABLE `av_category` (
  `id` int(11) NOT NULL,
  `en_keyword` varchar(225) NOT NULL,
  `jp_keyword` varchar(225) NOT NULL,
  `grouping` varchar(125) NOT NULL DEFAULT 'theme' COMMENT '//category, theme, content, actress',
  `type` varchar(25) NOT NULL DEFAULT '' COMMENT '//main or sub[for category group only] else '' ''',
  `status` int(11) NOT NULL DEFAULT '1',
  `sort_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_category`
--

INSERT INTO `av_category` (`id`, `en_keyword`, `jp_keyword`, `grouping`, `type`, `status`, `sort_order`) VALUES
(1, 'Pornstar', 'AV女優', 'category', 'main', 1, 0),
(2, 'Amateur', '素人', 'category', 'main', 1, 0),
(3, 'MILF', '熟女', 'category', 'main', 1, 0),
(4, 'Pornstar', 'AV女優', 'actress', 'sub', 1, 0),
(5, 'Amateur', 'AV女優素人', 'actress', 'sub', 1, 0),
(6, 'Mature', 'AV女優熟女', 'actress', 'sub', 1, 0),
(7, 'Slender', 'スレンダー', 'actress', 'sub', 1, 0),
(8, 'Nice Hips', '美尻', 'actress', 'sub', 1, 0),
(9, 'Nice Legs', '美脚', 'actress', 'sub', 1, 0),
(10, 'Nice Tits', ' 美乳', 'actress', 'sub', 1, 0),
(11, 'Young', 'ロリ系', 'actress', 'sub', 1, 0),
(12, 'Gal', ' ギャル', 'actress', 'sub', 1, 0),
(13, 'Glabrousness', 'パイパン', 'actress', 'sub', 1, 0),
(14, 'Sexy', 'セクシー', 'actress', 'sub', 1, 0),
(15, 'Foreigner', '外国人', 'actress', 'sub', 1, 0),
(16, 'Big Tits', '巨乳', 'actress', 'sub', 1, 0),
(17, 'Creampie', '中出し', 'content', '', 1, 0),
(18, 'Anal Sex', 'アナル', 'content', '', 1, 0),
(19, 'Handjob', '手コキ', 'content', '', 1, 0),
(20, 'Footjob', '足コキ', 'content', '', 1, 0),
(21, 'Masturbation', 'オナニー', 'content', '', 1, 0),
(22, 'Bukkake', ' ぶっかけ', 'content', '', 1, 0),
(23, 'Threesome', '3P', 'content', '', 1, 0),
(24, 'Orgy', '乱交', 'content', '', 1, 0),
(25, 'Tit wank', 'パイズリ', 'content', '', 1, 0),
(26, 'Lotion', 'ローション', 'content', '', 1, 0),
(27, 'Adult Toy', 'おもちゃ', 'content', '', 1, 0),
(28, 'Blowjob', 'フェラ抜き', 'content', '', 1, 0),
(29, 'Cowgirl', '騎乗位', 'content', '', 1, 0),
(30, 'Dogstyle', 'バック', 'content', '', 1, 0),
(31, 'Facesitting', '顔面騎乗', 'content', '', 1, 0),
(32, 'Cumshot', '口内射精', 'content', '', 1, 0),
(33, 'Squirting', '潮吹き', 'content', '', 1, 0),
(34, 'Lesbian', '具合わせ', 'content', '', 1, 0),
(35, 'Rimming', '尻コキ', 'content', '', 1, 0),
(36, 'Group Sex', '複数人', 'content', '', 1, 0),
(37, 'Reverse Cowgirl', '背面騎乗位', 'content', '', 1, 0),
(38, 'Deepthroat', 'イマラチオ', 'content', '', 1, 0),
(39, 'Standing doggy', '立ちバック', 'content', '', 1, 0),
(40, 'Pantyjob', '素股', 'content', '', 1, 0),
(41, 'Blowjob Gangbang', 'Wフェラ', 'content', '', 1, 0),
(42, '69', '69', 'content', '', 1, 0),
(43, 'Facial', '顔射', 'content', '', 1, 0),
(44, 'Hatsuura', '初裏', 'theme', '', 1, 0),
(45, 'POV', 'ハメ撮り', 'theme', '', 1, 0),
(46, 'Slut', '痴女', 'theme', '', 1, 0),
(47, 'Peeping', 'のぞき', 'theme', '', 1, 0),
(48, 'Lesbian', 'レズ', 'theme', '', 1, 0),
(49, 'Reveal', '露出', 'theme', '', 1, 0),
(50, 'Restraint', '拘束', 'theme', '', 1, 0),
(51, 'SM', 'SM', 'theme', '', 1, 0),
(52, 'Cheating', '不倫・浮気', 'theme', '', 1, 0),
(53, 'Teacher', '女教師', 'theme', '', 1, 0),
(54, 'OL', 'OL', 'theme', '', 1, 0),
(55, 'Cosplay', 'コスプレ', 'theme', '', 1, 0),
(56, 'Nurse', 'ナース', 'theme', '', 1, 0),
(57, 'Uniform', '制服', 'theme', '', 1, 0),
(58, 'Kimono', '和服', 'theme', '', 1, 0),
(59, 'Glasses', 'めがね', 'theme', '', 1, 0),
(60, 'Outdoors', '野外', 'theme', '', 1, 0),
(61, 'Clerk', '店員', 'theme', '', 1, 0),
(62, 'Bath', '風呂', 'theme', '', 1, 0),
(63, 'Shower', 'シャワー', 'theme', '', 1, 0),
(64, 'Driving', 'ドライブ', 'theme', '', 1, 0),
(65, 'Break', '調教', 'theme', '', 1, 0),
(66, 'Dance', 'ダンス', 'theme', '', 1, 0),
(67, 'Housekeeper', '家政婦', 'theme', '', 1, 0),
(68, 'Insurance Agent', '生保レディ', 'theme', '', 1, 0),
(69, 'Este', 'エステ', 'theme', '', 1, 0),
(70, 'Retirement', '引退', 'theme', '', 1, 0),
(71, 'Travel', '旅行', 'theme', '', 1, 0),
(72, 'Nurse', '介護士', 'theme', '', 1, 0),
(73, 'Sport', 'スポーツ', 'theme', '', 1, 0),
(74, 'Black', '黒人', 'theme', '', 1, 0),
(75, 'Hostess', 'キャバ嬢', 'theme', '', 1, 0),
(76, 'Pet', 'ペット', 'theme', '', 1, 0),
(77, 'Married', '人妻', 'theme', '', 1, 0),
(78, 'Interview', '面接', 'theme', '', 1, 0),
(79, 'Massage', 'マッサージ', 'theme', '', 1, 0),
(80, 'Custom', '風俗', 'theme', '', 1, 0),
(81, 'Secret Club', '秘密俱楽部', 'theme', '', 1, 0),
(82, 'Dating', 'デート', 'theme', '', 1, 0),
(83, 'Apron', 'エプロン', 'theme', '', 1, 0),
(84, 'school', '学園', 'theme', '', 1, 0),
(85, 'Drama', 'ドラマ', 'theme', '', 1, 0),
(86, 'SEX Dependency', 'SEX依存症', 'theme', '', 1, 0),
(87, 'Friend', '友達', 'theme', '', 1, 0),
(88, 'Sleeping', '夜這い', 'theme', '', 1, 0),
(89, 'Subjectivity', '主観', 'theme', '', 1, 0),
(90, 'Seduced women', 'ナンパ', 'theme', '', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `av_inquiry`
--

CREATE TABLE `av_inquiry` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `detail` text NOT NULL,
  `status` varchar(125) NOT NULL DEFAULT 'open' COMMENT '// close, open, ignore',
  `is_urgent` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_inquiry`
--

INSERT INTO `av_inquiry` (`id`, `user_id`, `title`, `detail`, `status`, `is_urgent`, `date_added`, `date_modified`) VALUES
(1, 1, 'Theres a problem with the video download', 'I cannot download the video? what should i do now?', 'close', 1, '2016-10-10 00:00:00', '2016-10-10 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `av_inquiry_reply`
--

CREATE TABLE `av_inquiry_reply` (
  `id` int(11) NOT NULL,
  `inquiry_id` int(11) NOT NULL,
  `reply_detail` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_group` varchar(125) NOT NULL DEFAULT 'member' COMMENT '//admin or member',
  `is_check` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_inquiry_reply`
--

INSERT INTO `av_inquiry_reply` (`id`, `inquiry_id`, `reply_detail`, `user_id`, `user_group`, `is_check`, `date_added`) VALUES
(1, 1, 'Please send me your email here', 1, 'admin', 0, '2016-10-10 00:00:00'),
(2, 1, 'Why? just fix the error. I want to download the video!', 1, 'member', 1, '2016-10-10 00:00:00'),
(3, 1, '<p>hello there? Are you having fun with the download now?</p>', 21, 'admin', 0, '2016-10-10 17:32:47');

-- --------------------------------------------------------

--
-- Table structure for table `av_review`
--

CREATE TABLE `av_review` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `review_type` varchar(125) NOT NULL DEFAULT 'video' COMMENT '// video or actress',
  `ref_id` int(11) NOT NULL COMMENT '//video id or actress id',
  `user_id` int(11) NOT NULL,
  `user_group` varchar(125) NOT NULL DEFAULT 'member' COMMENT '// admin or member',
  `username` varchar(125) NOT NULL COMMENT '// will be used if a user has been deleted',
  `title` varchar(225) NOT NULL,
  `review_description` text NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_review`
--

INSERT INTO `av_review` (`id`, `parent_id`, `review_type`, `ref_id`, `user_id`, `user_group`, `username`, `title`, `review_description`, `status`, `date_added`, `date_modified`) VALUES
(2, 0, 'video', 1, 2, 'admin', 'Admin', 'Peter piper', 'peter piper peck a peck the peter piper.', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 0, 'video', 1, 1, 'member', '', '', 'This is my sample post', 1, '2016-11-16 11:48:00', '0000-00-00 00:00:00'),
(4, 0, 'video', 1, 1, 'member', '', '', 'why whtttt', 1, '2016-11-16 11:49:29', '0000-00-00 00:00:00'),
(6, 2, 'video', 1, 1, 'member', '', '', 'helllo admin something went wrong', 1, '2016-11-16 11:50:40', '0000-00-00 00:00:00'),
(7, 2, 'video', 1, 1, 'member', '', '', 'hello admin something went wrong', 1, '2016-11-16 11:51:04', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `av_search`
--

CREATE TABLE `av_search` (
  `id` int(11) NOT NULL,
  `keyword` varchar(225) NOT NULL,
  `full_url` varchar(225) NOT NULL,
  `count_found` int(11) NOT NULL DEFAULT '0' COMMENT '// found during the search',
  `username` varchar(225) NOT NULL DEFAULT 'guest',
  `ip_address` varchar(125) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `av_video`
--

CREATE TABLE `av_video` (
  `id` int(11) NOT NULL,
  `video_grouping` varchar(225) NOT NULL DEFAULT 'vr' COMMENT '//future plan: merge of avjunky and vr',
  `video_duration` time NOT NULL COMMENT '//full video',
  `category` text NOT NULL,
  `theme` text NOT NULL,
  `scene_content` text NOT NULL,
  `actress` text NOT NULL,
  `banner_image` varchar(225) NOT NULL,
  `cover_image` varchar(225) NOT NULL,
  `poster_image` varchar(225) NOT NULL,
  `status` int(11) NOT NULL,
  `is_featured` tinyint(4) NOT NULL,
  `view_count` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_modified` datetime NOT NULL,
  `date_last_viewed` datetime NOT NULL,
  `added_by` varchar(125) NOT NULL,
  `updated_by` varchar(125) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video`
--

INSERT INTO `av_video` (`id`, `video_grouping`, `video_duration`, `category`, `theme`, `scene_content`, `actress`, `banner_image`, `cover_image`, `poster_image`, `status`, `is_featured`, `view_count`, `date_added`, `date_modified`, `date_last_viewed`, `added_by`, `updated_by`) VALUES
(1, 'vr', '01:11:05', '1', '46', '19,23', '1', 'Banners/OsDasSUUA4.jpg', 'Images/test2.png', 'Images/960px.png', 1, 1, 121, '2016-11-02 14:24:41', '2016-11-08 17:31:33', '0000-00-00 00:00:00', 'jolowafu', 'jolowafu'),
(2, 'vr', '01:11:05', '2', '44,54,57', '17,21', '0', 'Banners/v6UEFj1XOt.jpg', 'Images/test.png', 'Images/960px.png', 1, 0, 398, '2016-11-02 17:21:24', '2017-01-16 15:18:52', '0000-00-00 00:00:00', 'jolowafu', 'jolowafu');

-- --------------------------------------------------------

--
-- Table structure for table `av_video_detail`
--

CREATE TABLE `av_video_detail` (
  `video_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `title` varchar(225) NOT NULL,
  `description` text NOT NULL,
  `meta_tags` varchar(225) NOT NULL,
  `meta_description` varchar(225) NOT NULL COMMENT '//must be 56 - 186 charater'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video_detail`
--

INSERT INTO `av_video_detail` (`video_id`, `language_id`, `title`, `description`, `meta_tags`, `meta_description`) VALUES
(1, 1, 'Can man and woman be friends?', '<p>Hello</p>', '', 'Sample Me'),
(1, 2, 'Can man and woman be friends? JP', '', '', 'Sample Me JP'),
(2, 1, 'Love Scandal', '<p>"ゆとり世代"とか"さとり世代"とか言われる現代の若者ではあるが・・・その世代の女の子の『性生活』はいったいどんなもんなのだろうか！？そんな事やらを聞きトークをしながら、エッチな展開になるとあれ！？案外タンパクなの。。。？！と思わせてからの〜〜 おかわりSEXに継ぐおかわりSEXで男はもうタジタジです...３発も中出しするハメになりました。 勘弁してくださいよ〜笑</p>', '', ''),
(2, 2, 'Love Scandal', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `av_video_downloads`
--

CREATE TABLE `av_video_downloads` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `fullhd` varchar(225) NOT NULL,
  `hdlite` varchar(225) NOT NULL,
  `mobile` varchar(225) NOT NULL,
  `vr_download` varchar(255) NOT NULL,
  `gallery_zip` varchar(225) NOT NULL,
  `scene_zip` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video_downloads`
--

INSERT INTO `av_video_downloads` (`id`, `video_id`, `fullhd`, `hdlite`, `mobile`, `vr_download`, `gallery_zip`, `scene_zip`) VALUES
(1, 1, 'http://10.0.0.223/avjunky_vr/uploads/Videos/samples/sample_vid.mp4', '', '', '', '', ''),
(2, 2, 'http://10.0.0.223/avjunky_vr/uploads/Videos/samples/sample_vid.mp4', 'http://10.0.0.223/avjunky_vr/uploads/Videos/samples/test.mp4', 'http://10.0.0.223/avjunky_vr/uploads/Videos/samples/test.mp4', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `av_video_gallery`
--

CREATE TABLE `av_video_gallery` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `image` varchar(225) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video_gallery`
--

INSERT INTO `av_video_gallery` (`id`, `video_id`, `image`, `sort_order`, `status`) VALUES
(5, 1, 'Images/test.png', 0, 1),
(6, 1, 'Images/960px.png', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `av_video_location`
--

CREATE TABLE `av_video_location` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `clip_mp4` varchar(255) NOT NULL,
  `clip_webm` varchar(255) NOT NULL,
  `clip_ogv` varchar(255) NOT NULL,
  `clip_360_vr` varchar(255) NOT NULL,
  `full_mp4` varchar(255) NOT NULL,
  `full_webm` varchar(255) NOT NULL,
  `full_ogv` varchar(255) NOT NULL,
  `full_vr` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video_location`
--

INSERT INTO `av_video_location` (`id`, `video_id`, `clip_mp4`, `clip_webm`, `clip_ogv`, `clip_360_vr`, `full_mp4`, `full_webm`, `full_ogv`, `full_vr`) VALUES
(1, 1, 'http://avjunky_vr/uploads/Videos/samples/360.mp4', 'http://avjunky_vr/uploads/Videos/samples/360.webm', '', '', '', '', '', ''),
(2, 2, 'http://avjunky_vr/uploads/Videos/samples/360.mp4', 'http://avjunky_vr/uploads/Videos/samples/360.webm', '', 'http://avjunky_vr/uploads/Videos/samples/test.mp4', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `av_video_scenes`
--

CREATE TABLE `av_video_scenes` (
  `id` int(11) NOT NULL,
  `video_id` int(11) NOT NULL,
  `scene_id` int(11) NOT NULL,
  `image` varchar(225) NOT NULL,
  `time_scene` time NOT NULL COMMENT '//example : 00:00:00',
  `scene_title` varchar(125) NOT NULL,
  `hours` int(2) UNSIGNED ZEROFILL NOT NULL,
  `minutes` int(2) UNSIGNED ZEROFILL NOT NULL,
  `seconds` int(2) UNSIGNED ZEROFILL NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `av_video_scenes`
--

INSERT INTO `av_video_scenes` (`id`, `video_id`, `scene_id`, `image`, `time_scene`, `scene_title`, `hours`, `minutes`, `seconds`) VALUES
(7, 1, 19, 'Images/test.png', '00:00:00', '', 00, 00, 00),
(8, 1, 23, 'Images/test2.png', '00:00:00', '', 00, 00, 00),
(19, 2, 17, 'no_image.jpg', '00:00:00', '', 00, 00, 00),
(20, 2, 21, 'no_image.jpg', '00:00:00', '', 00, 00, 00);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `id` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('8c693981efdbe1f8012971728efcc3ef00ce7faa', '10.0.0.223', 1482202421, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323432313b),
('e184d51a95d5f136b5f01f84e9bb5f23ff93f709', '10.0.0.223', 1482202422, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323432323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('cf22fe90e2764b68f7a9ad80bb188257a7aeba1c', '10.0.0.223', 1482202424, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323432343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('049241abc17af9d38ef3951f1681e0e6bd933c2d', '10.0.0.223', 1482202428, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323432383b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d63757272656e745f766964656f5f706167657c733a313a2231223b),
('7dc12b09786172c901f1f7c1d3b95acf6e4013a2', '10.0.0.223', 1482202429, ''),
('2f419c9d0d5a8b16030fdabed9dc5d87dee572cf', '10.0.0.223', 1482202431, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323433313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d63757272656e745f766964656f5f706167657c733a313a2231223b),
('ca56f3c0d15d25ee1bbb1fffd46738216f08972d', '10.0.0.223', 1482202432, ''),
('34ee5e0410e74b5a51befa86038ad8a1c7b0fed1', '10.0.0.223', 1482202443, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323434333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d63757272656e745f766964656f5f706167657c733a313a2231223b),
('65706f04bae35bf579799a6f39d3be25379a5c0f', '10.0.0.223', 1482202443, ''),
('2ca92b37a4ab36fccaf0e65609db093a379865cb', '10.0.0.223', 1482202462, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230323436313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d63757272656e745f766964656f5f706167657c733a313a2231223b),
('3b278f6ed00bf92a4b982847da7c4355bcbfa815', '10.0.0.223', 1482202462, ''),
('3971e8bd053edeb0fd7007a96bd892fb52dff5e4', '10.0.0.223', 1482204309, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230343134333b63757272656e745f766964656f5f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('e16e8b7535a69044d1b9031256018b7a80bf2de1', '10.0.0.223', 1482204703, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230343730333b63757272656e745f766964656f5f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('eb3d39d31bb631424c91a4275931b990e12c6217', '10.0.0.223', 1482205399, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323230353234363b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b0e42a65e3368031552b830b328a060ccb7731d5', '10.0.0.223', 1482211596, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231313338313b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('56ed1e3282c49cfa250f88e03fd3552c154b5867', '10.0.0.223', 1482211955, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231313934393b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('2c70bfb76483444570d311fc21f05e8f17fbd033', '10.0.0.223', 1482212405, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231323330373b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b23bfea84dc1650ddc62697112543f253aa353ec', '10.0.0.223', 1482212886, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231323730393b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('5f8d991b1341807a0553d1dff00176a80780feba', '10.0.0.223', 1482214181, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231333839323b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('2bd8b95fcae6d7357e5f5e88800bf4b6ff8d3f1c', '10.0.0.223', 1482214925, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231343636343b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ffd6497f7a8b44651e871ab160a9ae50ceaba23e', '10.0.0.223', 1482215262, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231343937373b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('81133bb4e5a0a236b5f0ef63a99805da9a955978', '10.0.0.223', 1482215290, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231353239303b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('da51f49c75469195280c78ce6bb5c5b6e78851c7', '10.0.0.223', 1482215905, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231353631303b63757272656e745f766964656f5f706167657c733a313a2231223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('7535dd10802da2fa3a0ab2f4240ff20f7f2641c1', '10.0.0.223', 1482216239, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231363031333b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('9a77a7aed1bab935155d8e2225be35d39b56195b', '10.0.0.223', 1482216462, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231363336393b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('53be9b08b4825ea39d9a644542f87e4242cbf254', '10.0.0.223', 1482217022, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231363734393b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('5a10e35df39f1401d4dc398ca32a5e379727dd2b', '10.0.0.223', 1482217359, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231373036343b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4e23e25d87e618d1887ac0d083d55ffd34e65a8b', '10.0.0.223', 1482217558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231373530323b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('842a49be05bdc60b8c8a0ef53822b4f5e54245a4', '10.0.0.223', 1482218097, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323231383038373b63757272656e745f766964656f5f706167657c733a313a2232223b63757272656e745f616374726573735f706167657c733a313a2231223b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('579b87ee85b5895763aa207e65927d7c231379c2', '10.0.0.223', 1482370558, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323337303535373b736974655f6c616e677c733a323a22656e223b),
('7ba2386599eafa6b9d2ad99917175ff580d10b02', '10.0.0.223', 1482391184, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323339313138313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ca01743a2ebaa54c52b3d42e24c6696c4ebf4de3', '10.0.0.223', 1482396080, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438323339363038303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('8d74ac4cb647afe26932f46605d311d420f464f2', '10.0.0.223', 1483678901, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438333637383839343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('7bb446b8a040046f316f93f34f69ddc39366fcbf', '10.0.0.223', 1483680665, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438333638303636353b736974655f6c616e677c733a323a22656e223b),
('a97a1bb71e9849a43065509ec63b05e61b2cd401', '10.0.0.223', 1484537745, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533373733353b),
('401e8ce980df5c7ea25d90061295f399fe201938', '10.0.0.223', 1484537995, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533373735363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('66a78dec125d5c1fdb25ac964cc7a088c1da41fa', '10.0.0.223', 1484538062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ce58ad79d956462afcc341ab5f7905a6085e88bf', '10.0.0.223', 1484538062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('c3f2e1a2703853e78dfc6c3007d4c815281607a4', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('0d26b35f3855281d476e3da75652139c3405d19f', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('46748829ac63346114368cb91a320a5894047974', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('812c2b2b79fd491f96f20ad2455e0bf2dd8702b4', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4660413968619bbbc40dca776ab1e0b5cfe232ed', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('238dddc26f79012d61067df1bb1acb9384ddb1eb', '10.0.0.223', 1484538063, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('8efb5acc8ab378f33493ee6dd8928579af3356c4', '10.0.0.223', 1484538064, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('18d20b5981ef3c22c8ac74ac672b16bf8ad24a91', '10.0.0.223', 1484538064, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('055e072dd90b65323321283b8efa6d32aa5a3631', '10.0.0.223', 1484538312, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383036343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('3fd3eeed7325ddbb9888a61c0740e1b42e389fd9', '10.0.0.223', 1484538522, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('e3ffba5d0eb2a2a3ab89a7c2411337f12f34c683', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('07939c8d8e69813ed181dad6065801410b20e2bb', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('2d0e5443006604f6f9386c09cc956cae6e08d0d6', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b433d863427b253bc6faa45fd991420d4b528bea', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('39c779eaf184ad0216cc582dc9a55d1a3919fa3e', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('db3e5ba378636d15d7951b820bbeb20854231077', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('aff04ea19ab5a8ddd0ec99483ca49c9e38e371cc', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('40c2ddfadee009c334188627a37f8137f2aa692e', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('02fdd80f73ef83160355ab708374d85ee635e12f', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('10601dd95790138c98de1f9daf129b6c20e928e0', '10.0.0.223', 1484538523, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343533383532333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a2b71df8501b1e7af069c838f5f2752a4d3377c9', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('e93babe18035faf70235be8453edda25aa9d511a', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('8cef6eaa8d737db9e761d83fb168db65d2463d1a', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('c99562c7fe2766e05bd4f578d593d78dcf63a1d6', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('62a838b7fc98360091c80b6988510f5714b1ad01', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4232b255aa1c5630e374f3b65906230879efbd36', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('c566403b4d0e8b28dee2a21172a1a530f2c53f4d', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ce3c3d7385b1c3f6acc979aab0102c680ade939b', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('55ac620bff9b0eb36cd344b6ce74d7fbbddd55fb', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('7ed5dc300e5ed763b14c46bd6037c4b93dd39b21', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('0768202273b43314256be0ee822611a76c09ddae', '10.0.0.223', 1484547136, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373133363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('be43447ea168e63da104df96a181d665341a507f', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('243428e28a8d42db91bd5f675b70b640edb71ff8', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a15513c80560b6b7a7deafbb3504f9dff16c54cd', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('0ce56ffd58e62a84ee8a9bc582d6010a1cef48db', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('0861de935738b68c3d2ddce9a8ebc149da691838', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('aaad5df797608d4d306cabfe7b6a6d1d0b1b1c36', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('599882a6c2a92bc39347f96fa2644dd7006de6cb', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('e954da1f2347d6e3b589e5fcee1da378fcbbc268', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('fc6426afc0876c73ee33b786b2630ee021fa2844', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a76c3e8ef5e01da4689077ce87831f5e9d361a61', '10.0.0.223', 1484547994, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f2caacaac5022f3bba734ade1c3cc6008cd74f91', '10.0.0.223', 1484547765, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534373736353b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f7ff4e0bcc444a3402814c9c11990b75ae0e3ada', '10.0.0.223', 1484548641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b8b6d5c82a349eb800c887609daa536dfad61d13', '10.0.0.223', 1484548641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('9db661f94b1f2f5fc0eff8a81b753708c959de8e', '10.0.0.223', 1484548641, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('333adf439b77be4591e207c9793f40b79831110e', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a39e0e3518ee6d7820c7a29ad0deaedc9f50b14e', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('6a8218daef5a2bdeaff55ab85dd22775f8523b0b', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634313b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('11f062bd2015c9aa8fac47da43fc6db64bd375c7', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('5ffd6899087c19862e6ec15ff29f2d8dfb18ec83', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('de474cf467dcfd292e85a1efd76bd0baae82419e', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('9f69013044d5aee6e972083ae40188c9be2b9b1f', '10.0.0.223', 1484548642, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('dc526a457f98a6ebdf45c754bb0ae2b7b9f4d62e', '10.0.0.223', 1484548789, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343534383634323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('5785c31fdd43004124f2b886d23a7787866b6f79', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('1d4578942a2348d2170712203f382b5c669dded6', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('505a93a1ec188bb4aac6bdd409a72e7c3d1917eb', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4fe2c4a68901791da0ea6e6ca675c1741cc5011a', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('2f24ce004e74510c925434479b9c73cc7420d94d', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('56b77c454970aee8841c980cadcea8acecb30d9e', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('5a5437e72a474d2523ebfb68058e64ced0b54f82', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4506a4b67e723c8a1cef56a2a41d69b66866b90d', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b1cffaec5cf562eae5d14024ef1541d739c723d3', '10.0.0.223', 1484550666, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f1f519a65a282631508b262749719157e43f81ec', '10.0.0.223', 1484550667, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636363b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('e1e169d9478fd566e03359176bd6a3028208013b', '10.0.0.223', 1484550947, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535303636373b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a68915af34072fc7cfbf43acb7eb19cbdef9d30b', '10.0.0.223', 1484551013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a2d38a52296e75e2c18eddc815c8fe4f9004ecd8', '10.0.0.223', 1484551013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('cf8f3f6a86ebd5ca585035f8e2f9c324384f6603', '10.0.0.223', 1484551013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('24d2da10e88470b41940c3f71ced4ea235c1806b', '10.0.0.223', 1484551013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('fe06e554c42cb83b6fd265fc3093a53d162c97a1', '10.0.0.223', 1484551013, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031333b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('9af698dad1e95cc1882eb1f40d294be3ff3f7b15', '10.0.0.223', 1484551014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('91cb1ef76228323d21796d0d31d78027f1254f5e', '10.0.0.223', 1484551014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('857e43efa57238a87286ac17529dd10cd554ad06', '10.0.0.223', 1484551014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('608eb0980a849f61eb73fdef0e662bc7f166177c', '10.0.0.223', 1484551110, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b38a5b2957b96addeea035dc570b17425e22c632', '10.0.0.223', 1484551014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('fd95fa7371682dfc45dd320a391c36c5bf641ab8', '10.0.0.223', 1484551014, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535313031343b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('8e29ee12af8397546f80bed355e062092356eab7', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('8764c05f472b78377f0442f379c5c3beef4615fe', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('9f05feacca29b2e322c1015f6d44e337cee07681', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('d47d78f630483d09ef310366d3c537949c29ae96', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('6374c854a8f643a9f29907bae2570cc1ec3f55b9', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ca201852b3a276e68e96ac3b8e898e6a5344cde0', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('d9eadc662967b86de64b65f1d8da0de97e18d04e', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('eababf0b666f2df5132f20bc4656e2bf581235f9', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('4163ca99762fb12942295bd9cede7e329c42efce', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('1418def2cbaf3c684f95a746af94a190ea9b8b72', '10.0.0.223', 1484553236, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('bd0edadb225e26129caf99457e6a88d778b4b494', '10.0.0.223', 1484553212, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333231323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('729b264e266b35b9cc06a77f2480b6a28bfaa8db', '10.0.0.223', 1484553569, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333536393b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f6d84fedf955e14b49cd6263e72683bf9b5f33aa', '10.0.0.223', 1484553569, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333536393b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('cc04d49d5841a01bce4ff9dcc6ca8bfd35378f8d', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333536393b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f7dfb963b8afcd08c34fdaaa88e7481bbac678fb', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('82fc8da0294956f54464ac0be3e54358bb8b33da', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('642669ed40b897dade10a3ba7037c683e4d54d55', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('a7db7867bc3fcef465674137c2afa479cca81bd8', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('82d3a1ce6f1ae61fb6ca68a12f87e569ed2f4f21', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('55a746f3c0ddd14fb29b27fb91bcddf35d8c7a3c', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('6db98740f1725c7b9a7a5847588dc2c07197c1e6', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('81b0de6095c18ae9e9b8f2524065666c0c97f1a7', '10.0.0.223', 1484553570, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535333537303b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('ea798ebb342060612c9cbf7918d9fea422634ae2', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('c6a45aec477eabaaa4bb012c955e2ef2e8a3014e', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('f8ac51d20f8642325488c1b29ebf28c5ad7013c0', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('59d91b05639ee32ed8c3844203841ec4bf98875b', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('95691f02aa4f754ed7d9da2af7af77a1cc187c75', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('854c3bf3705df1cb42d9aa18d9456dd4f26d75e2', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('b00d78d3fe2c1ef186ee830022c0527007bdc52c', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('3e25e9f058453cf4cd30cda4ee30a5c8d144a8a2', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('eb25db324cd62a2b0d8281004da607589f37a42e', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('845442d2970a6107bb7c8e039b4d279713e2a329', '10.0.0.223', 1484555252, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d),
('57ed76e03f6c4147794e732bb7e41404f9411eb3', '10.0.0.223', 1484555253, 0x5f5f63695f6c6173745f726567656e65726174657c693a313438343535353235323b63726f73735f73657373696f6e7c613a313a7b733a31333a2263726f73735f73657373696f6e223b613a303a7b7d7d);

-- --------------------------------------------------------

--
-- Table structure for table `home_banner`
--

CREATE TABLE `home_banner` (
  `id` int(11) NOT NULL,
  `banner_group` int(11) NOT NULL COMMENT '//0 av, 1 vr',
  `image` varchar(255) NOT NULL,
  `text_label` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `home_banner`
--

INSERT INTO `home_banner` (`id`, `banner_group`, `image`, `text_label`, `link`, `sort_order`, `status`, `date_added`) VALUES
(2, 1, 'Banners/OsDasSUUA4.jpg', 'Banner2', '', 2, 1, '2016-08-03 16:09:42'),
(3, 1, 'Banners/v6UEFj1XOt.jpg', 'Banner 1', '', 0, 1, '2016-10-10 11:01:32');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `code` varchar(5) COLLATE utf8_bin NOT NULL,
  `locale` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(64) COLLATE utf8_bin NOT NULL,
  `directory` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `filename` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `sort_order` int(3) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `name`, `code`, `locale`, `image`, `directory`, `filename`, `sort_order`, `status`) VALUES
(1, 'English', 'en', 'en_US.UTF-8,en_US,en-gb,english', 'gb.png', 'english', 'english', 1, 1),
(2, 'Japanese', 'jp', 'ja_JA.utf-8,japanese', 'jp.png', 'japanese', 'japanese', 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `id_pointer` varchar(125) NOT NULL COMMENT '// id of a project or something',
  `posted_to_id` int(11) NOT NULL COMMENT '//user_id to notify',
  `path_group` varchar(125) NOT NULL COMMENT '//path for site_url',
  `variablename` varchar(125) NOT NULL COMMENT '//optional fro url var',
  `detail` text NOT NULL COMMENT '//html',
  `is_check` int(11) NOT NULL,
  `status` varchar(125) NOT NULL COMMENT '//success, danger blah',
  `posted_by` varchar(125) NOT NULL,
  `date_added` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `system_config`
--

CREATE TABLE `system_config` (
  `id` int(11) NOT NULL,
  `config_name` varchar(125) NOT NULL,
  `value` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `system_config`
--

INSERT INTO `system_config` (`id`, `config_name`, `value`) VALUES
(1, 'system_name', 'Flax Midorie JP'),
(2, 'owner_name', 'Flax'),
(3, 'location', 'Makati, Philippines'),
(4, 'theme', 'default'),
(5, 'record_per_page', '20'),
(6, 'show_notification', '1'),
(7, 'en_home_attention', ' ADULT CONTENT WARNING Do not enter this site unless you are 18 years of age or older(or age of legal majority in the jurisdiction in which you reside) AVJunkyにはアダルトコンテンツが含まれています。このページを閲覧するには、下記内容に同意しなければなりません。 私は18歳以上の成人（18歳'),
(8, 'jp_home_attention', ' ADULT CONTENT WARNING Do not enter this site unless you are 18 years of age or older(or age of legal majority in the jurisdiction in which you reside) AVJunkyにはアダルトコンテンツが含まれています。このページを閲覧するには、下記内容に同意しなければなりません。 私は18歳以上の成人（18歳'),
(9, 'vr_index_banner', 'Banners/OsDasSUUA4.jpg'),
(10, 'config_meta_description', ' All new FULL HD Adult Japanese VR videos every week! Watch and register now.'),
(11, 'av_homepage_banner', 'Banners/OsDasSUUA4.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_system_variables`
--
ALTER TABLE `aauth_system_variables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_users_info`
--
ALTER TABLE `aauth_users_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `actress`
--
ALTER TABLE `actress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `actress_detail`
--
ALTER TABLE `actress_detail`
  ADD KEY `actress_id` (`actress_id`),
  ADD KEY `actress_id_2` (`actress_id`,`language_id`);

--
-- Indexes for table `actress_gallery`
--
ALTER TABLE `actress_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `actress_id` (`actress_id`);

--
-- Indexes for table `av_category`
--
ALTER TABLE `av_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `av_inquiry`
--
ALTER TABLE `av_inquiry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `av_inquiry_reply`
--
ALTER TABLE `av_inquiry_reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `inquiry_id` (`inquiry_id`);

--
-- Indexes for table `av_review`
--
ALTER TABLE `av_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ref_id` (`ref_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `av_search`
--
ALTER TABLE `av_search`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `av_video`
--
ALTER TABLE `av_video`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `av_video_detail`
--
ALTER TABLE `av_video_detail`
  ADD UNIQUE KEY `video_id` (`video_id`,`language_id`);

--
-- Indexes for table `av_video_downloads`
--
ALTER TABLE `av_video_downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `av_video_gallery`
--
ALTER TABLE `av_video_gallery`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `av_video_location`
--
ALTER TABLE `av_video_location`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `av_video_scenes`
--
ALTER TABLE `av_video_scenes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `video_id` (`video_id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `home_banner`
--
ALTER TABLE `home_banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pointer` (`id_pointer`),
  ADD KEY `posted_to` (`posted_to_id`);

--
-- Indexes for table `system_config`
--
ALTER TABLE `system_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_system_variables`
--
ALTER TABLE `aauth_system_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `aauth_users_info`
--
ALTER TABLE `aauth_users_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `actress`
--
ALTER TABLE `actress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `actress_gallery`
--
ALTER TABLE `actress_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `av_category`
--
ALTER TABLE `av_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;
--
-- AUTO_INCREMENT for table `av_inquiry`
--
ALTER TABLE `av_inquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `av_inquiry_reply`
--
ALTER TABLE `av_inquiry_reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `av_review`
--
ALTER TABLE `av_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `av_search`
--
ALTER TABLE `av_search`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `av_video`
--
ALTER TABLE `av_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `av_video_downloads`
--
ALTER TABLE `av_video_downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `av_video_gallery`
--
ALTER TABLE `av_video_gallery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `av_video_location`
--
ALTER TABLE `av_video_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `av_video_scenes`
--
ALTER TABLE `av_video_scenes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `home_banner`
--
ALTER TABLE `home_banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `system_config`
--
ALTER TABLE `system_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
