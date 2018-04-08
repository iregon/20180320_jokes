-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Apr 08, 2018 alle 14:12
-- Versione del server: 10.1.28-MariaDB
-- Versione PHP: 7.1.11

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
  `email` varchar(255) DEFAULT NULL,
  `idUtente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `author`
--

INSERT INTO `author` (`id`, `name`, `email`, `idUtente`) VALUES
(1, 'Kevin Yank', 'kevin@sitepoint.com', 0),
(2, 'Joan Smith', 'joan@example.com', 0),
(3, 'Alfonso Santo Altamura', NULL, 0),
(4, 'Baldassare Baglio', NULL, 0),
(5, 'Mariano Nigro', NULL, 0),
(6, 'Dionisio Palumbo', NULL, 0),
(7, 'Giulio Brioschi', NULL, 0),
(8, 'Eutimio Amatore', NULL, 0),
(9, 'Calogero Masin', NULL, 0),
(10, 'Anastasio Raimondi', NULL, 0),
(11, 'Settimio Nicolai', NULL, 0),
(12, 'Viola Masin', NULL, 0),
(13, 'Cirillo Nardo', NULL, 0),
(14, 'Lorenzo Abatantuono', NULL, 0),
(15, 'Iregon', '', 0),
(16, 'admin admin', '0iregon0@gmail.com', 1),
(21, 'Anonimo', 'mario.rossi@gmail.com', 16);

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
(1, 'Donne'),
(2, 'Uomini'),
(3, 'Matrimoni'),
(4, 'Bambini'),
(5, 'Animali'),
(6, 'Computer'),
(7, 'Carabinieri'),
(8, 'Politica');

-- --------------------------------------------------------

--
-- Struttura della tabella `joke`
--

CREATE TABLE `joke` (
  `id` int(11) NOT NULL,
  `joketext` text COLLATE utf8_unicode_ci,
  `jokedate` date NOT NULL,
  `idauthor` int(11) DEFAULT NULL,
  `likeCounter` int(11) NOT NULL,
  `unlikeCounter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dump dei dati per la tabella `joke`
--

