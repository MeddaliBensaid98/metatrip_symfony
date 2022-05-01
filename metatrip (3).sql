-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 01 mai 2022 à 21:27
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
-- Structure de la table `localisationvoyage`
--

CREATE TABLE `localisationvoyage` (
  `idl` int(11) NOT NULL,
  `longitude` float NOT NULL,
  `latitude` float NOT NULL,
  `Idv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `localisationvoyage`
--

INSERT INTO `localisationvoyage` (`idl`, `longitude`, `latitude`, `Idv`) VALUES
(201, 10.4515, 51.1657, 605),
(202, 8.77566, 34.4311, 603),
(203, 18.7682, 23.7842, 509),
(204, -3.74922, 40.4637, 55559),
(205, 4.54352, 35.7956, 600),
(209, 8.67917, 48.2646, 600),
(210, 24.7284, 46.0411, 55560),
(211, 43.8652, 23.5757, 600),
(212, 43.8652, 23.5757, 600);

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
(12, '2022-04-03', '2022-04-20', 'PAYE', 813, 600, 0),
(18, '2022-04-05', '2022-04-21', 'PAYE', 813, 603, 0),
(19, '2022-04-05', '2022-04-21', 'PAYE', 813, 369, 0),
(20, '2022-04-05', '2022-04-21', 'PAYE', 69, 369, 0),
(21, '2022-04-05', '2022-04-29', 'NON PAYE', 813, 509, 0),
(22, '2022-04-30', '2022-05-01', 'NON PAYE', 813, 600, 0),
(23, '2022-04-17', '2022-05-01', 'NON PAYE', 813, 600, 0),
(24, '2022-04-17', '2022-05-01', 'NON PAYE', 812, 100, 0),
(25, '2022-04-17', '2022-05-01', 'NON PAYE', 814, 600, 0),
(28, '2022-04-23', '2022-04-27', 'NON PAYE', 813, 369, 0),
(29, '2022-04-22', '2022-04-27', 'NON PAYE', 813, 369, 0),
(30, '2022-04-15', '2022-04-20', 'NON PAYE', 813, 369, 0),
(31, '2022-04-30', '2022-05-08', 'NON PAYE', 813, 369, 0),
(32, '2022-04-30', '2022-05-08', 'NON PAYE', 813, 369, 0);

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
  `Password` varchar(1000) NOT NULL,
  `Image` varchar(40) NOT NULL,
  `Role` int(11) DEFAULT 0,
  `dateNaissance` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Idu`, `Cin`, `Nom`, `Prenom`, `Tel`, `Email`, `Password`, `Image`, `Role`, `dateNaissance`) VALUES
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
(76, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(77, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(78, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(811, '199525', 'ssss', 'cxx', '2568435', 'nex@live.fr', '25d55ad283aa400af464c76d713c07ad', 'image', 0, '2011-10-01'),
(812, '195', 'flam', 'fares', '256845', 'flam@live.fr', '0000', 'image', 0, '2010-09-11'),
(813, '195', 'flam', 'fares', '256845', 'fares.lamloum@esprit.tn', '0000', 'image', 0, '2010-09-11'),
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
  `Image_pays` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `voyage`
--

INSERT INTO `voyage` (`Idv`, `Pays`, `Image_pays`) VALUES
(100, 'la tunisie', 'espagne.jpg'),
(369, 'tounis', 'espagne.jpg'),
(499, 'tounis', 'espagne.jpg'),
(501, 'tounis', 'espagne.jpg'),
(509, 'tounisf', 'espagne.jpg'),
(599, 'tounis', 'espagne.jpg'),
(600, 'allemagne', 'espagne.jpg'),
(601, 'gafsa', 'espagne.jpg'),
(602, 'gafsa', 'espagne.jpg'),
(603, 'gafsaa', '6258036517cc7619143110.jpg'),
(604, 'gafsa', 'espagne.jpg'),
(605, 'gafsa', 'espagne.jpg'),
(55556, 'ozbakesten', '62577cee0d7c2903928220.jpg'),
(55559, 'espagne', '6257ae1513416552009763.jpg'),
(55560, 'romania', 'gafsa.jpg');

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
(80, 170.6, 'nexusd', 0, 10, 'INDISPO', 55559),
(82, 170.6, 'nex', 5, 4, 'DISPO', 603),
(84, 170.6, 'nex', 3, 0, 'INDISPO', 605),
(86, 170.6, 'nexdd', 3, 0, 'DISPO', 603),
(88, 999, 'turkish', 0, 8, 'DISPO', 369),
(89, 980, 'Turkish air', 0, 8, 'INDISPO', 100),
(91, 980, 'Turkish air', 0, 8, 'INDISPO', 100),
(92, 980, 'Turkish air', 0, 8, 'INDISPO', 600),
(93, 980, 'TunisAir', 0, 18, 'INDISPO', 369),
(98, 980, 'TunisAir', 0, 18, 'INDISPO', 509),
(99, 980, 'TunisAir', 0, 18, 'INDISPO', 603),
(100, 980, 'TunisAir', 0, 18, 'INDISPO', 603),
(120, 1980, 'TunisAir', 0, 20, 'INDISPO', 369),
(128, 1980, 'TunisAir', 0, 20, 'INDISPO', 509),
(132, 12000, 'maroc air', 0, 30, 'DISPO', 55560),
(134, 2350, 'Lufthansa', 0, 96, 'DISPO', 600),
(135, 17777, 'romania air', 0, 23, 'INDISPO', 55560),
(136, 2850, 'ksa airline', 0, 30, 'DISPO', 600),
(137, 2850, 'ksa airline', 0, 30, 'DISPO', 600),
(138, 1980, 'TunisAir', 0, 20, 'INDISPO', 509);

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
-- Index pour la table `localisationvoyage`
--
ALTER TABLE `localisationvoyage`
  ADD PRIMARY KEY (`idl`),
  ADD KEY `FK_Voyage` (`Idv`);

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
  ADD KEY `Idrv` (`Idrv`),
  ADD KEY `FKPAY` (`Ref_paiement`),
  ADD KEY `FK_resvoy` (`Idv`),
  ADD KEY `FKUSER` (`Idu`);

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
-- AUTO_INCREMENT pour la table `localisationvoyage`
--
ALTER TABLE `localisationvoyage`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

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
  MODIFY `Idrv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

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
  MODIFY `Idv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55562;

--
-- AUTO_INCREMENT pour la table `voyage_organise`
--
ALTER TABLE `voyage_organise`
  MODIFY `Idvo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

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
-- Contraintes pour la table `localisationvoyage`
--
ALTER TABLE `localisationvoyage`
  ADD CONSTRAINT `FK_Voyage` FOREIGN KEY (`Idv`) REFERENCES `voyage` (`Idv`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `FKUSER` FOREIGN KEY (`Idu`) REFERENCES `user` (`Idu`) ON DELETE CASCADE ON UPDATE CASCADE,
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
