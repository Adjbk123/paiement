-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 08 mars 2026 à 00:58
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `paiements`
--

-- --------------------------------------------------------

--
-- Structure de la table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subtitle` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `tabs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`tabs`)),
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `circonscriptions`
--

CREATE TABLE `circonscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `circonscriptions`
--

INSERT INTO `circonscriptions` (`id`, `departement_id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 1, 'Banikoara 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(2, 1, 'Banikoara 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(3, 1, 'Gogounou', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(4, 1, 'Kandi 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(5, 1, 'Kandi 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(6, 1, 'Karimama', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(7, 1, 'Malanville', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(8, 1, 'Ségbana', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(9, 2, 'Boukoumbé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(10, 2, 'Cobly', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(11, 2, 'Kérou', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(12, 2, 'Kouandé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(13, 2, 'Matéri', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(14, 2, 'Natitingou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(15, 2, 'Natitingou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(16, 2, 'Péhunco', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(17, 2, 'Tanguiéta', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(18, 2, 'Toucountouna', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(19, 3, 'Abomey-Calavi 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(20, 3, 'Abomey-Calavi 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(21, 3, 'Abomey-Calavi 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(22, 3, 'Abomey-Calavi 4', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(23, 3, 'Abomey-Calavi 5', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(24, 3, 'Abomey-Calavi 6', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(25, 3, 'Allada 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(26, 3, 'Allada 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(27, 3, 'Kpomassè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(28, 3, 'Ouidah 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(29, 3, 'Ouidah 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(30, 3, 'Sô-Ava', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(31, 3, 'Toffo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(32, 3, 'Tori-Bossito', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(33, 3, 'Zè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(34, 4, 'Bembéréké 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(35, 4, 'Bembéréké 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(36, 4, 'Kalalé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(37, 4, 'N\'Dali', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(38, 4, 'Nikki', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(39, 4, 'Parakou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(40, 4, 'Parakou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(41, 4, 'Parakou 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(42, 4, 'Pèrèrè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(43, 4, 'Sinendé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(44, 4, 'Tchaourou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(45, 4, 'Tchaourou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(46, 4, 'Tchaourou 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(47, 5, 'Bantè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(48, 5, 'Dassa-Zoumè 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(49, 5, 'Dassa-Zoumè 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(50, 5, 'Glazoué 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(51, 5, 'Glazoué 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(52, 5, 'Ouèssè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(53, 5, 'Savalou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(54, 5, 'Savalou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(55, 5, 'Savè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(56, 6, 'Aplahoué 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(57, 6, 'Aplahoué 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(58, 6, 'Djakotomey 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(59, 6, 'Djakotomey 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(60, 6, 'Dogbo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(61, 6, 'Klouékanmè 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(62, 6, 'Klouékanmè 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(63, 6, 'Lalo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(64, 6, 'Toviklin', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(65, 7, 'Bassila 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(66, 7, 'Bassila 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(67, 7, 'Copargo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(68, 7, 'Djougou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(69, 7, 'Djougou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(70, 7, 'Djougou 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(71, 7, 'Ouaké', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(72, 8, 'Cotonou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(73, 8, 'Cotonou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(74, 8, 'Cotonou 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(75, 8, 'Cotonou 4', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(76, 8, 'Cotonou 5', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(77, 8, 'Cotonou 6', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(78, 9, 'Athiémé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(79, 9, 'Bopa', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(80, 9, 'Comé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(81, 9, 'Grand-Popo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(82, 9, 'Houéyogbé 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(83, 9, 'Houéyogbé 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(84, 9, 'Lokossa 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(85, 9, 'Lokossa 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(86, 10, 'Adjarra', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(87, 10, 'Adjohoun', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(88, 10, 'Aguégués', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(89, 10, 'Akpro-Missérété 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(90, 10, 'Akpro-Missérété 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(91, 10, 'Avrankou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(92, 10, 'Avrankou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(93, 10, 'Bonou', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(94, 10, 'Dangbo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(95, 10, 'Porto-Novo 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(96, 10, 'Porto-Novo 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(97, 10, 'Porto-Novo 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(98, 10, 'Sèmè-Kpodji 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(99, 10, 'Sèmè-Kpodji 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(100, 11, 'Adja-Ouèrè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(101, 11, 'Ifangni', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(102, 11, 'Kétou 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(103, 11, 'Kétou 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(104, 11, 'Pobè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(105, 11, 'Sakété', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(106, 12, 'Abomey', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(107, 12, 'Agbangnizoun', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(108, 12, 'Bohicon 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(109, 12, 'Bohicon 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(110, 12, 'Bohicon 3', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(111, 12, 'Covè', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(112, 12, 'Djidja 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(113, 12, 'Djidja 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(114, 12, 'Ouinhi', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(115, 12, 'Zagnanado', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(116, 12, 'Za-Kpota 1', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(117, 12, 'Za-Kpota 2', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(118, 12, 'Zogbodomey', '2026-03-04 07:50:51', '2026-03-04 07:50:51');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Alibori', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(2, 'Atacora', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(3, 'Atlantique', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(4, 'Borgou', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(5, 'Collines', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(6, 'Couffo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(7, 'Donga', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(8, 'Littoral', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(9, 'Mono', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(10, 'Ouémé', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(11, 'Plateau', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(12, 'Zou', '2026-03-04 07:50:51', '2026-03-04 07:50:51');

-- --------------------------------------------------------

--
-- Structure de la table `districts`
--

CREATE TABLE `districts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `districts`
--

INSERT INTO `districts` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Alibori', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(2, 'Atacora', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(3, 'Atlantique', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(4, 'Borgou', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(5, 'Collines', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(6, 'Couffo', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(7, 'Donga', '2026-03-04 07:50:51', '2026-03-04 07:50:51'),
(8, 'Littoral', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(9, 'Mono', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(10, 'Ouémé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(11, 'Plateau', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(12, 'Zou', '2026-03-04 07:50:52', '2026-03-04 07:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `enseignements`
--

CREATE TABLE `enseignements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `statut` enum('visible','invisible') NOT NULL DEFAULT 'visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enseignements`
--

INSERT INTO `enseignements` (`id`, `nom`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'Maternel', 'visible', '2026-03-04 07:50:50', '2026-03-04 07:50:50'),
(2, 'Primaire', 'visible', '2026-03-04 07:50:50', '2026-03-04 07:50:50'),
(3, 'Secondaire', 'visible', '2026-03-04 07:50:50', '2026-03-04 07:50:50'),
(4, 'Autre', 'visible', '2026-03-04 07:50:50', '2026-03-04 07:50:50');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formations`
--

CREATE TABLE `formations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `district_id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `formations`
--

INSERT INTO `formations` (`id`, `district_id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 1, 'Banikoara 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(2, 1, 'Banikoara 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(3, 1, 'Gogounou', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(4, 1, 'Kandi 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(5, 1, 'Kandi 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(6, 1, 'Karimama', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(7, 1, 'Malanville', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(8, 1, 'Ségbana', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(9, 2, 'Boukoumbé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(10, 2, 'Cobly', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(11, 2, 'Kérou', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(12, 2, 'Kouandé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(13, 2, 'Matéri', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(14, 2, 'Natitingou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(15, 2, 'Natitingou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(16, 2, 'Péhunco', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(17, 2, 'Tanguiéta', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(18, 2, 'Toucountouna', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(19, 3, 'Abomey-Calavi 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(20, 3, 'Abomey-Calavi 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(21, 3, 'Abomey-Calavi 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(22, 3, 'Abomey-Calavi 4', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(23, 3, 'Abomey-Calavi 5', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(24, 3, 'Abomey-Calavi 6', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(25, 3, 'Allada 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(26, 3, 'Allada 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(27, 3, 'Kpomassè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(28, 3, 'Ouidah 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(29, 3, 'Ouidah 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(30, 3, 'Sô-Ava', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(31, 3, 'Toffo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(32, 3, 'Tori-Bossito', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(33, 3, 'Zè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(34, 4, 'Bembéréké 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(35, 4, 'Bembéréké 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(36, 4, 'Kalalé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(37, 4, 'N\'Dali', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(38, 4, 'Nikki', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(39, 4, 'Parakou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(40, 4, 'Parakou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(41, 4, 'Parakou 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(42, 4, 'Pèrèrè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(43, 4, 'Sinendé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(44, 4, 'Tchaourou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(45, 4, 'Tchaourou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(46, 4, 'Tchaourou 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(47, 5, 'Bantè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(48, 5, 'Dassa-Zoumè 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(49, 5, 'Dassa-Zoumè 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(50, 5, 'Glazoué 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(51, 5, 'Glazoué 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(52, 5, 'Ouèssè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(53, 5, 'Savalou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(54, 5, 'Savalou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(55, 5, 'Savè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(56, 6, 'Aplahoué 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(57, 6, 'Aplahoué 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(58, 6, 'Djakotomey 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(59, 6, 'Djakotomey 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(60, 6, 'Dogbo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(61, 6, 'Klouékanmè 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(62, 6, 'Klouékanmè 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(63, 6, 'Lalo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(64, 6, 'Toviklin', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(65, 7, 'Bassila 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(66, 7, 'Bassila 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(67, 7, 'Copargo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(68, 7, 'Djougou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(69, 7, 'Djougou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(70, 7, 'Djougou 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(71, 7, 'Ouaké', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(72, 8, 'Cotonou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(73, 8, 'Cotonou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(74, 8, 'Cotonou 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(75, 8, 'Cotonou 4', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(76, 8, 'Cotonou 5', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(77, 8, 'Cotonou 6', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(78, 9, 'Athiémé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(79, 9, 'Bopa', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(80, 9, 'Comé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(81, 9, 'Grand-Popo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(82, 9, 'Houéyogbé 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(83, 9, 'Houéyogbé 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(84, 9, 'Lokossa 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(85, 9, 'Lokossa 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(86, 10, 'Adjarra', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(87, 10, 'Adjohoun', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(88, 10, 'Aguégués', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(89, 10, 'Akpro-Missérété 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(90, 10, 'Akpro-Missérété 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(91, 10, 'Avrankou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(92, 10, 'Avrankou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(93, 10, 'Bonou', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(94, 10, 'Dangbo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(95, 10, 'Porto-Novo 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(96, 10, 'Porto-Novo 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(97, 10, 'Porto-Novo 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(98, 10, 'Sèmè-Kpodji 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(99, 10, 'Sèmè-Kpodji 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(100, 11, 'Adja-Ouèrè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(101, 11, 'Ifangni', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(102, 11, 'Kétou 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(103, 11, 'Kétou 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(104, 11, 'Pobè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(105, 11, 'Sakété', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(106, 12, 'Abomey', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(107, 12, 'Agbangnizoun', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(108, 12, 'Bohicon 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(109, 12, 'Bohicon 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(110, 12, 'Bohicon 3', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(111, 12, 'Covè', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(112, 12, 'Djidja 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(113, 12, 'Djidja 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(114, 12, 'Ouinhi', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(115, 12, 'Zagnanado', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(116, 12, 'Za-Kpota 1', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(117, 12, 'Za-Kpota 2', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(118, 12, 'Zogbodomey', '2026-03-04 07:50:52', '2026-03-04 07:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `galeries`
--

CREATE TABLE `galeries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` longtext DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `type` enum('societe','publicite') NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `statut` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_02_20_082432_create_roles_table', 1),
(5, '2026_02_20_082853_create_permissions_table', 1),
(6, '2026_02_20_083302_create_user_role_table', 1),
(7, '2026_02_20_083744_create_user_permission_table', 1),
(8, '2026_02_20_103754_create_parametres_table', 1),
(9, '2026_02_20_110534_create_options_table', 1),
(10, '2026_02_22_132557_create_departements_table', 1),
(11, '2026_02_22_133245_create_circonscriptions_table', 1),
(12, '2026_02_22_152440_create_districts_table', 1),
(13, '2026_02_22_152656_create_formations_table', 1),
(14, '2026_02_24_130512_create_abouts_table', 1),
(15, '2026_02_24_143922_create_services_table', 1),
(16, '2026_02_25_080609_create_galeries_table', 1),
(17, '2026_02_25_161054_create_enseignements_table', 1),
(18, '2026_02_25_162215_create_provinces_table', 1),
(19, '2026_02_25_163017_create_regions_table', 1),
(20, '2026_02_25_164208_create_paiement_inscription_table', 1),
(21, '2026_02_27_175811_create_paiement_tranches_table', 1),
(23, '2026_03_04_111846_add_deleted_at_to_paiement_inscriptions_table', 2);

-- --------------------------------------------------------

--
-- Structure de la table `options`
--

CREATE TABLE `options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `option_montant` decimal(10,2) NOT NULL,
  `description` longtext DEFAULT NULL,
  `statut` enum('visible','invisible') NOT NULL DEFAULT 'visible',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `options`
--

INSERT INTO `options` (`id`, `nom`, `option_montant`, `description`, `statut`, `created_at`, `updated_at`) VALUES
(1, 'Formation en informatique', 32000.00, NULL, 'visible', '2026-03-04 09:26:22', '2026-03-04 09:26:22');

-- --------------------------------------------------------

--
-- Structure de la table `paiement_inscriptions`
--

CREATE TABLE `paiement_inscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenoms` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `option_id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED DEFAULT NULL,
  `circonscription_id` bigint(20) UNSIGNED DEFAULT NULL,
  `district_id` bigint(20) UNSIGNED DEFAULT NULL,
  `formation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `enseignement_id` bigint(20) UNSIGNED NOT NULL,
  `autre_enseignement` varchar(255) DEFAULT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `region_id` bigint(20) UNSIGNED DEFAULT NULL,
  `montant` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending' COMMENT 'pending, approved, failed',
  `recu_envoye` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Indique si le reçu a été envoyé par email',
  `reference` varchar(255) NOT NULL,
  `transaction_id` varchar(255) DEFAULT NULL,
  `payment_url` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `paiement_inscriptions`
--

INSERT INTO `paiement_inscriptions` (`id`, `nom`, `prenoms`, `email`, `phone`, `option_id`, `departement_id`, `circonscription_id`, `district_id`, `formation_id`, `enseignement_id`, `autre_enseignement`, `province_id`, `region_id`, `montant`, `status`, `recu_envoye`, `reference`, `transaction_id`, `payment_url`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'BONOU', 'HONTONNOU GERMAIN', 'germainbonou604@gmail.com', '0146834697', 1, 1, 1, 10, 92, 1, NULL, NULL, NULL, 100, 'pending', 0, 'pay_69a82338cadf0', '109830693', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTgzMDY5MywiZXhwIjoxNzcyNzEzMTUyfQ.hvBRrLHL5560_Zcxw3_YFGNlSDiGZuGFiOl7tGUcT3U', NULL, '2026-03-04 11:19:11', '2026-03-06 14:03:34', '2026-03-06 14:03:34'),
(2, 'BONOU', 'HONTONNOU GERMAIN', 'germainbonou604@gmail.com', '0165641543', 1, NULL, NULL, NULL, NULL, 3, NULL, 11, 64, 100, 'pending', 0, 'pay_69a824099193d', '109830767', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTgzMDc2NywiZXhwIjoxNzcyNzEzMzU4fQ.N2QEDfSsPyxEsEub8nsyMBE7e0IQ4VvrNylnR_FqQc8', NULL, '2026-03-04 11:22:36', '2026-03-06 14:04:30', '2026-03-06 14:04:30'),
(3, 'BONOU', 'Hontonnou Germain', 'germainbonou604@gmail.com', '0143211664', 1, NULL, NULL, NULL, NULL, 3, NULL, 11, 65, 100, 'paid', 0, 'pay_69a87a5b25681', '109836921', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTgzNjkyMSwiZXhwIjoxNzcyNzM1NDU1fQ.MfKF24_yu-YBLUFJtxkSXY3yDyzfUw9r0Giq2VZVUc4', NULL, '2026-03-04 17:30:53', '2026-03-06 14:01:32', '2026-03-06 14:01:32'),
(4, 'BONOU', 'Hontonnou Germain', 'germainbonou604@gmail.com', '0143211664', 1, 11, 101, 11, 105, 2, NULL, NULL, NULL, 100, 'approved', 0, 'pay_69a933201227d', '109842776', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTg0Mjc3NiwiZXhwIjoxNzcyNzgyNzU5fQ.pKwQEbyTK6vscyK8cg4yj4kSs80-4IjJlutPlwlTsJs', NULL, '2026-03-05 06:39:17', '2026-03-05 06:40:02', NULL),
(5, 'BONOU', 'HONTONNOU GERMAIN', 'germainbonou604@gmail.com', '0143211664', 1, NULL, NULL, NULL, NULL, 4, 'Etudiant', 11, 65, 100, 'approved', 0, 'pay_69a94bc0342fa', '109844285', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTg0NDI4NSwiZXhwIjoxNzcyNzg5MDYwfQ.pMQP8UZ5f5ns0E6CMvSFeoDR9g-lUFIbDLo_JFCf0Mg', NULL, '2026-03-05 08:24:18', '2026-03-05 08:24:51', NULL),
(6, 'BONOU', 'Hontonnou Germain', 'germainbonou604@gmail.com', '0143211664', 1, NULL, NULL, NULL, NULL, 3, NULL, 10, 63, 100, 'approved', 0, 'pay_69a9694ccdc33', '109846669', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTg0NjY2OSwiZXhwIjoxNzcyNzk2NjI2fQ._ErC_bqvbfHyi4fPm31P6KZbuXYwmjZXXrhyXKQeCIs', NULL, '2026-03-05 10:30:24', '2026-03-05 10:30:51', NULL),
(7, 'BONOU', 'Hontonnou Germain', 'germainbonou604@gmail.com', '0143211664', 1, 11, 102, 3, 33, 2, NULL, NULL, NULL, 100, 'approved', 0, 'pay_69aaeff2e3a0e', '109868343', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTg2ODM0MywiZXhwIjoxNzcyODk2NjMyfQ.x54h8yQSuEI_0n2k9LyUq2FkNfBdSPIgKJqDR-bX6c8', NULL, '2026-03-06 14:17:12', '2026-03-06 14:17:51', NULL),
(8, 'BONOU', 'Hontonnou Germain', 'germainbonou604@gmail.com', '0143211664', 1, 11, 100, 11, 103, 1, NULL, NULL, NULL, 100, 'approved', 0, 'pay_69ab0e1064889', '109870605', 'https://process.fedapay.com/eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjEwOTg3MDYwNSwiZXhwIjoxNzcyOTA0MzM4fQ.x588qQTuw_GEJGA6IE0oqf8gVRRwJkyJo0dNfl_I5Iw', NULL, '2026-03-06 16:25:38', '2026-03-06 16:26:07', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `paiement_tranches`
--

CREATE TABLE `paiement_tranches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `paiement_inscription_id` bigint(20) UNSIGNED NOT NULL,
  `montant_tranche` decimal(15,2) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `status` enum('pending','approved','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `parametres`
--

CREATE TABLE `parametres` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `website_name` varchar(255) DEFAULT NULL,
  `website_url` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `email1` varchar(255) DEFAULT NULL,
  `email2` varchar(255) DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `twitter` varchar(255) DEFAULT NULL,
  `whatsapp` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `parametres`
--

INSERT INTO `parametres` (`id`, `website_name`, `website_url`, `meta_description`, `address`, `phone1`, `phone2`, `email1`, `email2`, `facebook`, `twitter`, `whatsapp`, `youtube`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'MAFLYT', NULL, NULL, 'Akpro-misséréte/Dotogodo', '0146834697', NULL, 'mafly26@gmail.com', NULL, NULL, NULL, NULL, NULL, '1772697428_maflyt.jpg', '2026-03-05 06:57:08', '2026-03-05 16:25:27');

-- --------------------------------------------------------

--
-- Structure de la table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `provinces`
--

INSERT INTO `provinces` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Alibori', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(2, 'Atacora', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(3, 'Atlantique', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(4, 'Borgou', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(5, 'Collines', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(6, 'Couffo', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(7, 'Donga', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(8, 'Littoral', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(9, 'Mono', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(10, 'Ouémé', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(11, 'Plateau', '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(12, 'Zou', '2026-03-04 07:50:52', '2026-03-04 07:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

CREATE TABLE `regions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id`, `nom`, `province_id`, `created_at`, `updated_at`) VALUES
(1, 'Banikoara', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(2, 'Gogounou', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(3, 'Kandi', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(4, 'Karimama', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(5, 'Malanville', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(6, 'Ségbana', 1, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(7, 'Boukoumbé', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(8, 'Cobly', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(9, 'Kérou', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(10, 'Kouandé', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(11, 'Matéri', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(12, 'Natitingou', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(13, 'Péhunco', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(14, 'Tanguiéta', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(15, 'Toucountouna', 2, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(16, 'Abomey-Calavi', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(17, 'Allada', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(18, 'Kpomassè', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(19, 'Ouidah', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(20, 'Sô-Ava', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(21, 'Toffo', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(22, 'Tori-Bossito', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(23, 'Zè', 3, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(24, 'Bembéréké', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(25, 'Kalalé', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(26, 'N\'Dali', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(27, 'Nikki', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(28, 'Parakou', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(29, 'Pèrèrè', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(30, 'Sinendé', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(31, 'Tchaourou', 4, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(32, 'Bantè', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(33, 'Dassa-Zoumè', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(34, 'Glazoué', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(35, 'Ouèssè', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(36, 'Savalou', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(37, 'Savè', 5, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(38, 'Aplahoué', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(39, 'Djakotomey', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(40, 'Dogbo', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(41, 'Klouékanmè', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(42, 'Lalo', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(43, 'Toviklin', 6, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(44, 'Bassila', 7, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(45, 'Copargo', 7, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(46, 'Djougou', 7, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(47, 'Ouaké', 7, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(48, 'Cotonou', 8, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(49, 'Athiémé', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(50, 'Bopa', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(51, 'Comé', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(52, 'Grand-Popo', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(53, 'Houéyogbé', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(54, 'Lokossa', 9, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(55, 'Adjarra', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(56, 'Adjohoun', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(57, 'Aguégués', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(58, 'Akpro-Missérété', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(59, 'Avrankou', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(60, 'Bonou', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(61, 'Dangbo', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(62, 'Porto-Novo', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(63, 'Sèmè-Kpodji', 10, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(64, 'Adja-Ouèrè', 11, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(65, 'Ifangni', 11, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(66, 'Kétou', 11, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(67, 'Pobè', 11, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(68, 'Sakété', 11, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(69, 'Abomey', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(70, 'Agbangnizoun', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(71, 'Bohicon', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(72, 'Covè', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(73, 'Djidja', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(74, 'Ouinhi', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(75, 'Zagnanado', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(76, 'Za-Kpota', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52'),
(77, 'Zogbodomey', 12, '2026-03-04 07:50:52', '2026-03-04 07:50:52');

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nom` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'administrateur', NULL, NULL),
(2, 'employer', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `link` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('3nvYKkayKEYgIxTv5JVLoSId9PlpNsDVDlNnVMov', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiSW4xWUMyZjRrWk9BTGdCcTdpbGp2czN1NFBSU2RMM3pEU3R5eVVOciI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1772921834),
('BlFtdu9NvLBxVZK8qgue55xbLeIa9bISARhdc1Ab', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/145.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiMmdZcUo0bHVCMGlocVlwSWpIQmlzRk0zM1ZUeG1MNXdoTDhENzYwMSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3NzI5MjE4NTQ7fX0=', 1772922789);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'BONOU Hontonnou Germain', 'germainbonou604@gmail.com', NULL, '$2y$12$YEoAmMAFydzt2SgTuL12AutOiRc.ujAn1d./5JOwJNoSuQVlSA4DW', NULL, '2026-03-04 08:35:31', '2026-03-04 08:35:31');

-- --------------------------------------------------------

--
-- Structure de la table `user_permission`
--

CREATE TABLE `user_permission` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user_role`
--

CREATE TABLE `user_role` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(1, 2);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Index pour la table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Index pour la table `circonscriptions`
--
ALTER TABLE `circonscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `circonscriptions_departement_id_foreign` (`departement_id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departements_nom_unique` (`nom`);

--
-- Index pour la table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `districts_nom_unique` (`nom`);

--
-- Index pour la table `enseignements`
--
ALTER TABLE `enseignements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `enseignements_nom_unique` (`nom`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `formations`
--
ALTER TABLE `formations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formations_district_id_foreign` (`district_id`);

--
-- Index pour la table `galeries`
--
ALTER TABLE `galeries`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Index pour la table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `options_nom_unique` (`nom`);

--
-- Index pour la table `paiement_inscriptions`
--
ALTER TABLE `paiement_inscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paiement_inscriptions_reference_unique` (`reference`),
  ADD KEY `paiement_inscriptions_option_id_foreign` (`option_id`),
  ADD KEY `paiement_inscriptions_departement_id_foreign` (`departement_id`),
  ADD KEY `paiement_inscriptions_circonscription_id_foreign` (`circonscription_id`),
  ADD KEY `paiement_inscriptions_district_id_foreign` (`district_id`),
  ADD KEY `paiement_inscriptions_formation_id_foreign` (`formation_id`),
  ADD KEY `paiement_inscriptions_enseignement_id_foreign` (`enseignement_id`),
  ADD KEY `paiement_inscriptions_province_id_foreign` (`province_id`),
  ADD KEY `paiement_inscriptions_region_id_foreign` (`region_id`);

--
-- Index pour la table `paiement_tranches`
--
ALTER TABLE `paiement_tranches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `paiement_tranches_transaction_id_unique` (`transaction_id`),
  ADD KEY `paiement_tranches_paiement_inscription_id_foreign` (`paiement_inscription_id`);

--
-- Index pour la table `parametres`
--
ALTER TABLE `parametres`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Index pour la table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `provinces_nom_unique` (`nom`);

--
-- Index pour la table `regions`
--
ALTER TABLE `regions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `regions_nom_unique` (`nom`),
  ADD KEY `regions_province_id_foreign` (`province_id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `user_permission`
--
ALTER TABLE `user_permission`
  ADD KEY `user_permission_user_id_foreign` (`user_id`),
  ADD KEY `user_permission_permission_id_foreign` (`permission_id`);

--
-- Index pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `circonscriptions`
--
ALTER TABLE `circonscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `districts`
--
ALTER TABLE `districts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `enseignements`
--
ALTER TABLE `enseignements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `formations`
--
ALTER TABLE `formations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT pour la table `galeries`
--
ALTER TABLE `galeries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pour la table `options`
--
ALTER TABLE `options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `paiement_inscriptions`
--
ALTER TABLE `paiement_inscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `paiement_tranches`
--
ALTER TABLE `paiement_tranches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `parametres`
--
ALTER TABLE `parametres`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `regions`
--
ALTER TABLE `regions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `circonscriptions`
--
ALTER TABLE `circonscriptions`
  ADD CONSTRAINT `circonscriptions_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `formations`
--
ALTER TABLE `formations`
  ADD CONSTRAINT `formations_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `paiement_inscriptions`
--
ALTER TABLE `paiement_inscriptions`
  ADD CONSTRAINT `paiement_inscriptions_circonscription_id_foreign` FOREIGN KEY (`circonscription_id`) REFERENCES `circonscriptions` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paiement_inscriptions_departement_id_foreign` FOREIGN KEY (`departement_id`) REFERENCES `departements` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paiement_inscriptions_district_id_foreign` FOREIGN KEY (`district_id`) REFERENCES `districts` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paiement_inscriptions_enseignement_id_foreign` FOREIGN KEY (`enseignement_id`) REFERENCES `enseignements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiement_inscriptions_formation_id_foreign` FOREIGN KEY (`formation_id`) REFERENCES `formations` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paiement_inscriptions_option_id_foreign` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `paiement_inscriptions_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `paiement_inscriptions_region_id_foreign` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `paiement_tranches`
--
ALTER TABLE `paiement_tranches`
  ADD CONSTRAINT `paiement_tranches_paiement_inscription_id_foreign` FOREIGN KEY (`paiement_inscription_id`) REFERENCES `paiement_inscriptions` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `regions`
--
ALTER TABLE `regions`
  ADD CONSTRAINT `regions_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_permission`
--
ALTER TABLE `user_permission`
  ADD CONSTRAINT `user_permission_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_permission_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
