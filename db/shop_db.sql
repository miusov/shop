-- phpMyAdmin SQL Dump
-- version 4.4.15.7
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 23 2016 г., 14:25
-- Версия сервера: 5.5.50
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `shop_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `carts`
--

CREATE TABLE IF NOT EXISTS `carts` (
  `id` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `datein` date DEFAULT NULL,
  `price` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(18, 'Бижутерия'),
(22, 'Игрушки'),
(21, 'Книги'),
(14, 'Косметика'),
(20, 'Обувь'),
(19, 'Одежда'),
(16, 'Спорттовары'),
(13, 'Техника'),
(15, 'Хозтовары'),
(17, 'Часы');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `text` varchar(512) NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `datein` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `pass` varchar(128) NOT NULL,
  `email` varchar(64) NOT NULL,
  `surname` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parentname` varchar(32) CHARACTER SET utf8mb4 NOT NULL,
  `birthday` datetime NOT NULL,
  `adress` varchar(512) NOT NULL,
  `phone` int(15) NOT NULL,
  `roleid` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL,
  `reg-date` datetime NOT NULL,
  `last-activity` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `customers`
--

INSERT INTO `customers` (`id`, `login`, `pass`, `email`, `surname`, `name`, `parentname`, `birthday`, `adress`, `phone`, `roleid`, `discount`, `total`, `imagepath`, `reg-date`, `last-activity`) VALUES
(4, 'admin', 'eb77f747c3c01a208d762a78714101ed', 'miusov86@gmail.com', 'Миусов', '', 'Святославович', '1986-02-21 00:00:00', 'г.Запорожье, Новая почта №9', 977919245, 1, 0, 11760, 'img/avatars/qwerty.jpg', '2016-12-01 00:00:00', '2016-12-20 00:00:00'),
(5, 'miusov', 'e10adc3949ba59abbe56e057f20f883e', '', '', '', '', '0000-00-00 00:00:00', '', 0, 2, 0, 73650, 'img/avatars/07.gif', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL,
  `itemid` int(11) DEFAULT NULL,
  `imagepath` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `itemid`, `imagepath`) VALUES
