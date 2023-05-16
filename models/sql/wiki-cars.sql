-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 16 mai 2023 à 13:03
-- Version du serveur : 10.6.12-MariaDB-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wiki-cars`
--
DROP DATABASE IF EXISTS `wiki-cars`;

CREATE DATABASE `wiki-cars` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

USE `wiki-cars`;
-- --------------------------------------------------------

--
-- Structure de la table `boitevitesse`
--

CREATE TABLE `boitevitesse` (
  `idBoiteVitesse` int(11) NOT NULL,
  `boiteVitesse` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `boitevitesse`
--

INSERT INTO `boitevitesse` (`idBoiteVitesse`, `boiteVitesse`) VALUES
(1, 'Manuelle (ou à commande manuelle)'),
(2, 'Boîte de vitesses « manuelle » pilotée'),
(3, 'Électromagnétique (Cotal)'),
(4, 'À présélection (Wilson)'),
(5, 'Automatique'),
(6, 'Variateur de vitesse mécanique'),
(7, 'Boîte de vitesses séquentielle');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `idCategorie` int(11) NOT NULL,
  `categorie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `categorie`) VALUES
(1, 'Mini citadines'),
(2, 'Citadines polyvalentes'),
(3, 'Compactes'),
(4, 'Familiales'),
(5, 'Intermédiaires ou routières'),
(6, 'Berlines de luxe (plus de 5,00 m de longueur)'),
(7, 'Coupés sportifs'),
(8, 'Monospaces ou MPV'),
(9, 'Sport utility vehicle (SUV) et tout-terrains : petits et gros');

-- --------------------------------------------------------

--
-- Structure de la table `energie`
--

