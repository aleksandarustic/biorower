-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2015 at 02:15 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `braining`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `text` varchar(1500) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_users1_idx` (`user_id`),
  KEY `fk_comments_sessions1_idx` (`session_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `session_id`, `user_id`, `text`, `date`) VALUES
(10, 90, 2, 'fdgdfgdasdsa', '2015-05-14 10:29:47'),
(11, 90, 2, 'fdgdfgdasdsa', '2015-05-14 10:30:20'),
(12, 90, 2, 'dasdasd', '2015-05-14 10:38:06'),
(13, 90, 2, 'fghfghfgh', '2015-05-14 11:45:55'),
(38, 90, 15, 'asdasdasd', '2015-05-19 10:22:04'),
(41, 90, 2, 'asdasdads\r\nghjghj', '2015-06-10 12:51:41'),
(45, 90, 2, 'ssssssssss', '2015-06-10 13:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `data_biorower_sessions`
--

CREATE TABLE IF NOT EXISTS `data_biorower_sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stroke_count` int(11) DEFAULT NULL,
  `time` double DEFAULT NULL,
  `distance` double DEFAULT NULL,
  `stroke_distance_average` double DEFAULT NULL,
  `stroke_distance_max` double DEFAULT NULL,
  `speed_average` double DEFAULT NULL,
  `speed_max` double DEFAULT NULL,
  `pace_average` double DEFAULT NULL,
  `pace_max` double DEFAULT NULL,
  `heart_rate_average` double DEFAULT NULL,
  `heart_rate_max` double DEFAULT NULL,
  `stroke_rate_average` double DEFAULT NULL,
  `stroke_rate_max` double DEFAULT NULL,
  `power_average` double DEFAULT NULL,
  `power_max` double DEFAULT NULL,
  `power_left_average` double DEFAULT NULL,
  `power_left_max` double DEFAULT NULL,
  `power_right_average` double DEFAULT NULL,
  `power_right_max` double DEFAULT NULL,
  `power_balance` double DEFAULT NULL,
  `angle_average` double DEFAULT NULL,
  `angle_max` double DEFAULT NULL,
  `angle_left_average` double DEFAULT NULL,
  `angle_left_max` double DEFAULT NULL,
  `angle_right_average` double DEFAULT NULL,
  `angle_right_max` double DEFAULT NULL,
  `mml_2_level` double DEFAULT NULL,
  `mml_4_level` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `data_biorower_sessions`
--

INSERT INTO `data_biorower_sessions` (`id`, `stroke_count`, `time`, `distance`, `stroke_distance_average`, `stroke_distance_max`, `speed_average`, `speed_max`, `pace_average`, `pace_max`, `heart_rate_average`, `heart_rate_max`, `stroke_rate_average`, `stroke_rate_max`, `power_average`, `power_max`, `power_left_average`, `power_left_max`, `power_right_average`, `power_right_max`, `power_balance`, `angle_average`, `angle_max`, `angle_left_average`, `angle_left_max`, `angle_right_average`, `angle_right_max`, `mml_2_level`, `mml_4_level`) VALUES
(1, 56, 15, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37),
(2, 56, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 88, 11, 21, 36, 37),
(3, 56, 49, 12, 16, 14, 15, 16, 14.3, 18, 19, 20, 21, 22, 67, 24, 100, 16, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37),
(4, 56, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37),
(5, 56, 15, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37);

-- --------------------------------------------------------

--
-- Table structure for table `dic_countries`
--

CREATE TABLE IF NOT EXISTS `dic_countries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;

--
-- Dumping data for table `dic_countries`
--

INSERT INTO `dic_countries` (`id`, `name`, `dic_id`) VALUES
(1, 'Andorra', 1),
(2, 'United Arab Emirates', 1),
(3, 'Afghanistan', 1),
(4, 'Antigua and Barbuda', 1),
(5, 'Anguilla', 1),
(6, 'Albania', 1),
(7, 'Armenia', 1),
(8, 'Angola', 1),
(9, 'Antarctica', 1),
(10, 'Argentina', 1),
(11, 'American Samoa', 1),
(12, 'Austria', 1),
(13, 'Australia', 1),
(14, 'Aruba', 1),
(15, 'Ă…land', 1),
(16, 'Azerbaijan', 1),
(17, 'Bosnia and Herzegovina', 1),
(18, 'Barbados', 1),
(19, 'Bangladesh', 1),
(20, 'Belgium', 1),
(21, 'Burkina Faso', 1),
(22, 'Bulgaria', 1),
(23, 'Bahrain', 1),
(24, 'Burundi', 1),
(25, 'Benin', 1),
(26, 'Saint BarthĂ©lemy', 1),
(27, 'Bermuda', 1),
(28, 'Brunei', 1),
(29, 'Bolivia', 1),
(30, 'Bonaire', 1),
(31, 'Brazil', 1),
(32, 'Bahamas', 1),
(33, 'Bhutan', 1),
(34, 'Bouvet Island', 1),
(35, 'Botswana', 1),
(36, 'Belarus', 1),
(37, 'Belize', 1),
(38, 'Canada', 1),
(39, 'Cocos [Keeling] Islands', 1),
(40, 'Democratic Republic of the Congo', 1),
(41, 'Central African Republic', 1),
(42, 'Republic of the Congo', 1),
(43, 'Switzerland', 1),
(44, 'Ivory Coast', 1),
(45, 'Cook Islands', 1),
(46, 'Chile', 1),
(47, 'Cameroon', 1),
(48, 'China', 1),
(49, 'Colombia', 1),
(50, 'Costa Rica', 1),
(51, 'Cuba', 1),
(52, 'Cape Verde', 1),
(53, 'Curacao', 1),
(54, 'Christmas Island', 1),
(55, 'Cyprus', 1),
(56, 'Czech Republic', 1),
(57, 'Germany', 1),
(58, 'Djibouti', 1),
(59, 'Denmark', 1),
(60, 'Dominica', 1),
(61, 'Dominican Republic', 1),
(62, 'Algeria', 1),
(63, 'Ecuador', 1),
(64, 'Estonia', 1),
(65, 'Egypt', 1),
(66, 'Western Sahara', 1),
(67, 'Eritrea', 1),
(68, 'Spain', 1),
(69, 'Ethiopia', 1),
(70, 'Finland', 1),
(71, 'Fiji', 1),
(72, 'Falkland Islands', 1),
(73, 'Micronesia', 1),
(74, 'Faroe Islands', 1),
(75, 'France', 1),
(76, 'Gabon', 1),
(77, 'United Kingdom', 1),
(78, 'Grenada', 1),
(79, 'Georgia', 1),
(80, 'French Guiana', 1),
(81, 'Guernsey', 1),
(82, 'Ghana', 1),
(83, 'Gibraltar', 1),
(84, 'Greenland', 1),
(85, 'Gambia', 1),
(86, 'Guinea', 1),
(87, 'Guadeloupe', 1),
(88, 'Equatorial Guinea', 1),
(89, 'Greece', 1),
(90, 'South Georgia and the South Sandwich Islands', 1),
(91, 'Guatemala', 1),
(92, 'Guam', 1),
(93, 'Guinea-Bissau', 1),
(94, 'Guyana', 1),
(95, 'Hong Kong', 1),
(96, 'Heard Island and McDonald Islands', 1),
(97, 'Honduras', 1),
(98, 'Croatia', 1),
(99, 'Haiti', 1),
(100, 'Hungary', 1),
(101, 'Indonesia', 1),
(102, 'Ireland', 1),
(103, 'Israel', 1),
(104, 'Isle of Man', 1),
(105, 'India', 1),
(106, 'British Indian Ocean Territory', 1),
(107, 'Iraq', 1),
(108, 'Iran', 1),
(109, 'Iceland', 1),
(110, 'Italy', 1),
(111, 'Jersey', 1),
(112, 'Jamaica', 1),
(113, 'Jordan', 1),
(114, 'Japan', 1),
(115, 'Kenya', 1),
(116, 'Kyrgyzstan', 1),
(117, 'Cambodia', 1),
(118, 'Kiribati', 1),
(119, 'Comoros', 1),
(120, 'Saint Kitts and Nevis', 1),
(121, 'North Korea', 1),
(122, 'South Korea', 1),
(123, 'Kuwait', 1),
(124, 'Cayman Islands', 1),
(125, 'Kazakhstan', 1),
(126, 'Laos', 1),
(127, 'Lebanon', 1),
(128, 'Saint Lucia', 1),
(129, 'Liechtenstein', 1),
(130, 'Sri Lanka', 1),
(131, 'Liberia', 1),
(132, 'Lesotho', 1),
(133, 'Lithuania', 1),
(134, 'Luxembourg', 1),
(135, 'Latvia', 1),
(136, 'Libya', 1),
(137, 'Morocco', 1),
(138, 'Monaco', 1),
(139, 'Moldova', 1),
(140, 'Montenegro', 1),
(141, 'Saint Martin', 1),
(142, 'Madagascar', 1),
(143, 'Marshall Islands', 1),
(144, 'Macedonia', 1),
(145, 'Mali', 1),
(146, 'Myanmar [Burma]', 1),
(147, 'Mongolia', 1),
(148, 'Macao', 1),
(149, 'Northern Mariana Islands', 1),
(150, 'Martinique', 1),
(151, 'Mauritania', 1),
(152, 'Montserrat', 1),
(153, 'Malta', 1),
(154, 'Mauritius', 1),
(155, 'Maldives', 1),
(156, 'Malawi', 1),
(157, 'Mexico', 1),
(158, 'Malaysia', 1),
(159, 'Mozambique', 1),
(160, 'Namibia', 1),
(161, 'New Caledonia', 1),
(162, 'Niger', 1),
(163, 'Norfolk Island', 1),
(164, 'Nigeria', 1),
(165, 'Nicaragua', 1),
(166, 'Netherlands', 1),
(167, 'Norway', 1),
(168, 'Nepal', 1),
(169, 'Nauru', 1),
(170, 'Niue', 1),
(171, 'New Zealand', 1),
(172, 'Oman', 1),
(173, 'Panama', 1),
(174, 'Peru', 1),
(175, 'French Polynesia', 1),
(176, 'Papua New Guinea', 1),
(177, 'Philippines', 1),
(178, 'Pakistan', 1),
(179, 'Poland', 1),
(180, 'Saint Pierre and Miquelon', 1),
(181, 'Pitcairn Islands', 1),
(182, 'Puerto Rico', 1),
(183, 'Palestine', 1),
(184, 'Portugal', 1),
(185, 'Palau', 1),
(186, 'Paraguay', 1),
(187, 'Qatar', 1),
(188, 'RĂ©union', 1),
(189, 'Romania', 1),
(190, 'Serbia', 1),
(191, 'Russia', 1),
(192, 'Rwanda', 1),
(193, 'Saudi Arabia', 1),
(194, 'Solomon Islands', 1),
(195, 'Seychelles', 1),
(196, 'Sudan', 1),
(197, 'Sweden', 1),
(198, 'Singapore', 1),
(199, 'Saint Helena', 1),
(200, 'Slovenia', 1),
(201, 'Svalbard and Jan Mayen', 1),
(202, 'Slovakia', 1),
(203, 'Sierra Leone', 1),
(204, 'San Marino', 1),
(205, 'Senegal', 1),
(206, 'Somalia', 1),
(207, 'Suriname', 1),
(208, 'South Sudan', 1),
(209, 'SĂŁo TomĂ© and PrĂ­ncipe', 1),
(210, 'El Salvador', 1),
(211, 'Sint Maarten', 1),
(212, 'Syria', 1),
(213, 'Swaziland', 1),
(214, 'Turks and Caicos Islands', 1),
(215, 'Chad', 1),
(216, 'French Southern Territories', 1),
(217, 'Togo', 1),
(218, 'Thailand', 1),
(219, 'Tajikistan', 1),
(220, 'Tokelau', 1),
(221, 'East Timor', 1),
(222, 'Turkmenistan', 1),
(223, 'Tunisia', 1),
(224, 'Tonga', 1),
(225, 'Turkey', 1),
(226, 'Trinidad and Tobago', 1),
(227, 'Tuvalu', 1),
(228, 'Taiwan', 1),
(229, 'Tanzania', 1),
(230, 'Ukraine', 1),
(231, 'Uganda', 1),
(232, 'U.S. Minor Outlying Islands', 1),
(233, 'United States', 1),
(234, 'Uruguay', 1),
(235, 'Uzbekistan', 1),
(236, 'Vatican City', 1),
(237, 'Saint Vincent and the Grenadines', 1),
(238, 'Venezuela', 1),
(239, 'British Virgin Islands', 1),
(240, 'U.S. Virgin Islands', 1),
(241, 'Vietnam', 1),
(242, 'Vanuatu', 1),
(243, 'Wallis and Futuna', 1),
(244, 'Samoa', 1),
(245, 'Kosovo', 1),
(246, 'Yemen', 1),
(247, 'Mayotte', 1),
(248, 'South Africa', 1),
(249, 'Zambia', 1),
(250, 'Zimbabwe', 1);

-- --------------------------------------------------------

--
-- Table structure for table `dic_languages`
--

CREATE TABLE IF NOT EXISTS `dic_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dic_languages`
--

INSERT INTO `dic_languages` (`id`, `name`, `dic_id`) VALUES
(1, 'English', 1),
(2, 'Serbian', 1),
(3, 'Engleski', 2),
(4, 'Srpski', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dic_user_types`
--

CREATE TABLE IF NOT EXISTS `dic_user_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `dic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `dic_user_types`
--

INSERT INTO `dic_user_types` (`id`, `name`, `dic_id`) VALUES
(1, 'Home User', 1),
(2, 'Gym/Club User', 1),
(3, 'Work User', 1),
(4, ' Armed Forces/Uniformed Services User', 1);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `groups_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=87 ;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `name`) VALUES
(71, ''),
(72, ''),
(73, ''),
(74, ''),
(75, ''),
(76, ''),
(77, ''),
(78, ''),
(80, ''),
(81, ''),
(82, ''),
(86, '/000/000/000/2a527ec8899eb010390666ae9f05ed94.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_user_id` int(10) unsigned NOT NULL,
  `receiver_user_id` int(10) unsigned NOT NULL,
  `text` text,
  `subject` varchar(150) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `read` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_messages_users1_idx` (`sender_user_id`),
  KEY `fk_messages_users2_idx` (`receiver_user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_user_id`, `receiver_user_id`, `text`, `subject`, `date`, `read`) VALUES
(1, 2, 4, 'Userjnapisesta hoces Boja Popović send you request for race. You can accept request on the following link: http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k', 'New request for race', '2015-06-02 00:00:00', 1),
(2, 4, 4, 'User aaa3  send you request for race. You can accept request on the following link: <a href=http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k >Accept</a>', 'New request for race', NULL, 1),
(3, 2, 4, 'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a href=''http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k'' >Accept</a>', 'New request for race', '2015-06-03 13:14:41', 1),
(4, 2, 4, 'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a class=''btn btn-default'' href=''http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W0&id2=6k'' >Accept</a>', 'New request for race', '2015-06-03 13:29:21', 1),
(14, 2, 5, 'User jnapisesta hoces (Boja Popović) send you request for race. You can accept request on the following link: <a class=''btn btn-default'' href=''http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=W5&id2=6k'' >Accept</a>', 'New request for race', '2015-06-05 07:25:06', 1),
(19, 2, 15, 'dasdasd', 'asdas', '2015-06-11 10:37:00', 0),
(20, 2, 15, 'asdasdaasdasda', 'dasd', '2015-06-11 12:38:23', 0),
(21, 2, 13, 'User Bojansaa (Bojan Popović) send you request for follow. You can accept request on the following link: <a class=''btn btn-default'' href=''http://localhost:8080/!powerhub%20template/blog/public/user/accept-following?user_ln=bojanproba811112'' >Accept</a>', 'New follower request', '2015-06-12 07:47:48', 1),
(24, 5, 2, 'sdfsdfsdf', 'sfsdf', '2015-06-16 10:18:01', 1),
(25, 2, 5, 'dadsadsasd', 'adasdad', '2015-06-01 00:00:00', 0),
(26, 2, 5, 'aaaaaaaaaa', 'dddddddddddd', '2015-06-03 00:00:00', 0),
(27, 2, 5, 'dsadasdasdas', 'dsadasdasd', '2015-06-04 00:00:00', 1),
(28, 5, 2, 'gde si?', 'ajdem', '2015-06-17 07:52:32', 1),
(29, 5, 2, 'jesi tu?', 'dad', '2015-06-17 08:02:19', 1),
(30, 2, 3, 'User Bojansaa (Bojan Popović) send you request for race. You can accept request on the following link: <a class=''btn btn-default'' href=''http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=oa&id2=V4'' >Accept</a>', 'New request for race', '2015-07-16 07:24:02', 0),
(31, 2, 3, 'User Bojansaa (Bojan Popović) send you request for race. You can accept request on the following link: <a class=''btn btn-default'' href=''http://localhost:8080/!powerhub%20template/blog/public/race/acceptrequest?id1=oa&id2=6k'' >Accept</a>', 'New request for race', '2015-08-05 10:45:38', 1),
(32, 2, 15, 'asdasdad', 'idemo', '2015-09-08 08:44:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('bojanproba81@gmail.com', 'b04d2d1ceb87eb338344aa0f22f1e32fc1586aa6765c15094228836c0f88dd75', '2015-08-04 08:35:09');

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dic_languages_id` int(11) DEFAULT NULL,
  `dic_country_id` int(11) DEFAULT NULL,
  `dic_user_type_id` int(11) DEFAULT NULL,
  `image_id` int(11) DEFAULT NULL,
  `privacy` tinyint(1) NOT NULL DEFAULT '3',
  `about_me` text COLLATE utf8_unicode_ci,
  `date_of_birth` datetime DEFAULT NULL,
  `gender` tinyint(1) DEFAULT '3',
  `phone` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notify_me_on_comment` tinyint(1) DEFAULT '3',
  `notify_me_on_new_session` tinyint(1) DEFAULT '3',
  `notify_me_on_new_watcher` tinyint(1) DEFAULT '3',
  `send_session_summary` tinyint(1) DEFAULT '3',
  `email_summary_alternative` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `send_session_summary_alternate` tinyint(1) DEFAULT '3',
  PRIMARY KEY (`id`),
  KEY `fk_users_languages_idx` (`dic_languages_id`),
  KEY `fk_users_dic_country1_idx` (`dic_country_id`),
  KEY `fk_users_dic_user_type1_idx` (`dic_user_type_id`),
  KEY `fk_profiles_image1_idx` (`image_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=35 ;

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `dic_languages_id`, `dic_country_id`, `dic_user_type_id`, `image_id`, `privacy`, `about_me`, `date_of_birth`, `gender`, `phone`, `mobile`, `line1`, `line2`, `city`, `zip`, `website`, `notify_me_on_comment`, `notify_me_on_new_session`, `notify_me_on_new_watcher`, `send_session_summary`, `email_summary_alternative`, `send_session_summary_alternate`) VALUES
(1, 1, 1, 3, NULL, 1, 'sdf sdf sdf sdf', '0000-00-00 00:00:00', 0, '123123', '121', '1233', '', '', '', '', 1, 3, 1, 3, 'er@gg.com', 3),
(3, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(4, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(5, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(6, NULL, NULL, NULL, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(15, NULL, NULL, NULL, 86, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(18, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(19, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(20, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(25, NULL, NULL, NULL, NULL, 1, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(26, NULL, NULL, NULL, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(29, NULL, NULL, NULL, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(33, NULL, NULL, NULL, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3),
(34, NULL, NULL, NULL, NULL, 3, NULL, NULL, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 3, 3, 3, 3, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `races`
--

CREATE TABLE IF NOT EXISTS `races` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `races`
--

INSERT INTO `races` (`id`, `name`, `date`) VALUES
(6, 'aaaadasda', '2015-08-12 13:53:31'),
(7, 'dasda', '2015-09-09 09:13:16'),
(8, 'idemo bre', '2015-09-09 00:00:00'),
(9, 'sfsdfsdf', '2015-09-18 13:36:51');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `data` text,
  `dataVersion` int(11) DEFAULT NULL,
  `deviceType` varchar(100) DEFAULT NULL,
  `serialNumber` varchar(50) DEFAULT NULL,
  `firmwareVersion` int(11) DEFAULT NULL,
  `mobileUserAgent` varchar(100) DEFAULT NULL,
  `sampleRate` int(11) DEFAULT NULL,
  `fftRange` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `utc` bigint(20) DEFAULT NULL,
  `website_id` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `data_biorower_sessions_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_session_users1_idx` (`user_id`),
  KEY `fk_sessions_websites1_idx` (`website_id`),
  KEY `fk_sessions_data_biorower_sessions1_idx` (`data_biorower_sessions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=97 ;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `date`, `data`, `dataVersion`, `deviceType`, `serialNumber`, `firmwareVersion`, `mobileUserAgent`, `sampleRate`, `fftRange`, `duration`, `utc`, `website_id`, `deleted`, `data_biorower_sessions_id`) VALUES
(90, 2, '2015-09-29 09:39:35', '[[\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		},\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		}\n	]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 1),
(91, 2, '2015-09-30 09:39:35', '[[\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		},\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		}\n	]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 2),
(92, 2, '2015-09-22 04:04:35', '[[\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		},\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		}\n	]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 3),
(93, 2, '2016-01-04 09:39:35', '[[\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		},\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		}\n	]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 4),
(94, 2, '2015-09-25 19:39:35', '[[\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		},\n		{\n			"time":300.0,\n			"speed":300.0,\n			"distance":300.0,\n			"pace":300.0,\n			"pwr":300.0,\n			"pwr_l":300.0,\n			"pwr_r":300.0,\n			"pwr_bal":49.0,\n			"srate":300.0,\n			"ang":300.0,\n			"ang_l":300.0,\n			"ang_r":300.0,\n			"hr":300.0,\n			"frc_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"frc_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_l":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113],\n			"ang_r":[110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,112,110,111,113]\n		}\n	]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 5),
(96, 3, '2015-08-23 09:39:35', '[[{"left":{"alpha":1,"beta":1,"peak_freq_1":11,"peak_freq_2":16,"raw":[59,59,59,59,75,113,162,180,145,98,55,33,26,25,30,33,38,43,47,51,54,58,60,62,64,65,66,67,68,69,71,74,78,83,87,90,92,93,93,93,92,91,89,88,86,84,80,77,73,69,66,65,64,63,63,63,63,63,64,64,64,65,65,66,66,66,66,67,67,67,68,68,68,68,68,68,69,69,69,69,69,70,71,71,72,74,77,81,83,84,82,79,75,71,69,67,67,66,65,64,63,62,60,59,59,59,59,59,70,105,155,181,160,107,61,35,26,25,28,32,37,42,46,50,54,57,60,62]},"right":{"alpha":1,"beta":0,"peak_freq_1":11,"peak_freq_2":3,"raw":[43,43,43,43,44,45,49,50,47,45,43,42,41,41,42,42,42,43,42,43,43,43,43,43,43,43,43,43,44,43,44,43,44,44,44,44,44,44,45,45,45,44,44,44,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,44,43,43,43,43,44,43,44,44,43,44,44,43,44,44,44,44,43,44,44,44,44,44,44,44,43,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,45,48,50,48,45,43,42,42,42,41,42,42,42,43,43,43,43,43,43]}},{"left":{"alpha":0,"beta":0,"peak_freq_1":5,"peak_freq_2":2,"raw":[63,65,66,67,68,69,71,73,77,82,86,90,92,93,94,93,93,90,90,88,86,84,81,77,73,70,67,65,64,63,63,63,63,63,64,64,64,65,65,65,66,66,67,67,67,67,67,68,68,68,68,68,68,69,69,69,69,70,71,71,72,73,77,80,83,84,83,80,75,72,69,68,67,66,65,64,63,62,61,60,59,59,59,59,65,98,147,180,166,116,66,38,27,25,27,31,36,41,46,50,53,57,59,61,63,64,66,67,68,69,70,73,77,81,86,89,92,93,94,93,92,91,90,88,86,84,81,78]},"right":{"alpha":0,"beta":0,"peak_freq_1":5,"peak_freq_2":8,"raw":[43,43,44,43,44,44,44,44,44,44,44,44,45,44,45,45,44,45,44,45,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,44,43,44,43,43,43,43,43,43,43,43,44,44,44,43,44,44,44,44,43,44,44,44,44,44,44,44,44,44,43,44,44,43,44,43,43,43,43,43,43,43,43,43,43,44,45,48,49,49,46,43,42,41,41,42,42,42,42,42,43,43,43,43,43,43,43,43,43,43,43,44,44,44,44,44,44,44,45,45,45,45,44,45,44,44,44,44,44]}},{"left":{"alpha":0,"beta":0,"peak_freq_1":4,"peak_freq_2":8,"raw":[73,69,67,65,64,63,63,63,63,63,64,64,64,65,65,65,66,66,66,67,67,67,67,67,68,68,68,68,68,69,69,69,69,70,70,71,71,73,76,80,82,83,83,80,76,72,69,68,67,66,66,65,64,62,61,60,59,59,59,59,61,92,140,180,170,125,73,41,28,25,27,31,35,41,45,49,53,56,59,61,63,64,66,67,68,69,70,72,76,81,85,89,91,93,94,93,93,91,90,88,86,85,82,78,75,71,68,65,64,63,63,63,63,63,63,64,64,65,65,66,66,66,67,67,67,67,67,68]},"right":{"alpha":0,"beta":0,"peak_freq_1":6,"peak_freq_2":9,"raw":[43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,44,43,44,44,43,44,43,44,44,43,43,43,43,44,43,44,43,43,44,44,44,44,44,44,44,44,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,45,47,49,49,46,44,42,41,41,42,42,42,42,42,43,43,43,43,43,43,43,43,44,44,44,43,43,44,44,44,44,44,45,45,44,44,45,44,44,44,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,43,44]}},{"left":{"alpha":1,"beta":0,"peak_freq_1":8,"peak_freq_2":5,"raw":[68,68,68,68,68,68,69,69,69,70,70,71,71,72,75,80,82,84,83,81,77,72,70,68,67,66,66,65,64,62,61,60,59,58,58,58,59,86,132,176,174,134,80,45,29,25,26,30,35,39,44,48,52,56,59,61,63,64,66,67,68,68,70,72,75,80,84,88,91,93,93,93,93,92,90,89,87,85,82,79,75,71,68,66,64,63,63,63,63,63,63,64,64,65,65,65,65,66,66,67,67,67,67,68,68,68,68,68,68,69,69,69,69,69,70,70,71,72,75,78,81,83,83,81,77,73,70,68]},"right":{"alpha":1,"beta":0,"peak_freq_1":8,"peak_freq_2":5,"raw":[43,43,43,43,43,43,44,44,43,43,44,44,43,43,44,44,44,44,44,44,44,44,44,43,43,43,43,43,43,43,43,43,43,43,43,43,43,44,47,49,50,46,44,42,42,41,41,41,42,42,43,43,43,43,43,43,43,43,44,43,43,44,43,44,44,44,44,44,45,45,45,45,44,44,45,44,44,44,44,44,43,44,43,43,43,43,43,43,43,43,43,43,43,43,44,43,44,43,43,43,43,44,43,44,44,43,44,43,43,43,43,43,44,43,43,44,44,44,44,44,44,44,44,44,44,44,44,44]}}]]', 1, 'Braining V1', '6856', 4, 'samsung; degaswifixx; SM-T230', 128, 64, 5, 1438069174821, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE IF NOT EXISTS `throttle` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `ip_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT '0',
  `suspended` tinyint(4) NOT NULL DEFAULT '0',
  `banned` tinyint(4) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permissions` text COLLATE utf8_unicode_ci,
  `activated` tinyint(4) NOT NULL DEFAULT '0',
  `activation_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activated_at` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_password_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `auth_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `linkname` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `facebook_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_settings_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `linkname_UNIQUE` (`linkname`),
  UNIQUE KEY `twitter_id_UNIQUE` (`twitter_id`),
  UNIQUE KEY `facebook_id_UNIQUE` (`facebook_id`),
  KEY `users_activation_code_index` (`activation_code`),
  KEY `users_reset_password_code_index` (`reset_password_code`),
  KEY `fk_users_profiles_idx` (`profile_id`),
  KEY `fk_users_user_settings1_idx` (`user_settings_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `profile_id`, `email`, `password`, `permissions`, `activated`, `activation_code`, `activated_at`, `last_login`, `persist_code`, `reset_password_code`, `first_name`, `last_name`, `created_at`, `updated_at`, `remember_token`, `auth_token`, `twitter_id`, `display_name`, `linkname`, `facebook_id`, `user_settings_id`) VALUES
(2, 1, 'bojanproba81@gmail.com', '$2y$10$Tay/ppyVxEhibD13oOQ9eO5jBT7Th91Z9JbsiiCMHDCaKfkWuwGcG', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Bojan', 'Popović', '2015-03-31 22:00:00', '2015-09-28 11:58:18', 'Z0n5eI9uf3qy1XYBJhmowRNJk0ssRwdxSJlDn9Q9LPNK6rzqV1YQIfMtLGHA', NULL, NULL, 'Bojansaa', 'sdfsdfsdf', NULL, 2),
(3, 3, 'idemo@email.com', '$2y$10$aiuU6uZt5P3jpk61rOY3Red.7WefuoQacCP9E0VrLBMT6WFvpBE4O', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Pera', 'Petrović', '2015-04-27 09:50:37', '2015-04-27 09:52:41', 'bhlLiONrNx3AQzgrA53lfLSYZZDMqdkK5HsS5RNyv0ioNG37wwBLlfuAHobH', NULL, NULL, 'aaa2', 'aa2', NULL, 1),
(4, 4, 'bojanpopovic81@gmail.com', '$2y$10$fdjTyMsZq4vkC.sAE/7APuBdwcm8biszMonLiNXgTHdEryyO4qvDG', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-04-27 09:52:59', '2015-06-09 04:09:26', 'LYLxNuDKvWSHQiSvVqs4I2bfsbItTYVO6pOe1cQ2FCNJVpXMJmk1pkHmXbdH', NULL, NULL, 'aaa3', 'aaa2', NULL, 1),
(5, 5, 'idemo2@email.com', '$2y$10$U7M8LxoMjKi/vZ6uhpeGX.Wysz4ZhpkNJY4cSeNfSDHuN5MjTrDYG', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-04-27 09:54:51', '2015-06-19 10:19:34', 'dAwmER1SeiV3dwi7dfkSFyyXvIRv9Zjy1PsPLPvwvB5ASG8Qyu5xpjBatCOv', '8c4adf2b8b991af9e30aa28d2b4c38f3', NULL, 'aaa5', 'aadsa', NULL, 1),
(6, 6, 'ajde@yuyu.com', '$2y$10$qvxo/3DJ2tMgnVvqHiScL.Pf1JLtX9KQMPzwkxQJ4gjfKaAwdgj9O', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-04-27 10:28:06', '2015-04-27 10:28:06', NULL, 'cd4dd49e43b8b221acea7b6d7bd8b698', NULL, 'aaa6', 'fsdff', NULL, 1),
(9, 15, 'retro981@yahoo.com', '$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK', NULL, 0, NULL, NULL, NULL, NULL, NULL, 'Zdravko', 'Petrović', '2015-04-30 08:37:05', '2015-08-05 09:11:57', 'PwDSKskw0nzQ9fCmmKIcafXdQoi9PlSWla2oj1zYTkh1c9FuGf44CDXZiHo0', NULL, NULL, 'aaa7', 'gsss', NULL, 1),
(11, 18, 'bojanproba8111@gmail.com', '$2y$10$HvRAZh63KINZlmkV7rDEzuuphe4nS9E0exbtoY1uBeQWO1nyBpYAm', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-15 11:53:51', '2015-05-15 11:56:45', 'XcRaCfDgXIiKsGM7Id9n0BJetAQFieqSCC8xpZ1TxZxIGve2VFQR4pbEe4cK', NULL, NULL, '', 'bojanproba8111', NULL, 1),
(12, 19, 'bojanproba8111@ajde.com', '$2y$10$oiyQeS8MCrPHeraCdmoRKufIP5TTy5UhGeJkhxdDRLDhiSdBc18cO', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-15 11:57:37', '2015-05-15 12:01:47', '46WNvRxzW49AyInhTnW0dTeqIdx27Qn9PABkiUnbRHl1l97nP1xD4Y3UlEJU', NULL, NULL, 'bojanproba8111', 'bojanproba81111', NULL, 1),
(13, 20, 'bojanproba8111@nekidrugi.com', '$2y$10$lc/z9MQ1zZlEHb0ICbO4xO3ojY3MCHHVsjF6.DrWPu0zXysTTBPPK', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-15 12:16:20', '2015-07-22 07:50:56', 'LN43H9ogTDMtU9Lfos5lJe0b0zT6Wm9trZSySh1F8Vcv5XyZTQRrgXNEeOkL', NULL, NULL, 'bojanproba8111', 'bojanproba811112', NULL, 1),
(14, 25, 'bojanproba81@gaamail.com', '$2y$10$FRnUw.l4vfc33Wt7xtkuqeW83tW/D0jPfZYJx5ziN3Ly3SZlmkFEm', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-19 04:36:29', '2015-05-27 11:32:12', 'iDSM6NkgIvsoFTWEyZPapYMCsDILt5dbdqRptkLzV4J5ZcHiJ63Qd59Q3nLB', NULL, NULL, 'bojanproba81', 'bojanproba81', NULL, 1),
(15, 26, 'bojanproba81@gaam23ail.com', '$2y$10$wG7IBD8dOIkr.RQeuZmg.OgwlEnUgNOI43aAiq0cPxo47Cnvx5Hp.', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-05-19 04:41:33', '2015-05-19 11:36:12', 'ikKVrciP4tIQR0gxeQWdShqtNKQjng2DtXcWGF0FQMPOX8vlZZPL044CECmY', NULL, NULL, 'bojanproba81', 'bojanproba811', NULL, 1),
(23, 34, 'blabla@idemo.com', '$2y$10$L4l8SEw.jmMnY9rfgrDEguLwlA0C89.zThrhK7/fyXO4CivO45zZm', NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2015-08-03 05:28:52', '2015-08-03 05:28:52', NULL, '8514dccbdfee3c84165ec611e35290c4', '123314234', 'blabla', 'blabla', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `group_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users_races`
--

CREATE TABLE IF NOT EXISTS `users_races` (
  `race_id` int(11) NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `accepted` tinyint(4) NOT NULL DEFAULT '1',
  `position` int(11) DEFAULT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `sessions_id` int(11) DEFAULT NULL,
  UNIQUE KEY `user_race_unique` (`race_id`,`user_id`),
  KEY `fk_users_race_rooms_races1_idx` (`race_id`),
  KEY `fk_users_race_rooms_users1_idx` (`user_id`),
  KEY `fk_users_races_sessions1_idx` (`sessions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_races`
--

INSERT INTO `users_races` (`race_id`, `user_id`, `accepted`, `position`, `deleted`, `sessions_id`) VALUES
(6, 2, 1, NULL, 0, NULL),
(6, 3, 0, NULL, 0, NULL),
(6, 14, 1, NULL, 0, NULL),
(7, 2, 1, NULL, 0, NULL),
(7, 4, 0, NULL, 0, NULL),
(9, 2, 1, NULL, 0, NULL),
(9, 3, 0, NULL, 0, NULL),
(9, 4, 0, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id` varchar(100) NOT NULL,
  `payload` text,
  `last_activity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_sessions`
--

INSERT INTO `user_sessions` (`id`, `payload`, `last_activity`) VALUES
('9777815d20eedb556e59f65c664dd28804a1f993', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidkgybVRDS0xJbDUxVGVtNGZsZjI0SmVLaWdHd0lTb0lIY1ZjaDVvViI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Njg6Imh0dHA6Ly9sb2NhbGhvc3Q6ODA4MC8hcG93ZXJodWIlMjB0ZW1wbGF0ZS9ibG9nL3B1YmxpYy9ob21lL2FwaS1kb2NzIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aToyO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDQzNTE0NTYxO3M6MToiYyI7aToxNDQzNTA3OTI4O3M6MToibCI7czoxOiIwIjt9fQ==', 1443514561),
('b4575b5af98588fa49549dc0bff7b15ce3b3ec53', 'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiV0g5YzVkSVdtV2xibWdKM2lXQVlSc2ZWVk5qbjdWaFZtMUxHOTY4OSI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjc2OiJodHRwOi8vbG9jYWxob3N0OjgwODAvIXBvd2VyaHViJTIwdGVtcGxhdGUvYmxvZy9wdWJsaWMvc2Rmc2Rmc2RmL3Nlc3Npb24vbHdBIjt9czo1OiJmbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM4OiJsb2dpbl84MmU1ZDJjNTZiZGQwODExMzE4ZjBjZjA3OGI3OGJmYyI7aToyO3M6OToiX3NmMl9tZXRhIjthOjM6e3M6MToidSI7aToxNDQzNDQ5ODk1O3M6MToiYyI7aToxNDQzNDQ3NzA1O3M6MToibCI7czoxOiIwIjt9fQ==', 1443449895);

-- --------------------------------------------------------

--
-- Table structure for table `user_settings`
--

CREATE TABLE IF NOT EXISTS `user_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `setting1` int(11) DEFAULT NULL,
  `setting2` int(11) DEFAULT NULL,
  `setting3` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `user_settings`
--

INSERT INTO `user_settings` (`id`, `setting1`, `setting2`, `setting3`) VALUES
(1, 1, 1, 1),
(2, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `watching`
--

CREATE TABLE IF NOT EXISTS `watching` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user1_id` int(10) unsigned NOT NULL,
  `user2_id` int(10) unsigned NOT NULL,
  `approved` tinyint(4) NOT NULL DEFAULT '0',
  `website_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_user1_user2_website` (`user1_id`,`user2_id`,`website_id`),
  KEY `fk_watching_users1_idx` (`user1_id`),
  KEY `fk_watching_users2_idx` (`user2_id`),
  KEY `fk_watching_websites1_idx` (`website_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `watching`
--

INSERT INTO `watching` (`id`, `user1_id`, `user2_id`, `approved`, `website_id`) VALUES
(18, 2, 9, 1, 1),
(21, 15, 2, 1, 1),
(25, 2, 6, 0, 1),
(35, 2, 4, 1, 1),
(39, 2, 13, 0, 1),
(41, 2, 5, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `websites`
--

CREATE TABLE IF NOT EXISTS `websites` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `websites`
--

INSERT INTO `websites` (`id`, `name`) VALUES
(1, 'biorower'),
(2, 'beeger');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `fk_comments_sessions1` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comments_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `fk_messages_users1` FOREIGN KEY (`sender_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_messages_users2` FOREIGN KEY (`receiver_user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `fk_users_dic_country1` FOREIGN KEY (`dic_country_id`) REFERENCES `dic_countries` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_dic_user_type1` FOREIGN KEY (`dic_user_type_id`) REFERENCES `dic_user_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_languages` FOREIGN KEY (`dic_languages_id`) REFERENCES `dic_languages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `sessions`
--
ALTER TABLE `sessions`
  ADD CONSTRAINT `fk_sessions_data_biorower_sessions1` FOREIGN KEY (`data_biorower_sessions_id`) REFERENCES `data_biorower_sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_sessions_websites1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_session_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_user_settings1` FOREIGN KEY (`user_settings_id`) REFERENCES `user_settings` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users_races`
--
ALTER TABLE `users_races`
  ADD CONSTRAINT `fk_users_races_sessions1` FOREIGN KEY (`sessions_id`) REFERENCES `sessions` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_race_rooms_races1` FOREIGN KEY (`race_id`) REFERENCES `races` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_race_rooms_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `watching`
--
ALTER TABLE `watching`
  ADD CONSTRAINT `fk_watching_users1` FOREIGN KEY (`user1_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_watching_users2` FOREIGN KEY (`user2_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_watching_websites1` FOREIGN KEY (`website_id`) REFERENCES `websites` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
