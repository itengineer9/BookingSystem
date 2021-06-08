-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 08. Jun 2021 um 08:51
-- Server-Version: 10.4.18-MariaDB
-- PHP-Version: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `termine`
--
-- --------------------------------------------------------
--
-- Tabellenstruktur für Tabelle `buchung`
--

CREATE TABLE `buchung` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `timeslot` varchar(20) NOT NULL,
  `date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Daten für Tabelle `buchung`
--

INSERT INTO `buchung` (`id`, `name`, `email`, `timeslot`, `date`) VALUES
(51, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:30PM-12:45PM', '21-06-08'),
(52, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:00PM-12:15PM', '21-06-08'),
(53, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '13:00PM-13:15PM', '21-06-08'),
(54, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '13:30PM-13:45PM', '21-06-08'),
(55, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '14:00PM-14:15PM', '21-06-08'),
(56, 'Fatima Azawi', 'alhamad.ahmad@web.de', '14:30PM-14:45PM', '21-06-08'),
(57, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '09:00AM-09:15AM', '21-06-08'),
(58, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '09:30AM-09:45AM', '21-06-08'),
(59, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '10:00AM-10:15AM', '21-06-08'),
(60, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '10:30AM-10:45AM', '21-06-08'),
(61, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '11:00AM-11:15AM', '21-06-08'),
(62, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '11:30AM-11:45AM', '21-06-08'),
(63, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:00PM-12:15PM', '21-06-09'),
(64, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '13:00PM-13:15PM', '21-06-16'),
(65, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '13:30PM-13:45PM', '21-07-02'),
(66, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '14:00PM-14:15PM', '21-07-02'),
(67, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '13:00PM-13:15PM', '21-07-02'),
(68, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:30PM-12:45PM', '21-07-08'),
(69, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:30PM-12:45PM', '21-07-02'),
(70, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '12:00PM-12:15PM', '21-07-02'),
(79, 'Ahmad Alhamad', 'alhamad.ahmad@web.de', '14:00PM-14:15PM', '21-06-16'),
(80, '13%&quot;$%$', 'alhamad.ahmad@web.de', '12:30PM-12:45PM', '21-06-09'),
(81, '34rd', 'alhamad.ahmad@web.de', '13:00PM-13:15PM', '21-06-10');

--
-- Indizes der exportierten Tabellen
--
--
-- Indizes für die Tabelle `buchung`
--
ALTER TABLE `buchung`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `buchung`
--
ALTER TABLE `buchung`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
