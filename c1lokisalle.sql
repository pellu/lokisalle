-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 23, 2017 at 06:05 PM
-- Server version: 10.0.30-MariaDB-0+deb8u1
-- PHP Version: 5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `c1lokisalle`
--

-- --------------------------------------------------------

--
-- Table structure for table `avis`
--

CREATE TABLE IF NOT EXISTS `avis` (
`id_avis` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `commentaire` text NOT NULL,
  `note` int(2) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `avis`
--

INSERT INTO `avis` (`id_avis`, `id_membre`, `id_salle`, `commentaire`, `note`, `date_enregistrement`) VALUES
(1, 3, 4, 'La salle est vraiment trÃ¨s pratique :) !', 5, '2017-04-22 13:11:37'),
(2, 5, 4, 'Vraiment trÃ¨s belle salle mais pas super pratique pour se garer', 3, '2017-04-22 13:16:29');

-- --------------------------------------------------------

--
-- Table structure for table `commande`
--

CREATE TABLE IF NOT EXISTS `commande` (
`id_commande` int(3) NOT NULL,
  `id_membre` int(3) NOT NULL,
  `id_produit` int(3) NOT NULL,
  `date_enregistrement` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `commande`
--

INSERT INTO `commande` (`id_commande`, `id_membre`, `id_produit`, `date_enregistrement`) VALUES
(3, 3, 15, '2022-04-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
`id_membre` int(3) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `mdp` varchar(60) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `civilite` varchar(1) NOT NULL,
  `statut` int(1) NOT NULL,
  `date_enregistrement` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`id_membre`, `pseudo`, `mdp`, `nom`, `prenom`, `email`, `civilite`, `statut`, `date_enregistrement`) VALUES
(1, 'admin', 'dd94709528bb1c83d08f3088d4043f4742891f4f', 'admin', 'admin', 'admin@admin.admin', 'h', 1, '1492502326'),
(3, 'Pellu', '783cf99a6dfe5e113e1966587f9604b220412c8e', 'Pellu', 'Jordan', 'pellu.pellu@pellu.fr', 'h', 0, '1492612326'),
(4, 'erwin', '554f220ea49724ff6894da46c97ac8af9245ecc7', 'Erwina', 'Erwin', 'erwin.erwina@gmail.com', 'h', 1, '1492612411'),
(5, 'paul', '88ee3f8e209d4f6dc5d600d140d6f21fb701c0a3', 'paul', 'paul', 'paul@paul.paul', 'h', 0, '1492859535');

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
`id_produit` int(3) NOT NULL,
  `id_salle` int(3) NOT NULL,
  `date_arrivee` tinytext NOT NULL,
  `date_depart` tinytext NOT NULL,
  `prix` int(3) NOT NULL,
  `etat` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `id_salle`, `date_arrivee`, `date_depart`, `prix`, `etat`) VALUES
(2, 3, '17-06-2017', '18-06-2017', 200, 'libre'),
(3, 10, '02-08-2017', '19-08-2017', 754, 'libre'),
(4, 8, '05-06-2017', '10-06-2017', 1500, 'libre'),
(5, 5, '08-05-2017', '20-05-2017', 800, 'libre'),
(6, 12, '29-06-2017', '30-06-2017', 500, 'libre'),
(7, 13, '24-04-2017', '28-04-2017', 777, 'libre'),
(8, 5, '03-07-2017', '21-07-2017', 2000, 'libre'),
(9, 8, '06-06-2017', '08-06-2017', 490, 'libre'),
(10, 11, '25-04-2017', '29-04-2017', 900, 'libre'),
(11, 9, '30-12-2017', '01-01-2018', 10000, 'libre'),
(12, 3, '24-04-2017', '24-05-2017', 5000, 'reserve'),
(14, 3, '29-05-2017', '31-05-2017', 500, 'libre'),
(15, 4, '24-04-2017', '07-05-2017', 2000, 'reserve'),
(16, 4, '22-05-2017', '26-05-2017', 795, 'reserve'),
(17, 4, '30-06-2017', '02-07-2017', 300, 'libre'),
(18, 6, '07-08-2017', '01-09-2017', 7000, 'libre'),
(19, 6, '25-04-2017', '30-04-2017', 900, 'libre'),
(20, 6, '19-05-2017', '23-05-2017', 762, 'libre'),
(21, 7, '05-06-2017', '16-06-2017', 1200, 'libre'),
(22, 7, '15-05-2017', '21-05-2017', 760, 'libre'),
(23, 7, '09-10-2017', '18-10-2017', 800, 'libre'),
(24, 8, '16-10-2017', '21-10-2017', 680, 'libre'),
(25, 9, '01-09-2017', '09-09-2017', 850, 'libre'),
(26, 9, '11-07-2017', '14-07-2017', 400, 'libre'),
(27, 10, '14-08-2017', '18-08-2017', 600, 'libre'),
(28, 10, '20-11-2017', '30-11-2017', 1300, 'libre'),
(29, 12, '29-05-2017', '31-05-2017', 300, 'libre'),
(30, 12, '10-07-2017', '13-07-2017', 350, 'libre'),
(31, 13, '12-06-2017', '23-06-2017', 1200, 'libre'),
(32, 13, '01-09-2017', '09-09-2017', 1500, 'libre'),
(33, 7, '08-05-2017', '20-05-2017', 725, 'libre'),
(34, 7, '08-06-2017', '08-06-2017', 500, 'libre'),
(35, 10, '26-04-2017', '29-04-2017', 300, 'libre'),
(36, 10, '30-04-2017', '10-05-2017', 400, 'libre'),
(37, 8, '23-04-2017', '26-04-2017', 600, 'libre');

-- --------------------------------------------------------

--
-- Table structure for table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
`id_salle` int(3) NOT NULL,
  `titre` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(200) NOT NULL,
  `ville` varchar(20) NOT NULL,
  `adresse` varchar(50) NOT NULL,
  `cp` varchar(5) NOT NULL,
  `capacite` int(3) NOT NULL,
  `categorie` varchar(15) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `salle`
--

INSERT INTO `salle` (`id_salle`, `titre`, `description`, `photo`, `ville`, `adresse`, `cp`, `capacite`, `categorie`) VALUES
(3, 'Salle prÃ¨s d''OpÃ©ra', 'Une salle prÃ¨s de l''arrÃªt de mÃ©tro OpÃ©ra, dans les immeuble Haussmannien. La piÃ¨ce trÃ¨s Ã©clairÃ© grÃ¢ce Ã  ces fenÃªtre d''Ã©poque.', 'eqJfn9uJt5_admin_1492605628.jpg', 'paris', '17 rue de la Paix', '75002', 10, '1'),
(4, 'Salle CÃ©zanne', 'ComplÃ¨tement rÃ©novÃ©e, elle sera parfaite pour vos RDV professionnel. Pour montrer Ã  votre client que vous Ãªtes plein au as !', 'e7bkQlsYRd_admin_1492605885.jpg', 'paris', '6 rue du Roi de Sicile', '75004', 5, '1'),
(5, 'Bureau Monet', 'Un bureau agrÃ©able, exposÃ© sud. EquipÃ© pour la sÃ©curitÃ©, vous pourrez dormir sur les deux oreilles.', 'eKYchuJlPc_admin_1492606252.jpg', 'marseille', '6 Boulevard Bensa', '13007', 20, '2'),
(6, 'Salle Renoir', 'Unique, louez une salle en plein cÅ“ur de Paris dans le quartier du Marais. Accessible depuis la ligne 8 et 11 en transport, situÃ©e au centre de Paris.', '8NCSi5PSFq_admin_1492606931.jpg', 'lyon', '74 rue Vieille du Temple', '75003', 150, '3'),
(7, 'Salle Van Gogh', 'La salle Van Gogh est situÃ© le long des Quais de SaÃ´ne Ã  800m du centre-ville de Lyon mÃ©tro Pont de SÃ¨vres.', 'l1pXZt1r8W_admin_1492607464.jpg', 'lyon', '34 Avenue Tony Garnier', '69007', 600, '3'),
(8, 'Salle Duchamp', 'Cette salle est situÃ©e le long de la A40 reliant directement Lyon depuis le 01. IdÃ©al si vous habitez la rÃ©gion ou travaillez sur Lyon.', 'MuDLdJXk0t_admin_1492607757.jpg', 'lyon', '58T Avenue Lacassagne', '69003', 80, '3'),
(9, 'Bureau Bazille', 'Ce bureau est parfait pour tout type de rÃ©union. EquipÃ©e d''un rÃ©tro-projecteur et de nombreuses prises de courant, il est a la fois fonctionnel et spacieux. Notre Ã©quipe sera ravie de vous recevoir en vous offrant un petit dÃ©jeuner Ã  votre arrivÃ©e.', 'fXWpXG14ai_admin_1492608036.jpg', 'paris', '50 Rue de la Bienfaisance', '75008', 7, '2'),
(10, 'Salle Klee', 'Cette salle est situÃ© au niveau du pÃ©riphÃ©rique Ã  la sortie Porte d''Aubervilliers, entre le 18iÃ¨me et le 19iÃ¨me arrondissement, au pied du tramway.', 'E2hVYVQ7gU_admin_1492608179.JPG', 'marseille', '32 Avenue de Valdonne', '13013', 55, '1'),
(11, 'Salle Ruben', 'Ã€ deux pas de la gare, la salle est accessible facilement en transport.', '68v1Yn7jpc_admin_1492608404.jpg', 'paris', '18 Rue Jean Zay', '75014', 100, '1'),
(12, 'Salle Rubens', 'Cette salle est situÃ©e Ã  deux pas de la place d''Italie, dans le quartier chic de la Butte aux cailles et Ã  proximitÃ© des commerces et des transports.', 'MgPQDMNAyp_admin_1492609018.jpg', 'paris', '20 Rue Jean-Colly', '75013', 38, '2'),
(13, 'Salle Monet', 'Monnaie monnaie ! Magnifique salle Monet, haut standing et trÃ¨s grande!', '6uTRlcuy7S_admin_1492609086.jpg', 'lyon', '6 Bd Haguenau', '13012', 981, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `avis`
--
ALTER TABLE `avis`
 ADD PRIMARY KEY (`id_avis`);

--
-- Indexes for table `commande`
--
ALTER TABLE `commande`
 ADD PRIMARY KEY (`id_commande`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
 ADD PRIMARY KEY (`id_membre`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
 ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `salle`
--
ALTER TABLE `salle`
 ADD PRIMARY KEY (`id_salle`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `avis`
--
ALTER TABLE `avis`
MODIFY `id_avis` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `commande`
--
ALTER TABLE `commande`
MODIFY `id_commande` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
MODIFY `id_membre` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
MODIFY `id_produit` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `salle`
--
ALTER TABLE `salle`
MODIFY `id_salle` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
