-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 04 juin 2025 à 15:22
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quiz`
--
CREATE DATABASE IF NOT EXISTS `quiz` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci;
USE `quiz`;

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cycle` int NOT NULL,
  `id_specialite` int NOT NULL,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_classe_cycle` (`id_cycle`),
  KEY `fk_classe_filiere` (`id_specialite`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `id_cycle`, `id_specialite`, `intitule`) VALUES
(1, 1, 1, 'GL2'),
(2, 1, 2, 'IWD3'),
(3, 1, 1, 'GL3'),
(4, 1, 3, 'CGE2');

-- --------------------------------------------------------

--
-- Structure de la table `classe_matiere`
--

DROP TABLE IF EXISTS `classe_matiere`;
CREATE TABLE IF NOT EXISTS `classe_matiere` (
  `id_classe` int NOT NULL,
  `id_matiere` bigint NOT NULL,
  PRIMARY KEY (`id_classe`,`id_matiere`),
  KEY `fk_contenir_matiere` (`id_matiere`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `classe_matiere`
--

INSERT INTO `classe_matiere` (`id_classe`, `id_matiere`) VALUES
(1, 1),
(1, 2),
(1, 4),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3),
(3, 4),
(4, 1),
(4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`id`, `intitule`) VALUES
(1, 'Licence'),
(2, 'Masteur');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_matiere`
--

