-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 11 mars 2019 à 19:50
-- Version du serveur :  5.7.23
-- Version de PHP :  7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_disko_test`
--

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migration_versions`
--

INSERT INTO `migration_versions` (`version`, `executed_at`) VALUES
('20190307133911', '2019-03-07 13:40:12');

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prix` double NOT NULL,
  `quantite` int(11) NOT NULL,
  `datecreation` datetime NOT NULL,
  `user_prod_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_29A5EC2759C5217F` (`user_prod_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`id`, `titre`, `description`, `prix`, `quantite`, `datecreation`, `user_prod_id`) VALUES
(4, 'toto Produit 1', 'txte voili voilou', 50, 3, '2019-03-07 17:48:23', 6),
(6, 'produit 3', 'kdsjfodsfodhfh', 30, 5, '2019-03-08 05:35:19', 10),
(9, 'produit 1', 'sdfd', 50, 5, '2019-03-09 23:37:54', 8),
(10, 'produit 2', 'dggdfsgfd', 5, 2, '2019-03-10 12:39:41', 8),
(11, 'dfdf', 'dfdfdfdf', 50, 0, '2019-03-11 18:38:38', 10);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datecreation` datetime NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `datecreation`, `roles`) VALUES
(6, 'toto@gmail.com', 'toto', '$2y$13$k.JwJ0k19PPe5CrI.GDUSOhUQH207lps08MJFtrPxGyanESn5SP0a', '2019-03-07 15:12:18', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(7, 'ya@gmail.com', 'yaya', '$2y$13$aCqDUZr5RXmV9FFrwh2zvO9QRldkOhv8G3JfsHADn/ZWwLgNSrSGu', '2019-03-07 21:26:43', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(8, 'admin01@gmail.com', 'admin01', '$2y$13$R589sLW2z8V5d7yeiodKteUiGhY1x0YiQjK3akvHGgzgv1BMwb/6.', '2019-03-08 00:19:59', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(9, 'admin02@gmail.com', 'admin02', '$2y$13$yJyTIWYqyrIu6aDmWs1IxObHQs4pEIT1.O3B5/552JFwyRvPebEpi', '2019-03-08 00:20:44', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(10, 'suad01@gmail.com', 'suad01', '$2y$13$t6GF39NLAgXEnMdSK2WAYeBWMJ.ciMK9kMke2VFmpfeBbj49SFKti', '2019-03-08 00:24:09', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}'),
(11, 'suad02@gmail.com', 'suad02', '$2y$13$.r7NkT5kGQ4QKQAYlzeYuOP46xwYDyWSkZh9tOI11DxNZq2gmh6h6', '2019-03-08 00:24:44', 'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}'),
(12, 'frd.y@gmail.fr', 'fdfd', '$2y$13$dHFBgOnAZBSAgW32Hw5ake.btAH6gbMrFPwvQkZZdOCKvELK6krWS', '2019-03-10 13:47:30', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(13, 'frd.y@gmail.com', 'test new admin', '$2y$13$b/KYDiuCG7CY7dciiMjrNezXFM79bp/m4VKAq7R2a5o3mr5IiF2f2', '2019-03-10 13:48:26', 'a:1:{i:0;s:10:\"ROLE_ADMIN\";}'),
(14, 'testFlash@gmail.com', 'testFlash', '$2y$13$WmIrkfuXk799jbkfit5.1uyxP6nKMzl558o8DguToL4QsHMo47mXu', '2019-03-11 18:04:26', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(15, 'autre@gmail.com', 'autre', '$2y$13$ei9RQEF0fv9AR50/zi6IJOlX1KW0poeOL3XPhRwCPSgaL2GvQZzfm', '2019-03-11 18:08:54', 'a:1:{i:0;s:9:\"ROLE_USER\";}'),
(16, 'fddfdf@jdfj.fsd', 'fddfdf', '$2y$13$CIcERARXKQHVpj8M.h1Bq.f/gyOXSam8gzv3lo825Ecx5ok08oMKO', '2019-03-11 18:17:43', 'a:1:{i:0;s:9:\"ROLE_USER\";}');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `FK_29A5EC2759C5217F` FOREIGN KEY (`user_prod_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