CREATE TABLE `energie` (
  `idEnergie` int(11) NOT NULL,
  `energie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `energie`
--

INSERT INTO `energie` (`idEnergie`, `energie`) VALUES
(1, 'Gazole'),
(2, 'Essence'),
(3, 'GPL'),
(4, 'Bioéthanol'),
(5, 'GNV (Gaz Naturel pour Véhicules'),
(6, 'Gazogène (pendant la Seconde Guerre mondiale en France'),
(7, 'Électrique'),
(8, 'Hybride (essence + moteur électrique)'),
(9, 'Pile à combustible (prototype)');

-- --------------------------------------------------------

--
-- Structure de la table `favoris`
--

CREATE TABLE `favoris` (
  `idUser` int(11) NOT NULL,
  `idVoiture` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `favoris`
--

INSERT INTO `favoris` (`idUser`, `idVoiture`) VALUES
(2, 20),
(1, 15),
(1, 14),
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `motorisation`
--

CREATE TABLE `motorisation` (
  `idMotorisation` int(11) NOT NULL,
  `moteur` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `motorisation`
--

INSERT INTO `motorisation` (`idMotorisation`, `moteur`) VALUES
(1, '1 cylindre'),
(2, '2 cylindres'),
(3, '3 cylindres'),
(4, '4 cylindres'),
(5, '5 cylindres'),
(6, '6 cylindres'),
(7, '8 cylindres'),
(8, '10 cylindres'),
(9, '12 cylindres'),
(10, '16 cylindres'),
(11, 'Cylindre en ligne'),
(12, 'Cylindre opposés (ou à plat)'),
(13, 'Cylindre en V'),
(14, 'Cylindre en W'),
(15, 'Moteur à piston rotatif (moteur Wankel)'),
(16, 'Moteur 2-temps'),
(17, 'Moteur 4-temps'),
(18, 'Électrique'),
(19, 'Hybride : thermique associé');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `idRole` int(11) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `role`) VALUES
(1, 'ADMIN'),
(2, 'USER');

-- --------------------------------------------------------

--
-- Structure de la table `status`
--

CREATE TABLE `status` (
  `idStatus` int(11) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `status`
--

INSERT INTO `status` (`idStatus`, `status`) VALUES
(1, 'ACTIVE'),
(2, 'INACTIVE');

-- --------------------------------------------------------

--
-- Structure de la table `transmission`
--

CREATE TABLE `transmission` (
  `idTransmission` int(11) NOT NULL,
  `transmission` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `transmission`
--

INSERT INTO `transmission` (`idTransmission`, `transmission`) VALUES
(1, 'Traction (avant)'),
(2, 'Propulsion (par les roues arrière)'),
(3, 'Quatre roues motrices'),
(4, 'Traction intégrale temporaire'),
(5, 'Traction intégrale permanente'),
(6, 'Traction avant + propulsion électrique');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `mdp` varchar(256) NOT NULL,
  `idStatus` int(11) NOT NULL DEFAULT 1,
  `idRole` int(11) NOT NULL DEFAULT 2,
  `avatar` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `nom`, `prenom`, `email`, `pseudo`, `mdp`, `idStatus`, `idRole`, `avatar`) VALUES
(1, 'Admin', 'Admin', 'admin@gmail.com', 'ADMIN', '$2y$10$l4dTJrMLA18JbcV4RtyQs.qpUioXL2TPERPKdH6QCrE635iRJDq4u', 1, 1, '/avatar/6458deaa0c22e.png'),
(2, 'Maleq', 'Ilan', 'ilan.maleq@icloud.com', 'ILAN123', '$2y$10$lpCQMVgCMzzBmZUPKwsQfuwLxOmHbQwFdPQ1238u90dUJzIRmBTRW', 1, 1, '/avatar/6458deddee71c.jpg'),
(3, 'Hamzi', 'LeFish', 'HamziLeFish@gmail.com', 'HamziLeFish', '$2y$10$j0p8x2BwTBNECsNu4/51COj0XPTQSxRHyjQQn.B5AllRWJZK8YdMa', 2, 2, '/avatar/6459eda1da97c.jpg'),
(4, 'Maleq', 'Ilan', 'bgbg@bg.bg', 'bgHamzi', '$2y$10$qkxaanKQLt1YuUc7rmh3N.1oM8x196iW3kyu5G1FSSsuY/O52Eh5m', 1, 2, '/avatar/645a471722792.png'),
(5, 'Boby', 'Boby', 'bobyLeFish@gmail.com', 'BobyLeFish', '$2y$10$HSDzPa5.yZoXVXpwiSZnVOLB5kijrnrwb9FpbJvdDfURHBPL0w1P6', 2, 2, '/avatar/645a483f6abf8.jpg'),
(6, 'jemo', 'jemo', 'jemo@jemo.jemo', 'JEMO', '$2y$10$AzU5ncIxJgO/f0FwDLPoVeYQmhfeTI.EWJ6smokKnL4caY.yDjEIe', 1, 2, '/avatar/645a494a1784c.png');

-- --------------------------------------------------------

--
-- Structure de la table `visibilite`
--

CREATE TABLE `visibilite` (
  `idVisibilite` int(11) NOT NULL,
  `visibilite` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `visibilite`
--

INSERT INTO `visibilite` (`idVisibilite`, `visibilite`) VALUES
(1, 'Privé'),
(2, 'Publique');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `idVoiture` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `dateCreationFiche` timestamp NOT NULL DEFAULT current_timestamp(),
  `marqueVoiture` varchar(100) NOT NULL,
  `modeleVoiture` varchar(100) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `idMotorisation` int(11) NOT NULL,
  `idEnergie` int(11) NOT NULL,
  `idTransmission` int(11) NOT NULL,
  `idBoiteVitesse` int(11) NOT NULL,
  `poids` int(11) NOT NULL,
  `nbrPortes` int(11) NOT NULL,
  `nbrPlaces` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `image` varchar(100) NOT NULL,
  `documentTechnique` varchar(100) NOT NULL,
  `dateFabrication` date NOT NULL,
  `idVisibilite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`idVoiture`, `idUser`, `dateCreationFiche`, `marqueVoiture`, `modeleVoiture`, `idCategorie`, `idMotorisation`, `idEnergie`, `idTransmission`, `idBoiteVitesse`, `poids`, `nbrPortes`, `nbrPlaces`, `commentaire`, `image`, `documentTechnique`, `dateFabrication`, `idVisibilite`) VALUES
