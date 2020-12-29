-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Gegenereerd op: 29 dec 2020 om 14:53
-- Serverversie: 10.3.24-MariaDB-cll-lve
-- PHP-versie: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_name`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `access`
--

CREATE TABLE `access` (
  `id` int(255) NOT NULL,
  `figure_id` int(255) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `access`
--

INSERT INTO `access` (`id`, `figure_id`, `password`) VALUES
(34, 34, 'admin'),

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attacks`
--

CREATE TABLE `attacks` (
  `id` int(255) NOT NULL,
  `set_id` int(255) NOT NULL,
  `name` varchar(200) NOT NULL,
  `color` varchar(20) NOT NULL,
  `size` int(3) NOT NULL,
  `damage` int(10) NOT NULL,
  `descr` varchar(1000) NOT NULL DEFAULT 'none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `attacks`
--

INSERT INTO `attacks` (`id`, `set_id`, `name`, `color`, `size`, `damage`, `descr`) VALUES
(22, 34, 'Spectral Thief', 'white', 36, 70, 'This Attacks damage is boosted by the amount of any Attack damage increases from the battle opponents Ability'),
(23, 34, 'Miss', 'red', 4, 0, 'none'),
(24, 34, 'Shadow Sneak', 'gold', 32, 30, 'none'),
(25, 34, 'Dodge', 'blue', 24, 0, 'none'),
(80, 61, 'Miss', 'red', 4, 0, 'Miss'),


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `attack_set`
--

CREATE TABLE `attack_set` (
  `id` int(11) NOT NULL,
  `figure_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `attack_set`
--

INSERT INTO `attack_set` (`id`, `figure_id`) VALUES
(34, 34),


-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `figures`
--

CREATE TABLE `figures` (
  `id` int(255) NOT NULL,
  `figname` varchar(50) NOT NULL,
  `ability_name` varchar(100) NOT NULL,
  `ability` varchar(1000) NOT NULL,
  `type_1` varchar(15) NOT NULL,
  `type_2` varchar(15) NOT NULL,
  `mp` int(1) NOT NULL,
  `rarity` varchar(2) NOT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Gegevens worden geëxporteerd voor tabel `figures`
--

INSERT INTO `figures` (`id`, `figname`, `ability_name`, `ability`, `type_1`, `type_2`, `mp`, `rarity`, `user`) VALUES
(34, 'Marshadow', 'Gloomdweller', 'This PokÃ©mon can MP move through other PokÃ©mon on the field. While this PokÃ©mon is on the field, opposing PokÃ©mon deal -20 damage for each Ghost-type PokÃ©mon adjacent to them. This effect does not stack..', 'Ghost', 'Fighting', 3, 'EX', 'Divani'),

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `access`
--
ALTER TABLE `access`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `attacks`
--
ALTER TABLE `attacks`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `attack_set`
--
ALTER TABLE `attack_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `figures`
--
ALTER TABLE `figures`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `access`
--
ALTER TABLE `access`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=725;

--
-- AUTO_INCREMENT voor een tabel `attacks`
--
ALTER TABLE `attacks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1514;

--
-- AUTO_INCREMENT voor een tabel `attack_set`
--
ALTER TABLE `attack_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=725;

--
-- AUTO_INCREMENT voor een tabel `figures`
--
ALTER TABLE `figures`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=725;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
