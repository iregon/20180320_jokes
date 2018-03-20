-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 20, 2018 alle 11:28
-- Versione del server: 10.1.26-MariaDB
-- Versione PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `joketables`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `author`
--

INSERT INTO `author` (`id`, `name`, `email`) VALUES
(1, 'Kevin Yank', 'kevin@sitepoint.com'),
(2, 'Joan Smith', 'joan@example.com');

-- --------------------------------------------------------

--
-- Struttura della tabella `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Carabiniere...'),
(2, 'Un uomo....'),
(3, 'Un internista...'),
(4, 'Saddam...');

-- --------------------------------------------------------

--
-- Struttura della tabella `joke`
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `joketext` text,
  `jokedate` date NOT NULL,
  `authorid` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `joke`
--

INSERT INTO `joke` (`id`, `joketext`, `jokedate`, `authorid`) VALUES
(1, 'Un carabiniere va dall\'edicolaio e dice \"E\' uscito Diabolik?\" e lui \"No\" allora il carabiniere urla \"Cirondate l\'edicola!!\"', '2004-04-01', 1),
(2, 'Un uomo sta guidando moderatamente in una stradina di campagna... ad un certo punto un carabiniere lo ferma. \"Le devo fare una multa per eccesso di velocità!\" dice il carabiniere. Al che l\'uomo lo supplica di non farla... allora il carabiniere gli dice: \"Senta... a me piacciono molto gli indovinelli. Se lei sa rispondere esattamente a questo indovinello, non le farò la multa!\" allora l\'uomo si prepara tutto concentrato e esorta il carabiniere a fargli l\'indovinello. \"In una stradina buia si vedono due fari... che cos\'è?\" dice il carabiniere e l\'uomo risponde: \"Come che cos\'è... è una macchina!\" e il carabiniere ribatte: \"Troppo generico... poteva essere una Punto o una BMW... mi dispiace le devo fare la multa!\" L\'uomo si mette a supplicare il carabiniere per una domanda di riserva così il carabiniere gliela fa. \"In una stradina buia si vede un faro... che cos\'è?\" e l\'uomo risponde: \"Come che cos\'è... è un motorino!\" Ma il carabiniere facendo la multa dice: \"Mi dispiace... troppo generico.. poteva essere una Vespa o un Ciao. Devo farle la multa!\" così l\'uomo un po\' seccato accetta la multa e poi dice: \"Senta signor carabiniere... lei mi ha fatto la multa ma visto che gli piacciono tanto gli indovinelli, posso fargliene uno io?\" il carabiniere molto orgoglioso ascolta l\'uomo. \"In una stradina buia ci sono dei fuocherelli ai margini della strada... cosa sono?\" e il carabiniere prontamente: \"Come cosa sono... sono prostitute!\" e l\'uomo: \"Eh... mi dispiace... troppo generico... potevano essere tua moglie, tua madre, tua figlia, tua sorella...\"', '2004-05-16', 1),
(3, 'Un interista parla con un amico e gli dice: \"sai che il mio cane quando l\'inter perde sta a digiuno per tutto il giorno?\" al che l\'amico incuriosito gli chiede: \"e se vince?\" e il fallito interista dice: \"eh... non lo so sinceramente...in fondo sono solo 10 anni che ce l\'ho!!!\" ', '2004-09-09', 2),
(4, 'Saddam domandò a Dio: \r\n- Come sarà l\'Iraq fra 4 anni? \r\nE Dio gli rispose: \r\n- Sarà distrutto da innumerevoli bombe lanciate dagli americani! \r\nSaddam sedette a terra, piangendo disperato. \r\nBush domandò a Dio: \r\n- Come saranno gli Stati Uniti fra 4 anni? \r\nE Dio rispose: \r\n- Saranno completamente contaminati da innumerevoli attacchi di bombe chimiche di Bin Laden! \r\nBush si accasciò al suolo, piangendo disperato. \r\nAlla fine Berlusconi domandò a Dio: \r\n- Come sarà l\'Italia fra 4 anni di mio governo? \r\nDio si accasciò al suolo e pianse disperato...', '2004-05-17', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `jokecategory`
--

CREATE TABLE `jokecategory` (
  `jokeid` int(11) NOT NULL,
  `categoryid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `jokecategory`
--

INSERT INTO `jokecategory` (`jokeid`, `categoryid`) VALUES
(1, 2),
(2, 1),
(3, 4);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `joke`
--
ALTER TABLE `joke`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `jokecategory`
--
ALTER TABLE `jokecategory`
  ADD PRIMARY KEY (`jokeid`,`categoryid`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
