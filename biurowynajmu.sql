-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2024 at 04:43 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `biurowynajmu`
CREATE DATABASE IF NOT EXISTS `biurowynajmu` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biurowynajmu`;
--
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `ID_Adres` int(10) UNSIGNED NOT NULL,
  `Kod_Pocztowy` varchar(10) DEFAULT NULL,
  `Miasto` varchar(255) DEFAULT NULL,
  `Ulica` varchar(255) DEFAULT NULL,
  `Numer_Budynku` varchar(10) DEFAULT NULL,
  `Numer_Lokalu` varchar(10) DEFAULT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresy`
--

INSERT INTO `adresy` (`ID_Adres`, `Kod_Pocztowy`, `Miasto`, `Ulica`, `Numer_Budynku`, `Numer_Lokalu`, `Data_Modyfikacji`) VALUES
(1, '00-123', 'Warszawa', 'Aleje Jerozolimskie', '1', 'A', '2023-12-26 19:58:10'),
(2, '00-123', 'Warszawa', 'Aleje Jerozolimskie', '1', 'A', '2023-12-26 19:58:10'),
(8, '01-234', 'Warszawa', 'Aleje Ujazdowskie', '10', 'A', '2023-12-26 20:01:04'),
(9, '02-345', 'Kraków', 'Rynek Główny', '15', 'B', '2023-12-26 20:01:04'),
(10, '03-456', 'Gdańsk', 'Długi Targ', '20', 'C', '2023-12-26 20:01:04'),
(11, '04-567', 'Poznań', 'Stary Rynek', '25', 'D', '2023-12-26 20:01:04'),
(12, '05-678', 'Wrocław', 'Rynek', '30', 'E', '2023-12-26 20:01:04'),
(13, '06-789', 'Łódź', 'Piotrkowska', '35', 'F', '2023-12-26 20:01:04'),
(14, '07-890', 'Szczecin', 'Wały Chrobrego', '40', 'G', '2023-12-26 20:01:04'),
(15, '08-901', 'Bydgoszcz', 'Stary Rynek', '45', 'H', '2023-12-26 20:01:04'),
(16, '09-012', 'Katowice', 'Rynek', '50', 'I', '2023-12-26 20:01:04'),
(17, '10-123', 'Gdynia', 'Skwer Kościuszki', '55', '', '2024-01-04 17:03:34'),
(28, '00-001', 'Warszawa', 'Aleje Jerozolimskie', '1', '2', '2024-01-03 19:25:04'),
(29, '02-002', 'Kraków', 'Rynek Główny', '3', '4', '2024-01-03 19:25:04'),
(30, '03-003', 'Wrocław', 'Plac Solny', '5', '6', '2024-01-03 19:25:04'),
(31, '04-004', 'Gdańsk', 'ul. Długa', '7', '8', '2024-01-03 19:25:04'),
(32, '05-005', 'Poznań', 'Stary Rynek', '9', '10', '2024-01-03 19:25:04'),
(33, '06-006', 'Łódź', 'Piotrkowska', '11', '12', '2024-01-03 19:25:04'),
(34, '07-007', 'Szczecin', 'Wały Chrobrego', '13', '14', '2024-01-03 19:25:04'),
(35, '08-008', 'Bydgoszcz', 'ul. Gdańska', '15', '16', '2024-01-03 19:25:04'),
(36, '09-009', 'Katowice', 'Rynek', '17', '18', '2024-01-03 19:25:04'),
(37, '10-010', 'Białystok', 'ul. Lipowa', '19', '20', '2024-01-03 19:25:04'),
(38, '11-011', 'Gdynia', 'Skwer Kościuszki', '21', '22', '2024-01-03 19:25:04'),
(39, '12-012', 'Częstochowa', 'Aleja Najświętszej Maryi Panny', '23', '24', '2024-01-03 19:25:04'),
(40, '13-013', 'Radom', 'Rynek Starego Miasta', '25', '26', '2024-01-03 19:25:04'),
(41, '14-014', 'Sosnowiec', 'ul. 3 Maja', '27', '28', '2024-01-03 19:25:04'),
(42, '15-015', 'Kielce', 'Plac Zamkowy', '29', '30', '2024-01-03 19:25:04'),
(43, '16-016', 'Toruń', 'ul. Szeroka', '31', '32', '2024-01-03 19:25:04'),
(44, '17-017', 'Rzeszów', 'Rynek', '33', '34', '2024-01-03 19:25:04'),
(45, '18-018', 'Gliwice', 'ul. Zwycięstwa', '35', '36', '2024-01-03 19:25:04'),
(46, '19-019', 'Zabrze', 'Plac Teatralny', '37', '38', '2024-01-03 19:25:04'),
(47, '20-020', 'Olsztyn', 'ul. Mickiewicza', '39', '40', '2024-01-03 19:25:04'),
(48, '00-000', 'admin', 'admin', '00', '00', '2024-03-27 15:36:49');

