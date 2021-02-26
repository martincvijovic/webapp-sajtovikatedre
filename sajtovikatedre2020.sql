-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 26, 2021 at 04:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sajtovikatedre2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `email` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`email`) VALUES
('admin2@etf.bg.ac.rs'),
('admin@etf.bg.ac.rs');

-- --------------------------------------------------------

--
-- Table structure for table `drzi_predmet`
--

CREATE TABLE `drzi_predmet` (
  `ident` int(11) NOT NULL,
  `id_nastavnika` varchar(100) COLLATE utf8_bin NOT NULL,
  `sifra_predmet` varchar(100) COLLATE utf8_bin NOT NULL,
  `grupa` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `drzi_predmet`
--

INSERT INTO `drzi_predmet` (`ident`, `id_nastavnika`, `sifra_predmet`, `grupa`) VALUES
(1, 'elmezeni@etf.bg.ac.rs', 'OE4DOS', 'P1'),
(2, 'elmezeni@etf.bg.ac.rs', 'OE4DOS', 'V1'),
(3, 'radivoje@etf.bg.ac.rs', 'OE2OE', 'P1'),
(4, 'radivoje@etf.bg.ac.rs', 'OE2OE', 'V1'),
(5, 'elmezeni@etf.bg.ac.rs', 'OE3DE', 'P1'),
(6, 'elmezeni@etf.bg.ac.rs', 'OE3DE', 'V1'),
(7, 'radivoje@etf.bg.ac.rs', 'OE4RFE', 'P1'),
(8, 'radivoje@etf.bg.ac.rs', 'OE4RFE', 'V1'),
(9, 'radivoje@etf.bg.ac.rs', 'OE2OAE', 'V1'),
(10, 'misic@etf.bg.ac.rs', 'IR2ASP', 'P1'),
(11, 'elmezeni@etf.bg.ac.rs', 'OE4DOS', 'P2'),
(12, 'drasko@etf.bg.ac.rs', 'IR1ORT', 'P1'),
(13, 'misic@etf.bg.ac.rs', 'IR1P1', 'P1'),
(14, 'misic@etf.bg.ac.rs', 'IR1P1', 'V1'),
(15, 'misic@etf.bg.ac.rs', 'IR1P2', 'P1'),
(16, 'drasko@etf.bg.ac.rs', 'IR5KER', 'P1'),
(17, 'misic@etf.bg.ac.rs', 'IR2OO1', 'P1'),
(18, 'misic@etf.bg.ac.rs', 'IR2OO2', 'P1'),
(19, 'drasko@etf.bg.ac.rs', 'IR2OOP', 'P1');

-- --------------------------------------------------------

--
-- Table structure for table `fajl_uz_obavestenje`
--

CREATE TABLE `fajl_uz_obavestenje` (
  `idfajla` int(11) NOT NULL,
  `id_obavestenja` int(11) NOT NULL,
  `putanja` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `fajl_uz_obavestenje`
--

INSERT INTO `fajl_uz_obavestenje` (`idfajla`, `id_obavestenja`, `putanja`) VALUES
(5, 13, 'files/Displej.pdf'),
(6, 14, 'files/diplomski.txt'),
(7, 6, 'files/Displej.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija_obavestenja`
--

CREATE TABLE `kategorija_obavestenja` (
  `id` int(11) NOT NULL,
  `naziv` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kategorija_obavestenja`
--

INSERT INTO `kategorija_obavestenja` (`id`, `naziv`) VALUES
(1, 'Pozivi za studentska takmicenja'),
(2, 'Obavestenja o konferencijama'),
(3, 'Ponude za praksu'),
(4, 'Ponude za posao'),
(7, 'Obavestenja o upisu');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(100) COLLATE utf8_bin NOT NULL,
  `ime` varchar(30) COLLATE utf8_bin NOT NULL,
  `prezime` varchar(30) COLLATE utf8_bin NOT NULL,
  `status` bit(1) NOT NULL,
  `prvipristup` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`email`, `lozinka`, `ime`, `prezime`, `status`, `prvipristup`) VALUES
('admin2@etf.bg.ac.rs', 'sifra123', 'Administrator', 'Administratovic', b'1', b'0'),
('admin@etf.bg.ac.rs', 'sifra123', 'Martin', 'Cvijovic', b'1', b'0'),
('drasko@etf.bg.ac.rs', 'sifra123', 'Drazen', 'Draskovic', b'1', b'0'),
('elmezeni@etf.bg.ac.rs', 'sifra123', 'Dragomir', 'El Mezeni', b'1', b'0'),
('martincvijovic@etf.bg.ac.rs', 'sifra123', 'Martinko', 'Cvijovic', b'1', b'0'),
('martintrecinalog@etf.bg.ac.rs', 'sifra123', 'Martinelo', 'Cvijanovic', b'1', b'1'),
('misic@etf.bg.ac.rs', 'sifra123', 'Marko', 'Misic', b'1', b'1'),
('nidzakoja@etf.bg.ac.rs', 'kojanikola', 'Nikola', 'Kojadinovic', b'1', b'0'),
('radivoje@etf.bg.ac.rs', 'sifra123', 'Radivoje', 'Djuric', b'1', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `materijal`
--

CREATE TABLE `materijal` (
  `id_materijal` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_bin NOT NULL,
  `fajlputanja` varchar(100) COLLATE utf8_bin NOT NULL,
  `sifra_predmet` varchar(100) COLLATE utf8_bin NOT NULL,
  `tip_materijala` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_nastavnik` varchar(100) COLLATE utf8_bin NOT NULL,
  `datum_objave` date NOT NULL,
  `vidljiv` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `materijal`
--

INSERT INTO `materijal` (`id_materijal`, `naslov`, `fajlputanja`, `sifra_predmet`, `tip_materijala`, `id_nastavnik`, `datum_objave`, `vidljiv`) VALUES
(1, 'Predavanje 1 - MOS Tranzistor', 'files/mos_tranzistor.pdf', 'OE2OE', 'predavanja', 'radivoje@etf.bg.ac.rs', '2021-02-13', 1),
(11, 'Predavanje 2 -Teme za diplomski rad', 'files/diplomski.txt', 'OE4DOS', 'predavanja', 'elmezeni@etf.bg.ac.rs', '2021-02-16', 1),
(12, 'Vezbe 1 - Ski skola', 'files/skijas.php', 'OE4DOS', 'vezbe', 'elmezeni@etf.bg.ac.rs', '2021-02-16', 1),
(14, 'Rokovi 1 - Brojaci', 'files/Brojaci.pdf', 'OE4DOS', 'ispitnapitanja', 'elmezeni@etf.bg.ac.rs', '2021-02-16', 1),
(16, 'Predavanje 1 - Uvod u ORT', 'files/Uputstvo za instalaciju.pdf', 'IR1ORT', 'predavanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(28, 'Vezbe 1 - Test 1', 'files/latexForJupyter.sh', 'IR1ORT', 'vezbe', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(31, 'Predavanje 2 - TEST', 'files/oe3dosRequirements.txt', 'IR1ORT', 'predavanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(33, 'Rok 1 ', 'files/latexForJupyter.sh', 'IR1ORT', 'ispitnapitanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(34, 'Rok 2', 'files/latexForJupyter.sh', 'IR1ORT', 'ispitnapitanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(35, 'Rok 3', 'files/latexForJupyter.sh', 'IR1ORT', 'ispitnapitanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1),
(36, 'Predavanje 3 - Test 3', 'files/latexForJupyter.sh', 'IR1ORT', 'predavanja', 'drasko@etf.bg.ac.rs', '2021-02-22', 1);

-- --------------------------------------------------------

--
-- Table structure for table `nastavni_plan`
--

CREATE TABLE `nastavni_plan` (
  `sifra_predmet` varchar(100) COLLATE utf8_bin NOT NULL,
  `id_odseka` int(11) NOT NULL,
  `godina_studija` int(11) NOT NULL,
  `semestar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `nastavni_plan`
--

INSERT INTO `nastavni_plan` (`sifra_predmet`, `id_odseka`, `godina_studija`, `semestar`) VALUES
('IR1ORT', 2, 1, 2),
('IR1P1', 2, 1, 1),
('IR1P2', 2, 1, 2),
('IR2ASP', 2, 2, 3),
('IR2OO1', 2, 2, 3),
('IR2OO2', 2, 2, 4),
('IR2OOP', 2, 2, 3),
('IR2OS1', 2, 2, 4),
('IR3KDP', 2, 3, 5),
('IR4MIPS', 2, 4, 7),
('IR5FP', 2, 5, 9),
('IR5KER', 2, 5, 10),
('OE2OAE', 1, 2, 4),
('OE2OE', 1, 2, 3),
('OE3DE', 1, 3, 5),
('OE4DOS', 1, 4, 7),
('OE4RFE', 1, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `obavestenje_predmet`
--

CREATE TABLE `obavestenje_predmet` (
  `id_obavestenja` int(11) NOT NULL,
  `id_predmet` varchar(100) COLLATE utf8_bin NOT NULL,
  `naslov` varchar(100) COLLATE utf8_bin NOT NULL,
  `sadrzaj` text COLLATE utf8_bin NOT NULL,
  `datum_objave` date NOT NULL,
  `id_nastavnik` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `obavestenje_predmet`
--

INSERT INTO `obavestenje_predmet` (`id_obavestenja`, `id_predmet`, `naslov`, `sadrzaj`, `datum_objave`, `id_nastavnik`) VALUES
(1, 'OE2OE', 'Rezultati ispita u feb', '<p>Rezultati ispita u februaru bice okaceni veceras&nbsp;<strong>uvid?</strong></p>\r\n', '2021-02-14', 'radivoje@etf.bg.ac.rs'),
(2, 'OE2OE', 'Rezultati ispita u januaru', 'Rezultati ispita u januaru bice okaceni veceras. Rezultati ispita u januaru bice okaceni veceras. Rezultati ispita u januaru bice okaceni veceras. Rezultati ispita u januaru bice okaceni veceras', '2021-01-14', 'radivoje@etf.bg.ac.rs'),
(4, 'OE2OE', 'Ispit u junu', 'Ispit u junskomi ispitnom roku bice odrzan 16.06.2020. Molimo studente da ponesu indeks i licnu kartu i da budu ispred sale 70 barem 15 minuta pre pocetka ispita', '2020-06-04', 'radivoje@etf.bg.ac.rs'),
(6, 'OE4DOS', 'Rezultati ispita u februaru', '<p>Drage koleginice i kolege,</p>\r\n\r\n<p>Rezultati ispita u februarskom ispitnom roku bice objavljeni&nbsp;<strong>najkasnije do subote.</strong></p>\r\n\r\n<h2>Mole se studenti&nbsp;<strong><em>da redovno prate sajt predmeta!</em></strong></h2>\r\n', '2021-02-15', 'elmezeni@etf.bg.ac.rs'),
(11, 'OE4DOS', 'Teme za diplomski', '<p>Teme su date u prilogu</p>\r\n', '2021-02-16', 'elmezeni@etf.bg.ac.rs'),
(12, 'OE4DOS', 'TEST VEST', '<p>TEST VEST sa fajlom</p>\r\n', '2021-02-17', 'elmezeni@etf.bg.ac.rs'),
(13, 'OE4DOS', 'TEST VEST 2', '<p>TEST vest 2</p>\r\n', '2021-02-17', 'elmezeni@etf.bg.ac.rs'),
(14, 'OE4DOS', 'TEST VEST 3', '<p>TEST vest 3</p>\r\n', '2021-02-17', 'elmezeni@etf.bg.ac.rs'),
(15, 'IR1ORT', 'Dobrodosli na ORT', '<p>Svim studentima zelim srecan pocetak novog semestra i dobrodoslicu na predmet osnovi racunarske tehnike!</p>\r\n\r\n<p>Pozdrav,</p>\r\n\r\n<p>Drazen</p>\r\n', '2021-02-22', 'drasko@etf.bg.ac.rs');

-- --------------------------------------------------------

--
-- Table structure for table `obavestenje_sajt`
--

CREATE TABLE `obavestenje_sajt` (
  `id_obavestenja` int(11) NOT NULL,
  `id_kategorije` int(11) NOT NULL,
  `naslov` varchar(100) COLLATE utf8_bin NOT NULL,
  `sadrzaj` varchar(10000) COLLATE utf8_bin NOT NULL,
  `datum_objave` date NOT NULL,
  `autor` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `obavestenje_sajt`
--

INSERT INTO `obavestenje_sajt` (`id_obavestenja`, `id_kategorije`, `naslov`, `sadrzaj`, `datum_objave`, `autor`) VALUES
(1, 3, 'Praksa u kompaniji Microsoft', 'Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.Kompanija Microsoft raspisala je konkurs za tromesecnu praksu u svom razvojnom centru.', '2021-01-13', 'admin@etf.bg.ac.rs'),
(12, 1, 'Elektrijada 2021.', '<p>Dragi studenti,</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>Sa zadovoljstvom vas obave&scaron;tavamo da će se ove godine uprkos&nbsp;<s>korona virusu</s>&nbsp;održati&nbsp;<strong><em>ELEKTRIJADA 2021.</em></strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><strong><em>Studenti koji žele da se prijave to mogu učiniti na&nbsp;<a href=\"http://etf.rs\">ovom linku</a>.</em></strong></p>\r\n', '2021-02-10', 'admin@etf.bg.ac.rs'),
(14, 7, 'Upis 2021 je zavrsen', '<p><em>Dragi studenti,</em></p>\r\n\r\n<p><em>Sa zadovoljstvom vas obavestavamo da je upis 2021&nbsp;<strong>zvanicno zavrsen.</strong></em></p>\r\n\r\n<p>Studenti koji zele da pokupe svoj indeks to mogu uraditi u&nbsp;<strong>studentskoj sluzbi.</strong></p>\r\n', '2021-02-22', 'admin@etf.bg.ac.rs');

-- --------------------------------------------------------

--
-- Table structure for table `odsek`
--

CREATE TABLE `odsek` (
  `id` int(11) NOT NULL,
  `naziv_odseka` varchar(100) COLLATE utf8_bin NOT NULL,
  `sef_odsek` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `odsek`
--

INSERT INTO `odsek` (`id`, `naziv_odseka`, `sef_odsek`) VALUES
(1, 'Odsek za Elektroniku', 'elmezeni@etf.bg.ac.rs'),
(2, 'Odsek za Racunarsku tehniku i informatiku', 'misic@etf.bg.ac.rs');

-- --------------------------------------------------------

--
-- Table structure for table `prati_predmet`
--

CREATE TABLE `prati_predmet` (
  `id_student` varchar(100) COLLATE utf8_bin NOT NULL,
  `sifra_predmet` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `prati_predmet`
--

INSERT INTO `prati_predmet` (`id_student`, `sifra_predmet`) VALUES
('martincvijovic@etf.bg.ac.rs', 'IR1ORT'),
('martincvijovic@etf.bg.ac.rs', 'IR2ASP'),
('martincvijovic@etf.bg.ac.rs', 'IR2OOP'),
('martincvijovic@etf.bg.ac.rs', 'IR5FP'),
('martincvijovic@etf.bg.ac.rs', 'OE2OAE'),
('martincvijovic@etf.bg.ac.rs', 'OE2OE'),
('martincvijovic@etf.bg.ac.rs', 'OE4DOS'),
('nidzakoja@etf.bg.ac.rs', 'IR5FP');

-- --------------------------------------------------------

--
-- Table structure for table `predmet`
--

CREATE TABLE `predmet` (
  `sifra_predmet` varchar(100) COLLATE utf8_bin NOT NULL,
  `naziv` varchar(100) COLLATE utf8_bin NOT NULL,
  `fond_casova` int(11) NOT NULL,
  `broj_ESPB` int(11) NOT NULL,
  `cilj_predmeta` text COLLATE utf8_bin NOT NULL,
  `ishod_predmeta` text COLLATE utf8_bin NOT NULL,
  `komentar` text COLLATE utf8_bin NOT NULL,
  `aktivan` tinyint(1) NOT NULL,
  `tip_predmeta` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `predmet`
--

INSERT INTO `predmet` (`sifra_predmet`, `naziv`, `fond_casova`, `broj_ESPB`, `cilj_predmeta`, `ishod_predmeta`, `komentar`, `aktivan`, `tip_predmeta`) VALUES
('IR1ORT', 'Osnovi racunarske tehnike 1', 15, 5, 'Osnovi racunarske tehnike nas uce da radimo multipleksere.', 'Cilj je upoznati multipleksere.', 'No comment', 1, 'izborni'),
('IR1P1', 'Programiranje 1', 25, 5, 'Programiranje 1 je obavezan predmet na prvoj godini studija Elektrotehničkog fakulteta u Beogradu na Elektrotehničkim Odsecima i na Odseku za Softversko Inženjerstvo. ', 'Predmet predstavlja uvodni kurs u programiranje i pokriva gradivo potrebno za sticanje osnovnih programerskih veština. Obrađuju se sledeće teme:\r\n- Formati mašinskih instrukcija\r\n- Predstavljanje celih brojeva\r\n- PicoComputer (pC)\r\n- Sintaksne notacije\r\n- Programski jezik Python', '', 1, 'obavezni'),
('IR1P2', 'Programiranje 2', 20, 5, 'Programiranje 2 je obavezan predmet na prvoj godini studija Elektrotehničkog fakulteta u Beogradu na Elektrotehničkim Odsecima i na Odseku za Softversko Inženjerstvo. Predmet predstavlja uvodni kurs u programiranje i pokriva gradivo potrebno za sticanje osnovnih programerskih veština.', 'Gradivo obuhvata:\r\n- predstavljanje realnih brojeva\r\n- programski jezik C\r\n', '', 1, 'obavezni'),
('IR2ASP', 'Algoritmi i strukture podataka', 24, 6, 'Упознавање са логичком организацијом и меморијском репрезентацијом линеарних и нелинеарих структура података, основним операцијама и типичним применама ових структура. Упознавање са алгоритмима и одговарајућим структурама података које се користе за претраживање и сортирање, као и њиховом практичном имплементацијом у програмским језицима.', 'Овај предмет треба студента да оспособи за програмску имплементацију линеарних и нелинераних структура, као и алгоритама за рад са њима у типичним применама. Поред тога, предмет треба студента да оспособи за практичну имплементацију алгоритама претраживања и сортирања у програмским језицима и решавање практичних проблема.', 'Odlican predmet', 1, 'obavezni'),
('IR2OO1', 'Objektno orijentisano programiranje 1', 20, 6, 'Objektno orijentisano programiranje 1 je obavezan predmet na drugoj godini studija Odseka za računarsku tehniku i informatiku i Odseka za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu. Predmet je izborni za studente Odseka za signale i sisteme, Odseka za telekomunikacije i informacione tehnologije i Odseka za energetiku.', 'Da bi se predmet položio, na pojedinim obavezama (laboratorijskim vežbama i ispitu) se mora steći\r\nbroj poena veći od odgovarajućeg praga; ovaj uslov je povoljniji u prvom ispitnom roku ', '', 1, 'obavezni'),
('IR2OO2', 'Objektno orijentisano programiranje 2', 20, 6, 'Objektno orijentisano programiranje 2 je obavezan predmet na drugoj godini studija Odseka za računarsku tehniku i informatiku i Odseka za softversko inženjerstvo Elektrotehničkog fakulteta Univerziteta u Beogradu. Predmet je izborni za studente Odseka za signale i sisteme, Odseka za telekomunikacije i informacione tehnologije i Odseka za energetiku.', 'Da bi se predmet položio, na pojedinim obavezama (laboratorijskim vežbama i ispitu) se mora steći\r\nbroj poena veći od odgovarajućeg praga; ovaj uslov je povoljniji u prvom ispitnom roku ', '', 1, 'obavezni'),
('IR2OOP', 'Objektno orijentisano programiranje', 20, 6, 'Objektno orijentisano softversko inženjerstvo je stručna oblast koja se bavi izučavanjem objektne tehnologije izrade softvera. Objektna tehnologija je moderan pristup izradi softvera koji koristi koncepte višeg nivoa apstrakcije nego sto su oni u tradicionalnom, strukturiranom (proceduralnom) programiranju. Objektna tehnologija nudi apstrakcije koje su bliže nivou razmišljanja programera i realnom svetu, omogužuju lakše modelovanje problema, bolju ponovnu upotrebu softverskih rešenja na raznim nivoima, bolju organizaciju softvera, njegovu vežu fleksibilnost, lakše odrzavanje i, najzad, vežu produktivnost u izradi softvera', ' Zbog svega ovoga, objektna tehnologija predstavlja moderan način proizvodnje softvera bez koga se danas praktično ne može zamisliti razvoj softvera. Izuzetna potražnja za kadrovima sa znanjem u ovoj oblasti u svetu i kod nas inspirisala je i formiranje ovog predmeta.', 'Pored predavanja i vežbi na tabli, predmet sadrži i praktičan rad u obliku obaveznih i neobaveznih domaćih zadataka, izrade projekata i diplomskih radova. Predmet objašnjava osnovne koncepte objektne tehnologije i prikazuje ove koncepte na najmodernijim OO jezicima (UML, Java i C++), sadrzi osnove objektnog projektovanja (uključujuži i projektne obrasce, engl. design patterns) i detaljno obrađuje jezik C++.', 1, 'izborni'),
('IR2OS1', 'Operativni sistemi 1', 30, 6, 'Upoznavanje studenata sa osnovnim konceptima operativnih sistema.', 'Po zavrsetku ovog kursa, studenti ce moci samostalno da isprojektuju nadogradnju kernela nekog operativnog sistema da podrzi multithreading.', 'Projekat je obavezan i uslov je za polaganje.', 1, 'izborni'),
('IR3KDP', 'Konkuretno i distribuirano programiranje', 22, 6, 'Упознавање студената са основним концептима конкурентног и дистрибуираног програмирања. Увођење појма различитих нивоа апстракције у конкурентном и дистрибуираном програмирању. Оспособљавање студената за писање конкурентних и дистрибуираних програма за најчешће проблеме у различитим програмским језицима.', 'Поседовање основних знања о концептима, алгоритмима, принципима, проблемима и решењима везаним за конкурентно и дистрибуирано програмирања. Препознавање различитих нивоа апстракције у конкурентном и дистрибуираном програмирању. Оспособљеност студента да у језику Јава самостално пишу једноставне конкурентне и дистрибуиране апликације и да самостално решава најчешће проблеме синхронизације.', 'Захарије Радивојевић, Игор Икодиновић, Зоран Јовановић, Конкурентно и дистрибуирано програмирање, Академска мисао, 2008.', 1, 'obavezni'),
('IR4MIPS', 'Mikroprocesorski sistemi', 20, 6, 'Mikroprocesorsko upoznavanje', 'Projekat u proteusu', '', 0, 'obavezni'),
('IR5FP', 'Funkcionalno programiranje', 20, 6, 'Kotlin vrv', 'Verovatno Kotlin i slicno', '', 1, 'izborni'),
('IR5KER', 'Kreativnost u elektrotehnici i racunarstvu', 27, 8, 'Biti ekstremno kreativan', 'Studenti postaju kreativniji u resavanju problema', '', 1, 'obavezni'),
('OE2OAE', 'Osnovi analogne elektronike', 20, 6, 'Упознавање са принципом рада појачавача са негативном повратном спрегом у режиму малих сигнала, како на ниским, тако и на високим учестаностима са урачунавањем свих паразитних капацитивних ефеката и шума.', 'Оспособљавање за пројектовање електронских склопова са операционим појачавачима и дискретним транзисторима и негативном повратном спрегом, у целом опсегу учестаности уз минимизирање утицаја шума.', '', 1, 'obavezni'),
('OE2OE', 'Osnovi elektronike', 14, 6, 'Фундаментална знања из физике рада и модела електронских компонената и анализе и пројектовања основних појачавачких кола у дискретној и интегрисаној технологији, са аспекта конструкције и примене.', 'Припрема студената за даље образовање из аналогне и дигиталне електронике.', '', 1, 'obavezni'),
('OE3DE', 'Digitalna elektronika', 16, 6, 'Упознавање студената са анализом и синтезом комплексних дигиталних кола и система. Упознавање студената са анализом и синтезом комплексних аналогно-дигиталних кола и система.', 'Оспособљавање студената да анализирају, пројектују и реализују комплексна дигитална кола и системе. Оспособљавање студената за избор адекватних кола да би задовољили спецификације дигиталних подсистема. Оспособљавање студената за избор адекватних кола да би задовољили спецификације аналогно-дигиталних подсистема.', '', 1, 'obavezni'),
('OE4DOS', 'Digitalna obrada slike', 20, 6, 'Упознати студенате са основама дигиталне обраде слике у просторном и фреквенцијском домену, Оспособити студенте да користе софтверске пакете за обраду слике, као и да имплементирају сопствене алгоритме за обраду и анализу слике.', 'После овог курса студенти су оспособљени да разумеју и примене основне алгоритме за обраду слике и користе софтверске пакете или сами пишу програме.', 'Tri domaca x 20p + Ispit 40p\r\n', 1, 'izborni'),
('OE4RFE', 'RF Elektronika', 16, 6, 'Овај курс се бави анализом и дизајном РФ интегрисаних кола и система. Предмет пружа могућност стицања експертских знања неопходних у високо-технолошком окружењу и академским истраживањима. Он има за циљ да пружи студентима неопходна знања за разумевање фундаменталних чињеница данашњих и будућих инжињерских решења у РФ колима и системима.', 'На крају курса студенти су у стању да самостално: -анализирају перформансе интегрисаних РФ кола и система -пројектују и тестирају основна РФ интегрисана кола, као што су: малошумни појачавачи, миксери, осцилатори, РФ појачавачи снаге', '', 1, 'izborni');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `indeks` varchar(10) COLLATE utf8_bin NOT NULL,
  `tipstudija` varchar(1) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`email`, `indeks`, `tipstudija`) VALUES
('martincvijovic@etf.bg.ac.rs', '2017/0558', 'd'),
('martintrecinalog@etf.bg.ac.rs', '2017/0558', 'd'),
('nidzakoja@etf.bg.ac.rs', '2017/0202', 'd');

-- --------------------------------------------------------

--
-- Table structure for table `tip_materijala`
--

CREATE TABLE `tip_materijala` (
  `naziv_tipa` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_materijala`
--

INSERT INTO `tip_materijala` (`naziv_tipa`) VALUES
('ispitnapitanja'),
('predavanja'),
('vezbe');

-- --------------------------------------------------------

--
-- Table structure for table `tip_predmeta`
--

CREATE TABLE `tip_predmeta` (
  `naziv_tipa` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tip_predmeta`
--

INSERT INTO `tip_predmeta` (`naziv_tipa`) VALUES
('izborni'),
('obavezni');

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

CREATE TABLE `zaposleni` (
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `adresa` varchar(100) COLLATE utf8_bin NOT NULL,
  `mobilni` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `licniweb` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `biografija` varchar(10000) COLLATE utf8_bin DEFAULT NULL,
  `zvanje` varchar(50) COLLATE utf8_bin NOT NULL,
  `kabinet` varchar(20) COLLATE utf8_bin NOT NULL,
  `profilnaslika` varchar(100) COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`email`, `adresa`, `mobilni`, `licniweb`, `biografija`, `zvanje`, `kabinet`, `profilnaslika`) VALUES
('drasko@etf.bg.ac.rs', 'Drazena Draskovica 007', '0647777777', 'drazen.com', 'Profesor na ETF-u, drzi dosta WEB predmeta', 'redovniprofesor', '5000', 'img/drazen.jpg'),
('elmezeni@etf.bg.ac.rs', 'Gospodara Vucica 100, Beograd', '0641234567', 'mezenidoktore.com', 'Najbolji profesor na fakultetu, doktorirao u oblasti masinske vizije i digitalne obrade slike. Redovni profesor na ETF Beograd. Drzi digitalnu obradu slike i Digitalnu elektroniku', 'redovniprofesor', '102d', 'img/Dragomir_El_Mezeni.jpg'),
('misic@etf.bg.ac.rs', 'Bulevar Kralja Aleksandra 73, 11000 Beograd', '0651234567', 'misic.etf.rs', 'Predaje P1, ASP i ne znam sta jos drzi na RTi. ', 'redovniprofesor', '100', 'img/default-image.png'),
('radivoje@etf.bg.ac.rs', 'Radivoja Radivojevica 100, Beograd', '0647654321', 'radivoje.com', 'RF meister', 'redovniprofesor', '102f', 'img/radivoje.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `drzi_predmet`
--
ALTER TABLE `drzi_predmet`
  ADD PRIMARY KEY (`ident`),
  ADD KEY `id_nastavnika` (`id_nastavnika`,`sifra_predmet`),
  ADD KEY `sifra_predmet` (`sifra_predmet`);

--
-- Indexes for table `fajl_uz_obavestenje`
--
ALTER TABLE `fajl_uz_obavestenje`
  ADD PRIMARY KEY (`idfajla`),
  ADD KEY `id_obavestenja` (`id_obavestenja`);

--
-- Indexes for table `kategorija_obavestenja`
--
ALTER TABLE `kategorija_obavestenja`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `materijal`
--
ALTER TABLE `materijal`
  ADD PRIMARY KEY (`id_materijal`),
  ADD KEY `sifra_predmet` (`sifra_predmet`,`tip_materijala`,`id_nastavnik`),
  ADD KEY `tip_materijala` (`tip_materijala`),
  ADD KEY `id_nastavnik` (`id_nastavnik`);

--
-- Indexes for table `nastavni_plan`
--
ALTER TABLE `nastavni_plan`
  ADD PRIMARY KEY (`sifra_predmet`,`id_odseka`,`godina_studija`),
  ADD KEY `sifra_predmet` (`sifra_predmet`,`id_odseka`),
  ADD KEY `id_odseka` (`id_odseka`);

--
-- Indexes for table `obavestenje_predmet`
--
ALTER TABLE `obavestenje_predmet`
  ADD PRIMARY KEY (`id_obavestenja`),
  ADD KEY `id_predmet` (`id_predmet`,`id_nastavnik`),
  ADD KEY `id_nastavnik` (`id_nastavnik`);

--
-- Indexes for table `obavestenje_sajt`
--
ALTER TABLE `obavestenje_sajt`
  ADD PRIMARY KEY (`id_obavestenja`),
  ADD KEY `id_kategorije` (`id_kategorije`),
  ADD KEY `autor` (`autor`);

--
-- Indexes for table `odsek`
--
ALTER TABLE `odsek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sef_odsek` (`sef_odsek`);

--
-- Indexes for table `prati_predmet`
--
ALTER TABLE `prati_predmet`
  ADD PRIMARY KEY (`id_student`,`sifra_predmet`),
  ADD KEY `sifra_predmet` (`sifra_predmet`);

--
-- Indexes for table `predmet`
--
ALTER TABLE `predmet`
  ADD PRIMARY KEY (`sifra_predmet`),
  ADD KEY `tip_predmeta` (`tip_predmeta`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `tip_materijala`
--
ALTER TABLE `tip_materijala`
  ADD PRIMARY KEY (`naziv_tipa`);

--
-- Indexes for table `tip_predmeta`
--
ALTER TABLE `tip_predmeta`
  ADD PRIMARY KEY (`naziv_tipa`);

--
-- Indexes for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `drzi_predmet`
--
ALTER TABLE `drzi_predmet`
  MODIFY `ident` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `fajl_uz_obavestenje`
--
ALTER TABLE `fajl_uz_obavestenje`
  MODIFY `idfajla` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `kategorija_obavestenja`
--
ALTER TABLE `kategorija_obavestenja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `materijal`
--
ALTER TABLE `materijal`
  MODIFY `id_materijal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `obavestenje_predmet`
--
ALTER TABLE `obavestenje_predmet`
  MODIFY `id_obavestenja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `obavestenje_sajt`
--
ALTER TABLE `obavestenje_sajt`
  MODIFY `id_obavestenja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `odsek`
--
ALTER TABLE `odsek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `administrator`
--
ALTER TABLE `administrator`
  ADD CONSTRAINT `administrator_ibfk_1` FOREIGN KEY (`email`) REFERENCES `korisnik` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `drzi_predmet`
--
ALTER TABLE `drzi_predmet`
  ADD CONSTRAINT `drzi_predmet_ibfk_1` FOREIGN KEY (`id_nastavnika`) REFERENCES `zaposleni` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `drzi_predmet_ibfk_2` FOREIGN KEY (`sifra_predmet`) REFERENCES `predmet` (`sifra_predmet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fajl_uz_obavestenje`
--
ALTER TABLE `fajl_uz_obavestenje`
  ADD CONSTRAINT `fajl_uz_obavestenje_ibfk_1` FOREIGN KEY (`id_obavestenja`) REFERENCES `obavestenje_predmet` (`id_obavestenja`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `materijal`
--
ALTER TABLE `materijal`
  ADD CONSTRAINT `materijal_ibfk_1` FOREIGN KEY (`tip_materijala`) REFERENCES `tip_materijala` (`naziv_tipa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materijal_ibfk_2` FOREIGN KEY (`sifra_predmet`) REFERENCES `predmet` (`sifra_predmet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `materijal_ibfk_3` FOREIGN KEY (`id_nastavnik`) REFERENCES `zaposleni` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `nastavni_plan`
--
ALTER TABLE `nastavni_plan`
  ADD CONSTRAINT `nastavni_plan_ibfk_1` FOREIGN KEY (`sifra_predmet`) REFERENCES `predmet` (`sifra_predmet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `nastavni_plan_ibfk_2` FOREIGN KEY (`id_odseka`) REFERENCES `odsek` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obavestenje_predmet`
--
ALTER TABLE `obavestenje_predmet`
  ADD CONSTRAINT `obavestenje_predmet_ibfk_1` FOREIGN KEY (`id_predmet`) REFERENCES `predmet` (`sifra_predmet`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obavestenje_predmet_ibfk_2` FOREIGN KEY (`id_nastavnik`) REFERENCES `zaposleni` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `obavestenje_sajt`
--
ALTER TABLE `obavestenje_sajt`
  ADD CONSTRAINT `obavestenje_sajt_ibfk_1` FOREIGN KEY (`id_kategorije`) REFERENCES `kategorija_obavestenja` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `obavestenje_sajt_ibfk_2` FOREIGN KEY (`autor`) REFERENCES `administrator` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `odsek`
--
ALTER TABLE `odsek`
  ADD CONSTRAINT `odsek_ibfk_1` FOREIGN KEY (`sef_odsek`) REFERENCES `zaposleni` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prati_predmet`
--
ALTER TABLE `prati_predmet`
  ADD CONSTRAINT `prati_predmet_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `student` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `prati_predmet_ibfk_2` FOREIGN KEY (`sifra_predmet`) REFERENCES `predmet` (`sifra_predmet`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `predmet`
--
ALTER TABLE `predmet`
  ADD CONSTRAINT `predmet_ibfk_1` FOREIGN KEY (`tip_predmeta`) REFERENCES `tip_predmeta` (`naziv_tipa`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`email`) REFERENCES `korisnik` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `zaposleni`
--
ALTER TABLE `zaposleni`
  ADD CONSTRAINT `zaposleni_ibfk_1` FOREIGN KEY (`email`) REFERENCES `korisnik` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
