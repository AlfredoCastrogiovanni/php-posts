-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 02, 2024 alle 14:43
-- Versione del server: 8.0.33
-- Versione PHP: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_blog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'PHP'),
(2, 'JS'),
(3, 'Laravel'),
(4, 'Vue');

-- --------------------------------------------------------

--
-- Struttura della tabella `posts`
--

CREATE TABLE `posts` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `content` text COLLATE utf8mb3_unicode_ci,
  `image` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dump dei dati per la tabella `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `image`, `user_id`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet ex pellentesque, rhoncus arcu sed, bibendum magna. Sed iaculis cursus massa, at placerat arcu venenatis tempus. Nulla nec leo non nisl fringilla fringilla in quis elit. Donec sit amet elit mattis, blandit nisl et, hendrerit odio. Proin a pulvinar nunc. Sed fringilla accumsan pulvinar. Nunc eget purus iaculis, placerat nibh sed, volutpat augue.\r\n\r\nMorbi sit amet cursus quam, a tempus sapien. Phasellus lobortis sapien sed pretium vehicula. In nec ipsum est. Pellentesque ligula ante, tristique dapibus mollis ac, tempor a leo. Etiam tincidunt vel ex posuere luctus. Proin vitae erat purus. Fusce enim ipsum, imperdiet quis pharetra at, viverra eu erat. Phasellus at posuere lorem. Vestibulum nec tincidunt eros, sed convallis magna. Nullam in urna tristique, tincidunt eros nec, pulvinar dolor. Pellentesque in neque ullamcorper, dapibus lorem non, fermentum odio. Fusce vitae est interdum leo cursus sodales.\r\n\r\nFusce vel laoreet nunc, nec fringilla lacus. Curabitur a tellus sit amet augue suscipit vestibulum. Nullam bibendum sit amet massa consequat accumsan. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Praesent iaculis arcu et dui condimentum tincidunt. Ut efficitur sem justo, in elementum tellus mattis tempor. Aenean vestibulum egestas egestas. Maecenas blandit arcu non tellus scelerisque, volutpat maximus mauris rutrum. Sed convallis nisi in mauris tincidunt, eu semper arcu placerat. Sed eleifend lacus ut interdum ultricies. Phasellus in metus magna.', NULL, 1, 2, '2023-12-30 11:30:37', '2024-01-02 14:42:22'),
(2, 'Laravel ipsum', 'Donec lacinia enim ac ante varius sollicitudin. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Nam at commodo arcu, iaculis bibendum magna. Praesent mollis arcu fermentum ligula finibus aliquet. Cras ultricies velit vel orci facilisis tincidunt. Vivamus laoreet dignissim ornare. Vestibulum et nunc velit. Curabitur dignissim venenatis eros, id placerat turpis molestie a. Cras commodo purus tincidunt euismod feugiat.\r\n\r\nNunc sem lorem, dignissim nec odio vitae, ultrices semper lorem. Curabitur suscipit leo sit amet sagittis blandit. Nulla vestibulum ligula non purus viverra, sed ornare nulla condimentum. Sed quis pulvinar libero. Sed eget tincidunt lorem, faucibus rutrum lacus. Etiam euismod in ex sed porttitor. Ut eget risus semper, pulvinar mauris eget, faucibus neque. Proin elementum sapien nec lacus gravida, quis congue odio ornare. Suspendisse potenti. Sed leo nisl, malesuada vel dolor vitae, pellentesque eleifend odio. Integer non ligula arcu. Nullam eu venenatis ante. Curabitur a turpis et est mattis efficitur vitae ac mauris. Duis ornare venenatis lorem, ut luctus est condimentum ornare.', NULL, 1, 3, '2023-12-30 12:17:35', '2024-01-02 14:26:08');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb3_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'Admin', '$2y$10$veDZEwticpnpI9tiZij3PutiVAw7lSB6HXQEshr1.mlDmz78DgXem');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `posts_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;