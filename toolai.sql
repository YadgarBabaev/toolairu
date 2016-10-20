-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 20, 2016 at 02:02 AM
-- Server version: 5.7.15-0ubuntu0.16.04.1
-- PHP Version: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toolai`
--

-- --------------------------------------------------------

--
-- Table structure for table `CMS_Menu`
--

CREATE TABLE `CMS_Menu` (
  `id` int(11) NOT NULL,
  `page_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `params` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `home` tinyint(1) DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menuType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CMS_Menu`
--

INSERT INTO `CMS_Menu` (`id`, `page_id`, `parent_id`, `title`, `alias`, `type`, `orderning`, `lft`, `rgt`, `lvl`, `root`, `status`, `params`, `home`, `url`, `menuType`) VALUES
(1, 1, NULL, 'Главная', 'glavnaia', 'content', 0, 1, 2, 0, 1, 1, 'a:0:{}', 1, NULL, 1),
(2, NULL, NULL, 'Магазин', 'maghazin', 'shop', 1, 1, 2, 0, 2, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 1),
(3, 2, NULL, 'Коллекции', 'kolliektsii', 'collection', 2, 1, 2, 0, 3, 1, 'a:1:{s:6:"cat_id";s:1:"2";}', NULL, NULL, 1),
(4, 3, NULL, 'Для бизнеса', 'dlia-bizniesa', 'b2b', 3, 1, 4, 0, 4, 1, 'a:1:{s:6:"cat_id";s:1:"4";}', NULL, NULL, 1),
(5, 4, NULL, 'Блог', 'blogh', 'blog', 5, 1, 2, 0, 5, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 1),
(7, 7, NULL, 'Условия и положения', 'usloviia-i-polozhieniia', 'content', 1, 1, 2, 0, 7, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 2),
(8, 8, NULL, 'ОБСЛУЖИВАНИЕ КЛИЕНТОВ', 'obsluzhivaniie-kliientov', 'content', 2, 1, 2, 0, 8, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 2),
(9, 9, NULL, 'Условия возврата и замена', 'usloviia-vozvrata-i-zamiena', 'content', 3, 1, 2, 0, 9, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 2),
(10, 11, NULL, 'Company Details', 'company-details', 'content', 0, 1, 2, 0, 10, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 3),
(11, 11, NULL, 'SIZE GUIDE', 'size-guide', 'content', 1, 1, 2, 0, 11, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 3),
(12, 11, NULL, 'Making a Purchase', 'making-a-purchase', 'content', 2, 1, 2, 0, 12, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 3),
(13, 11, NULL, 'Delivery Schedule', 'delivery-schedule', 'content', 3, 1, 2, 0, 13, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 3),
(14, 11, NULL, 'PRIVACY POLICY', 'privacy-policy', 'content', 4, 1, 2, 0, 14, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 3),
(15, NULL, NULL, 'Магазин-Пронто', 'maghazin-pronto', 'shop', 5, 1, 2, 0, 15, 1, 'a:1:{s:6:"cat_id";s:1:"6";}', NULL, NULL, 3),
(16, NULL, NULL, 'Магазин-Сток', 'maghazin-stok', 'shop', 2, 1, 2, 0, 16, 1, 'a:1:{s:6:"cat_id";s:1:"7";}', NULL, NULL, 3),
(17, 16, NULL, 'Оплата', 'oplata', 'content', 5, 1, 2, 0, 17, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, NULL, 2),
(18, NULL, NULL, 'Контакты', 'kontakty', 'url', 6, 1, 2, 0, 18, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, 'contacts', 1),
(19, NULL, NULL, 'Мой аккаунт', 'moi-akkaunt', 'url', 1, 1, 2, 0, 19, 1, 'a:1:{s:6:"cat_id";s:1:"1";}', NULL, 'user_profile', 4);

-- --------------------------------------------------------

--
-- Table structure for table `CMS_Menu_Type`
--

CREATE TABLE `CMS_Menu_Type` (
  `id` int(11) NOT NULL,
  `status_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CMS_Menu_Type`
--

INSERT INTO `CMS_Menu_Type` (`id`, `status_id`, `name`) VALUES
(1, 1, 'mainMenu'),
(2, 1, 'footerMenu'),
(3, 1, 'term'),
(4, 1, 'term2');

-- --------------------------------------------------------

--
-- Table structure for table `CMS_Pages`
--

CREATE TABLE `CMS_Pages` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `keywords` longtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `published` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL,
  `params` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `images` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `main_images` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CMS_Pages`
--