(1, 2, '2023-05-09 14:24:31', 'BMW', 'M3 CS', 7, 6, 2, 2, 5, 1585, 5, 4, 'La nouvelle BMW M3 CS est la plus r&eacute;cente &eacute;dition sp&eacute;ciale de BMW M GmbH et aussi le plus puissant v&eacute;hicule de s&eacute;rie de tous les temps dans la gamme M3. Le moteur essence M TwinPower Turbo &agrave; 6 cylindres en ligne de 460 ch et de 600 Nm, propulse cette sportive de l&rsquo;extr&ecirc;me de 0 &agrave; 100 km/h en 3,9 secondes et lui conf&egrave;re une vitesse maximale r&eacute;gul&eacute;e de 280 km/h. Le centre BMW Emil Frey Acacias a le privil&egrave;ge d&#039;en proposer deux exemplaires.', '/car/6458e0e6a92e5.jpg', '/document/6458e0e6af030.pdf', '2017-11-08', 2),
(2, 2, '2023-05-09 14:25:47', 'Ferrari', 'Monza SP2', 7, 7, 2, 2, 5, 1500, 3, 2, 'Les Ferrari Monza SP1 et SP2 sont des barquettes produites par le constructeur automobile italien Ferrari &agrave; partir de 2019. La monoplace SP1 et la biplace SP2 font partie de la nouvelle gamme de supercar Icona du constructeur au cheval cabr&eacute;. La Monza SP2 est &eacute;lue &laquo; Plus belle supercar de l&#039;ann&eacute;e 2018 &raquo;. ', '/car/6458e4476e6cd.jpg', '/document/6458e447738e2.pdf', '2019-01-19', 2),
(3, 2, '2023-05-09 14:33:50', 'Maserati', 'Grand Sport V8 ', 7, 7, 2, 3, 2, 1690, 3, 4, 'La Maserati Coup&eacute; est une voiture coup&eacute; Grand Tourisme de luxe produite par le constructeur italien Maserati de 2002 &agrave; 2007. Son design est d&ucirc; au c&eacute;l&egrave;bre designer automobile Giorgetto Giugiaro.\r\n\r\nCe mod&egrave;le est une &eacute;volution de la Maserati 3200 GT d&rsquo;un point de vue esth&eacute;tique. Elle diff&egrave;re n&eacute;anmoins nettement de la 3200 GT par son architecture transaxale, c&rsquo;est-&agrave;-dire que la boite est ici accol&eacute;e au train arri&egrave;re. Cette architecture est notamment tr&egrave;s utilis&eacute;e par Ferrari qui a pris le contr&ocirc;le du constructeur de Mod&egrave;ne et qui supervise donc le d&eacute;veloppement des mod&egrave;les.\r\n\r\nElle h&eacute;rite du moteur Ferrari F136 &agrave; carter sec que l&rsquo;on retrouvera par exemple par la suite sur la Ferrari F430 ou Ferrari 458 Italia ainsi que la boite F1 Ferrari ici baptis&eacute;e Cambiocorsa ou une boite manuelle traditionnelle maison. ', '/car/6458e74702b74.jpg', '/document/6458e74721aa8.pdf', '2005-08-23', 2),
(4, 2, '2023-05-09 14:35:33', 'Ferrari', 'Daytona SP3', 7, 9, 8, 2, 1, 1485, 3, 2, 'La Daytona SP3 est une supercar du constructeur automobile italien Ferrari produite &agrave; 599 exemplaires &agrave; partir de fin 20221. Elle rend hommage au tripl&eacute; Ferrari lors des 24 Heures de Daytona 1967. ', '/car/6458f163c427d.jpg', '/document/6458f163ca63a.pdf', '2022-01-01', 2),
(5, 2, '2023-05-09 14:36:56', 'Porsche', 'GT3RS', 7, 6, 2, 2, 7, 1400, 3, 2, 'Les athl&egrave;tes le savent : les meilleures performances exigent plus que des conditions id&eacute;ales et de la chance. Il faut vouloir, &agrave; tout prix, devenir plus rapide et plus fort &agrave; chaque entra&icirc;nement. Tout remettre en question, surtout soi-m&ecirc;me. Et apprendre de chaque erreur. Dans cet esprit, Porsche continue de repousser les limites du possible et am&eacute;liore encore ses performances sur circuit. D&eacute;couvrez la nouvelle 911 GT3 RS, au meilleur de sa forme.', '/car/6458f60256ad9.JPG', '/document/6458f6025a561.pdf', '2019-05-02', 2),
(6, 2, '2023-05-09 14:38:59', 'Chevrolet', 'Corvette C8', 7, 7, 8, 1, 1, 1655, 3, 2, 'La Corvette (C8) est une voiture de sport du constructeur automobile am&eacute;ricain Chevrolet produite &agrave; partir de d&eacute;cembre 2019. Elle est la 8e g&eacute;n&eacute;ration de Chevrolet Corvette. ', '/car/6458f841aa576.jpeg', '/document/6458f841aeb5a.pdf', '2019-10-03', 2),
(7, 2, '2023-05-09 14:40:07', 'McLaren', 'P1', 7, 6, 2, 2, 5, 1400, 3, 2, 'La McLaren P1 est la premi&egrave;re voiture de sport hybride du constructeur automobile britannique McLaren, mais aussi dans le monde. Elle est pr&eacute;sent&eacute;e au Salon international de l&#039;automobile de Gen&egrave;ve 2013 et est fabriqu&eacute;e en 375 exemplaires. ', '/car/645906e887cea.jpg', '/document/645906e88c6b6.pdf', '2013-04-02', 2),
(8, 2, '2023-05-10 06:24:03', 'Maserati', 'Grand Sport V8 ', 7, 7, 2, 3, 2, 1690, 3, 4, 'La Maserati Coup&eacute; est une voiture coup&eacute; Grand Tourisme de luxe produite par le constructeur italien Maserati de 2002 &agrave; 2007. Son design est d&ucirc; au c&eacute;l&egrave;bre designer automobile Giorgetto Giugiaro.\r\n\r\nCe mod&egrave;le est une &eacute;volution de la Maserati 3200 GT d&rsquo;un point de vue esth&eacute;tique. Elle diff&egrave;re n&eacute;anmoins nettement de la 3200 GT par son architecture transaxale, c&rsquo;est-&agrave;-dire que la boite est ici accol&eacute;e au train arri&egrave;re. Cette architecture est notamment tr&egrave;s utilis&eacute;e par Ferrari qui a pris le contr&ocirc;le du constructeur de Mod&egrave;ne et qui supervise donc le d&eacute;veloppement des mod&egrave;les.\r\n\r\nElle h&eacute;rite du moteur Ferrari F136 &agrave; carter sec que l&rsquo;on retrouvera par exemple par la suite sur la Ferrari F430 ou Ferrari 458 Italia ainsi que la boite F1 Ferrari ici baptis&eacute;e Cambiocorsa ou une boite manuelle traditionnelle maison. ', '/car/6458e74702b74.jpg', '/document/6458e74721aa8.pdf', '2005-08-23', 1),
(9, 2, '2023-05-10 07:13:51', 'McLaren', 'P1', 7, 6, 2, 2, 5, 1400, 3, 2, 'La McLaren P1 est la premi&egrave;re voiture de sport hybride du constructeur automobile britannique McLaren, mais aussi dans le monde. Elle est pr&eacute;sent&eacute;e au Salon international de l&#039;automobile de Gen&egrave;ve 2013 et est fabriqu&eacute;e en 375 exemplaires. ', '/car/645906e887cea.jpg', '/document/645906e88c6b6.pdf', '2013-04-02', 1),
(10, 2, '2023-05-10 08:25:08', 'Chevrolet', 'Corvette C7', 7, 7, 2, 2, 1, 1539, 3, 2, 'La Corvette (C7) est une voiture de sport produite par le constructeur automobile am&eacute;ricain Chevrolet &agrave; partir de 2013. Elle est la 7e g&eacute;n&eacute;ration de Chevrolet Corvette, dont la production a d&eacute;but&eacute; en 1953, et fait rena&icirc;tre le nom &laquo; Stingray &raquo; (nom anglais de la raie &agrave; &eacute;peron), d&eacute;signant &agrave; l&#039;origine la Corvette de deuxi&egrave;me g&eacute;n&eacute;ration).\r\n\r\nPour les 60 ans de ce mod&egrave;le, cette g&eacute;n&eacute;ration se dote de technologies &eacute;prouv&eacute;es, comme des ressorts &agrave; lames ou une distribution par culbuteurs, dont l&#039;adoption permet &agrave; la Corvette de rester concurrentielle sur le plan des performances par rapport aux sportives europ&eacute;ennes.\r\n\r\nEn 2017, Chevrolet d&eacute;voile une s&eacute;rie sp&eacute;ciale baptis&eacute;e Carbon 65 de sa Corvette pour f&ecirc;ter les 65 ans du mod&egrave;le originel n&eacute; en 1953. ', '/car/645b54e4a6269.jpg', '/document/645b54e4aebf2.pdf', '2013-06-03', 2),
(11, 2, '2023-05-10 08:38:09', 'Mercedes', 'AMG GT', 7, 7, 2, 2, 5, 1615, 3, 2, 'La Mercedes-AMG GT est une voiture sportive produite par le constructeur automobile allemand Mercedes-AMG de 2014 &agrave; 2021. Il s&#039;agit de la seconde voiture de sport d&eacute;velopp&eacute;e compl&egrave;tement en interne apr&egrave;s la Mercedes-Benz SLS AMG.\r\n\r\nLa Mercedes-AMG GT existe en coup&eacute; et roadster deux portes &agrave; deux places, &eacute;quip&eacute;e d&#039;un moteur V8 Bi-turbo de 4,0 litres dont la puissance &eacute;volue selon les versions.\r\n\r\nCe mod&egrave;le n&#039;est plus produit &agrave; partir de d&eacute;cembre 2021. ', '/car/645b57f13a64a.jpg', '/document/645b57f13fef1.pdf', '2018-09-06', 2),
(12, 2, '2023-05-10 08:53:18', 'Porsche', '959', 7, 6, 2, 2, 1, 1449, 3, 2, 'La Porsche 959 est une voiture sportive produite par Porsche. Elle appara&icirc;t en 1983 au salon de Francfort sous la forme d&#039;un prototype, la 911 Groupe B. Peu avant, la F&eacute;d&eacute;ration internationale de l&#039;automobile (FIA) avait chang&eacute; ses r&egrave;glements pour encourager les constructeurs &agrave; faire de la comp&eacute;tition : il ne fallait plus commercialiser que deux cents exemplaires pour pouvoir prendre part aux comp&eacute;titions du Groupe B. Int&eacute;ress&eacute; par ce changement, Porsche d&eacute;veloppa une version routi&egrave;re de la 959 avec pour objectif de servir de vitrine technologique &agrave; la marque, sans se soucier du co&ucirc;t final de la voiture.\r\n\r\nLa 959 sera suivie par la 911 GT1 Stra&szlig;enversion en 1996, puis par la Carrera GT en 2003, puis par la Porsche 918 en 2013. ', '/car/645b5b7e76bfc.jpg', '/document/645b5b7e7b109.pdf', '1983-06-05', 2),
(13, 2, '2023-05-10 08:58:07', 'Ferrari', 'F8 Tributo', 7, 7, 8, 1, 1, 1430, 3, 2, 'La rempla&ccedil;ante de la Ferrari 488 GTB est d&eacute;voil&eacute;e le 28 f&eacute;vrier 2019 avant sa premi&egrave;re exposition publique au Salon international de l&#039;automobile de Gen&egrave;ve 20191. La F8 doit son nom au nombre de cylindre de son moteur, comme la F12 en 2012, et &laquo; Tributo &raquo; signifie &laquo; Hommage &raquo; qu&#039;elle rend &agrave; la F40 et la 308 par son design.\r\n\r\nFerrari a pour habitude d&#039;offrir une grosse mise &agrave; jour de sa sportive, en changeant de patronyme, avant que celle-ci ne soit remplac&eacute;e par un nouveau mod&egrave;le. Ainsi la 208 et 308 est devenue 328 en 1985, avant d&#039;&ecirc;tre remplac&eacute;e par la 348 en 1989, elle m&ecirc;me devenue F355 en 1994, puis remplac&eacute;e par la 360 Modena en 1999, qui devient &agrave; F430 en 2004. En 2009 c&#039;est la 458 Italia qui d&eacute;barque, elle est remplac&eacute;e par la 488 GTB en 2015. Mais cette fois, Ferrari d&eacute;roge &agrave; la r&egrave;gle et pr&eacute;sente la F8 Tributo, dont le nom ne suit plus la logique d&#039;&eacute;volution des &laquo; 300 &raquo;, qui repose une nouvelle fois sur les bases de la 458 Italia. Soit donc trois mod&egrave;les cons&eacute;cutifs &agrave; partir d&#039;une base commune. La F8 Tributo ressemble plus &agrave; un gros restylage de sa pr&eacute;d&eacute;cesseure plut&ocirc;t qu&#039;&agrave; un nouveau mod&egrave;le, certains &eacute;l&eacute;ments de carrosserie &eacute;tant communs aux deux versions.\r\n\r\nLa production de la Ferrari F8 Tributo est arr&ecirc;t&eacute;e en avril 2023 pour la version coup&eacute;, seuls les derniers exemplaires de F8 Spider sont encore produit pour les mod&egrave;les 2023. ', '/car/645b5c9f19496.jpg', '/document/645b5c9f1d376.pdf', '2019-07-06', 2),
(14, 2, '2023-05-10 09:06:17', 'BMW', 'X3 M40i', 5, 6, 2, 3, 5, 1925, 5, 5, 'La X3 est un crossover (SUV compact) haut de gamme produit par le constructeur automobile allemande BMW.\r\n\r\n&Agrave; la suite du succ&egrave;s de la BMW X5 et profitant de l&rsquo;essor du march&eacute; des v&eacute;hicules de loisirs, BMW pr&eacute;sente en 2003 un concept X3 au salon de D&eacute;troit. Les premiers mod&egrave;les sortent d&#039;usine un an apr&egrave;s cette pr&eacute;sentation. Pionnier sur le segment des SUV compact &laquo; premium &raquo;, la BMW X3 ne rencontre pas de r&eacute;elle concurrence avant l&#039;arriv&eacute;e des Audi Q5 et autres Mercedes-Benz GLK.\r\n\r\nLa troisi&egrave;me g&eacute;n&eacute;ration de la X3 est actuellement produite, depuis 2017. Une version &eacute;lectrique baptis&eacute;e iX3 est &eacute;galement disponible. ', '/car/645b5e89029d8.jpg', '/document/645b5e890739e.pdf', '2021-02-24', 2),
(15, 2, '2023-05-10 09:13:04', 'Nissan', 'Skyline R34', 7, 6, 2, 3, 1, 1459, 3, 2, 'La Skyline R34 est un v&eacute;hicule sportif haut de gamme &agrave; volant &agrave; droite existant en coup&eacute; 2 portes et en berline 4 portes. Elle est souvent retenue pour la d&eacute;clinaison GT-R (BNR34), &agrave; ne pas confondre avec la Nissan GT-R, un mod&egrave;le de supercar n&#039;appartenant pas &agrave; la gamme Skyline. Cette g&eacute;n&eacute;ration de Skyline a &eacute;t&eacute; majoritairement commercialis&eacute;e au Japon, &agrave; l&#039;exception de quelques mod&egrave;les GT-R (BNR34) import&eacute;s officiellement dans quelques pays tels que le Royaume-Uni et l&#039;Australie.\r\n\r\nLa Skyline R34 a &eacute;t&eacute; remplac&eacute;e en 2002 par la Skyline V35, vendue aux &Eacute;tats-Unis et en Europe sous la marque Infiniti, avec le mod&egrave;le G35/37/25.\r\n\r\nCe mod&egrave;le a eu de nombreuses d&eacute;clinaisons, par exemple une version nomm&eacute;e d&rsquo;apr&egrave;s le circuit du N&uuml;rburgring (Nissan Skyline R34 GT-R N&uuml;r) plus performant, ou encore l&rsquo;&eacute;dition limit&eacute;e Midnight Purple, peinte d&rsquo;un violet caract&eacute;ristique.\r\n\r\nNismo, la division performance de Nissan, pr&eacute;pare, entre 2003 et 2007, dix-neuf mod&egrave;les GT-R (BNR34) pour en faire des GT-R Z-Tune. Cette version finale du mod&egrave;le d&eacute;veloppe 500 ch pour 540 N m de couple, les moteurs RB26DETT des mod&egrave;les GT-R utilis&eacute;s sont r&eacute;al&eacute;s&eacute;s &agrave; 2 771 cm3, ces moteurs sont alors num&eacute;rot&eacute;s avec la mention Z2, ils sont donc appel&eacute;s &laquo; RB28Z2 &raquo;. ', '/car/645b6020509be.jpg', '/document/645b602055648.pdf', '1999-09-02', 2),
(16, 2, '2023-05-10 09:30:58', 'Renault', 'Twingo', 1, 18, 7, 2, 1, 780, 5, 5, 'Version &eacute;lectrique, pr&eacute;sent&eacute;e le 1er septembre 2020 pour commercialisation fin 2020, &eacute;quip&eacute;e d&#039;une batterie de 21,3 kWh et d&#039;un moteur de 60 kW (82 ch). Son autonomie est de 180 km en cycle mixte et jusqu&#039;&agrave; 270 km en urbain.', '/car/645b6d76a226f.jpeg', '/document/645b6d76a707f.pdf', '2023-02-05', 2),
(17, 2, '2023-05-10 10:42:52', 'Citro&euml;n', 'C1', 1, 3, 2, 1, 1, 790, 4, 4, 'Sortie en 2005, la premi&egrave;re Citro&euml;n C1 est la plus petite voiture &agrave; motorisation thermique de la marque (la C0 &eacute;tant 100 % &eacute;lectrique). Comme ses cousines Peugeot 107 et Toyota Aygo, elle se pr&eacute;sente sous la forme d&#039;une petite voiture 3 ou 5 portes, &agrave; l&#039;int&eacute;rieur relativement rustique, notamment dans sa finition et les mat&eacute;riaux employ&eacute;s. Elle est disponible en deux motorisations, 1 L essence de 68 ch et 1,4 L Diesel de 54 ch, et deux bo&icirc;tes &agrave; 5 vitesses, l&#039;une manuelle et l&#039;autre robotis&eacute;e.[', '/car/645b725caf0b8.jpg', '/document/645b725cb4d53.pdf', '2020-09-05', 2),
(18, 2, '2023-05-10 10:46:01', 'Citro&euml;n', 'C1', 1, 3, 2, 1, 1, 790, 4, 4, 'Sortie en 2005, la premi&egrave;re Citro&euml;n C1 est la plus petite voiture &agrave; motorisation thermique de la marque (la C0 &eacute;tant 100 % &eacute;lectrique). Comme ses cousines Peugeot 107 et Toyota Aygo, elle se pr&eacute;sente sous la forme d&#039;une petite voiture 3 ou 5 portes, &agrave; l&#039;int&eacute;rieur relativement rustique, notamment dans sa finition et les mat&eacute;riaux employ&eacute;s. Elle est disponible en deux motorisations, 1 L essence de 68 ch et 1,4 L Diesel de 54 ch, et deux bo&icirc;tes &agrave; 5 vitesses, l&#039;une manuelle et l&#039;autre robotis&eacute;e.[', '/car/645b725caf0b8.jpg', '/document/645b725cb4d53.pdf', '2020-09-05', 1),
(19, 2, '2023-05-10 10:58:34', 'Renault', 'Clio 4', 2, 4, 2, 1, 5, 1178, 5, 4, 'La Clio V est une automobile citadine du constructeur automobile fran&ccedil;ais Renault, commercialis&eacute;e depuis le 2 avril 20191. Il s&#039;agit de la cinqui&egrave;me g&eacute;n&eacute;ration de Clio apr&egrave;s la Clio I de 1990, la Clio II de 1998, la Clio III en 2005 et la Clio IV de 2012, vendues &agrave; 15 millions d&#039;exemplaires cumul&eacute;s. Elle est le premier mod&egrave;le de la gamme Clio &agrave; voir sa production enti&egrave;rement d&eacute;localis&eacute;e hors de France. ', '/car/645b78da27f5a.jpg', '/document/645b78da2ce51.pdf', '2019-12-02', 2),
(20, 2, '2023-05-10 11:17:23', 'Volkswagen', 'Polo 7 ', 2, 4, 2, 1, 5, 1179, 5, 5, 'En avril 2021, la Polo re&ccedil;oit un restylage bien visible.\r\n\r\nEn plus de proposer de nouveaux phares, une calandre l&eacute;g&egrave;rement retouch&eacute;e et des boucliers redessin&eacute;s, les versions restyl&eacute;es de la Polo int&egrave;grent de nouvelles fonctions d&#039;assistance &agrave; la conduite: De s&eacute;rie, la Polo est &eacute;quip&eacute;e du Travel Assist &mdash; similaire &agrave; celle de la Passat &mdash; qui contient &agrave; la fois une fonction Adaptive Cruise Control et une fonction de maintien dans la voie. La pr&eacute;sence de ces deux fonctions d&#039;aide longitudinale et transversale classe la suite au niveau 2 sous la responsabilit&eacute; du conducteur.\r\n\r\nLa fonction Adaptive Cruise Control du Travel Assist prend en compte certaines conditions de circulation comme les limitations de vitesse, les virages, les agglom&eacute;rations et les croisements &agrave; la mani&egrave;re d&#039;une adaptation intelligente de la vitesse.\r\n\r\nLe syst&egrave;me IQ.Drive est optionnel.\r\n\r\nCes nouvelles fonctions d&#039;assistance &agrave; la conduite sont disponibles sur la Polo &agrave; partir de mai 2021 en pr&eacute;vente3 mais seulement disponibles en concession en septembre 2021.\r\n\r\nEn juin 2021, Volkswagen pr&eacute;sente la version restyl&eacute;e de la Polo GTi, qui avait disparu du catalogue en mars 2020, &eacute;quip&eacute;e du quatre cylindres 2.0 litres Turbo d&eacute;veloppant 207 ch.\r\n\r\nLa version br&eacute;silienne est restyl&eacute;e en septembre 2022. Son style reste plus proche de celui de la phase 1, dont la forme carr&eacute;e des feux arri&egrave;re est conserv&eacute;e. ', '/car/645b7d43774f6.jpg', '/document/645b7d437bf2f.pdf', '2021-02-21', 2),
(21, 2, '2023-05-11 07:03:21', 'Citro&euml;n', 'C1', 1, 3, 2, 1, 1, 790, 4, 4, 'Sortie en 2005, la premi&egrave;re Citro&euml;n C1 est la plus petite voiture &agrave; motorisation thermique de la marque (la C0 &eacute;tant 100 % &eacute;lectrique). Comme ses cousines Peugeot 107 et Toyota Aygo, elle se pr&eacute;sente sous la forme d&#039;une petite voiture 3 ou 5 portes, &agrave; l&#039;int&eacute;rieur relativement rustique, notamment dans sa finition et les mat&eacute;riaux employ&eacute;s. Elle est disponible en deux motorisations, 1 L essence de 68 ch et 1,4 L Diesel de 54 ch, et deux bo&icirc;tes &agrave; 5 vitesses, l&#039;une manuelle et l&#039;autre robotis&eacute;e.[', '/car/645b725caf0b8.jpg', '/document/645b725cb4d53.pdf', '2020-09-05', 1),
(22, 2, '2023-05-15 06:35:26', 'Test', 'Test', 1, 1, 1, 1, 1, 1232131, 3, 3, 'dsadsd', '/car/6461d2ae8f183.jpg', '/document/6461d2ae92336.pdf', '2023-05-01', 1),
(23, 1, '2023-05-16 09:55:32', 'McLaren', 'P1', 7, 6, 2, 2, 5, 1400, 3, 2, 'La McLaren P1 est la premi&egrave;re voiture de sport hybride du constructeur automobile britannique McLaren, mais aussi dans le monde. Elle est pr&eacute;sent&eacute;e au Salon international de l&#039;automobile de Gen&egrave;ve 2013 et est fabriqu&eacute;e en 375 exemplaires. ', '/car/645906e887cea.jpg', '/document/645906e88c6b6.pdf', '2013-04-02', 1);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `boitevitesse`
--
ALTER TABLE `boitevitesse`
  ADD PRIMARY KEY (`idBoiteVitesse`);

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`idCategorie`);

