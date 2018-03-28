-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Лип 26 2016 р., 18:49
-- Версія сервера: 5.6.17
-- Версія PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База даних: `tesla`
--

-- --------------------------------------------------------

--
-- Структура таблиці `a_test`
--

CREATE TABLE IF NOT EXISTS `a_test` (
  `name` varchar(255) DEFAULT NULL,
  `test2` varchar(255) DEFAULT NULL,
  `dateCreate` datetime DEFAULT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_action_js_ref`
--

CREATE TABLE IF NOT EXISTS `osc_admin_action_js_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action_id` int(11) DEFAULT NULL,
  `js_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_applications`
--

CREATE TABLE IF NOT EXISTS `osc_admin_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8 NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Дамп даних таблиці `osc_admin_applications`
--

INSERT INTO `osc_admin_applications` (`id`, `alias`, `name`, `details`, `dateCreate`, `dateModify`, `block`) VALUES
(1, '0', 'Админ Меню', 'Главное меню админ панели', '2013-11-15 07:04:32', '2013-12-26 19:01:26', 0),
(5, '0', 'Меню в шапке', 'Меню в шапке при перезагрузке страницы', '2013-11-25 14:29:41', '2013-11-25 14:29:41', 0),
(6, '0', 'Задания', 'Пользователь -> задания', '2013-11-25 14:30:55', '2013-12-27 16:20:03', 0),
(7, '0', 'Сообщения', 'Пользователь -> сообщения', '2013-11-25 14:31:21', '2013-12-27 16:20:10', 0),
(8, '0', 'Профиль', 'Пользователь -> профиль', '2013-11-25 14:31:46', '2013-12-27 16:20:16', 0),
(9, '0', 'Все пользователи', 'Пользователи -> все пользователи', '2013-11-25 16:20:10', '2013-12-27 16:20:23', 0),
(10, '0', 'Группы пользователей', 'Пользователи -> группы пользователей', '2013-11-25 16:20:38', '2013-12-27 16:20:29', 0),
(11, '0', 'Добавить новую группу', 'Пользователи -> добавить новую группу', '2013-11-25 16:21:02', '2013-12-27 16:20:37', 0),
(12, '0', 'Рассылка пользователям', 'Пользователи -> рассылка пользователям', '2013-11-25 16:21:33', '2013-12-27 16:20:50', 0),
(13, '0', 'Менеджер материалов', 'Материалы -> менеджер материалов', '2013-11-25 16:27:09', '2013-12-27 16:20:56', 0),
(14, '0', 'Категории материалов', 'Материалы -> Категории материалов', '2013-11-25 16:27:31', '2013-12-27 16:21:02', 0),
(15, '0', 'Баннерная система', 'Материалы -> баннерная система', '2013-11-25 16:28:17', '2013-12-27 16:21:09', 0),
(16, '0', 'Контент блоки', 'Материалы -> контент блоки', '2013-11-25 16:28:49', '2013-12-27 16:21:20', 0),
(17, '0', 'Вопрос-ответ', 'Материалы -> вопрос-ответ', '2013-11-25 16:29:06', '2013-12-27 16:21:27', 0),
(18, '0', 'Менеджер меню', 'Материалы -> менеджер меню', '2013-11-25 16:29:21', '2013-12-27 16:21:34', 0),
(19, '0', 'Категории товаров', 'Магазин -> категории товаров', '2013-11-25 16:32:34', '2013-12-27 16:22:43', 0),
(20, '0', 'Управление товарами', 'Магазин -> управление товарами', '2013-11-25 16:32:53', '2013-12-27 16:22:51', 0),
(21, '0', 'Характеристики товаров', 'Магазин -> характеристики товаров', '2013-11-25 16:33:19', '2013-12-27 16:23:08', 0),
(22, '0', 'Заказы', 'Магазин -> заказы', '2013-11-25 16:33:32', '2013-12-27 16:29:28', 0),
(23, '0', 'Управление приложениями', 'Настройки -> управление приложениями', '2013-11-25 16:47:52', '2013-12-27 16:23:40', 0),
(24, '0', 'Группы приложений', 'Настройки -> группы приложений', '2013-11-25 16:48:13', '2013-12-27 16:23:47', 0),
(25, '0', 'Глобальные настройки', 'Настройки -> глобальные настройки', '2013-11-25 16:48:36', '2013-12-27 16:24:01', 0),
(26, '0', 'SHOP настройки', 'Настройки -> seo-настройки', '2013-11-25 16:49:17', '2013-12-27 16:24:25', 0),
(27, '0', 'Задать вопрос', 'Помощь -> задать вопрос', '2013-11-25 16:54:19', '2013-12-27 16:24:40', 0),
(28, '0', 'Частые вопросы', 'Помощь -> частые вопросы', '2013-11-25 16:54:32', '2013-12-27 16:24:47', 0),
(29, '0', 'Группы товаров', 'Интернет магазин - группы товаров', '2013-12-13 17:32:09', '2013-12-27 16:24:57', 0),
(30, '0', 'Категории свойств товара', 'ИМ - категории свойств товара', '2013-12-13 17:32:59', '2013-12-27 16:25:04', 0),
(31, '0', 'Склады', 'ИМ - склады', '2013-12-13 17:33:31', '2013-12-27 16:25:10', 0),
(32, '0', 'Складские ячейки', 'ИМ - Складские ячейки', '2013-12-13 17:33:57', '2013-12-27 16:25:18', 0),
(33, '0', 'Прием товаров', 'ИМ - прием товаров', '2013-12-13 17:34:49', '2013-12-27 16:25:29', 0),
(34, '0', 'Поставщики', 'Поставщики продукции', '2014-01-13 17:35:56', '2014-01-13 17:35:56', 0),
(35, '0', 'Входящие заказы', 'Заказы с ИМ', '2014-12-21 16:15:04', '2014-12-21 16:15:04', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_applications_groups`
--

CREATE TABLE IF NOT EXISTS `osc_admin_applications_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_app_hs_item_ref`
--

CREATE TABLE IF NOT EXISTS `osc_admin_app_hs_item_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) NOT NULL DEFAULT '0',
  `section_id` int(11) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `nonactive_title` varchar(255) NOT NULL DEFAULT '0',
  `active_title` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_head_sections`
--

CREATE TABLE IF NOT EXISTS `osc_admin_head_sections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(63) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `osc_admin_head_sections`
--

INSERT INTO `osc_admin_head_sections` (`id`, `type`, `name`, `details`) VALUES
(1, 'filter', 'Список с фильтром', 'В левой локации размещается фильтр, в правой иконки: дублировать, заблокировать, разблокировать, удалить, создать'),
(2, 'create', 'Создание элемента списка', 'В левой локации иконка возврат, в правой - варианты сохранения'),
(3, 'card', 'Карточка редактирования', 'В левой локации возврат, в правой - варианты сохранения');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_head_section_items`
--

CREATE TABLE IF NOT EXISTS `osc_admin_head_section_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(1) NOT NULL DEFAULT '0',
  `section_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_js_functions`
--

CREATE TABLE IF NOT EXISTS `osc_admin_js_functions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп даних таблиці `osc_admin_js_functions`
--

INSERT INTO `osc_admin_js_functions` (`id`, `name`, `data`, `details`) VALUES
(1, 'change_head', 'function change_head(id){\n		$(''.head-app'').hide();\n		$(''#head-app-''+id).show();\n	}', 'Скрывает все секции событий, после открывает указанную по ID'),
(2, 'open_modal', 'function open_modal(ajaxFile,data)\n{\n	$(''#modal-window'').html(''Loading...'');\n	$(''#modal-window'').load(ajaxFile,data,function(){\n			$(''#modal-window'').show(200);\n		});\n}', 'Открывает в модальном окне файл ajaxPath и передает ему параметры в data'),
(3, 'close_modal', 'function close_modal()\n{\n	$(''#modal-window'').html('''');\n	$(''#modal-window'').hide(200);\n}', 'Закрывает модальное окно'),
(4, 'load_create', 'function load_create(ajaxFile)\n{\n	$(''#inajax-1'').html(''<center>Loading...</center>'');\n	$(''#inajax-1'').load(ajaxFile);\n}', 'Загружает указанный ajax файл, предназначенный для создания элемента списка.'),
(5, 'load_card', 'function load_card(ajaxFile,id)\n{\n	$(''#inajax-1'').html(''<center>Loading...</center>'');\n	var data = {id:id}\n	$(''#inajax-1'').load(ajaxFile,data);\n}', 'Загружает указанный ajax файл, предназначенный для редактирования карточки элемента списка.'),
(6, 'load_app_content', 'function load_app_content(ajaxFile,app_id)\n{\n	global_ajaxFile = ajaxFile;\n	global_app_id = app_id;\n	\n	$(''#inajax-1'').html(''<center>Loading...</center>'');\n\n	var data = {\n				filtr_table:global_table_filtr,\n				tables:global_tables,\n				fields:global_fields,\n						\n				ajaxpath:ajaxFile,\n				start_page:global_start_page,\n				on_page:10,\n				app_id:app_id,\n				''f_fields[]'':global_f_fields,\n				''f_values[]'':global_f_values,\n				first_load:false\n				}\n	$(''#inajax-1'').load(ajaxFile,data);\n}', 'Загрузка указанного ajax файла, предназначенного для вывода списка элементов раздела по определенному APP ID'),
(7, 'filtr_content', 'function filtr_content(name,value)\n{\n	if(!filtr_sem)\n	{\n		global_start_page = 1;\n	}else\n	{\n		filtr_sem = false;\n	}\n	//alert(name+'' = ''+value);\n	\n	var f_fields = [];\n	var f_values = [];\n	\n	$(''#filtr-wrap form input'').each(function(){\n			//alert($(this).attr(''name'')+" = "+$(this).val());\n			\n			f_fields.push($(this).attr(''name''));\n			f_values.push($(this).val());\n		});\n	$(''#filtr-wrap form select'').each(function(){\n			//alert($(this).attr(''name'')+" = "+$(this).val());\n			\n			f_fields.push($(this).attr(''name''));\n			f_values.push($(this).val());\n		});\n		\n	var cur_pos = f_fields.indexOf(name);\n	\n	f_values[cur_pos] = value;\n		\n	global_f_fields = f_fields;\n	global_f_values = f_values;\n\n	load_app_content(global_ajaxFile,global_app_id);\n}', 'Активирует фильтрацию списка элементов в разделе');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_menu`
--

CREATE TABLE IF NOT EXISTS `osc_admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(6) NOT NULL DEFAULT '0',
  `parent` int(6) NOT NULL DEFAULT '0',
  `assign` int(5) NOT NULL DEFAULT '0',
  `name` varchar(127) NOT NULL DEFAULT '0',
  `alias` varchar(127) NOT NULL DEFAULT '0',
  `filename` varchar(127) NOT NULL DEFAULT '0',
  `order_id` int(5) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '#',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Дамп даних таблиці `osc_admin_menu`
--

INSERT INTO `osc_admin_menu` (`id`, `type`, `parent`, `assign`, `name`, `alias`, `filename`, `order_id`, `details`, `block`, `link`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 1, 0, 0, 'Учетная запись', 'personal', 'user-icon-slider.png', 1, 'Учетная запись пользователя', 0, '#', '2013-11-15 02:52:32', '2013-11-15 05:40:23', 1),
(2, 1, 0, 0, 'Пользователи', 'users', 'all-users-icon-slider.png', 5, 'Управление пользователями системы', 0, '#1', '2013-11-15 02:55:52', '2016-03-22 20:17:24', 1),
(3, 1, 0, 0, 'Управление меню', 'articles', 'materials-icon-slider.png', 2, 'Управления материалами сайта', 0, '#', '2013-11-15 02:57:55', '2016-03-22 20:16:14', 1),
(4, 1, 0, 0, 'Управление ботами', 'bots', 'shop-icon-slider.png', 3, 'CS Bots', 0, '#', '2013-11-15 02:59:06', '2016-03-22 20:17:14', 1),
(5, 1, 0, 0, 'Настройки', 'settings', 'settings-icon-slider.png', 6, 'Настройки системы', 0, '#', '2013-11-15 03:00:21', '2016-03-22 20:17:32', 1),
(6, 1, 0, 0, 'Помощь', 'help', 'help-icon-slider.png', 7, 'Помощь администратору', 1, '#', '2013-11-15 03:01:26', '2016-03-22 20:17:37', 1),
(7, 1, 1, 0, 'Профиль', 'profile', '0', 3, 'Личный кабинет администратора', 0, '#', '2013-11-15 03:03:08', '2013-11-15 15:55:43', 1),
(8, 1, 2, 0, 'Все пользователи', 'users-list', '0', 1, 'Список пользователей системой', 0, '#', '2013-11-15 03:04:34', '2013-11-15 16:06:43', 1),
(10, 1, 2, 0, 'Группы пользователей', 'users-levels', '0', 3, 'Уровни или типы пользователей системы', 0, '#', '2013-11-15 03:07:17', '2013-11-15 16:07:21', 1),
(11, 1, 2, 0, 'Добавить новую группу', 'add-user-level', '0', 4, 'Создание нового уровня для пользователей', 1, '#', '2013-11-15 03:09:35', '2013-11-15 16:07:46', 1),
(12, 1, 3, 0, 'Менеджер материалов', 'articles-manager', '0', 2, 'Управление материалами сайта', 0, '#', '2013-11-15 03:10:50', '2015-08-12 15:38:48', 1),
(13, 1, 3, 0, 'Категории материалов', 'articles-categories', '0', 1, 'Управление категориями материалов', 0, '#', '2013-11-15 03:11:43', '2015-08-12 15:38:52', 1),
(14, 1, 3, 0, 'Баннерная система', 'banners-system', '0', 3, 'Управление баннерной системой на сайте', 0, '#', '2013-11-15 03:12:29', '2013-11-15 03:12:29', 1),
(15, 1, 3, 0, 'Контент блоки', 'content-blocks', '0', 4, 'Управление контент блоками на сайте', 1, '#', '2013-11-15 03:13:24', '2016-07-26 11:12:19', 1),
(16, 1, 3, 0, 'Вопрос-ответ', 'faq', '0', 5, 'Управление FAQ', 0, '#', '2013-11-15 03:14:49', '2013-11-15 03:14:49', 1),
(22, 1, 5, 0, 'Управление приложениями', 'apps-manage', '0', 1, 'Управление приложениями сайта', 1, '#', '2013-11-15 03:26:02', '2014-09-09 12:14:50', 1),
(23, 1, 5, 0, 'Группы приложений', 'appsGroups-manage', '0', 2, 'Управление группами приложений', 1, '#', '2013-11-15 03:29:21', '2013-12-20 02:12:41', 1),
(24, 1, 5, 0, 'Общие', 'global-settings', '0', 3, 'Глобальные настройки системы', 0, '#', '2013-11-15 03:30:00', '2013-12-20 02:12:55', 1),
(25, 1, 5, 0, 'Настройки магазина', 'shop-manage', '0', 4, 'Управление SEO параметрами', 0, '#', '2013-11-15 03:30:39', '2013-12-20 02:13:17', 1),
(26, 1, 6, 0, 'Задать вопрос', 'help-question', '0', 1, 'Задать вопрос супер администратору', 0, '#', '2013-11-15 03:31:18', '2013-11-15 03:31:18', 1),
(28, 1, 1, 0, 'Задания', 'profile-zadaniya', '0', 1, 'Входящие заказы с ИМ', 0, '#', '2013-11-15 15:56:25', '2014-12-21 16:13:07', 1),
(29, 1, 1, 0, 'Сообщения', 'profile-message', '0', 2, 'Личные сообщения пользователю от других админов', 0, '#', '2013-11-15 15:59:29', '2013-11-15 15:59:29', 1),
(30, 1, 3, 0, 'Менеджер меню', 'menu-manager', '0', 0, 'Менеджер меню', 0, '#', '2013-11-15 16:01:48', '2015-08-12 15:38:40', 1),
(31, 1, 2, 0, 'Рассылка пользователям', 'users-sender', '0', 5, 'Почтовая рассылка пользователям', 1, '#', '2013-11-15 16:09:10', '2014-10-18 19:12:42', 1),
(38, 1, 1, 0, 'Входящие заказы', 'profile-in-orders', '0', 0, 'Новые заказы с ИМ', 0, '#', '2014-12-21 16:14:09', '2016-03-05 22:27:16', 1),
(40, 1, 3, 0, 'Галлереи', 'galleries', '0', 8, 'Медиа галлереи', 0, '#', '2015-08-12 15:37:47', '2015-08-12 15:37:47', 1),
(43, 1, 3, 0, 'Отзывы', 'art-comments', '0', 15, 'Отзывы к статьям', 0, '#', '2015-09-18 10:11:28', '2015-09-18 10:11:33', 1),
(45, 1, 1, 0, 'Быстрые заказы ', 'profile-in-quick-orders', '0', 0, 'Меню быстрых заказов', 0, '#', '2016-03-05 22:17:01', '2016-03-05 22:27:45', 1),
(48, 1, 5, 0, 'Мои счета', 'my-accounts', '0', 4, 'Список банковских реквизитов', 0, '#', '2016-03-09 14:06:16', '2016-03-09 14:06:23', 1),
(49, 1, 5, 0, 'Курс валют', 'course_of_ex', '0', 4, '', 0, '#', '2016-03-10 15:44:46', '2016-03-10 15:44:46', 1),
(50, 1, 5, 0, 'Способы доставки', 'delivery-methods', '0', 4, 'Способы доставки товара', 0, '#', '2016-03-10 16:01:45', '2016-03-10 16:03:14', 1),
(51, 1, 4, 0, 'Мои боты', 'my-bots', '0', 1, 'my bots', 0, '#', '2016-03-22 20:13:54', '2016-03-22 20:13:54', 1),
(52, 1, 4, 0, 'Инвентарь', 'inventory', '0', 2, 'inventory', 0, '#', '2016-03-22 20:14:17', '2016-03-22 20:14:17', 1),
(53, 1, 0, 0, 'Управление играми', 'games', '0', 4, 'Games manager', 0, '#', '2016-03-22 20:18:14', '2016-03-22 20:18:14', 1),
(54, 1, 53, 0, 'Рулетка (стандарт)', 'roulette', '0', 1, 'Рулетка (стандарт) на вещи + лимиты', 0, '#', '2016-03-22 20:21:24', '2016-03-22 20:21:24', 1),
(55, 1, 53, 0, 'Розыгрыш ключей', 'keys-lottary', '0', 2, 'Розыгрыш ключей между участниками', 0, '#', '2016-03-22 20:23:25', '2016-03-22 20:23:25', 1),
(56, 1, 53, 0, 'Розыгрыш вещей', 'stuff-lottery', '0', 3, 'материал, вещи, вещество, хлам, дрянь, материя', 0, '#', '2016-03-22 20:26:27', '2016-03-22 20:26:27', 1),
(57, 1, 53, 0, 'Коинфлип', 'coin-flip', '0', 4, 'Коинфлип или 1х1', 0, '#', '2016-03-22 20:30:28', '2016-03-22 20:30:28', 1),
(58, 1, 53, 0, 'Дуель', 'duel', '0', 5, 'Дуель, как в БК.ру', 0, '#', '2016-03-22 20:33:57', '2016-03-22 20:33:57', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_menu_app_ref`
--

CREATE TABLE IF NOT EXISTS `osc_admin_menu_app_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `app_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Дамп даних таблиці `osc_admin_menu_app_ref`
--

INSERT INTO `osc_admin_menu_app_ref` (`id`, `menu_id`, `app_id`) VALUES
(19, 36, 33),
(21, 28, 6),
(22, 29, 7),
(23, 7, 8),
(24, 8, 9),
(25, 10, 10),
(26, 11, 11),
(27, 31, 12),
(28, 12, 13),
(29, 13, 14),
(30, 14, 15),
(31, 15, 16),
(32, 16, 17),
(33, 30, 18),
(34, 17, 19),
(35, 17, 19),
(36, 18, 20),
(37, 19, 21),
(38, 22, 23),
(39, 23, 24),
(40, 24, 25),
(41, 25, 26),
(42, 25, 26),
(43, 26, 27),
(44, 27, 28),
(45, 32, 29),
(46, 34, 30),
(47, 33, 31),
(48, 35, 32),
(49, 36, 33),
(50, 20, 22),
(51, 37, 34),
(52, 38, 35);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_admin_tmp`
--

CREATE TABLE IF NOT EXISTS `osc_admin_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `tmp` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=252 ;

--
-- Дамп даних таблиці `osc_admin_tmp`
--

INSERT INTO `osc_admin_tmp` (`id`, `admin_id`, `tmp`) VALUES
(1, 0, 'Пожалуйста, заполните поле Имя.'),
(45, 0, '1'),
(77, 0, '1'),
(78, 0, '1'),
(79, 0, '1'),
(93, 0, 'Пожалуйста, заполните поле Название.'),
(251, 0, '');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_all_games`
--

CREATE TABLE IF NOT EXISTS `osc_all_games` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_type_id` int(11) NOT NULL,
  `players` text NOT NULL,
  `items` text NOT NULL,
  `winner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_applications`
--

CREATE TABLE IF NOT EXISTS `osc_applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0',
  `details` text CHARACTER SET utf8 NOT NULL,
  `fields` text CHARACTER SET utf8 NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Дамп даних таблиці `osc_applications`
--

INSERT INTO `osc_applications` (`id`, `alias`, `name`, `details`, `fields`, `dateCreate`, `dateModify`, `block`) VALUES
(1, 'top-menu.php', 'Меню в шапке', 'Меню в шапке сайта', '', '2014-02-13 15:59:08', '2014-02-13 18:55:03', 0),
(2, 'top-socs.php', 'Социальные сети в шапке', 'Социальные сети в шапке на сайте', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_applications_groups`
--

CREATE TABLE IF NOT EXISTS `osc_applications_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `apps` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_applications_groups`
--

INSERT INTO `osc_applications_groups` (`id`, `alias`, `name`, `details`, `dateCreate`, `dateModify`, `block`, `apps`) VALUES
(1, 'top-header', 'Шапка сайта', 'Составляющее: \nМеню, соц. сети, корзина', '2014-02-11 19:34:35', '2014-02-11 19:34:35', 0, '');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_app_access`
--

CREATE TABLE IF NOT EXISTS `osc_app_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(7) NOT NULL DEFAULT '0',
  `apps_list` text NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица прав доступа на приложения в системе' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_articles`
--

CREATE TABLE IF NOT EXISTS `osc_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_id` int(11) NOT NULL DEFAULT '0',
  `is_video` int(1) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `preview` tinytext NOT NULL,
  `content` text NOT NULL,
  `filename` varchar(127) NOT NULL DEFAULT '0',
  `order_id` int(7) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  `target` int(1) NOT NULL DEFAULT '0',
  `gallery_id` int(7) NOT NULL DEFAULT '0',
  `script_name` varchar(63) CHARACTER SET utf16 NOT NULL DEFAULT '',
  `text_pos` int(7) NOT NULL DEFAULT '1',
  `gallery_pos` int(7) NOT NULL DEFAULT '2',
  `script_pos` int(7) NOT NULL DEFAULT '3',
  `meta_title` varchar(255) DEFAULT '',
  `meta_keys` varchar(255) DEFAULT '',
  `meta_desc` varchar(255) DEFAULT '',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  `pos_id` int(7) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список статей и материалов для сайта' AUTO_INCREMENT=6 ;

--
-- Дамп даних таблиці `osc_articles`
--

INSERT INTO `osc_articles` (`id`, `cat_id`, `is_video`, `name`, `alias`, `preview`, `content`, `filename`, `order_id`, `block`, `target`, `gallery_id`, `script_name`, `text_pos`, `gallery_pos`, `script_pos`, `meta_title`, `meta_keys`, `meta_desc`, `dateCreate`, `dateModify`, `adminMod`, `pos_id`) VALUES
(1, 1, 0, 'Рулетка', 'ruletka', '', '', '0', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '2016-03-18 15:43:51', '2016-07-26 11:15:33', 0, 0),
(2, 1, 0, 'Розыгрыш ключей', 'rozugrush-klyuchey', '', '', '0', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '2016-03-18 15:44:14', '2016-03-18 15:44:14', 0, 0),
(3, 1, 0, 'Розыгрыш вещей между участниками', 'rozugrush-vesh-ey-mezhdu-uchastnikami', '', '', '0', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '2016-03-18 15:44:30', '2016-03-18 15:44:30', 0, 0),
(4, 1, 0, 'Коинфлип или 1х1', 'koinflip-ili-1h1', '', '', '0', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '2016-03-18 15:44:48', '2016-03-18 15:44:48', 0, 0),
(5, 1, 0, 'Дуель', 'duel', '', '', '0', 0, 0, 0, 0, '', 0, 0, 0, '', '', '', '2016-03-18 15:45:02', '2016-03-18 15:45:02', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_article_comments`
--

CREATE TABLE IF NOT EXISTS `osc_article_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `rating` int(5) NOT NULL DEFAULT '5',
  `block` int(1) NOT NULL DEFAULT '1',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `fname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_art_cat_ref`
--

CREATE TABLE IF NOT EXISTS `osc_art_cat_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `art_id` int(7) NOT NULL DEFAULT '0',
  `cat_id` int(7) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица связей материалов с категориями' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_art_menu_ref`
--

CREATE TABLE IF NOT EXISTS `osc_art_menu_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(7) NOT NULL DEFAULT '0',
  `art_id` int(7) NOT NULL DEFAULT '0',
  `cat_id` int(7) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица связей пунктов меню с материалами или с категориями материалов' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_banners`
--

CREATE TABLE IF NOT EXISTS `osc_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `pos_id` int(7) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '#',
  `target` int(1) NOT NULL DEFAULT '1',
  `startPublish` datetime NOT NULL,
  `finishPublish` datetime NOT NULL,
  `meta_keys` varchar(255) NOT NULL DEFAULT 'zen',
  `index` int(1) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_categories`
--

CREATE TABLE IF NOT EXISTS `osc_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent` int(5) NOT NULL DEFAULT '0',
  `name` varchar(127) NOT NULL DEFAULT '0',
  `alias` varchar(127) NOT NULL DEFAULT '0',
  `details` tinytext NOT NULL,
  `filename` varchar(127) NOT NULL DEFAULT '0',
  `order_id` int(7) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список категорий для группирования материалов' AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_categories`
--

INSERT INTO `osc_categories` (`id`, `parent`, `name`, `alias`, `details`, `filename`, `order_id`, `block`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 0, 'Играть', 'igrat', '', '0', 0, 0, '2016-03-18 15:42:58', '2016-03-18 15:42:58', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_contact_form`
--

CREATE TABLE IF NOT EXISTS `osc_contact_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_contact_form`
--

INSERT INTO `osc_contact_form` (`id`, `name`, `email`, `message`, `date_created`) VALUES
(1, 'Сергей', 's.kononuchenko@yandex.ru', '1234567891', '2016-07-26 15:59:59');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_content_blocks`
--

CREATE TABLE IF NOT EXISTS `osc_content_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `pos_id` int(7) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '#',
  `target` int(1) NOT NULL DEFAULT '1',
  `startPublish` datetime NOT NULL,
  `finishPublish` datetime NOT NULL,
  `meta_keys` varchar(255) NOT NULL DEFAULT 'zen',
  `index` int(1) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_copy_history`
--

CREATE TABLE IF NOT EXISTS `osc_copy_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(255) NOT NULL DEFAULT '0',
  `row_id` int(11) NOT NULL DEFAULT '0',
  `copy_quant` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `osc_copy_history`
--

INSERT INTO `osc_copy_history` (`id`, `table`, `row_id`, `copy_quant`) VALUES
(1, 'osc_articles', 1, 0),
(2, 'osc_articles', 2, 0),
(3, 'osc_articles', 3, 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_db_structure`
--

CREATE TABLE IF NOT EXISTS `osc_db_structure` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table` varchar(63) NOT NULL,
  `type` varchar(63) NOT NULL,
  `structure` text NOT NULL,
  `ref_table` varchar(63) NOT NULL,
  `ref_tables` varchar(127) NOT NULL,
  `date_create` datetime NOT NULL,
  `date_modify` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Отображает структуры всей БД. Type: object, extention, reference' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_dialog_files_ref`
--

CREATE TABLE IF NOT EXISTS `osc_dialog_files_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(63) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '0',
  `crop` varchar(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT 'Фото',
  `is_link` int(1) NOT NULL DEFAULT '0',
  `href` varchar(255) DEFAULT NULL,
  `target` int(1) NOT NULL DEFAULT '1',
  `path` varchar(255) NOT NULL DEFAULT '/',
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_docs_ref`
--

CREATE TABLE IF NOT EXISTS `osc_docs_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(63) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '0',
  `crop` varchar(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT 'Фото',
  `is_link` int(1) NOT NULL DEFAULT '0',
  `href` varchar(255) DEFAULT NULL,
  `target` int(1) NOT NULL DEFAULT '1',
  `path` varchar(255) NOT NULL DEFAULT '/',
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_faq`
--

CREATE TABLE IF NOT EXISTS `osc_faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `answer` text NOT NULL,
  `block` int(11) NOT NULL DEFAULT '0',
  `order_id` int(7) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_faq`
--

INSERT INTO `osc_faq` (`id`, `question`, `answer`, `block`, `order_id`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, '', '', 0, 0, '2016-07-26 11:15:47', '2016-07-26 11:15:47', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_files_ref`
--

CREATE TABLE IF NOT EXISTS `osc_files_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_table` varchar(63) NOT NULL DEFAULT '0',
  `ref_id` int(11) NOT NULL DEFAULT '0',
  `file` varchar(255) NOT NULL DEFAULT '0',
  `crop` varchar(255) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT 'Фото',
  `is_link` int(1) NOT NULL DEFAULT '0',
  `href` varchar(255) DEFAULT NULL,
  `target` int(1) NOT NULL DEFAULT '1',
  `path` varchar(255) NOT NULL DEFAULT '/',
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_language`
--

CREATE TABLE IF NOT EXISTS `osc_language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(63) NOT NULL,
  `alias` varchar(63) NOT NULL,
  `ru` text NOT NULL,
  `en` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_menu`
--

CREATE TABLE IF NOT EXISTS `osc_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(6) NOT NULL DEFAULT '0',
  `pos_id` int(1) NOT NULL DEFAULT '0',
  `parent` int(6) NOT NULL DEFAULT '0',
  `assign` int(5) NOT NULL DEFAULT '0',
  `name` varchar(127) NOT NULL DEFAULT '0',
  `alias` varchar(127) NOT NULL DEFAULT '0',
  `filename` varchar(127) NOT NULL DEFAULT '0',
  `order_id` int(5) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `top_view` int(1) NOT NULL DEFAULT '0',
  `link` varchar(255) NOT NULL DEFAULT '#',
  `target` int(1) NOT NULL DEFAULT '0',
  `relation` varchar(255) NOT NULL DEFAULT '0',
  `gallery_id` int(11) NOT NULL DEFAULT '0',
  `script_name` varchar(63) NOT NULL DEFAULT '',
  `text_pos` int(1) NOT NULL DEFAULT '1',
  `gallery_pos` int(1) NOT NULL DEFAULT '2',
  `script_pos` int(1) NOT NULL DEFAULT '3',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Дамп даних таблиці `osc_menu`
--

INSERT INTO `osc_menu` (`id`, `type`, `pos_id`, `parent`, `assign`, `name`, `alias`, `filename`, `order_id`, `details`, `block`, `top_view`, `link`, `target`, `relation`, `gallery_id`, `script_name`, `text_pos`, `gallery_pos`, `script_pos`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 0, 1, 0, 0, 'Электромобили', 'electrocars', '0', 0, '', 0, 0, 'electrocars', 0, '0', 0, '', 1, 2, 3, '2016-07-26 00:00:00', '2016-07-26 00:00:00', 0),
(2, 0, 1, 0, 0, 'Тест-Драйв', 'test-drive', '0', 0, '', 0, 0, 'test-drive', 0, '0', 0, '', 1, 2, 3, '2016-07-26 00:00:00', '2016-07-26 00:00:00', 0),
(3, 0, 1, 0, 0, 'Электрозаправки', 'charge', '0', 0, '', 0, 0, 'charge', 0, '0', 0, '', 1, 2, 3, '2016-07-26 00:00:00', '2016-07-26 00:00:00', 0),
(4, 0, 1, 0, 0, 'Каталог', 'catalog', '0', 0, '', 0, 0, 'catalog', 0, '0', 0, '', 1, 2, 3, '2016-07-26 00:00:00', '2016-07-26 00:00:00', 0),
(5, 0, 1, 0, 0, 'Контакты', 'contacts', '0', 0, '', 0, 0, 'contacts', 0, '0', 0, '', 1, 2, 3, '2016-07-26 00:00:00', '2016-07-26 00:00:00', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_menu_formats`
--

CREATE TABLE IF NOT EXISTS `osc_menu_formats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL DEFAULT 'NoName',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `osc_menu_formats`
--

INSERT INTO `osc_menu_formats` (`id`, `name`) VALUES
(1, 'Одиночный'),
(2, 'Привязан к категории материалов'),
(3, 'Привязан к нескольким категориям материалов'),
(4, 'Привязан к каталогу магазина');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_menu_types`
--

CREATE TABLE IF NOT EXISTS `osc_menu_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Список типов меню для сайта' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_message_statuses`
--

CREATE TABLE IF NOT EXISTS `osc_message_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL DEFAULT '0',
  `alias` varchar(63) NOT NULL DEFAULT '0',
  `details` tinytext NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список типов сообщений' AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `osc_message_statuses`
--

INSERT INTO `osc_message_statuses` (`id`, `name`, `alias`, `details`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 'Не прочитано', 'new', 'Не прочитанные сообщения', '2013-11-15 00:00:00', '2013-11-15 00:00:00', 1),
(2, 'Прочитано', 'readble', 'Прочитанные сообщения', '2013-11-15 00:00:00', '2013-11-15 00:00:00', 1),
(3, 'Выполнено', 'done', 'Выполненное задание', '2013-11-15 11:24:01', '2013-11-15 11:24:01', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_message_types`
--

CREATE TABLE IF NOT EXISTS `osc_message_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(63) NOT NULL DEFAULT '0',
  `alias` varchar(63) NOT NULL DEFAULT '0',
  `details` tinytext NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Список типов сообщений' AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `osc_message_types`
--

INSERT INTO `osc_message_types` (`id`, `name`, `alias`, `details`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 'Сообщение', 'message', 'Обычное сообщение пользователю', '2013-11-15 11:04:04', '2013-11-15 11:04:04', 1),
(2, 'Задание', 'task', 'Задание с необходимостью выполнить и поставить статус выполнено', '2013-11-15 11:04:51', '2013-11-15 11:04:51', 1),
(3, 'Тикет', 'ticket', 'Используются к примеру для кладовщика от управляющих, информация по отгрузке товаров', '2013-11-15 11:06:02', '2013-11-15 11:06:02', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_my_accounts`
--

CREATE TABLE IF NOT EXISTS `osc_my_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acc_number` varchar(63) NOT NULL COMMENT 'Номер счета',
  `props` varchar(255) NOT NULL COMMENT 'Реквизит',
  `name` varchar(63) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Таблица счетов для оплаты' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_shop_settings`
--

CREATE TABLE IF NOT EXISTS `osc_shop_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uah_ex` double NOT NULL,
  `usd_ex` double NOT NULL,
  `eur_ex` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_shop_settings`
--

INSERT INTO `osc_shop_settings` (`id`, `uah_ex`, `usd_ex`, `eur_ex`) VALUES
(1, 1, 25, 27);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_site_positions`
--

CREATE TABLE IF NOT EXISTS `osc_site_positions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп даних таблиці `osc_site_positions`
--

INSERT INTO `osc_site_positions` (`id`, `name`, `alias`, `block`) VALUES
(1, 'Шапка', 'top', 0),
(2, 'Левая колонка', 'left-column', 0),
(3, 'Правая колонка', 'right-column', 0),
(4, 'Футер', 'footer', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_tables_info`
--

CREATE TABLE IF NOT EXISTS `osc_tables_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  `fields` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Дамп даних таблиці `osc_tables_info`
--

INSERT INTO `osc_tables_info` (`id`, `table_name`, `details`, `fields`) VALUES
(1, 'a_test', 'Тест.', ''),
(2, 'next_admin_menu_app_ref', 'Связи пунктов меню и приложений в админке.\nСвязные таблицы: admin_menu <-> admin_applications.', ''),
(3, 'next_tables_info', 'Описания всех таблиц.', ''),
(4, 'next_admin_head_sections', 'Секции в шапке админки, которые хранят наборы событий для отдельных страниц управления контентом.', ''),
(5, 'next_admin_action_js_ref', 'Связи js функций и событий - иконок в секциях шапки админки.\nСвязные таблицы: admin_js_functions <-> admin_head_section_items.', ''),
(6, 'next_admin_app_hs_item_ref', 'Связи приложений с иконками из секций событий в шапке админки.\nСвязные таблицы: admin_applications <-> admin_head_section_items.', ''),
(7, 'next_admin_applications', 'Приложения в админке.', ''),
(8, 'next_admin_applications_groups', 'Группы приложений в админке.', ''),
(9, 'next_admin_head_section_items', 'Иконки событий, с указанием секции в шапке админки.', ''),
(10, 'next_admin_js_functions', 'JS Функции с описанием самой функции для админки.', ''),
(11, 'next_admin_menu', 'Главное меню в админке.', ''),
(12, 'next_admin_tmp', 'Буфер для временной записи результатов работы ajax страниц в админке.', ''),
(14, 'next_app_access', 'Уровни доступа для администраторов системы, хранятся в поле apps_list в виде массива serialize.', ''),
(15, 'next_applications', 'Приложения для сайта.', ''),
(16, 'next_applications_groups', 'Группы приложений для сайта.', ''),
(17, 'next_art_cat_ref', 'Связи статей и категорий на сайте. \nСвязные таблицы: categoties <-> articles.', ''),
(18, 'next_art_menu_ref', 'Связи статей и пунктов меню на сайте. \nСвязные таблицы: articles <-> menu.', ''),
(19, 'next_articles', 'Статьи на сайте.', ''),
(20, 'next_categories', 'Категории статей на сайте.', ''),
(21, 'next_config', 'Настройки сайта.', ''),
(22, 'next_copy_history', 'Буфер. История копирования строчек в таблицах администратором для понимания системой - какой номер указать следующей копии с одинаковым названием.', ''),
(23, 'next_db_structure', 'Структура Базы Данных.', ''),
(24, 'next_menu', 'Главное меню на сайте.', ''),
(25, 'next_menu_assignes', 'Назначения пунктов меню на сайте.', ''),
(26, 'next_menu_types', 'Типы меню на сайте. К примеру основное, в футере, горизонтальное, вертикальное и т.д.', ''),
(27, 'next_message_statuses', 'Статусы сообщений в админке. К примеру: прочитано, не прочитано, выполнено.', ''),
(28, 'next_message_types', 'Типы сообщений в админке. К примеру: задание, уведомление, тикет.', ''),
(29, 'next_product_photos', 'ИМ. Фото файлы к продукции.', ''),
(30, 'next_shop_cat_prod_ref', 'ИМ. Связи категорий и продукции. \nСвязные таблицы: shop_catalog <-> shop_products.', ''),
(31, 'next_shop_catalog', 'ИМ. Каталог продукции.', ''),
(32, 'next_shop_orders', 'ИМ. Заказы.', ''),
(33, 'next_shop_prod_group_ref', 'ИМ. Связи продукции и групп товаров. К примеру: акционные, новинки. \nСвязные таблицы: shop_products <-> shop_products_groups.', ''),
(34, 'next_shop_products', 'ИМ. Продукция.', ''),
(35, 'next_shop_products_groups', 'ИМ. Группы товаров. К примеру: акционные, новинки.', ''),
(36, 'next_shop_products_shelf_ref', 'ИМ. Связи продукции и ячеек на складе. \nСвязные таблицы: shop_products <-> stock_fields.', ''),
(40, 'next_stock_fields', 'Склад. Складские ячейки.', ''),
(41, 'next_stock_order_products', 'Склад. Продукция из заявки. \nСвязные таблицы: stock_orders.', ''),
(42, 'next_stock_orders', 'Склад. Заявки на поступление продукции.', ''),
(43, 'next_stocks', 'Склады.', ''),
(44, 'next_total_config', 'Глобальные настройки в админке.', ''),
(46, 'next_user_ef_ref', 'Связи пользователей и дополнительных полей. \nСвязные таблицы: shop_users <-> users_extra_fields.', ''),
(47, 'next_user_extra_fields', 'Дополнительные поля для пользователей.', ''),
(48, 'next_users', 'Пользователи системы.', ''),
(49, 'next_users_chat', 'Переписка между пользователями системы.', ''),
(50, 'next_users_ef_group_ref', 'Связи дополнительных полей пользователей и групп. К примеру: группа Паспортные данные. \nСвязные таблицы: users_extra_fields_groups <-> users_extra_fields.', ''),
(51, 'next_users_extra_fields_groups', 'Группы дополнительных полей пользователей. К примеру: Домашний адрес.', ''),
(52, 'next_users_types', 'Типы пользователей. Например: Презентант.', ''),
(53, 'next_users_types_extra_field_ref', 'Связи групп дополнительных полей пользователей и групп пользователей. К примеру: группа Паспортные данные - Салон. \nСвязные таблицы: users_types <-> users_extra_fields_groups.', ''),
(54, 'next_shop_chars_groups', 'Без описания.', ''),
(55, 'next_shop_chars', 'Без описания.', ''),
(56, 'next_shop_cat_chars_group_ref', 'Без описания.', ''),
(57, 'next_shop_product_chars_ref', 'Без описания.', ''),
(58, 'next_content_blocks', 'Контент блоки на сайте.', ''),
(59, 'next_banners', 'Без описания.', ''),
(61, 'next_site_positions', 'Без описания.', ''),
(62, 'next_files_ref', 'Без описания.', ''),
(63, 'next_template_pages', 'Без описания.', ''),
(64, 'next_template_blocks', 'Без описания.', ''),
(65, 'next_template_page_block_ref', 'Без описания.', ''),
(66, 'next_user_type_access', 'Без описания.', ''),
(67, 'next_users_dialogs', 'Без описания.', ''),
(68, 'next_dialog_files_ref', 'Без описания.', ''),
(69, 'next_faq', 'Без описания.', ''),
(70, 'next_tasks', 'Без описания.', ''),
(71, 'next_task_admin_ref', 'Без описания.', ''),
(72, 'next_shop_char_types', 'Без описания.', ''),
(73, 'page_types', 'Без описания.', ''),
(74, 'next_page_types', 'Без описания.', ''),
(75, 'shop_chars_prod_ref', 'Без описания.', ''),
(76, 'next_shop_chars_prod_ref', 'Без описания.', ''),
(77, 'next_shop_cart', 'Без описания.', ''),
(78, 'next_shop_payment_methods', 'Без описания.', ''),
(79, 'next_shop_delivery_methods', 'Без описания.', ''),
(80, 'next_shop_order_statuses', 'Без описания.', ''),
(81, 'next_shop_settings', 'Без описания.', ''),
(82, 'next_forgot_password_hash', 'Без описания.', ''),
(83, 'liqpay_log', 'Без описания.', ''),
(84, 'faq', 'Без описания.', ''),
(85, 'next_docs_ref', 'Содержит связи между таблицами объектов и документами', ''),
(86, 'osc_menu_formats', 'Без описания.', ''),
(87, 'osc_admin_applications_groups', 'Без описания.', ''),
(88, 'osc_admin_applications', 'Без описания.', ''),
(89, 'osc_admin_action_js_ref', 'Без описания.', ''),
(90, 'osc_admin_menu', 'Без описания.', ''),
(91, 'osc_menu', 'Без описания.', ''),
(92, 'osc_galleries', 'Без описания.', ''),
(93, 'osc_admin_head_section_items', 'Без описания.', ''),
(94, 'osc_admin_app_hs_item_ref', 'Без описания.', '');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_tasks`
--

CREATE TABLE IF NOT EXISTS `osc_tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(2) NOT NULL DEFAULT '1',
  `stock_order_id` int(11) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT ' No subject',
  `comment` text NOT NULL,
  `date_finish` datetime NOT NULL,
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_task_admin_ref`
--

CREATE TABLE IF NOT EXISTS `osc_task_admin_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL DEFAULT '0',
  `responsible_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_total_config`
--

CREATE TABLE IF NOT EXISTS `osc_total_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sitename` varchar(255) NOT NULL DEFAULT '0',
  `support_email` varchar(255) NOT NULL DEFAULT 'support@',
  `phone_number` varchar(255) NOT NULL DEFAULT '044-000-00-00',
  `bussiness_hours` varchar(255) NOT NULL,
  `company_address` varchar(255) NOT NULL,
  `active` int(1) NOT NULL DEFAULT '1',
  `editor` int(1) NOT NULL DEFAULT '0',
  `index` int(1) NOT NULL DEFAULT '0',
  `meta_title` varchar(255) NOT NULL DEFAULT 'ZEN',
  `meta_keys` varchar(255) NOT NULL DEFAULT 'ZEN',
  `meta_desc` text NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(7) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_total_config`
--

INSERT INTO `osc_total_config` (`id`, `sitename`, `support_email`, `phone_number`, `bussiness_hours`, `company_address`, `active`, `editor`, `index`, `meta_title`, `meta_keys`, `meta_desc`, `dateModify`, `adminMod`) VALUES
(1, 'COUNTER STRIKE', 'support@parquet-board.com.ua', '067-900-16-22', '<div><b>Пн-Пт 9:00 - 18:00</b></div>\r\n', '<p><b>г.Киев пр-т. Николая Бажана 14</b><br></p>\r\n', 1, 0, 0, 'COUNTER STRIKE', 'CS, CS GO, CS items, roulette, CS lottery', 'Рулетка CS GO', '2016-07-26 11:38:41', 1);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users`
--

CREATE TABLE IF NOT EXISTS `osc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(4) NOT NULL DEFAULT '9',
  `login` varchar(63) NOT NULL,
  `pass` varchar(63) NOT NULL,
  `phone` varchar(31) NOT NULL DEFAULT '0',
  `birthday` datetime NOT NULL,
  `name` varchar(64) NOT NULL DEFAULT '0',
  `fname` varchar(31) NOT NULL DEFAULT '',
  `avatar` varchar(255) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `block` int(1) NOT NULL DEFAULT '0',
  `active` int(1) NOT NULL DEFAULT '0',
  `real_name` varchar(255) NOT NULL,
  `profileData` text NOT NULL,
  `profile_url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='System Administrators' AUTO_INCREMENT=10 ;

--
-- Дамп даних таблиці `osc_users`
--

INSERT INTO `osc_users` (`id`, `type`, `login`, `pass`, `phone`, `birthday`, `name`, `fname`, `avatar`, `dateCreate`, `dateModify`, `block`, `active`, `real_name`, `profileData`, `profile_url`) VALUES
(3, 9, '', '', '0', '0000-00-00 00:00:00', 'Crux', '', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/bf/bf4cfa125d9bd3d7936593090c7341b8e7b02bf1_full.jpg', '2016-05-13 07:42:29', '2016-07-12 08:11:22', 0, 0, 'Crux', '{"steamid":"76561198022208725","communityvisibilitystate":3,"profilestate":1,"personaname":"Crux","lastlogoff":1468258727,"commentpermission":1,"profileurl":"http:\\/\\/steamcommunity.com\\/id\\/mcnw\\/","avatar":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/bf\\/bf4cfa125d9bd3d7936593090c7341b8e7b02bf1.jpg","avatarmedium":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/bf\\/bf4cfa125d9bd3d7936593090c7341b8e7b02bf1_medium.jpg","avatarfull":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/bf\\/bf4cfa125d9bd3d7936593090c7341b8e7b02bf1_full.jpg","personastate":0,"primaryclanid":"103582791429521408","timecreated":1268237573,"personastateflags":0,"loccountrycode":"UA","locstatecode":"12"}', 'http://steamcommunity.com/id/mcnw/'),
(6, 9, '', '', '0', '0000-00-00 00:00:00', 'Frank Horrigan', '', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/94/94f68bfe1f96436be743f66697da9c2696c8720d_full.jpg', '2016-06-01 07:45:13', '2016-07-11 14:10:08', 0, 0, 'Сергей', '{"steamid":"76561198031125555","communityvisibilitystate":3,"profilestate":1,"personaname":"Frank Horrigan","lastlogoff":1468179393,"commentpermission":1,"profileurl":"http:\\/\\/steamcommunity.com\\/id\\/fallout1990\\/","avatar":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/94\\/94f68bfe1f96436be743f66697da9c2696c8720d.jpg","avatarmedium":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/94\\/94f68bfe1f96436be743f66697da9c2696c8720d_medium.jpg","avatarfull":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/94\\/94f68bfe1f96436be743f66697da9c2696c8720d_full.jpg","personastate":1,"realname":"\\u0421\\u0435\\u0440\\u0433\\u0435\\u0439","primaryclanid":"103582791431678990","timecreated":1285660673,"personastateflags":0,"loccountrycode":"UA","locstatecode":"12"}', 'http://steamcommunity.com/id/fallout1990/'),
(7, 9, '', '', '0', '0000-00-00 00:00:00', 'unrecogn', '', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fd/fd038cf47333e82678ff23acc95c9294951138ae_full.jpg', '2016-06-08 10:25:16', '2016-07-07 13:50:57', 0, 0, 'unrecogn', '{"steamid":"76561198295075440","communityvisibilitystate":3,"profilestate":1,"personaname":"unrecogn","lastlogoff":1460564903,"profileurl":"http:\\/\\/steamcommunity.com\\/profiles\\/76561198295075440\\/","avatar":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/fd\\/fd038cf47333e82678ff23acc95c9294951138ae.jpg","avatarmedium":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/fd\\/fd038cf47333e82678ff23acc95c9294951138ae_medium.jpg","avatarfull":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/fd\\/fd038cf47333e82678ff23acc95c9294951138ae_full.jpg","personastate":0,"primaryclanid":"103582791429521408","timecreated":1459162655,"personastateflags":0}', 'http://steamcommunity.com/profiles/76561198295075440/'),
(8, 9, '', '', '0', '0000-00-00 00:00:00', 'm.sivkovych', '', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/1e/1e982c110535e5e6db3099ed26a7d0168d31af10_full.jpg', '2016-07-07 13:49:43', '2016-07-11 11:13:04', 0, 0, 'Maksym', '{"steamid":"76561198296127456","communityvisibilitystate":3,"profilestate":1,"personaname":"m.sivkovych","lastlogoff":1467899399,"commentpermission":1,"profileurl":"http:\\/\\/steamcommunity.com\\/id\\/positive-coder\\/","avatar":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/1e\\/1e982c110535e5e6db3099ed26a7d0168d31af10.jpg","avatarmedium":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/1e\\/1e982c110535e5e6db3099ed26a7d0168d31af10_medium.jpg","avatarfull":"https:\\/\\/steamcdn-a.akamaihd.net\\/steamcommunity\\/public\\/images\\/avatars\\/1e\\/1e982c110535e5e6db3099ed26a7d0168d31af10_full.jpg","personastate":0,"realname":"Maksym","primaryclanid":"103582791429521408","timecreated":1459335047,"personastateflags":0,"loccountrycode":"UA","locstatecode":"12"}', 'http://steamcommunity.com/id/positive-coder/'),
(9, 1, 'ms-tx@yandex.ru', '4a7d1ed414474e4033ac29ccb8653d9b', '0982858976', '2016-07-01 00:00:00', 'Maksym', 'Dev', '0', '2016-07-12 00:00:00', '2016-07-12 00:00:00', 0, 1, 'Maksym Dev', '', '');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_chat`
--

CREATE TABLE IF NOT EXISTS `osc_users_chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(63) NOT NULL DEFAULT 'message',
  `status` int(1) NOT NULL DEFAULT '0',
  `from_id` int(7) NOT NULL DEFAULT '0',
  `to_id` int(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '0',
  `message` tinytext NOT NULL,
  `file` varchar(63) NOT NULL DEFAULT '0',
  `important` int(2) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Чат между пользователями' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_dialogs`
--

CREATE TABLE IF NOT EXISTS `osc_users_dialogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last` int(1) NOT NULL DEFAULT '1',
  `message` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL DEFAULT '0',
  `to_id` int(11) NOT NULL DEFAULT '0',
  `dateCreate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Дамп даних таблиці `osc_users_dialogs`
--

INSERT INTO `osc_users_dialogs` (`id`, `last`, `message`, `status`, `from_id`, `to_id`, `dateCreate`) VALUES
(1, 1, 'g43g3g34g', 0, 9, 0, '2016-07-26 11:23:03');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_ef_group_ref`
--

CREATE TABLE IF NOT EXISTS `osc_users_ef_group_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `ef_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_extra_fields_groups`
--

CREATE TABLE IF NOT EXISTS `osc_users_extra_fields_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп даних таблиці `osc_users_extra_fields_groups`
--

INSERT INTO `osc_users_extra_fields_groups` (`id`, `name`, `details`) VALUES
(1, 'Адрес доставки', 'Код, страна, город, улица, дом'),
(2, 'Домашний адрес', 'код, страна, город, улица, дом'),
(3, 'Паспортные данные', 'Серия, Номер паспорта, ИНН, дата выдачи паспорта, кем выдан');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_types`
--

CREATE TABLE IF NOT EXISTS `osc_users_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `alias` varchar(255) NOT NULL DEFAULT '0',
  `block` int(1) NOT NULL DEFAULT '0',
  `admin_enter` int(1) NOT NULL DEFAULT '1',
  `change_login` int(1) NOT NULL DEFAULT '1',
  `dateCreate` datetime NOT NULL,
  `dateModify` datetime NOT NULL,
  `adminMod` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Уровни пользователей' AUTO_INCREMENT=14 ;

--
-- Дамп даних таблиці `osc_users_types`
--

INSERT INTO `osc_users_types` (`id`, `name`, `alias`, `block`, `admin_enter`, `change_login`, `dateCreate`, `dateModify`, `adminMod`) VALUES
(1, 'SuperAdministrator', 'superadministrator', 0, 1, 1, '2013-11-14 00:00:00', '2016-07-26 11:14:04', 0),
(2, 'ContentManager', 'contentmanager', 0, 1, 1, '2013-11-14 00:00:00', '2015-10-02 16:09:41', 0),
(3, 'Cosmetolog', 'cosmetolog', 0, 1, 1, '2013-11-15 10:40:48', '2013-11-15 10:40:48', 0),
(4, 'Salon', 'salon', 0, 1, 1, '2013-11-15 10:41:33', '2013-11-15 10:41:33', 0),
(5, 'Presentant', 'presentant', 0, 1, 1, '2013-11-15 10:42:00', '2013-11-15 10:42:00', 0),
(6, 'QualityManager', 'qualitymanager', 0, 1, 1, '2013-11-15 10:47:01', '2015-09-19 01:40:14', 0),
(8, 'Bookkeeper', 'bookkeeper', 0, 1, 1, '2013-11-15 10:47:58', '2014-10-13 16:07:17', 0),
(9, 'Зарегистрированный', 'siteuser', 0, 0, 0, '2013-12-23 15:52:55', '2015-07-26 14:25:01', 0),
(12, 'test', 'test', 0, 1, 0, '2015-02-06 13:38:31', '2015-02-06 14:58:21', 0),
(13, 'СЕО Менеджер', 'seo-menedzher', 0, 1, 0, '2016-02-24 18:17:06', '2016-02-24 18:17:06', 0);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_users_types_extra_field_ref`
--

CREATE TABLE IF NOT EXISTS `osc_users_types_extra_field_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `ef_id` int(11) NOT NULL DEFAULT '0',
  `ef_group_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Дамп даних таблиці `osc_users_types_extra_field_ref`
--

INSERT INTO `osc_users_types_extra_field_ref` (`id`, `group_id`, `ef_id`, `ef_group_id`) VALUES
(1, 0, 0, 1),
(2, 0, 0, 2),
(3, 1, 0, 1),
(4, 1, 0, 2),
(5, 2, 0, 1),
(6, 2, 0, 2),
(7, 3, 0, 1),
(8, 3, 0, 2),
(9, 4, 0, 1),
(10, 4, 0, 2),
(11, 5, 0, 1),
(12, 5, 0, 2),
(13, 5, 0, 3),
(14, 6, 0, 1),
(15, 6, 0, 2),
(16, 7, 0, 1),
(17, 7, 0, 2),
(18, 8, 0, 1),
(19, 8, 0, 2),
(20, 9, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблиці `osc_user_ef_ref`
--

CREATE TABLE IF NOT EXISTS `osc_user_ef_ref` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `ef_id` int(11) NOT NULL DEFAULT '0',
  `value` varchar(255) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблиці `osc_user_extra_fields`
--

CREATE TABLE IF NOT EXISTS `osc_user_extra_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '0',
  `type` varchar(123) NOT NULL DEFAULT 'VARCHAR',
  `length` int(5) NOT NULL DEFAULT '2',
  `default` varchar(255) NOT NULL DEFAULT '0',
  `details` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп даних таблиці `osc_user_extra_fields`
--

INSERT INTO `osc_user_extra_fields` (`id`, `name`, `type`, `length`, `default`, `details`) VALUES
(1, 'Серия', 'VARCHAR', 2, '', 'Серия паспорта'),
(2, 'Номер', 'INT', 8, '', 'Номер паспорта'),
(3, 'ИНН', 'INT', 11, '', 'Идентификационный код'),
(4, 'Дата выдачи паспорта', 'DATETIME', 12, '', 'Дата выдачи паспорта'),
(7, 'Кем выдан', 'VARCHAR', 100, '', 'Кем выдан паспорт'),
(8, 'День', 'INT', 2, '', 'День подписания договора'),
(9, 'Месяц', 'INT', 2, '', 'Месяц подписания договора'),
(10, 'Год', 'INT', 4, '', 'Год подписания договора'),
(11, 'Место подписания', 'VARCHAR', 123, '', 'Место подписания договора'),
(12, 'Время работы', 'VARCHAR', 255, '', 'Время работы салона'),
(13, 'Код', 'INT', 5, '', 'Почтовый индекс адреса доставки'),
(14, 'Страна', 'VARCHAR', 25, 'Украина', 'Страна адреса доставки'),
(15, 'Город', 'VARCHAR', 25, 'Киев', 'Город адреса доставки'),
(16, 'Улица', 'VARCHAR', 25, '', 'Улица адреса доставки'),
(17, 'Дом', 'VARCHAR', 10, '', 'Номер дома адреса доставки'),
(18, 'Код', 'INT', 5, '', 'Почтовый индекс домашнего адреса'),
(19, 'Страна', 'VARCHAR', 25, 'Украина', 'Страна домашнего адреса'),
(20, 'Город', 'VARCHAR', 25, 'Киев', 'Город домашнего адреса'),
(21, 'Улица', 'VARCHAR', 25, '', 'Улица домашнего адреса'),
(22, 'Дом', 'VARCHAR', 10, '', 'Номер дома домашнего адреса');

-- --------------------------------------------------------

--
-- Структура таблиці `osc_user_type_access`
--

CREATE TABLE IF NOT EXISTS `osc_user_type_access` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `access` int(1) NOT NULL DEFAULT '1',
  `type_id` int(11) NOT NULL DEFAULT '0',
  `menu_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=467 ;

--
-- Дамп даних таблиці `osc_user_type_access`
--

INSERT INTO `osc_user_type_access` (`id`, `access`, `type_id`, `menu_id`) VALUES
(1, 0, 9, 28),
(2, 0, 9, 29),
(3, 0, 9, 7),
(4, 0, 9, 12),
(5, 0, 9, 13),
(6, 0, 9, 14),
(7, 0, 9, 15),
(8, 0, 9, 16),
(9, 0, 9, 30),
(10, 0, 9, 8),
(11, 0, 9, 10),
(12, 0, 9, 11),
(13, 0, 9, 31),
(14, 0, 9, 18),
(15, 0, 9, 17),
(16, 0, 9, 19),
(17, 0, 9, 34),
(18, 0, 9, 32),
(19, 0, 9, 33),
(20, 0, 9, 35),
(21, 0, 9, 20),
(22, 0, 9, 36),
(23, 0, 9, 22),
(24, 0, 9, 23),
(25, 0, 9, 24),
(26, 0, 9, 25),
(27, 1, 9, 26),
(28, 1, 9, 27),
(29, 0, 10, 28),
(30, 0, 10, 29),
(31, 0, 10, 7),
(32, 0, 10, 12),
(33, 0, 10, 13),
(34, 0, 10, 14),
(35, 0, 10, 15),
(36, 0, 10, 16),
(37, 0, 10, 30),
(38, 0, 10, 8),
(39, 0, 10, 10),
(40, 0, 10, 11),
(41, 0, 10, 31),
(42, 0, 10, 18),
(43, 0, 10, 17),
(44, 0, 10, 19),
(45, 0, 10, 34),
(46, 0, 10, 32),
(47, 0, 10, 33),
(48, 0, 10, 35),
(49, 0, 10, 20),
(50, 0, 10, 36),
(51, 0, 10, 22),
(52, 0, 10, 23),
(53, 0, 10, 24),
(54, 0, 10, 25),
(55, 1, 10, 26),
(56, 1, 10, 27),
(57, 1, 1, 28),
(58, 1, 1, 29),
(59, 1, 1, 7),
(60, 1, 1, 12),
(61, 1, 1, 13),
(62, 1, 1, 14),
(63, 1, 1, 15),
(64, 1, 1, 16),
(65, 1, 1, 30),
(66, 1, 1, 8),
(67, 1, 1, 10),
(68, 1, 1, 11),
(69, 1, 1, 31),
(70, 1, 1, 18),
(71, 1, 1, 17),
(72, 1, 1, 19),
(73, 1, 1, 34),
(74, 1, 1, 32),
(75, 1, 1, 33),
(76, 1, 1, 35),
(77, 1, 1, 20),
(78, 1, 1, 36),
(79, 1, 1, 22),
(80, 1, 1, 23),
(81, 1, 1, 24),
(82, 1, 1, 25),
(83, 1, 1, 26),
(84, 1, 1, 27),
(85, 1, 2, 28),
(86, 1, 2, 29),
(87, 1, 2, 7),
(88, 1, 2, 12),
(89, 0, 2, 13),
(90, 0, 2, 14),
(91, 0, 2, 15),
(92, 1, 2, 16),
(93, 0, 2, 30),
(94, 0, 2, 8),
(95, 0, 2, 10),
(96, 0, 2, 11),
(97, 0, 2, 31),
(98, 1, 2, 18),
(99, 1, 2, 17),
(100, 1, 2, 19),
(101, 1, 2, 34),
(102, 1, 2, 32),
(103, 1, 2, 33),
(104, 1, 2, 35),
(105, 1, 2, 20),
(106, 0, 2, 36),
(107, 0, 2, 22),
(108, 0, 2, 23),
(109, 0, 2, 24),
(110, 0, 2, 25),
(111, 1, 2, 26),
(112, 1, 2, 27),
(113, 1, 3, 28),
(114, 1, 3, 29),
(115, 1, 3, 7),
(116, 1, 3, 12),
(117, 1, 3, 13),
(118, 1, 3, 14),
(119, 1, 3, 15),
(120, 1, 3, 16),
(121, 1, 3, 30),
(122, 1, 3, 8),
(123, 1, 3, 10),
(124, 1, 3, 11),
(125, 1, 3, 31),
(126, 1, 3, 18),
(127, 1, 3, 17),
(128, 1, 3, 19),
(129, 1, 3, 34),
(130, 1, 3, 32),
(131, 1, 3, 33),
(132, 1, 3, 35),
(133, 1, 3, 20),
(134, 1, 3, 36),
(135, 1, 3, 22),
(136, 1, 3, 23),
(137, 1, 3, 24),
(138, 1, 3, 25),
(139, 1, 3, 26),
(140, 1, 3, 27),
(141, 1, 4, 28),
(142, 1, 4, 29),
(143, 1, 4, 7),
(144, 1, 4, 12),
(145, 1, 4, 13),
(146, 1, 4, 14),
(147, 1, 4, 15),
(148, 1, 4, 16),
(149, 1, 4, 30),
(150, 1, 4, 8),
(151, 1, 4, 10),
(152, 1, 4, 11),
(153, 1, 4, 31),
(154, 1, 4, 18),
(155, 1, 4, 17),
(156, 1, 4, 19),
(157, 1, 4, 34),
(158, 1, 4, 32),
(159, 1, 4, 33),
(160, 1, 4, 35),
(161, 1, 4, 20),
(162, 1, 4, 36),
(163, 1, 4, 22),
(164, 1, 4, 23),
(165, 1, 4, 24),
(166, 1, 4, 25),
(167, 1, 4, 26),
(168, 1, 4, 27),
(169, 1, 5, 28),
(170, 1, 5, 29),
(171, 1, 5, 7),
(172, 1, 5, 12),
(173, 1, 5, 13),
(174, 1, 5, 14),
(175, 1, 5, 15),
(176, 1, 5, 16),
(177, 1, 5, 30),
(178, 1, 5, 8),
(179, 1, 5, 10),
(180, 1, 5, 11),
(181, 1, 5, 31),
(182, 1, 5, 18),
(183, 1, 5, 17),
(184, 1, 5, 19),
(185, 1, 5, 34),
(186, 1, 5, 32),
(187, 1, 5, 33),
(188, 1, 5, 35),
(189, 1, 5, 20),
(190, 1, 5, 36),
(191, 1, 5, 22),
(192, 1, 5, 23),
(193, 1, 5, 24),
(194, 1, 5, 25),
(195, 1, 5, 26),
(196, 1, 5, 27),
(197, 1, 6, 28),
(198, 1, 6, 29),
(199, 1, 6, 7),
(200, 1, 6, 12),
(201, 1, 6, 13),
(202, 1, 6, 14),
(203, 1, 6, 15),
(204, 1, 6, 16),
(205, 1, 6, 30),
(206, 0, 6, 8),
(207, 0, 6, 10),
(208, 0, 6, 11),
(209, 1, 6, 31),
(210, 1, 6, 18),
(211, 1, 6, 17),
(212, 1, 6, 19),
(213, 1, 6, 34),
(214, 1, 6, 32),
(215, 1, 6, 33),
(216, 1, 6, 35),
(217, 1, 6, 20),
(218, 1, 6, 36),
(219, 1, 6, 22),
(220, 1, 6, 23),
(221, 1, 6, 24),
(222, 1, 6, 25),
(223, 1, 6, 26),
(224, 1, 6, 27),
(225, 1, 7, 28),
(226, 1, 7, 29),
(227, 1, 7, 7),
(228, 1, 7, 12),
(229, 1, 7, 13),
(230, 1, 7, 14),
(231, 1, 7, 15),
(232, 1, 7, 16),
(233, 1, 7, 30),
(234, 1, 7, 8),
(235, 1, 7, 10),
(236, 1, 7, 11),
(237, 1, 7, 31),
(238, 1, 7, 18),
(239, 1, 7, 17),
(240, 1, 7, 19),
(241, 1, 7, 34),
(242, 1, 7, 32),
(243, 1, 7, 33),
(244, 1, 7, 35),
(245, 1, 7, 20),
(246, 1, 7, 36),
(247, 1, 7, 22),
(248, 1, 7, 23),
(249, 1, 7, 24),
(250, 1, 7, 25),
(251, 1, 7, 26),
(252, 1, 7, 27),
(253, 1, 8, 28),
(254, 1, 8, 29),
(255, 1, 8, 7),
(256, 1, 8, 12),
(257, 1, 8, 13),
(258, 1, 8, 14),
(259, 1, 8, 15),
(260, 1, 8, 16),
(261, 1, 8, 30),
(262, 1, 8, 8),
(263, 1, 8, 10),
(264, 1, 8, 11),
(265, 1, 8, 31),
(266, 1, 8, 18),
(267, 1, 8, 17),
(268, 1, 8, 19),
(269, 1, 8, 34),
(270, 1, 8, 32),
(271, 1, 8, 33),
(272, 1, 8, 35),
(273, 1, 8, 20),
(274, 1, 8, 36),
(275, 1, 8, 22),
(276, 1, 8, 23),
(277, 1, 8, 24),
(278, 1, 8, 25),
(279, 1, 8, 26),
(280, 1, 8, 27),
(281, 1, 1, 37),
(282, 1, 6, 37),
(283, 1, 10, 28),
(284, 1, 10, 29),
(285, 1, 10, 7),
(286, 1, 10, 12),
(287, 1, 10, 13),
(288, 1, 10, 14),
(289, 1, 10, 15),
(290, 1, 10, 16),
(291, 1, 10, 30),
(292, 1, 10, 8),
(293, 1, 10, 10),
(294, 1, 10, 11),
(295, 1, 10, 31),
(296, 1, 10, 18),
(297, 1, 10, 17),
(298, 1, 10, 19),
(299, 1, 10, 34),
(300, 1, 10, 32),
(301, 1, 10, 33),
(302, 1, 10, 35),
(303, 1, 10, 20),
(304, 1, 10, 36),
(305, 0, 10, 37),
(306, 1, 10, 22),
(307, 1, 10, 23),
(308, 1, 10, 24),
(309, 1, 10, 25),
(310, 1, 10, 26),
(311, 0, 8, 37),
(312, 1, 10, 7),
(313, 1, 10, 28),
(314, 1, 10, 29),
(315, 0, 10, 8),
(316, 0, 10, 10),
(317, 0, 10, 11),
(318, 0, 10, 31),
(319, 1, 10, 12),
(320, 1, 10, 13),
(321, 1, 10, 14),
(322, 1, 10, 15),
(323, 1, 10, 16),
(324, 1, 10, 30),
(325, 0, 10, 17),
(326, 0, 10, 18),
(327, 0, 10, 19),
(328, 0, 10, 20),
(329, 0, 10, 32),
(330, 0, 10, 33),
(331, 0, 10, 34),
(332, 0, 10, 35),
(333, 0, 10, 36),
(334, 0, 10, 37),
(335, 1, 10, 22),
(336, 1, 10, 23),
(337, 1, 10, 24),
(338, 1, 10, 25),
(339, 1, 10, 26),
(340, 0, 9, 37),
(341, 0, 2, 37),
(342, 1, 1, 38),
(343, 0, 11, 7),
(344, 0, 11, 28),
(345, 0, 11, 29),
(346, 0, 11, 38),
(347, 0, 11, 8),
(348, 0, 11, 10),
(349, 0, 11, 11),
(350, 0, 11, 31),
(351, 0, 11, 12),
(352, 0, 11, 13),
(353, 0, 11, 14),
(354, 0, 11, 15),
(355, 0, 11, 16),
(356, 0, 11, 30),
(357, 0, 11, 17),
(358, 0, 11, 18),
(359, 0, 11, 19),
(360, 0, 11, 20),
(361, 0, 11, 32),
(362, 0, 11, 33),
(363, 0, 11, 34),
(364, 0, 11, 35),
(365, 0, 11, 36),
(366, 0, 11, 37),
(367, 0, 11, 22),
(368, 0, 11, 23),
(369, 0, 11, 24),
(370, 0, 11, 25),
(371, 0, 11, 26),
(372, 1, 12, 7),
(373, 1, 12, 28),
(374, 1, 12, 29),
(375, 1, 12, 38),
(376, 1, 12, 8),
(377, 1, 12, 10),
(378, 1, 12, 11),
(379, 1, 12, 31),
(380, 1, 12, 12),
(381, 1, 12, 13),
(382, 1, 12, 14),
(383, 1, 12, 15),
(384, 1, 12, 16),
(385, 1, 12, 30),
(386, 1, 12, 17),
(387, 1, 12, 18),
(388, 0, 12, 19),
(389, 0, 12, 20),
(390, 0, 12, 32),
(391, 0, 12, 33),
(392, 0, 12, 34),
(393, 0, 12, 35),
(394, 0, 12, 36),
(395, 0, 12, 37),
(396, 1, 12, 22),
(397, 1, 12, 23),
(398, 1, 12, 24),
(399, 1, 12, 25),
(400, 1, 12, 26),
(401, 1, 2, 38),
(402, 1, 1, 39),
(403, 1, 2, 39),
(404, 0, 9, 38),
(405, 0, 9, 39),
(406, 1, 1, 40),
(407, 1, 1, 41),
(408, 1, 1, 42),
(409, 1, 1, 43),
(410, 1, 6, 38),
(411, 1, 6, 40),
(412, 1, 6, 43),
(413, 1, 6, 41),
(414, 1, 6, 39),
(415, 1, 6, 42),
(416, 1, 2, 40),
(417, 1, 2, 43),
(418, 1, 2, 41),
(419, 1, 2, 42),
(420, 1, 13, 7),
(421, 1, 13, 28),
(422, 1, 13, 29),
(423, 0, 13, 38),
(424, 0, 13, 8),
(425, 0, 13, 10),
(426, 0, 13, 11),
(427, 0, 13, 31),
(428, 1, 13, 12),
(429, 1, 13, 13),
(430, 0, 13, 14),
(431, 0, 13, 15),
(432, 1, 13, 16),
(433, 0, 13, 30),
(434, 0, 13, 40),
(435, 1, 13, 43),
(436, 1, 13, 17),
(437, 1, 13, 18),
(438, 0, 13, 19),
(439, 0, 13, 20),
(440, 0, 13, 32),
(441, 0, 13, 33),
(442, 0, 13, 34),
(443, 0, 13, 35),
(444, 0, 13, 36),
(445, 0, 13, 41),
(446, 0, 13, 39),
(447, 0, 13, 42),
(448, 0, 13, 22),
(449, 0, 13, 23),
(450, 0, 13, 24),
(451, 0, 13, 25),
(452, 1, 13, 26),
(453, 1, 1, 44),
(454, 1, 1, 45),
(455, 1, 1, 46),
(456, 1, 1, 47),
(457, 1, 1, 48),
(458, 0, 1, 49),
(459, 1, 1, 50),
(460, 1, 1, 51),
(461, 1, 1, 52),
(462, 1, 1, 54),
(463, 1, 1, 55),
(464, 1, 1, 56),
(465, 1, 1, 57),
(466, 1, 1, 58);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
