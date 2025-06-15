-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versione server:              10.4.32-MariaDB - mariadb.org binary distribution
-- S.O. server:                  Win64
-- HeidiSQL Versione:            12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dump della struttura del database hw2
CREATE DATABASE IF NOT EXISTS `hw2` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hw2`;

-- Dump della struttura di tabella hw2.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.cache: ~0 rows (circa)
DELETE FROM `cache`;

-- Dump della struttura di tabella hw2.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.cache_locks: ~0 rows (circa)
DELETE FROM `cache_locks`;

-- Dump della struttura di tabella hw2.commenti
CREATE TABLE IF NOT EXISTS `commenti` (
  `id_commento` int(11) NOT NULL AUTO_INCREMENT,
  `id_post` int(11) NOT NULL,
  `id_autore` int(11) NOT NULL,
  `testo` text NOT NULL,
  PRIMARY KEY (`id_commento`),
  KEY `id_post` (`id_post`),
  KEY `id_autore` (`id_autore`),
  CONSTRAINT `commenti_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  CONSTRAINT `commenti_ibfk_2` FOREIGN KEY (`id_autore`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.commenti: ~57 rows (circa)
DELETE FROM `commenti`;
INSERT INTO `commenti` (`id_commento`, `id_post`, `id_autore`, `testo`) VALUES
	(1, 2, 4, 'BEL POST! Continua cosi'),
	(2, 2, 1, 'BRAVOOO'),
	(3, 2, 4, 'Mi iscrivo al tuo Canale!'),
	(4, 1, 6, 'Bellisima città Londra!'),
	(5, 1, 4, 'Funzionano i Commenti'),
	(6, 1, 6, 'EVviva, voglio andarae a Londra Presto!\r\n'),
	(7, 1, 1, 'Articolo molto interessante, grazie!'),
	(8, 1, 2, 'Non sapevo queste cose, molto utile.'),
	(9, 1, 3, 'Ottimo lavoro, continua così!'),
	(10, 2, 6, 'Aspetto il prossimo post!'),
	(11, 2, 1, 'Hai spiegato tutto benissimo.'),
	(12, 5, 2, 'Molto chiaro, complimenti.'),
	(13, 3, 3, 'Un punto di vista originale.'),
	(14, 3, 4, 'Mi hai fatto riflettere.'),
	(15, 3, 1, 'Questo argomento mi interessa molto.'),
	(17, 1, 1, 'Articolo molto interessante, grazie!'),
	(18, 1, 2, 'Non sapevo queste cose, molto utile.'),
	(19, 1, 3, 'Ottimo lavoro, continua così!'),
	(20, 2, 4, 'Aspetto il prossimo post!'),
	(21, 2, 1, 'Hai spiegato tutto benissimo.'),
	(22, 2, 2, 'Molto chiaro, complimenti.'),
	(23, 3, 3, 'Un punto di vista originale.'),
	(24, 3, 4, 'Mi hai fatto riflettere.'),
	(25, 3, 1, 'Questo argomento mi interessa molto.'),
	(26, 5, 2, 'Davvero ben scritto!'),
	(27, 4, 3, 'Ci voleva un post così!'),
	(28, 4, 4, 'Grazie per aver condiviso.'),
	(29, 1, 1, 'Molto utile anche per chi è alle prime armi.'),
	(30, 2, 2, 'Bravo, continua così.'),
	(31, 3, 3, 'Contenuto ben strutturato.'),
	(32, 4, 4, 'Una lettura piacevole.'),
	(33, 1, 2, 'Condivido pienamente quanto scritto.'),
	(34, 2, 3, 'Aspetto altri articoli del genere.'),
	(35, 3, 4, 'Hai centrato il punto perfettamente.'),
	(36, 4, 1, 'Un ottimo spunto per approfondire.'),
	(37, 1, 4, 'HAi ragione!\r\n'),
	(38, 1, 10, 'Scrivo un commento!!'),
	(39, 12, 4, 'Bella Twin Peaks!'),
	(40, 2, 4, 'ciaoooo\r\n'),
	(41, 24, 4, 'Ottimo\r\n'),
	(42, 24, 4, 'Ottimo\r\n'),
	(43, 24, 4, 'Ottimo\r\n'),
	(44, 22, 4, 'buono!'),
	(45, 24, 4, 'graziee :)\r\n'),
	(46, 15, 4, 'Mi piace tanto'),
	(47, 14, 4, 'Bellla la nuvoa 5090!'),
	(48, 25, 4, '25'),
	(49, 25, 4, '25'),
	(50, 25, 4, '25'),
	(51, 25, 4, ''),
	(52, 5, 4, 'Bel libro'),
	(53, 3, 4, 'Nuovo commento'),
	(54, 25, 4, 'Molto utile'),
	(55, 20, 4, 'Mi è piaciuto il panino con la mortadella'),
	(56, 20, 4, 'ci vorrei andare'),
	(57, 21, 4, 'AMD!'),
	(58, 25, 4, 'ottima idea'),
	(59, 25, 4, 'ciAooo'),
	(60, 25, 4, 'asd'),
	(61, 25, 4, 'WOW!!!!!!!!!'),
	(62, 25, 4, 'Evvia i commenti funzionanooo!'),
	(63, 25, 4, 'ciaooo'),
	(64, 36, 4, 'Ciaooo!'),
	(65, 71, 4, 'ciaoo'),
	(66, 72, 4, 'Doveva vincere !! o forse no'),
	(67, 80, 4, 'Bellissimo il 3!'),
	(68, 72, 4, 'bella canzone'),
	(69, 97, 4, 'Mi piace!');

-- Dump della struttura di tabella hw2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.failed_jobs: ~0 rows (circa)
DELETE FROM `failed_jobs`;

-- Dump della struttura di tabella hw2.immaginiutente
CREATE TABLE IF NOT EXISTS `immaginiutente` (
  `id_utente` int(11) NOT NULL,
  `immagine_profilo` varchar(255) DEFAULT NULL,
  `immagine_copertina` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_utente`),
  CONSTRAINT `immaginiutente_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.immaginiutente: ~35 rows (circa)
DELETE FROM `immaginiutente`;
INSERT INTO `immaginiutente` (`id_utente`, `immagine_profilo`, `immagine_copertina`) VALUES
	(1, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(2, 'Content/profile/pf2.jpg', 'Content/profile/pf1Background.jpg'),
	(3, 'Content/profile/pf3.jpg', 'Content/profile/pf1Background.jpg'),
	(4, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(5, 'Content/profile/pf2.jpg', 'Content/profile/pf1Background.jpg'),
	(7, '', 'Content/profile/pf1Background.jpg'),
	(8, 'Content/profile/pf1.jpg', 'Content/profile/pf1Background.jpg'),
	(10, 'Content/profile/pf3.jpg', 'Content/profile/pf1Background.jpg'),
	(55, 'https://avatar.iran.liara.run/public/boy?username=Warner', NULL),
	(56, 'https://avatar.iran.liara.run/public/boy?username=Cyberpunk', NULL),
	(57, 'https://avatar.iran.liara.run/public/boy?username=Nintendo+of+Ame', NULL),
	(58, 'https://avatar.iran.liara.run/public/boy?username=PLAYERINSIDE', NULL),
	(59, 'https://avatar.iran.liara.run/public/boy?username=Prodigeek', NULL),
	(62, 'https://avatar.iran.liara.run/public/boy?username=Poro+Michele', NULL),
	(64, 'https://avatar.iran.liara.run/public/boy?username=PlayStation', NULL),
	(65, 'https://avatar.iran.liara.run/public/boy?username=NVIDIA', NULL),
	(66, 'https://avatar.iran.liara.run/public/boy?username=Universit%C3%A0+di+', NULL),
	(67, 'https://avatar.iran.liara.run/public/boy?username=Evoice+Erebus', NULL),
	(69, 'https://avatar.iran.liara.run/public/boy?username=Dalfang', NULL),
	(70, 'https://avatar.iran.liara.run/public/boy?username=BigWynter', NULL),
	(72, 'https://avatar.iran.liara.run/public/boy?username=Batman+Arkham+V', NULL),
	(73, 'https://avatar.iran.liara.run/public/boy?username=World+Athletics', NULL),
	(74, 'https://avatar.iran.liara.run/public/boy?username=Red+Bull', NULL),
	(75, 'https://avatar.iran.liara.run/public/boy?username=Top+Travel', NULL),
	(76, 'https://avatar.iran.liara.run/public/boy?username=GiorgiaVEVO', NULL),
	(77, 'https://avatar.iran.liara.run/public/boy?username=Exotic+Vacation', NULL),
	(78, 'https://avatar.iran.liara.run/public/boy?username=Isola+degli+Art', NULL),
	(79, 'https://avatar.iran.liara.run/public/boy?username=HowToMen', NULL),
	(80, 'https://avatar.iran.liara.run/public/boy?username=DC', NULL),
	(81, 'https://avatar.iran.liara.run/public/boy?username=Marvel+Entertai', NULL),
	(82, 'https://avatar.iran.liara.run/public/boy?username=Eleonora+Petrel', NULL),
	(83, 'https://avatar.iran.liara.run/public/boy?username=DadoBax+-+Feel+', NULL),
	(84, 'https://avatar.iran.liara.run/public/boy?username=MYGEMPICTURES', NULL),
	(85, 'https://avatar.iran.liara.run/public/boy?username=Peaceful+Relaxa', NULL),
	(86, 'https://avatar.iran.liara.run/public/boy?username=Scenic+Relaxati', NULL),
	(87, 'https://avatar.iran.liara.run/public/boy?username=Around+The+Worl', NULL);

-- Dump della struttura di tabella hw2.iscrizione
CREATE TABLE IF NOT EXISTS `iscrizione` (
  `follower_id` int(11) NOT NULL,
  `seguito_id` int(11) NOT NULL,
  PRIMARY KEY (`follower_id`,`seguito_id`),
  KEY `seguito_id` (`seguito_id`),
  CONSTRAINT `iscrizione_ibfk_1` FOREIGN KEY (`follower_id`) REFERENCES `users` (`id`),
  CONSTRAINT `iscrizione_ibfk_2` FOREIGN KEY (`seguito_id`) REFERENCES `users` (`id`),
  CONSTRAINT `CONSTRAINT_1` CHECK (`follower_id` <> `seguito_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.iscrizione: ~28 rows (circa)
DELETE FROM `iscrizione`;
INSERT INTO `iscrizione` (`follower_id`, `seguito_id`) VALUES
	(1, 2),
	(1, 3),
	(1, 4),
	(2, 3),
	(3, 1),
	(4, 1),
	(4, 2),
	(4, 3),
	(4, 5),
	(4, 6),
	(4, 7),
	(4, 8),
	(4, 46),
	(4, 55),
	(4, 57),
	(4, 58),
	(4, 62),
	(4, 75),
	(4, 76),
	(4, 79),
	(4, 83),
	(4, 84),
	(7, 1),
	(7, 2),
	(7, 4),
	(8, 4),
	(10, 1);

-- Dump della struttura di tabella hw2.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.jobs: ~0 rows (circa)
DELETE FROM `jobs`;

-- Dump della struttura di tabella hw2.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.job_batches: ~0 rows (circa)
DELETE FROM `job_batches`;

-- Dump della struttura di tabella hw2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.migrations: ~2 rows (circa)
DELETE FROM `migrations`;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dump della struttura di tabella hw2.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.password_reset_tokens: ~0 rows (circa)
DELETE FROM `password_reset_tokens`;

-- Dump della struttura di tabella hw2.post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `id_autore` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `contenuto` text NOT NULL,
  `percorsoMedia` varchar(255) DEFAULT NULL,
  `categoria` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id_post`),
  KEY `id_autore` (`id_autore`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_autore`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.post: ~60 rows (circa)
DELETE FROM `post`;
INSERT INTO `post` (`id_post`, `id_autore`, `title`, `contenuto`, `percorsoMedia`, `categoria`) VALUES
	(1, 1, 'VIAGGIO a Londra', 'Appena tornati da Londra e siamo ancora pieni di emozioni! 🇬🇧\nTra pioggia leggera e cieli grigi, la città ha un fascino unico.\nAbbiamo camminato lungo il Tamigi,\nsalutato il Big Ben e fatto shopping a Camden.\nI pub storici, i musei gratuiti e i parchi immensi ci hanno conquistati.\nLa vista dalla London Eye è qualcosa che non si dimentica. 🎡\nOgni quartiere ha la sua anima, dal classico Notting Hill al moderno Shoreditch.\nAbbiamo assaggiato di tutto, dal fish & chips al curry più piccante.\nLondra è un mix perfetto tra storia e innovazione.\nPresto vi raccontiamo tutto per bene — stay tuned! 🖤', 'Content/background/Londra.jpg', 'Viaggi'),
	(2, 1, 'COSA Fare a New YORK?', 'Appena tornati da un\'avventura incredibile a New York! 🗽\nAbbiamo camminato tra i grattacieli di Manhattan,\nassaporato street food a Brooklyn e respirato arte al MoMA.\nCentral Park in autunno è pura magia,\nmentre le luci di Times Square tolgono il fiato ogni volta. ✨\nAbbiamo scoperto angoli meno turistici e vissuto la città come veri newyorkesi.\nOgni quartiere ha un’anima diversa e unica.\nNon vediamo l’ora di raccontarvi tutto,\ncondividere foto, consigli e qualche sorpresa.\nLa Grande Mela ci ha davvero conquistati! 🍎', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(3, 4, 'PLATAX post 3, autore 4', 'Qui scivero un testo molto lungo in cui diro cosa si fa a new yotk', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(4, 1, 'POst di prova', 'Non so che scrivere.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Viaggi'),
	(5, 2, 'Libri da leggere', 'Ultimamente mi sono perso tra le pagine di storie incredibili. 📚\nCi sono libri che ti tengono sveglio la notte e altri che ti restano dentro per sempre.\nHo riscoperto il piacere di leggere senza fretta, solo per il gusto di farlo.\nNarrativa, saggistica, classici e novità: c’è un mondo intero tra le righe.\nAlcune pagine sembrano scritte proprio per te, altre ti aprono gli occhi su cose nuove.\nOgni libro è un viaggio, anche se non ti muovi dal divano.\nSto preparando una selezione dei miei preferiti da consigliare.\nSpoiler: ce n’è uno che mi ha davvero cambiato il punto di vista.\nPresto ve ne parlo meglio, magari con qualche citazione memorabile.\nE voi, cosa state leggendo in questo periodo? 📖✨', 'Content/background/libri.jpg', 'Lettura'),
	(6, 1, 'Viaggio in Islanda', 'Esperienza indimenticabile tra geyser e cascate.', 'Content/background/Londra.jpg', 'Viaggi'),
	(7, 2, 'Recensione MacBook M3', 'Analisi dettagliata delle performance.', 'Content/background/Intelligenza-Artificiale.jpeg', 'Tecnologia'),
	(8, 3, 'Pasta fatta in casa', 'La mia ricetta della nonna.', 'Content/background/Londra.jpg', 'Cucina'),
	(10, 6, 'Python vs JavaScript', 'Confronto tra i due linguaggi.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(11, 7, 'Arte digitale con Procreate', 'Tutorial base per principianti.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design'),
	(12, 8, 'Fotografia notturna', 'Come catturare le stelle.', 'Content/background/Londra.jpg', 'Fotografia'),
	(13, 1, 'Cose da fare a Roma', 'Itinerario di 3 giorni.', 'Content/background/Londra.jpg', 'Viaggi'),
	(14, 2, 'Gadget tech 2025', 'I migliori accessori smart.', 'Content/background/videogame.jpg', 'Tecnologia'),
	(15, 3, 'Pane fatto in casa', 'Con pochi ingredienti, tanto gusto.', '', 'Cucina'),
	(17, 6, 'Come usare Git', 'Comandi base e flusso di lavoro.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(18, 7, 'Moodboard per grafici', 'Strumenti utili per il design.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design'),
	(19, 8, 'Scatti urbani', 'Come raccontare una città con la fotografia.', 'Content/background/Londra.jpg', 'Fotografia'),
	(20, 1, 'Weekend in Toscana', 'Vino, colline e relax.', 'Content/background/Londra.jpg', 'Viaggi'),
	(21, 2, 'Intel vs AMD', 'Qual è meglio nel 2025?', 'Content/background/videogame.jpg', 'Tecnologia'),
	(22, 3, 'Tiramisù classico', 'Dolce tradizionale italiano.', 'Content/background/Intelligenza-Artificiale.jpeg', 'Cucina'),
	(24, 6, 'API REST explained', 'Architettura e best practices.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Programmazione'),
	(25, 7, 'Creare un logo efficace', 'Cosa considerare nel design.', 'Content/background/Cosa-Fare-a-New-york-01.jpg', 'Design'),
	(36, 46, 'Superman - Official &#39;Tickets on Sale&#39; Trailer (2025) David Corenswet, Nicholas Hoult', 'Don\'t miss the \'Tickets on Sale\' Trailer for Superman, the start of the new DCU helmed by James Gunn distributed by Warner Bros ...', 'https://i.ytimg.com/vi/RyHEvDusigI/hqdefault.jpg', 'Caricamenti'),
	(37, 55, 'THE BATMAN – Main Trailer', 'It\'s not just a call… It\'s a warning. https://www.instagram.com/thebatman/ https://www.facebook.com/thebatman ...', 'https://i.ytimg.com/vi/mqqft2x_Aa4/hqdefault.jpg', 'Caricamenti'),
	(38, 56, 'Cyberpunk 2077 — Official E3 2018 Trailer', 'Watch the E3 trailer for Cyberpunk 2077 — the role-playing game of the dark future from CD PROJEKT RED, creators of The ...', 'https://i.ytimg.com/vi/8X2kIfS6fb8/hqdefault.jpg', 'Caricamenti'),
	(39, 56, 'Cyberpunk 2077: Ultimate Edition — Nintendo Swit', 'Cyberpunk 2077: Ultimate Edition is out now on Nintendo Switch 2! Become V, a cyber-enhanced mercenary determined to make ...', 'https://i.ytimg.com/vi/iRswiS_NvgA/hqdefault.jpg', 'Caricamenti'),
	(40, 57, 'Nintendo Switch 2 – Launch Trailer', 'The Nintendo Switch 2 system is available now! Learn more: ...', 'https://i.ytimg.com/vi/0QeqO0kFz-E/hqdefault.jpg', 'Caricamenti'),
	(41, 58, 'SWITCH 2: ci è arrivata ROTTA (la scatola) | TEST', 'E ci siamo! Nintendo Switch 2 è qui nelle nostre mani e finalmente possiamo parlarvene con cognizione di causa. Nell\'attesa ...', 'https://i.ytimg.com/vi/pstjxrZOgdo/hqdefault.jpg', 'Caricamenti'),
	(42, 59, 'NINTENDO SWITCH 2 | LA RECENSIONE DEFINITIVA!', 'Whokeys Codice Sconto 25%! Software: PD20 □ Windows 11 (20€): https://it.whokeys.com/wk/Wins11PD □ Windows 10 (15€): ...', 'https://i.ytimg.com/vi/3kcmcfT9pgY/hqdefault.jpg', 'Caricamenti'),
	(43, 62, 'COME MIGLIORARE LA QUALITA&#39; DELLO SCHERMO DI N', 'La console non ha uno schermo OLED, Ma l\'IPS di Switch 2 è comunque meglio della vecchia Nintendo Switch? Ecco come ...', 'https://i.ytimg.com/vi/opX4vo98Z-E/hqdefault.jpg', 'Caricamenti'),
	(44, 62, '“Nintendo Switch 2 sarà un fallimento...” @Ni', 'Nintendo Switch 2 è la console più venduta di sempre al lancio. Con oltre 3,5 milioni di unità, l\'handheld Nintendo ha battuto ...', 'https://i.ytimg.com/vi/9duooCTGzCs/mqdefault.jpg', 'Caricamenti'),
	(46, 58, 'NINTENDO SWITCH 2: 500 EURO BUTTATI? RECENSIONE CO', 'Ci siamo! Eccoci con la nostra recensione completa e definitiva di Nintendo Switch 2 nella quale scopriremo insieme se vale la ...', 'https://i.ytimg.com/vi/8opUu_4_xXY/mqdefault.jpg', 'Caricamenti'),
	(47, 58, 'TANTISSIMI GIOCHI! (ANCHE PER PS5) | XBOX GAMES SH', 'Un evento divertente e pieno di titoli, anche per PS5, per chi se lo stesse chiedendo. Una festa per i videogiocatori tutti, dunque, ...', 'https://i.ytimg.com/vi/B-tAhzmZ9io/mqdefault.jpg', 'Caricamenti'),
	(48, 58, 'NON POSSIAMO FARCI PRENDERE IN GIRO COSÌ | SWTCH ', 'Una domenica in versione "redux", se vogliamo, con poche news ma è tutto nella norma, considerando che in questi giorni di ...', 'https://i.ytimg.com/vi/jzcxaCGDAUo/mqdefault.jpg', 'Caricamenti'),
	(49, 64, 'Astro Bot DualSense Controller Reveal | PS5', 'https://blog.playstation.com/2024/07/29/first-look-astro-bot-limited-edition-dualsense-wireless-controller/ Whizz through the galaxy ...', 'https://i.ytimg.com/vi/GaElJ75QQJQ/mqdefault.jpg', 'Caricamenti'),
	(50, 64, 'PlayStation 5 Pro Console - Reveal Trailer', 'PlayStation®5 Pro Console Witness Play Unleashed™ With the PlayStation®5 Pro console, the world\'s greatest game creators ...', 'https://i.ytimg.com/vi/6HaRMiTfvks/mqdefault.jpg', 'Caricamenti'),
	(51, 65, 'NVIDIA CEO Jensen Huang Keynote at CES 2025', 'Watch NVIDIA CEO Jensen Huang unveil groundbreaking RTX 50 series GPUs powered by the Blackwell architecture. Witness ...', 'https://i.ytimg.com/vi/k82RwXqZHY8/mqdefault.jpg', 'Caricamenti'),
	(52, 66, 'Elezioni Rettorali Unict 2025/2031 | Candidato Sal', 'Videomessaggio del prof. Salvatore Baglio, ordinario di Misure elettriche ed elettroniche al Dipartimento di Ingegneria elettrica, ...', 'https://i.ytimg.com/vi/hWLGIw0zyT0/mqdefault.jpg', 'Caricamenti'),
	(53, 67, 'Cyberpunk 2077 Получит Еще Одно Но', '12 и 13 июня получайте кэшбэк до 30% в любимых играх! Подробнее: https://vk.cc/cMJxGe?erid=2W5zFGcEifA Cyberpunk ...', 'https://i.ytimg.com/vi/lsNYUQRktP8/mqdefault.jpg', 'Caricamenti'),
	(58, 69, 'Cyberpunk 2077 is Getting Another &quot;Final Upda', 'They said it was the last update. Again. But something about this one feels different. This is a love letter to CDPR\'s refusal to let ...', 'https://i.ytimg.com/vi/Tj18stNIHoY/mqdefault.jpg', 'Caricamenti'),
	(61, 56, 'Cyberpunk 2077 — Official E3 2018 Trailer', 'Watch the E3 trailer for Cyberpunk 2077 — the role-playing game of the dark future from CD PROJEKT RED, creators of The ...', 'https://i.ytimg.com/vi/8X2kIfS6fb8/mqdefault.jpg', 'Caricamenti'),
	(67, 72, 'Batman: Arkham Knight - Full Game Walkthrough in 4', 'Batman: Arkham Knight Full Movie Walkthrough / Guide Video in New Game Plus Knightmare Difficulty 120% Completion with all ...', 'https://i.ytimg.com/vi/ke3ZPjsy1Nk/mqdefault.jpg', 'Caricamenti'),
	(68, 73, 'Nothing beats a clean pass 😮‍💨 #athletics ', 'Subscribe to our channel - https://www.youtube.com/worldathletics ⭐️ Follow us on Twitter - https://twitter.com/WorldAthletics ...', 'https://i.ytimg.com/vi/JNYz4YdOgFk/mqdefault.jpg', 'Caricamenti'),
	(69, 73, 'When things don&#39;t go to plan 🥹 #athletics #', 'Subscribe to our channel - https://www.youtube.com/worldathletics ⭐️ Watch exclusive videos on Inside Track ...', 'https://i.ytimg.com/vi/sA_FtB4Etlg/mqdefault.jpg', 'Caricamenti'),
	(70, 74, 'Sports You Never Knew Existed 👀', 'Compilation of crazy sports within the world of Red Bull, including Red Bull Fierste Ljepper, Red Bull Slopesoakers, Red Bull ...', 'https://i.ytimg.com/vi/9bv0rBDxVrY/mqdefault.jpg', 'Caricamenti'),
	(71, 75, 'Wonders of Greece | The Most Amazing Places in Gre', 'Explore Greece with our documentary, capturing a land where history and beauty collide. Witness a world shaped by ancient tales ...', 'https://i.ytimg.com/vi/VyQcXXFuVDU/mqdefault.jpg', 'Caricamenti'),
	(72, 76, 'Giorgia - LA CURA PER ME (Official Video - Sanremo', 'Giorgia #LACURAPERME #Sanremo2025 Ascolta ora “LA CURA PER ME”: https://Epic.lnk.to/Lacuraperme Chiedi ad Alexa: metti ...', 'https://i.ytimg.com/vi/-ixB0yDkLO4/mqdefault.jpg', 'Caricamenti'),
	(73, 77, 'How to Spend 4 Days in PARIS France  | Travel Itin', 'Get ready to fall in love with Paris! We\'ve put together the perfect four-day guide to help you make the most of your trip to this ...', 'https://i.ytimg.com/vi/_36bHzl-PV0/mqdefault.jpg', 'Caricamenti'),
	(74, 78, 'Serena Brancale - ANEMA E CORE (Official Video - S', 'Serena Brancale - ANEMA E CORE (Official Video - Sanremo 2025) Ascolta “ANEMA E CORE”: https://wmi.lnk.to/anemaecore ...', 'https://i.ytimg.com/vi/5aO1Lu7Khw0/mqdefault.jpg', 'Caricamenti'),
	(75, 79, 'CES 2025: 15 Best Tech You’ll Actually Want!', 'Here are the Best Gadgets at CES 2025 that will make you jealous that you don\'t own them! ▣ MegPad ...', 'https://i.ytimg.com/vi/flY9daaR9Do/mqdefault.jpg', 'Caricamenti'),
	(76, 59, 'NVIDIA N1X È UN MOSTRO! 😱 FINALMENTE IL CHIP A', 'Whokeys Codice Sconto 25%! Software: PD20 □ Windows 11 (20€): https://it.whokeys.com/wk/Wins11PD □ Windows 10 (15€): ...', 'https://i.ytimg.com/vi/7-TNaZwVjbE/mqdefault.jpg', 'Caricamenti'),
	(77, 80, 'Superman | Tickets on Sale Now', 'On July 11, the entire world will look up. Get tickets now for #Superman - Only In Theaters and @IMAX “Superman,” DC Studios\' ...', 'https://i.ytimg.com/vi/nZTgJy8ym34/mqdefault.jpg', 'Caricamenti'),
	(78, 81, 'Marvel Television&#39;s Ironheart | Official Trail', 'Watch the brand new trailer for Marvel Television\'s #Ironheart Don\'t miss the 3-episode premiere on June 24 at 6pm PT/ 9pm ET, ...', 'https://i.ytimg.com/vi/r6j-wSIqJJ0/mqdefault.jpg', 'Caricamenti'),
	(79, 82, 'Tendenze primavera estate 2025! Non so se amo di p', 'Ecco un nuovo video sulle 10 tendenze più belle per vestire alla moda questo primavera estate 2025! Se vuoi vedere altri video: ...', 'https://i.ytimg.com/vi/sLAwypGtuZY/mqdefault.jpg', 'Caricamenti'),
	(80, 83, 'FALLOUT Retrospettiva • La Serie di GDR ATOMICI ', 'Qui trovi key a prezzi scontati: https://www.instant-gaming.com/?igr=DadoBax Fallout è una serie di Giochi di Ruolo esplosiva, ...', 'https://i.ytimg.com/vi/CKPcDJ0cpT8/mqdefault.jpg', 'Caricamenti'),
	(81, 84, 'ONE DAY IN CATANIA (ITALY) | 4K 60FPS | A lively c', 'Catania, also called the "black city", is the second largest city in the region of Sicily after Palermo. A volcanic eruption in 1669 and ...', 'https://i.ytimg.com/vi/RhyJIQhULbk/mqdefault.jpg', 'Caricamenti'),
	(97, 4, 'I\'m Spiderman', 'Ecco la mia playlist I\'m Spiderman su Spotify', 'https://image-cdn-fa.spotifycdn.com/image/ab67706c0000da84966c6fb65030d70060019c5a', 'Caricamenti'),
	(98, 4, 'G(old)', 'Ecco la mia playlist G(old) su Spotify', 'https://mosaic.scdn.co/640/ab67616d00001e02587d2127f6fa5a9786480d36ab67616d00001e0270f7a1b35d5165c85b95a0e0ab67616d00001e02927530e44371f0bc1bb296d4ab67616d00001e02e8dd4db47e7177c63b0b7d53', 'Caricamenti'),
	(99, 4, 'La mia playlist WEB PROGRAMMING', 'Ecco la mia playlist La mia playlist WEB PROGRAMMING su Spotify', 'https://mosaic.scdn.co/640/ab67616d00001e023395f3e809dfbc2b1101d464ab67616d00001e023c29e91ff6eaef48d451b43fab67616d00001e02aaa9d84415623c1e790cd07bab67616d00001e02c41f4e1133b0e6c5fcf58680', 'Caricamenti'),
	(100, 85, 'PARIS, FRANCE 4K - Relaxing Music Along With Beaut', 'Paris was a universe whole and entire unto herself, hollowed and fashioned by history; so she seemed in this age of Napoleon III ...', 'https://i.ytimg.com/vi/wlYJSAd9qGI/mqdefault.jpg', 'Caricamenti'),
	(101, 86, 'Hawaii 4K - Scenic Relaxation Film with Calming Mu', 'Hawaii is one of the world\'s most beautiful destinations. Enjoy this 4K visual journey across the Hawaiian island of Oahu. I hope ...', 'https://i.ytimg.com/vi/MxcJtLbIhvs/mqdefault.jpg', 'Caricamenti'),
	(102, 87, 'San Francisco in 4K', 'From the majestic Golden Gate Bridge to the charming streets of Fisherman\'s Wharf, join us as we explore the diverse landscapes ...', 'https://i.ytimg.com/vi/h_ayZ-xcMd4/mqdefault.jpg', 'Caricamenti');

-- Dump della struttura di tabella hw2.preferiti
CREATE TABLE IF NOT EXISTS `preferiti` (
  `id_utente` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  PRIMARY KEY (`id_utente`,`id_post`),
  KEY `id_post` (`id_post`),
  CONSTRAINT `preferiti_ibfk_1` FOREIGN KEY (`id_utente`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `preferiti_ibfk_2` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.preferiti: ~28 rows (circa)
DELETE FROM `preferiti`;
INSERT INTO `preferiti` (`id_utente`, `id_post`) VALUES
	(1, 3),
	(4, 1),
	(4, 15),
	(4, 19),
	(4, 20),
	(4, 24),
	(4, 25),
	(4, 37),
	(4, 43),
	(4, 44),
	(4, 46),
	(4, 47),
	(4, 72),
	(4, 73),
	(4, 74),
	(4, 75),
	(4, 76),
	(4, 77),
	(4, 78),
	(4, 79),
	(4, 80),
	(4, 81),
	(4, 98),
	(4, 100),
	(4, 101),
	(4, 102);

-- Dump della struttura di tabella hw2.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.sessions: ~1 rows (circa)
DELETE FROM `sessions`;
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('7nFzWqpTYh5EUsrlXIzYUKkQdrdKHogruGWOkOzS', NULL, '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/137.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiTm5JTkE0VzJ0T1hpcENIY2pUVjF6UDNKM1hmOVBpczk3QldRbVZESiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly9sb2NhbGhvc3QvaHcyL3B1YmxpYy9mZXRjaEhvbWVDb250ZW50Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo3OiJ1c2VyX2lkIjtpOjQ7fQ==', 1749995524);

-- Dump della struttura di tabella hw2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dump dei dati della tabella hw2.users: ~39 rows (circa)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `surname`) VALUES
	(1, 'pippo', '$2y$10$e1A7ohI6L0vohc0Ll8qwQOPZIa86nwy/WKscSVDVz5HLBSAdCytJW', 'sdadsadas@gmail.com', 'Pippo', 'Rossi'),
	(2, 'pluto', '$2y$10$tBYnG6t9CT6LeEMRbrYXD.h9h.TXR3rHnKTT4HmvCbRfAYsseCSC.', 'saddas@gmail.com', 'PLUTO', 'BIANCHI'),
	(3, 'paperino', '$2y$10$Vty5Tvzd7N/XjbdfEDfGH.0OYPTdgMZ8qH0TWibV2dyqYNCgq5zwe', 'sjdsijdsa@gmail.com', 'Paolino Giuseppino', 'Paperino'),
	(4, 'platax', '$2y$10$GinOfS5rNPgiXPvizIc2WullzbT.CD6lZY5J8l9RFy3C8AtBRrVnu', 'dasasd@studium.unict.it', 'Simone', 'Platania'),
	(5, 'alice', 'hashed_password_1', 'alice@example.com', 'Alice', 'Rossi'),
	(6, 'bob', 'hashed_password_2', 'bob@example.com', 'Bob', 'Verdi'),
	(7, 'carla', 'hashed_password_3', 'carla@example.com', 'Carla', 'Bianchi'),
	(8, 'agentCooper', 'hashed_password_4', 'dave@example.com', 'Dale', 'Cooper'),
	(10, 'platax2', '$2y$10$GinOfS5rNPgiXPvizIc2WullzbT.CD6lZY5J8l9RFy3C8AtBRrVnu', 'dsd@studium.unict.it', 'Simone', 'messina'),
	(11, 'bobbybrigs', '$2y$10$LGpKZRBo.3A8GPkA/6DgLedLz14Ao7xie69PsGYrRQqOoNry.gpoy', 'brobbdybrg@email.com', 'bobby', 'Briggs'),
	(24, 'Batman', '$2y$10$SrixzRwxnBDpLq6xkGQE7O1v1eUvyqOBqb3dLsBDxUxdYkEoOkV/q', 'batman@gmail.com', '12331', '132dasds'),
	(26, 'superman', '$2y$10$.pTP9hDiuWekQKU6P6VLie8uH9BHqTcTSgDANCTV0kIzimg1xBjCe', 'SUperman@example.com', 'WebProject', 'asd'),
	(46, 'IGN', 'ign@example.com', 'email@example.com', 'IGN', 'surname'),
	(55, 'Warner Bros.', 'warnerbros.@example.com', 'warnerbros.@example.com', 'Warner Bros.', 'surname'),
	(56, 'Cyberpunk 2077', 'cyberpunk2077@example.com', 'cyberpunk2077@example.com', 'Cyberpunk 2077', 'surname'),
	(57, 'Nintendo of Ame', 'nintendoofamerica@example.com', 'nintendoofamerica@example.com', 'Nintendo of Ame', 'surname'),
	(58, 'PLAYERINSIDE', 'playerinside@example.com', 'playerinside@example.com', 'PLAYERINSIDE', 'surname'),
	(59, 'Prodigeek', 'prodigeek@example.com', 'prodigeek@example.com', 'Prodigeek', 'surname'),
	(62, 'Poro Michele', 'poromichele@example.com', 'poromichele@example.com', 'Poro Michele', 'surname'),
	(64, 'PlayStation', 'playstation@example.com', 'playstation@example.com', 'PlayStation', 'surname'),
	(65, 'NVIDIA', 'nvidia@example.com', 'nvidia@example.com', 'NVIDIA', 'surname'),
	(66, 'Università di ', 'universitàdicatania-webtv@example.com', 'universitàdicatania-webtv@example.com', 'Università di ', 'surname'),
	(67, 'Evoice Erebus', 'evoiceerebus@example.com', 'evoiceerebus@example.com', 'Evoice Erebus', 'surname'),
	(69, 'Dalfang', 'dalfang@example.com', 'dalfang@example.com', 'Dalfang', 'surname'),
	(70, 'BigWynter', 'bigwynter@example.com', 'bigwynter@example.com', 'BigWynter', 'surname'),
	(72, 'Batman Arkham V', '', 'batmanarkhamvideos@example.com', 'Batman Arkham V', 'surname'),
	(73, 'World Athletics', '', 'worldathletics@example.com', 'World Athletics', 'surname'),
	(74, 'Red Bull', '', 'redbull@example.com', 'Red Bull', 'surname'),
	(75, 'Top Travel', '', 'toptravel@example.com', 'Top Travel', 'surname'),
	(76, 'GiorgiaVEVO', '', 'giorgiavevo@example.com', 'GiorgiaVEVO', 'surname'),
	(77, 'Exotic Vacation', '', 'exoticvacation@example.com', 'Exotic Vacation', 'surname'),
	(78, 'Isola degli Art', '', 'isoladegliartisti@example.com', 'Isola degli Art', 'surname'),
	(79, 'HowToMen', '', 'howtomen@example.com', 'HowToMen', 'surname'),
	(80, 'DC', '', 'dc@example.com', 'DC', 'surname'),
	(81, 'Marvel Entertai', '', 'marvelentertainment@example.com', 'Marvel Entertai', 'surname'),
	(82, 'Eleonora Petrel', '', 'eleonorapetrella@example.com', 'Eleonora Petrel', 'surname'),
	(83, 'DadoBax - Feel ', '', 'dadobax-feelthevideogames@example.com', 'DadoBax - Feel ', 'surname'),
	(84, 'MYGEMPICTURES', '', 'mygempictures@example.com', 'MYGEMPICTURES', 'surname'),
	(85, 'Peaceful Relaxa', '', 'peacefulrelaxation4k@example.com', 'Peaceful Relaxa', 'surname'),
	(86, 'Scenic Relaxati', '', 'scenicrelaxation@example.com', 'Scenic Relaxati', 'surname'),
	(87, 'Around The Worl', '', 'aroundtheworld4k@example.com', 'Around The Worl', 'surname');

-- Dump della struttura di tabella hw2.users_old
CREATE TABLE IF NOT EXISTS `users_old` (
  `id` int(10) unsigned NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dump dei dati della tabella hw2.users_old: ~0 rows (circa)
DELETE FROM `users_old`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
