-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 10 avr. 2022 à 01:29
-- Version du serveur : 10.4.22-MariaDB
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `metatrip`
--

-- --------------------------------------------------------

--
-- Structure de la table `abonnement`
--

CREATE TABLE `abonnement` (
  `Ida` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  `Prix_a` int(11) NOT NULL,
  `Date_achat` date NOT NULL,
  `Date_expiration` date NOT NULL,
  `Etat` varchar(20) NOT NULL,
  `Ref_paiement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `chambre`
--

CREATE TABLE `chambre` (
  `idc` int(11) NOT NULL,
  `numc` int(20) NOT NULL,
  `image` varchar(1000) NOT NULL,
  `type` varchar(20) NOT NULL,
  `etat` varchar(40) NOT NULL,
  `idh` int(11) NOT NULL,
  `prixc` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chambre`
--

INSERT INTO `chambre` (`idc`, `numc`, `image`, `type`, `etat`, `idh`, `prixc`) VALUES
(139, 122, 'C:\\\\Users\\\\Nayrouz\\\\Documents\\\\NetBeansProjects\\\\metaFinal\\\\src\\\\image\\\\hotel1.jpg', 'Single', 'Disponible', 12236, 0),
(140, 5, 'C:\\\\Users\\\\Nayrouz\\\\Documents\\\\NetBeansProjects\\\\metaFinal\\\\src\\\\image\\\\cigale.jpg', 'Double', 'Disponible', 12235, 70),
(141, 20, 'ImageView[id=image_view, styleClass=image-view]', 'Double', 'Non Disponible', 12236, 80),
(143, 17, 'C:\\\\Users\\\\Nayrouz\\\\Documents\\\\NetBeansProjects\\\\metaFinal\\\\src\\\\image\\\\hotel4.jpg', 'Single', 'Disponible', 12235, 500);

-- --------------------------------------------------------

--
-- Structure de la table `chauffeur`
--

CREATE TABLE `chauffeur` (
  `idch` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(20) NOT NULL,
  `photo` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `description` varchar(20) NOT NULL,
  `etatDispo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `chauffeur`
--

INSERT INTO `chauffeur` (`idch`, `nom`, `prenom`, `photo`, `tel`, `description`, `etatDispo`) VALUES
(666, 'lam', 'fares', 'fares.png', '99999999', 'flam', 'DISPO');

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `Ide` int(11) NOT NULL,
  `Type_event` varchar(20) NOT NULL,
  `Chanteur` varchar(20) NOT NULL,
  `Adresse` varchar(20) NOT NULL,
  `Date_event` date NOT NULL,
  `prix_e` float NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`Ide`, `Type_event`, `Chanteur`, `Adresse`, `Date_event`, `prix_e`, `image`) VALUES
(2, 'hhhuhonl', 'c', '7 rue 2938', '2020-09-01', 12, ''),
(3, 'aaaaaaa', 'c', '7 rue 2938', '2020-09-01', 120, '');

-- --------------------------------------------------------

--
-- Structure de la table `hotel`
--

CREATE TABLE `hotel` (
  `Idh` int(11) NOT NULL,
  `Nom_hotel` varchar(20) NOT NULL,
  `Nb_etoiles` int(11) NOT NULL,
  `Adresse` varchar(50) NOT NULL,
  `image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `hotel`
--

INSERT INTO `hotel` (`Idh`, `Nom_hotel`, `Nb_etoiles`, `Adresse`, `image`) VALUES
(12235, 'mouradi', 5, 'hammamet', 'C:\\Users\\Nayrouz\\Documents\\NetBeansProjects\\metaFinal\\src\\image\\hotel2.jpeg'),
(12236, 'movenpick ', 5, 'gammarth', 'C:UsersNayrouzDocumentsNetBeansProjectsmetaFinalsrcimagehotel3.jpg'),
(12238, 'la cigale ', 5, 'taba', 'C:\\Users\\Nayrouz\\Documents\\NetBeansProjects\\metaFinal\\src\\image\\cigale.jpg'),
(12239, 'golden tulip', 4, 'tunis', 'C:\\\\Users\\\\Nayrouz\\\\Documents\\\\NetBeansProjects\\\\metaFinal\\\\src\\\\image\\\\hotel4.jpg'),
(12240, 'movenpick ', 4, 'gammarth', 'C:UsersNayrouzDocumentsNetBeansProjectsmetaFinalsrcimagehotel3.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `Ref_paiement` int(11) NOT NULL,
  `Date_paiement` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `paiement`
--

INSERT INTO `paiement` (`Ref_paiement`, `Date_paiement`) VALUES
(1, '2022-02-16');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_event`
--

CREATE TABLE `reservation_event` (
  `Idrev` int(11) NOT NULL,
  `Nb_pers` int(11) NOT NULL,
  `Ide` int(11) NOT NULL,
  `Idu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_event`
--

INSERT INTO `reservation_event` (`Idrev`, `Nb_pers`, `Ide`, `Idu`) VALUES
(6, 5, 2, 813),
(17, 5, 2, 813),
(20, 5, 2, 816),
(21, 5, 2, 817);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_hotel`
--

CREATE TABLE `reservation_hotel` (
  `Idrh` int(11) NOT NULL,
  `Nb_nuitees` int(11) NOT NULL,
  `Nb_personnes` int(11) NOT NULL,
  `Prix` float NOT NULL,
  `Idu` int(11) NOT NULL,
  `idh` int(11) NOT NULL,
  `Date_depart` date DEFAULT NULL,
  `Date_arrivee` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_hotel`
--

INSERT INTO `reservation_hotel` (`Idrh`, `Nb_nuitees`, `Nb_personnes`, `Prix`, `Idu`, `idh`, `Date_depart`, `Date_arrivee`) VALUES
(24, 5, 10, 3000, 41, 12236, '2022-03-15', '2022-03-17'),
(25, 2, 2, 240, 41, 12235, '2022-03-08', '2022-03-08'),
(26, 4, 2, 0, 41, 12236, '2022-03-03', '2022-03-17'),
(29, 5, 5, 1500, 41, 12236, '2022-03-09', '2022-03-24'),
(31, 5, 5, 1500, 41, 12236, '2022-03-17', '2022-03-18'),
(32, 5, 2, 600, 41, 12235, '2022-03-09', '2022-03-16'),
(33, 5, 4, 1200, 41, 12239, '2022-03-23', '2022-03-27'),
(34, 5, 2, 600, 41, 12235, '2022-03-10', '2022-03-14'),
(35, 2, 2, 240, 41, 12235, '2022-03-01', '2022-03-08'),
(36, 2, 2, 240, 41, 12235, '2022-03-01', '2022-03-15');

-- --------------------------------------------------------

--
-- Structure de la table `reservation_voiture`
--

CREATE TABLE `reservation_voiture` (
  `Idrvoit` int(11) NOT NULL,
  `prix_rent` float NOT NULL,
  `Trajet` varchar(20) NOT NULL,
  `Idu` int(11) NOT NULL,
  `Idvoit` int(11) NOT NULL,
  `idch` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_voiture`
--

INSERT INTO `reservation_voiture` (`Idrvoit`, `prix_rent`, `Trajet`, `Idu`, `Idvoit`, `idch`) VALUES
(10, 5.5, 'jandouba', 41, 55, 666);

-- --------------------------------------------------------

--
-- Structure de la table `reservation_voyage`
--

CREATE TABLE `reservation_voyage` (
  `Idrv` int(11) NOT NULL,
  `Date_depart` date NOT NULL,
  `Date_arrivee` date NOT NULL,
  `etat` varchar(20) NOT NULL,
  `Idu` int(11) NOT NULL,
  `Idv` int(11) NOT NULL,
  `Ref_paiement` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `reservation_voyage`
--

INSERT INTO `reservation_voyage` (`Idrv`, `Date_depart`, `Date_arrivee`, `etat`, `Idu`, `Idv`, `Ref_paiement`) VALUES
(7, '2022-02-16', '2022-02-16', 'Paye', 26, 97, 0),
(9, '2022-02-16', '2022-02-16', 'NonPaye', 26, 18, 0),
(10, '2020-09-01', '2050-09-01', 'Paye', 26, 97, 0),
(11, '2050-09-01', '2050-09-01', 'Paye', 26, 97, 0);

-- --------------------------------------------------------

--
-- Structure de la table `sponsor`
--

CREATE TABLE `sponsor` (
  `ids` int(11) NOT NULL,
  `nomsponsor` varchar(20) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `image` varchar(255) NOT NULL,
  `date_sp` date NOT NULL,
  `prix_sp` float NOT NULL,
  `ide` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `sponsor`
--

INSERT INTO `sponsor` (`ids`, `nomsponsor`, `tel`, `email`, `image`, `date_sp`, `prix_sp`, `ide`) VALUES
(1, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(2, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(3, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(4, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(5, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(6, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(7, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(8, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2),
(9, 'Vitalait', '22252718', 'amine@zarga.tn', '', '2011-10-01', 12, 2);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `Idu` int(11) NOT NULL,
  `Cin` varchar(20) NOT NULL,
  `Nom` varchar(20) NOT NULL,
  `Prenom` varchar(20) NOT NULL,
  `Tel` varchar(20) NOT NULL,
  `Email` varchar(38) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Image` varchar(40) NOT NULL,
  `Role` int(11) DEFAULT 0,
  `dateNaissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Idu`, `Cin`, `Nom`, `Prenom`, `Tel`, `Email`, `Password`, `Image`, `Role`, `dateNaissance`) VALUES
(41, '196525', 'ssss', 'cxx', '29845823', 'gasmi.nayrouz@esprit.tn', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(42, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(43, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(44, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(45, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(47, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', 'e882b72bccfc2ad578c27b0d9b472a14', 'image', 0, '2011-10-01'),
(48, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(49, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(50, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(51, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(52, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(53, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(54, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(55, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(56, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(57, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(58, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(59, '196525', 'ssss', 'cxx', '2568435', 'fares@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(60, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(61, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(62, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(63, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(64, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(65, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(66, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(67, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(68, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(69, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(70, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(71, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(73, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(74, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(75, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(76, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(77, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(78, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(811, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(812, '195', 'flam', 'fares', '256845', 'flam@live.fr', '0000', 'image', 0, '2010-09-11'),
(813, '195', 'flam', 'fares', '256845', 'flam@live.fr', '0000', 'image', 0, '2010-09-11'),
(814, '5866', 'dafdouf', 'zakzouk', '5895', 'zak@live.fr', '0000', 'image', 0, '2011-10-01'),
(815, '195', 'nex', 'nex', '256845', 'nex@live.fr', 'aaaa', 'image', 0, '2010-09-11'),
(816, '195', 'nex', 'nex', '256845', 'nex@live.fr', 'aaaa', 'image', 0, '2010-09-11'),
(817, '195', 'nex', 'nex', '256845', 'nex@live.fr', 'aaaa', 'image', 0, '2010-09-11'),
(818, '9638850', 'flam', 'med', '98222555', 'faresnex@esprit.tn', 'flamnex', 'fares.jpg', 0, '2020-02-07'),
(819, '111112222', 'ben s3id', 'nexus', '92666777', '7anda3li@easy.tn', '2d1c78a165d1f3a5444caf4afe8e2d72', 'nex.png', 0, '1999-02-02'),
(820, '9638850', 'si med flamedin', 'medssssss', '98222555', 'faresnex@esprit.tn', '2bef74e451a79914b1fc65e56fac5164', 'nexxs.jpg', 0, '2020-02-07'),
(821, '99998888', 'fares', 'lam', '98305054', 'fares@esprit.com', '594f803b380a41396ed63dca39503542', 'fares.png', 0, '2022-02-22'),
(822, '999999', 'fzzffez', 'fzfzf', '4444444', 'aaaa@a.tn', '5d793fc5b00a2348c3fb9ab59e5ca98a', 'aaaa.jpg', 0, '2022-02-09'),
(823, '9993333', 'dafdafafa', 'fafafafafa', '90114475', 'fafafa@gmail.tn', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'dada.jpg', 0, '2006-03-09'),
(824, '12345678', 'aaa', 'bbbb', '5555555', 'aaaa@aaa.tn', '0b4e7a0e5fe84ad35fb5f95b9ceeac79', 'aaa.jpg', 0, '2001-02-03'),
(825, '12345879', 'azzazaz', 'zzzzzzzzzz', '98665541', 'fares@esprit.tn', '5d793fc5b00a2348c3fb9ab59e5ca98a', 'fares.png', 0, '2000-02-02'),
(826, '11223344', 'lamloum', 'fares', '98665580', 'fareslamloum@gmail.com', 'ab4f63f9ac65152575886860dde480a1', 'fares.png', 0, '2000-02-07'),
(827, '1236987', 'lamloum', 'fares', '98663217', 'flam@gmail.com', '54965f9cd7e81588669cbbb393950569', 'fares.jpg', 0, '2000-02-07'),
(828, '1230000', 'lamloum', 'fares', '98332140', 'fareslam@esprit.tn', '74b87337454200d4d33f80c4663dc5e5', 'fares.png', 0, '2000-07-08'),
(831, '199525', 'ssss', 'cxx', '2568435', 'fares.lamloum@esprit.tn', '550e1bafe077ff0b0b67f4e32f29d751', 'image', 0, '2011-10-01');

-- --------------------------------------------------------

--
-- Structure de la table `voiture`
--

CREATE TABLE `voiture` (
  `Idvoit` int(11) NOT NULL,
  `Matricule` varchar(50) NOT NULL,
  `Puissance_fiscalle` int(11) NOT NULL,
  `Image_v` varchar(255) NOT NULL,
  `Modele` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `voiture`
--

INSERT INTO `voiture` (`Idvoit`, `Matricule`, `Puissance_fiscalle`, `Image_v`, `Modele`) VALUES
(1, '120TU120', 12, 'image', 'Mercedes'),
(2, '120TU120', 12, 'image', 'Mercedes'),
(3, '220TU120', 12, 'image', 'bmw'),
(55, '220TU120', 12, 'image', 'Mercedes'),
(663, '220TU120', 12, 'image', 'bmw'),
(669, '220TU120', 12, 'image', 'bmw'),
(2000, '220TU120', 12, 'image', 'bmw'),
(2001, '220TU120', 12, 'image', 'bmw'),
(6390, '220TU120', 12, 'image', 'bmw'),
(6600, '220TU120', 12, 'image', 'bmw'),
(6690, '220TU120', 12, 'image', 'bmw'),
(6890, '220TU120', 12, 'image', 'bmw');

-- --------------------------------------------------------

--
-- Structure de la table `voyage`
--

CREATE TABLE `voyage` (
  `Idv` int(11) NOT NULL,
  `Pays` varchar(20) NOT NULL,
  `Image_pays` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`Idv`, `Pays`, `Image_pays`) VALUES
(18, 'espagne', 'c://espagne.png'),
(97, 'istanbul', 'c://antalya.png'),
(98, 'tounis', 'c://maroc.png'),
(99, 'tounis', 'c://maroc.png'),
(100, 'tounis', 'c://maroc.png'),
(169, 'espagne', 'c://espagne.png'),
(198, 'espagne', 'c://espagne.png'),
(199, 'espagne', 'c://espagne.png'),
(369, 'tounis', 'c://maroc.png'),
(399, 'tounis', 'c://berlin.png'),
(499, 'tounis', 'c://berlin.png'),
(501, 'tounis', 'c://berlin.png'),
(509, 'tounis', 'c://berlin.png'),
(599, 'tounis', 'c://berlin.png'),
(600, 'allemagne', 'c://berlin.png'),
(601, 'gafsa', 'c://beja.png'),
(602, 'gafsa', 'c://beja.png'),
(603, 'gafsa', 'c://beja.png'),
(604, 'gafsa', 'c://beja.png'),
(605, 'gafsa', 'c://beja.png'),
(606, 'gafsa', 'c://beja.png');

-- --------------------------------------------------------

--
-- Structure de la table `voyage_organise`
--

CREATE TABLE `voyage_organise` (
  `Idvo` int(11) NOT NULL,
  `Prix_billet` float NOT NULL,
  `Airline` varchar(20) NOT NULL,
  `Nb_nuitees` int(11) NOT NULL,
  `nbplaces` int(11) NOT NULL,
  `etatVoyage` enum('DISPO','INDISPO') NOT NULL,
  `Idv` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `voyage_organise`
--

INSERT INTO `voyage_organise` (`Idvo`, `Prix_billet`, `Airline`, `Nb_nuitees`, `nbplaces`, `etatVoyage`, `Idv`) VALUES
(78, 170.6, 'nex', 3, 0, 'DISPO', 18),
(79, 990.6, 'sounay', 3, 0, '', 369),
(80, 170.6, 'nex', 3, 0, '', 369),
(81, 10.6, 'flam', 3, 0, '', 369),
(82, 170.6, 'nex', 3, 0, '', 600),
(84, 170.6, 'nex', 3, 0, 'INDISPO', 605),
(85, 170.6, 'nexdd', 3, 0, 'DISPO', 97),
(86, 170.6, 'nexdd', 3, 0, 'INDISPO', 605),
(87, 170.6, 'nexdd', 3, 0, 'INDISPO', 605);

-- --------------------------------------------------------

--
-- Structure de la table `voyage_virtuel`
--

CREATE TABLE `voyage_virtuel` (
  `Idvv` int(11) NOT NULL,
  `Video` varchar(255) NOT NULL,
  `Image_v` varchar(255) NOT NULL,
  `Idv` int(11) NOT NULL,
  `Ida` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD PRIMARY KEY (`Ida`),
  ADD KEY `Ida` (`Ida`),
  ADD KEY `FK_pai` (`Ref_paiement`);

--
-- Index pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD PRIMARY KEY (`idc`),
  ADD KEY `idc` (`idc`),
  ADD KEY `idh` (`idh`);

--
-- Index pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  ADD PRIMARY KEY (`idch`),
  ADD KEY `idch` (`idch`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`Ide`);

--
-- Index pour la table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`Idh`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`Ref_paiement`);

--
-- Index pour la table `reservation_event`
--
ALTER TABLE `reservation_event`
  ADD PRIMARY KEY (`Idrev`),
  ADD KEY `Idrev` (`Idrev`),
  ADD KEY `Fk_eve` (`Ide`),
  ADD KEY `Fk_usr` (`Idu`);

--
-- Index pour la table `reservation_hotel`
--
ALTER TABLE `reservation_hotel`
  ADD PRIMARY KEY (`Idrh`),
  ADD KEY `Idrh` (`Idrh`),
  ADD KEY `FK_u` (`Idu`),
  ADD KEY `kk_h` (`idh`);

--
-- Index pour la table `reservation_voiture`
--
ALTER TABLE `reservation_voiture`
  ADD PRIMARY KEY (`Idrvoit`),
  ADD KEY `Idrvoit` (`Idrvoit`),
  ADD KEY `FK_resu` (`Idu`),
  ADD KEY `FK_resv` (`Idvoit`),
  ADD KEY `FK_CHAUFF` (`idch`);

--
-- Index pour la table `reservation_voyage`
--
ALTER TABLE `reservation_voyage`
  ADD PRIMARY KEY (`Idrv`),
  ADD KEY `FK_reusr` (`Idu`),
  ADD KEY `Idrv` (`Idrv`),
  ADD KEY `FKPAY` (`Ref_paiement`),
  ADD KEY `FK_resvoy` (`Idv`);

--
-- Index pour la table `sponsor`
--
ALTER TABLE `sponsor`
  ADD PRIMARY KEY (`ids`),
  ADD KEY `sponsor_ibfk_1` (`ide`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Idu`);

--
-- Index pour la table `voiture`
--
ALTER TABLE `voiture`
  ADD PRIMARY KEY (`Idvoit`),
  ADD KEY `Idvoit` (`Idvoit`);

--
-- Index pour la table `voyage`
--
ALTER TABLE `voyage`
  ADD PRIMARY KEY (`Idv`);

--
-- Index pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  ADD PRIMARY KEY (`Idvo`),
  ADD KEY `FK_vo` (`Idv`);

--
-- Index pour la table `voyage_virtuel`
--
ALTER TABLE `voyage_virtuel`
  ADD PRIMARY KEY (`Idvv`),
  ADD KEY `FK_abb` (`Ida`),
  ADD KEY `FK_vv` (`Idv`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonnement`
--
ALTER TABLE `abonnement`
  MODIFY `Ida` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `chambre`
--
ALTER TABLE `chambre`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT pour la table `chauffeur`
--
ALTER TABLE `chauffeur`
  MODIFY `idch` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=667;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `Ide` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `hotel`
--
ALTER TABLE `hotel`
  MODIFY `Idh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12241;

--
-- AUTO_INCREMENT pour la table `reservation_event`
--
ALTER TABLE `reservation_event`
  MODIFY `Idrev` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `reservation_hotel`
--
ALTER TABLE `reservation_hotel`
  MODIFY `Idrh` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT pour la table `reservation_voiture`
--
ALTER TABLE `reservation_voiture`
  MODIFY `Idrvoit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `reservation_voyage`
--
ALTER TABLE `reservation_voyage`
  MODIFY `Idrv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `sponsor`
--
ALTER TABLE `sponsor`
  MODIFY `ids` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `Idu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=832;

--
-- AUTO_INCREMENT pour la table `voiture`
--
ALTER TABLE `voiture`
  MODIFY `Idvoit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6891;

--
-- AUTO_INCREMENT pour la table `voyage`
--
ALTER TABLE `voyage`
  MODIFY `Idv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55556;

--
-- AUTO_INCREMENT pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  MODIFY `Idvo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT pour la table `voyage_virtuel`
--
ALTER TABLE `voyage_virtuel`
  MODIFY `Idvv` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `abonnement`
--
ALTER TABLE `abonnement`
  ADD CONSTRAINT `FK_pai` FOREIGN KEY (`Ref_paiement`) REFERENCES `paiement` (`Ref_paiement`);

--
-- Contraintes pour la table `chambre`
--
ALTER TABLE `chambre`
  ADD CONSTRAINT `fk_hot` FOREIGN KEY (`idh`) REFERENCES `hotel` (`Idh`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation_event`
--
ALTER TABLE `reservation_event`
  ADD CONSTRAINT `Fk_eve` FOREIGN KEY (`Ide`) REFERENCES `evenement` (`Ide`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_usr` FOREIGN KEY (`Idu`) REFERENCES `user` (`Idu`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation_hotel`
--
ALTER TABLE `reservation_hotel`
  ADD CONSTRAINT `FK_u` FOREIGN KEY (`Idu`) REFERENCES `user` (`Idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `kk_h` FOREIGN KEY (`idh`) REFERENCES `hotel` (`Idh`);

--
-- Contraintes pour la table `reservation_voiture`
--
ALTER TABLE `reservation_voiture`
  ADD CONSTRAINT `FK_CHAUFF` FOREIGN KEY (`idch`) REFERENCES `chauffeur` (`idch`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_resu` FOREIGN KEY (`Idu`) REFERENCES `user` (`Idu`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_resv` FOREIGN KEY (`Idvoit`) REFERENCES `voiture` (`Idvoit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `reservation_voyage`
--
ALTER TABLE `reservation_voyage`
  ADD CONSTRAINT `FK_resvoy` FOREIGN KEY (`Idv`) REFERENCES `voyage` (`Idv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `sponsor`
--
ALTER TABLE `sponsor`
  ADD CONSTRAINT `sponsor_ibfk_1` FOREIGN KEY (`ide`) REFERENCES `evenement` (`Ide`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  ADD CONSTRAINT `FK_vo` FOREIGN KEY (`Idv`) REFERENCES `voyage` (`Idv`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `voyage_virtuel`
--
ALTER TABLE `voyage_virtuel`
  ADD CONSTRAINT `FK_abb` FOREIGN KEY (`Ida`) REFERENCES `abonnement` (`Ida`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_vv` FOREIGN KEY (`Idv`) REFERENCES `voyage` (`Idv`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
