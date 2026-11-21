-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : sam. 09 mai 2026 à 23:28
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
-- Base de données : `ista_attestations`
--

-- --------------------------------------------------------

--
-- Structure de la table `attestations`
--

CREATE TABLE `attestations` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `validated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `attestations`
--

INSERT INTO `attestations` (`id`, `student_id`, `agent_id`, `created_at`, `updated_at`, `validated_at`) VALUES
(1, 1, 1, '2026-05-03 15:38:17', '2026-05-06 15:40:57', NULL),
(2, 2, 1, '2026-05-07 18:12:17', '2026-05-07 18:12:17', '2026-05-07 19:12:17'),
(3, 4, 1, '2026-05-07 18:12:27', '2026-05-07 18:24:18', '2026-05-07 19:24:18'),
(4, 3, 1, '2026-05-07 18:15:45', '2026-05-07 18:24:04', '2026-05-07 19:24:04');

-- --------------------------------------------------------

--
-- Structure de la table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `code_student` varchar(50) NOT NULL,
  `cin` varchar(50) NOT NULL,
  `filiere` varchar(150) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `students`
--

INSERT INTO `students` (`id`, `firstname`, `lastname`, `date_of_birth`, `code_student`, `cin`, `filiere`, `user_id`) VALUES
(1, 'ferhat', 'hajar', '2000-11-16', 'H445556668', 'F484556', 'Développement Digital', 2),
(2, 'Benali', 'Amina	', '2004-06-16', 'H445500187', 'F123456	', 'Développement Digital', 3),
(3, 'El Amrani	', 'Youssef	', '2006-01-13', 'H445500222', 'F654321', 'Infrastructure Digitale', 4),
(4, 'Tazi', 'Karim', '2002-09-21', 'H445500499', 'F998877	', 'Gestion des Entreprises', 5);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`) VALUES
(1, 'agent', 'agent@ofppt.ma', '$2y$10$ejUSRFr0eDSE.xB12n5cNuMUJXQUwjlQptpnGS5LIw3QrODGJjE3C', 'agent'),
(2, 'etudiant1', 'etudiant1@ofppt.ma', '$2y$10$J20PtkFb3bnWhVjVq0lIcOEAQ8e/mE/p5wb4GPvNL8Wid6sxMXuzG', 'etudiant'),
(3, 'etudiant2', 'etudiant2@ofppt.ma', '$2y$10$PN6r/g53t7tSH8FeOaS4peaLfNv85MzgfUmo/9Ut02AM1rTdJGJ8W', 'etudiant'),
(4, 'etudiant3', 'etudiant3@ofppt.ma', '$2y$10$K5nF4SCIIsnDXpMZjtTdGOI/Q39J8PPFPgGqpHsGOAPvWx00sJ4tK', 'etudiant'),
(5, 'etudiant4', 'etudiant4@ofppt.ma', '$2y$10$cNI3sQG5nnuWzGW6vo4xk.a1cPd1jxB06cEAJIyUo5lijKa6x8zgy', 'etudiant'),
(7, 'agent', 'agent2@ofppt.ma', '$2y$10$qphAI.rdOm8VzmmwYp9udOs5K7jHcL6vFIeKYfNb/Jo0zaYg3IB2S', 'agent'),
(8, 'agent', 'agent3@ofppt.ma', '$2y$10$3dTb0iKuley6qcHBrBAlouSGi8YRjd7MzOISeKnRZOhjY32iCrKJ.', 'agent');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `attestations`
--
ALTER TABLE `attestations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `agent_id` (`agent_id`);

--
-- Index pour la table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code_student` (`code_student`),
  ADD UNIQUE KEY `cin` (`cin`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `attestations`
--
ALTER TABLE `attestations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `attestations`
--
ALTER TABLE `attestations`
  ADD CONSTRAINT `attestations_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attestations_ibfk_2` FOREIGN KEY (`agent_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