--
-- Index pour la table `energie`
--
ALTER TABLE `energie`
  ADD PRIMARY KEY (`idEnergie`);

--
-- Index pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD KEY `FK_IDUSER` (`idUser`),
  ADD KEY `FK_IDCAR` (`idVoiture`);

--
-- Index pour la table `motorisation`
--
ALTER TABLE `motorisation`
  ADD PRIMARY KEY (`idMotorisation`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`idStatus`);

--
-- Index pour la table `transmission`
--
ALTER TABLE `transmission`
  ADD PRIMARY KEY (`idTransmission`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idUser`),
  ADD KEY `FK_STATUS` (`idStatus`),
  ADD KEY `FK_ROLES` (`idRole`);

--
-- Index pour la table `visibilite`
--
ALTER TABLE `visibilite`
  ADD PRIMARY KEY (`idVisibilite`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`idVoiture`),
  ADD KEY `FK_CATEGORIE` (`idCategorie`),
  ADD KEY `FK_ENERGIE` (`idEnergie`),
  ADD KEY `FK_MOTORISATION` (`idMotorisation`),
  ADD KEY `FK_TRANSMISSION` (`idTransmission`),
  ADD KEY `FK_USER` (`idUser`),
  ADD KEY `FK_VISIBILITE` (`idVisibilite`),
  ADD KEY `FK_BOITEVITESSE` (`idBoiteVitesse`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `boitevitesse`
--
ALTER TABLE `boitevitesse`
  MODIFY `idBoiteVitesse` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `idCategorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `energie`
--
ALTER TABLE `energie`
  MODIFY `idEnergie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `motorisation`
--
ALTER TABLE `motorisation`
  MODIFY `idMotorisation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `status`
--
ALTER TABLE `status`
  MODIFY `idStatus` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `transmission`
--
ALTER TABLE `transmission`
  MODIFY `idTransmission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `visibilite`
--
ALTER TABLE `visibilite`
  MODIFY `idVisibilite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `idVoiture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `favoris`
--
ALTER TABLE `favoris`
  ADD CONSTRAINT `FK_IDCAR` FOREIGN KEY (`idVoiture`) REFERENCES `voiture` (`idVoiture`),
  ADD CONSTRAINT `FK_IDUSER` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_ROLES` FOREIGN KEY (`idRole`) REFERENCES `roles` (`idRole`),
  ADD CONSTRAINT `FK_STATUS` FOREIGN KEY (`idStatus`) REFERENCES `status` (`idStatus`);

--
-- Contraintes pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD CONSTRAINT `FK_BOITEVITESSE` FOREIGN KEY (`idBoiteVitesse`) REFERENCES `boitevitesse` (`idBoiteVitesse`),
  ADD CONSTRAINT `FK_CATEGORIE` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`),
  ADD CONSTRAINT `FK_ENERGIE` FOREIGN KEY (`idEnergie`) REFERENCES `energie` (`idEnergie`),
  ADD CONSTRAINT `FK_MOTORISATION` FOREIGN KEY (`idMotorisation`) REFERENCES `motorisation` (`idMotorisation`),
  ADD CONSTRAINT `FK_TRANSMISSION` FOREIGN KEY (`idTransmission`) REFERENCES `transmission` (`idTransmission`),
  ADD CONSTRAINT `FK_USER` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`),
  ADD CONSTRAINT `FK_VISIBILITE` FOREIGN KEY (`idVisibilite`) REFERENCES `visibilite` (`idVisibilite`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
