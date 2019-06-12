-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 14 May 2019, 22:09:02
-- Sunucu sürümü: 10.1.38-MariaDB
-- PHP Sürümü: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `digitalcrafts`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contents`
--

CREATE TABLE `contents` (
  `userid` int(11) NOT NULL,
  `contentid` int(11) NOT NULL,
  `content_type` varchar(45) NOT NULL,
  `upload_time` datetime DEFAULT NULL,
  `title` varchar(45) NOT NULL,
  `file_loc` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `contents`
--

INSERT INTO `contents` (`userid`, `contentid`, `content_type`, `upload_time`, `title`, `file_loc`) VALUES
(1, 1, 'Image', '2019-05-07 15:54:49', 'einstein', 'uploads/5cd18e296f0e7.jpg'),
(1, 2, 'Image', '2019-05-07 17:35:35', 'baboon', 'uploads/img4.jpg'),
(1, 3, 'Image', '2019-05-09 13:00:52', 'lady', 'uploads/img8.jpg'),
(8, 4, 'Image', '2019-05-14 16:37:30', 'wallpaper', 'uploads/1547300705676.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `donations`
--

CREATE TABLE `donations` (
  `receiving_wallet` int(11) DEFAULT NULL,
  `moneydonated` int(11) NOT NULL,
  `donated_content` int(11) DEFAULT NULL,
  `donationid` int(11) NOT NULL,
  `moacid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `donations`
--

INSERT INTO `donations` (`receiving_wallet`, `moneydonated`, `donated_content`, `donationid`, `moacid`) VALUES
(1, 10, 3, 20, 22),
(1, 1, 3, 21, 23),
(1, 2, 3, 22, 24);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `monetary_actions`
--

CREATE TABLE `monetary_actions` (
  `moacid` int(11) NOT NULL,
  `moactype` varchar(45) NOT NULL,
  `moacdate` datetime DEFAULT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `monetary_actions`
--

INSERT INTO `monetary_actions` (`moacid`, `moactype`, `moacdate`, `userid`) VALUES
(22, 'donation', '2019-05-13 14:27:23', 8),
(23, 'donation', '2019-05-13 14:29:03', 8),
(24, 'donation', '2019-05-13 14:30:00', 8),
(25, 'withdraw', '2019-05-13 20:06:52', 1),
(26, 'withdraw', '2019-05-13 20:07:41', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `usern` varchar(80) DEFAULT NULL,
  `passw` varchar(80) DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `confirmed` int(11) DEFAULT '0',
  `userid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`usern`, `passw`, `email`, `confirmed`, `userid`) VALUES
('umut', '1234', 'umut@mail.com', 1, 1),
('umut1', '1234', 'umut1@mail.com', 1, 4),
('admin', 'admin', 'admin@mail.com', 0, 5),
('umut3', '12345', 'umut3@mail.com', 0, 8);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `wallets`
--

CREATE TABLE `wallets` (
  `userid` int(11) DEFAULT NULL,
  `walletid` int(11) NOT NULL,
  `money` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `wallets`
--

INSERT INTO `wallets` (`userid`, `walletid`, `money`) VALUES
(1, 1, 10),
(4, 2, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `withdraws`
--

CREATE TABLE `withdraws` (
  `withdrawers_wallet` int(11) DEFAULT NULL,
  `money_withdrawn` int(11) DEFAULT NULL,
  `withdraw_method` varchar(80) DEFAULT NULL,
  `withdrawid` int(11) NOT NULL,
  `moacid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `withdraws`
--

INSERT INTO `withdraws` (`withdrawers_wallet`, `money_withdrawn`, `withdraw_method`, `withdrawid`, `moacid`) VALUES
(1, 1, NULL, 1, 25),
(1, 2, NULL, 2, 26);

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `contents`
--
ALTER TABLE `contents`
  ADD PRIMARY KEY (`contentid`),
  ADD KEY `userid` (`userid`);

--
-- Tablo için indeksler `donations`
--
ALTER TABLE `donations`
  ADD PRIMARY KEY (`donationid`),
  ADD UNIQUE KEY `moacid` (`moacid`),
  ADD KEY `receiving_wallet` (`receiving_wallet`),
  ADD KEY `donated_content` (`donated_content`);

--
-- Tablo için indeksler `monetary_actions`
--
ALTER TABLE `monetary_actions`
  ADD PRIMARY KEY (`moacid`),
  ADD KEY `userid` (`userid`) USING BTREE;

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `usern` (`usern`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Tablo için indeksler `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`walletid`),
  ADD UNIQUE KEY `userid` (`userid`);

--
-- Tablo için indeksler `withdraws`
--
ALTER TABLE `withdraws`
  ADD PRIMARY KEY (`withdrawid`),
  ADD UNIQUE KEY `moacid` (`moacid`),
  ADD KEY `withdrawers_wallet` (`withdrawers_wallet`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `contents`
--
ALTER TABLE `contents`
  MODIFY `contentid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `donations`
--
ALTER TABLE `donations`
  MODIFY `donationid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Tablo için AUTO_INCREMENT değeri `monetary_actions`
--
ALTER TABLE `monetary_actions`
  MODIFY `moacid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Tablo için AUTO_INCREMENT değeri `wallets`
--
ALTER TABLE `wallets`
  MODIFY `walletid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `withdraws`
--
ALTER TABLE `withdraws`
  MODIFY `withdrawid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `contents`
--
ALTER TABLE `contents`
  ADD CONSTRAINT `contents_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `donations`
--
ALTER TABLE `donations`
  ADD CONSTRAINT `donations_ibfk_1` FOREIGN KEY (`receiving_wallet`) REFERENCES `wallets` (`walletid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `donations_ibfk_2` FOREIGN KEY (`donated_content`) REFERENCES `contents` (`contentid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `donations_ibfk_3` FOREIGN KEY (`moacid`) REFERENCES `monetary_actions` (`moacid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `monetary_actions`
--
ALTER TABLE `monetary_actions`
  ADD CONSTRAINT `monetary_actions_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Tablo kısıtlamaları `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `wallets_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Tablo kısıtlamaları `withdraws`
--
ALTER TABLE `withdraws`
  ADD CONSTRAINT `withdraws_ibfk_1` FOREIGN KEY (`withdrawers_wallet`) REFERENCES `wallets` (`walletid`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `withdraws_ibfk_2` FOREIGN KEY (`moacid`) REFERENCES `monetary_actions` (`moacid`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
