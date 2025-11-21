-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : ven. 21 nov. 2025 à 18:47
-- Version du serveur : 9.5.0
-- Version de PHP : 8.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `garantia`
--

-- --------------------------------------------------------

--
-- Structure de la table `pdfWarranty`
--

CREATE TABLE `pdfWarranty` (
  `idPdfWarranty` int NOT NULL,
  `pdfWarranty` longtext COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `iduserRole` int NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `acces` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`iduserRole`, `role`, `acces`) VALUES
(1, 'Admin', 'All'),
(2, 'Staff', 'semi-All'),
(3, 'User', 'User acces');

-- --------------------------------------------------------

--
-- Structure de la table `role_has_user`
--

CREATE TABLE `role_has_user` (
  `role_iduserRole` int NOT NULL,
  `user_iduser` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `iduser` int NOT NULL,
  `userName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userSurname` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userEmail` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userPwd` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `userAge` int DEFAULT NULL,
  `role_iduserRole` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`iduser`, `userName`, `userSurname`, `userEmail`, `userPwd`, `userAge`, `role_iduserRole`) VALUES
(9, 'jeff', 'benard', 'jeff@mail.fr', '$2y$12$3RMGzI/klpWV/ODaZTtAc.W5YINXkV0FyoOEEj7Q9qP9CtmFf0.VO', 24, 3),
(10, 'Florine', 'Fausse', 'florine@mail.fr', '$2y$12$DbEoYjMZ4bUIsNLONpeYRObCIMCA5WD66Agsbaf9d4JO84wSVEV/a', 22, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Warranty`
--

CREATE TABLE `Warranty` (
  `idWarranty` int NOT NULL,
  `brandWarranty` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `nameWarranty` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `purchaseDate` date NOT NULL,
  `warrantyTime` date NOT NULL,
  `user_iduser` int NOT NULL,
  `pdfWarranty_idPdfWarranty` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `Warranty`
--

INSERT INTO `Warranty` (`idWarranty`, `brandWarranty`, `nameWarranty`, `purchaseDate`, `warrantyTime`, `user_iduser`, `pdfWarranty_idPdfWarranty`) VALUES
(24, 'Apple', 'Iphone 13', '2025-11-03', '2025-11-26', 9, NULL),
(25, 'Sony', 'PlayStation 5', '2025-11-10', '2027-10-21', 9, NULL),
(26, 'Apple', 'Mac', '2025-10-27', '2025-12-07', 9, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `pdfWarranty`
--
ALTER TABLE `pdfWarranty`
  ADD PRIMARY KEY (`idPdfWarranty`);

--
-- Index pour la table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`iduserRole`);

--
-- Index pour la table `role_has_user`
--
ALTER TABLE `role_has_user`
  ADD PRIMARY KEY (`role_iduserRole`,`user_iduser`),
  ADD KEY `fk_role_has_user_user1_idx` (`user_iduser`),
  ADD KEY `fk_role_has_user_role_idx` (`role_iduserRole`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`),
  ADD KEY `fk_user_role1_idx` (`role_iduserRole`);

--
-- Index pour la table `Warranty`
--
ALTER TABLE `Warranty`
  ADD PRIMARY KEY (`idWarranty`),
  ADD KEY `fk_Warranty_user1_idx` (`user_iduser`),
  ADD KEY `fk_Warranty_pdfWarranty1_idx` (`pdfWarranty_idPdfWarranty`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `pdfWarranty`
--
ALTER TABLE `pdfWarranty`
  MODIFY `idPdfWarranty` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `role`
--
ALTER TABLE `role`
  MODIFY `iduserRole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Warranty`
--
ALTER TABLE `Warranty`
  MODIFY `idWarranty` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `role_has_user`
--
ALTER TABLE `role_has_user`
  ADD CONSTRAINT `fk_role_has_user_role` FOREIGN KEY (`role_iduserRole`) REFERENCES `role` (`iduserRole`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_role_has_user_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_user_role1` FOREIGN KEY (`role_iduserRole`) REFERENCES `role` (`iduserRole`);

--
-- Contraintes pour la table `Warranty`
--
ALTER TABLE `Warranty`
  ADD CONSTRAINT `fk_Warranty_pdfWarranty1` FOREIGN KEY (`pdfWarranty_idPdfWarranty`) REFERENCES `pdfWarranty` (`idPdfWarranty`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_Warranty_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