INSERT INTO `joke` (`id`, `joketext`, `jokedate`, `idauthor`, `likeCounter`, `unlikeCounter`) VALUES
(1, 'Quando è che una donna si trasforma in strega? \r\nDopo averla sposata', '2018-03-20', 1, 6, 1),
(2, '- \"Voto inglese?\"\r\n- \"Ottimo\"\r\n- \"ok..traduca *capire le donne*\"\r\n- \"Missione impossible\" \r\n- \"Assunto\"', '2018-03-20', 1, 3, 0),
(3, 'L’ammiraglio vede una flotta nemica e dice al suo tirapiedi: \"portami la mia maglietta rossa così i soldati non vedranno il mio sangue\".\r\nSubito dopo il tirapiedi gli dice: \"ci sono altre 20 navi ammiraglio...vado a prendere i pantaloni marroni\".', '2018-03-20', 1, 4, 0),
(4, 'Sposa bagnata?...sposo fortunato!!! ', '2018-03-20', 16, 0, 1),
(5, 'Ci sono due sposi che devono farlo per la prima volta, lui però si vergogna perchè ce l\'ha piccolo, allora decide di farlo a luci spente e di metterglielo in mano..allora lei: \"grazie...ma non fumo!\" ', '2018-03-20', 1, 1, 0),
(6, 'Un padre attende la nascita del suo primo figlio e l\'ostetrica:\r\n- \"purtroppo è senza braccia\"\r\n- \"lo amerò lo stesso\"\r\n- \"è anche senza gambe\"\r\n- \"lo amerò lo stesso, in fondo è figlio mio!\"\r\n- \"ma è anche senza tronco\"\r\n- \"lo amerò lo stesso!\"\r\n- \"guardi, purtroppo è anche senza testa\"\r\n- \"lo amerò lo stesso\"\r\n- \"mi dispiace: è nato solo con quest\' orecchio\"\r\n- \"lo amerò lo stesso\" \r\n- \"si, ma gli parli più vicino perchè è sordo!\"', '2018-03-20', 1, 1, 0),
(7, 'Un fantasmino si sveglia perché aveva fatto un incubo, va dalla mamma e la mamma gli dice: \"madonna tesoro! sei pallidissimo\". ', '2018-03-20', 1, 0, 1),
(8, 'La moglie chiede al marito: \"perché il gatto sembra ubriaco?\"\r\ne lui risponde: \"perché mi hai detto di dargli il whisky\"\r\nallora la moglie si mette a urlare e dice: \"whiskas luigi, ho detto whiskas!\"', '2018-03-20', 16, 0, 0),
(9, 'Cosa bisogna portare se vai al mare con il tuo cane?\r\nIl canotto! ', '2018-03-20', 1, 0, 0),
(10, 'La confessione \r\nUn signore si deve confessare, si inginocchia nel confessionale e subito esce una tastiera ed una vocina che dice: \"digiti uno se hai bestemmiato, digiti due se hai rubato, digiti tre se hai ucciso, digiti quattro se hai commesso atti impuri, digiti cinque....\" e cosi per tutti e dieci comandamenti. Il signore digita quattro. La vocina: \"digiti uno se da solo, digiti due se con un partner\". Il signore digita due e la vocina: \"digiti uno se era una amica, digiti due se era tua cognata, digiti tre se era una prostituta\". Il signore digita tre. La vocina: \"digiti uno se con la bocca, digiti due se dietro, digiti tre se normale\" e il signore digita uno. La vocina: \"digiti uno se hai pagato 30 euro, digiti due se hai pagato 50 euro, digiti tre se hai pagato 70 euro, digiti quattro se altro\" ed il signore digita tre. La vocina: \"sei un coglione se andavi in Via Roma pagavi di meno ed erano più brave\".', '2018-03-20', 1, 0, 0),
(11, 'Qual è l\'app più divertente della Apple?...iRonia! ', '2018-03-20', 1, 0, 0),
(12, 'Due carabinieri fermano un auto e controllano i documenti, la donna che guidava aveva superato il limite di velocità e loro glielo fanno notare, le chiedono come mai tutta questa fretta e lei: \"sapete? sono eccitata ho appena fatto una sega ad un uomo\" e i carabinieri segnalano tutto in centrale e chiedono al capitano il da farsi, il capitano: \"fatene produrre qualcuna anche per tagliare il grande albero davanti alla caserma\".', '2018-03-20', 1, 0, 0),
(13, 'Un maresciallo e un appuntato sono di pattuglia a piedi per le vie cittadine in una giornata afosa, vedono un albero e si fermano sotto all\'ombra per prendere un di fiato. Il maresciallo guarda l\'albero e dice: \"quest\'albero deve essere maschio\" e l\'appuntato guardando i rami esclama: \"no no è femmina\" ma i due non trovano un accordo, quando passa una signora le chiedono: \"scusi questo albero è maschio o femmina?\" e la signora li guarda ed esclama: \"è maschio\" ed il maresciallo: \"e perché\" e la signora: \"con due coglioni sotto è sicuramente maschio\".', '2018-03-20', 1, 0, 0),
(14, 'Nei paesi musulmani i ladri sono \"amputati\"..in Finlandia sono \"imputati\" ed in Italia sono \"deputati\"!', '2018-03-20', 16, 0, 0),
(15, 'Qual\'è la droga preferita di Renzi? L\'ashish ', '2018-03-20', 1, 0, 0),
(56, 'Tornato da un lungo viaggio,un signore domanda alla moglie: &quot;Hai dato da mangiare ai pesci rossi?&quot; e lei: &quot;Si, ma mi sono dimenticata di dargli da bere&quot;.', '2018-04-06', 16, 0, 0),
(57, 'A scuola un bambino dice alla maestra di avere una gallina che fa un uovo ogni mezz&#039;ora e la maestra aspetta un po&#039; e poi dice: &quot;Si va bene, ma allora?&quot; ed il bambino candidamente risponde: &quot;due uova!&quot; ', '2018-04-06', 21, 0, 0);

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
(1, 1),
(2, 1),
(3, 2),
(4, 3),
(5, 4),
(6, 5),
(7, 5),
(8, 6),
(9, 6),
(10, 7),
(11, 7),
(12, 8),
(13, 8),
(14, 9),
(15, 9),
(37, 6),
(56, 5),
(57, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `idUtente` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `cognome` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`idUtente`, `nome`, `cognome`, `email`, `pass`) VALUES
(1, 'admin', 'admin', '0iregon0@gmail.com', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918'),
(16, 'Mario', 'Rossi', 'mario.rossi@gmail.com', '8d969eef6ecad3c29a3a629280e686cf0c3f5d5a86aff3ca12020c923adc6c92');

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
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUtente`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `joke`
--
ALTER TABLE `joke`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `idUtente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
