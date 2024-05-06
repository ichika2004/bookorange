-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 05 月 03 日 08:08
-- 伺服器版本： 10.4.28-MariaDB
-- PHP 版本： 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bookorangeDB`
--

-- --------------------------------------------------------

--
-- 資料表結構 `Product`
--

CREATE TABLE `Product` (
  `pNo` int(11) NOT NULL,
  `pName` varchar(255) NOT NULL,
  `p_img` varchar(255) NOT NULL,
  `p_intro` longtext DEFAULT NULL,
  `category` varchar(50) NOT NULL,
  `unitPrice` decimal(10,2) NOT NULL,
  `method` text DEFAULT NULL,
  `language` varchar(255) NOT NULL,
  `payment_method` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `Product`
--

INSERT INTO `Product` (`pNo`, `pName`, `p_img`, `p_intro`, `category`, `unitPrice`, `method`, `language`, `payment_method`) VALUES
(5, 'AI世界的底層邏輯與生存法則', 'Product_img/0000000005_663434f666a9f.png', 'AI 只是標配，思考才是你的武器，<br>\r\n取代你的人，是會用 AI 的人!<br>\r\n<br><br>\r\n史丹佛電腦科學專家程世嘉，<br>\r\n深入淺出，轉譯AI 帶來的質變，<br>\r\n搞懂AI世界的底層邏輯和生存法則，<br>\r\n讓你在工作、學習、商業上全面超車。<br>\r\n<br><br>\r\n　　「Sega，一位台大/ 史丹佛高材生、Google 工程師、AI 領域創業家，是不少人面對 AI  焦慮的大海浮木。那種日以繼夜盯著 AI  發展的工作，就交給專業的他吧！世界雖快，透過 Sega  的深入淺出的轉譯，讀者的心，則可以慢！」——簡立峰（iKala董事、Google 台灣前董事總經理）\r\n', 'Computers & Technology', 300.00, 'Seller Delivery, Self Pickup', 'Chinese', 'Credit Card/Debit Card, Cash on Delivery'),
(6, '深刻認識一個人：發現自己與他人的非凡之處 <br>How to Know a Person: The Art of Seeing Others Deeply and Being Deeply Seen', 'Product_img/0000000006_663436b96a726.png', '為了被看見，我願意為此奮不顧身<br>\r\n當我們遇見某個人，而這個人了解你、看透你，說出一些你自己彷彿都不知道的事情。<br>\r\n那可能讓我們感覺被愛、被重視、被同理，那一刻我們簡直無所不能，願意為此奮不顧身，在這個世界裡成為一個更好的人。但當我們被當成隱形人，可能感覺憤怒、羞辱、覺得自己毫無價值，甚至覺得自己是人生的失敗者。 <br>\r\n「如何深刻認識一個人」，這對人生至關重要的事，學校卻從不會教我們這些技能。在社群當道時代，人們只能看到每個人浮在水面上的那一面，光鮮華麗，總是擁有太多我們得不到的快樂。這讓所有人都孤單，與人的連結只剩羨慕嫉妒恨，而這本書就是獻給這個時代的禮物，讓人得以獨處也得以真心擁抱他人。\r\n\r\n優惠組合', 'Self-Help', 3000.00, 'Seller Delivery, Convenience Store', 'English', 'Credit Card/Debit Card, Bank Transfer'),
(7, '羅生門：芥川龍之介小說選', 'Product_img/0000000007_663437f3c02c2.png', '內容簡介<br>\r\n<br>\r\n　　「但我不禁想像。即便百年後仍落寞無名，但有那麼一位讀者，拿著我的書。在他的內心深處，儘管朦朧，仍會浮現我筆下的海市蜃樓……」──芥川龍之介\r\n<br><br>\r\n　　【日本文學大師──芥川龍之介】<br>\r\n　　芥川龍之介是日本現代文學的鬼才，寫下風靡世界的《羅生門》電影原著小說〈竹林中〉。為表彰他對文學的貢獻，設立了以其姓氏命名的純文學最高榮譽「芥川賞」。\r\n<br><br>\r\n　　【收錄芥川龍之介代表作】<br>\r\n　　本書收錄芥川龍之介16篇作品，不僅包含著名作品，也挑選一些少見、有趣新異的作品。書中依出刊時間排序故事篇章，帶你循序漸進閱讀芥川龍之介的創作。', 'Fiction & Literature', 400.00, 'Seller Delivery, Convenience Store', 'Chinese', 'Credit Card/Debit Card, Bank Transfer, Cash on Delivery, PayPal'),
(8, '人間失格 <br>にんげんしっかく', 'Product_img/0000000008_663449c930413.png', '「生而為人，我很抱歉。」<br>\r\n\r\n　　從小到大，我始終擺脫不了孤獨和傷感，我始終渴望愛與被愛，卻始終事與願違，如深淵般無止盡的迷惘和絕望，逐漸將我吞噬，我一次又一次地傷害了我愛和愛我的人，我自暴自棄、甚至自虐，直到喪失了做為人的資格……<br>\r\n\r\n　　我是葉藏，這是我的真實故事。<br>\r\n　　願這些痛苦掙扎，能成為你的良藥，去愛這個世間萬物。<br>\r\n\r\n　　太宰治以敏銳的洞察力和獨特的寫作手法，塑造了人性的自我革命，定格了人在世間短暫逗留的永恆形象，力圖通過自己的筆墨為傷痕累累的靈魂塗上永不褪色的悲劇色彩，在絕望中毀滅希望，在頹廢中凸顯人性。<br>\r\n\r\n　　《人間失格》是一面照出幽靈的鏡子，每個活在世上的人都會從它照出自己要麼模糊、要麼變形的面孔和影子。另一面，它又如同一部警世醒言，提醒世界，請不要忽略和遺忘，甚至歧視弱者的存在。<br>', 'Fiction & Literature', 500.00, 'Seller Delivery, Convenience Store', 'Japanese', 'Credit Card/Debit Card, Cash on Delivery, PayPal'),
(9, 'test to img', 'Product_img/0000000009_6634706d606da.png', 'test  image', 'Business & Finance', 300000.00, 'Seller Delivery, Convenience Store', 'Japanese', 'Cash on Delivery, PayPal'),
(10, 'book3', 'Product_img/0000000010_66347c55919d2.png', 'demo ', 'Arts & Design', 300.00, 'Seller Delivery, Self Pickup', 'English', 'Credit Card/Debit Card, Cash on Delivery, PayPal');

-- --------------------------------------------------------

--
-- 資料表結構 `SELL`
--

CREATE TABLE `SELL` (
  `UID` int(11) NOT NULL,
  `pNo` int(11) NOT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `SELL`
--

INSERT INTO `SELL` (`UID`, `pNo`, `date`) VALUES
(1, 5, '2024-05-03 08:51:02'),
(1, 6, '2024-05-03 08:58:33'),
(1, 7, '2024-05-03 09:03:47'),
(5, 8, '2024-05-03 10:19:53'),
(5, 9, '2024-05-03 12:26:45'),
(6, 10, '2024-05-03 13:55:33');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `UID` int(11) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `U_NAME` varchar(50) NOT NULL,
  `U_EMAIL` varchar(100) NOT NULL,
  `U_PHONE` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 傾印資料表的資料 `users`
--

INSERT INTO `users` (`UID`, `PASSWORD`, `U_NAME`, `U_EMAIL`, `U_PHONE`) VALUES
(1, '$2y$10$4icH1/OuNoRoho3fSWfk1etJ0msHMy41QaS6tjjYyrdRqDfcERWrW', 'test_user', 'test@gmail.com', '110'),
(2, '$2y$10$/IJqtKZzBcvJ.gMdiNoSoOjEY3ZIpyKOoNQ5hu48oBYSI21fnBQtK', '', '', ''),
(3, '$2y$10$fQltsz6Mo2ApkMgQiT43KuDLFL.OBBUhnw0p/JTvkE9usJmaVmNfK', '', '', ''),
(4, '$2y$10$v2OWvtfnxCq4JTXtEWDZsuDXFIEUzZVUN6YRO.irXDf3AKhSe8PzS', '', '', ''),
(5, '$2y$10$JwDK1yyf6BbKIaw.JsYxAuPVkm69dSQmH2JMg3LHYChAG3REHx/Tq', '田所浩二', 'homo@gmail.com', '1145141919'),
(6, '$2y$10$c3e0T9QndM3JM4jo.l0uo.G6OLJJz1fXZwiqCDaJ/xIvpTUpIIhBm', 'test2', 'test2@gmail.com', '110');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `Product`
--
ALTER TABLE `Product`
  ADD PRIMARY KEY (`pNo`);

--
-- 資料表索引 `SELL`
--
ALTER TABLE `SELL`
  ADD PRIMARY KEY (`UID`,`pNo`),
  ADD KEY `sell_ibfk_2` (`pNo`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `Product`
--
ALTER TABLE `Product`
  MODIFY `pNo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `SELL`
--
ALTER TABLE `SELL`
  ADD CONSTRAINT `sell_ibfk_1` FOREIGN KEY (`UID`) REFERENCES `users` (`UID`),
  ADD CONSTRAINT `sell_ibfk_2` FOREIGN KEY (`pNo`) REFERENCES `Product` (`pNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
