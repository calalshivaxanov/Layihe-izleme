-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 02 May 2022, 22:49:44
-- Sunucu sürümü: 5.6.51
-- PHP Sürümü: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `layiheizleme`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `istifadeciler`
--

CREATE TABLE `istifadeciler` (
  `user_id` int(5) NOT NULL,
  `user_name` varchar(200) DEFAULT NULL,
  `user_mail` varchar(250) DEFAULT NULL,
  `user_password` varchar(250) DEFAULT NULL,
  `user_telefon` varchar(50) DEFAULT NULL,
  `user_unvan` varchar(250) DEFAULT NULL,
  `user_vezife` int(11) DEFAULT NULL,
  `user_logo` varchar(250) DEFAULT NULL,
  `ip_adresi` varchar(300) DEFAULT NULL,
  `session_mail` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `istifadeciler`
--

INSERT INTO `istifadeciler` (`user_id`, `user_name`, `user_mail`, `user_password`, `user_telefon`, `user_unvan`, `user_vezife`, `user_logo`, `ip_adresi`, `session_mail`) VALUES
(1, 'Cəlal Şivəxanov', 'calalshivaxanov@gmail.com', '92049debbe566ca5782a3045cf300a3c', '0507509899', 'CEO | Admin', 1, 'img/576145996720180406_104110.jpg', '127.0.0.1', '64f544fb5101be9ac60eb1f09b1b9dfc');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `layihe`
--

CREATE TABLE `layihe` (
  `layihe_id` int(5) NOT NULL,
  `layihe_basliq` varchar(250) DEFAULT NULL,
  `layihe_haqqinda` text,
  `layihe_teslim_tarixi` varchar(100) DEFAULT NULL,
  `layihe_baslama_tarixi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `layihe_durum` varchar(100) DEFAULT NULL,
  `layihe_tecili` varchar(100) DEFAULT NULL,
  `fayl_yolu` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `layihe`
--

INSERT INTO `layihe` (`layihe_id`, `layihe_basliq`, `layihe_haqqinda`, `layihe_teslim_tarixi`, `layihe_baslama_tarixi`, `layihe_durum`, `layihe_tecili`, `fayl_yolu`) VALUES
(1, 'Bukhur Perfume', '<p>İlk &ouml;ncə Buxur Parfumeriyanın Ətirlərinin siyahısını &ccedil;ıxartmaq, Sonra ən tanınmış ətirlərə postlar hazırlıyıb instagram və tiktok kimi sosial şəbəkələrdə paylaşmaq... Paylaşdıqdan Sonra Reklam bazarını araşdırıb, Bloggerlər və tanınan digər səhifələrdə reklam qiymətlərində razılaşmaq... Eyni zamanda veb saytlarının dizaynını hazır edib, arxa plan kodlarını quraşdırmaq...</p>\r\n', '2021-11-18', '2022-05-02 23:27:06', 'Bitdi', 'Normal', 'dosyalar/2949POST-01.jpg'),
(2, 'Samsung Electronics (Xırdalan)', '<p>Samsung Electronics`in SMM xidmətləri və veb saytlarının hazırlanması.. M&uuml;mk&uuml;n qədər təcili şəkildə</p>\r\n', '2021-09-16', '2022-05-02 23:36:11', 'Bitdi', 'Normal', 'dosyalar/187341indir.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `parametrler`
--

CREATE TABLE `parametrler` (
  `id` int(11) NOT NULL,
  `sayt_basliq` varchar(300) DEFAULT NULL,
  `sayt_aciqlama` varchar(300) DEFAULT NULL,
  `sayt_sahibi` varchar(100) DEFAULT NULL,
  `mail_tesdiqi` int(11) DEFAULT NULL,
  `xeberdarliq_tesdiqi` int(11) DEFAULT NULL,
  `sayt_logo` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `parametrler`
--

INSERT INTO `parametrler` (`id`, `sayt_basliq`, `sayt_aciqlama`, `sayt_sahibi`, `mail_tesdiqi`, `xeberdarliq_tesdiqi`, `sayt_logo`) VALUES
(1, 'Lima Technology - Layihə izləmə', 'Lima Technology - Layihə izləmə', 'Lima Technology', 0, 0, 'img/73568911lima r-01.png');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sifaris`
--

CREATE TABLE `sifaris` (
  `sifaris_id` int(5) NOT NULL,
  `musteri_ad` varchar(250) DEFAULT NULL,
  `musteri_mail` varchar(250) DEFAULT NULL,
  `musteri_telefon` varchar(50) DEFAULT NULL,
  `sifaris_basliq` varchar(300) DEFAULT NULL,
  `sifaris_teslim_tarixi` varchar(100) DEFAULT NULL,
  `sifaris_tecili` varchar(100) DEFAULT NULL,
  `sifaris_durum` varchar(100) DEFAULT NULL,
  `sifaris_haqqinda` mediumtext,
  `sifaris_qiymet` varchar(100) DEFAULT NULL,
  `sifaris_baslama_tarix` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fayl_yolu` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sifaris`
--

INSERT INTO `sifaris` (`sifaris_id`, `musteri_ad`, `musteri_mail`, `musteri_telefon`, `sifaris_basliq`, `sifaris_teslim_tarixi`, `sifaris_tecili`, `sifaris_durum`, `sifaris_haqqinda`, `sifaris_qiymet`, `sifaris_baslama_tarix`, `fayl_yolu`) VALUES
(1, 'İlk s&ouml;z Psixologiya mərkəzi', 'ilksoz@bk.ru', '0777332223', 'SMM', '2021-10-10', 'Təcili', 'Bitdi', '<p>İlk s&ouml;z psixologiya mərkəzinin SMM xidmətlərini g&ouml;rmək, Daha sonra da veb sayt &uuml;&ccedil;&uuml;n anlaşmaq</p>\r\n', '400', '2022-05-02 23:34:22', 'dosyalar/365119514153_120672136440698_1964906158998303936_n.jpg');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `istifadeciler`
--
ALTER TABLE `istifadeciler`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_mail` (`user_mail`);

--
-- Tablo için indeksler `layihe`
--
ALTER TABLE `layihe`
  ADD PRIMARY KEY (`layihe_id`);

--
-- Tablo için indeksler `parametrler`
--
ALTER TABLE `parametrler`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `sifaris`
--
ALTER TABLE `sifaris`
  ADD PRIMARY KEY (`sifaris_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `istifadeciler`
--
ALTER TABLE `istifadeciler`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `layihe`
--
ALTER TABLE `layihe`
  MODIFY `layihe_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `parametrler`
--
ALTER TABLE `parametrler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `sifaris`
--
ALTER TABLE `sifaris`
  MODIFY `sifaris_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
