-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Feb 10, 2025 alle 17:36
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leviws2`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `bozza`
--

CREATE TABLE `bozza` (
                         `idbozza` bigint(18) UNSIGNED NOT NULL,
                         `Destinazione` varchar(45) NOT NULL,
                         `tipoViaggio` varchar(45) NOT NULL,
                         `data_inizio` date NOT NULL,
                         `data_fine` date NOT NULL,
                         `due_idReferente` bigint(13) UNSIGNED NOT NULL,
                         `idReferente` bigint(13) UNSIGNED NOT NULL,
                         `idClasse` bigint(14) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `classe`
--

CREATE TABLE `classe` (
                          `idclasse` bigint(14) UNSIGNED NOT NULL,
                          `N_studenti` int(11) NOT NULL,
                          `cordinatore` bigint(13) UNSIGNED NOT NULL,
                          `idistituto` bigint(15) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `docente`
--

CREATE TABLE `docente` (
                           `iddocente` bigint(13) UNSIGNED NOT NULL,
                           `nome` varchar(45) NOT NULL,
                           `cognome` varchar(45) NOT NULL,
                           `ruolo` varchar(45) NOT NULL,
                           `email` varchar(45) NOT NULL,
                           `idUser` bigint(12) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `groups`
--

CREATE TABLE `groups` (
                          `id` bigint(11) UNSIGNED NOT NULL,
                          `name` varchar(50) NOT NULL,
                          `permissions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`permissions`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
                                                       (1, 'admins', '{\"manage_users\": true, \"view_dashboard\": true, \"manage_settings\": true}'),
                                                       (2, 'users', '{\"view_dashboard\": true}');

-- --------------------------------------------------------

--
-- Struttura della tabella `istituto`
--

CREATE TABLE `istituto` (
                            `idistituto` bigint(15) UNSIGNED NOT NULL,
                            `nome_istituto` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `proposte`
--

CREATE TABLE `proposte` (
                            `idproposte` bigint(19) UNSIGNED NOT NULL,
                            `idBozza` bigint(18) UNSIGNED NOT NULL,
                            `idtipoViaggio` bigint(15) UNSIGNED NOT NULL,
                            `idAccompagnatore` bigint(13) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `tipoviaggio`
--

CREATE TABLE `tipoviaggio` (
                               `idtipoViaggio` bigint(17) UNSIGNED NOT NULL,
                               `nome_Viaggio` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
                         `id` bigint(12) UNSIGNED NOT NULL,
                         `username` varchar(50) NOT NULL,
                         `password_hash` varchar(255) NOT NULL,
                         `group_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `group_id`) VALUES
                                                                        (1, 'admin_user', '$2y$10$6s00YYHczdd/MtQu1Ks.8eQVHFVTkfcoVnGfcFAN8adJj6jFLJQp2', 1),
                                                                        (2, 'standard_user', '$2y$10$1jK1AoMovQO8cApX.Lcc2uYor52rr.2H5QPn.7bEAtyKugNR0e6BC', 2),
                                                                        (3, 'pippo', '$2y$10$aKrgftaLq0X0H.8gkv3D3eL/cy1l.0bz79lQJ9akoWoSChevmOdu2', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `viaggio`
--

CREATE TABLE `viaggio` (
                           `idviaggio` bigint(16) UNSIGNED NOT NULL,
                           `città` varchar(45) NOT NULL,
                           `Nazione` varchar(45) NOT NULL,
                           `data_inizio` date NOT NULL,
                           `data_fine` date NOT NULL,
                           `Descrizione` varchar(45) NOT NULL,
                           `idReferente` bigint(13) UNSIGNED NOT NULL,
                           `tipoViaggio` bigint(17) UNSIGNED NOT NULL,
                           `idProposta` bigint(19) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `bozza`
--
ALTER TABLE `bozza`
    ADD PRIMARY KEY (`idbozza`),
    ADD KEY `classb_isk_idx` (`idClasse`),
    ADD KEY `docb_isk_idx` (`idReferente`),
    ADD KEY `docbdue_isk__idx` (`due_idReferente`);

--
-- Indici per le tabelle `classe`
--
ALTER TABLE `classe`
    ADD PRIMARY KEY (`idclasse`),
    ADD KEY `cord_isk_idx` (`cordinatore`),
    ADD KEY `ist_isk_idx` (`idistituto`);

--
-- Indici per le tabelle `docente`
--
ALTER TABLE `docente`
    ADD PRIMARY KEY (`iddocente`),
    ADD KEY `user_isk_idx` (`idUser`);

--
-- Indici per le tabelle `groups`
--
ALTER TABLE `groups`
    ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `istituto`
--
ALTER TABLE `istituto`
    ADD PRIMARY KEY (`idistituto`);

--
-- Indici per le tabelle `proposte`
--
ALTER TABLE `proposte`
    ADD PRIMARY KEY (`idproposte`),
    ADD KEY `bozzap_isk_idx` (`idBozza`),
    ADD KEY `tipviaggiop_isk_idx` (`idtipoViaggio`),
    ADD KEY `accp_isk_idx` (`idAccompagnatore`);

--
-- Indici per le tabelle `tipoviaggio`
--
ALTER TABLE `tipoviaggio`
    ADD PRIMARY KEY (`idtipoViaggio`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `username` (`username`),
    ADD KEY `group_id` (`group_id`);

--
-- Indici per le tabelle `viaggio`
--
ALTER TABLE `viaggio`
    ADD PRIMARY KEY (`idviaggio`),
    ADD KEY `tip_isk_idx` (`tipoViaggio`),
    ADD KEY `ref_isk_idx` (`idReferente`),
    ADD KEY `prop_isk_idx` (`idProposta`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `docente`
--
ALTER TABLE `docente`
    MODIFY `iddocente` bigint(13) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `groups`
--
ALTER TABLE `groups`
    MODIFY `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
    MODIFY `id` bigint(12) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `bozza`
--
ALTER TABLE `bozza`
    ADD CONSTRAINT `classb_isk` FOREIGN KEY (`idClasse`) REFERENCES `classe` (`idclasse`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `docb_isk` FOREIGN KEY (`idReferente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `docbdue_isk_` FOREIGN KEY (`due_idReferente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `classe`
--
ALTER TABLE `classe`
    ADD CONSTRAINT `cord_isk` FOREIGN KEY (`cordinatore`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `ist_isk` FOREIGN KEY (`idistituto`) REFERENCES `istituto` (`idistituto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `docente`
--
ALTER TABLE `docente`
    ADD CONSTRAINT `user_isk` FOREIGN KEY (`idUser`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `proposte`
--
ALTER TABLE `proposte`
    ADD CONSTRAINT `accp_isk` FOREIGN KEY (`idAccompagnatore`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `bozzap_isk` FOREIGN KEY (`idBozza`) REFERENCES `bozza` (`idbozza`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `tipviaggiop_isk` FOREIGN KEY (`idtipoViaggio`) REFERENCES `tipoviaggio` (`idtipoViaggio`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limiti per la tabella `users`
--
ALTER TABLE `users`
    ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`);

--
-- Limiti per la tabella `viaggio`
--
ALTER TABLE `viaggio`
    ADD CONSTRAINT `prop_isk` FOREIGN KEY (`idProposta`) REFERENCES `proposte` (`idproposte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `ref_isk` FOREIGN KEY (`idReferente`) REFERENCES `docente` (`iddocente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
    ADD CONSTRAINT `tip_isk` FOREIGN KEY (`tipoViaggio`) REFERENCES `tipoviaggio` (`idtipoViaggio`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