(13, 21, 'img/tovari/1301724.jpg'),
(14, 21, 'img/tovari/430023365.jpg'),
(15, 21, 'img/tovari/geminus01.jpg'),
(16, 21, 'img/tovari/i.jpg'),
(17, 21, 'img/tovari/ip7plus_rugged_armor_title_03_large.jpg'),
(18, 21, 'img/tovari/iphone-7-plus-12.jpg'),
(19, 21, 'img/tovari/tab e 3.jpg'),
(20, 24, 'img/tovari/1.png'),
(21, 24, 'img/tovari/2.png'),
(22, 24, 'img/tovari/3.gif'),
(24, 24, 'img/tovari/5.jpg'),
(25, 26, 'img/tovari/asus_x541sa_xo041d_images_1741081794.jpg'),
(26, 26, 'img/tovari/asus_x541sa_xo041d_images_1741082102.jpg'),
(27, 26, 'img/tovari/asus_x541sa_xo041d_images_1741083026.jpg'),
(28, 26, 'img/tovari/asus_x541sa_xo041d_images_1741083292.jpg'),
(29, 26, 'img/tovari/asus_x541sa_xo041d_images_1741083600.jpg'),
(30, 26, 'img/tovari/asus_x541sa_xo041d_images_1741083817.jpg'),
(31, 26, 'img/tovari/asus_x541sa_xo041d_images_1741083971.jpg'),
(32, 27, 'img/tovari/c108bed2694d9943262e365d73a917aa_enl.jpg'),
(33, 28, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138599.jpg'),
(34, 28, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138690.jpg'),
(35, 28, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138781.jpg'),
(36, 28, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138872.jpg'),
(37, 28, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138963.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL,
  `itemname` varchar(128) NOT NULL,
  `catid` int(11) DEFAULT NULL,
  `subid` int(11) DEFAULT NULL,
  `pricein` int(11) NOT NULL,
  `pricesale` int(11) NOT NULL,
  `info` varchar(1024) NOT NULL,
  `rate` double DEFAULT NULL,
  `imagepath` varchar(256) NOT NULL,
  `action` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `items`
--

INSERT INTO `items` (`id`, `itemname`, `catid`, `subid`, `pricein`, `pricesale`, `info`, `rate`, `imagepath`, `action`) VALUES
(1, 'GA-400-7AER', 17, 28, 1300, 1800, 'Сверхмощная автоматическая подсветка LED  \r\nПри недостаточной освещенности только поворот Вашего запястья включит яркую цветную подсветку часов.\r\nCASIO CO GA-400-7AER Ударопрочность \r\nУдаропрочная конструкция защищает от ударов и вибрации.', NULL, 'img/tovari/GA-400-7AER.jpg', NULL),
(2, 'CASIO GW-M5610-1ER', 17, 28, 750, 1250, 'Пол: Мужские\r\nМеханизм: Солнечная батарея\r\nСтекло: Минеральное\r\nТип индикации: Цифровые\r\nКорпус: Полимер\r\nВодонепроницаемость: 200 метров\r\nБраслет: Полимерный ремешок\r\nПодсветка: Электролюминесцентная подсветка\r\nЗащита корпуса часов: Ударопрочные\r\nФункции:', NULL, 'img/tovari/GW-M5610-1ER.jpg', NULL),
(3, 'CASIO AW-591-2AER', 17, 26, 1200, 1500, 'СВЕТОДИОДНАЯ АВТОПОДСВЕТКА CASIO CO AW-591-2AER-L\r\nПросто немного наклоните часы к себе, чтобы включилась светодиодная подсветка циферблата.\r\nПРОТИВОУДАРНЫЕ\r\nБлагодаря противоударной защите часы могут выдержать достаточно сильный удар или сотрясение без не', NULL, 'img/tovari/AW-591-2AER.jpg', NULL),
(4, 'CASIO AW-591BB-1AER', 17, 26, 1950, 2650, 'CASIO AW-591BB-1AER - наручные часы,которые представлены в черном матовом корпусе с черным циферблатом. Как мы все знаем, G-Shock пользуются огромной популярностью среди потребителей, и эта модель тому не исключение. Часы имеют невероятно стильный внешний ', NULL, 'img/tovari/AW-591BB-1A.jpg', NULL),
(5, 'Ноутбук HP 250', 13, 10, 6210, 7230, 'Диагональ дисплея: 15,6"; Тип процессора: Intel Celeron N3050 (1.6 - 2,16 ГГц); Дисплей: Матовый экран; Оперативная память: 4 ГБ; Жесткий диск HDD: 500 Гб; Графический адаптер: Intel HD Graphics;\r\nПодробнее: http://allo.ua/ru/products/notebooks/hp-250-n0y2', NULL, 'img/tovari/177544_1_1.jpg', NULL),
(6, 'Ноутбук HP Stream 11-r001ur', 13, 10, 300, 5600, 'Диагональ дисплея: 11,6"; Тип процессора: Intel Celeron N3050 (1.6 - 2,16 ГГц); Дисплей: Глянцевый экран; Оперативная память: 2 ГБ; Жесткий диск SSD: 32 Гб; Графический адаптер: Intel HD Graphics;\r\nПодробнее: http://allo.ua/ru/products/notebooks/hp-stream-', NULL, 'img/tovari/193923.jpg', NULL),
(7, 'Ноутбук HP ProBook 450', 13, 10, 15000, 17000, 'Диагональ дисплея: 15,6"; Тип процессора: Intel Core i5-6200U (2.3-2.8 ГГц); Дисплей: Матовый экран; Оперативная память: 8 ГБ; Жесткий диск HDD: 1 Тб; Графический адаптер: AMD Radeon R7 M340;\r\nПодробнее: http://allo.ua/ru/products/notebooks/hp-probook-450-', NULL, 'img/tovari/177529.jpg', NULL),
(8, 'Браслет Akvamarin', 18, 13, 100, 230, 'Частенько женщины ищут для себя украшения крупного плана, имеющие асимметричную форму. Браслет из серебра украшенный ярко синими сапфирами, станет правильным выбором для людей, которые хотят подчеркнуть стилевые предпочтения и индивидуальность, но также ск', NULL, 'img/tovari/mjnhbgvf789.jpg', NULL),
(9, 'Браслет Akvamarin', 18, 13, 150, 540, 'Серебряный браслет с эмалью – это уникальное украшение, которое украсит повседневную одежду, а также станет элегантным дополнением к строгому вечернему платью. На браслете ювелир разместил небольшие камешки циркония, для того чтобы он смог раскрыть свою мн', NULL, 'img/tovari/fcb8458059c5c347bbfa097d894a8033.jpg', NULL),
(10, 'Холодильник Gorenje RK 61 FSY2B', 13, 7, 5600, 8300, 'Холодильник Gorenje RK 61 FSY2B способен создать оптимальную температуру для длительного хранения продуктов. Общий объем холодильника составляет 321 литр, его годовой расход электроэнергии равен 281 кВт с классом энергопотребления А+. В устройстве использу', NULL, 'img/tovari/gorenje_rk_61_fsy2b_.jpg', NULL),
(11, 'Велосипед GHOST Cagua 7000', 16, 18, 70500, 85000, 'Велосипед GHOST Cagua 7000 оборудован всем, что необходимо для идеальной езды. Модель имеет 170 мм ходовой механизм, который обеспечит наилучшую эффективность в сложной местности. С этим ультрасовременным и продуманным д мелочей горным байком вы не только ', NULL, 'img/tovari/ghost_cagua_7000.jpg', NULL),
(12, 'Телевизор Panasonic TX-65DXR900', 13, 8, 100000, 121300, 'Телевизор Panasonic TX-65DXR900 однозначно не относится к спонтанной покупке. Если вы остановились на этой модели, значит вы серьезно подошли к выбору телевизора, сравнили с десяток моделей и осознанно выбрали именно эту. Если вы выбрали Panasonic TX-65, з', NULL, 'img/tovari/957436525.jpg', NULL),
(13, 'Рюкзак Dakine 8100-103 Abs Signal 25L Black+Abs Activat-Steel', 16, 30, 14000, 15300, 'Этот необычный рюкзак выглядит достаточно простым, не так ли? Но на самом деле он скрывает все свои возможности. Такой рюкзак предназначен для настоящего экстрима, поэтому вам стоит задержать свое дыхание и слушать, слушать, слушать. Мужской рюкзак Dakine ', NULL, 'img/tovari/244070_001.jpg', NULL),
(14, 'Мультитул Victorinox SKIPPER (111мм, 17 функций), синий 0.9093.2W', 16, 30, 900, 1320, 'Слово мультитулс, в переводе с иностранного, расшифровывается как многофункциональный инструмент. И видя перед собой швейцарский складной нож, мало кто может подумать, что он относится именно к таким инструментам. Что же в нем такого многофункционального? ', NULL, 'img/tovari/217928_1.jpg', NULL),
(15, 'Adidas КРОССОВКИ ALTARUN', 20, 32, 30, 50, 'Комфортные беговые кроссовки, которые помогут юному чемпиону достигнуть впечатляющих результатов. Дышащий верх из сетки обеспечивает необходимый уровень вентиляции и свежести. Удобные ремешки на липучках для быстрого надевания и снимания.', NULL, 'img/tovari/BA7425_01_standard.jpg', NULL),
(16, 'Джинсы Medicine Inverness', 19, 41, 890, 1230, 'Купить брюки мужские Medicine Inverness вы можете, оформив заказ у нас на сайте, а также по телефону горячей линии 0-800-300-100.', NULL, 'img/tovari/full_img_718027_2.jpg', NULL),
(17, 'Мультитул Victorinox CLASSIC', 16, 30, 230, 340, 'Тип: Карманные; Количество инструментов: 1; Инструменты: Ножницы, Плоская отвертка;', NULL, 'img/tovari/228420.jpg', NULL),
(18, 'Телевизор Sony KDL-32R303CBR', 13, 8, 7800, 9600, 'Не знаете, чем заняться в свободное от работы и домашних дел время? Теперь у вас появилась прекрасная возможность отправиться в мир необыкновенных развлечений вместе с телевизором Sony KDL-32R303СBR. В этой модели производителю удалось объединить самые последние инновационные разработки с доступным и удобным управлением. Одной из многих привлекательных черт нового телевизора является его ненавязчивый, минималистичный, однако стильный и современный дизайн.', NULL, 'img/tovari/sony_kdl-32r303cbr_1.jpg', NULL),
(19, 'Телевизор Sony KDL-43WD752SR2', 13, 8, 9800, 12400, 'Телевизор Sony Телевизор Sony KDL-43WD752SR2 – это гарантировано удачный выбор, так как в нем вы найдете одно из самых удачных сочетаний качества изображения, функциональности и взвешенной цены. Что же до внешнего оформления, то производители уделили ему должное внимание, чтобы телевизор по достоинству занял центральное место в вашей гостиной, спальне, столовой. Возможность крепления на стену позволит вам разместить его, не используя подставку (кронштейны для крепления приобретаются отдельно).', NULL, 'img/tovari/a2c53dd5f08b9322130a5702a1d187d4.png', NULL),
(20, 'Туалетна вода Versace Eau Fraiche Man', 14, 42, 450, 620, 'Стильный парфюм для мужчин от Versace Бренд Versace в 2006 году создал аромат под названием Versace Man, недолго думая, спустя некоторое время бренд выпустил легкую версию парфюма. С тех пор, упрощенная версия аромата пользует невероятной популярностью. Аромат является уникальным своем роду, он подойдет для повседневного использования, некоторые мужчины используют такой аромат л занятия спортом. Но также парфюм станет отличным атрибутом для особенных событий, романтических встреч, прогулок, свиданий. Его можно использовать в любое время суток, как днем, та и в ночное время.', NULL, 'img/tovari/eau_fraiche.png', NULL),
(21, 'Apple iPhone 7 Plus 256GB', 13, 9, 32000, 35700, 'Диагональ экрана: 5.5"; Разрешение экрана: 1920x1080; Камера: 12 Mpx; Количество ядер: 4; Внутренняя память: 256 Гб; Bluetooth: Bluetooth 4.2;', NULL, 'img/tovari/226453_2.jpg', NULL),
(22, 'Фонарь Led Lenser Seo 3', 16, 30, 780, 930, 'LED LENSER SEO – это название новой серии налобных фонарей с современным дизайном, яркими цветами и выдающейся силой света. Оригинальные упаковки и современная форма изделия подчёркивают особую направленность этих моделей на активную целевую аудиторию. Немецкий производитель разработал эту серию фонарей для активных, уверенных в себе, спортивных покупателей, стремящихся во всем иметь свой стиль. Ведь фонари LED LENSER SEO разнообразные и неповторимые – каждый найдёт подходящий цвет и необходимый набор функций.', NULL, 'img/tovari/11656383_1__3.jpg', NULL),
(23, 'Метеостанция La Crosse WS6825-BLA', 16, 30, 670, 750, 'Домашняя метеостанция La Crosse модели WS6825-BLA является незаменимым источником информации погодных условий. Она может информировать об погодных условиях, предоставлять прогнозы на ближайшие сутки. Этот компактный метеоролог можно размещать в любом удобном месте в комнате, что позволит узнавать информацию, не выглядывая за окно. Незаменимый помощник тому кругу людей, чья работа зависит исключительно от погоды.', NULL, 'img/tovari/184965.jpg', NULL),
(24, 'Планшет Samsung Galaxy Tab E 9.6"', 13, 43, 4590, 5569, 'Samsung Samsung Galaxy Tab E 9.6" 8Gb 3G Gold Brown (SM-T561NZNASEK) это гармоничное сочетание производительности и стиля. Корпус устройства выполнен в современном лаконичном дизайне и имеет скругленные очертания. Обладая тонкой рамкой и небольшим весом, он не утомляет ваших рук при долгой эксплуатации. К тому же задняя панель выполнена из качественного пластика с рельефной текстурой, обеспечивающего надежное размещение в ладони. Рациональный вариант для активных людей.', NULL, 'img/tovari/06_sm-t560_front_brown_standard_online_s_1_.jpg', NULL),
(25, 'ЧАСЫ ORIENT FEU00000DW', 17, 28, 2900, 3300, 'Мужские часы Orient FEU00000DW купить в Киеве с официальной гарантией и доставкой по Украине.\r\nНазвание - Orient FEU00000DW. Код товара: FEU00000DW. Уникальные наручные часы японской марки Orient - это прекрасный выбор для тех кто ценит надежность и технологичность часов. Корпус изготовлен из качественной нержавеющей стали. Официальная гарантия 1 год. Механические часы Orient с автоподзаводом - заводятся от колебаний маятника при движении руки. Допустимая точность хода -15+25 сек/сутки. Не требуют ручного завода. \r\nМужские часы неотъемлемый элемент гардероба. Они не только подсказывают время, но и подчеркивают стиль. Минеральное стекло достаточно устойчиво к царапинам, потертостям и к ударам. Защита от воды 50 метров позволяет принимать душ и мыть руки не снимая часы.\r\nДополнительные функции (усложнения механизма):\r\nОтображение дня недели, числа, месяца. \r\nБраслет из нержавеющей стали подойдёт под любой стиль одежды и жизни, он очень универсальный и практичный.', NULL, 'img/tovari/feu00000dw_1.jpg', NULL),
(26, 'ASUS VivoBook Max X541', 13, 10, 6500, 7900, 'ASUS VivoBook Max X541. Великолепный звук. Взрывная сила.\r\nНоутбук ASUS серии VivoBook X отличается великолепными мультимедийными возможностями. Оснащенные мощным процессором Intel, он справится с самыми ресурсоемкими задачами. Эксклюзивная аудиотехнология SonicMaster с программными средствами ICEpower обеспечивает беспрецедентное для мобильных компьютеров качество звучания.', NULL, 'img/tovari/asus_x541sa_xo041d_images_1741081619.jpg', NULL),
(27, 'Багги 1:10 Himoto Dirt Whip E10DBL Brushless', 22, 45, 6500, 7900, 'Мощная багги 1:10 Himoto Dirt Whip E10DBL Brushless проедет по любой поверхности, оставив своих соперников далеко позади. Если ребёнок мечтает выходить из любой гонки победителем, под восторженные взгляды друзей, то Dirt Whip E10DBL Brushless – это как раз то, что надо. Эта машинка завораживает с первого взгляда благодаря своему крутому оригинальному дизайну. У неё очень прочный корпус, поэтому ей не страшны удары. Забудьте о заездах на ровных асфальтированных дорожках, ведь это так скучно! Эта багги может проехать по грязи и воде, миновать ямки и кочки. \r\nПитается она от аккумулятора Ni-Mh 7.2V 2000 mAh, а работает на частоте 2,4 Ггц, защищённой от помех. У неё бесколлекторный двигатель и маслонаполненные амортизаторы. Эта супер скоростная игрушка сможет разогнаться до 60 километров в час. \r\nКомплектация: багги, пульт управлени, аккумулято, зарядное устройство, инструкция по эксплуатации. Для пульта надо будет дополнительно приобрести четыре батарейки АА.\r\nВозраст: 10+\r\nРазмер: 40,9х25,6х13,9 сантиметров\r\nПр', NULL, 'img/tovari/44a1555b7cbd73aaa5f18b5e8bf82158_enl.jpg', NULL),
(28, 'Meizu M3 Note 16GB Grey', 13, 9, 3200, 4000, 'Meizu M3 Note 16GB Grey (Международная версия)\r\n\r\nПрошивка: Flyme 5.1.3.2G. Модель: 681H\r\n\r\nКомпания Meizu представила первый смартфон из новой линейки устройств 2016 года – металлический Meizu M3 Note. Новинка стала обновлением невероятно успешного Meizu M2 Note и получила значительные улучшения!', NULL, 'img/tovari/copy_meizu_m3_note_m681_3_32gb_gr_not_576d1c85149af_images_1650138508.jpg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `customerid` int(11) DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `datein` date DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `ordername` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL,
  `role` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `role`) VALUES
(1, 'admin'),
(2, 'customer');

-- --------------------------------------------------------

--
-- Структура таблицы `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL,
  `customername` varchar(32) DEFAULT NULL,
  `itemname` varchar(128) DEFAULT NULL,
  `pricein` int(11) DEFAULT NULL,
  `pricesale` int(11) DEFAULT NULL,
  `datesale` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `sales`
--

INSERT INTO `sales` (`id`, `customername`, `itemname`, `pricein`, `pricesale`, `datesale`) VALUES
(5, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 12:59:26'),
(6, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 12:59:41'),
(7, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 12:59:44'),
(8, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:01:45'),
(9, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:02:08'),
(10, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:03:53'),
(11, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:03:56'),
(12, 'cart', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:05:24'),
(13, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:37:00'),
(14, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:37:00'),
(15, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:38:48'),
(16, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:38:48'),
(17, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:43:21'),
(18, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:43:21'),
(19, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:43:25'),
(20, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:43:25'),
(21, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:44:03'),
(22, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:44:03'),
(23, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:44:05'),
(24, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:44:05'),
(25, 'admin', 'Фонарь Led Lenser Seo 3', 780, 930, '2016-12-10 13:45:39'),
(26, 'admin', 'Метеостанция La Crosse WS6825-BLA', 670, 750, '2016-12-10 13:45:39');

-- --------------------------------------------------------

--
-- Структура таблицы `subcategories`
--

CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL,
  `subcategory` varchar(64) NOT NULL,
  `catid` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subcategories`
--

INSERT INTO `subcategories` (`id`, `subcategory`, `catid`) VALUES
(7, 'Холодильники', 13),
(8, 'Телевизоры', 13),
(9, 'Телефоны', 13),
(10, 'Ноутбуки', 13),
(11, 'Кольца', 18),
(12, 'Сережки', 18),
(13, 'Браслеты', 18),
(14, 'Крема', 14),
(15, 'Шампуни', 14),
(16, 'Мыло', 14),
(17, 'Пудра', 14),
(18, 'Вело', 16),
(19, 'Единоборства', 16),
(20, 'Плавание', 16),
(21, 'Теннис', 16),
(22, 'Гимнастика', 16),
(23, 'Порошки', 15),
(24, 'Моющие средства', 15),
(25, 'Наручные', 17),
(26, 'Спортивные', 17),
(27, 'Классика', 17),
(28, 'Мужские', 17),
(29, 'Женские', 17),
(30, 'Туризм', 16),
(31, 'Помада', 14),
(32, 'Кроссовки', 20),
(33, 'Туфли', 20),
(39, 'Макасины', 20),
(40, 'Шорты', 19),
(41, 'Джинсы', 19),
(42, 'Духи', 14),
(43, 'Планшеты', 13),
(44, 'Мягкие', 22),
(45, 'На радиоуправлении', 22);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category` (`category`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `roleid` (`roleid`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `catid` (`catid`),
  ADD KEY `subid` (`subid`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customerid` (`customerid`),
  ADD KEY `itemid` (`itemid`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role` (`role`);

--
-- Индексы таблицы `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subcategory` (`subcategory`),
  ADD KEY `catid` (`catid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT для таблицы `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT для таблицы `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `roles` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `items_ibfk_2` FOREIGN KEY (`subid`) REFERENCES `subcategories` (`id`) ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerid`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`itemid`) REFERENCES `items` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `subcategories`
--
ALTER TABLE `subcategories`
  ADD CONSTRAINT `subcategories_ibfk_1` FOREIGN KEY (`catid`) REFERENCES `categories` (`id`) ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
