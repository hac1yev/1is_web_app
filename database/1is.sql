-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 14, 2023 at 10:42 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u983993164_1is`
--

-- --------------------------------------------------------

--
-- Table structure for table `accept_type`
--

CREATE TABLE `accept_type` (
  `id` int(11) NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `accept_type`
--

INSERT INTO `accept_type` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Elektron Poçt vasitəsilə ', 'Via Email', 'По электронной почте', 'E-posta yoluyla', 'elektron-poct-vasitesile', '1', '2023-02-03 09:11:05', '2023-02-03 09:11:05'),
(2, '1iş.az üzərindən', 'via 1ish.az', 'через 1ish.az', '1ish.az aracılığıyla', '1isaz-uzerinden', '1', '2023-02-03 09:11:21', '2023-06-27 17:59:06'),
(3, 'Keçid Linki', 'Transition Link', 'Ссылка на переход', 'Geçiş Bağlantısı', 'kecid-linki', '1', '2023-02-03 09:11:43', '2023-06-27 17:58:54');

-- --------------------------------------------------------

--
-- Table structure for table `adverts`
--

CREATE TABLE `adverts` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `redirect_link` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `adverts`
--

INSERT INTO `adverts` (`id`, `image`, `redirect_link`, `status`, `created_at`, `updated_at`) VALUES
(3, 'back/assets/images/adverts/advert_ej5KzI.png', 'https://1is.butagrup.az/back/assets/images/logos/favicon_kPZKOx.png', '1', '2023-07-13 05:04:22', '2023-07-13 05:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `banner_image`
--

CREATE TABLE `banner_image` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `banner_image`
--

INSERT INTO `banner_image` (`id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 'back/assets/images/banner/banner_1NJHsP.jpg', '1', '2023-03-10 06:52:12', '2023-06-23 07:39:13');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content_az` longtext NOT NULL,
  `content_en` longtext NOT NULL,
  `content_ru` longtext NOT NULL,
  `content_tr` longtext NOT NULL,
  `keywords_az` varchar(500) NOT NULL,
  `keywords_en` varchar(500) NOT NULL,
  `keywords_ru` varchar(500) NOT NULL,
  `keywords_tr` varchar(500) NOT NULL,
  `image` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `cv` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `vacancy_id` bigint(20) DEFAULT NULL,
  `user_id` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `icon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Maliyyə və mühasibatlıq', 'Finance and accounting', 'Финансы и учет', 'Finans ve muhasebe', 'maliyye-ve-muhasibatliq', 'fa fa-calculator', '1', '2023-01-11 05:38:50', '2023-06-20 12:20:52'),