DROP TABLE IF EXISTS `enseignant_matiere`;
CREATE TABLE IF NOT EXISTS `enseignant_matiere` (
  `email_enseignant` varchar(255) NOT NULL,
  `id_matiere` bigint NOT NULL,
  KEY `enseignant_matiere_ibfk_1` (`email_enseignant`(250)),
  KEY `enseignant_matiere_ibfk_2` (`id_matiere`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `enseignant_matiere`
--

INSERT INTO `enseignant_matiere` (`email_enseignant`, `id_matiere`) VALUES
('admin@mail.com', 1),
('admin@mail.com', 2),
('admin@mail.com', 3),
('admin@mail.com', 4),
('admin@mail.com', 6),
('wabo@gmail.com', 2),
('fowa@gmail.com', 2),
('fowa@gmail.com', 3),
('fowa@gmail.com', 4),
('talla@gmail.com', 5),
('talla@gmail.com', 2),
('talla@gmail.com', 1),
('admin@mail.com', 7);

-- --------------------------------------------------------

--
-- Structure de la table `filiere`
--

DROP TABLE IF EXISTS `filiere`;
CREATE TABLE IF NOT EXISTS `filiere` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `description`) VALUES
(1, 'Génie Logiciel', ''),
(2, 'Infographie et Web Design', ''),
(3, 'Comptabilité et Gestion des Entreprises', 'Comptabilite');

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

DROP TABLE IF EXISTS `matiere`;
CREATE TABLE IF NOT EXISTS `matiere` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `description`) VALUES
(1, 'Français', ''),
(2, 'Traitement de données multimédia', ''),
(3, 'Algorithme et complexité', ''),
(4, 'Base de Données', ''),
(5, 'Finance d&#039;entreprise', '');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint NOT NULL,
  `intitule` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proposition_1` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proposition_2` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proposition_3` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `proposition_4` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `reponse` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_question_matiere` (`id_matiere`)
) ENGINE=MyISAM AUTO_INCREMENT=355 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_matiere`, `intitule`, `proposition_1`, `proposition_2`, `proposition_3`, `proposition_4`, `reponse`) VALUES
(1, 3, 'Quelle est la complexité temporelle de la recherche linéaire dans un tableau non trié ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(2, 3, 'Quel algorithme de tri a une complexité moyenne de O(n log n) ?', 'Tri à bulles', 'Tri par fusion', 'Tri par insertion', 'Tri par sélection', 2),
(3, 3, 'Quelle structure de données utilise le principe LIFO (Last In, First Out) ?', 'File', 'Pile', 'Arbre', 'Graphe', 2),
(4, 3, 'Quelle est la complexité spatiale de l\'algorithme de tri rapide (quicksort) dans le pire cas ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(5, 3, 'Dans un arbre binaire de recherche équilibré, quelle est la complexité de la recherche d\'un élément ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n log n)', 2),
(6, 3, 'Quel est le principe de l\'algorithme de recherche dichotomique ?', 'Diviser pour régner', 'Programmation dynamique', 'Algorithme glouton', 'Force brute', 1),
(7, 3, 'Quelle notation est utilisée pour décrire la borne supérieure de la complexité d\'un algorithme ?', 'Notation Theta (Θ)', 'Notation Omega (Ω)', 'Notation Big O (O)', 'Notation Little o (o)', 3),
(8, 3, 'Combien d\'éléments peut-on trier avec le tri par comptage en temps O(n) ?', 'Tous types d\'éléments', 'Seulement les entiers dans une plage limitée', 'Seulement les nombres réels', 'Seulement les chaînes de caractères', 2),
(9, 3, 'Quelle est la complexité temporelle de l\'insertion d\'un élément dans une table de hachage bien dimensionnée ?', 'O(1) en moyenne', 'O(log n)', 'O(n)', 'O(n²)', 1),
(10, 3, 'Dans quel cas la complexité du tri rapide (quicksort) devient-elle O(n²) ?', 'Tableau déjà trié', 'Tableau de taille impaire', 'Tableau contenant des doublons', 'Tableau de nombres négatifs', 1),
(11, 3, 'Quelle structure de données permet l\'accès en O(1) à un élément par son index ?', 'Liste chaînée', 'Tableau', 'Arbre binaire', 'Graphe', 2),
(12, 3, 'Quel algorithme utilise la technique de programmation dynamique ?', 'Tri par fusion', 'Recherche dichotomique', 'Calcul de la suite de Fibonacci optimisé', 'Parcours en largeur', 3),
(13, 3, 'Quelle est la complexité spatiale d\'un algorithme récursif calculant la factorielle ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(14, 3, 'Dans un graphe, quel algorithme permet de trouver le chemin le plus court entre deux sommets ?', 'Parcours en profondeur (DFS)', 'Parcours en largeur (BFS)', 'Algorithme de Dijkstra', 'Tri topologique', 3),
(15, 3, 'Quelle est la complexité temporelle de l\'ajout d\'un élément à la fin d\'un tableau dynamique (comme ArrayList en Java) ?', 'O(1) amorti', 'O(log n)', 'O(n)', 'O(n log n)', 1),
(16, 3, 'Quel type d\'algorithme est caractérisé par le fait qu\'il fait toujours le choix localement optimal ?', 'Algorithme de force brute', 'Algorithme glouton', 'Algorithme de programmation dynamique', 'Algorithme de diviser pour régner', 2),
(17, 3, 'Combien de comparaisons sont nécessaires dans le pire cas pour trier n éléments avec le tri par fusion ?', 'O(n)', 'O(n log n)', 'O(n²)', 'O(2^n)', 2),
(18, 3, 'Quelle est la complexité temporelle de la suppression d\'un élément au milieu d\'un tableau ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(19, 3, 'Dans une file de priorité implémentée avec un tas binaire, quelle est la complexité de l\'extraction du minimum ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n log n)', 2),
(20, 3, 'Quel algorithme de tri est le plus efficace pour de petits tableaux (moins de 10 éléments) ?', 'Tri rapide', 'Tri par fusion', 'Tri par insertion', 'Tri par tas', 3),
(21, 3, 'Quelle est la différence principale entre BFS et DFS dans le parcours d\'un graphe ?', 'BFS utilise une pile, DFS une file', 'BFS utilise une file, DFS une pile', 'BFS est plus rapide que DFS', 'Il n\'y a pas de différence', 2),
(22, 3, 'Quelle est la complexité temporelle de la recherche d\'un élément dans un arbre binaire de recherche déséquilibré dans le pire cas ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(23, 3, 'Quel algorithme permet de détecter un cycle dans un graphe orienté ?', 'Algorithme de Dijkstra', 'Parcours en profondeur (DFS)', 'Tri par fusion', 'Recherche dichotomique', 2),
(24, 3, 'Quelle est la complexité spatiale du tri par fusion ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(25, 3, 'Dans le contexte des algorithmes, que signifie \'in-place\' ?', 'L\'algorithme s\'exécute en temps constant', 'L\'algorithme utilise un espace supplémentaire constant', 'L\'algorithme ne modifie pas les données originales', 'L\'algorithme est récursif', 2),
(26, 3, 'Quelle structure de données est la plus appropriée pour implémenter une fonction d\'annulation (undo) ?', 'File', 'Pile', 'Arbre', 'Table de hachage', 2),
(27, 3, 'Quelle est la complexité temporelle de l\'algorithme de recherche dans un arbre AVL ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n log n)', 2),
(28, 3, 'Quel algorithme de tri a la meilleure complexité temporelle dans le cas moyen ?', 'Tri à bulles', 'Tri par sélection', 'Tri par insertion', 'Tri rapide', 4),
(29, 3, 'Dans une liste chaînée simple, quelle est la complexité de l\'insertion d\'un élément au début ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 1),
(30, 3, 'Quel est l\'avantage principal de l\'algorithme de tri par comptage ?', 'Il fonctionne avec tous types de données', 'Il a une complexité O(n) pour certains types de données', 'Il trie en place', 'Il est récursif', 2),
(31, 3, 'Quelle technique permet d\'optimiser les appels récursifs répétitifs ?', 'Diviser pour régner', 'Mémoïsation', 'Algorithme glouton', 'Force brute', 2),
(32, 3, 'Dans un graphe pondéré, quel algorithme trouve l\'arbre couvrant de poids minimum ?', 'Algorithme de Dijkstra', 'Algorithme de Kruskal', 'Parcours en largeur', 'Tri topologique', 2),
(33, 3, 'Quelle est la complexité temporelle de l\'opération de peek (consultation sans suppression) dans une pile ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 1),
(34, 3, 'Quel algorithme est utilisé pour trier des chaînes de caractères de manière efficace ?', 'Tri lexicographique', 'Tri radix', 'Tri par comptage', 'Tri par insertion', 2),
(35, 3, 'Dans le contexte de la complexité algorithmique, que représente la notation Ω (Omega) ?', 'Borne supérieure', 'Borne inférieure', 'Complexité exacte', 'Complexité moyenne', 2),
(36, 3, 'Quelle est la complexité spatiale de l\'algorithme de tri par tas (heapsort) ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n log n)', 1),
(37, 3, 'Quel type de problème peut être résolu efficacement avec un algorithme glouton ?', 'Problème du sac à dos 0/1', 'Problème du rendu de monnaie avec pièces canoniques', 'Problème du voyageur de commerce', 'Problème de satisfaction de contraintes', 2),
(38, 3, 'Dans un tableau trié, combien de comparaisons sont nécessaires au maximum pour trouver un élément avec la recherche dichotomique ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 2),
(39, 3, 'Quelle est la complexité temporelle de l\'algorithme de tri par insertion dans le meilleur cas ?', 'O(1)', 'O(log n)', 'O(n)', 'O(n²)', 3),
(40, 3, 'Quel algorithme permet de trouver la plus courte distance entre tous les couples de sommets dans un graphe ?', 'Algorithme de Dijkstra', 'Algorithme de Floyd-Warshall', 'Parcours en largeur', 'Algorithme de Kruskal', 2),
(41, 1, 'Quel est le féminin du mot \'acteur\' ?', 'Actrice', 'Acteuse', 'Acteure', 'Activiste', 1),
(42, 1, 'Comment s\'accorde le participe passé avec l\'auxiliaire être ?', 'Avec le sujet', 'Avec le complément d\'objet direct', 'Il reste invariable', 'Avec le complément d\'objet indirect', 1),
(43, 1, 'Quelle est la fonction du mot souligné dans la phrase : \'Le chat mange sa pâtée\' ?', 'Sujet', 'Complément d\'objet direct', 'Complément d\'objet indirect', 'Attribut du sujet', 1),
(44, 1, 'Quel est le pluriel du mot \'bijou\' ?', 'Bijous', 'Bijoux', 'Bijoues', 'Bijouds', 2),
(45, 1, 'Dans quelle proposition trouve-t-on une métaphore ?', 'Il pleut des cordes', 'Ses yeux sont des étoiles', 'Il court comme un lièvre', 'Le vent souffle fort', 2),
(46, 1, 'Quel temps exprime une action qui se déroulait habituellement dans le passé ?', 'Passé composé', 'Passé simple', 'Imparfait', 'Plus-que-parfait', 3),
(47, 1, 'Quelle est la nature du mot \'très\' dans la phrase \'Il est très grand\' ?', 'Adjectif', 'Adverbe', 'Préposition', 'Conjonction', 2),
(48, 1, 'Comment s\'écrit correctement cette phrase ?', 'Quelle belle journée !', 'Quel belle journée !', 'Quelles belle journée !', 'Quels belle journée !', 1),
(49, 1, 'Quel est le contraire du mot \'généreux\' ?', 'Avare', 'Méchant', 'Triste', 'Pauvre', 1),
(50, 1, 'Dans quelle proposition le verbe est-il conjugué au subjonctif présent ?', 'Il faut que tu viennes', 'Tu viens souvent', 'Tu venais hier', 'Tu viendras demain', 1),
(51, 1, 'Quelle figure de style consiste à exagérer volontairement ?', 'Métaphore', 'Comparaison', 'Hyperbole', 'Personnification', 3),
(52, 1, 'Quel est le groupe du verbe \'finir\' ?', '1er groupe', '2ème groupe', '3ème groupe', 'Auxiliaire', 2),
(53, 1, 'Comment s\'appelle le narrateur qui connaît tout de l\'histoire ?', 'Narrateur interne', 'Narrateur externe', 'Narrateur omniscient', 'Narrateur témoin', 3),
(54, 1, 'Quelle est la fonction de la proposition soulignée : \'Je pense qu\'il viendra\' ?', 'Proposition principale', 'Proposition subordonnée complétive', 'Proposition subordonnée relative', 'Proposition subordonnée circonstancielle', 2),
(55, 1, 'Quel mot de liaison exprime l\'opposition ?', 'Donc', 'Cependant', 'Ainsi', 'Ensuite', 2),
(56, 1, 'Dans quel registre de langue trouve-t-on l\'expression \'J\'ai la dalle\' ?', 'Soutenu', 'Courant', 'Familier', 'Technique', 3),
(57, 1, 'Quelle est la voix du verbe dans \'La maison est construite par l\'ouvrier\' ?', 'Voix active', 'Voix passive', 'Voix pronominale', 'Voix impersonnelle', 2),
(58, 1, 'Quel est le féminin du mot \'héros\' ?', 'Hérose', 'Hérosse', 'Héroïne', 'Héroïsse', 3),
(59, 1, 'Dans quelle phrase le participe passé s\'accorde-t-il ?', 'Elle s\'est lavée', 'Elle s\'est lavé les mains', 'Elle a mangé', 'Elle est venue', 4),
(60, 1, 'Qu\'est-ce qu\'un alexandrin ?', 'Un vers de 8 syllabes', 'Un vers de 10 syllabes', 'Un vers de 12 syllabes', 'Un vers de 14 syllabes', 3),
(61, 1, 'Quel est le synonyme du mot \'irascible\' ?', 'Calme', 'Colérique', 'Triste', 'Joyeux', 2),
(62, 1, 'Dans quelle phrase y a-t-il une ellipse ?', 'Pierre mange, Paul boit', 'Pierre mange une pomme', 'Pierre mange rapidement', 'Pierre mange beaucoup', 1),
(63, 1, 'Quel pronom personnel complément peut remplacer \'à mes parents\' ?', 'Les', 'Leur', 'Leurs', 'Eux', 2),
(64, 1, 'Quelle est la fonction du groupe nominal souligné : \'Pierre, mon ami, viendra\' ?', 'Sujet', 'Apposition', 'Complément d\'objet direct', 'Attribut du sujet', 2),
(65, 1, 'Dans quel cas emploie-t-on le subjonctif après \'espérer\' ?', 'Toujours', 'Jamais', 'À la forme négative ou interrogative', 'Seulement au passé', 3),
(66, 1, 'Quel est le pluriel du mot \'festival\' ?', 'Festivals', 'Festivaux', 'Festivales', 'Festivals', 1),
(67, 1, 'Quelle locution conjonctive exprime le but ?', 'Parce que', 'Afin que', 'Bien que', 'Si bien que', 2),
(68, 1, 'Dans la phrase \'Il mange sa soupe avec une cuillère\', quel est le complément circonstanciel ?', 'Il', 'Sa soupe', 'Avec une cuillère', 'Mange', 3),
(69, 1, 'Quel type de discours rapporte les paroles telles qu\'elles ont été prononcées ?', 'Discours indirect', 'Discours indirect libre', 'Discours direct', 'Discours narrativisé', 3),
(70, 1, 'Quelle est la valeur du présent dans \'Demain, je pars en vacances\' ?', 'Présent d\'énonciation', 'Présent de vérité générale', 'Présent de narration', 'Futur proche', 4),
(71, 1, 'Quel est le radical du verbe \'chanter\' au présent de l\'indicatif ?', 'Chant-', 'Chante-', 'Chanti-', 'Chan-', 1),
(72, 1, 'Dans quelle phrase trouve-t-on un pléonasme ?', 'Il pleut dehors', 'Monter en haut', 'Il fait beau', 'Elle est grande', 2),
(73, 1, 'Quelle est la nature du mot \'que\' dans \'Je sais que tu viendras\' ?', 'Pronom relatif', 'Conjonction de subordination', 'Adverbe', 'Pronom interrogatif', 2),
(74, 1, 'Quel est le temps primitif du verbe \'eu\' ?', 'Présent', 'Imparfait', 'Passé simple', 'Passé composé', 3),
(75, 1, 'Dans quelle phrase l\'adjectif est-il employé comme adverbe ?', 'Elle chante fort', 'Elle est forte', 'Une voix forte', 'Plus fort', 1),
(76, 1, 'Quelle est la figure de style dans \'Le silence de la mort\' ?', 'Métaphore', 'Personnification', 'Métonymie', 'Synecdoque', 2),
(77, 1, 'Quel mode exprime l\'ordre ou la défense ?', 'Indicatif', 'Subjonctif', 'Impératif', 'Conditionnel', 3),
(78, 1, 'Dans quelle phrase le pronom relatif \'dont\' est-il bien employé ?', 'La maison dont j\'habite', 'L\'homme dont je pense', 'Le livre dont je parle', 'L\'endroit dont je vais', 3),
(79, 1, 'Quel est le genre du mot \'après-midi\' ?', 'Masculin', 'Féminin', 'Masculin ou féminin', 'Neutre', 3),
(80, 1, 'Quelle est la fonction du mot \'hier\' dans \'Hier, il pleuvait\' ?', 'Sujet', 'Complément circonstanciel de temps', 'Complément d\'objet direct', 'Attribut', 2),
(81, 1, 'Dans quelle phrase y a-t-il une anacoluthe ?', 'Arrivé en retard, le professeur l\'a grondé', 'Le professeur, arrivé en retard, l\'a grondé', 'Le professeur l\'a grondé car il était en retard', 'En retard, le professeur a grondé l\'élève', 1),
(82, 1, 'Quel est le contraire du préfixe \'dé-\' ?', 'Re-', 'Pré-', 'Anti-', 'Sur-', 1),
(83, 1, 'Dans quelle phrase le gérondif est-il correctement employé ?', 'En marchant, il réfléchit', 'En marchant, ses idées s\'éclaircissent', 'En marchant, la route était longue', 'En marchant, le temps passe vite', 1),
(84, 1, 'Quel est le pluriel de \'Madame\' ?', 'Madames', 'Mesdames', 'Mesdames', 'Madames', 2),
(85, 1, 'Quelle est la valeur du conditionnel dans \'Il pourrait venir\' ?', 'Potentiel', 'Irréel du présent', 'Irréel du passé', 'Politesse', 1),
(86, 2, 'Quel est le format d\'image le plus adapté pour les photographies avec beaucoup de couleurs ?', 'GIF', 'PNG', 'JPEG', 'BMP', 3),
(87, 2, 'Que signifie l\'acronyme R G B ?', 'Red Green Blue', 'Red Gray Black', 'Real Graphics Base', 'Render Graphics Buffer', 1),
(88, 2, 'Quelle est la résolution standard de la télévision haute définition (HD) ?', '720x480', '1920x1080', '1280x720', '640x480', 2),
(89, 2, 'Quel format audio offre une compression sans perte ?', 'MP3', 'AAC', 'FLAC', 'OGG', 3),
(90, 2, 'Dans le modèle de couleur CMYK, que représente la lettre K ?', 'Kilo', 'Key (Noir)', 'Kontrast', 'Kolor', 2),
(91, 2, 'Quelle est la fréquence d\'échantillonnage standard d\'un CD audio ?', '22,05 kHz', '44,1 kHz', '48 kHz', '96 kHz', 2),
(92, 2, 'Quel codec vidéo est le plus couramment utilisé pour la diffusion en streaming ?', 'MPEG-2', 'H.264', 'AVI', 'MOV', 2),
(93, 2, 'Que signifie DPI dans le contexte de l\'image numérique ?', 'Digital Picture Interface', 'Dots Per Inch', 'Digital Pixel Index', 'Data Processing Image', 2),
(94, 2, 'Quel format d\'image supporte la transparence ?', 'JPEG', 'BMP', 'PNG', 'TIFF', 3),
(95, 2, 'Quelle est la profondeur de couleur standard d\'une image 24 bits ?', '8 millions de couleurs', '16 millions de couleurs', '32 millions de couleurs', '64 millions de couleurs', 2),
(96, 2, 'Dans quel format les métadonnées EXIF sont-elles principalement stockées ?', 'PNG', 'JPEG', 'GIF', 'BMP', 2),
(97, 2, 'Quel est l\'avantage principal du format vectoriel par rapport au format bitmap ?', 'Taille de fichier plus petite', 'Redimensionnement sans perte de qualité', 'Meilleure compression', 'Support de l\'animation', 2),
(98, 2, 'Quelle technique permet de réduire la taille d\'un fichier multimédia ?', 'Échantillonnage', 'Compression', 'Quantification', 'Modulation', 2),
(99, 2, 'Dans le traitement audio, que signifie le terme \'bitrate\' ?', 'Fréquence d\'échantillonnage', 'Débit binaire', 'Profondeur de bits', 'Durée du fichier', 2),
(100, 2, 'Quel protocole est couramment utilisé pour la diffusion vidéo en temps réel ?', 'HTTP', 'FTP', 'RTMP', 'SMTP', 3),
(101, 2, 'Quelle est la différence principale entre compression avec perte et sans perte ?', 'La vitesse de compression', 'La qualité après décompression', 'La taille du fichier', 'Le type de données', 2),
(102, 2, 'Dans une image numérique, qu\'est-ce qu\'un pixel ?', 'Un point de couleur', 'Une unité de mesure', 'Un type de fichier', 'Un algorithme', 1),
(103, 2, 'Quel format conteneur peut inclure à la fois audio et vidéo ?', 'MP3', 'JPEG', 'MP4', 'PNG', 3),
(104, 2, 'Quelle est la résolution 4K standard ?', '1920x1080', '2560x1440', '3840x2160', '4096x2304', 3),
(105, 2, 'Dans le traitement d\'image, qu\'est-ce que l\'histogramme ?', 'Une représentation de la distribution des couleurs', 'Un type de filtre', 'Un format de fichier', 'Une technique de compression', 1),
(106, 2, 'Quel est le principal avantage du format SVG ?', 'Compression élevée', 'Support de l\'animation', 'Scalabilité sans perte', 'Petite taille de fichier', 3),
(107, 2, 'Dans l\'audio numérique, que représente la quantification ?', 'Le nombre d\'échantillons par seconde', 'La précision de chaque échantillon', 'La durée de l\'enregistrement', 'Le volume sonore', 2),
(108, 2, 'Quel algorithme est couramment utilisé pour la compression JPEG ?', 'LZW', 'DCT (Discrete Cosine Transform)', 'Huffman', 'RLE', 2),
(109, 2, 'Quelle est la différence entre les formats entrelacés et progressifs ?', 'La méthode de compression', 'L\'ordre d\'affichage des lignes', 'La résolution', 'La profondeur de couleur', 2),
(110, 2, 'Dans le modèle HSV, que représente la lettre S ?', 'Saturation', 'Spectrum', 'Scale', 'Shadow', 1),
(111, 2, 'Quel format est le plus approprié pour stocker des images avec peu de couleurs ?', 'JPEG', 'PNG', 'GIF', 'TIFF', 3),
(112, 2, 'Que signifie l\'acronyme MIDI ?', 'Musical Instrument Digital Interface', 'Multi Image Data Index', 'Media Integration Digital Input', 'Music Information Data Interface', 1),
(113, 2, 'Dans une vidéo, qu\'est-ce que le framerate ?', 'La résolution de l\'image', 'Le nombre d\'images par seconde', 'La qualité de compression', 'La durée de la vidéo', 2),
(114, 2, 'Quel est l\'espace colorimétrique le plus large ?', 'sRGB', 'Adobe RGB', 'ProPhoto RGB', 'CMYK', 3),
(115, 2, 'Dans le traitement audio, qu\'est-ce que l\'effet de réverbération ?', 'Une augmentation du volume', 'Une simulation d\'écho dans un espace', 'Une modification de la fréquence', 'Une compression du signal', 2),
(116, 2, 'Quel format d\'image est natif des appareils photo numériques professionnels ?', 'JPEG', 'PNG', 'RAW', 'GIF', 3),
(117, 2, 'Dans la vidéo numérique, qu\'est-ce qu\'un codec ?', 'Un type de caméra', 'Un algorithme de compression/décompression', 'Un format de fichier', 'Un protocole de transmission', 2),
(118, 2, 'Quelle technique permet d\'améliorer la netteté d\'une image ?', 'Flou gaussien', 'Masque de netteté', 'Réduction de bruit', 'Correction gamma', 2),
(119, 2, 'Dans l\'audio stéréo, combien de canaux sont utilisés ?', '1', '2', '4', '6', 2),
(120, 2, 'Quel est l\'avantage principal du format WebP ?', 'Meilleure qualité', 'Compression plus efficace que JPEG', 'Support universel', 'Format ouvert', 2),
(121, 2, 'Dans le traitement vidéo, qu\'est-ce qu\'un keyframe ?', 'La première image', 'Une image de référence complète', 'La dernière image', 'Une image corrompue', 2),
(122, 2, 'Quelle est la résolution standard du format VGA ?', '320x240', '640x480', '800x600', '1024x768', 2),
(123, 2, 'Dans l\'édition audio, qu\'est-ce que la normalisation ?', 'Ajustement du volume maximum', 'Suppression du bruit', 'Modification de la fréquence', 'Ajout d\'effets', 1),
(124, 2, 'Quel format de sous-titres est le plus couramment utilisé ?', 'SRT', 'ASS', 'VTT', 'SUB', 1),
(125, 2, 'Dans une image, qu\'est-ce que le bruit numérique ?', 'Des pixels indésirables', 'Une compression excessive', 'Un problème de couleur', 'Une erreur de format', 1),
(126, 2, 'Quel est le rapport d\'aspect standard du cinéma ?', '4:3', '16:9', '21:9', '1:1', 3),
(127, 2, 'Dans le traitement d\'image, qu\'est-ce qu\'un filtre passe-bas ?', 'Un filtre qui élimine les hautes fréquences', 'Un filtre qui élimine les basses fréquences', 'Un filtre de couleur', 'Un filtre de contraste', 1),
(128, 2, 'Quel format audio est développé par Apple ?', 'MP3', 'AAC', 'ALAC', 'OGG', 3),
(129, 2, 'Dans la vidéo, qu\'est-ce que le débit binaire (bitrate) ?', 'Le nombre d\'images par seconde', 'La quantité de données par seconde', 'La résolution de l\'image', 'La durée de la vidéo', 2),
(130, 2, 'Quel est l\'avantage principal du format TIFF ?', 'Compression avec perte', 'Support de multiples pages', 'Petite taille de fichier', 'Format web optimisé', 2),
(354, 5, 'Combien de pays compte l\'OHADA', '5', '16', '20', '17', 4),
(353, 4, 'Quelle est la caractéristique principale d\'une base de données NoSQL ?', 'Utilisation exclusive de SQL', 'Schéma fixe et rigide', 'Flexibilité du schéma et scalabilité horizontale', 'Structure uniquement tabulaire', 3),
(351, 4, 'L\'intégrité référentielle garantit la validité des :', 'Sauvegardes', 'Relations entre les tables', 'Performances', 'Accès concurrents', 2),
(352, 4, 'Un trigger (déclencheur) s\'exécute automatiquement en réponse à un :', 'Redémarrage du serveur', 'Événement spécifique sur la base', 'Lancement d\'une application', 'Accès à un fichier', 2),
(349, 4, 'Une vue en SQL est une :', 'Table physique', 'Copie de données', 'Table virtuelle', 'Fonction de tri', 3),
(350, 4, 'Quel type de base de données est le plus adapté aux données non structurées ?', 'Relationnelle', 'Hiérarchique', 'NoSQL', 'Orientée objet', 3),
(348, 4, 'La persistance des données signifie que les données :', 'Sont protégées contre les virus', 'Restent disponibles après l\'arrêt du programme', 'Peuvent être compressées', 'Sont uniquement en lecture', 2),
(344, 4, 'Quelle commande SQL insère de nouvelles lignes ?', 'UPDATE', 'ADD', 'INSERT INTO', 'CREATE', 3),
(345, 4, 'Pour modifier des données existantes, on utilise la commande SQL :', 'ALTER TABLE', 'UPDATE', 'MODIFY', 'CHANGE', 2),
(346, 4, 'La commande SQL pour supprimer des enregistrements est :', 'REMOVE', 'DROP', 'DELETE FROM', 'ERASE', 3),
(347, 4, 'Qu\'est-ce qu\'une transaction en base de données ?', 'Une seule instruction SQL', 'Un groupe d\'opérations exécutées comme une seule unité', 'Un rapport d\'activité', 'Une procédure stockée', 2),
(342, 4, 'Quel est le rôle d\'un index dans une base de données ?', 'Garantir l\'intégrité des données', 'Améliorer la vitesse de recherche', 'Définir la structure des tables', 'Créer des vues', 2),
(343, 4, 'DDL est utilisé pour :', 'Modifier les données', 'Définir la structure de la base', 'Interroger les données', 'Manipuler les enregistrements', 2),
(340, 4, 'Que signifie l\'acronyme ACID pour les transactions ?', 'Access, Control, Integrity, Durability', 'Atomicity, Consistency, Isolation, Durability', 'Analysis, Classification, Indexing, Data', 'Application, Connection, Isolation, Data', 2),
(341, 4, 'La normalisation d\'une base de données vise principalement à :', 'Accélérer les requêtes', 'Réduire la redondance des données', 'Simplifier les sauvegardes', 'Augmenter la taille de la base', 2),
(339, 4, 'Pour combiner des lignes de plusieurs tables en SQL, on utilise une :', 'Union', 'Jointure', 'Intersection', 'Sous-requête', 2),
(337, 4, 'Qu\'est-ce qu\'une clé primaire ?', 'Un attribut permettant d\'identifier une relation', 'Un identifiant unique pour chaque enregistrement', 'Une colonne qui stocke des dates', 'Un lien vers une autre table', 2),
(338, 4, 'Le rôle d\'une clé étrangère est d\'établir une :', 'Sécurité des données', 'Liaison entre deux tables', 'Indexation rapide', 'Validation des entrées', 2),
(336, 4, 'Quel langage est standard pour interroger une base de données relationnelle ?', 'Python', 'Java', 'C#', 'SQL', 4),
(334, 4, 'Quel est l\'objectif principal d\'un SGBD ?', 'Gérer les transactions financières', 'Organiser et manipuler les données', 'Développer des applications web', 'Sécuriser les réseaux', 2),
(335, 4, 'Dans une base de données relationnelle, les données sont organisées en :', 'Listes', 'Documents', 'Tables', 'Fichiers XML', 3),
(313, 5, 'Qu\'est-ce que l\'analyse de sensibilité en finance ?', 'L\'étude de l\'impact des variations de paramètres', 'L\'analyse des sentiments du marché', 'L\'étude de la concurrence', 'L\'analyse des risques uniquement', 1),
(312, 5, 'Comment s\'appelle le coût des capitaux propres ?', 'Coût de l\'endettement', 'Taux de rentabilité exigé par les actionnaires', 'Taux d\'intérêt bancaire', 'Coût des ventes', 2),
(311, 5, 'Qu\'est-ce qu\'une cession d\'actif ?', 'L\'achat d\'une immobilisation', 'La vente d\'un élément d\'actif', 'Une provision', 'Un amortissement', 2),
(310, 5, 'Quelle est la formule du délai de recouvrement des créances ?', 'Créances clients / (CA TTC / 360)', 'CA / Créances clients', 'Créances / CA HT', 'CA TTC / Créances', 1),
(309, 5, 'Qu\'est-ce que la valeur comptable d\'une action ?', 'Capitaux propres / Nombre d\'actions', 'Prix de marché de l\'action', 'Dividende par action', 'Bénéfice par action', 1),
(308, 5, 'Comment calcule-t-on le ratio de liquidité réduite ?', '(Actif circulant - Stocks) / Dettes à court terme', 'Trésorerie / Dettes totales', 'Stocks / Actif circulant', 'Créances / Dettes', 1),
(307, 5, 'Qu\'est-ce qu\'un tableau de financement ?', 'Un document expliquant l\'évolution financière', 'Un budget prévisionnel', 'Un contrat de prêt', 'Un relevé bancaire', 1),
(306, 5, 'Quelle est la différence entre amortissement linéaire et dégressif ?', 'Le linéaire est constant, le dégressif décroissant', 'Le dégressif est constant, le linéaire croissant', 'Il n\'y a pas de différence', 'Seul le linéaire est autorisé', 1),
(305, 5, 'Qu\'est-ce que la rentabilité des ventes ?', 'Résultat net / Chiffre d\'affaires', 'Chiffre d\'affaires / Actif total', 'Capitaux propres / Résultat net', 'Dettes / Chiffre d\'affaires', 1),
(304, 5, 'Comment appelle-t-on le financement par émission d\'actions ?', 'Financement par capitaux propres', 'Financement par endettement', 'Financement mixte', 'Autofinancement', 1),
(303, 5, 'Qu\'est-ce qu\'un découvert bancaire ?', 'Une facilité de trésorerie temporaire', 'Un prêt à long terme', 'Une subvention', 'Un investissement', 1),
(302, 5, 'Quelle est la formule du ratio de rotation des stocks ?', 'Coût d\'achat des marchandises vendues / Stock moyen', 'Stock / Chiffre d\'affaires', 'Chiffre d\'affaires / Stock', 'Stock / Coût d\'achat', 1),
(301, 5, 'Qu\'est-ce que la politique de dividendes ?', 'La stratégie de distribution des bénéfices', 'La stratégie d\'investissement', 'La stratégie commerciale', 'La stratégie de production', 1),
(300, 5, 'Comment s\'appelle le risque lié à l\'endettement ?', 'Risque commercial', 'Risque financier', 'Risque opérationnel', 'Risque technique', 2),
(299, 5, 'Qu\'est-ce qu\'une provision ?', 'Une réserve obligatoire', 'Une charge probable mais incertaine', 'Un bénéfice futur', 'Un investissement', 2),
(298, 5, 'Que signifie EBITDA ?', 'Résultat avant intérêts, impôts, dotations et amortissements', 'Résultat net après impôts', 'Chiffre d\'affaires hors taxes', 'Capitaux propres', 1),
(297, 5, 'Qu\'est-ce qu\'un budget de trésorerie ?', 'Un plan comptable', 'Un tableau prévisionnel des encaissements et décaissements', 'Un contrat bancaire', 'Un bilan prévisionnel', 2),
(296, 5, 'Comment calcule-t-on la marge sur coût variable ?', 'Chiffre d\'affaires - charges variables', 'Charges fixes - charges variables', 'Résultat net - charges fixes', 'Actif - passif', 1),
(295, 5, 'Qu\'est-ce que le point mort (seuil de rentabilité) ?', 'Le niveau de ventes où l\'entreprise ne fait ni profit ni perte', 'Le moment de fermeture de l\'entreprise', 'Le montant maximum de ventes', 'Le bénéfice minimum requis', 1),
(294, 5, 'Quelle est la différence entre charges fixes et charges variables ?', 'Les fixes ne changent jamais', 'Les fixes sont indépendantes du volume d\'activité', 'Les variables sont plus importantes', 'Il n\'y a pas de différence', 2),
(292, 5, 'Comment appelle-t-on les dividendes non distribués ?', 'Réserves', 'Provisions', 'Charges', 'Produits', 1),
(293, 5, 'Qu\'est-ce qu\'une augmentation de capital ?', 'Une diminution des dettes', 'Un apport de nouveaux fonds par les associés', 'Une distribution de dividendes', 'Un remboursement d\'emprunt', 2),
(291, 5, 'Qu\'est-ce que la structure financière optimale ?', '100% de capitaux propres', '100% de dettes', 'L\'équilibre qui minimise le coût du capital', '50% de capitaux propres et 50% de dettes', 3),
(290, 5, 'Que représente le fonds de roulement ?', 'Les stocks de l\'entreprise', 'La différence entre ressources stables et emplois stables', 'La trésorerie disponible', 'Les créances clients', 2),
(289, 5, 'Qu\'est-ce qu\'un crédit-bail (leasing) ?', 'Un prêt bancaire classique', 'Une location avec option d\'achat', 'Une subvention publique', 'Un découvert bancaire', 2),
(288, 5, 'Quelle est la formule du ratio d\'endettement ?', 'Dettes / Capitaux propres', 'Capitaux propres / Dettes', 'Dettes / Total bilan', 'Actif / Passif', 1),
(287, 5, 'Qu\'est-ce que le taux de rentabilité interne (TRI) ?', 'Le taux d\'intérêt bancaire', 'Le taux qui annule la VAN', 'Le taux de croissance', 'Le taux d\'inflation', 2),
(286, 5, 'Comment calcule-t-on le délai de récupération d\'un investissement ?', 'Investissement / Cash-flow annuel moyen', 'Cash-flow / Investissement', 'Résultat net / Investissement', 'Chiffre d\'affaires / Investissement', 1),
(285, 5, 'Qu\'est-ce que la valeur actualisée nette (VAN) ?', 'La valeur comptable d\'un investissement', 'La différence entre les flux actualisés et l\'investissement initial', 'Le montant de l\'investissement', 'Le taux de rentabilité', 2),
(284, 5, 'Quelle est la principale caractéristique d\'une action ?', 'Elle garantit un revenu fixe', 'Elle donne droit à une part des bénéfices', 'Elle a une durée limitée', 'Elle ne peut pas être vendue', 2),
(283, 5, 'Qu\'est-ce qu\'une obligation ?', 'Un titre de propriété', 'Un titre de créance', 'Un contrat commercial', 'Un placement bancaire', 2),
(282, 5, 'Comment s\'appelle le coût moyen pondéré du capital ?', 'CMPC ou WACC', 'ROI', 'EVA', 'EBITDA', 1),
(281, 5, 'Que signifie ROE (Return on Equity) ?', 'Rentabilité des ventes', 'Rentabilité des investissements', 'Rentabilité des capitaux propres', 'Rentabilité du personnel', 3),
(280, 5, 'Qu\'est-ce qu\'un plan de financement ?', 'Un document comptable obligatoire', 'Un tableau prévisionnel des ressources et emplois', 'Un contrat avec les banques', 'Un état de la trésorerie', 2),
(279, 5, 'Quelle est la différence entre rentabilité économique et rentabilité financière ?', 'Il n\'y a pas de différence', 'La rentabilité économique concerne l\'actif, la financière les capitaux propres', 'La rentabilité économique est toujours supérieure', 'Seule la rentabilité financière compte', 2),
(278, 5, 'Qu\'est-ce que l\'effet de levier financier ?', 'L\'augmentation du capital social', 'L\'utilisation de l\'endettement pour améliorer la rentabilité', 'La diminution des coûts de production', 'L\'augmentation du chiffre d\'affaires', 2),
(277, 5, 'Comment calcule-t-on la capacité d\'autofinancement (CAF) ?', 'Résultat net + dotations aux amortissements', 'Chiffre d\'affaires - charges', 'Actif - Passif', 'Produits financiers - charges financières', 1),
(276, 5, 'Qu\'est-ce qu\'un cash-flow ?', 'Le chiffre d\'affaires de l\'entreprise', 'Les flux de trésorerie générés par l\'activité', 'Les investissements réalisés', 'Les emprunts contractés', 2),
(275, 5, 'Quelle est la formule du ratio de liquidité générale ?', 'Actif circulant / Dettes à court terme', 'Trésorerie / Dettes totales', 'Capitaux propres / Total actif', 'Résultat net / Chiffre d\'affaires', 1),
(274, 5, 'Que représente le besoin en fonds de roulement (BFR) ?', 'Les investissements en immobilisations', 'Le financement permanent de l\'entreprise', 'Le décalage entre les encaissements et décaissements d\'exploitation', 'La trésorerie disponible', 3),
(273, 5, 'Qu\'est-ce que le capital social d\'une entreprise ?', 'L\'ensemble des dettes de l\'entreprise', 'Les apports des associés ou actionnaires', 'Le chiffre d\'affaires annuel', 'Les bénéfices accumulés', 2);

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `intitule`, `description`) VALUES
(1, 'Joueur', ''),
(2, 'Enseignant', ''),
(3, 'Administrateur', '');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(255) NOT NULL,
  `nom` varchar(200) NOT NULL,
  `mot_de_passe` varchar(200) DEFAULT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `utilisateur_ibfk_1` (`type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `mot_de_passe`, `type`) VALUES
('admin@mail.com', 'Admin', '$2y$10$1MxA3xFcW9hWLQBC20OUr.2vtkCt1oN3YlMo85jATZXjlzTESFZVi', 3),
('wabo@gmail.com', 'Wabo', '$2y$10$iNt2g6Qx1TchvNmdAKXgg.SVL9kvqUNjEUtpeeL9QCSh6z6qGTvtO', 2),
('fowa@gmail.com', 'Fowa', '$2y$10$b/7S.i74OOeoffTpaX1WC.PjJKTEplExGdavNTdYUC4aDfy8C41Bm', 2),
('talla@gmail.com', 'Talla', '$2y$10$dC635Rsd.kjQkv0WUOhJyOObSsGr.ckhL5pgq.6IyIOqNIxdb1O8q', 2),
('ericleretour@gmail.com', 'Eric', '$2y$10$O19hft8FTaHOC6g0M21TduPx70JfSYzKJxNV2x/l3rbwVou.RPO9y', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