INSERT INTO `CMS_Pages` (`id`, `parent_id`, `fullName`, `alias`, `content`, `status`, `title`, `description`, `keywords`, `created`, `published`, `update_date`, `params`, `images`, `main_images`) VALUES
(1, NULL, 'Главная', 'home', NULL, 1, 'Главная', NULL, NULL, '2016-03-11 01:49:02', '2016-03-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:2:{i:0;s:9:"hideTitle";i:1;s:8:"hideText";}}', NULL, NULL),
(2, NULL, 'Коллекции', 'kollekcii', NULL, 1, 'Коллекции', NULL, NULL, '2016-03-11 01:56:41', '2016-03-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:2:{i:0;s:9:"hideTitle";i:1;s:8:"hideText";}}', NULL, NULL),
(3, NULL, 'Для бизнеса', 'b2b', NULL, 1, 'Для бизнеса', NULL, NULL, '2016-03-11 01:57:59', '2016-03-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:2:{i:0;s:9:"hideTitle";i:1;s:8:"hideText";}}', NULL, NULL),
(4, NULL, 'Блог', 'blog', NULL, 1, 'Блог', NULL, NULL, '2016-03-11 01:58:34', '2016-03-01 00:00:00', '2016-07-25 19:53:52', 'a:1:{s:4:"hide";a:2:{i:0;s:9:"hideTitle";i:1;s:8:"hideText";}}', NULL, 'a:1:{i:0;s:31:"http://toolai.dev/uploads/3.png";}'),
(5, 4, 'БРЕНД ТУЛАЙ  ВПЕРВЫЕ ВЫСТУПИЛ  НА МЕЖДУНАРОДНОЙ ТОРГОВОЙ АРЕНЕ', 'brend-tulaj -vpervye-vystupil -na-mezhdunarodnoj-torgovoj-arene', '<p>В феврале 2016 бренд Тулай впервые выступил на международной торговой арене, на Премиум класса выставке СПМ в Москве, где собираются ведущие торговые марки одежды со всего мира.</p>\r\n\r\n<p>Благодаря специальной программе по поддержке молодых дизайнеров, наш бренд был выбран из числа многих претендентов, что очень сильно помогло нам в нашем профессиональном продвижении.</p>\r\n\r\n<p><img alt="" src="/uploads/20160223_111829.jpg" style="height:118px; width:220px" /></p>\r\n\r\n<p><img alt="" src="/uploads/novost3-1.JPG" style="height:370px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/novost3-2.JPG" style="height:370px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_111829.jpg" style="height:312px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_112008.jpg" style="height:987px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_120734.jpg" style="height:987px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_120846.jpg" style="height:987px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_120921.jpg" style="height:987px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_111646.jpg" style="height:312px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/20160223_111713.jpg" style="height:312px; width:555px" /></p>\r\n\r\n<p>&nbsp;</p>', 1, 'БРЕНД ТУЛАЙ  ВПЕРВЫЕ ВЫСТУПИЛ  НА МЕЖДУНАРОДНОЙ ТОРГОВОЙ АРЕНЕ', NULL, NULL, '2016-03-11 01:58:58', '2016-04-05 00:00:00', '2016-04-29 10:59:03', 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(6, NULL, 'Контакты', 'kontakty', '<h4>Контакты</h4>\r\n\r\n<p><strong>TOOLAI-FASHION</strong></p>\r\n\r\n<p>ИП БЕЙШЕНОВА С.К</p>\r\n\r\n<p>ИНН: 11911197800749</p>\r\n\r\n<p>ОКПО: 29175022</p>\r\n\r\n<p>ДЗЕРЖИНСКОГО 30, Г.БАЛЫКЧЫ</p>\r\n\r\n<p>КЫРГЫЗСТАН</p>\r\n\r\n<p>Т: +996 3944 70590</p>\r\n\r\n<p>М: +996 707 91 43 35</p>\r\n\r\n<p>Е: toolai.fashion@gmail.com , aseleleonora.b@gmail.com</p>\r\n\r\n<p>W: www.tоolai-fashion.com , www.toolai-fashion.ru</p>', 1, 'Контакты', NULL, NULL, '2016-03-11 02:02:09', '2016-03-01 00:00:00', '2016-08-16 07:56:34', 'a:1:{s:4:"hide";a:1:{i:0;s:9:"hideTitle";}}', 'a:0:{}', 'a:0:{}'),
(7, NULL, 'Условия и положения', 'uslovija-i-polozhenija', '<p>Добро пожаловать в интернет магазин TOOLAI-FASHION.RU&nbsp; Если вы по-прежнему просматриваете и используете этот сайт, вы соглашаетесь с условиями и правилами использования&nbsp; сайта TOOLAI-FASHION.RU, которые вместе с нашей политикой конфиденциальности устанавливают отношения с вами с нашим веб-сайтом TOOLAI-FASHION.RU.</p>\r\n\r\n<p>Если вы согласны с условиями использования нашего сайта, то, пожалуйста, обратите внимание, что эти условия могут быть изменены без предварительного уведомления, и вы должны проверять эту страницу регулярно, чтобы убедиться, что вы читали самую последнюю версию и согласны с нашими условиями использования. Любые изменения, внесенные после установленного вами заказа, не будет влиять на порядок проведения вашего заказа.</p>\r\n\r\n<p>Если вы не согласны с каким-либо пунктом Условий и Политикой нашей компании , вы можете не использовать наш сайт.</p>\r\n\r\n<p>Эта версия была обновлена &nbsp;18 апреля 2016 года.</p>', 1, 'Условия и положения', NULL, NULL, '2016-03-16 10:20:50', '2016-03-01 00:00:00', '2016-04-18 09:28:23', 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(8, NULL, 'ОБСЛУЖИВАНИЕ КЛИЕНТОВ', 'obsluzhivanie-klientov', '<ul>\r\n	<li><a href="http://toolai-fashion.ru/">ОБСЛУЖИВАНИЕ КЛИЕНТОВ</a></li>\r\n	<li>&nbsp;</li>\r\n</ul>', 1, 'ОБСЛУЖИВАНИЕ КЛИЕНТОВ', NULL, NULL, '2016-03-23 14:24:42', '2016-03-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(9, NULL, 'УСЛОВИЯ ВОЗВРАТА И ЗАМЕНА', 'uslovija-vozvrata-i-zamena', '<p>УСЛОВИЯ ВОЗВРАТА И ЗАМЕНА</p>', 1, 'УСЛОВИЯ ВОЗВРАТА И ЗАМЕНА', NULL, NULL, '2016-03-23 14:25:10', '2016-03-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(11, NULL, 'Company Details', 'company-details', '<p>WELCOME</p>\r\n\r\n<p>Welcome to the online home of TOOLAI-FASHION.COM If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use, which together with our privacy policy govern TOOLAI-FASHION.COM relationship with you in relation to this website.</p>\r\n\r\n<p>If you agree to the conditions of use for our website, then please note that these terms and conditions are subject to change without notice, and you should check this page regularly to ensure that you have read the most current version and still agree with our conditions of use. Any changes that are made after you have placed an order will not affect that order unless we are required to make that change by law. This Website also contains links to other websites, which are not operated by TOOLAI-FASHION.COM (the &quot;Linked Sites&quot;). TOOLAI-FASHION.COM has no control over the Linked Sites and accepts no responsibility for them or for any loss or damage that may arise from your use of them. Your use of the Linked Sites will be subject to the terms of use and service contained within each such site.</p>\r\n\r\n<p>If you disagree with any part of these Terms and Conditions, our Customer Care or our Cancellations, Returns, Refunds and Exchanges Policy please do not use our website.</p>\r\n\r\n<p>This version of our Terms and Conditions was last updated 4th March 2016.</p>', 1, 'Company Details', NULL, NULL, '2016-04-06 10:26:22', '2016-04-01 00:00:00', NULL, 'a:1:{s:4:"hide";a:1:{i:0;s:9:"hideTitle";}}', NULL, NULL),
(12, 4, 'НОВАЯ КОЛЛЕКЦИЯ НА ОСЕНЬ ЗИМА 2016-17г.', 'novaja-kollekcija-na-osen-zima-2016-17g.', '<p>Новая коллекция на осень-зима 2016-17г.</p>\r\n\r\n<p>Новая осенне-зимняя коллекция бренда Тулай ярко подчеркивает свое концептуальное направление городского кочевника. Свободные формы, комфортная, функциональная и практичная одежда выглядит обманчиво просто, однако создает сильное впечатление в изменении обстановки, времени, места и обстоятельств.</p>\r\n\r\n<p><img alt="" src="/uploads/%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D1%8C%202.jpg" style="height:220px; width:390px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-171NEWS-2.jpg" style="height:794px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-172NEWS-2.jpg" style="height:794px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-174NEWS-2.jpg" style="height:794px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-175NEWS-2.jpg" style="height:794px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-176NEWS-2.jpg" style="height:794px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/FW16-177NEWS-2.jpg" style="height:794px; width:555px" /></p>', 1, 'НОВАЯ КОЛЛЕКЦИЯ НА ОСЕНЬ ЗИМА 2016-17г.', NULL, NULL, '2016-04-07 12:16:47', '2016-04-07 00:00:00', '2016-04-29 10:53:08', 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(13, 4, 'TOOLAI – ЛЕТО 2016', 'toolai-–-leto-2016', '<p>Философия новой коллекции TOOLAI на Лето 2016&nbsp; приблизить человека с самим собой и его окружением с помощью традиционной гармонии&nbsp; между промышленным пространством и &nbsp;силой природы, романтической атмосферой, которая открывается перед космическими горизонтами.</p>\r\n\r\n<p>Это дает ощущение&nbsp; пространства и комфорта&nbsp; и защищенности собственного мира.</p>\r\n\r\n<p>Мягкие натуральные волокна, контрасное освещение как в 70-х напоминающее</p>\r\n\r\n<p>технические цвета, такие как рабочий синий, гранитные оттенки,&nbsp; приглушение ярких взрывов красок, окисленное &nbsp;отражение&nbsp; придают &nbsp;мощную романтическую форму.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>', 1, 'TOOLAI – ЛЕТО 2016', NULL, NULL, '2016-04-07 12:59:13', '2016-04-02 00:00:00', '2016-07-25 21:48:58', 'a:1:{s:4:"hide";a:0:{}}', 'a:4:{i:0;s:49:"http://toolai.dev/uploads/Blouse-Twist-1-SITE.jpg";i:1;s:49:"http://toolai.dev/uploads/Blouse-Osaka-2-SITE.jpg";i:2;s:49:"http://toolai.dev/uploads/SKIRT-STORMY-SITE-2.jpg";i:3;s:51:"http://toolai.dev/uploads/SS16-PICTURE-4-SITE-2.jpg";}', 'a:1:{i:0;s:76:"http://toolai.dev/uploads/%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D1%8C%201.jpg";}'),
(14, 4, 'МЕЖДУНАРОДНАЯ ВЫСТАВКА СПМ', 'mezhdunarodnaja-vystavka-spm', '<p>В рамках международной выставки СПМ, проходящей в феврале этого года, наш бренд Тулай проводил показ новой осенне-зимней коллекции на будущий год. Натуральные ткани, свободные и в то же время классические формы в стиле day-to-night, стоячие ниспадающие пончо, двусторонние утепленные куртки, ассиметричные юбки подчеркивают стиль бренда &laquo;Urban Nomad&raquo; и дают ощущение защищенности, комфорта и непринужденности.</p>\r\n\r\n<p><img alt="" src="/uploads/%D0%BD%D0%BE%D0%B2%D0%BE%D1%81%D1%82%D1%8C%204.jpg" style="height:220px; width:391px" />​</p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-005.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-006.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-008.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-010.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-012.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-014.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-018.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-019.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p><img alt="" src="/uploads/TOOLAI%20LowRes-021.JPG" style="height:833px; width:555px" /></p>\r\n\r\n<p>&nbsp;</p>', 1, 'МЕЖДУНАРОДНАЯ ВЫСТАВКА СПМ', NULL, NULL, '2016-04-07 13:05:50', '2016-04-03 00:00:00', '2016-04-29 11:26:13', 'a:1:{s:4:"hide";a:0:{}}', NULL, NULL),
(15, NULL, 'Агенты', 'agenty', '<p>&nbsp;</p>\r\n\r\n<p><span style="font-size:28px"><span style="font-family:times new roman,times,serif"><strong>Агенты</strong></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>ло невозможно, в соответствии с требованиями &laquo;<a href="https://ru.wikipedia.org/w/index.php?title=Secure_Digital_Music_Initiative&amp;action=edit&amp;redlink=1" title="Secure Digital Music Initiative (страница отсутствует)">Secure Digital Music Initiative</a>&raquo;. Этот факт был отражён в названии стандарта (&laquo;Secure Digital&raquo;). Для записи в защищённую область используется специальный протокол записи, недоступный для обычных пользователей. При этом карта также может быть защищена паролем, без которого доступ к записанной информации невозможен; восстановить работоспособность карты можно только её полным переформатированием с потерей записанной информации.</p>\r\n\r\n<p>Карты формата Secure Digital снабжены механическим<sup><a href="https://ru.wikipedia.org/wiki/Secure_Digital#cite_note-3">[3]</a></sup>&nbsp;переключателем защиты от записи. В положении &laquo;lock&raquo; невозможны запись информации, и, соответственно, удаление файлов и&nbsp;<a href="https://ru.wikipedia.org/wiki/%D0%A4%D0%BE%D1%80%D0%BC%D0%B0%D1%82%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D0%BD%D0%B8%D0%B5_%D0%B4%D0%B8%D1%81%D0%BA%D0%B0" title="Форматирование диска">форматирование</a>&nbsp;карты, что позволяет избежать случайной потери информации. Однако следует учитывать, что собственно защита от записи осуществляется не самой картой, а устройством, использующим карту, и может оказаться в нём не реализованной, либо намеренно отсутствовать. Например, автозагрузка резидентной программы&nbsp;<a href="https://ru.wikipedia.org/wiki/CHDK" title="CHDK">CHDK</a>&nbsp;для фотоаппаратов Canon работает, только когда карта защищена от записи.</p>\r\n\r\n<p>В большинстве случаев SD можно заменить&nbsp;<a href="https://ru.wikipedia.org/wiki/Multimedia_Card" title="Multimedia Card">MMC-картой</a>. Обратная замена обычно невозможна: SD толще и может просто не войти в&nbsp;<a href="https://ru.wikipedia.org/wiki/%D0%A1%D0%BB%D0%BE%D1%82" title="Слот">слот</a>&nbsp;для MMC.</p>', 0, 'Агенты', NULL, NULL, '2016-07-31 14:58:13', '2016-06-27 00:00:00', '2016-08-24 19:13:07', 'a:1:{s:4:"hide";a:1:{i:0;s:9:"hideTitle";}}', 'a:0:{}', 'a:0:{}'),
(16, NULL, 'Оплата', 'oplata', '<p>оплата</p>', 1, 'Оплата', NULL, NULL, '2016-07-31 15:16:15', '2016-06-29 00:00:00', NULL, 'a:1:{s:4:"hide";a:0:{}}', 'a:0:{}', 'a:0:{}'),
(17, NULL, 'Магазины', 'magaziny', '<p>Магазины тут</p>', 1, 'Магазины', NULL, NULL, '2016-08-16 08:01:36', '2016-07-31 00:00:00', NULL, 'a:1:{s:4:"hide";a:0:{}}', 'a:0:{}', 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `CMS_Widget`
--

CREATE TABLE `CMS_Widget` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hideTitle` tinyint(1) NOT NULL DEFAULT '1',
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `html` longtext COLLATE utf8_unicode_ci,
  `title_html` longtext COLLATE utf8_unicode_ci,
  `params` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `orderning` int(11) DEFAULT '0',
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `menu_check` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_src` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CMS_Widget`
--

INSERT INTO `CMS_Widget` (`id`, `title`, `hideTitle`, `type`, `html`, `title_html`, `params`, `orderning`, `position`, `status`, `class`, `menu_check`, `youtube_src`) VALUES
(1, 'menu', 0, 'menu', NULL, NULL, 'a:9:{s:8:"MenuType";i:1;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', -1, 'mainMenu', 1, 'nav navbar-nav navbar-nav-menu', 'all', NULL),
(2, 'слайдер', 0, 'slider', NULL, NULL, 'a:9:{s:8:"MenuType";N;s:11:"SliderCount";i:4;s:11:"SliderSpeed";i:5999;s:11:"SliderTitle";i:0;s:10:"SliderHref";i:0;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', 0, 'carousel', 1, NULL, 'main', NULL),
(3, 'текс', 0, 'html', '<div class="pink">\r\n<div class="container-fluid">\r\n<div class="row">\r\n<div class="col-sm-6 col-sm-offset-3 text-center">\r\n<h3><strong><span style="color:#FFFFFF"><span style="font-size:26px">КОМФОРТ &nbsp; &nbsp; &nbsp; ФУНКЦИОНАЛЬНОСТЬ &nbsp; &nbsp; &nbsp; ПРАКТИЧНОСТЬ</span></span></strong></h3>\r\n</div>\r\n</div>\r\n</div>\r\n</div>', NULL, 'a:9:{s:8:"MenuType";N;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', 0, 'pink', 1, NULL, 'in_menu', NULL),
(4, 'левый верхний блок', 0, 'html', '<div class="category-item new-1"><a href="/maghazin.html"><img alt="" src="/uploads/11%2022.jpg" style="height:427px; width:499px" /></a></div>', '<div class="category-item new-1"><a href="/maghazin.html"><img alt="" src="/uploads/11%2022.jpg" style="height:427px; width:499px" /></a></div>', 'a:9:{s:8:"MenuType";N;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";i:16;s:11:"ProductHref";N;}', 0, 'category_left_1', 1, NULL, 'in_menu', NULL),
(5, 'левый нижний блок', 0, 'product', '<div class="category-item new-2"><img alt="image" src="/uploads/2222.jpg" /></div>', '<div class="category-item new-2"><img alt="image" src="/uploads/2222.jpg" /></div>', 'a:9:{s:8:"MenuType";N;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";i:4;s:11:"ProductHref";N;}', 0, 'category_left_2', 1, NULL, 'in_menu', '<iframe width="853" height="480" src="https://www.youtube.com/embed/SDNbTD2nTsc?list=RDbRDFuNr7ceI&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>'),
(6, 'Правй блок', 0, 'html', '<div class="category-item new-3"><a class="category-item-link" href="kolliektsii/kolliektsiia/viesna-lieto-2016.html"><img alt="image" src="/uploads/3333.jpg" /> </a></div>', NULL, 'a:9:{s:8:"MenuType";N;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', 0, 'category_right', 1, NULL, 'in_menu', NULL),
(7, 'footermenu', 0, 'menu', NULL, NULL, 'a:9:{s:8:"MenuType";i:2;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', NULL, 'footerMenu', 1, 'list-unstyled list-inline', 'all', NULL),
(8, 'menu TErms', 0, 'menu', NULL, NULL, 'a:9:{s:8:"MenuType";i:1;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', 0, 'left_menu', 1, 'list-unstyled terms-menu-list', 'in_menu', NULL),
(9, 'tems2', 0, 'menu', NULL, NULL, 'a:9:{s:8:"MenuType";i:4;s:11:"SliderCount";N;s:11:"SliderSpeed";N;s:11:"SliderTitle";N;s:10:"SliderHref";N;s:8:"Category";N;s:12:"CategoryHref";N;s:7:"Product";N;s:11:"ProductHref";N;}', 5, 'left_menu', 1, 'list-unstyled terms-menu-list', 'in_menu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `CMS_widget_menu`
--

CREATE TABLE `CMS_widget_menu` (
  `widget_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `CMS_widget_menu`
--

INSERT INTO `CMS_widget_menu` (`widget_id`, `menu_id`) VALUES
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(8, 7),
(8, 9),
(9, 8),
(9, 9),
(9, 10);

-- --------------------------------------------------------

--
-- Table structure for table `email_db`
--

CREATE TABLE `email_db` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_date` datetime NOT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci,
  `created` datetime DEFAULT NULL,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `legal_person`
--

CREATE TABLE `legal_person` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `director_fio` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_index` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `house_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requisite1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `requisite2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fact_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fact_p_index` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fact_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fact_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fact_house_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phoneNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `whats_app` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` tinytext COLLATE utf8_unicode_ci,
  `email2` tinytext COLLATE utf8_unicode_ci,
  `site` tinytext COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `legal_person`
--

INSERT INTO `legal_person` (`id`, `user_id`, `company_name`, `company_type`, `position`, `fio`, `inn`, `director_fio`, `country`, `p_index`, `city`, `street`, `house_number`, `requisite1`, `requisite2`, `fact_country`, `fact_p_index`, `fact_city`, `fact_street`, `fact_house_number`, `phoneNumber`, `mobile_number`, `whats_app`, `email1`, `email2`, `site`) VALUES
(1, 2, 'qwe', 'Web', 'qwe', 'qqq www eee', '1231241241b124', 'qweeq qeqwe qweqw', 'Kyrgyzstan', '123123', 'Bishkek', 'Toktogula', '123', '123214214', '12321312321', 'Kg', '123124124214214', 'rfghjk', 'dfvbgnm', '13', '234 45 456', '770 123 123', '2132414214', 'rersefd@qwe', 'werw@123', 'www.wertew.com'),
(2, 5, 'company', NULL, NULL, 'Mavlyanov', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'http://dev.toolai-fashion.ru/admin/user/'),
(3, 6, 'company', NULL, NULL, 'fio', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 7, 'Company2', NULL, NULL, 'Ivanov', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ordering_products`
--

CREATE TABLE `ordering_products` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `color_id` int(11) DEFAULT NULL,
  `size_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  `type_id` int(11) DEFAULT NULL,
  `pronto_type` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ordering_products`
--

INSERT INTO `ordering_products` (`id`, `product_id`, `color_id`, `size_id`, `count`, `type_id`, `pronto_type`) VALUES
(1, 5, 7, 1, 1, NULL, NULL),
(2, 5, 7, 1, 1, NULL, NULL),
(3, 4, 3, 3, 1, NULL, NULL),
(4, 6, 8, 2, 1, NULL, NULL),
(5, 6, 8, 3, 1, NULL, NULL),
(6, 6, 8, 2, 1, 6, 1),
(7, 6, 8, 3, 1, 6, 1),
(8, 4, 4, 4, 1, 1, 0),
(9, 6, 8, 2, 1, 6, 1),
(10, 6, 8, 3, 1, 6, 1),
(11, 4, 4, 4, 1, 1, 0),
(12, 6, 8, 2, 4, 6, 1),
(13, 6, 8, 3, 3, 6, 1),
(14, 4, 4, 4, 2, 1, 0),
(15, 6, 8, 2, 2, 6, 1),
(16, 6, 8, 3, 2, 6, 1),
(17, 6, 10, 2, 3, 6, 1),
(18, 6, 10, 3, 3, 6, 1),
(19, 4, 3, 4, 1, 1, 0),
(20, 6, 8, 2, 1, 6, 1),
(21, 6, 8, 3, 1, 6, 1),
(22, 4, 3, 4, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `shipping_method_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `l_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `house_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `p_index` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `shipping_method_id`, `email`, `f_name`, `l_name`, `address`, `house_number`, `city`, `country`, `state`, `p_index`, `phone`, `status_id`, `user_id`, `date`) VALUES
(9, 2, 'testuser23@mail.ru', 'company', 'Mavlyanov', 'asdasdas', 'выа', 'asdasd', 'asdas', NULL, 'dasd', 'sdfdsd', 1, 5, NULL),
(10, 1, 'testuser23@mail.ru', 'company', 'Mavlyanov', 'Киевская 96', NULL, 'asdasd', 'asdas', NULL, 'sdf', '0772 16 87 35', 1, 5, '2016-08-16 07:36:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE `orders_products` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`order_id`, `product_id`) VALUES
(9, 15),
(9, 16),
(9, 17),
(9, 18),
(9, 19),
(10, 20),
(10, 21),
(10, 22);

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`id`, `name`) VALUES
(1, 'Оформлен');

-- --------------------------------------------------------

--
-- Table structure for table `ref_status`
--

CREATE TABLE `ref_status` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_add` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ref_status`
--

INSERT INTO `ref_status` (`id`, `name`, `date_add`) VALUES
(1, 'Активный', '2016-03-11 01:49:38'),
(2, 'Не активный', '2016-03-11 01:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `email`) VALUES
(1, 'toolai.fashion@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) DEFAULT NULL,
  `coast` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`id`, `name`, `type`, `coast`) VALUES
(1, 'Бесплатно - заказ от 20 единиц и выше.', 2, 500),
(2, 'Простая доставка - 1000 руб/сом , 2-5 дней', 1, 300),
(3, 'Платная доставка', 2, 300);

-- --------------------------------------------------------

--
-- Table structure for table `shop_category`
--

CREATE TABLE `shop_category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sale` tinyint(1) NOT NULL DEFAULT '0',
  `b2b` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_category`
--

INSERT INTO `shop_category` (`id`, `parent_id`, `name`, `alias`, `description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `status`, `orderning`, `lft`, `rgt`, `lvl`, `root`, `logo`, `sale`, `b2b`) VALUES
(1, NULL, 'Магазин', 'maghazin', NULL, 'Магазин', NULL, NULL, 1, 0, 1, 2, 0, 1, '8393a8b7062ea2f68e489e9c060fda7fcc483746.png', 0, NULL),
(2, NULL, 'Коллекция', 'kolliektsiia', NULL, 'Коллекция', NULL, NULL, 1, 0, 1, 22, 0, 2, NULL, 0, NULL),
(3, 2, 'Весна лето 2016', 'kolliektsiia/viesna-lieto-2016', NULL, 'Весна лето 2016', NULL, NULL, 1, 1, 2, 3, 1, 2, '4d799911384a06a8df001ece60403c7918646d8b.png', 1, NULL),
(4, NULL, 'Для бизнеса', 'dlja-biznesa', NULL, 'Для бизнеса', NULL, NULL, 1, 0, 1, 8, 0, 4, NULL, 0, NULL),
(5, 4, 'pret-a-porter', 'pretaporter', NULL, 'pret-a-porter', NULL, NULL, 1, 1, 2, 3, 1, 4, 'c16a89071f390fb2e083e923be8aad32e3729c43.jpeg', 1, 'pret-a-porter'),
(6, 4, 'pronto', 'pronto', NULL, 'pronto', NULL, NULL, 1, 2, 4, 5, 1, 4, '36f5021e5d600eb2807ad61f585d6bbcc8a95d28.jpeg', 1, 'pronto'),
(7, 4, 'склад', 'sklad', NULL, 'склад', NULL, NULL, 1, 3, 6, 7, 1, 4, '5e8add8a96316afa10aefb9df10534bb3aa92124.jpeg', 1, 'stock'),
(8, 2, 'ЗИМА - ОСЕНЬ 13/14', 'zima--osen-13/14', NULL, 'ЗИМА - ОСЕНЬ 13/14', NULL, NULL, 1, 2, 4, 5, 1, 2, '650e0476072d68460978d3d4b7c98f89ace5eca5.jpeg', 0, NULL),
(9, 2, 'ВЕСНА - ЛЕТО 15', 'vesna--leto-15', NULL, 'ВЕСНА - ЛЕТО 15', NULL, NULL, 1, 3, 6, 7, 1, 2, '86160772310efd1bf4375e578905890a7dcee51c.jpeg', 0, NULL),
(10, 2, 'ЗИМА - ОСЕНЬ 15/16', 'zima--osen-15/16', NULL, 'ЗИМА - ОСЕНЬ 15/16', NULL, NULL, 1, 4, 8, 9, 1, 2, '8446f502db3ac64c64ba806ce3833c09927c992d.jpeg', 0, NULL),
(11, 2, 'ВЕСНА - ЛЕТО 14', 'vesna--leto-14', NULL, 'ВЕСНА - ЛЕТО 14', NULL, NULL, 1, 5, 10, 11, 1, 2, 'ec08b48a28ad1adc7dc62966077e40d26f043482.jpeg', 0, NULL),
(12, 2, 'ss11', 'ss11', NULL, 'ss11', NULL, NULL, 1, 6, 12, 13, 1, 2, NULL, 0, NULL),
(13, 2, 'fw12-13', 'fw1213', NULL, 'fw12-13', NULL, NULL, 1, 7, 14, 15, 1, 2, '5926a7717b2a0a3e715c227e74528e6ab8dfab8a.jpeg', 0, NULL),
(14, 2, 'ss13', 'ss13', NULL, 'ss13', NULL, NULL, 1, 8, 16, 17, 1, 2, NULL, 0, NULL),
(15, 2, 'fw11-12', 'fw1112', NULL, 'fw11-12', NULL, NULL, 1, 9, 18, 19, 1, 2, NULL, 0, NULL),
(16, 2, 'ss12', 'ss12', NULL, 'ss12', NULL, NULL, 1, 10, 20, 21, 1, 2, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_color`
--

CREATE TABLE `shop_color` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_color`
--

INSERT INTO `shop_color` (`id`, `name`, `logo`) VALUES
(1, '123', 'a7c6ed207f41db8dd42251c908b64c96e1036c04.png'),
(2, '312', '5b60b69e9f1c4c8d5c529d85e153ee9cbcd7afdf.png'),
(3, 'шторми', '2b3701d33b53be6a1cf09bf828330e693a3a633d.jpeg'),
(4, 'дымчатое дерево', '8f0c5fc2bf07330a1d50fd38d540dabc2dadfa2f.jpeg'),
(5, 'темно-синий', '5419c09a5223089b1ada0abed4f9aa0b1ac7af69.jpeg'),
(6, 'паприка', 'cd3d63bac764a53d3c2f919444e41b06e2db2966.jpeg'),
(7, 'Черный', '9eb8d2c608a894021dd4de8a2e9e0a08f5d9bdd5.jpeg'),
(8, 'шторми', '284f55efc241b4aaf0377bad2fb253614503da68.jpeg'),
(9, 'дымчатое дерево', '6541614cb183b9977bed5eb5c5a694e559b6eaab.jpeg'),
(10, 'темно-синий', 'a63f52cb1aa400952fb5f5d1052ca0a4ffd985b1.jpeg'),
(11, 'паприка', '5f0917f8469a2c4962a71dc11981f05174a6eeec.jpeg'),
(12, 'темно-синий батик', '9114e2627d715ae717a0f914d83147e6bb7c51b4.jpeg'),
(13, 'аквамарин батик', '45e607023a3e553a5d15aa50b5615ea3ae7664c1.jpeg'),
(14, 'шторми батик', 'b9c3ee329fb4ead6e5a035fa7a9b59167145c364.jpeg'),
(15, 'шторми', 'df083eefa7febda8f037607e60666eb3130810b1.jpeg'),
(16, 'аквамарин', '414652c622ce5fcba210521d565c1474da44ec5e.jpeg'),
(17, 'темно-синий', 'e24af7af0eef3a52f5e9a0bd9c5ece6aa1525c19.jpeg'),
(18, 'оливковый', '3e68db98b82733056bd1b15ca0a558236f28c913.jpeg'),
(19, 'шторми', '3305de98ac7563267057e3a527b8ef1f6a777be1.jpeg'),
(20, 'дымчатое дерево', 'e7d2ca0da419c2f507f107b3cec3ccccca1e359e.jpeg'),
(21, 'темно-синий', '59689ea0b7ca70a493c6cd26d9ed9120e52fdba5.jpeg'),
(22, 'паприка', '50c2c3410707a050c6ad6a498d1ed9da56003aec.jpeg'),
(23, 'шторми', '59560b62d40191e1f757e9320e91e9994ab6bf17.jpeg'),
(24, 'аквамарин', '6afa5c2598d47fe5033632d0abebfec236707794.jpeg'),
(25, 'дымчатое дерево', 'bbe5152d4cf34f37449496a1078c3b10f1bb4bc9.jpeg'),
(26, 'оливковый', '2836ba52c40a299657dbcae8d613ebed9a7548c9.jpeg'),
(27, 'черный', 'd4122d657ea27388df3fdf120e619d36b74db55a.jpeg'),
(28, 'белый', '142798c450616e2823143c1839bd1af8afcb1810.jpeg'),
(29, 'оливковый', '3a29bce4cedaffdb13fc1ef00b48fd18401c95c1.jpeg'),
(30, 'дымчатое дерево', 'd3d2b71566f6f5a96275fc260debda9a9625cf01.jpeg'),
(31, 'темно-синий', '135c375834e96a639096b5ee9bf72eca823efdf0.jpeg'),
(32, 'оливковый', 'f2d7d40dc7b0fbe4d20319c6a6ab7a4aa324f7a3.jpeg'),
(33, 'белый', '73180e680e43a34ef7fa17ecf162f14f51c5de66.jpeg'),
(34, 'темно-синий батик', '46841e1034a61b58d61450e57f32532a22059c05.jpeg'),
(35, 'аквамарин батик', '76c7b19f966a33f3808846c8220d6548cb286bee.jpeg'),
(36, 'шторми батик', 'a2c952f890530890c1edab9858399dc8ad1fea8e.jpeg'),
(37, 'аквамарин', '5497e44a13d56259fd31c6eb5179ceae32faec0b.jpeg'),
(38, 'дымчатое дерево', '23828058c3b8c7b8c2d5053f6780dc817e90b10e.jpeg'),
(39, 'паприка', '3cc59bb85450caab6dfe159ab33c8e816dc476ac.jpeg'),
(40, 'темно-синий', '45db87daf51decf5b42f3d9ad81f1a33e5e14fc9.jpeg'),
(41, 'черный', '152bbe29ea070db3d107110029077c670c4309e0.jpeg'),
(42, 'шторми', 'b3c4f573897867c4271552841465af516fa0ae5d.jpeg'),
(43, 'дымчатое дерево', '052aedb74f98c1bcf61f2b0d6f05d5240b3f2ed2.jpeg'),
(44, 'темно-синий', '5d03e6e4df60eda9f9a3ea360688523a95d51b23.jpeg'),
(45, 'паприка', '970813d3efa8d5b0dcd72ea8521b47d0ad8c42bb.jpeg'),
(46, 'темно-синий батик', '63b9708ec092c3acfe356c2eadc7c035e09387fa.jpeg'),
(47, 'аквамарин батик', 'dc7eeeed0973b40ca58fe805670c35139b5aaf3a.jpeg'),
(48, 'шторми батик', 'd7e44822e0a5478d23a144b076529d4ddadd2e1d.jpeg'),
(49, 'белый', '909f08457ff4c4617e1b336b61120f403c78cc50.jpeg'),
(50, 'аквамарин', 'f020b69b5df0f9ba87385bcea141f98c2d8b6c59.jpeg'),
(51, 'оливковый', 'ffb64bb0ba69e4e44e96ef50e53954ceb064d542.jpeg'),
(52, 'паприка', '8b4a584fb04f85c13f46618b55f24da768807542.jpeg'),
(53, 'темно-синий', 'e4298cf40f9726e941607d713dea7c54a5ae817b.jpeg'),
(54, 'черный', 'db4f26cdb06aee54086198a5323cfb3da54ec0e3.jpeg'),
(55, 'белый', '8c3200c9032663fcf398b8db283ec2a208de669d.jpeg'),
(56, 'аквамарин', 'ca8a82e7624d9da808b463e152dd6f59d184f2e5.jpeg'),
(57, 'темно-синий', '60be1412fe3842b1804748b6cd42c714dd6ccab5.jpeg'),
(58, 'дымчатое дерево', 'b1fa6e59a1e3a5a0414011f037dce7520e416b3a.jpeg'),
(59, 'паприка', 'e7770d5e3b6cfa63631bfb7a528075102c3cd921.jpeg'),
(60, 'черный', 'b08f1061dceff55c324c318f1bc0aeabd1d1d720.jpeg'),
(61, 'белый', '7b35e04db5629b1a9e1b251766d88156c8d60976.jpeg'),
(62, 'шторми', '0b70f0bb6aed19187e647c0142597a9fd18b4728.jpeg'),
(63, 'черный', '3cbc5de2b253c454524a754a63ecd576343d534e.jpeg'),
(64, 'дымчатое дерево', '5b6bc6bd39ddc23025e709a028c4b5a714155eb3.jpeg'),
(65, 'дымчатое дерево', 'bc0616ba6ccaabba079b88641b7e8aba062c27f3.jpeg'),
(66, 'белый', 'dfac0d28c6636e634369a3f17ef0386f109ff6b5.jpeg'),
(67, 'глубокий атлантический', '620ffd3fe2efb0d7c81ea3f2be31ef4dbfe0c50c.jpeg'),
(68, 'белый', 'bd4bef3c247445e916a42bd64a6acdb036df8e44.jpeg'),
(69, 'глубокий атлантический', 'fc3bc4d0af8e9b66deb09b81dc3779acef07f58f.jpeg'),
(70, 'белый', '70642a83cf6899edbccd38ab372f55a9f0faf028.jpeg'),
(71, 'шторми', 'f2a7ecd1918f1ece2e3068a6eadbb38893ce189a.jpeg'),
(72, 'шторми', 'ad7d2e827badbdbef5b5d093ecd3a1473b87cded.jpeg'),
(73, 'темно-синий', '081739bbd0d521bf621817233a85703f277c7717.jpeg'),
(74, 'оливковый', '8b608c670c0c7ca58ee18dfc65b8e0086f6eeeab.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_filters`
--

CREATE TABLE `shop_filters` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_filters`
--

INSERT INTO `shop_filters` (`id`, `name`, `created`, `status`) VALUES
(1, 'Новая', '2016-03-16 12:08:48', 1),
(2, 'Платья', '2016-03-16 12:09:19', 1),
(3, 'Блузки', '2016-03-16 12:09:49', 1),
(8, 'Юбки-Брюки', '2016-03-24 08:55:56', 1),
(10, 'Жакеты-Плащи-Пальто', '2016-03-25 08:52:19', 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product`
--

CREATE TABLE `shop_product` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `meta_tag_description` longtext COLLATE utf8_unicode_ci,
  `meta_tag_keywords` longtext COLLATE utf8_unicode_ci,
  `tags` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `composition` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `images` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price_discount` decimal(10,2) DEFAULT NULL,
  `price_b2b` decimal(10,2) DEFAULT NULL,
  `categoryB2B_id` int(11) DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product`
--

INSERT INTO `shop_product` (`id`, `category_id`, `name`, `alias`, `description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `tags`, `composition`, `style`, `price`, `status`, `orderning`, `images`, `logo`, `type`, `price_discount`, `price_b2b`, `categoryB2B_id`, `note`) VALUES
(4, 3, 'ПЛАТЬЕ "ИЗИ"', 'plate-izi', '<p>Летнее платье day-to-night &nbsp;из легкой вискозы длиной чуть выше колена, &nbsp;как для работы, так и для активного вечера.</p>', 'платье', 'Летнее платье day-to-night  из легкой вискозы длиной чуть выше колена,  как для работы, так и для активного вечера.', 'дизайн, мода, платье, лето, вискоза, отдых, работа, натуральный', 'платье, лето, вискоза, отдых, работа, натуральный, дизайн, мода,', '100% ВИСКОЗА ПОПЛИН', '1002.1', '8750.00', 1, 1, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-83-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-83-SITE-3.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-83-SITE-2.jpg";}', 'e9f67b58be2936067212ee6e67a9bd8bb0c45033.jpeg', NULL, '2000.00', '3500.00', 7, 'Примечание'),
(5, 3, 'ПЛАТЬЕ "СЛИМ ДЖЕРСИ"', 'plate-slim-dzhersi', '<p>Длинное платье из мягкой трикотажной вискозы, плавно облегающего силуэта, наиболее подходящий выбор в жаркие летние дни и прохладные вечера.</p>', 'платье', 'Длинное платье из мягкой трикотажной вискозы, плавно облегающего силуэта, наиболее подходящий выбор в жаркие летние дни и прохладные вечера.', NULL, NULL, '100%ВИСКОЗА ТРИКОТАЖ', '1003.1', '4750.00', 1, 2, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-13-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-13-SITE-2.jpg";}', '45b86edac8a9c433944ca768ef397755ce7d0851.jpeg', NULL, NULL, '1900.00', 6, NULL),
(6, 3, 'ПЛАТЬЕ-РУБАХА "НОЧНОЙ БЛЮЗ"', 'platerubaha-nochnoj-bljuz', '<p>Платье-рубашка свободного силуэта , 100-процентная вискоза приятно охлаждает в жаркую погоду</p>', 'ПЛАТЬЕ-РУБАХА "НОЧНОЙ БЛЮЗ"', 'Платье-рубашка свободного силуэта , 100-процентная вискоза приятно охлаждает в жаркую погоду', 'Платье, рубашка,силуэт,  вискоза, мода, дизайн', NULL, '100%ВИСКОЗА   ПОПЛИН', '1006.1', '7250.00', 1, 3, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-66-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-66-SITE-2.jpg";}', 'bce83432cb7af062db741162a5002926f1071ee4.jpeg', 'Платье-рубашка свободного силуэта', NULL, '2900.00', 6, 'Примечание текст тест итд'),
(7, 3, 'ПЛАТЬЕ-САРАФАН В ТРИ УРОВНЯ "БАТИК"', 'platesarafan-v-tri-urovnja-batik', '<p>Легкий сарафан на тоненьких бретелях в трех уровнях , проделанный &nbsp;в технике батик вручную.</p>', 'ПЛАТЬЕ-САРАФАН В ТРИ УРОВНЯ "БАТИК"', 'Легкий сарафан на тоненьких бретелях в трех уровнях , проделанный  в технике батик вручную.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНАЯ  ВУАЛЬ', '1007.1', '7750.00', 1, 4, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-26-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-26-SITE-2.jpg";}', '2d9328debe194c982d4d1fb2f5627cad74bfd8c4.jpeg', 'Легкий сарафан на тоненьких бретелях', NULL, '3100.00', 6, NULL),
(8, 3, 'ПЛАТЬЕ МАКСИ "БЛЮ ДЖИН"', 'plate-maksi-blju-dzhin', '<p>Длинное Бохо-стиль сарафан-платье с широким воланом по низу, отлично подойдет в жаркий день и теплый летний вечер.</p>', 'ПЛАТЬЕ МАКСИ "БЛЮ ДЖИН"', 'Длинное Бохо-стиль сарафан-платье с широким воланом по низу, отлично подойдет в жаркий день и теплый летний вечер.', NULL, NULL, '100% ВИСКОЗА ПОПЛИН', '1011.1', '11750.00', 1, 5, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-45-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-45-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-45-SITE-3.jpg";}', '66371546c22e750f60c1f48ccf465076a4a17b58.jpeg', 'Длинное Бохо-стиль сарафан-платье', NULL, '4700.00', 6, NULL),
(9, 3, 'ПЛАТЬЕ МАКСИ V-ГОРЛОВИНА "ШТОРМИ"', 'plate-maksi-vgorlovina-shtormi', '<p>Длинное платье свободного кроя, отличное решение для прогулок по побережью.</p>', 'ПЛАТЬЕ МАКСИ V-ГОРЛОВИНА "ШТОРМИ"', 'Длинное платье свободного кроя, отличное решение для прогулок по побережью', NULL, NULL, '100%ВИСКОЗА ПОПЛИН', '1012.1', '9750.00', 1, 6, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-50-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-50-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-50-SITE-3.jpg";}', '121134498fd5fb413f285755a93d86fbe743c1dd.jpeg', 'Длинное платье свободного кроя', NULL, '3900.00', 6, NULL),
(10, 3, 'ДЛИНОЕ ПЛАТЬЕ-РУБАХА "ДЖЕНИС ДЖОПЛИН"', 'dlinoe-platerubaha-dzhenis-dzhoplin', '<p>Многофункциональное платье-рубашка длинного силуэта из 100-процентного хлопка, благодаря мелким пуговицам в разрезах из одной модели возможно представить как минимум три.</p>', 'ДЛИНОЕ ПЛАТЬЕ-РУБАХА "ДЖЕНИС ДЖОПЛИН"', 'Многофункциональное платье-рубашка длинного силуэта из 100-процентного хлопка, благодаря мелким пуговицам в разрезах из одной модели возможно представить как минимум три.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНЫЙ ПОПЛИН', '1013.1', '7750.00', 1, 7, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-18-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-18-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-18-SITE-3.jpg";}', '6edfd80220bb94ae35bb26fc5dcd85811fba60bf.jpeg', 'Многофункциональное платье-рубашка', NULL, '3100.00', 6, NULL),
(11, 3, 'ШЕЛКОВОЕ  ПЛАТЬЕ "КОКОН"', 'shelkovoe--plate-kokon', '<p>Коктейльное платье в стиле БОХО из хлопчатобумажного шелка с рукавом 3/4 &nbsp;идеальное решение для выхода в летний вечер.</p>', 'ШЕЛКОВОЕ  ПЛАТЬЕ "КОКОН"', 'Коктейльное платье в стиле БОХО из хлопчатобумажного шелка с рукавом 3/4  идеальное решение для выхода в летний вечер.', NULL, NULL, 'ШЕЛКОВЫЙ ХЛОПОК С МЕТАЛЛОМ  51%SILK41%COT8%METYARNS', '1008.1', '12750.00', 1, 8, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-27-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-27-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-27-SITE-3.jpg";}', 'da822c50d25b58ffb3acf4c29bad6c824c8de428.jpeg', 'ШЕЛКОВОЕ  КОКТЕЙЛЬНОЕ  ПЛАТЬЕ', NULL, '5100.00', 6, NULL),
(12, 3, 'КАФТАН -ТУНИКА "КВАДРАТ"', 'kaftan-tunika-kvadrat', '<p>Кафтан свободного кроя из плотной хлопчатобумажной габардины ,благодаря большим накладным карманам и симметричным углам, дает нам романтическое ощущение путешественника.</p>', 'КАФТАН -ТУНИКА "КВАДРАТ"', 'Кафтан свободного кроя из плотной хлопчатобумажной габардины ,благодаря большим накладным карманам и симметричным углам, дает нам романтическое ощущение путешественника.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНЫЙ ПОПЛИН', '1101.1', '6250.00', 1, 9, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-53-SITE-3.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-53-SITE-1.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-53-SITE-2.jpg";}', '3df42cda71f2f756293fe9774510f0ee548f0b36.jpeg', 'Кафтан-туника  свободного кроя', NULL, '2500.00', 6, NULL),
(13, 3, 'КАФТАН -ТУНИКА  ЛЕГКИЙ "КВАДРАТ-2"', 'kaftan-tunika--legkij-kvadrat2', '<p>Кафтан свободного кроя из легкой полупрозрачной хлопчатобусажной вуали дает ощущение свежести в жаркие дни.</p>', 'КАФТАН -ТУНИКА  ЛЕГКИЙ "КВАДРАТ-2"', 'Кафтан свободного кроя из легкой полупрозрачной хлопчатобусажной вуали дает ощущение свежести в жаркие дни.', NULL, NULL, '100% ХЛОПЧАТОБУМАЖНАЯ ВУАЛЬ', '1101.2', '7750.00', 1, 10, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-23-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-23-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-23-SITE-3.jpg";}', '1e28e8a758cde832d43632aad58d9b623869a96d.jpeg', 'Кафтан-туника свободного кроя из легкой полупрозрачной  вуали', NULL, '3100.00', 6, NULL),
(14, 3, 'КАФТАН С КАПЮШОНОМ "БАТИК"', 'kaftan-s-kapjushonom-batik', '<p>Короткий кафтан с капюшоном , рукав 3/4 &nbsp;с непринужденными симметричными углами и регулируемой сборкой , решение для всех возрастов.</p>', 'КАФТАН С КАПЮШОНОМ "БАТИК"', 'Короткий кафтан с капюшоном , рукав 3/4  с непринужденными симметричными углами и регулируемой сборкой , решение для всех возрастов.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНАЯ ВУАЛЬ', '1102.1', '7750.00', 1, 11, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-56-SITE-3.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-56-SITE-1.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-56-SITE-2.jpg";}', '5ccba73a4fd91d0875b7451d6ff003f4c57098ba.jpeg', 'Кафтан свободного кроя с капюшоном', NULL, '3100.00', 6, NULL),
(15, 3, 'КАФТАН С КАПЮШОНОМ "КЛЕТЧАТЫЙ"', 'kaftan-s-kapjushonom-kletchatyj', '<p>Короткий кафтан с капюшоном , рукав 3/4 &nbsp;с непринужденными симметричными углами и регулируемой сборкой , решение для всех возрастов.</p>', 'КАФТАН С КАПЮШОНОМ "КЛЕТЧАТЫЙ"', 'Короткий кафтан с капюшоном , рукав 3/4  с непринужденными симметричными углами и регулируемой сборкой , решение для всех возрастов.', NULL, NULL, '100%  КЛЕТЧАТЫЙ ХЛОПОК', '1102.2', '7750.00', 1, 12, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-73-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-73-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-73-SITE-3.jpg";}', 'fed10ac380664bceae9cb925ca32727e27e20019.jpeg', 'Короткий кафтан с капюшоном', NULL, '3100.00', 6, NULL),
(16, 3, 'ДЛИННЫЙ КАФТАН "ПАПРИКА"', 'dlinnyj-kaftan-paprika', '<p>Длинный кафтан прямого свободного кроя всегда актуален для летнего отдыха.</p>', 'ДЛИННЫЙ КАФТАН "ПАПРИКА"', 'Длинный кафтан прямого свободного кроя всегда актуален для летнего отдыха.', NULL, NULL, '100% ВИСКОЗНЫЙ ПОПЛИН', '1103.1', '7990.00', 1, 13, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-65-SITE-3.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-65-SITE-1.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-65-SITE-2.jpg";}', '49532a128e513ff22cdb063fa6558b1ad164ef17.jpeg', 'Длинный кафтан прямого свободного кроя', NULL, '3200.00', 6, NULL),
(17, 3, 'КАФТАН-РУБАШКА "БАТИК"', 'kaftanrubashka-batik', '<p>Укороченный кафтан-рубашка из легкого батиста , выполненный вручную в технике батик.</p>', 'КАФТАН-РУБАШКА "БАТИК"', 'Укороченный кафтан-рубашка из легкого батиста , выполненный вручную в технике батик.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНАЯ ВУАЛЬ', '1104.1', '5750.00', 1, 14, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-29-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-29-SITE-2.jpg";}', 'f62f8f4c42065f3b0b622d4630ef9b98723b0b33.jpeg', 'Укороченный кафтан-рубашка', NULL, '2300.00', 6, NULL),
(18, 3, 'ТОП-БЛУЗКА "ТВИСТ" БЕЗ РУКАВОВ', 'topbluzka-tvist-bez-rukavov', '<p>Блуза-топ без рукавов из мягкого модального трикотажа с элементом перекручивания актуальна в любое время и на любой случай.</p>', 'ТОП-БЛУЗКА "ТВИСТ" БЕЗ РУКАВОВ', 'Блуза-топ без рукавов из мягкого модального трикотажа с элементом перекручивания актуальна в любое время и на любой случай.', NULL, NULL, 'ТРИКОТАЖНЫЙ МОДАЛЬ  50%COT50%MODAL', '3004.1', '3990.00', 1, 15, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-79-SITE-2.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-79-SITE-1.jpg";}', '0a9d8f07a4977f6f7a8747263269998f4aea65a2.jpeg', 'Блуза-топ без рукавов', NULL, '1600.00', 6, NULL),
(19, 3, 'ТОП "УГОЛОК"', 'top-ugolok', '<p>Асимметричный легкий топ с акцентом на угол впереди &nbsp;идеальное дополнение для любого гардероба.</p>', 'ТОП "УГОЛОК"', 'Асимметричный легкий топ с акцентом на угол впереди  идеальное дополнение для любого гардероба.', NULL, NULL, '100% КЛЕТЧАТЫЙ ХЛОПОК', '3005.2', '3250.00', 1, 16, 'a:3:{i:0;s:55:"http://dev.toolai-fashion.ru/uploads/SS16-19-SITE-2.jpg";i:1;s:55:"http://dev.toolai-fashion.ru/uploads/SS16-19-SITE-1.jpg";i:2;s:55:"http://dev.toolai-fashion.ru/uploads/SS16-19-SITE-3.jpg";}', '8fed0cb4fe903d0bc11eb3b8010cee90c4ad2b3f.jpeg', 'Асимметричный легкий топ', NULL, '1300.00', 6, NULL),
(20, 3, 'БЛУЗА-РУБАШКА "ОСАКА"', 'bluzarubashka-osaka', '<p>Блуза-рубаха из легкого хлопка, решение на любой случай, от деловой встречи до вечеринки с друзьями.</p>', 'БЛУЗА-РУБАШКА "ОСАКА"', 'Блуза-рубаха из легкого хлопка, решение на любой случай, от деловой встречи до вечеринки с друзьями.', NULL, NULL, '100%  ХЛОПЧАТОБУМАЖНАЯ ВУАЛЬ', '3010.1', '5500.00', 1, 17, 'a:3:{i:0;s:60:"http://dev.toolai-fashion.ru/uploads/Blouse-Osaka-1-SITE.jpg";i:1;s:60:"http://dev.toolai-fashion.ru/uploads/Blouse-Osaka-2-SITE.jpg";i:2;s:60:"http://dev.toolai-fashion.ru/uploads/Blouse-Osaka-3-SITE.jpg";}', '635d4d752d3932e1ec41746698aeb6428eb19158.jpeg', 'Блуза-рубаха из легкого хлопка', NULL, '2200.00', 6, NULL),
(21, 3, 'БЛУЗА-РУБАШКА "ТВИСТ-2" С ДЛИННЫМИ РУКАВАМИ', 'bluzarubashka-tvist2-s-dlinnymi-rukavami', '<p>Специальное предложение дизайнера, блузка с античным элементом заворота , решение не только на лето но и остальные сезоны.</p>', 'БЛУЗА-РУБАШКА "ТВИСТ-2" С ДЛИННЫМИ РУКАВАМИ', 'Специальное предложение дизайнера, блузка с античным элементом заворота , решение не только на лето но и остальные сезоны.', NULL, NULL, '100%  КЛЕТЧАТЫЙ ХЛОПОК', '3008.1', '5990.00', 1, 18, 'a:2:{i:0;s:60:"http://dev.toolai-fashion.ru/uploads/Blouse-Twist-2-SITE.jpg";i:1;s:60:"http://dev.toolai-fashion.ru/uploads/Blouse-Twist-1-SITE.jpg";}', '41539ec55384ff90a4868fba57edcf5b24bb7ab2.jpeg', 'Блузка с античным элементом заворота', NULL, '2400.00', 6, NULL),
(22, 3, 'БЛУЗА-РУБАШКА "АНЖЕЛИКА"', 'bluzarubashka-anzhelika', '<p>Блузка из легкой вискозы. Мягкие обтекающие линии и широкий свободный крой облагораживают любую фигуру.</p>', 'БЛУЗА-РУБАШКА "АНЖЕЛИКА"', 'Блузка из легкой вискозы. Мягкие обтекающие линии и широкий свободный крой облагораживают любую фигуру.', NULL, NULL, '100%  ВИСКОЗНЫЙ ПОПЛИН', '3009.1', '6490.00', 1, 19, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/Blouse-Angelica-2-SITE.jpg";i:1;s:61:"http://dev.toolai-fashion.ru/uploads/Blouse-Angelica-SITE.jpg";}', 'e5099c934b85fc1ef0e1bbefc7acfb8f365395b6.jpeg', 'Блузка из легкой вискозы', NULL, '2600.00', 6, NULL),
(23, 3, 'МНОГОФУНКЦИОНАЛЬНАЯ ЮБКА "САКУРА"', 'mnogofunkcionalnaja-jubka-sakura', '<p>Льняная многофункциональная юбка , благодаря &quot;умному&quot; крою, может быть представлена как мини-юбка, юбка средней длины так и оригинальное дизайнерское решение с отпущенным уголком.</p>', 'МНОГОФУНКЦИОНАЛЬНАЯ ЮБКА "САКУРА"', 'Льняная многофункциональная юбка , благодаря "умному" крою, может быть представлена как мини-юбка, юбка средней длины так и оригинальное дизайнерское решение с отпущенным уголком.', NULL, NULL, '100%   ЛЕН', '2003.2', '6490.00', 1, 20, 'a:8:{i:0;s:60:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-SITE-1.jpg";i:1;s:60:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-SITE-2.jpg";i:2;s:60:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-SITE-3.jpg";i:3;s:65:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-ITEM-SITE-1.jpg";i:4;s:69:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-ITEM-SITE-1BACK.jpg";i:5;s:65:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-ITEM-SITE-2.jpg";i:6;s:69:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-ITEM-SITE-2BACK.jpg";i:7;s:65:"http://dev.toolai-fashion.ru/uploads/SKIRT-STORMY-ITEM-SITE-3.jpg";}', '003ce8405dd6d3ae24e2e8e304d22ed7a0426648.jpeg', 'Многофункциональная ассиметричная юбка', NULL, NULL, 6, NULL),
(24, 3, 'БРЮКИ ШИРОКИЕ "ЛУЗ"', 'brjuki-shirokie-luz', '<p>Широкие &nbsp;штаны-шаровары &nbsp;из легкой вискозы, решение на жаркие летние дни.</p>', 'БРЮКИ ШИРОКИЕ "ЛУЗ"', 'Широкие  штаны-шаровары  из легкой вискозы, решение на жаркие летние дни.', NULL, NULL, '100%  ВИСКОЗНЫЙ ПОПЛИН', '5001.2', '6250.00', 1, 21, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-80-SITE-2.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-80-SITE-1.jpg";}', '93a93cb438d85b9c3ce24630b7c185cc3b459ef3.jpeg', 'Широкие  штаны-шаровары', NULL, '2500.00', 6, NULL),
(25, 3, 'КОМБИНЕЗОН УДЛИНЕННЫЙ "ДЫМЧАТОЕ ДЕРЕВО"', 'kombinezon-udlinennyj-dymchatoe-derevo', '<p>Мягко облегающий тело вискозный комбинезон, оригинальное&nbsp;дизайнерское&nbsp;решение для современной женщины</p>', 'КОМБИНЕЗОН УДЛИНЕННЫЙ "ДЫМЧАТОЕ ДЕРЕВО"', 'Мягко облегающий тело вискозный комбинезон, оригинальное дизайнерское решение для современной женщины', NULL, NULL, '100%  ВИСКОЗНЫЙ ПОПЛИН', '5101.1', '10490.00', 1, 22, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-68-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-68-SITE-4.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-68-SITE-3.jpg";}', 'cefc1594b4636572b024fa761066cca254342ea9.jpeg', 'Длинный  вискозный комбинезон', NULL, '4200.00', 6, NULL),
(26, 3, 'ЛЬНЯНОЙ КОМБИНЕЗОН-ШОРТЫ', 'lnjanoj-kombinezonshorty', '<p>Укороченный комбинезон-шорты свободного кроя в стиле &quot;сафари&quot; выполненный из льняного материала в жаркое лето даст нам прохладу и чуство комфорта.</p>', 'ЛЬНЯНОЙ КОМБИНЕЗОН-ШОРТЫ', 'Укороченный комбинезон-шорты свободного кроя в стиле "сафари" выполненный из льняного материала в жаркое лето даст нам прохладу и чуство комфорта.', NULL, NULL, '100%   ЛЕН', '5102.1', '7990.00', 1, 23, 'a:2:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-47-SITE-3.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-47-SITE-2.jpg";}', '64c388cc9bf31e3a048d8132569b3bd528f2a6a5.jpeg', 'Укороченный комбинезон-шорты', NULL, '3200.00', 6, NULL),
(27, 3, 'ПАРКА УДЛИНЕННАЯ "НОРВЕГИЯ"', 'parka-udlinennaja-norvegija', '<p>Летняя парка , для похладных вечеров и ранней осени.</p>', 'ПАРКА УДЛИНЕННАЯ "НОРВЕГИЯ"', 'Летняя парка , для похладных вечеров и ранней осени.', NULL, NULL, '30%COT70%NYLON', '4001.1', '13250.00', 1, 24, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-75-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-75-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-75-SITE-3.jpg";}', '7c3dfde089435549c76ee74f3e85161d2b0a18e1.jpeg', 'Летняя  удлиненная парка', NULL, '5300.00', 6, NULL),
(28, 3, 'ЖАКЕТ-ПАРКА "СТИЛЬ КРЕПОН"', 'zhaketparka-stil-krepon', '<p>Летная парка-жакет, выполненная из хлопчатобумажного шелка с металлическими добавками, решение как для повседневного выхода, так и для вечернего коктейля.</p>', 'ЖАКЕТ-ПАРКА "СТИЛЬ КРЕПОН"', 'Летная парка-жакет, выполненная из хлопчатобумажного шелка с металлическими добавками, решение как для повседневного выхода, так и для вечернего коктейля.', NULL, NULL, 'ШЕЛКОВЫЙ ХЛОПОК С МЕТАЛЛОМ   51%SILK41%COT8%METYARNS', '4002.1', '11490.00', 1, 25, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-38-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-38-SITE-2.jpg";i:2;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-38-SITE-3.jpg";}', '303598f98560af7d63ac4c50e4b50f37c2f6b844.jpeg', 'Летная парка-жакет, выполненная из хлопчатобумажного шелка.', NULL, '4600.00', 6, NULL),
(29, 3, 'ЖАКЕТ-ПАРКА " СПОРТ-СТИЛЬ"', 'zhaketparka--sportstil', '<p>Парка-жакет спортивного стиля , решение на каждый день для активных женщин.</p>', 'ЖАКЕТ-ПАРКА " СПОРТ-СТИЛЬ"', 'Парка-жакет спортивного стиля , решение на каждый день для активных женщин.', NULL, NULL, 'ШЕЛКОВЫЙ ХЛОПОК С МЕТАЛЛОМ  51%SILK41%COT8%METYARNS', '4003.1', '11490.00', 1, 26, 'a:2:{i:0;s:62:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-1-SITE-1.jpg";i:1;s:62:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-1-SITE-2.jpg";}', 'd75f4d0fb7fa6855553153210044b81d8a68ee44.jpeg', 'Парка-жакет спортивного стиля.', NULL, '4600.00', 6, NULL),
(30, 3, 'МНОГОФУНКЦИОНАЛЬНЫЙ ПЛАЩ "РОТТЕРДАМ"', 'mnogofunkcionalnyj-plasch-rotterdam', '<p>Многофункциональный летний плащ, где убираются рукава , выполненный из льняного материала, идеальное решение для регионов с прохладным летом.</p>', 'МНОГОФУНКЦИОНАЛЬНЫЙ ПЛАЩ "РОТТЕРДАМ"', 'Многофункциональный летний плащ, где убираются рукава , выполненный из льняного материала, идеальное решение для регионов с прохладным летом.', NULL, NULL, '30%COT70%NYLON', '6101.1', '14250.00', 1, 27, 'a:4:{i:0;s:62:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-4-SITE-1.jpg";i:1;s:62:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-4-SITE-2.jpg";i:2;s:62:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-4-SITE-3.jpg";i:3;s:59:"http://dev.toolai-fashion.ru/uploads/SS16-ITEM-4-SITE-2.jpg";}', '89645741804048c3fdb0c166add2b41358307099.jpeg', 'Многофункциональный летний плащ.', NULL, '5700.00', 6, NULL),
(31, 3, 'ПЛАЩ БЕЗ РУКАВОВ "ШТОРМИ"', 'plasch-bez-rukavov-shtormi', '<p>Легкий летний плащ без рукавов, выполненный из льняной вуали, идеально подходит к любому силуэту и благородно подчеркивает индивидуаоьность каждой женщины.</p>', 'ПЛАЩ БЕЗ РУКАВОВ "ШТОРМИ"', 'Легкий летний плащ без рукавов, выполненный из льняной вуали, идеально подходит к любому силуэту и благородно подчеркивает индивидуаоьность каждой женщины.', NULL, NULL, '100%   ЛЕН', '6102.1', '12250.00', 1, 28, 'a:3:{i:0;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-44-SITE-1.jpg";i:1;s:63:"http://dev.toolai-fashion.ru/uploads/SS16-PICTURE-44-SITE-2.jpg";i:2;s:57:"http://dev.toolai-fashion.ru/uploads/SS16-ITEM-RGB-44.jpg";}', 'a2d822b335182081f063ab544f56ed7f5c145f82.jpeg', 'Легкий летний плащ без рукавов.', NULL, '4900.00', 6, NULL),
(32, 8, '1', '1', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b3ce20ae54cfc9077908c4464b4017f1dda6f8b8.jpeg', NULL, NULL, NULL, NULL, NULL),
(33, 8, '2', '2', NULL, '2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f05d30ef8d3026013ab34d1dd6b312b78dca2182.jpeg', NULL, NULL, NULL, NULL, NULL),
(34, 8, '3', '3', NULL, '3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b03db87b7386e22143895aa6de600ca3ef09cc94.jpeg', NULL, NULL, NULL, NULL, NULL),
(35, 8, '4', '4', NULL, '4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '729025fe0394ee5704e532a79eaa96ee70df5223.jpeg', NULL, NULL, NULL, NULL, NULL),
(36, 8, '5', '5', NULL, '5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'eaff7c9269b0e796390967300db3ef2aa8a5066f.jpeg', NULL, NULL, NULL, NULL, NULL),
(37, 8, '6', '6', NULL, '6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5edfac530afc8395b5ac785094eb78a361fd066a.jpeg', NULL, NULL, NULL, NULL, NULL),
(38, 8, '7', '7', NULL, '7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8342b582dac03912b39fd273966697f97f545689.jpeg', NULL, NULL, NULL, NULL, NULL),
(39, 8, '8', '8', NULL, '8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0bea3f8e7e1b56df99b139bb9d436dd80636b99d.jpeg', NULL, NULL, NULL, NULL, NULL),
(40, 8, '9', '9', NULL, '9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2a906007e1d7919f405415f8a3a39b8a3dcfa05f.jpeg', NULL, NULL, NULL, NULL, NULL),
(41, 8, '10', '10', NULL, '10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '09ca9ec65c7ec643152bbb38064df7afebb28fbe.jpeg', NULL, NULL, NULL, NULL, NULL),
(42, 8, '11', '11', NULL, '11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'bf149ed53a50685f18bf4e9b97c107bf58a35960.jpeg', NULL, NULL, NULL, NULL, NULL),
(43, 8, '12', '12', NULL, '12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c72df7e4a002ef2c2a72315ab22fa2ee128a1291.jpeg', NULL, NULL, NULL, NULL, NULL),
(44, 8, '13', '13', NULL, '13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'efe2dbe6072ae031c803192f62d72c46b651bcee.jpeg', NULL, NULL, NULL, NULL, NULL),
(46, 8, '14', '14', NULL, '14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '894e88678264239c8e382112546c38c7f3b81d6f.jpeg', NULL, NULL, NULL, NULL, NULL),
(48, 8, '15', '15', NULL, '15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ecf06818f68e6cac64933488f6803e61e8c0489b.jpeg', NULL, NULL, NULL, NULL, NULL),
(49, 12, '1-1', '1-1', NULL, '1-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ea0b5335c7bf04acc1469a7e242f4176317963ae.jpeg', NULL, NULL, NULL, NULL, NULL),
(50, 8, '16', '16', NULL, '16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a009e43adcb53fb49af673a395c963c7fcbfb7e4.jpeg', NULL, NULL, NULL, NULL, NULL),
(51, 8, '17', '17', NULL, '17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '28f76aec3657a90bf545584f4ada60324a7562cd.jpeg', NULL, NULL, NULL, NULL, NULL),
(53, 8, '18', '18', NULL, '18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '834e68dda1fdde97275f8c2bb328e0b3978391df.jpeg', NULL, NULL, NULL, NULL, NULL),
(54, 12, '1-2', '1-2', NULL, '1-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9151d217c200d273789c644bd11f52adadb89fda.jpeg', NULL, NULL, NULL, NULL, NULL),
(55, 12, '1-3', '1-3', NULL, '1-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5b84b5a93d9bad114925eb7aa50f88687a7f0530.jpeg', NULL, NULL, NULL, NULL, NULL),
(56, 12, '1-4', '1-4', NULL, '1-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '132118dbb58486051b2626d3d9fdbbd69a9de823.jpeg', NULL, NULL, NULL, NULL, NULL),
(57, 8, '19', '19', NULL, '19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '342cc89a8f8580865762b1854822f251d5cbc75b.jpeg', NULL, NULL, NULL, NULL, NULL),
(58, 12, '1-5', '1-5', NULL, '1-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd3cf0adc34236f1ecbcc720d4cea4c2c3840b02f.jpeg', NULL, NULL, NULL, NULL, NULL),
(59, 8, '20', '20', NULL, '20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a71d8928aff31bd24367b15f7b5745b6f1799904.jpeg', NULL, NULL, NULL, NULL, NULL),
(60, 12, '1-6', '1-6', NULL, '1-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9a9357901fe8a2669899d935addbbf9642a46f49.jpeg', NULL, NULL, NULL, NULL, NULL),
(61, 8, '21', '21', NULL, '21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '38392ea3eadccb6cd766cf118b9620c5d6dc83c1.jpeg', NULL, NULL, NULL, NULL, NULL),
(62, 12, '1-7', '1-7', NULL, '1-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1e34725158cb4a4d22dcbc8b0a907e5daddf5b9e.jpeg', NULL, NULL, NULL, NULL, NULL),
(63, 8, '22', '22', NULL, '22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c6c358369452a2f7d66c0722f78d7a7fda1e1876.jpeg', NULL, NULL, NULL, NULL, NULL),
(64, 12, '1-8', '1-8', NULL, '1-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ffb2accce200bd25afbb91df4665249c9a5eafcf.jpeg', NULL, NULL, NULL, NULL, NULL),
(65, 12, '1-9', '1-9', NULL, '1-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '04c82fd51c8edddd73764a5270fdc59da31e0a24.jpeg', NULL, NULL, NULL, NULL, NULL),
(66, 12, '1-10', '1-10', NULL, '1-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '49c39d1a665a24034fc044e1b05618ffab65f72f.jpeg', NULL, NULL, NULL, NULL, NULL),
(67, 12, '1-12', '1-12', NULL, '1-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3ec45e51f409b4d7468ed90b2f9edefa16fb01b5.jpeg', NULL, NULL, NULL, NULL, NULL),
(68, 8, '23', '23', NULL, '23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ff9f4de21a542ef8464d47e62a8e803821fc398c.jpeg', NULL, NULL, NULL, NULL, NULL),
(69, 12, '1-13', '1-13', NULL, '1-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f9853534cf38ffea27cace78a336addb6dbe00af.jpeg', NULL, NULL, NULL, NULL, NULL),
(70, 8, '24', '24', NULL, '24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7e8a174de8693691c47e0a1ac01821170c1220b2.jpeg', NULL, NULL, NULL, NULL, NULL),
(71, 12, '1-14', '1-14', NULL, '1-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f439566fc1695e742470b3ac290a140acb3b590a.jpeg', NULL, NULL, NULL, NULL, NULL),
(72, 8, '25', '25', NULL, '25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3eb1bacbad48555738a62a4224b4cd0c136351cf.jpeg', NULL, NULL, NULL, NULL, NULL),
(73, 12, '1-15', '1-15', NULL, '1-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c5bdcf94d869cdf7dd9b54dad2f0c7f394098814.jpeg', NULL, NULL, NULL, NULL, NULL),
(74, 8, '26', '26', NULL, '26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '34c5a0f1489ad92b16d0bf43c09d9e94bbc0d319.jpeg', NULL, NULL, NULL, NULL, NULL),
(75, 8, '27', '27', NULL, '27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '54309af617a62e1b5a4b38ac58217f3b7b07b7ae.jpeg', NULL, NULL, NULL, NULL, NULL),
(76, 12, '1-16', '1-16', NULL, '1-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'aaa7c7fd6a2db867325a1d60a4773a452fe57110.jpeg', NULL, NULL, NULL, NULL, NULL),
(77, 12, '1-17', '1-17', NULL, '1-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9b713d1b4bc33aa39c3c30386963e81e24c87c95.jpeg', NULL, NULL, NULL, NULL, NULL),
(80, 12, '1-18', '1-18', NULL, '1-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '93251b708ef00f8b63cd458ad47a588a51102235.jpeg', NULL, NULL, NULL, NULL, NULL),
(81, 12, '1-19', '1-19', NULL, '1-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0a07851879f0234ac623d793fe1f84b803c2655a.jpeg', NULL, NULL, NULL, NULL, NULL),
(82, 12, '1-20', '1-20', NULL, '1-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0d890bbba283066a4ff0a59fa72b69f99ac3fba8.jpeg', NULL, NULL, NULL, NULL, NULL),
(83, 12, '1-21', '1-21', NULL, '1-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f131d24735d030d35e4de73e3380825d409dcf60.jpeg', NULL, NULL, NULL, NULL, NULL),
(84, 8, '28', '28', NULL, '28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd755b24694edc925c54011a6d802e76ab9142a9e.jpeg', NULL, NULL, NULL, NULL, NULL),
(85, 8, '29', '29', NULL, '29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f8575d8ba535a3e04c682d3ed79e5e4561711174.jpeg', NULL, NULL, NULL, NULL, NULL),
(86, 12, '1-22', '1-22', NULL, '1-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f40b3541a7ab728e8f6d955b661c3a446e90129d.jpeg', NULL, NULL, NULL, NULL, NULL),
(87, 8, '30', '30', NULL, '30', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '21dddbffc593a702149e4f3f408444d871605964.jpeg', NULL, NULL, NULL, NULL, NULL),
(88, 8, '31', '31', NULL, '31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '62cca93ceed08e3e895400a77eb217dfc54f8e98.jpeg', NULL, NULL, NULL, NULL, NULL),
(89, 12, '1-23', '1-23', NULL, '1-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ac876412e28d9e154657fb05458014c3612377fa.jpeg', NULL, NULL, NULL, NULL, NULL),
(90, 8, '32', '32', NULL, '32', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '13cfe4900968086efb0db8e76df9bbc09292af59.jpeg', NULL, NULL, NULL, NULL, NULL),
(91, 12, '1-24', '1-24', NULL, '1-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'fb12beb2aff770f6691b5d636eebb1da03534407.jpeg', NULL, NULL, NULL, NULL, NULL),
(92, 8, '33', '33', NULL, '33', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '22ce23677f0225e22bd851192674f12ffd0773b7.jpeg', NULL, NULL, NULL, NULL, NULL),
(93, 12, '1-25', '1-25', NULL, '1-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'cabc7680f463c46a63445b519d5f4bdbbc16a049.jpeg', NULL, NULL, NULL, NULL, NULL),
(94, 8, '34', '34', NULL, '34', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2a58ce5020cf31d9ee9107f5b29ea0b2b97db2e5.jpeg', NULL, NULL, NULL, NULL, NULL),
(95, 12, '1-26', '1-26', NULL, '1-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '683055e1f34b012c08ca0e46943efe1778dd3f74.jpeg', NULL, NULL, NULL, NULL, NULL),
(96, 8, '35', '35', NULL, '35', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '575022f4ba2e4e531ed0648959c543b820bde6ca.jpeg', NULL, NULL, NULL, NULL, NULL),
(97, 12, '1-27', '1-27', NULL, '1-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c4287768067282acd9dd671cf7d98fd6b2baf6d2.jpeg', NULL, NULL, NULL, NULL, NULL),
(98, 13, '2-1', '2-1', NULL, '2-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '641c03ed7adb8e98ba6118312472e9359666cdc7.jpeg', NULL, NULL, NULL, NULL, NULL),
(99, 13, '2-2', '2-2', NULL, '2-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c11631ef1ab2a3357b19a63cce447dbbe30eb07d.jpeg', NULL, NULL, NULL, NULL, NULL),
(100, 13, '2-3', '2-3', NULL, '2-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2fbe63bf48535bb5927134b9d636349a6d1d681a.jpeg', NULL, NULL, NULL, NULL, NULL),
(101, 13, '2-4', '2-4', NULL, '2-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '745845cb04fd60f605585f7bb6f3b3a69a28afdd.jpeg', NULL, NULL, NULL, NULL, NULL),
(102, 13, '2-5', '2-5', NULL, '2-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b48dea09a5869c34c0edd2d7e01b43a901d5fe13.jpeg', NULL, NULL, NULL, NULL, NULL),
(103, 13, '2-6', '2-6', NULL, '2-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2e52f9197ef4db293265756d65f2e8223d66383e.jpeg', NULL, NULL, NULL, NULL, NULL),
(104, 13, '2-8', '2-8', NULL, '2-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0d1f9cde9e35dfeb2b5111f61311d5cb3c5e911a.jpeg', NULL, NULL, NULL, NULL, NULL),
(105, 13, '2-7', '2-7', NULL, '2-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '029a0734c105a345b06fa35ecc3c0666a9de9a09.jpeg', NULL, NULL, NULL, NULL, NULL),
(106, 13, '2-9', '2-9', NULL, '2-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0d0f25702aebdb10a05e6b67cfc4d80f55d10453.jpeg', NULL, NULL, NULL, NULL, NULL),
(107, 13, '2-10', '2-10', NULL, '2-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ac7fe8cfd2dc375a818e6c4dc5755ac40dd37b46.jpeg', NULL, NULL, NULL, NULL, NULL),
(108, 13, '2-11', '2-11', NULL, '2-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3051ff8de59000d1c338ffcd97c8d69dc80e8106.jpeg', NULL, NULL, NULL, NULL, NULL),
(109, 13, '2-12', '2-12', NULL, '2-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1a65097f163f49272f0da2df1241406ea7a9e9d2.jpeg', NULL, NULL, NULL, NULL, NULL),
(110, 13, '2-13', '2-13', NULL, '2-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f495561ee1933fbf9cbfc5ef73adc14c4b2e4199.jpeg', NULL, NULL, NULL, NULL, NULL),
(111, 13, '2-14', '2-14', NULL, '2-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b6a7cbba304a18182a288a35cb82fd383d57df30.jpeg', NULL, NULL, NULL, NULL, NULL),
(112, 13, '2-15', '2-15', NULL, '2-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ee0fe1e0c4c618ca92ad3c752a0d6633e5820951.jpeg', NULL, NULL, NULL, NULL, NULL),
(113, 13, '2-16', '2-16', NULL, '2-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '171001f8054b3704ba70a1c39045d7b0ccffd687.jpeg', NULL, NULL, NULL, NULL, NULL),
(114, 13, '2-17', '2-17', NULL, '2-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'fa403c853841e9b2cf350feb160b961af263fb5e.jpeg', NULL, NULL, NULL, NULL, NULL),
(115, 13, '2-18', '2-18', NULL, '2-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a395effa4702b262d0acbaf7ef884acf0234a9ab.jpeg', NULL, NULL, NULL, NULL, NULL),
(116, 15, '2-19', '2-19', NULL, '2-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0cab9ebb01834fb9f75b2f4c90ee827c2f6f60c0.jpeg', NULL, NULL, NULL, NULL, NULL),
(117, 13, '2-20', '2-20', NULL, '2-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ff79274394eac1710e8e52d65a74b0931714c177.jpeg', NULL, NULL, NULL, NULL, NULL),
(118, 13, '2-21', '2-21', NULL, '2-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f66dd0c501f4233dd0b8d55235f6babf396ff1f7.jpeg', NULL, NULL, NULL, NULL, NULL),
(119, 13, '2-22', '2-22', NULL, '2-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '435c3d0d8d8ff1cf429630e428247d26c1a9c03e.jpeg', NULL, NULL, NULL, NULL, NULL),
(120, 13, '2-23', '2-23', NULL, '2-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9b5c1a683e4c649d387b10151dfb51c6a2ba302f.jpeg', NULL, NULL, NULL, NULL, NULL),
(121, 13, '2-24', '2-24', NULL, '2-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '391a795062f9f474e14cda4ea46d6987211792fe.jpeg', NULL, NULL, NULL, NULL, NULL),
(122, 11, '3-1', '3-1', NULL, '3-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '45b7b54c7fe2c5f6d51fc4ccaf7343e1fb332cf9.jpeg', NULL, NULL, NULL, NULL, NULL),
(123, 13, '2-26', '2-26', NULL, '2-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '66393475d4147317633736955eb8ef10aa705a73.jpeg', NULL, NULL, NULL, NULL, NULL),
(124, 13, '2-25', '2-25', NULL, '2-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '20bd5a55534c2c1b0e8a3afc507e4e495091428b.jpeg', NULL, NULL, NULL, NULL, NULL),
(125, 11, '3-2', '3-2', NULL, '3-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5771f2ae1af13c2dd093caa18ae1083808acfd31.jpeg', NULL, NULL, NULL, NULL, NULL),
(126, 14, '4-1', '4-1', NULL, '4-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4c0ad447f38a691383e7a1cc44232f960c622774.jpeg', NULL, NULL, NULL, NULL, NULL),
(127, 14, '4-2', '4-2', NULL, '4-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd01d20aba45b27d791e6f3f025abaeb31e1df6ad.jpeg', NULL, NULL, NULL, NULL, NULL),
(128, 14, '4-3', '4-3', NULL, '4-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '390d8cb9bd0a0ff07f4e70ebc1d8c172eeb66a85.jpeg', NULL, NULL, NULL, NULL, NULL),
(129, 11, '3-3', '3-3', NULL, '3-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'be1fd69f096f023605e22e4a6805805170723d47.jpeg', NULL, NULL, NULL, NULL, NULL),
(130, 14, '4-4', '4-4', NULL, '4-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '336affb9e5b4155553e177b3c504e129843fc435.jpeg', NULL, NULL, NULL, NULL, NULL),
(131, 14, '4-5', '4-5', NULL, '4-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5c244d6cc78ab85be39c1dea1916877a2812168e.jpeg', NULL, NULL, NULL, NULL, NULL),
(132, 14, '4-6', '4-6', NULL, '4-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7914bc9f42815e5c8f1a3d5f8bc2394ad69d836e.jpeg', NULL, NULL, NULL, NULL, NULL),
(133, 14, '4-7', '4-7', NULL, '4-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '93bcd5c6c9932aee5366a958c8f270e9db7f68fb.jpeg', NULL, NULL, NULL, NULL, NULL),
(134, 11, '3-4', '3-4', NULL, '3-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ab341399c3fe5edc98d72b5673dbefd7f7b68c34.jpeg', NULL, NULL, NULL, NULL, NULL),
(135, 14, '4-8', '4-8', NULL, '4-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'bbd57da9b008282bbbaae4ac8bb156305ba6baa9.jpeg', NULL, NULL, NULL, NULL, NULL),
(136, 11, '3-5', '3-5', NULL, '3-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3627b55fa55d5d15f0ee6e7f0d1991696dbbc3d2.jpeg', NULL, NULL, NULL, NULL, NULL),
(145, 14, '4-9', '4-9', NULL, '4-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '69035631886bf1da4fd2344622efda0075ae3381.jpeg', NULL, NULL, NULL, NULL, NULL),
(146, 14, '4-10', '4-10', NULL, '4-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2346917cdaf191a1ee178f2e918e6c298a2aff3d.jpeg', NULL, NULL, NULL, NULL, NULL),
(151, 14, '4-11', '4-11', NULL, '4-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c659b66e1b1d7b67cd5225207f7cd267849a46a2.jpeg', NULL, NULL, NULL, NULL, NULL),
(152, 14, '4-12', '4-12', NULL, '4-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f0c65b60d92c839de7d720c9155d19475e3fed1a.jpeg', NULL, NULL, NULL, NULL, NULL),
(153, 14, '4-13', '4-13', NULL, '4-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '23f9459930f6670724fecb64e4e2690410845537.jpeg', NULL, NULL, NULL, NULL, NULL),
(154, 14, '4-14', '4-14', NULL, '4-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8647c87cab1aa7df8d7f1b62fd8c5f1868b4b0a6.jpeg', NULL, NULL, NULL, NULL, NULL),
(155, 14, '4-15', '4-15', NULL, '4-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '88075b05f0ef59d2b387a97b3e38cb0230d72305.jpeg', NULL, NULL, NULL, NULL, NULL),
(156, 11, '3-6', '3-6', NULL, '3-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dfa3b781b6038e3442b9dd627085fb29360c40fb.jpeg', NULL, NULL, NULL, NULL, NULL),
(157, 14, '4-16', '4-16', NULL, '4-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5b615651ef25d116c56d9edf8279b86df14391e8.jpeg', NULL, NULL, NULL, NULL, NULL),
(158, 11, '3-7', '3-7', NULL, '3-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ba2978b574838dc82718ad2e89115c9431e642fb.jpeg', NULL, NULL, NULL, NULL, NULL),
(159, 14, '4-17', '4-17', NULL, '4-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ac906848f53fb27be2c7b0bc87ef4ae96d7c8a16.jpeg', NULL, NULL, NULL, NULL, NULL),
(160, 14, '4-18', '4-18', NULL, '4-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1bd8500f317173e835eeceb787805073855ea5bc.jpeg', NULL, NULL, NULL, NULL, NULL),
(161, 11, '3-8', '3-8', NULL, '3-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b671db6722a9d906dceeb550f16275a4ab3e557c.jpeg', NULL, NULL, NULL, NULL, NULL),
(162, 14, '4-19', '4-19', NULL, '4-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4b87cdd61af4396c32baf51534e8a564a3158c87.jpeg', NULL, NULL, NULL, NULL, NULL),
(163, 14, '4-20', '4-20', NULL, '4-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c0500195dcd3ebed2b6a86d672b6314ea1a4114e.jpeg', NULL, NULL, NULL, NULL, NULL),
(164, 14, '4-22', '4-22', NULL, '4-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7fa267e6f8af484e1287b000dd3cbd2a99380cb5.jpeg', NULL, NULL, NULL, NULL, NULL),
(165, 14, '4-23', '4-23', NULL, '4-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd2b2ea0a2dd64f02f3cd19cae292c4cb8dcb4afe.jpeg', NULL, NULL, NULL, NULL, NULL),
(166, 14, '4-24', '4-24', NULL, '4-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3b467a2b32e1d91b5a56cc9297debd42ff2cdc5f.jpeg', NULL, NULL, NULL, NULL, NULL),
(167, 14, '4-25', '4-25', NULL, '4-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ff6eda0b9df3bb819a8d692be4b2e4229f09d769.jpeg', NULL, NULL, NULL, NULL, NULL),
(168, 14, '4-26', '4-26', NULL, '4-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e24c7af474cd7f610def0b92562cd2d47230d409.jpeg', NULL, NULL, NULL, NULL, NULL),
(169, 14, '4-27', '4-27', NULL, '4-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a25d25ff101f54e66121880e23afdf2ffc5f3503.jpeg', NULL, NULL, NULL, NULL, NULL),
(170, 14, '4-28', '4-28', NULL, '4-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8f557afac04e41289da1b39459f8e7404e3e3411.jpeg', NULL, NULL, NULL, NULL, NULL),
(171, 14, '4-29', '4-29', NULL, '4-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd97599fb16ef127676235d3c64638f0bc8e21b9b.jpeg', NULL, NULL, NULL, NULL, NULL),
(172, 14, '4-30', '4-30', NULL, '4-30', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b96e7a6ac30064c5d2035b74f8b8db1573656313.jpeg', NULL, NULL, NULL, NULL, NULL),
(173, 11, '3-9', '3-9', NULL, '3-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0c70822494177985e89433efe40dbfea20a40f93.jpeg', NULL, NULL, NULL, NULL, NULL),
(174, 11, '3-10', '3-10', NULL, '3-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '046305f9f03457acabac30fcce1762fe4322e07f.jpeg', NULL, NULL, NULL, NULL, NULL),
(175, 14, '4-31', '4-31', NULL, '4-31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '940a1dcd15f7e611722912d029ed9f3f2d490656.jpeg', NULL, NULL, NULL, NULL, NULL),
(176, 14, '4-32', '4-32', NULL, '4-32', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9e65aa4a4f050265d50ba6f70b581c900707a8f8.jpeg', NULL, NULL, NULL, NULL, NULL),
(177, 11, '3-11', '3-11', NULL, '3-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dbd470687aa755fd9788ebc6a5560f758101638f.jpeg', NULL, NULL, NULL, NULL, NULL),
(178, 14, '4-33', '4-33', NULL, '4-33', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f869a03902c61f3eec2e105842c568cac275f4e7.jpeg', NULL, NULL, NULL, NULL, NULL),
(179, 11, '3-12', '3-12', NULL, '3-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '01738e15b204e74e3de2000edd00e67d01657201.jpeg', NULL, NULL, NULL, NULL, NULL),
(180, 14, '4-34', '4-34', NULL, '4-34', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '454346c874f91227c36f9ab38dac7cc5e3b82739.jpeg', NULL, NULL, NULL, NULL, NULL),
(181, 14, '4-35', '4-35', NULL, '4-35', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8661c35730cfabe4d4061cae8c94aeeeff56971e.jpeg', NULL, NULL, NULL, NULL, NULL),
(182, 14, '4-36', '4-36', NULL, '4-36', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '61c6080aed670750156897a5dfcb9031aa803d38.jpeg', NULL, NULL, NULL, NULL, NULL),
(183, 11, '3-13', '3-13', NULL, '3-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e1c381f06fbdfda7b506896632726ac90a136e03.jpeg', NULL, NULL, NULL, NULL, NULL),
(184, 14, '4-37', '4-37', NULL, '4-37', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3c0e453f3688ff936a0717ec0a5ff53d2feedfc5.jpeg', NULL, NULL, NULL, NULL, NULL),
(185, 14, '4-38', '4-38', NULL, '4-38', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'daf18b2f98f6705da8bdcb5c0c459ad21c0d4743.jpeg', NULL, NULL, NULL, NULL, NULL),
(186, 11, '3-14', '3-14', NULL, '3-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ef3eb09c122e10940d16a3b061e0cbb210f1d6b4.jpeg', NULL, NULL, NULL, NULL, NULL),
(187, 14, '4-39', '4-39', NULL, '4-39', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9de6e294f99bcd4edc6472b029ae928f2b05a88a.jpeg', NULL, NULL, NULL, NULL, NULL),
(188, 14, '4-40', '4-40', NULL, '4-40', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c8f2328c2443dba1168202ebb29196b1031f3074.jpeg', NULL, NULL, NULL, NULL, NULL),
(189, 11, '3-15', '3-15', NULL, '3-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8f4b1d70733090773e6aafc1253e970f4e6469aa.jpeg', NULL, NULL, NULL, NULL, NULL),
(190, 14, '4-41', '4-41', NULL, '4-41', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '90064690dfc3ed295649f484b363ecc51606f3be.jpeg', NULL, NULL, NULL, NULL, NULL),
(191, 14, '4-42', '4-42', NULL, '4-42', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a959f69357c49380303c67362dc37af41e158432.jpeg', NULL, NULL, NULL, NULL, NULL),
(192, 14, '4-43', '4-43', NULL, '4-43', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b87f0eebd6ad7d40798b3769d40e804117f120cb.jpeg', NULL, NULL, NULL, NULL, NULL),
(193, 14, '4-44', '4-44', NULL, '4-44', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e7a5e8a0fdcae8cfc108d2269b329a7c76a04279.jpeg', NULL, NULL, NULL, NULL, NULL),
(194, 14, '4-45', '4-45', NULL, '4-45', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5a2bc9cd4211c782c8f78b613bfbed893de36e60.jpeg', NULL, NULL, NULL, NULL, NULL),
(195, 11, '3-16', '3-16', NULL, '3-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4ce0d74c57d2f9b897ddd2e2c3f680befc80029c.jpeg', NULL, NULL, NULL, NULL, NULL),
(196, 14, '4-46', '4-46', NULL, '4-46', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e453ae18fa9d3fb65b5375aef2d4ea11326f6bd4.jpeg', NULL, NULL, NULL, NULL, NULL),
(197, 14, '4-47', '4-47', NULL, '4-47', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '97b05c8448832d994e0f53e00138adbd50740d46.jpeg', NULL, NULL, NULL, NULL, NULL),
(198, 11, '3-17', '3-17', NULL, '3-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e1a6912ac97281e6e369a5f1cd2da46ee977d964.jpeg', NULL, NULL, NULL, NULL, NULL),
(199, 14, '4-48', '4-48', NULL, '4-48', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'fb5d99e2f5b06e81a150f0e56f01c4b0c0cc5752.jpeg', NULL, NULL, NULL, NULL, NULL),
(200, 14, '4-49', '4-49', NULL, '4-49', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0c4e900940c411b21a806284033eb9d1a8180edb.jpeg', NULL, NULL, NULL, NULL, NULL),
(201, 14, '4-50', '4-50', NULL, '4-50', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c2be1853a85d7f65d8b45c0d77f8216d9596483d.jpeg', NULL, NULL, NULL, NULL, NULL),
(202, 14, '4-51', '4-51', NULL, '4-51', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b02bbe8d00292f79ae1681bac1df41551fcacc32.jpeg', NULL, NULL, NULL, NULL, NULL),
(203, 11, '3-18', '3-18', NULL, '3-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '266c8b0c41ee2d3454fa60f60343d95fb1d05984.jpeg', NULL, NULL, NULL, NULL, NULL),
(204, 11, '3-19', '3-19', NULL, '3-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'cfbad59e8c02861b515fdbe7e7ec2a197390cef3.jpeg', NULL, NULL, NULL, NULL, NULL),
(205, 16, '5-1', '5-1', NULL, '5-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a088e749c4e5fa55d8b968d46f23951ae07819e3.jpeg', NULL, NULL, NULL, NULL, NULL),
(206, 11, '3-20', '3-20', NULL, '3-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a94cdf84cec0251fbf8c4fb21d5fe9fa19d1dbc4.jpeg', NULL, NULL, NULL, NULL, NULL),
(207, 16, '5-2', '5-2', NULL, '5-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4beb5a2bbe41796e8783ee1b9735b79e993bdba8.jpeg', NULL, NULL, NULL, NULL, NULL),
(208, 16, '5-3', '5-3', NULL, '5-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '61ff44c50f14db3abab1b1eccee71567c3f9b287.jpeg', NULL, NULL, NULL, NULL, NULL),
(209, 16, '5-4', '5-4', NULL, '5-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c5caf896c1c8f63eb5d884e6fd9e3e407a1f5619.jpeg', NULL, NULL, NULL, NULL, NULL),
(210, 11, '3-21', '3-21', NULL, '3-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '775cc50f39c80c73af8eb0ccdda48a16acdae0e3.jpeg', NULL, NULL, NULL, NULL, NULL),
(211, 16, '5-5', '5-5', NULL, '5-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7c54fa2bd25c437c4ad2928305f4db55c6ecefce.jpeg', NULL, NULL, NULL, NULL, NULL),
(212, 16, '5-6', '5-6', NULL, '5-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a95a12d8c222677cc8016f4083ee16c6591c94ec.jpeg', NULL, NULL, NULL, NULL, NULL),
(213, 16, '5-7', '5-7', NULL, '5-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f6bd4fcb5ad586c7fe2fddd8d1802909dd6f6a5c.jpeg', NULL, NULL, NULL, NULL, NULL),
(214, 16, '5-8', '5-8', NULL, '5-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '080c1e647706ebc7d1859bf1235f284077195be4.jpeg', NULL, NULL, NULL, NULL, NULL),
(215, 16, '5-9', '5-9', NULL, '5-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1abb071c80aea47d7f4062c5eb450d4b176a7c85.jpeg', NULL, NULL, NULL, NULL, NULL),
(216, 16, '5-10', '5-10', NULL, '5-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '15de40e88e32362c981ef060131bda0c96b65fed.jpeg', NULL, NULL, NULL, NULL, NULL);
INSERT INTO `shop_product` (`id`, `category_id`, `name`, `alias`, `description`, `meta_tag_title`, `meta_tag_description`, `meta_tag_keywords`, `tags`, `composition`, `style`, `price`, `status`, `orderning`, `images`, `logo`, `type`, `price_discount`, `price_b2b`, `categoryB2B_id`, `note`) VALUES
(217, 16, '5-11', '5-11', NULL, '5-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'defa101776f7f236358a4f5d5f9d20a045afadfc.jpeg', NULL, NULL, NULL, NULL, NULL),
(218, 11, '3-22', '3-22', NULL, '3-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7213cc5a7bac4a0b8491c827d2b33a488ea3fde2.jpeg', NULL, NULL, NULL, NULL, NULL),
(219, 16, '5-12', '5-12', NULL, '5-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'bdbd60aec0c08202f651b891402b36d95c870f9b.jpeg', NULL, NULL, NULL, NULL, NULL),
(220, 16, '5-13', '5-13', NULL, '5-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '859ae567492fd06e58161137b500a7caabba5111.jpeg', NULL, NULL, NULL, NULL, NULL),
(221, 16, '5-14', '5-14', NULL, '5-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6157b25c1372dcf922be11ff3a146ba02e17adb9.jpeg', NULL, NULL, NULL, NULL, NULL),
(222, 11, '3-23', '3-23', NULL, '3-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c209ccca19885b75ced643e8033761a2360c5685.jpeg', NULL, NULL, NULL, NULL, NULL),
(223, 16, '5-15', '5-15', NULL, '5-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '600c3254b613e4880530a1da69add7e98d4bf484.jpeg', NULL, NULL, NULL, NULL, NULL),
(224, 11, '3-24', '3-24', NULL, '3-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6ea145831db92ca6ae43d0ce9b1cd479cbf4b9a0.jpeg', NULL, NULL, NULL, NULL, NULL),
(225, 16, '5-16', '5-16', NULL, '5-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dbbcb5cf39c2f056c8a84a14846ef2f92894750f.jpeg', NULL, NULL, NULL, NULL, NULL),
(226, 16, '5-17', '5-17', NULL, '5-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'bdc77d80139fabc4dc36efeb7d20db71b94065a8.jpeg', NULL, NULL, NULL, NULL, NULL),
(227, 11, '3-25', '3-25', NULL, '3-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '489e057c6781eb967b965274d4a148fcd7f807d7.jpeg', NULL, NULL, NULL, NULL, NULL),
(228, 16, '5-18', '5-18', NULL, '5-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3abf21f2ba643f25e90d04c994ef5c00ac2f49b4.jpeg', NULL, NULL, NULL, NULL, NULL),
(229, 11, '3-26', '3-26', NULL, '3-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6dd29cd48d7703584596c359ee95bbf9184f5bf7.jpeg', NULL, NULL, NULL, NULL, NULL),
(230, 16, '5-19', '5-19', NULL, '5-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a21111df6334a76a7dbec62c632924239ffe2168.jpeg', NULL, NULL, NULL, NULL, NULL),
(231, 11, '3-27', '3-27', NULL, '3-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0df5f2a6d59261d3f72f1d303f9105289f27b683.jpeg', NULL, NULL, NULL, NULL, NULL),
(235, 11, '3-28', '3-28', NULL, '3-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9606ef3214969224093777b0dbe6caba83139ea9.jpeg', NULL, NULL, NULL, NULL, NULL),
(241, 11, '3-29', '3-29', NULL, '3-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ce016448324f7b0d2146ee681f91cffc4e9ef5dd.jpeg', NULL, NULL, NULL, NULL, NULL),
(244, 16, '5-20', '5-20', NULL, '5-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'aad7508ef73edf01e01435e92e57714f11938a01.jpeg', NULL, NULL, NULL, NULL, NULL),
(245, 16, '5-21', '5-21', NULL, '5-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'acb5b233347ea8770c4d45418bf44874157444b4.jpeg', NULL, NULL, NULL, NULL, NULL),
(246, 16, '5-22', '5-22', NULL, '5-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '723fc1c680757aed6b9f3fd8ff705c2945ff49b3.jpeg', NULL, NULL, NULL, NULL, NULL),
(247, 16, '5-23', '5-23', NULL, '5-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd6251a984c99c4e4cc1d5b6814d7048f65a1a217.jpeg', NULL, NULL, NULL, NULL, NULL),
(248, 16, '5-24', '5-24', NULL, '5-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a5193b51b3d3edf91f580960407f20a957d34030.jpeg', NULL, NULL, NULL, NULL, NULL),
(249, 16, '5-25', '5-25', NULL, '5-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd219700e9eab170465e71eb3e2df603be46787a0.jpeg', NULL, NULL, NULL, NULL, NULL),
(250, 16, '5-26', '5-26', NULL, '5-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9c07fd8c4220e2b83dd2738e639a0a60911464a0.jpeg', NULL, NULL, NULL, NULL, NULL),
(251, 16, '5-27', '5-27', NULL, '5-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8f98f04868e865efd3033487a5c68bbe63523723.jpeg', NULL, NULL, NULL, NULL, NULL),
(252, 16, '5-28', '5-28', NULL, '5-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dd7bb7ea7ed32a9f0a2d2fec6c1a07d03e967a35.jpeg', NULL, NULL, NULL, NULL, NULL),
(253, 16, '5-29', '5-29', NULL, '5-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9b781c18872f0b66d3498018a649b1cb8ce414f7.jpeg', NULL, NULL, NULL, NULL, NULL),
(254, 16, '5-30', '5-30', NULL, '5-30', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b073762d3d3ae2a7bccd7d74ab65f0a08c98b2a2.jpeg', NULL, NULL, NULL, NULL, NULL),
(255, 16, '5-31', '5-31', NULL, '5-31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '50afda616459ab11ceb05669e785d2f008e379fa.jpeg', NULL, NULL, NULL, NULL, NULL),
(256, 9, '6-1', '61', NULL, '6-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8eded101508a7b515472d3724396a4986978e5ea.jpeg', NULL, NULL, NULL, NULL, NULL),
(257, 16, '5-32', '5-32', NULL, '5-32', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '8c1fe30c7fb005148ecbf216691685318f1286c3.jpeg', NULL, NULL, NULL, NULL, NULL),
(258, 16, '5-33', '5-33', NULL, '5-33', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f65123ede3d6f74aa1ccb022b021adbcc6430863.jpeg', NULL, NULL, NULL, NULL, NULL),
(259, 9, '6-2', '6-2', NULL, '6-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b21776306cdf08f270bdb0d86ca24b4944ed1a2f.jpeg', NULL, NULL, NULL, NULL, NULL),
(260, 16, '5-34', '5-34', NULL, '5-34', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '84eba2d573c5fe69f8227a324a5a408bd790e0b1.jpeg', NULL, NULL, NULL, NULL, NULL),
(261, 16, '5-35', '5-35', NULL, '5-35', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1cbbcd6c0104a6d203fc54eff52d8215403825b5.jpeg', NULL, NULL, NULL, NULL, NULL),
(262, 9, '6-3', '6-3', NULL, '6-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '61dbe6548dc325a142f43dbdccb83a2d5e002075.jpeg', NULL, NULL, NULL, NULL, NULL),
(263, 10, '7-1', '7-1', NULL, '7-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '46e9bfb1b97cc5dae518fe32acd89fe0facbd745.jpeg', NULL, NULL, NULL, NULL, NULL),
(264, 9, '6-4', '6-4', NULL, '6-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '86fbb1f3b95ad35e9622617e81fb81c3773a96c4.jpeg', NULL, NULL, NULL, NULL, NULL),
(265, 10, '7-2', '7-2', NULL, '7-2', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6ea25d34e80e39845b5b1a7ba0b29818e0766b1b.jpeg', NULL, NULL, NULL, NULL, NULL),
(266, 10, '7-3', '7-3', NULL, '7-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1b7aef17bdac65d982805d72780940d70fa9652a.jpeg', NULL, NULL, NULL, NULL, NULL),
(267, 10, '7-4', '7-4', NULL, '7-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4af7906eea5434fc9650270fd90e4c78da77070e.jpeg', NULL, NULL, NULL, NULL, NULL),
(268, 10, '7-5', '7-5', NULL, '7-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '389cfa6765779ab16fe4ccefef71c1a64ca020e0.jpeg', NULL, NULL, NULL, NULL, NULL),
(269, 10, '7-6', '7-6', NULL, '7-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '534e9e1222be199a6bd43d93bc2b2ac1c826f733.jpeg', NULL, NULL, NULL, NULL, NULL),
(270, 10, '7-7', '7-7', NULL, '7-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2050d8642ab4df14f069ac2bcfc8e53cb4611213.jpeg', NULL, NULL, NULL, NULL, NULL),
(271, 10, '7-8', '7-8', NULL, '7-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '041fa068e2554ab237ed8f34e67ea4795495bf30.jpeg', NULL, NULL, NULL, NULL, NULL),
(272, 9, '6-5', '6-5', NULL, '6-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '86fbee4deed3ff4f5bcd08049a9ae063001ff80a.jpeg', NULL, NULL, NULL, NULL, NULL),
(273, 10, '7-9', '7-9', NULL, '7-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '905613f95217ed145049c4e0a367acd7d840ac8a.jpeg', NULL, NULL, NULL, NULL, NULL),
(274, 10, '7-10', '7-10', NULL, '7-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '94a8e740fdbb1ae96f5e39013731418c980edfc7.jpeg', NULL, NULL, NULL, NULL, NULL),
(275, 10, '7-11', '7-11', NULL, '7-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '161de0d0582d363fa917a8898192235e531cdcf8.jpeg', NULL, NULL, NULL, NULL, NULL),
(276, 9, '6-6', '6-6', NULL, '6-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6dfbb84a3cb5f16db5b4910724706f97655cf5fa.jpeg', NULL, NULL, NULL, NULL, NULL),
(277, 10, '7-12', '7-12', NULL, '7-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '791b5fb9762122007adcf58b5c705a54a185aa7c.jpeg', NULL, NULL, NULL, NULL, NULL),
(278, 9, '6-7', '6-7', NULL, '6-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '91c7edb1fd3c53be91518393f444234163ab5f1e.jpeg', NULL, NULL, NULL, NULL, NULL),
(279, 10, '7-13', '7-13', NULL, '7-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '94c5a08d6d2120196d7f8a4aef5996f2708a0cef.jpeg', NULL, NULL, NULL, NULL, NULL),
(280, 10, '7-14', '7-14', NULL, '7-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7e213142e027816259cbc45d17118c33bdb0a6b9.jpeg', NULL, NULL, NULL, NULL, NULL),
(281, 9, '6-8', '6-8', NULL, '6-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd659848624a1801059cd4f33b8d64ec035556168.jpeg', NULL, NULL, NULL, NULL, NULL),
(282, 10, '7-15', '7-15', NULL, '7-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0e67f5a54a43179d9c2b20fb64cc25a8a1f1e12b.jpeg', NULL, NULL, NULL, NULL, NULL),
(283, 10, '7-16', '7-16', NULL, '7-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '63721d6bf5f617d674f6593e33fc476d5c5a8a33.jpeg', NULL, NULL, NULL, NULL, NULL),
(284, 9, '6-9', '6-9', NULL, '6-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6a6305e22bdbdc79cb915460ed00411bd456e49f.jpeg', NULL, NULL, NULL, NULL, NULL),
(285, 10, '7-17', '7-17', NULL, '7-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5839e2be795cd57101214974481efe7d0524c353.jpeg', NULL, NULL, NULL, NULL, NULL),
(286, 9, '6-10', '6-10', NULL, '6-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '07914a2e97fce150b02baf10abfed2cc4fd98986.jpeg', NULL, NULL, NULL, NULL, NULL),
(287, 10, '7-18', '7-18', NULL, '7-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'cb6d71ed9575e07c87d99e5dc2605c8ed56bb4ab.jpeg', NULL, NULL, NULL, NULL, NULL),
(288, 9, '6-11', '6-11', NULL, '6-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6b9ec0254b17268a2aab0a2e940a059ffadb16ab.jpeg', NULL, NULL, NULL, NULL, NULL),
(289, 10, '7-19', '7-19', NULL, '7-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '135ae4432948b33796d955046a72f6b17d22f28c.jpeg', NULL, NULL, NULL, NULL, NULL),
(290, 10, '7-20', '7-20', NULL, '7-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '72203cabead14b0294c173188688044d969bddb6.jpeg', NULL, NULL, NULL, NULL, NULL),
(291, 9, '6-12', '6-12', NULL, '6-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '61f730cda33380724bde3839e0b8c14ee5b10755.jpeg', NULL, NULL, NULL, NULL, NULL),
(292, 10, '7-21', '7-21', NULL, '7-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5d20fb8fec2991c4ea58fa63a544f934f8a31631.jpeg', NULL, NULL, NULL, NULL, NULL),
(293, 10, '7-22', '7-22', NULL, '7-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '499ba5bdbb0958b0e2a218a00036a06ebe2c6fd7.jpeg', NULL, NULL, NULL, NULL, NULL),
(294, 9, '6-13', '6-13', NULL, '6-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f415d7bb271e1f1ed3857ba103835056c7cd0d6a.jpeg', NULL, NULL, NULL, NULL, NULL),
(295, 10, '7-23', '7-23', NULL, '7-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a1f6fb580f450995a97557125ace2c5b473528fb.jpeg', NULL, NULL, NULL, NULL, NULL),
(296, 9, '6-14', '6-14', NULL, '6-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e5e123e381258aeea0744f25859f1635af1a69d3.jpeg', NULL, NULL, NULL, NULL, NULL),
(297, 10, '7-24', '7-24', NULL, '7-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3bb66a42e3406a081946a15efa7d44f81c8a7b1d.jpeg', NULL, NULL, NULL, NULL, NULL),
(298, 9, '6-15', '6-15', NULL, '6-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9878ab644913bc87a3f99d95339f51e7b6ad7087.jpeg', NULL, NULL, NULL, NULL, NULL),
(299, 10, '7-25', '7-25', NULL, '7-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '4b22e3d963a95de3479f6edd372ae61e6e1df7b8.jpeg', NULL, NULL, NULL, NULL, NULL),
(300, 10, '7-26', '7-26', NULL, '7-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5ca86535ed1f04ab11f4e0d8213f467bd2e0b92d.jpeg', NULL, NULL, NULL, NULL, NULL),
(301, 10, '7-27', '7-27', NULL, '7-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c7b804434efee98c4a9a567003cb79c22aacfd46.jpeg', NULL, NULL, NULL, NULL, NULL),
(302, 9, '6-16', '6-16', NULL, '6-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '57aa52138f9a0e46d2cd35b207f97e316451f966.jpeg', NULL, NULL, NULL, NULL, NULL),
(303, 10, '7-28', '7-28', NULL, '7-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '57e138e9b17ce06f271eba643490e1c754c03645.jpeg', NULL, NULL, NULL, NULL, NULL),
(304, 10, '7-29', '7-29', NULL, '7-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '64b39a26b7cff0965fa167dbaac1aa05e06bfff3.jpeg', NULL, NULL, NULL, NULL, NULL),
(305, 9, '6-17', '6-17', NULL, '6-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2fc86987283638fae0a0f871f78ce76e2ab535f1.jpeg', NULL, NULL, NULL, NULL, NULL),
(306, 10, '7-30', '7-30', NULL, '7-30', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9ff3f7b76b46645e84a2dd922ddb4df7a2be9c2a.jpeg', NULL, NULL, NULL, NULL, NULL),
(307, 9, '6-18', '6-18', NULL, '6-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0cbead446b11d0eb5a39f6bd1ff44f478b7f4663.jpeg', NULL, NULL, NULL, NULL, NULL),
(308, 10, '7-31', '7-31', NULL, '7-31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c8eaebdf7ee2a8fd60d12273a94dc35056110139.jpeg', NULL, NULL, NULL, NULL, NULL),
(309, 10, '7-32', '7-32', NULL, '7-32', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'ce9d3290ac05eaea402f7e481b2eddb80052149c.jpeg', NULL, NULL, NULL, NULL, NULL),
(310, 9, '6-19', '6-19', NULL, '6-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6972824f8f361d5ce868d6cc7c0e1525aa39e503.jpeg', NULL, NULL, NULL, NULL, NULL),
(311, 10, '7-33', '7-33', NULL, '7-33', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2f86270b15fcea4d060484ffa03e2a19cbc569ee.jpeg', NULL, NULL, NULL, NULL, NULL),
(312, 9, '6-20', '6-20', NULL, '6-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a7769ad6e8be89da8611a5c368023130e9613f50.jpeg', NULL, NULL, NULL, NULL, NULL),
(313, 10, '7-34', '7-34', NULL, '7-34', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f353d4cfdc0716e14675bd3d36d93417826a899c.jpeg', NULL, NULL, NULL, NULL, NULL),
(314, 9, '6-21', '6-21', NULL, '6-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5f298aa0828c00f4a80c41337f8f4bf177e4a3db.jpeg', NULL, NULL, NULL, NULL, NULL),
(315, 9, '6-22', '6-22', NULL, '6-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '04e744dd6fca7db24aa304289e9266f5e13f00e6.jpeg', NULL, NULL, NULL, NULL, NULL),
(316, 9, '6-23', '6-23', NULL, '6-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '0c700a0beaa8038a388e83fdca51529662d1833f.jpeg', NULL, NULL, NULL, NULL, NULL),
(317, 9, '6-24', '6-24', NULL, '6-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '2f84d453bd1ce19f6f20e34f5a6f9a175bb3cc48.jpeg', NULL, NULL, NULL, NULL, NULL),
(318, 9, '6-25', '6-25', NULL, '6-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '972d736292ef6a2a5b36b9368eab3e86a6c631bc.jpeg', NULL, NULL, NULL, NULL, NULL),
(319, 9, '6-26', '6-26', NULL, '6-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e10dd7f4393404fd068acc018717d51a1f6cd523.jpeg', NULL, NULL, NULL, NULL, NULL),
(320, 9, '6-27', '6-27', NULL, '6-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c5b415eada9d115beafa1db50fa96e1791e24ff7.jpeg', NULL, NULL, NULL, NULL, NULL),
(321, 9, '6-28', '6-28', NULL, '6-28', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dc0cbcf7ff2c95364a530fb8a648ec199f7e1bed.jpeg', NULL, NULL, NULL, NULL, NULL),
(322, 9, '6-29', '6-29', NULL, '6-29', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5973340c1f32a143ffdef79d1cc9aed234ee643a.jpeg', NULL, NULL, NULL, NULL, NULL),
(323, 9, '6-30', '6-30', NULL, '6-30', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'f2396c9a478bc53edb91c252aca30312e705d647.jpeg', NULL, NULL, NULL, NULL, NULL),
(324, 9, '6-31', '6-31', NULL, '6-31', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3f8f63a23b8e197993303d5053d48b3390ecd247.jpeg', NULL, NULL, NULL, NULL, NULL),
(325, 9, '6-32', '6-32', NULL, '6-32', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '37b05310372dcfe37043ddbdc0ce7ea18554da96.jpeg', NULL, NULL, NULL, NULL, NULL),
(326, 9, '6-33', '6-33', NULL, '6-33', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '6f6cc81cda000aa644bd134e559891b0c4c6f275.jpeg', NULL, NULL, NULL, NULL, NULL),
(327, 9, '6-34', '6-34', NULL, '6-34', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9abc5f1babf1e5560b68f0c67ec67b85ba7c4e09.jpeg', NULL, NULL, NULL, NULL, NULL),
(328, 9, '6-35', '6-35', NULL, '6-35', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '48ddbed6ce9905375edd4eaaec2f47130fa39500.jpeg', NULL, NULL, NULL, NULL, NULL),
(334, 15, '8-1', '8-1', NULL, '8-1', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'fcf4dce24a28b1b276f6507c771e15a87ec91652.jpeg', NULL, NULL, NULL, NULL, NULL),
(335, 15, '8-3', '8-3', NULL, '8-3', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7ab098f539ec9c5c0388c73bdb8dade0e9ceffbd.jpeg', NULL, NULL, NULL, NULL, NULL),
(336, 15, '8-4', '8-4', NULL, '8-4', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '7f1ec15bfd9d5bfb1a62c78dbae72963cbb8fa13.jpeg', NULL, NULL, NULL, NULL, NULL),
(337, 15, '8-5', '8-5', NULL, '8-5', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '9da8114cc5a672d43ce5d96fee5316e9c030d243.jpeg', NULL, NULL, NULL, NULL, NULL),
(338, 15, '8-6', '8-6', NULL, '8-6', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '46d373cb8395c34802fdbff76b2a613b688c4d80.jpeg', NULL, NULL, NULL, NULL, NULL),
(339, 15, '8-7', '8-7', NULL, '8-7', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e8ca7f8472f026b5afd4f19082d0d14ab28063cd.jpeg', NULL, NULL, NULL, NULL, NULL),
(340, 15, '8-8', '8-8', NULL, '8-8', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'bcfcd7d03af55ea21c4b37faf3838e380dde4107.jpeg', NULL, NULL, NULL, NULL, NULL),
(341, 15, '8-9', '8-9', NULL, '8-9', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'cfaf6a1c5961f9c0de8586071f4271173eafe35a.jpeg', NULL, NULL, NULL, NULL, NULL),
(342, 15, '8-10', '8-10', NULL, '8-10', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'b8f8e464d0bcac297c776cbf1628f28ee4fc25aa.jpeg', NULL, NULL, NULL, NULL, NULL),
(343, 15, '8-11', '8-11', NULL, '8-11', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '738131b2d0a9ecd8bc9394eb5146c14e31e2ffc5.jpeg', NULL, NULL, NULL, NULL, NULL),
(344, 15, '8-12', '8-12', NULL, '8-12', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'fc59ec1c5a35da3f0a29bc0d3f81ec8133c008d8.jpeg', NULL, NULL, NULL, NULL, NULL),
(345, 15, '8-13', '8-13', NULL, '8-13', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'a25fea6ff3e830efb3d5f5b3155129ef68a49379.jpeg', NULL, NULL, NULL, NULL, NULL),
(346, 15, '8-14', '8-14', NULL, '8-14', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'c80b12f127896bd2a10f87fb08d292c4d1c11d14.jpeg', NULL, NULL, NULL, NULL, NULL),
(347, 15, '8-15', '8-15', NULL, '8-15', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'd3945823e9c1dc8587754fd77bf04102bca204cf.jpeg', NULL, NULL, NULL, NULL, NULL),
(348, 15, '8-16', '8-16', NULL, '8-16', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1084f1ddcc67eada0221f462836481d08100a4d8.jpeg', NULL, NULL, NULL, NULL, NULL),
(349, 15, '8-17', '8-17', NULL, '8-17', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '5350420a81d7af5debd0c3f448e7c57560d64ce5.jpeg', NULL, NULL, NULL, NULL, NULL),
(350, 15, '8-18', '8-18', NULL, '8-18', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e51e41770a984fc4a93f2acbeef5f2a44723032f.jpeg', NULL, NULL, NULL, NULL, NULL),
(351, 15, '8-19', '8-19', NULL, '8-19', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '82eafed1fab1acf9ad47398bd239a1a86218406c.jpeg', NULL, NULL, NULL, NULL, NULL),
(352, 15, '8-20', '8-20', NULL, '8-20', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'dd2d8fd59b3368aa960b2193a33c3e0830d1a287.jpeg', NULL, NULL, NULL, NULL, NULL),
(353, 15, '8-21', '8-21', NULL, '8-21', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '1ad71bfddcf10bcadac77c2a6b3fcc895a55c84f.jpeg', NULL, NULL, NULL, NULL, NULL),
(354, 15, '8-22', '8-22', NULL, '8-22', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '645f390f1f5329b30e657746be53dc9e68679959.jpeg', NULL, NULL, NULL, NULL, NULL),
(355, 15, '8-23', '8-23', NULL, '8-23', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '27b0b7f0191d1a44c450d6378aa2aa915160d406.jpeg', NULL, NULL, NULL, NULL, NULL),
(356, 15, '8-24', '8-24', NULL, '8-24', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '55becbd9075d651d3f1692978d02d0f2e1415d41.jpeg', NULL, NULL, NULL, NULL, NULL),
(357, 15, '8-25', '8-25', NULL, '8-25', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', 'e6e6c406bd0043be4fd7b6ec900b3e182b46d278.jpeg', NULL, NULL, NULL, NULL, NULL),
(358, 15, '8-26', '8-26', NULL, '8-26', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '38f6111a7b32b78c794b04149407188fd71c0a7a.jpeg', NULL, NULL, NULL, NULL, NULL),
(359, 15, '8-27', '8-27', NULL, '8-27', NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, 'a:0:{}', '3e62af1a12e12930eda9fb41a48c950fbd945a5b.jpeg', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_category`
--

CREATE TABLE `shop_product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_category`
--

INSERT INTO `shop_product_category` (`product_id`, `category_id`) VALUES
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(18, 3),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_color`
--

CREATE TABLE `shop_product_color` (
  `product_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_color`
--

INSERT INTO `shop_product_color` (`product_id`, `color_id`) VALUES
(4, 3),
(4, 4),
(4, 5),
(5, 7),
(6, 8),
(6, 10),
(7, 12),
(7, 13),
(7, 14),
(8, 15),
(8, 16),
(8, 17),
(9, 19),
(9, 20),
(9, 21),
(9, 22),
(10, 24),
(10, 25),
(11, 29),
(12, 30),
(13, 33),
(14, 34),
(15, 37),
(15, 38),
(16, 42),
(17, 46),
(17, 47),
(18, 49),
(19, 50),
(20, 55),
(21, 57),
(21, 58),
(21, 74),
(22, 61),
(23, 62),
(24, 63),
(25, 64),
(25, 72),
(26, 65),
(26, 73),
(27, 66),
(28, 67),
(29, 68),
(29, 69),
(30, 70),
(31, 71);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_filter`
--

CREATE TABLE `shop_product_filter` (
  `product_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_filter`
--

INSERT INTO `shop_product_filter` (`product_id`, `filter_id`) VALUES
(4, 1),
(4, 2),
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(7, 2),
(8, 2),
(9, 1),
(9, 2),
(10, 1),
(10, 2),
(11, 1),
(11, 2),
(12, 1),
(12, 2),
(13, 2),
(14, 1),
(14, 2),
(15, 1),
(15, 2),
(16, 1),
(16, 2),
(17, 1),
(17, 2),
(18, 1),
(18, 3),
(19, 1),
(19, 3),
(20, 1),
(20, 3),
(21, 1),
(21, 3),
(22, 1),
(22, 3),
(23, 1),
(23, 8),
(24, 1),
(24, 8),
(25, 1),
(25, 8),
(26, 1),
(26, 8),
(27, 1),
(27, 10),
(28, 1),
(28, 10),
(29, 1),
(29, 10),
(30, 1),
(30, 10),
(31, 1),
(31, 10);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_size`
--

CREATE TABLE `shop_product_size` (
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_size`
--

INSERT INTO `shop_product_size` (`product_id`, `size_id`) VALUES
(4, 2),
(4, 3),
(4, 4),
(5, 1),
(5, 2),
(5, 3),
(6, 2),
(6, 3),
(6, 4),
(7, 1),
(7, 2),
(7, 3),
(8, 2),
(8, 3),
(8, 4),
(9, 2),
(9, 3),
(9, 4),
(10, 2),
(10, 3),
(10, 4),
(11, 1),
(11, 2),
(11, 3),
(11, 4),
(12, 2),
(12, 3),
(12, 4),
(13, 1),
(13, 2),
(13, 3),
(14, 2),
(14, 3),
(14, 4),
(15, 2),
(15, 3),
(15, 4),
(16, 2),
(16, 3),
(16, 4),
(17, 2),
(17, 3),
(17, 4),
(18, 2),
(18, 3),
(18, 4),
(19, 2),
(19, 3),
(19, 4),
(20, 1),
(20, 2),
(20, 3),
(20, 4),
(21, 2),
(21, 3),
(21, 4),
(22, 1),
(22, 2),
(22, 3),
(22, 4),
(23, 2),
(23, 3),
(23, 4),
(24, 2),
(24, 3),
(24, 4),
(25, 2),
(25, 3),
(25, 4),
(26, 2),
(26, 3),
(26, 4),
(27, 2),
(27, 3),
(27, 4),
(28, 2),
(28, 3),
(28, 4),
(29, 2),
(29, 3),
(29, 4),
(30, 2),
(30, 3),
(30, 4),
(31, 2),
(31, 3),
(31, 4);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_stroe`
--

CREATE TABLE `shop_product_stroe` (
  `id` int(11) NOT NULL,
  `size_id` int(11) DEFAULT NULL,
  `color_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `store_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_stroe`
--

INSERT INTO `shop_product_stroe` (`id`, `size_id`, `color_id`, `product_id`, `store_id`, `count`) VALUES
(1, 2, 3, 4, 1, 2),
(2, 3, 3, 4, 1, 2),
(3, 4, 3, 4, 1, 0),
(4, 2, 4, 4, 1, 1),
(5, 3, 4, 4, 1, 1),
(6, 4, 4, 4, 1, 1),
(7, 2, 5, 4, 1, 1),
(8, 3, 5, 4, 1, 1),
(9, 4, 5, 4, 1, 1),
(10, 2, 6, 4, 1, 1),
(11, 3, 6, 4, 1, 1),
(12, 4, 6, 4, 1, 1),
(13, 1, 24, 10, 1, 1),
(14, 2, 24, 10, 1, 4),
(15, 3, 24, 10, 1, 5),
(16, 4, 24, 10, 1, 0),
(17, 1, 25, 10, 1, 1),
(18, 2, 25, 10, 1, 4),
(19, 3, 25, 10, 1, 4),
(20, 4, 25, 10, 1, 0),
(21, 1, 26, 10, 1, 1),
(22, 2, 26, 10, 1, 1),
(23, 3, 26, 10, 1, 1),
(24, 4, 26, 10, 1, 1),
(25, 2, 3, 4, 2, 1),
(26, 3, 3, 4, 2, 1),
(27, 4, 3, 4, 2, 1),
(28, 2, 4, 4, 2, 1),
(29, 3, 4, 4, 2, 1),
(30, 4, 4, 4, 2, 1),
(31, 2, 5, 4, 2, 0),
(32, 3, 5, 4, 2, 0),
(33, 4, 5, 4, 2, 0),
(34, 1, 7, 5, 1, 0),
(35, 2, 7, 5, 1, 0),
(36, 3, 7, 5, 1, 0),
(37, 2, 8, 6, 1, 0),
(38, 3, 8, 6, 1, 4),
(39, 4, 8, 6, 1, 0),
(40, 2, 9, 6, 1, 0),
(41, 3, 9, 6, 1, 0),
(42, 4, 9, 6, 1, 0),
(43, 2, 10, 6, 1, 2),
(44, 3, 10, 6, 1, 4),
(45, 4, 10, 6, 1, 0),
(46, 2, 19, 9, 1, 3),
(47, 3, 19, 9, 1, 2),
(48, 4, 19, 9, 1, 1),
(49, 2, 20, 9, 1, 1),
(50, 3, 20, 9, 1, 1),
(51, 4, 20, 9, 1, 1),
(52, 2, 21, 9, 1, 0),
(53, 3, 21, 9, 1, 0),
(54, 4, 21, 9, 1, 0),
(55, 2, 22, 9, 1, 0),
(56, 3, 22, 9, 1, 0),
(57, 4, 22, 9, 1, 0),
(58, 2, 64, 25, 1, 6),
(59, 3, 64, 25, 1, 6),
(60, 4, 64, 25, 1, 2),
(61, 2, 72, 25, 1, 3),
(62, 3, 72, 25, 1, 2),
(63, 4, 72, 25, 1, 3),
(64, 2, 65, 26, 1, 2),
(65, 3, 65, 26, 1, 2),
(66, 4, 65, 26, 1, 2),
(67, 2, 73, 26, 1, 1),
(68, 3, 73, 26, 1, 1),
(69, 4, 73, 26, 1, 1),
(70, 2, 57, 21, 1, 2),
(71, 3, 57, 21, 1, 1),
(72, 4, 57, 21, 1, 1),
(73, 2, 58, 21, 1, 3),
(74, 3, 58, 21, 1, 1),
(75, 4, 58, 21, 1, 0),
(76, 2, 74, 21, 1, 1),
(77, 3, 74, 21, 1, 1),
(78, 4, 74, 21, 1, 1),
(79, 2, 34, 14, 1, 2),
(80, 3, 34, 14, 1, 2),
(81, 4, 34, 14, 1, 0),
(82, 2, 37, 15, 1, 2),
(83, 3, 37, 15, 1, 2),
(84, 4, 37, 15, 1, 0),
(85, 2, 38, 15, 1, 2),
(86, 3, 38, 15, 1, 1),
(87, 4, 38, 15, 1, 0),
(88, 2, 46, 17, 1, 4),
(89, 3, 46, 17, 1, 4),
(90, 4, 46, 17, 1, 2),
(91, 2, 47, 17, 1, 4),
(92, 3, 47, 17, 1, 4),
(93, 4, 47, 17, 1, 2),
(94, 2, 30, 12, 1, 0),
(95, 3, 30, 12, 1, 2),
(96, 4, 30, 12, 1, 2),
(97, 2, 50, 19, 1, 1),
(98, 3, 50, 19, 1, 1),
(99, 4, 50, 19, 1, 1),
(100, 2, 62, 23, 1, 1),
(101, 3, 62, 23, 1, 1),
(102, 4, 62, 23, 1, 0),
(103, 2, 42, 16, 1, 0),
(104, 3, 42, 16, 1, 0),
(105, 4, 42, 16, 1, 1),
(106, 2, 49, 18, 1, 2),
(107, 3, 49, 18, 1, 2),
(108, 4, 49, 18, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `shop_product_user`
--

CREATE TABLE `shop_product_user` (
  `product_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_product_user`
--

INSERT INTO `shop_product_user` (`product_id`, `user_id`) VALUES
(4, 1),
(4, 5),
(5, 1),
(5, 5),
(6, 1),
(6, 2),
(7, 1),
(7, 5);

-- --------------------------------------------------------

--
-- Table structure for table `shop_setting_country`
--

CREATE TABLE `shop_setting_country` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `lvl` int(11) NOT NULL,
  `root` int(11) DEFAULT NULL,
  `procent` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_setting_country`
--

INSERT INTO `shop_setting_country` (`id`, `parent_id`, `name`, `status`, `orderning`, `lft`, `rgt`, `lvl`, `root`, `procent`) VALUES
(1, NULL, 'СНГ', 1, 1, 1, 6, 0, 1, '15.00'),
(2, 1, 'Россия', 1, 0, 2, 3, 1, 1, '15.00'),
(3, 1, 'Кыргызстан', 1, 2, 4, 5, 1, 1, '15.00');

-- --------------------------------------------------------

--
-- Table structure for table `shop_setting_currency`
--

CREATE TABLE `shop_setting_currency` (
  `id` int(11) NOT NULL,
  `iso_name` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `morph1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `morph2` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `morph5` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `subunit_morph1` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `subunit_morph2` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `subunit_morph5` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `short_sign` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `main` tinyint(1) NOT NULL DEFAULT '0',
  `rate` double DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_setting_currency`
--

INSERT INTO `shop_setting_currency` (`id`, `iso_name`, `name`, `symbol`, `morph1`, `morph2`, `morph5`, `subunit_morph1`, `subunit_morph2`, `subunit_morph5`, `short_sign`, `main`, `rate`, `status`, `created`) VALUES
(1, 'KGS', 'Сом', 'Сом', 'Сом', 'Сома', 'Сомов', 'Тыйын', 'Тыйына', 'Тыйынов', 'Сом', 1, 1, 1, '2016-03-18 11:40:26'),
(2, 'RUB', 'Рубль', 'Рубль', 'Рубль', 'Рубля', 'Рублей', 'Копейка', 'Копейки', 'Копеек', 'Рубль', 0, 1.05, 1, '2016-03-18 11:43:30');

-- --------------------------------------------------------

--
-- Table structure for table `shop_setting_slider_image`
--

CREATE TABLE `shop_setting_slider_image` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_setting_slider_image`
--

INSERT INTO `shop_setting_slider_image` (`id`, `category_id`, `product_id`, `name`, `title`, `status`, `orderning`, `type`, `logo`) VALUES
(5, NULL, NULL, '11', '<p>1</p>', 1, 1, 'product', '854b634cf954ee55cb5453769232f891406a707b.jpeg'),
(6, NULL, NULL, '22', '<p>22</p>', 1, 2, 'product', '7dbaa46663c9658036b83c5296d9645982b03e32.jpeg'),
(7, NULL, NULL, '33', '<p>33</p>', 1, 3, 'product', '3bc819054576e1465ed69d5618a31bf47b52fa9e.jpeg'),
(8, NULL, NULL, '44', '<p>44</p>', 1, 4, 'product', '354b557e011ae7ad0e194ef60a9ec49d733005ce.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `shop_shop_by_look`
--

CREATE TABLE `shop_shop_by_look` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `orderning` int(11) DEFAULT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_shop_by_look`
--

INSERT INTO `shop_shop_by_look` (`id`, `name`, `status`, `orderning`, `logo`, `category_id`) VALUES
(2, 'Платье "Шарлиз"', 1, 1, 'e0ed0e25d53f3f423aa17b2077052eb3d2bdf235.jpeg', 3),
(3, 'Платье "Клаудия"', 1, 2, '2fb12db3c72c01c223157bd13b0b4c9df55888fd.jpeg', 3),
(4, 'Платье "Изи"', 1, 3, '3e86daabf072c9a5575bac6e07dc8a7b0f74e121.jpeg', 3),
(5, 'Блузка "Твист-Луз"', 1, 4, '92805d22b5909ea925677444e5c621b63785a09f.jpeg', 3),
(6, 'Брюки "Луз"', 1, 5, 'c3eb95b6b61e04e38ab838ef8b119ee20eaf24fe.jpeg', 3),
(7, 'Жилет "Деловая леди"', 1, 6, 'db5ac83f31495140d7fe74f79f5c7247dc3da056.jpeg', 3),
(8, 'Блузка "Твист без рукавов"', 1, 7, '07fd7e62c2c475144bb5a923c452bbc68b3286ce.jpeg', 3),
(9, 'Платье "Слим Джерси"', 1, 8, 'fc62f2c18148d7395502fd949ca08731268210c5.jpeg', 3),
(10, 'Сет " Спорт стайл"', 1, 9, 'a27bfcb2bd0208f90376347330dba7094c54aa7e.jpeg', 3),
(11, 'Брюки "Луз"', 1, 10, '5174293731a43cdb9218f450dab24243e5fa9003.jpeg', 3),
(12, 'Юбка "Сакура"-Топ "Углы"', 1, 11, 'fbbea22eeced1f1a885580971e6c4c4fbe61e955.jpeg', 3),
(13, 'Многофункциональный плащ "Роттердам"- Брюки "Луз" белые', 1, 12, '77a757fda17c1bffcfdf4b11a36fbdbfe679d20a.jpeg', 3),
(14, 'Жакет-парка "Крепон стиль"- Брюки "Луз"', 1, 13, '4e924fcbedfcc9da05a8bc20e042f4403ca1abf8.jpeg', 3),
(15, 'Костюм - сет "Шелковый лен-черный"', 1, 14, 'e1baa68e1fe811b3e08137eac8f5807c8f4ae9f2.jpeg', 3),
(16, 'Костюм - сет "Шелковый лен-черный"', 1, 15, 'b8ca1ac5f3bec3a51b5c4cb99a543c10b2296de5.jpeg', 3),
(17, 'Блуза-рубашка "Анжелика"', 1, 16, '797f9330a9d2b723824b6ee5467083a7b83348f4.jpeg', 3),
(18, 'Блузка "Осака"', 1, 17, 'd82b8728ab1d3eb694e3bfab6b750f5bf3071b76.jpeg', 3),
(19, 'Топ "Лайф"', 1, 18, 'ad48a9a6e43e1027773a6e16c3937f1d304f7a79.jpeg', 3),
(20, 'Платье "Блю Джин"', 1, 19, '76f327eead6e5cd761d32f083104a61b9166d3ae.jpeg', 3),
(21, 'Платье "Три лайерс батик"', 1, 20, '9eb87d78ad19f0479811544142c3b6ec431026b9.jpeg', 3),
(22, 'Кафтан "Паприка"', 1, 21, 'fe380f973fded8c955205bf9a6d0ec5be1325c4a.jpeg', 3),
(23, 'Платье "Шторми"', 1, 22, '02e0d6470716e524ef6af8a12a9a02f69365d62a.jpeg', 3),
(24, 'Кафтан "Батик"', 1, 23, '08656eb4f1b649e4a2557e8fe098f873e9d577a0.jpeg', 3),
(25, 'Платье "Найт Блюз"', 1, 24, '874e13b23dc73785116772c1473f477d8f0ca8be.jpeg', 3),
(26, 'Кафтан "Квадрат"', 1, 25, '831cfa1c672d23a886064885302d6ff3c312864b.jpeg', 3),
(27, 'Платье-рубашка "Дженис Джоплин"', 1, 26, '58dca551aa8fc1ef09ad43a3d8ffea0b66c9e0fa.jpeg', 3),
(28, 'Кафтан-рубашка "Батик"', 1, 27, '5e5005d3ff513f98a9a7531cdaa82e13f7c1ca6f.jpeg', 3),
(29, 'Платье "Мини-Деним"', 1, 28, '468762576a00ff18ebb6b220516cad2a64b6f060.jpeg', 3),
(30, 'Жакет-парка "Крепон стиль"- Блузка "Твист без рукавов"', 1, 29, '7e970072588c578afefa7a7d5fe8cd88d4070d7f.jpeg', 3),
(31, 'Плащ "Шторми" без рукавов', 1, 30, '54b520b002ce68ba8f7bb4a91a73ec75c7dabc90.jpeg', 3),
(32, 'Топ "Уголок"', 1, 31, 'dcdef0aec25746728acfb47cab4fa6bf2db29689.jpeg', 3),
(33, 'Комбинезон-шорты "Принт"', 1, 32, '180ce01f19e9df51c466b5850fb11eb180755543.jpeg', 3),
(34, 'Топ "Паприка с капюшоном"', 1, 33, '162ede82a5bcd6904e151d1cbc2195a75964db5d.jpeg', 3),
(35, 'Топ "Уголок"', 1, 34, '914dd8be25b43f9a83ea51636d5e35ed8191262e.jpeg', 3),
(36, 'Куртка "Сборка атлантик-дип"', 1, 35, '6d6a549c8a13af1d17a57cf6f73db6f5dd916271.jpeg', 3),
(37, 'Комбинезон-шорты "Льняной"', 1, 36, 'cca44446803de2fdf27621b62e2a723e9ccabe23.jpeg', 3),
(38, 'Блузка "Твист" с длиными рукавами', 1, 37, 'ac8daafedc68af217fc5abce0b8040b3278b3621.jpeg', 3),
(39, 'Куртка "Джин"-Юбка "Сакура"', 1, 38, 'a5f9f380ca9a2ae6e221e57a73835555e74a5135.jpeg', 3),
(40, 'Блузка "Твист" с длиными рукавами-Юбка "Барбара"', 1, 39, 'bb7dfacf9cda3c532a3d0befe6a17e3b820d9e68.jpeg', 3),
(41, 'Платье "Кокон"', 1, 40, '01e2e39de715a123ca35837cc144f7fab7e7fcdd.jpeg', 3),
(42, 'Платье шелковое длинное "Блю Джин"', 1, 41, 'f033531fe7368c17e631770cba37e40806c51f6f.jpeg', 3),
(43, 'Платье длинное "Инфинити"', 1, 42, '61b5029b06aa78c4bf09638c73e6c149322a8c21.jpeg', 3),
(44, 'Комбинезон "Вудсмок"', 1, 43, 'db382c22928025a7a5d0ac0964e884b0503ec633.jpeg', 3),
(45, 'Платье "Три уровня - Батик"', 1, 44, 'd3a50db5895b17d51a5bb808103d45e555297ab4.jpeg', 3),
(46, 'Кафтан-рубашка "Клетчатый энзим"', 1, 45, '2a9cad429650c74cb0315e3cff457abc3aa1e0c4.jpeg', 3),
(47, 'Комбинезон "Вудсмок"', 1, 46, 'd73773c3932e28c9bf726ae8f824d10578b314fa.jpeg', 3),
(48, '1', 1, 1, '03c07bc73e080a6eb239faf0b5f3dcb16671eff6.jpeg', 5),
(49, '2', 1, 2, '9d51057fe7f5310d8c6efd81fa99bd182af09d3e.jpeg', 5),
(50, '3', 1, 3, '26368e36e78f2bebf5eae255504d3dcd2ff11144.jpeg', 5),
(51, '4', 1, 4, 'ce95e48510ddb7f5685186aef8b451ed0b144812.jpeg', 5),
(52, '5', 1, 5, '7862b356aeaad0941711696c7300c7f6da1def40.jpeg', 5),
(53, '6', 1, 6, '4ed1a2efa5c648de271021d85c9e08558bf59757.jpeg', 5),
(54, '7', 1, 7, 'eead630450cadb4ac543e65868cdb96860d0d89c.jpeg', 5),
(55, '8', 1, 8, 'a402c539960a60b987fce738d471a1aa70cf25ca.jpeg', 5),
(56, '9', 1, 9, 'eba2cb8eb51a54eedae08c68a4d850a28f90be25.jpeg', 5),
(57, '10', 1, 10, '421b499c91dd085165de829ece6073f1612ee91c.jpeg', 5),
(58, '11', 1, 11, '6ff2a10dc19d59e5071a2ce9e65d629ecffd51ae.jpeg', 5),
(59, '12', 1, 12, '5ea3283c51f368ae9b5a70da8072dc406290f290.jpeg', 5),
(60, '13', 1, 13, '707a0ac2c5854cd0a76ebb44f7b803147e80f5cb.jpeg', 5),
(61, '14', 1, 14, 'a956e8e476beca74ea1f931e6949e4fad7ac524c.jpeg', 5),
(62, '15', 1, 15, '1de94187543fb5546271e1d38fde59a3423de650.jpeg', 5),
(63, '16', 1, 16, '63ed7c6663b7d020dd8d19b3c188325e62efd075.jpeg', 5),
(64, '17', 1, 17, '44306b5c696e05b5ea19d1477c4fd1bf1446e896.jpeg', 5),
(65, '18', 1, 18, 'a5355a7b1a2726f48b79dfe21696b172e896603f.jpeg', 5),
(66, '19', 1, 19, '8f23a2cf886f927a678a7aba8087d2d39c9768a4.jpeg', 5),
(67, '20', 1, 20, '496c12b0f265db4c4cfba42b788a58d058a8018c.jpeg', 5),
(68, '21', 1, 21, '8e030e6ea24c9ff705d8d88843b26701d7aa1e82.jpeg', 5),
(69, '22', 1, 22, '5085daea1b96c987e6a021a9f921b76c74e0dad4.jpeg', 5),
(70, '23', 1, 23, '913c1759552f6ed61f53341c8ef4f82b34f74534.jpeg', 5),
(71, '24', 1, 24, '80b3d82787cfaae49b6684238316d7e5d231ecd8.jpeg', 5),
(72, '25', 1, 25, 'fc9933db087f3310d9d3f9df0b5f4a735bdfd0a5.jpeg', 5),
(73, '26', 1, 26, '3343305a9f0cfa0acff758da222b8eecf34fd38b.jpeg', 5),
(74, '27', 1, 27, 'f52dd87c5831798c410a8b1c6ba51d5295dae4af.jpeg', 5),
(75, '28', 1, 28, '7cb2d1942927c6e1074c7df82642b34d6a59930c.jpeg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `shop_shop_by_look_product`
--

CREATE TABLE `shop_shop_by_look_product` (
  `shop_by_look_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_shop_by_look_product`
--

INSERT INTO `shop_shop_by_look_product` (`shop_by_look_id`, `product_id`) VALUES
(4, 4),
(6, 24),
(6, 31),
(7, 19),
(8, 18),
(8, 23),
(9, 5),
(9, 27),
(10, 29),
(11, 24),
(11, 31),
(12, 23),
(13, 24),
(13, 30),
(14, 24),
(14, 28),
(17, 22),
(18, 20),
(20, 8),
(22, 16),
(23, 9),
(24, 14),
(25, 6),
(26, 12),
(27, 10),
(28, 17),
(30, 18),
(30, 28),
(31, 31),
(32, 19),
(35, 19),
(37, 26),
(38, 21),
(39, 23),
(40, 21),
(41, 11),
(44, 25),
(45, 7),
(46, 15),
(47, 25);

-- --------------------------------------------------------

--
-- Table structure for table `shop_size`
--

CREATE TABLE `shop_size` (
  `id` int(11) NOT NULL,
  `size` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `marking` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bust` double DEFAULT NULL,
  `waist` double DEFAULT NULL,
  `hips` double DEFAULT NULL,
  `front_waist_length` double DEFAULT NULL,
  `bust_depth` double DEFAULT NULL,
  `back_length` double DEFAULT NULL,
  `back_width` double DEFAULT NULL,
  `shoulder_width` double DEFAULT NULL,
  `hand_length` double DEFAULT NULL,
  `height` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_size`
--

INSERT INTO `shop_size` (`id`, `size`, `marking`, `bust`, `waist`, `hips`, `front_waist_length`, `bust_depth`, `back_length`, `back_width`, `shoulder_width`, `hand_length`, `height`) VALUES
(1, '42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '44', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '46', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '48', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '50', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '52', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_store`
--

CREATE TABLE `shop_store` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `shop_store`
--

INSERT INTO `shop_store` (`id`, `country_id`, `name`, `status`) VALUES
(1, 3, 'Кыргызстан Бишкек', 1),
(2, 2, 'Склад  Россия', 1);

-- --------------------------------------------------------

--
-- Table structure for table `subscribe`
--

CREATE TABLE `subscribe` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `date` datetime NOT NULL,
  `type` varchar(5) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subscribe`
--

INSERT INTO `subscribe` (`id`, `name`, `title`, `content`, `date`, `type`) VALUES
(2, 'Пример рассылки', 'Проверка', '<p><strong>Проверка еуые</strong></p>', '2016-07-28 19:12:28', 'b2b');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `f_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `news` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `name`, `f_name`, `gender`, `news`) VALUES
(1, 'admin', 'admin', 'web.arli@gmail.com', 'web.arli@gmail.com', 1, '9qkos6gdcmko4cocc88w8wkosgs0wc4', '$2y$13$O.BqZrW1JBF63EOTlVbrp..8Pjm0dQC9GshzrzGmlSoxnOt.02RM2', '2016-10-18 07:33:13', 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, '', '', '', 0),
(2, 'roman.kubatov@gmail.com', 'roman.kubatov@gmail.com', 'roman.kubatov@gmail.com', 'roman.kubatov@gmail.com', 1, 'b8mhmjwqfsowkk8cwgwscoksg48og48', '$2y$13$0dcOcqxfsiX8qPkCu0.FvODxzMu1DteHaaOr3Vh974ms3BjBMoLIS', '2016-05-24 09:12:25', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'qwe', 'qqq www eee', NULL, 1),
(5, 'testuser23@mail.ru', 'testuser23@mail.ru', 'testuser23@mail.ru', 'testuser23@mail.ru', 1, 'k2cnm2mnouo80wwk4wgo4gwcgg48040', '$2y$13$xIPxaguLkoty7HozV7P4quYkfg8OJjeUnz8nriOqXjUKt8AfX7HL.', '2016-08-16 07:24:57', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'company', 'Mavlyanov', '2', 1),
(6, 'testuser@mil.ru', 'testuser@mil.ru', 'testuser@mil.ru', 'testuser@mil.ru', 1, 'kscm3veztnkkg0kc80swk0k4s84wwso', '$2y$13$ZHNgV58NnsFTcbFZHo5QZu.F9WiTZGyxQcTih1O5.aYiwrpqbR4Ai', '2016-06-08 15:00:57', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL, 'company', 'fio', NULL, 1),
(7, 'x_pat@mail.ru', 'x_pat@mail.ru', 'x_pat@mail.ru', 'x_pat@mail.ru', 1, 'e9db8zeb3oggk8k0ok4sgwkc8sk4g0w', '$2y$13$9Yf5JjErkvk4DnVKNMys9uGLVucdDj78efrH5k0w3TTwTQgK4xz56', NULL, 0, 0, NULL, NULL, NULL, 'a:1:{i:0;s:16:"ROLE_SUPER_ADMIN";}', 0, NULL, 'Company2', 'Ivanov', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `CMS_Menu`
--
ALTER TABLE `CMS_Menu`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_2BC6662CE16C6B94` (`alias`),
  ADD KEY `IDX_2BC6662CC4663E4` (`page_id`),
  ADD KEY `IDX_2BC6662C727ACA70` (`parent_id`),
  ADD KEY `IDX_2BC6662CF9262FDF` (`menuType`);

--
-- Indexes for table `CMS_Menu_Type`
--
ALTER TABLE `CMS_Menu_Type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_88E7F54D6BF700BD` (`status_id`);

--
-- Indexes for table `CMS_Pages`
--
ALTER TABLE `CMS_Pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_7BFC8834E16C6B94` (`alias`),
  ADD KEY `IDX_7BFC8834727ACA70` (`parent_id`);

--
-- Indexes for table `CMS_Widget`
--
ALTER TABLE `CMS_Widget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `CMS_widget_menu`
--
ALTER TABLE `CMS_widget_menu`
  ADD PRIMARY KEY (`widget_id`,`menu_id`),
  ADD KEY `IDX_8ECC8B4BFBE885E2` (`widget_id`),
  ADD KEY `IDX_8ECC8B4BCCD7E912` (`menu_id`);

--
-- Indexes for table `email_db`
--
ALTER TABLE `email_db`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `legal_person`
--
ALTER TABLE `legal_person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D8EA0B0DA76ED395` (`user_id`);

--
-- Indexes for table `ordering_products`
--
ALTER TABLE `ordering_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_C1CBF42D4584665A` (`product_id`),
  ADD KEY `IDX_C1CBF42D7ADA1FB5` (`color_id`),
  ADD KEY `IDX_C1CBF42D498DA827` (`size_id`),
  ADD KEY `IDX_C1CBF42DC54C8C93` (`type_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E52FFDEE5F7D6850` (`shipping_method_id`),
  ADD KEY `IDX_E52FFDEE6BF700BD` (`status_id`),
  ADD KEY `IDX_E52FFDEEA76ED395` (`user_id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`order_id`,`product_id`),
  ADD KEY `IDX_749C879C8D9F6D38` (`order_id`),
  ADD KEY `IDX_749C879C4584665A` (`product_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ref_status`
--
ALTER TABLE `ref_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_DDF4E357727ACA70` (`parent_id`);

--
-- Indexes for table `shop_color`
--
ALTER TABLE `shop_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_filters`
--
ALTER TABLE `shop_filters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_product`
--
ALTER TABLE `shop_product`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_D0794487E16C6B94` (`alias`),
  ADD KEY `IDX_D079448712469DE2` (`category_id`),
  ADD KEY `IDX_D0794487E2A5CE63` (`categoryB2B_id`);

--
-- Indexes for table `shop_product_category`
--
ALTER TABLE `shop_product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `IDX_ECA174E74584665A` (`product_id`),
  ADD KEY `IDX_ECA174E712469DE2` (`category_id`);

--
-- Indexes for table `shop_product_color`
--
ALTER TABLE `shop_product_color`
  ADD PRIMARY KEY (`product_id`,`color_id`),
  ADD KEY `IDX_D916A4BA4584665A` (`product_id`),
  ADD KEY `IDX_D916A4BA7ADA1FB5` (`color_id`);

--
-- Indexes for table `shop_product_filter`
--
ALTER TABLE `shop_product_filter`
  ADD PRIMARY KEY (`product_id`,`filter_id`),
  ADD KEY `IDX_8D191FBF4584665A` (`product_id`),
  ADD KEY `IDX_8D191FBFD395B25E` (`filter_id`);

--
-- Indexes for table `shop_product_size`
--
ALTER TABLE `shop_product_size`
  ADD PRIMARY KEY (`product_id`,`size_id`),
  ADD KEY `IDX_674D61594584665A` (`product_id`),
  ADD KEY `IDX_674D6159498DA827` (`size_id`);

--
-- Indexes for table `shop_product_stroe`
--
ALTER TABLE `shop_product_stroe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_AB85E81B498DA827` (`size_id`),
  ADD KEY `IDX_AB85E81B7ADA1FB5` (`color_id`),
  ADD KEY `IDX_AB85E81B4584665A` (`product_id`),
  ADD KEY `IDX_AB85E81BB092A811` (`store_id`);

--
-- Indexes for table `shop_product_user`
--
ALTER TABLE `shop_product_user`
  ADD PRIMARY KEY (`product_id`,`user_id`),
  ADD KEY `IDX_1D1E937A4584665A` (`product_id`),
  ADD KEY `IDX_1D1E937AA76ED395` (`user_id`);

--
-- Indexes for table `shop_setting_country`
--
ALTER TABLE `shop_setting_country`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E2D27DBA727ACA70` (`parent_id`);

--
-- Indexes for table `shop_setting_currency`
--
ALTER TABLE `shop_setting_currency`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_setting_slider_image`
--
ALTER TABLE `shop_setting_slider_image`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_B8F8AB0012469DE2` (`category_id`),
  ADD KEY `IDX_B8F8AB004584665A` (`product_id`);

--
-- Indexes for table `shop_shop_by_look`
--
ALTER TABLE `shop_shop_by_look`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_303AA0712469DE2` (`category_id`);

--
-- Indexes for table `shop_shop_by_look_product`
--
ALTER TABLE `shop_shop_by_look_product`
  ADD PRIMARY KEY (`shop_by_look_id`,`product_id`),
  ADD KEY `IDX_8F286897471CD25B` (`shop_by_look_id`),
  ADD KEY `IDX_8F2868974584665A` (`product_id`);

--
-- Indexes for table `shop_size`
--
ALTER TABLE `shop_size`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_store`
--
ALTER TABLE `shop_store`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_38410225F92F3E70` (`country_id`);

--
-- Indexes for table `subscribe`
--
ALTER TABLE `subscribe`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_1483A5E992FC23A8` (`username_canonical`),
  ADD UNIQUE KEY `UNIQ_1483A5E9A0D96FBF` (`email_canonical`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `CMS_Menu`
--
ALTER TABLE `CMS_Menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `CMS_Menu_Type`
--
ALTER TABLE `CMS_Menu_Type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `CMS_Pages`
--
ALTER TABLE `CMS_Pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `CMS_Widget`
--
ALTER TABLE `CMS_Widget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `email_db`
--
ALTER TABLE `email_db`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `legal_person`
--
ALTER TABLE `legal_person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ordering_products`
--
ALTER TABLE `ordering_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ref_status`
--
ALTER TABLE `ref_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop_category`
--
ALTER TABLE `shop_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `shop_color`
--
ALTER TABLE `shop_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;
--
-- AUTO_INCREMENT for table `shop_filters`
--
ALTER TABLE `shop_filters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `shop_product`
--
ALTER TABLE `shop_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=360;
--
-- AUTO_INCREMENT for table `shop_product_stroe`
--
ALTER TABLE `shop_product_stroe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;
--
-- AUTO_INCREMENT for table `shop_setting_country`
--
ALTER TABLE `shop_setting_country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `shop_setting_currency`
--
ALTER TABLE `shop_setting_currency`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shop_setting_slider_image`
--
ALTER TABLE `shop_setting_slider_image`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `shop_shop_by_look`
--
ALTER TABLE `shop_shop_by_look`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `shop_size`
--
ALTER TABLE `shop_size`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `shop_store`
--
ALTER TABLE `shop_store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subscribe`
--
ALTER TABLE `subscribe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `CMS_Menu`
--
ALTER TABLE `CMS_Menu`
  ADD CONSTRAINT `FK_2BC6662C727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `CMS_Menu` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_2BC6662CC4663E4` FOREIGN KEY (`page_id`) REFERENCES `CMS_Pages` (`id`),
  ADD CONSTRAINT `FK_2BC6662CF9262FDF` FOREIGN KEY (`menuType`) REFERENCES `CMS_Menu_Type` (`id`);

--
-- Constraints for table `CMS_Menu_Type`
--
ALTER TABLE `CMS_Menu_Type`
  ADD CONSTRAINT `FK_88E7F54D6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `ref_status` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `CMS_Pages`
--
ALTER TABLE `CMS_Pages`
  ADD CONSTRAINT `FK_7BFC8834727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `CMS_Pages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `CMS_widget_menu`
--
ALTER TABLE `CMS_widget_menu`
  ADD CONSTRAINT `FK_8ECC8B4BCCD7E912` FOREIGN KEY (`menu_id`) REFERENCES `CMS_Menu` (`id`),
  ADD CONSTRAINT `FK_8ECC8B4BFBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `CMS_Widget` (`id`);

--
-- Constraints for table `legal_person`
--
ALTER TABLE `legal_person`
  ADD CONSTRAINT `FK_D8EA0B0DA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ordering_products`
--
ALTER TABLE `ordering_products`
  ADD CONSTRAINT `FK_C1CBF42D4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C1CBF42D498DA827` FOREIGN KEY (`size_id`) REFERENCES `shop_size` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C1CBF42D7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `shop_color` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_C1CBF42DC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `shop_category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_E52FFDEE5F7D6850` FOREIGN KEY (`shipping_method_id`) REFERENCES `shipping_method` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_E52FFDEE6BF700BD` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD CONSTRAINT `FK_749C879C4584665A` FOREIGN KEY (`product_id`) REFERENCES `ordering_products` (`id`),
  ADD CONSTRAINT `FK_749C879C8D9F6D38` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Constraints for table `shop_category`
--
ALTER TABLE `shop_category`
  ADD CONSTRAINT `FK_DDF4E357727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_product`
--
ALTER TABLE `shop_product`
  ADD CONSTRAINT `FK_D079448712469DE2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`),
  ADD CONSTRAINT `FK_D0794487E2A5CE63` FOREIGN KEY (`categoryB2B_id`) REFERENCES `shop_category` (`id`);

--
-- Constraints for table `shop_product_category`
--
ALTER TABLE `shop_product_category`
  ADD CONSTRAINT `FK_ECA174E712469DE2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`),
  ADD CONSTRAINT `FK_ECA174E74584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`);

--
-- Constraints for table `shop_product_color`
--
ALTER TABLE `shop_product_color`
  ADD CONSTRAINT `FK_D916A4BA4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_D916A4BA7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `shop_color` (`id`);

--
-- Constraints for table `shop_product_filter`
--
ALTER TABLE `shop_product_filter`
  ADD CONSTRAINT `FK_8D191FBF4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_8D191FBFD395B25E` FOREIGN KEY (`filter_id`) REFERENCES `shop_filters` (`id`);

--
-- Constraints for table `shop_product_size`
--
ALTER TABLE `shop_product_size`
  ADD CONSTRAINT `FK_674D61594584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_674D6159498DA827` FOREIGN KEY (`size_id`) REFERENCES `shop_size` (`id`);

--
-- Constraints for table `shop_product_stroe`
--
ALTER TABLE `shop_product_stroe`
  ADD CONSTRAINT `FK_AB85E81B4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_AB85E81B498DA827` FOREIGN KEY (`size_id`) REFERENCES `shop_size` (`id`),
  ADD CONSTRAINT `FK_AB85E81B7ADA1FB5` FOREIGN KEY (`color_id`) REFERENCES `shop_color` (`id`),
  ADD CONSTRAINT `FK_AB85E81BB092A811` FOREIGN KEY (`store_id`) REFERENCES `shop_store` (`id`);

--
-- Constraints for table `shop_product_user`
--
ALTER TABLE `shop_product_user`
  ADD CONSTRAINT `FK_1D1E937A4584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_1D1E937AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `shop_setting_country`
--
ALTER TABLE `shop_setting_country`
  ADD CONSTRAINT `FK_E2D27DBA727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `shop_setting_country` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_setting_slider_image`
--
ALTER TABLE `shop_setting_slider_image`
  ADD CONSTRAINT `FK_B8F8AB0012469DE2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_B8F8AB004584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_shop_by_look`
--
ALTER TABLE `shop_shop_by_look`
  ADD CONSTRAINT `FK_303AA0712469DE2` FOREIGN KEY (`category_id`) REFERENCES `shop_category` (`id`);

--
-- Constraints for table `shop_shop_by_look_product`
--
ALTER TABLE `shop_shop_by_look_product`
  ADD CONSTRAINT `FK_8F2868974584665A` FOREIGN KEY (`product_id`) REFERENCES `shop_product` (`id`),
  ADD CONSTRAINT `FK_8F286897471CD25B` FOREIGN KEY (`shop_by_look_id`) REFERENCES `shop_shop_by_look` (`id`);

--
-- Constraints for table `shop_store`
--
ALTER TABLE `shop_store`
  ADD CONSTRAINT `FK_38410225F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `shop_setting_country` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