(11, 'Marketinq, reklam, çap, nəşriyyat', 'Marketing, advertising, printing, publishing', 'Маркетинг, реклама, полиграфия, издательское дело', 'Pazarlama, reklam, basım, yayıncılık', 'marketinq-reklam-cap-nesriyyat', 'fa fa-bullhorn', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(21, 'İnformasiya texnologiyaları və proqramlaşdırma', 'Information technologies and programming', 'Информационные технологии и программирование', 'Bilişim teknolojileri ve programlama', 'informasiya-texnologiyalari-ve-proqramlasdirma', 'fa fa-code', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(22, 'Mühəndislik', 'Engineering', 'Инжиниринг', 'Mühendislik', 'muhendislik', 'fa fa-wrench', '1', '2023-01-11 05:38:50', '2023-01-12 06:58:44'),
(31, 'Data Analitika', 'Data Analytics', 'Аналитика данных', 'Veri analizi', 'data-analitika', 'fa fa-line-chart', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(34, 'İnzibati, biznes və idarəetmə', 'Administrative, business and management', 'Административный, бизнес и менеджмент', 'İdari, iş ve yönetim', 'inzibati-biznes-ve-idareetme', 'fa fa-briefcase', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(40, 'Pərakəndə satış və müştəri xidmətləri', 'Retail sales and customer service', 'Розничные продажи и обслуживание клиентов', 'Perakende satış ve müşteri hizmetleri', 'perakende-satis-ve-musteri-xidmetleri', 'fa fa-shopping-cart', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(44, 'Xidmət sahəsi', 'Service area', 'Зона обслуживания', 'Hizmet alanı', 'xidmet-sahesi', 'fa fa-glass', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(50, 'Turizm, otel, restoran', 'Tourism, hotel, restaurant', 'Туризм, гостиница, ресторан', 'Turizm, otel, restoran', 'turizm-otel-restoran', 'fa fa-cutlery', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(52, 'Logistika, nəqliyyat', 'Logistics, transport', 'Логистика, транспорт', 'Lojistik, ulaşım', 'logistika-neqliyyat', 'fa fa-truck', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(56, 'Hüquq və məhkəmə', 'Law and court', 'Закон и суд', 'Hukuk ve mahkeme', 'huquq-ve-mehkeme', 'fa fa-gavel', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(60, 'Səhiyyə', 'Healthcare', 'Здравоохранение', 'Sağlık hizmeti', 'sehiyye', 'fa fa-medkit', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(64, 'Təhsil və elm', 'Education and science', 'Образование и наука', 'Eğitim ve bilim', 'tehsil-ve-elm', 'fa fa-university', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(75, 'Sənaye və kənd təsərrüfatı', 'Industry and agriculture', 'Промышленность и сельское хозяйство', 'Sanayi ve tarım', 'senaye-ve-kend-teserrufati', 'fa fa-leaf', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(81, 'Tikinti və inşaat', 'Construction', 'Строительство', 'İnşaat', 'tikinti-ve-insaat', 'fa fa-building', '1', '2023-01-11 05:38:50', '2023-07-07 08:47:50'),
(86, 'Dizayn, incəsənət', 'Design, art', 'Дизайн, искусство', 'Tasarım, sanat', 'dizayn-incesenet', 'fa fa-paint-brush', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(94, 'Müxtəlif', 'Various', 'Различный', 'Çeşitli', 'muxtelif', 'fa fa-random', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(95, 'Media', 'Media', 'СМИ', 'Medya', 'media', 'fa fa-newspaper-o', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(96, 'Təcrübə proqramı', 'Internship program', 'Программа интернатуры', 'Staj programı', 'tecrube-proqrami', 'fa fa-suitcase', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(100, 'Sığorta', 'Insurance', 'Страхование', 'Sigorta', 'sigorta', 'fa fa-life-ring', '1', '2023-01-11 05:38:50', '2023-01-11 05:38:50'),
(101, 'İnsan resursları', 'Human resources', 'Человеческие ресурсы', 'İnsan kaynakları', 'insan-resurslari', 'fa fa-users', '1', '2023-01-11 05:38:50', '2023-06-27 17:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Bakı', 'Baku', 'Баку', 'Bakü', 'baki', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(2, 'Xırdalan', 'Xırdalan', 'Xırdalan', 'Xırdalan', 'xirdalan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(3, 'Sumqayıt', 'Sumgait', 'Сумгаит', 'Sumgait', 'sumqayit', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(4, 'Gəncə', 'Ganja', 'Гянджа', 'Gence', 'gence', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(5, 'Mingəçevir', 'Mingachevir', 'Мингячевир', 'Mingeçevir', 'mingecevir', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(6, 'Naxçıvan', 'Nakhchivan', 'Нахчыван', 'Nahçıvan', 'naxcivan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(7, 'Ağcabədi', 'Agjabadi', 'Агджабеди', 'Ağcabadi', 'agcabedi', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(8, 'Ağdam', 'Aghdam', 'Агдам', 'Ağdam', 'agdam', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(9, 'Ağdaş', 'Agdash', 'Агдаш', 'Ağdaş', 'agdas', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(10, 'Ağstafa', 'Agstafa', 'Агстафа', 'Ağstafa', 'agstafa', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(11, 'Ağsu', 'Ağsu', 'Ağsu', 'Ağsu', 'agsu', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(12, 'Astara', 'Astara', 'Astara', 'Astara', 'astara', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(13, 'Balakən', 'Balakan', 'Балакан', 'Balakan', 'balaken', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(14, 'Beyləqan', 'Beylagan', 'Бейлаган', 'Beylagan', 'beyleqan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(15, 'Bərdə', 'Barda', 'Барда', 'Barda', 'berde', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(16, 'Biləsuvar', 'Bilasuvar', 'Билясувар', 'Bilasuvar', 'bilesuvar', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(17, 'Cəbrayıl', 'Gabriel', 'Габриэль', 'Cebrail', 'cebrayil', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(18, 'Cəlilabad', 'Jalilabad', 'Джалилабад', 'Celilabad', 'celilabad', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(19, 'Culfa', 'Julfa', 'Джульфа', 'Culfa', 'culfa', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(20, 'Daşkəsən', 'Dashkasan', 'Дашкасан', 'Daşkasan', 'daskesen', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(21, 'Füzuli', 'Fuzuli', 'Физули', 'Fuzuli', 'fuzuli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(22, 'Gədəbəy', 'Gadabay', 'Кедабек', 'Gadabay', 'gedebey', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(23, 'Goranboy', 'Goranboy', 'Геранбой', 'Goranboy', 'goranboy', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(24, 'Göyçay', 'Goychay', 'Гейчай', 'Göyçay', 'goycay', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(25, 'Göygöl', 'Goygol', 'Гёйгёль', 'Göygöl', 'goygol', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(26, 'Hacıqabul', 'Hacıgabul', 'Гаджигабул', 'Hacıqabul', 'haciqabul', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(27, 'Hadrut', 'Hadrut', 'Гадрут', 'Hadrut', 'hadrut', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(29, 'Xaçmaz', 'Xaçmaz', 'Xaçmaz', 'Xaçmaz', 'xacmaz', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(30, 'Xankəndi', 'Khankendi', 'Ханкенди', 'Hankendi', 'xankendi', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(31, 'Xızı', 'Xızı', 'Xızı', 'Xızı', 'xizi', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(32, 'Xocalı', 'Khojaly', 'Ходжалы', 'Hocalı', 'xocali', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(33, 'Xocavənd', 'Khojavand', 'Ходжавенд', 'Hocavend', 'xocavend', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(34, 'İmişli', 'Imishli', 'Имишли', 'İmişli', 'imisli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(35, 'İsmayıllı', 'İsmayıllı', 'İsmayıllı', 'İsmayıllı', 'ismayilli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(36, 'Kəlbəcər', 'Kalbajar', 'Кельбаджар', 'Kelbecer', 'kelbecer', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(37, 'Kürdəmir', 'Kurdamir', 'Кюрдамир', 'Kürdemir', 'kurdemir', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(38, 'Qax', 'Qax', 'Qax', 'Qax', 'qax', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(39, 'Qazax', 'Qazax', 'Qazax', 'Qazax', 'qazax', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(40, 'Qəbələ', 'Gabala', 'Габала', 'Kebele', 'qebele', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(41, 'Qobustan', 'Gobustan', 'Гобустан', 'Kobustan', 'qobustan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(42, 'Quba', 'Guba', 'Губа', 'Guba', 'quba', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(43, 'Qubadlı', 'Gubadli', 'Губадлы', 'Gubadlı', 'qubadli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(44, 'Qusar', 'Qusar', 'Qusar', 'Qusar', 'qusar', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(45, 'Laçın', 'Lachin', 'Лачин', 'Laçin', 'lacin', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(46, 'Lerik', 'Lerik', 'Лерик', 'Lerik', 'lerik', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(47, 'Lənkəran', 'Lankaran', 'Ленкорань', 'Lenkeran', 'lenkeran', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(48, 'Masallı', 'Masallı', 'Masallı', 'Masallı', 'masalli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(49, 'Naftalan', 'Naftalan', 'Naftalan', 'Naftalan', 'naftalan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(50, 'Neftçala', 'Neftchala', 'Нефтчала', 'Neftçala', 'neftcala', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(51, 'Oğuz', 'Oguz', 'Огуз', 'Oğuz', 'oguz', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(52, 'Ordubad', 'Ordubad', 'Ордубад', 'Ordubad', 'ordubad', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(53, 'Saatlı', 'Saatlı', 'Saatlı', 'Saatlı', 'saatli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(54, 'Sabirabad', 'Sabirabad', 'Сабирабад', 'Sabirabad', 'sabirabad', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(55, 'Salyan', 'Salyan', 'Сальян', 'Salyan', 'salyan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(56, 'Samux', 'Samux', 'Самукс', 'Samux', 'samux', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(57, 'Siyəzən', 'Siyazan', 'Сиазань', 'Siyazan', 'siyezen', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(58, 'Şabran', 'Shabran', 'Шабран', 'Şabran', 'sabran', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(59, 'Şahbuz', 'Shahbuz', 'Шахбуз', 'Şahbuz', 'sahbuz', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(60, 'Şamaxı', 'Shamakhi', 'Шамаха', 'Şamahı', 'samaxi', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(61, 'Şəki', 'Sheki', 'Шеки', 'Şeki', 'seki', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(62, 'Şəmkir', 'Shamkir', 'Шамкир', 'Şemkir', 'semkir', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(63, 'Şərur', 'Sharur', 'Шарур', 'Şarur', 'serur', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(64, 'Şirvan', 'Shirvan', 'Ширван', 'Şirvan', 'sirvan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(65, 'Şuşa', 'Shusha', 'Шуша', 'Şuşa', 'susa', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(66, 'Tərtər', 'Tərtər', 'Tərtər', 'Tərtər', 'terter', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(67, 'Tovuz', 'Tovuz', 'Tovuz', 'Tovuz', 'tovuz', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(68, 'Ucar', 'Ucar', 'Ucar', 'Ucar', 'ucar', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(69, 'Yardımlı', 'Yardımlı', 'Yardımlı', 'Yardımlı', 'yardimli', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(70, 'Yevlax', 'Yevlakh', 'Евлах', 'Yevlah', 'yevlax', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(71, 'Zaqatala', 'Zagatala', 'Загатала', 'Zakatala', 'zaqatala', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(72, 'Zəngilan', 'Zəngilan', 'Zəngilan', 'Zəngilan', 'zengilan', '1', '2023-01-11 06:07:01', '2023-01-11 06:07:01'),
(73, 'Zərdab', 'Zərdab', 'Zərdab', 'Zərdab', 'zerdab', '1', '2023-01-11 06:07:01', '2023-06-27 17:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `sector_id` int(11) NOT NULL,
  `average` int(11) DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `about` text NOT NULL,
  `hr` text DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `map` text NOT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `vacanc_say` int(20) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_info`
--

CREATE TABLE `contact_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address_az` varchar(255) NOT NULL,
  `address_en` varchar(255) NOT NULL,
  `address_ru` varchar(255) NOT NULL,
  `address_tr` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `contact_info`
--

INSERT INTO `contact_info` (`id`, `phone`, `email`, `address_az`, `address_en`, `address_ru`, `address_tr`, `status`, `created_at`, `updated_at`) VALUES
(1, '+994 (12) 564 76 60', 'info@butagrup.com.tr45', 'Oktay Kərimov 44, Nərimanov rayonu, Bakı', 'Oktay Karimov 44, Narimanov district, Baku.', 'Октай Керимов 44, Наримановский район, Баку.', 'Oktay Kerimov 44, Nerimanov ilçesi, Bakü.', '1', '2023-01-10 12:27:52', '2023-06-25 08:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `education_id` int(11) DEFAULT NULL,
  `experience_id` int(11) DEFAULT NULL,
  `job_type_id` int(11) DEFAULT NULL,
  `gender_id` int(11) DEFAULT NULL,
  `name` varchar(2555) DEFAULT NULL,
  `surname` varchar(2555) DEFAULT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `about_education` longtext DEFAULT NULL,
  `salary` varchar(25) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `work_history` longtext DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `contact_mail` varchar(50) DEFAULT NULL,
  `contact_phone` varchar(50) DEFAULT NULL,
  `cv` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `portfolio` longtext DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `educations`
--

CREATE TABLE `educations` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `educations`
--

INSERT INTO `educations` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Orta təhsil', 'Secondary education', 'Среднее образование', 'Orta öğretim', 'orta-tehsil', '1', '2023-01-11 06:12:35', '2023-01-11 06:12:35'),
(2, 'Bakalavr', 'Bachelors', 'Бакалавры', 'Lisans', 'bakalavr', '1', '2023-01-11 06:12:35', '2023-01-11 06:12:35'),
(3, 'Magistr', 'Master', 'Mагистра', 'Yüksek lisans', 'magistr', '1', '2023-01-11 06:12:35', '2023-01-13 06:05:48'),
(4, 'Doktorantura', 'Doctorate', 'Докторантура', 'Doktora', 'doktorantura', '1', '2023-01-11 06:12:35', '2023-06-27 17:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `experiences`
--

CREATE TABLE `experiences` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `experiences`
--

INSERT INTO `experiences` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, '1 ildən az', 'Less than 1 year', 'Менее 1 года', '1 yıldan daha az', '1-ilden-az', '1', '2023-01-11 06:22:31', '2023-01-11 06:22:31'),
(2, '1 ildən 3 ilə', 'From 1 year to 3 years', 'От 1 года до 3 лет', '1 yıldan 3 yıla kadar', '1-ilden-3-ile', '1', '2023-01-11 06:22:31', '2023-01-11 06:22:31'),
(3, '3 ildən 5 ilə', '3 to 5 years', 'от 3 до 5 лет', '3 ila 5 yıl', '3-ilden-5-ile', '1', '2023-01-11 06:22:31', '2023-01-13 06:54:37'),
(4, '5 ildən çox', 'More than 5 years', 'Более 5 лет', '5 yıldan fazla', '5-ilden-cox', '1', '2023-01-11 06:22:31', '2023-06-27 17:54:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `favorits`
--

CREATE TABLE `favorits` (
  `id` int(11) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `vacancy_id` bigint(20) DEFAULT NULL,
  `cv_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Qadın', 'Woman', 'Женщинa', 'Kadın', 'qadin', '1', '2023-02-06 09:41:04', '2023-02-06 09:41:04'),
(2, 'Kişi', 'Man', 'Мужской', 'Erkek', 'kisi', '1', '2023-02-06 09:41:34', '2023-07-12 06:16:10');

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tam iş vaxtı', 'Full time', 'На постоянной основе', 'Tam zamanlı', 'tam-is-vaxti', '1', '2023-02-03 08:12:08', '2023-02-03 08:12:08'),
(2, 'Natamam iş vaxtı', 'Part time work', 'Неполный рабочий день', 'Yarı zamanlı iş', 'natamam-is-vaxti', '1', '2023-02-03 08:12:08', '2023-02-07 12:10:47'),
(3, 'Qısaldılmış iş vaxtı', 'Shortened working hours', 'Сокращенный рабочий день', 'Kısaltılmış çalışma saatleri', 'qisaldilmis-is-vaxti', '1', '2023-02-03 08:12:08', '2023-02-03 08:12:08'),
(4, 'Sərbəst', 'Free', 'Бесплатно', 'Özgür', 'serbest', '1', '2023-02-03 08:12:08', '2023-06-27 18:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(10) UNSIGNED NOT NULL,
  `fullname` varchar(15) NOT NULL,
  `shortname` varchar(3) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `fullname`, `shortname`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Azerbaijan', 'az', '1', '2023-01-10 12:22:36', '2023-01-10 12:22:36'),
(2, 'English', 'en', '1', '2023-01-10 12:22:36', '2023-01-10 12:22:36'),
(3, 'Russian', 'ru', '1', '2023-01-10 12:22:56', '2023-01-10 12:22:56'),
(4, 'Turkish', 'tr', '1', '2023-01-10 12:22:56', '2023-01-10 12:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `login_images`
--

CREATE TABLE `login_images` (
  `id` int(10) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `newslatter`
--

CREATE TABLE `newslatter` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_az` text NOT NULL,
  `content_en` text NOT NULL,
  `content_ru` text NOT NULL,
  `content_tr` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`id`, `content_az`, `content_en`, `content_ru`, `content_tr`, `status`, `created_at`, `updated_at`) VALUES
(2, '1. Razılaşmanın tərəfləri – \"Buta Grup\" Azərbaycan (1iş.az) və istifadəçilərdir.<br/>\r\n\r\n2. Razılaşma \"1iş.az\" xidmətinin istifadəçiləri tərəfindən istifadə şərtlərini müəyyən edir.<br/>\r\n3. İstifadəçi razılaşması aşağıda göstərilən hallarda tətbiq ediləcək: - Servis-İnternet şəbəkəsində, 1iş.az ünvanında yerləşdirilmiş məlumatlar Buta Grup Azərbaycan və istifadəçilər (razılaşma şərtlərini qəbul etmiş şəxslər) tərəfindən yerləşdirilmiş informasiyalardır. - Şəxsi kabinet - bu istifadəçilər tərəfindən yaradılmış və şəxsi informasiyaların (məlumatların) əlavə edilmiş məcmusudur. Hər hansı bir istifadəçinin yalnız bir şəxsi kabinetə malik olmaq hüququ vardır. - Servis xidmətlərindən və materiallarından istifadə edilmə qüvvədə olan qanunvericiliyin normaları, həmçinin də hazırkı razılaşma ilə tənzimlənir.<br/>\r\n4. Servis xidmətlərindən istifadə edərək, istifadəçi hazırkı razılaşmanı və servis xidmətlərindən istifadə üzrə təlimatlara riayət etmək şərtlərini və öhdəliklərini qəbul edir. - Buta Grup Azərbaycan istənilən vaxt birtərəfli qaydada hazırkı razılaşmanın şərtlərini dəyişdirmək hüququna malikdir. - İstifadəçi razılaşmanın şərtlərinə edilmiş dəyişikliklərlə razılaşmadığı halda o servisə girişdən imtina etməli və xidmətlərindən istifadəni dayandırmalıdır.<br/>\r\n5. 1iş.az istifadəçilərə servis xidmətlərindən istifadə və elanların yerləşdirilməsi, eləcə də axtarışı üzrə xidmətləri təklif edir.<br/>\r\n6. Digər xidmətlərin verilməsi xüsusi qaydalarla və/və ya razılaşmalarla tənzimlənə bilər. - Servisin bütün materialları və xidmətləri reklamla müşayiət oluna bilər. İstifadəçi bunu əvvəlcədən qəbul edir.<br/>\r\n7. İstifadəçi öz şifrəsini gizli saxlamağı öhdəsinə götürür. İstifadəçi öz elektron poçt ünvanından və şifrədən istifadə ilə bağlı əməliyyatlara, həmçinin də istifadəçinin şəxsi kabinetində yerinə yetirilən fəaliyyətlərə görə məsuliyyət daşıyır. İstifadəçi servis xidmətlərindən yalnız öz şəxsi elektron poçt ünvanı və şifrə ilə daxil olub istifadə etmək hüququna malikdir. Əgər istifadəçi şəxsi kabinetinə icazəsiz daxil olma halları ilə qarşılaşarsa, öz parolunu sərbəst dəyişməyi öhdəsinə götürür.<br/>\r\n8. 1iş.az istifadəçilərin servisdə qeydiyyat zamanı təqdim etdiyi məlumatların həqiqətən təqdim edildiyi kimi doğruluğuna görə məsuliyyət daşımır.<br/>\r\n9. İstifadəçi tərəfindən başqa şəxslərin hüquqlarının və ya qüvvədə olan qanunvericiliyin pozulması halında, həmçinin başqa səbəblərdən, servis istifadəçi girişini məhdudlaşdırmaq və ya dayandırmaq hüququna malikdir.<br/>\r\n10. 1iş.az istifadəçilərin tamamlanmayan informasiya və etibarsız məlumatlarını xüsusi icazə olmadan sistemdən silmək hüququna malikdir.<br/>', '1. The parties to the agreement – Buta Grup Azərbaycan (1iş.az) and users.<br/>\r\n\r\n2. The agreement defines the terms of use by users of 1iş.az service.<br/>\r\n\r\n3. The user agreement will be applied in the following cases:<br/>\r\n\r\n- The information posted on the service-internet network, at 1iş.az, is the information posted by Buta Group Azerbaijan and the users (persons who have accepted the terms of the agreement) .<br/>\r\n\r\n- Personal cabinet - this is a set of personal information (data) created by users. Any user has the right to have only one personal cabinet.<br/>\r\n\r\n-Use of the services and materials is subject to applicable law and this agreement.<br/>\r\n\r\n4. By using the services, the user accepts the terms and obligations to comply with this agreement and the instructions for use of the services.<br/>\r\n\r\n- Buta Group Azerbaijan reserves the right to unilaterally change the terms of this agreement at any time.<br/>\r\n\r\n- If the user does not agree with the changes to the terms of the agreement, he / she must refuse access to the service and stop using its services.<br/>\r\n\r\n5. 1iş.az provides users with the use of the service and the placement of advertisements, as well as search services.<br/>\r\n\r\n6. The provision of other services may be subject to certain rules and/or agreements.<br/>\r\n\r\n- All materials and services of 1iş.az may be accompanied by advertising. The user accepts this in advance.<br/>\r\n\r\n7. The user undertakes to keep his / her password confidential. The user is responsible for transactions related to the use of his e-mail address and password, as well as for activities carried out in the user\'s personal cabinet. The user has the right to access and use the services only with his / her personal e-mail address and password. If the user encounters unauthorized access to the personal cabinet, he / she undertakes to freely change his / her password.<br/>\r\n\r\n8. 1iş.az is not responsible for the accuracy of the information provided by users during registration in the 1iş.az.<br/>\r\n\r\n9. 1iş.az the right to restrict or suspend the user\'s access if the user violates the rights of other persons or applicable legislation, as well as for other reasons.<br/>\r\n\r\n10. 1iş.az reserves the right to delete incomplete and invalid information of users from the system without special permission.<br/>', '1. Сторонами соглашения являются Buta Group Azerbaijan (1iş.az) и пользователи.<br/>\r\n\r\n2. определяет условия использования пользователями сервиса.<br/>\r\n\r\n3. Пользовательское соглашение применяется в следующих случаях:<br/>\r\n\r\n- В служебно-интернет-сети,, 1iş.az размещено в информация Buta Group Azerbaijan и пользователи (лица, принявшие условия соглашения) информацию разместил .<br/>\r\n\r\n- Личный кабинет - это совокупность личной информации (данных), созданная пользователями. является добавленным агрегатом. Наличие только одного личного кабинета любого пользователя имеет право.<br/>\r\n\r\n- Использование услуг и материалов регулируется применимым законодательством нормы также регулируются настоящим Соглашением.<br/>\r\n\r\n4. Используя Услуги, Пользователь соглашается с настоящим cоглашением и yслугами. принимает условия и обязательства по соблюдению инструкций по использованию.<br/>\r\n\r\n \r\n-Buta Group Azerbaijan может в одностороннем порядке расторгнуть условия настоящего cоглашения в любое время. имеет право изменить<br/>\r\n\r\n- В случае несогласия Пользователя с изменениями, внесенными в условия Соглашения, он обязан уведомить об этом cервис. отказать в доступе и прекратить пользоваться их услугами<br/>\r\n\r\n5. 1iş.az позволяет пользователям использовать Сервис и размещать рекламу, а также также предлагает услуги поиска.<br/>\r\n\r\n6. Предоставление других услуг может регулироваться конкретными правилами и/или соглашениями.<br/>\r\n\r\n \r\n- Все материалы и услуги сервиса могут сопровождаться рекламой. Пользователь делает это принимает заранее.<br/>\r\n\r\n7. Пользователь обязуется хранить свой пароль в тайне. Пользователь со своего адреса электронной почты и операции, связанные с использованием паролей, а также совершаемые в Личном кабинете Пользователя несет ответственность за выполненные действия. Службы обслуживания пользователей являются вашими собственными имеет право войти в систему и использовать адрес электронной почты и пароль. Если вы частный пользователь обязуется беспрепятственно менять свой пароль в случае несанкционированного доступа в его кабинет берет.<br/>\r\n\r\n8. 1iş.az – это действительно информация, предоставляемая пользователями при регистрации в cервисе. не несет ответственности за ее точность, как указано.<br/>\r\n\r\n9. Нарушение пользователем прав других лиц или применимого законодательства в случае, а также по иным причинам ограничить или приостановить доступ пользователя к cервису имеет право.<br/>\r\n\r\n10. 1iş.az Специальное разрешение на неполную информацию и недостоверную информацию пользователей имеет право удалить из системы без.<br/>', '1. Anlaşmanın tarafları – Buta Grup Azerbaycan (1iş.az) ve kullanıcılar.<br/>\r\n\r\n2. Anlaşma 1iş.az hizmet kullanıcıları tarafından kullanım şartlarını belirler.<br/>\r\n\r\n3. Kullanıcı sözleşmesi aşağıdaki durumlarda geçerli olacaktır:<br/>\r\n\r\n- Hizmet-İnternet ağı olan, 1iş.az adresinde yayınlanan bilgiler Buta Grup Azerbaycan ve kullanıcılar (sözleşme şartlarını kabul etmiş kişiler) tarafından yayınlanan bilgilerdir.<br/>\r\n\r\n- Kişisel hesap - bu, kullanıcılar tarafından oluşturulan bir kişisel bilgi (veri) alanıdır. Herhangi bir kullanıcının yalnızca bir kişisel hesabına sahip olmak hakkı vardır.<br/>\r\n\r\n- Hizmetlerin ve malzemelerin kullanımı geçerli yasalara tabidir, standartlar da bu sözleşme ile düzenlenir.<br/>\r\n\r\n4. Kullanıcı hizmetleri kullanarak, bu sözleşmeye ve hizmetlerin kullanım talimatlarına uyma şartlarını ve yükümlülüklerini kabul eder.<br/>\r\n\r\n \r\n-Buta Grup Azerbaycan bu sözleşmenin şartlarını herhangi bir zamanda tek taraflı olarak değiştirme hakkına sahiptir.<br/>\r\n\r\n- Kullanıcı sözleşme koşullarındaki değişiklikleri kabul etmezse, hizmete erişimi reddetmeli ve hizmetlerini kullanmayı bırakmalıdır.<br/>\r\n\r\n5. 1iş.az, kullanıcılara hizmetin kullanımı ve reklamların yanı sıra arama hizmetlerinin yerleştirilmesini sağlar.<br/>\r\n\r\n6. Diğer hizmetlerin sağlanması belirli kurallara ve/veya anlaşmalara tabi olabilir.<br/>\r\n\r\n \r\n- 1iş.az\'ın tüm materyalleri ve hizmetlerine reklam eşlik edebilir. Kullanıcı bunu peşinen kabul eder.<br/>\r\n\r\n7.Kullanıcı, şifresini gizli tutmayı taahhüt eder. Kullanıcı, e-posta adresi ve şifresinin kullanımı ile ilgili işlemlerden ve kullanıcı\'nın kişisel hesabında gerçekleştirdiği faaliyetlerden sorumludur. Kullanıcı, hizmetlere yalnızca kişisel e-posta adresi ve şifresi ile erişme ve kullanma hakkına sahiptir. Kullanıcı, kişisel hesaba yetkisiz erişimle karşılaşması durumunda, şifresini serbestçe değiştirmeyi taahhüt eder.<br/>\r\n\r\n8. 1iş.az, 1iş.az\'a kayıt sırasında kullanıcılar tarafından sağlanan bilgilerin doğruluğundan sorumlu değildir.<br/>\r\n\r\n9. 1iş.az kullanıcının diğer kişilerin haklarını veya yürürlükteki mevzuatı ve başka nedenlerle ihlal etmesi durumunda, kullanıcının erişimini kısıtlama veya askıya alma hakkına sahiptir.<br/>\r\n\r\n10. 1iş, kullanıcıların eksik ve geçersiz bilgilerini özel izin almadan sistemden silme hakkını saklı tutar.<br/>', '1', '2023-06-23 07:55:40', '2023-06-27 18:08:32');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_com`
--

CREATE TABLE `privacy_com` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_az` text NOT NULL,
  `content_ru` text NOT NULL,
  `content_en` text NOT NULL,
  `content_tr` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `privacy_com`
--

INSERT INTO `privacy_com` (`id`, `content_az`, `content_ru`, `content_en`, `content_tr`, `status`, `created_at`, `updated_at`) VALUES
(3, '1. 1iş.az istifadəçilərə qeydiyyat zamanı əlavə etdikləri elektron poçt ünvanları və ya qeyd olunmuş telefon nömrələrinə qısa mesaj göndərmək hüququna malikdir.<br/>\r\n\r\n2. Əlavə olaraq istifadəçi anlayır, qəbul edir və razılaşır ki, belə məktublar və mesajlar, təkliflər və ya reklam xarakterli mesajlar göndərilə bilər.<br/>\r\n\r\n3. Administrasiya başqa istifadəçilər tərəfindən servisin səhifələrində İstifadəçi tərəfindən yerləşdirilmiş telefon nömrələrindən və elektron poçt ünvanlarından istifadəyə görə məsuliyyət daşımır.<br/>\r\n\r\n4. İstifadəçi təsdiqləyir ki, 1iş.az istifadəçilərə məktub və mesajları göndərmək məqsədi üçün elektron poçt ünvanlarını və telefon nömrələrini üçüncü şəxslərə vermək hüququna malikdir.<br/>\r\n\r\n5. İstifadəçinin administrasiya və ya servis moderatorları ilə əlaqə elektron poçt vasitəsilə həyata keçirilir.<br/>', '1. 1iş.az пользователи имеют право отправить короткое сообщение на адреса электронной почты или номера телефонов, которые они добавили при регистрации.<br/>\r\n2. Кроме того, пользователь понимает, принимает и соглашается с тем, что такие письма и сообщения, предложения или рекламные сообщения могут быть отправлены.<br/>\r\n3. Администрация не несет ответственности за использование номеров телефонов и адресов электронной почты, размещенных пользователем на страницах cервиса, другими пользователями.<br/>\r\n4. Пользователь подтверждает, что рекрутинг.аз имеет право предоставлять адреса электронной почты и номера телефонов третьим лицам с целью отправки писем и сообщений пользователям.<br/>\r\n5. Связь с aдминистрацией пользователя или модераторами cервиса осуществляется посредством электронной почты.\r\n\r\n<br/>', '1. 1iş.az reserves the right to send text messages to users to the e-mail addresses or phone numbers specified during registration.\r\n\r\n<br/>\r\n2. In addition, the user understands, accepts and agrees that such letters and messages, suggestions or advertising messages may be sent.\r\n\r\n<br/>\r\n3. The administration is not responsible for the use by other users of telephone numbers and e-mail addresses posted by the user on the pages of 1iş.az.\r\n\r\n<br/>\r\n4. The user confirms that 1iş.az has the right to provide e-mail addresses and telephone numbers to third parties for the purpose of sending letters and messages to users.\r\n\r\n<br/>\r\n5. Communication with the user\'s administration or service moderators is via e-mail.\r\n\r\n<br/>', '1. 1iş kullanıcılara kayıt sırasında belirtilen e-posta adreslerine veya telefon numaralarına kısa mesaj gönderme hakkını saklı tutar.\r\n\r\n<br/>\r\n2. Ayrıca kullanıcı, bu tür mektup ve mesajların, önerilerin veya reklam mesajlarının gönderilebileceğini anlar ve kabul eder.\r\n\r\n<br/>\r\n\r\n3. Yönetim, kullanıcı tarafından 1iş.az sayfalarında yayınlanan telefon numaralarının ve e-posta adreslerinin diğer kullanıcılar tarafından kullanılmasından sorumlu değildir.\r\n\r\n<br/>\r\n4. Kullanıcı, 1iş\'ın, kullanıcılara mektup ve mesaj göndermek amacıyla üçüncü şahıslara e-posta adresleri ve telefon numaraları verme hakkına sahip olduğunu onaylar.\r\n\r\n<br/>\r\n5. Kullanıcı yönetimi veya hizmet moderatörleri ile iletişim e-posta yoluyla yapılır.\r\n\r\n<br/>', '1', '2023-06-23 07:59:20', '2023-06-26 13:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `privacy_pro`
--

CREATE TABLE `privacy_pro` (
  `id` int(10) UNSIGNED NOT NULL,
  `content_az` text NOT NULL,
  `content_en` text NOT NULL,
  `content_ru` text NOT NULL,
  `content_tr` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `privacy_pro`
--

INSERT INTO `privacy_pro` (`id`, `content_az`, `content_en`, `content_ru`, `content_tr`, `status`, `created_at`, `updated_at`) VALUES
(3, '1. iş.az domen adının və saytın xüsusi sahibkarıdır.<br/>\r\n2. Servisin funksiyalarına əsasən belə lisenziya, istisna olaraq istifadəçiyə servisin xidmətlərindən istifadə imkanının verilməsi və onlardan xeyirlərin alınması üçün nəzərdə tutulmuşdur.<br/>\r\n3. Servisin (1iş.az) surətinin çıxarılması, dəyişdirilməsi qadağan edilir.<br/>', '1. 1iş.az is the exclusive owner of the domain name and the site.<br/>\r\n\r\n2. According to the functions of the service, such a license is solely aimed at allowing the user to use and benefit from the services.<br/>\r\n\r\n3. Copying or modifying the service (1iş.az) is prohibited.<br/>', '1. 1iş.az является эксклюзивным владельцем доменного имени и сайта. <br/>\r\n\r\n2. Исходя из функций cервиса, такая лицензия предназначена исключительно для предоставления пользователю возможности использовать cервисы и получать от них выгоду.<br/>\r\n\r\n3. Копирование или изменение сервиса (1iş.az) запрещено.<br/>', '1. 1iş, alan adının ve sitenin münhasır sahibidir.<br/>\r\n\r\n2. Hizmetin işlevlerine göre, bu tür bir lisans yalnızca kullanıcının hizmetlerden yararlanmasına ve kullanmasına izin vermeyi amaçlar.<br/>\r\n\r\n3. Hizmetin (1iş) kopyalanması veya değiştirilmesi yasaktır.<br/>', '1', '2023-06-26 12:21:26', '2023-06-26 12:21:26');

-- --------------------------------------------------------

--
-- Table structure for table `regions`
--

CREATE TABLE `regions` (
  `id` int(10) UNSIGNED NOT NULL,
  `city_id` int(11) NOT NULL DEFAULT 1,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `regions`
--

INSERT INTO `regions` (`id`, `city_id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'aaaa', 'aaaa', 'aaaa', 'aaaa', 'aaaa', '1', '2023-02-03 09:48:02', '2023-06-27 17:56:37');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `fullname` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `message` text DEFAULT NULL,
  `rating` tinyint(1) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sectors`
--

CREATE TABLE `sectors` (
  `id` int(10) UNSIGNED NOT NULL,
  `title_az` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `title_ru` varchar(255) NOT NULL,
  `title_tr` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `sectors`
--

INSERT INTO `sectors` (`id`, `title_az`, `title_en`, `title_ru`, `title_tr`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Maliyyə, Mühasibatlıq və Audit', 'Finance, Accounting and Auditing', 'Финансы, бухгалтерский учет и аудит', 'Finans, Muhasebe ve Denetim', 'maliyye-muhasibatliq-ve-audit', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(2, 'Dövlət İdarəetməsi və Müdafiə; İcbari Sosial Təminat', 'Public Administration and Defense; Compulsory Social Security', 'государственное управление и оборона; Обязательное социальное обеспечение', 'Kamu Yönetimi ve Savunma; Zorunlu Sosyal Güvenlik', 'dovlet-idareetmesi-ve-mudafie-icbari-sosial-teminat', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(3, 'Səhiyyə, İdman və Sağlamlıq', 'Health, Sports and Wellness', 'Здоровье, спорт и хорошее самочувствие', 'Sağlık, Spor ve Zindelik', 'sehiyye-idman-ve-saglamliq', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(4, 'Topdan və Pərakəndə Ticarət', 'Wholesale and Retail Trade', 'Оптовая и розничная торговля', 'Toptan ve Perakende Ticaret', 'topdan-ve-perakende-ticaret', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(5, 'Bank ', 'Bank ', 'Банк', 'Banka', 'bank', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(6, 'İnformasiya Texnologiyaları', 'Information technologies', 'Информационные технологии', 'Bilişim Teknolojileri', 'informasiya-texnologiyalari', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(7, 'Tikinti', 'Construction', 'Строительство', 'Yapı', 'tikinti', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(8, 'Kənd təsərrüfatı', 'Agriculture', 'Cельское хозяйство', 'Tarım', 'kend-teserrufati', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(9, 'Nəqliyyat və Logistika', 'Transport and Logistics', 'Транспорт и логистика', 'Nakliye ve Lojistik', 'neqliyyat-ve-logistika', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(10, 'Hüquq və Vergi', 'Law and Taxation', 'Закон и налогообложение', 'Hukuk ve Vergilendirme', 'huquq-ve-vergi', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(11, 'Emal Sənayesi', 'Processing industry', 'Обрабатывающая промышленность', 'İşleme endüstrisi', 'emal-senayesi', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(12, 'Ağır sənaye və Metallurgiya', 'Heavy industry and Metallurgy', 'Тяжелая промышленность и металлургия', 'Ağır sanayi ve metalurji', 'agir-senaye-ve-metallurgiya', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(13, 'Turizm və Otelçilik', 'Tourism and Hospitality', 'Туризм и гостеприимство', 'Turizm ve misafirperverlik', 'turizm-ve-otelcilik', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(14, 'Rabitə və Telekommunikasiya', 'Communication and Telecommunications', 'Связь и телекоммуникации', 'İletişim ve Telekomünikasyon', 'rabite-ve-telekommunikasiya', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(15, 'Media', 'Media', 'СМИ', 'Medya', 'media', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(16, 'Mətbəə, Nəşriyyat və Reklam', 'Printing, Publishing and Advertising', 'Полиграфия, издательское дело и реклама', 'Basım, Yayın ve Reklamcılık', 'metbee-nesriyyat-ve-reklam', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(17, 'Qida', 'Food', 'Еда', 'Yiyecek', 'qida', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(18, 'Sığorta', 'Insurance', 'Страхование', 'Sigorta', 'sigorta', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(19, 'Elm və Təhsil', 'Science and Education', 'Наука и образование', 'Bilim ve Eğitim', 'elm-ve-tehsil', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(20, 'Xidmət', 'Service', 'Услуга', 'Hizmet', 'xidmet', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(21, 'Geyim, Gözəllik və Moda', 'Clothing, Beauty and Fashion', 'Одежда, красота и мода', 'Giyim, Güzellik ve Moda', 'geyim-gozellik-ve-moda', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(22, 'Daşınmaz əmlak', 'Real Estate', 'Недвижимость', 'Emlak', 'dasinmaz-emlak', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(23, 'Enerji ', 'Energy', 'Энергия', 'Enerji', 'enerji', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(24, 'Mədənçıxarma Sənayesi', 'Mining Industry', 'Горнодобывающая индустрия', 'Maden endüstrisi', 'medencixarma-senayesi', '1', '2023-01-11 05:45:48', '2023-01-11 05:45:48'),
(25, 'Şirkətlər qrupu', 'Group of companies', 'Группа компаний', 'Şirketler grubu', 'sirketler-qrupu', '1', '2023-01-11 05:45:48', '2023-06-27 17:43:40');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `meta_keywords_az` varchar(500) NOT NULL,
  `meta_keywords_en` varchar(500) NOT NULL,
  `meta_keywords_ru` varchar(500) NOT NULL,
  `meta_keywords_tr` varchar(500) NOT NULL,
  `meta_title_az` varchar(500) NOT NULL,
  `meta_title_en` varchar(500) NOT NULL,
  `meta_title_ru` varchar(500) NOT NULL,
  `meta_title_tr` varchar(500) NOT NULL,
  `meta_description_az` text NOT NULL,
  `meta_description_en` text NOT NULL,
  `meta_description_ru` text NOT NULL,
  `meta_description_tr` text NOT NULL,
  `logo` varchar(255) NOT NULL,
  `favicon` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `meta_keywords_az`, `meta_keywords_en`, `meta_keywords_ru`, `meta_keywords_tr`, `meta_title_az`, `meta_title_en`, `meta_title_ru`, `meta_title_tr`, `meta_description_az`, `meta_description_en`, `meta_description_ru`, `meta_description_tr`, `logo`, `favicon`, `status`, `created_at`, `updated_at`) VALUES
(1, '[{\"value\":\"1is az\"},{\"value\":\"1isaze\"},{\"value\":\"111111\"},{\"value\":\"saaaa\"}]', '[{\"value\":\"1is en\"},{\"value\":\"1isen\"},{\"value\":\"22222\"},{\"value\":\"ssssssss\"}]', '[{\"value\":\"1is ru\"},{\"value\":\"1isru\"},{\"value\":\"333333\"},{\"value\":\"sddddddd\"}]', '[{\"value\":\"44444\"},{\"value\":\"sfffffff\"}]', '1is.az', '1is en', '1is ru', '1is tr', '1is az', '1is en', '1is ru', 'fgdfgdfdfgdfgdfgdfg', 'back/assets/images/logos/logo_Fo6WOO.png', 'back/assets/images/logos/favicon_kPZKOx.png', '1', '2023-01-10 12:07:42', '2023-07-13 12:35:18');

-- --------------------------------------------------------

--
-- Table structure for table `social_media`
--

CREATE TABLE `social_media` (
  `id` int(10) UNSIGNED NOT NULL,
  `facebook` varchar(512) NOT NULL,
  `instagram` varchar(512) NOT NULL,
  `linkedin` varchar(512) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `social_media`
--

INSERT INTO `social_media` (`id`, `facebook`, `instagram`, `linkedin`, `status`, `created_at`, `updated_at`) VALUES
(1, 'https://www.facebook.com/1ish.az/', 'https://www.instagram.com/1is_az/', 'https://www.linkedin.com/company/recruitment-azerbaycan/', '1', '2023-01-10 12:27:42', '2023-06-20 12:18:11');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(10) UNSIGNED NOT NULL,
  `stories` longtext NOT NULL,
  `redirect_link` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `stories`, `redirect_link`, `image`, `status`, `created_at`, `updated_at`) VALUES
(10, 'back/assets/images/stories/story_4yZPf1.png', 'https://1is.butagrup.az/vacancy/1538', 'back/assets/images/stories/story_qxi3Sb.PNG', '1', '2023-06-23 07:47:14', '2023-07-14 05:08:29');

-- --------------------------------------------------------

--
-- Table structure for table `trainings`
--

CREATE TABLE `trainings` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `redirect_link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `payment_type` enum('0','1') NOT NULL,
  `price` int(11) DEFAULT NULL,
  `view` int(11) NOT NULL DEFAULT 0,
  `deadline` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT 'back/assets/images/users/default-user.png',
  `email_verification_code` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cat_id` varchar(255) NOT NULL,
  `google_id` varchar(400) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_admin` enum('0','1') NOT NULL DEFAULT '0',
  `is_superadmin` enum('0','1') NOT NULL DEFAULT '0',
  `status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `village_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `job_type_id` int(11) NOT NULL,
  `experience_id` int(11) NOT NULL,
  `education_id` int(11) NOT NULL,
  `position` varchar(1000) NOT NULL,
  `slug` varchar(1000) NOT NULL,
  `salary_type` enum('0','1') NOT NULL DEFAULT '1',
  `min_salary` int(11) DEFAULT NULL,
  `max_salary` int(11) DEFAULT NULL,
  `min_age` int(11) NOT NULL,
  `max_age` int(11) NOT NULL,
  `requirement` longtext NOT NULL,
  `description` longtext NOT NULL,
  `contact_name` varchar(50) DEFAULT NULL,
  `accept_type` enum('0','1','2') NOT NULL DEFAULT '1',
  `contact_info` varchar(1500) DEFAULT NULL,
  `deadline` date NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `view` int(11) NOT NULL DEFAULT 0,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accept_type`
--
ALTER TABLE `accept_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `adverts`
--
ALTER TABLE `adverts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner_image`
--
ALTER TABLE `banner_image`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vacancy_id` (`vacancy_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_info`
--
ALTER TABLE `contact_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `educations`
--
ALTER TABLE `educations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experiences`
--
ALTER TABLE `experiences`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `favorits`
--
ALTER TABLE `favorits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_favorites_user_id` (`user_id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_images`
--
ALTER TABLE `login_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `newslatter`
--
ALTER TABLE `newslatter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_com`
--
ALTER TABLE `privacy_com`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy_pro`
--
ALTER TABLE `privacy_pro`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sectors`
--
ALTER TABLE `sectors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_media`
--
ALTER TABLE `social_media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trainings`
--
ALTER TABLE `trainings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accept_type`
--
ALTER TABLE `accept_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `adverts`
--
ALTER TABLE `adverts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `banner_image`
--
ALTER TABLE `banner_image`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact_info`
--
ALTER TABLE `contact_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `educations`
--
ALTER TABLE `educations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `experiences`
--
ALTER TABLE `experiences`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `favorits`
--
ALTER TABLE `favorits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gender`
--
ALTER TABLE `gender`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `login_images`
--
ALTER TABLE `login_images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `newslatter`
--
ALTER TABLE `newslatter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `privacy_com`
--
ALTER TABLE `privacy_com`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `privacy_pro`
--
ALTER TABLE `privacy_pro`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sectors`
--
ALTER TABLE `sectors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `social_media`
--
ALTER TABLE `social_media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `trainings`
--
ALTER TABLE `trainings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