-- --------------------------------------------------------

--
-- Zastąpiona struktura widoku `dostepne_lokale`
-- (See below for the actual view)
--
CREATE TABLE `dostepne_lokale` (
`ID_Lokalu` int(10) unsigned
,`ID_Adres` int(10) unsigned
,`Powierzchnia` decimal(10,2)
,`Kwota_Czynszu_Za_Dzien` decimal(10,2)
,`Nazwa_Lokalu` varchar(255)
,`Opis_Lokalu` text
,`Zdjecie_Lokalu` varchar(255)
,`Nazwa_Dostepnosci` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `dostepnosc_lokalu`
--

CREATE TABLE `dostepnosc_lokalu` (
  `ID_Dostepnosci` int(10) UNSIGNED NOT NULL,
  `Nazwa_Dostepnosci` varchar(255) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dostepnosc_lokalu`
--

INSERT INTO `dostepnosc_lokalu` (`ID_Dostepnosci`, `Nazwa_Dostepnosci`, `Data_Modyfikacji`) VALUES
(1, 'Dostępny', '2023-12-26 19:58:10'),
(3, 'Niedostępny', '2023-12-26 19:58:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `kredyty`
--

CREATE TABLE `kredyty` (
  `ID_Kredytu` int(10) UNSIGNED NOT NULL,
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `ID_Wniosku` int(10) UNSIGNED NOT NULL,
  `Kwota_Kredytu` decimal(10,2) NOT NULL,
  `Do_Splacenia` decimal(10,2) NOT NULL,
  `Rata_Kredytu` decimal(10,2) NOT NULL,
  `Ilosc_Rat_Do_Splacenia` int(11) NOT NULL,
  `Ile_Splaconych_Rat` int(11) NOT NULL,
  `Data_Wziecia_Kredytu` date NOT NULL DEFAULT current_timestamp(),
  `Data_Splacenia_Kredytu` date DEFAULT NULL,
  `Czy_Kredyt_Splacony` tinyint(1) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kredyty`
--

INSERT INTO `kredyty` (`ID_Kredytu`, `ID_Uzytkownika`, `ID_Wniosku`, `Kwota_Kredytu`, `Do_Splacenia`, `Rata_Kredytu`, `Ilosc_Rat_Do_Splacenia`, `Ile_Splaconych_Rat`, `Data_Wziecia_Kredytu`, `Data_Splacenia_Kredytu`, `Czy_Kredyt_Splacony`, `Data_Modyfikacji`) VALUES
(15, 3, 6, 100000.00, 110000.00, 1833.34, 60, 60, '2022-01-01', '2024-01-03', 1, '2024-01-11 17:14:06'),
(16, 17, 29, 20000.00, 22000.00, 2750.00, 8, 8, '2024-01-11', '2024-01-11', 1, '2024-01-11 17:16:32'),
(17, 17, 31, 123456.00, 135801.60, 1131.68, 120, 0, '2024-01-11', NULL, 0, '2024-01-11 18:05:35'),
(18, 17, 34, 10000.00, 11000.00, 91.67, 120, 0, '2024-01-14', NULL, 0, '2024-01-14 18:16:29');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lokale`
--

CREATE TABLE `lokale` (
  `ID_Lokalu` int(10) UNSIGNED NOT NULL,
  `ID_Adres` int(10) UNSIGNED NOT NULL,
  `Powierzchnia` decimal(10,2) NOT NULL,
  `ID_Dostepnosci` int(10) UNSIGNED NOT NULL,
  `Kwota_Czynszu_Za_Dzien` decimal(10,2) NOT NULL,
  `Nazwa_Lokalu` varchar(255) NOT NULL,
  `Opis_Lokalu` text NOT NULL,
  `Zdjecie_Lokalu` varchar(255) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lokale`
--

INSERT INTO `lokale` (`ID_Lokalu`, `ID_Adres`, `Powierzchnia`, `ID_Dostepnosci`, `Kwota_Czynszu_Za_Dzien`, `Nazwa_Lokalu`, `Opis_Lokalu`, `Zdjecie_Lokalu`, `Data_Modyfikacji`) VALUES
(1, 1, 80.00, 3, 150.00, 'Przykładowy Lokal 1', 'To jest przykładowy lokal o powierzchni 80m2.', 'lokale/obraz1.jpg', '2023-12-26 19:58:10'),
(2, 2, 100.00, 3, 200.00, 'Przykładowy Lokal 2', 'To jest inny przykładowy lokal o powierzchni 100m2.', 'obraz2.png', '2024-01-07 22:56:00'),
(43, 8, 80.00, 1, 150.00, 'Lokal 1', 'Przykładowy lokal o powierzchni 80m2.', 'lokale/obraz1.jpg', '2024-01-10 17:36:09'),
(44, 9, 100.00, 3, 200.00, 'Lokal 2', 'Inny przykładowy lokal o powierzchni 100m2.', 'lokale/obraz2.jpg', '2024-01-07 22:56:04'),
(45, 10, 120.00, 3, 180.00, 'Lokal 3', 'Przykładowy lokal na Długim Targu.', 'lokale/obraz3.jpg', '2023-12-26 20:03:29'),
(46, 11, 90.00, 1, 160.00, 'Lokal 4', 'Przykładowy lokal na Starym Rynku.', 'lokale/obraz4.jpg', '2024-01-10 19:14:49'),
(47, 12, 110.00, 3, 190.00, 'Lokal 5', 'Inny przykładowy lokal na Rynku.', 'lokale/obraz5.jpg', '2024-01-07 22:56:08'),
(48, 13, 95.00, 3, 170.00, 'Lokal 6', 'Przykładowy lokal na Piotrkowskiej.', 'lokale/obraz6.jpg', '2023-12-26 20:03:29'),
(49, 14, 1.00, 1, 140.00, 'Lokal 7', 'Przykładowy lokal na Wałach Chrobrego.', 'lokale/obraz7.jpg', '2023-12-26 20:03:29'),
(50, 15, 2.00, 3, 130.00, 'Lokal 8', 'Inny przykładowy lokal na Starym Rynku.', 'lokale/obraz8.jpg', '2024-01-07 22:56:11'),
(51, 16, 3.00, 3, 200.00, 'Lokal 9', 'Przykładowy lokal na Rynku.', 'lokale/obraz9.jpg', '2023-12-26 20:03:29'),
(52, 17, 4.00, 1, 180.00, 'Lokal 10', 'Przykładowy lokal na Skwerze Kościuszki.', 'lokale/obraz10.jpg', '2023-12-26 20:03:29'),
(73, 1, 50.00, 1, 200.00, 'Przykładowy Lokal 1', 'To jest przykładowy opis lokalu nr 1.', 'zdjecie1.jpg', '2024-01-03 19:28:37'),
(74, 2, 75.50, 1, 300.00, 'Przykładowy Lokal 2', 'To jest przykładowy opis lokalu nr 2.', 'zdjecie2.jpg', '2024-01-03 19:28:37'),
(75, 8, 40.00, 1, 150.00, 'Przykładowy Lokal 3', 'To jest przykładowy opis lokalu nr 3.', 'zdjecie3.jpg', '2024-01-03 19:28:37'),
(76, 9, 90.00, 1, 400.00, 'Przykładowy Lokal 4', 'To jest przykładowy opis lokalu nr 4.', 'zdjecie4.jpg', '2024-01-03 19:28:37'),
(77, 10, 60.00, 1, 250.00, 'Przykładowy Lokal 5', 'To jest przykładowy opis lokalu nr 5.', 'zdjecie5.jpg', '2024-01-03 19:28:37'),
(78, 11, 55.00, 1, 220.00, 'Przykładowy Lokal 6', 'To jest przykładowy opis lokalu nr 6.', 'zdjecie6.jpg', '2024-01-03 19:28:37'),
(79, 12, 70.00, 1, 280.00, 'Przykładowy Lokal 7', 'To jest przykładowy opis lokalu nr 7.', 'zdjecie7.jpg', '2024-01-03 19:28:37'),
(80, 13, 65.00, 1, 260.00, 'Przykładowy Lokal 8', 'To jest przykładowy opis lokalu nr 8.', 'zdjecie8.jpg', '2024-01-03 19:28:37'),
(81, 14, 85.00, 1, 350.00, 'Przykładowy Lokal 9', 'To jest przykładowy opis lokalu nr 9.', 'zdjecie9.jpg', '2024-01-03 19:28:37'),
(82, 15, 120.00, 1, 500.00, 'Przykładowy Lokal 10', 'To jest przykładowy opis lokalu nr 10.', 'zdjecie10.jpg', '2024-01-03 19:28:37'),
(83, 16, 45.00, 1, 180.00, 'Przykładowy Lokal 11', 'To jest przykładowy opis lokalu nr 11.', 'zdjecie11.jpg', '2024-01-03 19:28:37'),
(84, 17, 80.00, 1, 320.00, 'Przykładowy Lokal 12', 'To jest przykładowy opis lokalu nr 12.', 'zdjecie12.jpg', '2024-01-03 19:28:37'),
(85, 28, 95.00, 1, 380.00, 'Przykładowy Lokal 13', 'To jest przykładowy opis lokalu nr 13.', 'zdjecie13.jpg', '2024-01-03 19:28:37'),
(86, 29, 110.00, 1, 450.00, 'Przykładowy Lokal 14', 'To jest przykładowy opis lokalu nr 14.', 'zdjecie14.jpg', '2024-01-03 19:28:37'),
(87, 30, 50.00, 1, 200.00, 'Przykładowy Lokal 15', 'To jest przykładowy opis lokalu nr 15.', 'zdjecie15.jpg', '2024-01-03 19:28:37'),
(88, 31, 75.50, 1, 300.00, 'Przykładowy Lokal 16', 'To jest przykładowy opis lokalu nr 16.', 'zdjecie16.jpg', '2024-01-03 19:28:37'),
(89, 32, 40.00, 1, 150.00, 'Przykładowy Lokal 17', 'To jest przykładowy opis lokalu nr 17.', 'zdjecie17.jpg', '2024-01-03 19:28:37'),
(90, 33, 90.00, 1, 400.00, 'Przykładowy Lokal 18', 'To jest przykładowy opis lokalu nr 18.', 'zdjecie18.jpg', '2024-01-03 19:28:37'),
(91, 34, 60.00, 1, 250.00, 'Przykładowy Lokal 19', 'To jest przykładowy opis lokalu nr 19.', 'zdjecie19.jpg', '2024-01-03 19:28:37'),
(92, 35, 55.00, 1, 220.00, 'Przykładowy Lokal 20', 'To jest przykładowy opis lokalu nr 20.', 'zdjecie20.jpg', '2024-01-03 19:28:37');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rodzaj_wniosku`
--

CREATE TABLE `rodzaj_wniosku` (
  `ID_Rodzaj_Wniosku` int(10) UNSIGNED NOT NULL,
  `Nazwa_Rodzaju_Wniosku` varchar(255) NOT NULL,
  `Opis_Rodzaju_Wniosku` text DEFAULT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rodzaj_wniosku`
--

INSERT INTO `rodzaj_wniosku` (`ID_Rodzaj_Wniosku`, `Nazwa_Rodzaju_Wniosku`, `Opis_Rodzaju_Wniosku`, `Data_Modyfikacji`) VALUES
(1, 'Wynajem mieszkania', 'Wniosek o wynajem mieszkania na stałe zamieszkanie', '2023-12-26 19:58:10'),
(2, 'Kredyt hipoteczny', 'Wniosek o przyznanie kredytu na zakup nieruchomości', '2023-12-26 19:58:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rola`
--

CREATE TABLE `rola` (
  `ID_Roli` int(10) UNSIGNED NOT NULL,
  `Nazwa_Roli` varchar(255) NOT NULL,
  `Opis_Roli` text NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rola`
--

INSERT INTO `rola` (`ID_Roli`, `Nazwa_Roli`, `Opis_Roli`, `Data_Modyfikacji`) VALUES
(1, 'Admin', 'Administrator systemu', '2023-12-29 15:44:24'),
(2, 'Uzytkownik', 'Zwykły użytkownik', '2023-12-29 15:44:24'),
(3, 'Pracownik', 'Pracownik biura wynajmu', '2024-01-04 17:05:50');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status_wniosek`
--

CREATE TABLE `status_wniosek` (
  `ID_Status_Wniosku` int(10) UNSIGNED NOT NULL,
  `Nazwa_Statusu` varchar(255) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_wniosek`
--

INSERT INTO `status_wniosek` (`ID_Status_Wniosku`, `Nazwa_Statusu`, `Data_Modyfikacji`) VALUES
(1, 'Oczekuje', '2023-12-26 19:58:10'),
(2, 'Zatwierdzony', '2023-12-26 19:58:10'),
(3, 'Odrzucony', '2023-12-26 19:58:10');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `status_zgloszenia`
--

CREATE TABLE `status_zgloszenia` (
  `ID_Status_Zgloszenia` int(10) UNSIGNED NOT NULL,
  `Nazwa_Statusu` varchar(255) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `status_zgloszenia`
--

INSERT INTO `status_zgloszenia` (`ID_Status_Zgloszenia`, `Nazwa_Statusu`, `Data_Modyfikacji`) VALUES
(1, 'Oczekuje', '2023-12-26 19:58:10'),
(2, 'W trakcie realizacji', '2023-12-26 19:58:10'),
(3, 'Zakończone', '2023-12-26 19:58:10'),
(4, 'Odrzucone', '2024-01-10 16:57:22');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tranzakcje`
--

CREATE TABLE `tranzakcje` (
  `ID_Tranzakcji` int(10) UNSIGNED NOT NULL,
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `Tytul_Tranzakcji` varchar(255) NOT NULL,
  `Opis_Tranzakcji` text DEFAULT 'Brak Opisu',
  `Stan_Kont_Po_Tranzakcji` decimal(10,2) NOT NULL,
  `Kwota_Tranzakcji` decimal(10,2) NOT NULL,
  `Data_Tranzakcji` timestamp NOT NULL DEFAULT current_timestamp(),
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tranzakcje`
--

INSERT INTO `tranzakcje` (`ID_Tranzakcji`, `ID_Uzytkownika`, `Tytul_Tranzakcji`, `Opis_Tranzakcji`, `Stan_Kont_Po_Tranzakcji`, `Kwota_Tranzakcji`, `Data_Tranzakcji`, `Data_Modyfikacji`) VALUES
(1, 4, 'Doładowanie Konta', 'Brak Opisu', 1300.00, 200.00, '2024-01-03 15:39:19', '2023-12-29 20:55:14'),
(2, 3, 'Doładowanie Konta', 'Doładowanie Konta', 19200.00, 2000.00, '2024-01-03 15:39:19', '2023-12-29 20:58:07'),
(3, 3, 'Doładowanie Konta', 'Doładowanie Konta', 99999999.99, 99999999.99, '2024-01-03 15:39:19', '2024-01-03 15:10:52'),
(10, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99935199.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:22:24'),
(11, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99933999.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:16'),
(12, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99932799.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:17'),
(13, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99931599.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:18'),
(14, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99930399.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:19'),
(15, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99929199.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:19'),
(16, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 1', 99927999.99, -1200.00, '2024-01-03 15:39:19', '2024-01-03 15:23:19'),
(17, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 24', 99899199.99, -28800.00, '2024-01-03 15:39:19', '2024-01-03 15:23:46'),
(18, 3, 'Doładowanie Konta', 'Doładowanie Konta', 99900199.99, 1000.00, '2024-01-03 15:54:41', '2024-01-03 15:54:41'),
(19, 3, 'Spłata kredytu', 'Ilość zapłaconych rat: 29', 99865399.99, -34800.00, '2024-01-03 16:05:17', '2024-01-03 16:05:17'),
(20, 17, 'Doładowanie Konta', 'Doładowanie Konta', 10000.00, 10000.00, '2024-01-04 17:09:38', '2024-01-04 17:09:38'),
(21, 17, 'Spłata kredytu', 'Ilość zapłaconych rat: 3', 1750.00, -8250.00, '2024-01-11 17:16:09', '2024-01-11 17:16:09'),
(22, 17, 'Doładowanie Konta', 'Doładowanie Konta', 301750.00, 300000.00, '2024-01-11 17:16:21', '2024-01-11 17:16:21'),
(23, 17, 'Spłata kredytu', 'Ilość zapłaconych rat: 5', 288000.00, -13750.00, '2024-01-11 17:16:31', '2024-01-11 17:16:31'),
(26, 17, 'Opłacenie Lokalu', 'Opłacenie Lokalu', 283200.00, -1600.00, '2024-01-14 18:13:47', '2024-01-14 18:13:47'),
(27, 17, 'Doładowanie Konta', 'Doładowanie Konta', 10000.00, 10000.00, '2024-01-14 18:17:27', '2024-01-14 18:17:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `uzytkownicy`
--

CREATE TABLE `uzytkownicy` (
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Haslo` varchar(255) NOT NULL,
  `Imie` varchar(255) NOT NULL,
  `Nazwisko` varchar(255) NOT NULL,
  `Data_Urodzenia` date DEFAULT NULL,
  `Numer_Telefonu` varchar(15) DEFAULT NULL,
  `ID_Adres_Zamieszkania` int(10) UNSIGNED NOT NULL,
  `Aktualne_Zarobki` decimal(10,2) DEFAULT NULL,
  `Stan_Konta` decimal(10,2) DEFAULT NULL,
  `ID_Roli` int(10) UNSIGNED NOT NULL,
  `Data_Zalozenia_Konta` timestamp NOT NULL DEFAULT current_timestamp(),
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `uzytkownicy`
--

INSERT INTO `uzytkownicy` (`ID_Uzytkownika`, `Email`, `Haslo`, `Imie`, `Nazwisko`, `Data_Urodzenia`, `Numer_Telefonu`, `ID_Adres_Zamieszkania`, `Aktualne_Zarobki`, `Stan_Konta`, `ID_Roli`, `Data_Zalozenia_Konta`, `Data_Modyfikacji`) VALUES
(3, 'jan.kowalski@example.com', '$2y$10$I0Rk/oRRlblbLh5Wb1MCiOPse0ZprfA9DHjmHBMHu0K2.wKtkivq2', 'Jan', 'Kowalski', '1990-01-02', '123456789', 17, 5000.00, 99865399.99, 2, '2024-01-04 20:37:56', '2024-01-04 17:01:52'),
(4, 'anna.nowak@example.com', '$2y$10$I0Rk/oRRlblbLh5Wb1MCiOPse0ZprfA9DHjmHBMHu0K2.wKtkivq2', 'Anna', 'Nowak', '1985-05-22', '987654321', 2, 6000.00, 1500.00, 2, '2024-01-04 20:37:56', '2023-12-28 21:24:18'),
(17, 'kubabonda@o2.pl', '$2y$10$I0Rk/oRRlblbLh5Wb1MCiOPse0ZprfA9DHjmHBMHu0K2.wKtkivq2', 'Jakub', 'Bonda', '2023-12-14', '507433691', 14, 2000.00, 10000.00, 3, '2024-01-04 20:37:56', '2024-01-14 18:17:27'),
(18, 'kubabonda1@o2.pl', '$2y$10$9yA5c6jSV9AX20Z1Xze.YecN3nM7VtRzUs2BVm7XxSb5JwTxre2bi', 'Jakub', 'Bonda', '1992-11-13', '507433691', 2, 2000.00, 123113.00, 2, '2024-01-04 20:37:56', '2024-01-03 19:27:22'),
(23, 'admin@wp.pl', '$2y$10$DE79VDlymwEyjAR.utptouurzve4y0JMLyVAgKWFRhqEtDXe1ri4y', 'admin', 'admin', '2024-03-27', '000000000', 48, 10000.00, NULL, 1, '2024-03-27 15:36:49', '2024-03-27 15:36:49');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wnioski`
--

CREATE TABLE `wnioski` (
  `ID_Wniosku` int(10) UNSIGNED NOT NULL,
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `ID_Rodzaj_Wniosku` int(10) UNSIGNED NOT NULL,
  `Data_Wniosku` timestamp NOT NULL DEFAULT current_timestamp(),
  `ID_Status_Wniosku` int(10) UNSIGNED NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wnioski`
--

INSERT INTO `wnioski` (`ID_Wniosku`, `ID_Uzytkownika`, `ID_Rodzaj_Wniosku`, `Data_Wniosku`, `ID_Status_Wniosku`, `Data_Modyfikacji`) VALUES
(6, 4, 2, '2022-02-19 23:00:00', 2, '2024-01-14 18:07:34'),
(29, 17, 2, '2024-01-11 17:15:11', 2, '2024-01-11 17:15:52'),
(31, 17, 2, '2024-01-11 18:05:35', 2, '2024-01-14 17:57:43'),
(32, 17, 1, '2024-01-14 17:55:45', 2, '2024-01-14 18:05:12'),
(33, 17, 1, '2024-01-14 17:57:21', 2, '2024-01-14 18:13:47'),
(34, 17, 2, '2024-01-14 18:16:29', 2, '2024-01-14 18:17:27');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wynajem`
--

CREATE TABLE `wynajem` (
  `ID_Wynajmu` int(10) UNSIGNED NOT NULL,
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `ID_Lokalu` int(10) UNSIGNED NOT NULL,
  `ID_Wniosku` int(10) UNSIGNED NOT NULL,
  `Data_Poczatkowa_Wynajmu` date DEFAULT NULL,
  `Data_Koncowa_Wynajmu` date DEFAULT NULL,
  `Ilosc_Dni_Wynajmu` int(11) DEFAULT NULL,
  `Koszt_Wynajmu` decimal(10,2) NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wynajem`
--

INSERT INTO `wynajem` (`ID_Wynajmu`, `ID_Uzytkownika`, `ID_Lokalu`, `ID_Wniosku`, `Data_Poczatkowa_Wynajmu`, `Data_Koncowa_Wynajmu`, `Ilosc_Dni_Wynajmu`, `Koszt_Wynajmu`, `Data_Modyfikacji`) VALUES
(17, 17, 43, 32, '2024-01-22', '2024-01-29', 8, 1200.00, '2024-01-14 17:55:45'),
(18, 17, 46, 33, '2024-01-31', '2024-02-09', 10, 1600.00, '2024-01-14 17:57:21');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `zgloszenia_serwisowe`
--

CREATE TABLE `zgloszenia_serwisowe` (
  `ID_Zgloszenia` int(10) UNSIGNED NOT NULL,
  `ID_Uzytkownika` int(10) UNSIGNED NOT NULL,
  `ID_Lokalu` int(10) UNSIGNED NOT NULL,
  `Opis_Problemu` text DEFAULT NULL,
  `Data_Zgloszenia` timestamp NULL DEFAULT current_timestamp(),
  `ID_Status_Zgloszenia` int(10) UNSIGNED NOT NULL,
  `Data_Modyfikacji` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `zgloszenia_serwisowe`
--

INSERT INTO `zgloszenia_serwisowe` (`ID_Zgloszenia`, `ID_Uzytkownika`, `ID_Lokalu`, `Opis_Problemu`, `Data_Zgloszenia`, `ID_Status_Zgloszenia`, `Data_Modyfikacji`) VALUES
(1, 4, 1, 'Awaria prądu', '2022-03-09 23:00:00', 1, '2023-12-26 19:58:10'),
(2, 4, 1, 'Wyciek wody', '2022-04-14 22:00:00', 1, '2023-12-26 19:58:10'),
(4, 4, 2, 'AAA', '2024-01-03 23:11:53', 2, '2024-01-10 17:22:14'),
(5, 4, 2, 'fafsafadasdafafsa', '2024-01-03 14:06:49', 4, '2024-01-10 17:25:07'),
(6, 17, 46, 'dafafsafadsadfgdfhdfgdg', '2024-01-07 23:56:17', 3, '2024-01-10 17:25:54');

-- --------------------------------------------------------

--
-- Struktura widoku `dostepne_lokale`
--
DROP TABLE IF EXISTS `dostepne_lokale`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dostepne_lokale`  AS   (select `lokale`.`ID_Lokalu` AS `ID_Lokalu`,`lokale`.`ID_Adres` AS `ID_Adres`,`lokale`.`Powierzchnia` AS `Powierzchnia`,`lokale`.`Kwota_Czynszu_Za_Dzien` AS `Kwota_Czynszu_Za_Dzien`,`lokale`.`Nazwa_Lokalu` AS `Nazwa_Lokalu`,`lokale`.`Opis_Lokalu` AS `Opis_Lokalu`,`lokale`.`Zdjecie_Lokalu` AS `Zdjecie_Lokalu`,`dostepnosc_lokalu`.`Nazwa_Dostepnosci` AS `Nazwa_Dostepnosci` from (`lokale` join `dostepnosc_lokalu` on(`lokale`.`ID_Dostepnosci` = `dostepnosc_lokalu`.`ID_Dostepnosci`)) where `dostepnosc_lokalu`.`Nazwa_Dostepnosci` = 'Dostępny')  ;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`ID_Adres`);

--
-- Indeksy dla tabeli `dostepnosc_lokalu`
--
ALTER TABLE `dostepnosc_lokalu`
  ADD PRIMARY KEY (`ID_Dostepnosci`);

--
-- Indeksy dla tabeli `kredyty`
--
ALTER TABLE `kredyty`
  ADD PRIMARY KEY (`ID_Kredytu`),
  ADD KEY `ID_Uzytkownika` (`ID_Uzytkownika`),
  ADD KEY `ID_Wniosku` (`ID_Wniosku`);

--
-- Indeksy dla tabeli `lokale`
--
ALTER TABLE `lokale`
  ADD PRIMARY KEY (`ID_Lokalu`),
  ADD KEY `ID_Adres` (`ID_Adres`),
  ADD KEY `ID_Dostepnosci` (`ID_Dostepnosci`);

--
-- Indeksy dla tabeli `rodzaj_wniosku`
--
ALTER TABLE `rodzaj_wniosku`
  ADD PRIMARY KEY (`ID_Rodzaj_Wniosku`);

--
-- Indeksy dla tabeli `rola`
--
ALTER TABLE `rola`
  ADD PRIMARY KEY (`ID_Roli`);

--
-- Indeksy dla tabeli `status_wniosek`
--
ALTER TABLE `status_wniosek`
  ADD PRIMARY KEY (`ID_Status_Wniosku`);

--
-- Indeksy dla tabeli `status_zgloszenia`
--
ALTER TABLE `status_zgloszenia`
  ADD PRIMARY KEY (`ID_Status_Zgloszenia`);

--
-- Indeksy dla tabeli `tranzakcje`
--
ALTER TABLE `tranzakcje`
  ADD PRIMARY KEY (`ID_Tranzakcji`),
  ADD KEY `tranzakcje_ibfk_1` (`ID_Uzytkownika`);

--
-- Indeksy dla tabeli `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD PRIMARY KEY (`ID_Uzytkownika`),
  ADD KEY `ID_Adres_Zamieszkania` (`ID_Adres_Zamieszkania`),
  ADD KEY `ID_Roli` (`ID_Roli`);

--
-- Indeksy dla tabeli `wnioski`
--
ALTER TABLE `wnioski`
  ADD PRIMARY KEY (`ID_Wniosku`),
  ADD KEY `ID_Uzytkownika` (`ID_Uzytkownika`),
  ADD KEY `ID_Rodzaj_Wniosku` (`ID_Rodzaj_Wniosku`),
  ADD KEY `ID_Status_Wniosku` (`ID_Status_Wniosku`);

--
-- Indeksy dla tabeli `wynajem`
--
ALTER TABLE `wynajem`
  ADD PRIMARY KEY (`ID_Wynajmu`),
  ADD KEY `ID_Uzytkownika` (`ID_Uzytkownika`),
  ADD KEY `ID_Lokalu` (`ID_Lokalu`),
  ADD KEY `ID_Wniosku` (`ID_Wniosku`);

--
-- Indeksy dla tabeli `zgloszenia_serwisowe`
--
ALTER TABLE `zgloszenia_serwisowe`
  ADD PRIMARY KEY (`ID_Zgloszenia`),
  ADD KEY `ID_Uzytkownika` (`ID_Uzytkownika`),
  ADD KEY `ID_Lokalu` (`ID_Lokalu`),
  ADD KEY `ID_Status_Zgloszenia` (`ID_Status_Zgloszenia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `ID_Adres` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `dostepnosc_lokalu`
--
ALTER TABLE `dostepnosc_lokalu`
  MODIFY `ID_Dostepnosci` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `kredyty`
--
ALTER TABLE `kredyty`
  MODIFY `ID_Kredytu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lokale`
--
ALTER TABLE `lokale`
  MODIFY `ID_Lokalu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `rodzaj_wniosku`
--
ALTER TABLE `rodzaj_wniosku`
  MODIFY `ID_Rodzaj_Wniosku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `rola`
--
ALTER TABLE `rola`
  MODIFY `ID_Roli` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `status_wniosek`
--
ALTER TABLE `status_wniosek`
  MODIFY `ID_Status_Wniosku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `status_zgloszenia`
--
ALTER TABLE `status_zgloszenia`
  MODIFY `ID_Status_Zgloszenia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tranzakcje`
--
ALTER TABLE `tranzakcje`
  MODIFY `ID_Tranzakcji` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  MODIFY `ID_Uzytkownika` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wnioski`
--
ALTER TABLE `wnioski`
  MODIFY `ID_Wniosku` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `wynajem`
--
ALTER TABLE `wynajem`
  MODIFY `ID_Wynajmu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `zgloszenia_serwisowe`
--
ALTER TABLE `zgloszenia_serwisowe`
  MODIFY `ID_Zgloszenia` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kredyty`
--
ALTER TABLE `kredyty`
  ADD CONSTRAINT `kredyty_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID_Uzytkownika`),
  ADD CONSTRAINT `kredyty_ibfk_2` FOREIGN KEY (`ID_Wniosku`) REFERENCES `wnioski` (`ID_Wniosku`);

--
-- Constraints for table `lokale`
--
ALTER TABLE `lokale`
  ADD CONSTRAINT `lokale_ibfk_1` FOREIGN KEY (`ID_Adres`) REFERENCES `adresy` (`ID_Adres`),
  ADD CONSTRAINT `lokale_ibfk_2` FOREIGN KEY (`ID_Dostepnosci`) REFERENCES `dostepnosc_lokalu` (`ID_Dostepnosci`);

--
-- Constraints for table `tranzakcje`
--
ALTER TABLE `tranzakcje`
  ADD CONSTRAINT `tranzakcje_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID_Uzytkownika`);

--
-- Constraints for table `uzytkownicy`
--
ALTER TABLE `uzytkownicy`
  ADD CONSTRAINT `uzytkownicy_ibfk_1` FOREIGN KEY (`ID_Adres_Zamieszkania`) REFERENCES `adresy` (`ID_Adres`),
  ADD CONSTRAINT `uzytkownicy_ibfk_2` FOREIGN KEY (`ID_Roli`) REFERENCES `rola` (`ID_Roli`);

--
-- Constraints for table `wnioski`
--
ALTER TABLE `wnioski`
  ADD CONSTRAINT `wnioski_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID_Uzytkownika`),
  ADD CONSTRAINT `wnioski_ibfk_2` FOREIGN KEY (`ID_Rodzaj_Wniosku`) REFERENCES `rodzaj_wniosku` (`ID_Rodzaj_Wniosku`),
  ADD CONSTRAINT `wnioski_ibfk_3` FOREIGN KEY (`ID_Status_Wniosku`) REFERENCES `status_wniosek` (`ID_Status_Wniosku`);

--
-- Constraints for table `wynajem`
--
ALTER TABLE `wynajem`
  ADD CONSTRAINT `wynajem_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID_Uzytkownika`),
  ADD CONSTRAINT `wynajem_ibfk_2` FOREIGN KEY (`ID_Lokalu`) REFERENCES `lokale` (`ID_Lokalu`),
  ADD CONSTRAINT `wynajem_ibfk_3` FOREIGN KEY (`ID_Wniosku`) REFERENCES `wnioski` (`ID_Wniosku`);

--
-- Constraints for table `zgloszenia_serwisowe`
--
ALTER TABLE `zgloszenia_serwisowe`
  ADD CONSTRAINT `zgloszenia_serwisowe_ibfk_1` FOREIGN KEY (`ID_Uzytkownika`) REFERENCES `uzytkownicy` (`ID_Uzytkownika`),
  ADD CONSTRAINT `zgloszenia_serwisowe_ibfk_2` FOREIGN KEY (`ID_Lokalu`) REFERENCES `lokale` (`ID_Lokalu`),
  ADD CONSTRAINT `zgloszenia_serwisowe_ibfk_3` FOREIGN KEY (`ID_Status_Zgloszenia`) REFERENCES `status_zgloszenia` (`ID_Status_Zgloszenia`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
