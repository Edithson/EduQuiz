-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 04 juin 2025 à 12:48
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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

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
('admin@mail.com', 5),
('wabo@gmail.com', 2),
('fowa@gmail.com', 2),
('fowa@gmail.com', 3),
('fowa@gmail.com', 4),
('talla@gmail.com', 5),
('talla@gmail.com', 2),
('talla@gmail.com', 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8mb3;

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
(131, 4, 'Que signifie l\'acronyme SQL ?', 'Structured Query Language', 'Standard Query Language', 'Simple Query Language', 'System Query Language', 1),
(132, 4, 'Quel est le rôle principal d\'un SGBD ?', 'Gérer et organiser les données', 'Créer des interfaces utilisateur', 'Développer des applications web', 'Optimiser les performances réseau', 1),
(133, 4, 'Quelle commande SQL permet de créer une nouvelle table ?', 'CREATE TABLE', 'NEW TABLE', 'MAKE TABLE', 'BUILD TABLE', 1),
(134, 4, 'Qu\'est-ce qu\'une clé primaire ?', 'Un identifiant unique pour chaque enregistrement', 'Un mot de passe pour accéder à la base', 'Une clé de chiffrement des données', 'Un index pour optimiser les requêtes', 1),
(135, 4, 'Quelle commande permet d\'insérer des données dans une table ?', 'INSERT INTO', 'ADD DATA', 'PUT INTO', 'APPEND TO', 1),
(136, 4, 'Que signifie ACID en base de données ?', 'Atomicité, Cohérence, Isolation, Durabilité', 'Access, Control, Index, Data', 'Automatic, Consistent, Integrated, Dynamic', 'Advanced, Complete, Indexed, Distributed', 1),
(137, 4, 'Quelle clause SQL permet de filtrer les résultats ?', 'WHERE', 'FILTER', 'SELECT', 'HAVING', 1),
(138, 4, 'Qu\'est-ce qu\'une clé étrangère ?', 'Une référence vers la clé primaire d\'une autre table', 'Une clé de sauvegarde de la table', 'Une clé publique de chiffrement', 'Une clé temporaire pour les transactions', 1),
(139, 4, 'Quelle commande permet de modifier la structure d\'une table ?', 'ALTER TABLE', 'MODIFY TABLE', 'CHANGE TABLE', 'UPDATE TABLE', 1),
(140, 4, 'Que fait la commande DELETE en SQL ?', 'Supprime des enregistrements d\'une table', 'Supprime une table complète', 'Supprime une base de données', 'Supprime un utilisateur', 1),
(141, 4, 'Quel type de jointure retourne tous les enregistrements des deux tables ?', 'FULL OUTER JOIN', 'INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 1),
(142, 4, 'Qu\'est-ce que la normalisation en base de données ?', 'Organiser les données pour éviter la redondance', 'Chiffrer les données sensibles', 'Optimiser les performances', 'Créer des sauvegardes automatiques', 1),
(143, 4, 'Quelle fonction SQL permet de compter le nombre d\'enregistrements ?', 'COUNT()', 'NUMBER()', 'TOTAL()', 'SUM()', 1),
(144, 4, 'Que signifie NULL en SQL ?', 'Une valeur manquante ou inconnue', 'Une valeur égale à zéro', 'Une chaîne vide', 'Une valeur par défaut', 1),
(145, 4, 'Quelle commande permet de trier les résultats d\'une requête ?', 'ORDER BY', 'SORT BY', 'ARRANGE BY', 'GROUP BY', 1),
(146, 4, 'Qu\'est-ce qu\'un index en base de données ?', 'Une structure pour accélérer les recherches', 'Une copie de sauvegarde', 'Un type de données spécial', 'Un utilisateur administrateur', 1),
(147, 4, 'Quelle est la première forme normale (1NF) ?', 'Éliminer les groupes répétitifs', 'Éliminer les dépendances partielles', 'Éliminer les dépendances transitives', 'Éliminer les dépendances multivaluées', 1),
(148, 4, 'Que fait la clause GROUP BY ?', 'Regroupe les enregistrements par valeur', 'Trie les enregistrements', 'Filtre les enregistrements', 'Joint deux tables', 1),
(149, 4, 'Quel type de données SQL stocke du texte de longueur variable ?', 'VARCHAR', 'CHAR', 'TEXT', 'STRING', 1),
(150, 4, 'Qu\'est-ce qu\'une transaction en base de données ?', 'Une séquence d\'opérations traitées comme une unité', 'Une requête de sélection complexe', 'Un type de jointure avancée', 'Une procédure stockée', 1),
(151, 4, 'Quelle commande crée un utilisateur en SQL ?', 'CREATE USER', 'ADD USER', 'NEW USER', 'MAKE USER', 1),
(152, 4, 'Que signifie le terme \'cardinalité\' en base de données ?', 'Le nombre de tuples dans une relation', 'La taille d\'un champ', 'Le type d\'une donnée', 'La vitesse d\'exécution', 1),
(153, 4, 'Quelle fonction SQL calcule la moyenne ?', 'AVG()', 'MEAN()', 'AVERAGE()', 'MEDIAN()', 1),
(154, 4, 'Qu\'est-ce qu\'une vue (VIEW) en SQL ?', 'Une table virtuelle basée sur une requête', 'Une copie physique d\'une table', 'Un type d\'index spécialisé', 'Une sauvegarde automatique', 1),
(155, 4, 'Quelle contrainte assure l\'unicité d\'une valeur ?', 'UNIQUE', 'DISTINCT', 'SINGLE', 'EXCLUSIVE', 1),
(156, 4, 'Que fait la commande TRUNCATE ?', 'Vide une table en conservant sa structure', 'Supprime complètement une table', 'Modifie la structure d\'une table', 'Crée une copie d\'une table', 1),
(157, 4, 'Qu\'est-ce qu\'un trigger en base de données ?', 'Une procédure qui s\'exécute automatiquement', 'Un type de requête complexe', 'Un utilisateur spécialisé', 'Une contrainte de sécurité', 1),
(158, 4, 'Quelle jointure retourne uniquement les enregistrements correspondants ?', 'INNER JOIN', 'LEFT JOIN', 'RIGHT JOIN', 'FULL JOIN', 1),
(159, 4, 'Que signifie CRUD en développement d\'applications ?', 'Create, Read, Update, Delete', 'Control, Read, Update, Display', 'Create, Retrieve, Upload, Delete', 'Copy, Read, Update, Distribute', 1),
(160, 4, 'Quel est le rôle d\'un DBA ?', 'Administrer la base de données', 'Développer des applications', 'Tester les logiciels', 'Former les utilisateurs', 1),
(161, 4, 'Qu\'est-ce que la dénormalisation ?', 'Introduire volontairement de la redondance', 'Supprimer toutes les redondances', 'Chiffrer les données', 'Compresser la base de données', 1),
(162, 4, 'Quelle commande permet de créer une sauvegarde ?', 'BACKUP DATABASE', 'SAVE DATABASE', 'COPY DATABASE', 'EXPORT DATABASE', 1),
(163, 4, 'Qu\'est-ce qu\'un schéma de base de données ?', 'La structure logique de la base', 'Le contenu des données', 'La taille du stockage', 'La vitesse d\'accès', 1),
(164, 4, 'Quelle fonction SQL retourne la date actuelle ?', 'NOW()', 'TODAY()', 'CURRENT()', 'DATE()', 1),
(165, 4, 'Que fait la clause HAVING ?', 'Filtre les groupes après GROUP BY', 'Trie les résultats', 'Joint deux tables', 'Crée un index', 1),
(166, 4, 'Qu\'est-ce qu\'une relation Many-to-Many ?', 'Plusieurs enregistrements liés à plusieurs autres', 'Un enregistrement lié à plusieurs autres', 'Plusieurs enregistrements liés à un seul', 'Aucune relation entre enregistrements', 1),
(167, 4, 'Quel opérateur SQL teste l\'appartenance à un ensemble ?', 'IN', 'BETWEEN', 'LIKE', 'EXISTS', 1),
(168, 4, 'Qu\'est-ce que l\'intégrité référentielle ?', 'Cohérence entre tables liées', 'Unicité des clés primaires', 'Chiffrement des données', 'Optimisation des requêtes', 1),
(169, 4, 'Quelle commande affiche la structure d\'une table ?', 'DESCRIBE', 'SHOW', 'DISPLAY', 'INFO', 1),
(170, 4, 'Qu\'est-ce qu\'un deadlock ?', 'Blocage mutuel entre transactions', 'Erreur de syntaxe SQL', 'Corruption de données', 'Panne de serveur', 1),
(171, 4, 'Quel niveau d\'isolation évite les lectures sales ?', 'READ COMMITTED', 'READ UNCOMMITTED', 'REPEATABLE READ', 'SERIALIZABLE', 1),
(172, 4, 'Qu\'est-ce qu\'une procédure stockée ?', 'Code SQL précompilé et stocké', 'Une requête sauvegardée', 'Un type de trigger', 'Une contrainte complexe', 1),
(173, 4, 'Quelle commande SQL permet la mise à jour conditionnelle ?', 'UPDATE avec WHERE', 'MODIFY avec IF', 'CHANGE avec WHEN', 'ALTER avec CASE', 1),
(174, 4, 'Qu\'est-ce que le sharding ?', 'Partitionnement horizontal des données', 'Chiffrement des données', 'Compression des tables', 'Réplication des serveurs', 1),
(175, 4, 'Quel type de données stocke des valeurs vraies/fausses ?', 'BOOLEAN', 'BIT', 'FLAG', 'SWITCH', 1),
(176, 4, 'Qu\'est-ce qu\'un cluster en base de données ?', 'Groupe de serveurs travaillant ensemble', 'Type d\'index spécialisé', 'Ensemble de tables liées', 'Procédure de sauvegarde', 1),
(177, 4, 'Quelle commande SQL supprime une table ?', 'DROP TABLE', 'DELETE TABLE', 'REMOVE TABLE', 'DESTROY TABLE', 1),
(178, 4, 'Qu\'est-ce que la réplication ?', 'Copie des données sur plusieurs serveurs', 'Compression des données', 'Chiffrement automatique', 'Optimisation des requêtes', 1),
(179, 4, 'Quel opérateur permet la recherche de motifs ?', 'LIKE', 'MATCH', 'FIND', 'SEARCH', 1),
(180, 4, 'Qu\'est-ce que l\'OLTP ?', 'Online Transaction Processing', 'Online Table Processing', 'Optimized Load Transfer Protocol', 'Object Level Transaction Processing', 1),
(181, 5, 'Qu\'est-ce que le besoin en fonds de roulement (BFR) ?', 'Besoin de financement du cycle d\'exploitation', 'Besoin de financement des investissements', 'Besoin de financement des dividendes', 'Besoin de financement des emprunts', 1),
(182, 5, 'Que représente le ratio de liquidité générale ?', 'Actif circulant / Dettes à court terme', 'Disponibilités / Dettes à court terme', 'Capitaux propres / Total bilan', 'Chiffre d\'affaires / Actif total', 1),
(183, 5, 'Quelle est la formule du délai de rotation des stocks ?', 'Stock moyen / Coût d\'achat × 360', 'Stock moyen / Chiffre d\'affaires × 360', 'Stock final / Coût d\'achat × 360', 'Stock initial / Chiffre d\'affaires × 360', 1),
(184, 5, 'Qu\'est-ce que la capacité d\'autofinancement (CAF) ?', 'Ressources générées par l\'activité', 'Bénéfice net de l\'exercice', 'Dividendes distribués', 'Augmentation de capital', 1),
(185, 5, 'Que mesure le ratio de rentabilité économique ?', 'Résultat d\'exploitation / Actif économique', 'Résultat net / Capitaux propres', 'Résultat net / Chiffre d\'affaires', 'Dividendes / Capitaux propres', 1),
(186, 5, 'Quelle est la différence entre charges fixes et charges variables ?', 'Les charges fixes sont indépendantes de l\'activité', 'Les charges fixes varient avec le chiffre d\'affaires', 'Les charges variables sont constantes', 'Il n\'y a pas de différence', 1),
(187, 5, 'Qu\'est-ce que le seuil de rentabilité ?', 'Niveau d\'activité où le résultat est nul', 'Niveau maximum de production', 'Niveau minimum de ventes', 'Niveau optimal de stock', 1),
(188, 5, 'Comment calcule-t-on la marge sur coût variable ?', 'Chiffre d\'affaires - Charges variables', 'Chiffre d\'affaires - Charges fixes', 'Résultat net - Impôts', 'Prix de vente - Coût d\'achat', 1),
(189, 5, 'Qu\'est-ce que l\'effet de levier financier ?', 'Impact de l\'endettement sur la rentabilité', 'Impact des stocks sur la trésorerie', 'Impact des clients sur les ventes', 'Impact des fournisseurs sur les achats', 1),
(190, 5, 'Que représente le ratio d\'endettement ?', 'Dettes financières / Capitaux propres', 'Dettes totales / Chiffre d\'affaires', 'Charges financières / Résultat', 'Emprunts / Total bilan', 1),
(191, 5, 'Quelle est la formule de la valeur actuelle nette (VAN) ?', 'Somme des flux actualisés - Investissement initial', 'Investissement initial / Flux de trésorerie', 'Flux de trésorerie / Taux d\'actualisation', 'Résultat net × Taux d\'actualisation', 1),
(192, 5, 'Qu\'est-ce que le délai de récupération (payback) ?', 'Temps nécessaire pour récupérer l\'investissement', 'Durée de vie du projet', 'Période de remboursement des emprunts', 'Délai de règlement des clients', 1),
(193, 5, 'Comment calcule-t-on le coût moyen pondéré du capital (CMPC) ?', 'Moyenne pondérée des coûts de financement', 'Coût des emprunts uniquement', 'Coût des capitaux propres uniquement', 'Taux d\'actualisation fixe', 1),
(194, 5, 'Qu\'est-ce que la rotation des actifs ?', 'Chiffre d\'affaires / Actif total', 'Actif total / Chiffre d\'affaires', 'Résultat / Actif total', 'Actif circulant / Actif total', 1),
(195, 5, 'Que représente le ratio de couverture des intérêts ?', 'Résultat d\'exploitation / Charges financières', 'Charges financières / Résultat net', 'Emprunts / Charges financières', 'Capitaux propres / Charges financières', 1),
(196, 5, 'Qu\'est-ce que l\'autofinancement ?', 'CAF - Dividendes distribués', 'Bénéfice net + Dividendes', 'Augmentation de capital', 'Emprunts nouveaux', 1),
(197, 5, 'Comment calcule-t-on le délai de règlement clients ?', 'Créances clients / CA TTC × 360', 'Créances clients / CA HT × 360', 'CA TTC / Créances clients × 360', 'CA HT / Créances clients × 360', 1),
(198, 5, 'Qu\'est-ce que la marge brute ?', 'Chiffre d\'affaires - Coût d\'achat des marchandises', 'Chiffre d\'affaires - Charges d\'exploitation', 'Résultat d\'exploitation - Charges financières', 'Résultat net - Impôts', 1),
(199, 5, 'Que mesure le ratio de liquidité immédiate ?', 'Disponibilités / Dettes à court terme', 'Actif circulant / Dettes à court terme', 'Créances / Dettes à court terme', 'Stocks / Dettes à court terme', 1),
(200, 5, 'Qu\'est-ce que le fonds de roulement net global (FRNG) ?', 'Ressources stables - Actif immobilisé', 'Actif circulant - Dettes à court terme', 'Capitaux propres - Actif immobilisé', 'Dettes à long terme - Actif immobilisé', 1),
(201, 5, 'Comment interpréter un ratio de liquidité générale de 1,5 ?', 'L\'entreprise peut honorer ses dettes à court terme', 'L\'entreprise est en difficulté financière', 'L\'entreprise a trop de liquidités', 'L\'entreprise manque de stocks', 1),
(202, 5, 'Qu\'est-ce que la rentabilité financière ?', 'Résultat net / Capitaux propres', 'Résultat d\'exploitation / Actif total', 'Chiffre d\'affaires / Capitaux propres', 'Dividendes / Capitaux propres', 1),
(203, 5, 'Que représente l\'indice de profitabilité ?', 'VAN / Investissement initial + 1', 'VAN / Investissement initial', 'Investissement initial / VAN', 'Flux de trésorerie / Investissement', 1),
(204, 5, 'Qu\'est-ce que le taux de rentabilité interne (TRI) ?', 'Taux qui annule la VAN', 'Taux d\'actualisation du marché', 'Taux de croissance des ventes', 'Taux de marge bénéficiaire', 1),
(205, 5, 'Comment calcule-t-on la trésorerie nette ?', 'FRNG - BFR', 'Disponibilités - Dettes financières', 'Actif circulant - Passif circulant', 'Capitaux propres - Dettes totales', 1),
(206, 5, 'Qu\'est-ce que l\'amortissement dégressif ?', 'Méthode d\'amortissement accéléré', 'Amortissement constant chaque année', 'Amortissement basé sur l\'usage', 'Amortissement exceptionnel', 1),
(207, 5, 'Que représente le coefficient multiplicateur ?', 'Charges fixes / Marge sur coût variable', 'Marge sur coût variable / Charges fixes', 'Chiffre d\'affaires / Charges fixes', 'Charges variables / Charges fixes', 1),
(208, 5, 'Qu\'est-ce que la valeur comptable d\'une action ?', 'Capitaux propres / Nombre d\'actions', 'Résultat net / Nombre d\'actions', 'Dividende / Nombre d\'actions', 'Chiffre d\'affaires / Nombre d\'actions', 1),
(209, 5, 'Comment calcule-t-on le délai de règlement fournisseurs ?', 'Dettes fournisseurs / Achats TTC × 360', 'Achats TTC / Dettes fournisseurs × 360', 'Dettes fournisseurs / Achats HT × 360', 'Achats HT / Dettes fournisseurs × 360', 1),
(210, 5, 'Qu\'est-ce que la provision pour risques et charges ?', 'Passif probable dont l\'échéance est incertaine', 'Réserve de trésorerie', 'Amortissement des immobilisations', 'Créance douteuse', 1),
(211, 5, 'Que mesure le ratio de rotation des créances ?', 'Rapidité d\'encaissement des créances', 'Niveau des créances irrécouvrables', 'Politique de crédit de l\'entreprise', 'Délai moyen de règlement', 1),
(212, 5, 'Qu\'est-ce que l\'excédent brut d\'exploitation (EBE) ?', 'Résultat d\'exploitation + Dotations - Reprises', 'Chiffre d\'affaires - Charges d\'exploitation', 'Résultat net + Charges financières', 'Marge commerciale - Charges externes', 1),
(213, 5, 'Comment interpréter une VAN positive ?', 'Le projet est rentable', 'Le projet n\'est pas rentable', 'Le projet est risqué', 'Le projet est sans intérêt', 1),
(214, 5, 'Qu\'est-ce que la structure financière optimale ?', 'Équilibre entre capitaux propres et dettes', 'Maximum de capitaux propres', 'Maximum d\'endettement', 'Aucun endettement', 1),
(215, 5, 'Que représente le ratio de solvabilité générale ?', 'Actif total / Dettes totales', 'Capitaux propres / Dettes totales', 'Trésorerie / Dettes totales', 'Résultat / Dettes totales', 1),
(216, 5, 'Qu\'est-ce que le risque de change ?', 'Risque lié aux variations de taux de change', 'Risque lié aux taux d\'intérêt', 'Risque lié à la concurrence', 'Risque lié aux clients', 1),
(217, 5, 'Comment calcule-t-on la rentabilité des ventes ?', 'Résultat net / Chiffre d\'affaires', 'Chiffre d\'affaires / Résultat net', 'Marge brute / Chiffre d\'affaires', 'Charges / Chiffre d\'affaires', 1),
(218, 5, 'Qu\'est-ce que l\'analyse horizontale du bilan ?', 'Comparaison des exercices successifs', 'Comparaison des postes du même exercice', 'Analyse des ratios', 'Analyse des flux de trésorerie', 1),
(219, 5, 'Que représente le crédit-bail (leasing) ?', 'Location avec option d\'achat', 'Prêt bancaire classique', 'Augmentation de capital', 'Subvention d\'investissement', 1),
(220, 5, 'Qu\'est-ce que la marge de sécurité ?', 'CA réalisé - CA au seuil de rentabilité', 'Charges fixes - Charges variables', 'Résultat net - Impôts', 'Actif - Passif', 1),
(221, 5, 'Comment calcule-t-on le taux de croissance interne ?', 'Taux d\'autofinancement × Rentabilité économique', 'Résultat net / CA de l\'année précédente', 'CAF / Investissement', 'Dividendes / Capitaux propres', 1),
(222, 5, 'Qu\'est-ce que l\'actualisation ?', 'Technique pour ramener les flux futurs en valeur actuelle', 'Calcul de l\'inflation', 'Évaluation des stocks', 'Calcul des amortissements', 1),
(223, 5, 'Que représente l\'actif économique ?', 'Actif immobilisé + BFR', 'Actif total - Passif total', 'Immobilisations corporelles uniquement', 'Capitaux propres + Dettes financières', 1),
(224, 5, 'Qu\'est-ce que la politique de dividende ?', 'Décision de distribution des bénéfices', 'Politique d\'investissement', 'Politique de financement', 'Politique commerciale', 1),
(225, 5, 'Comment calculer le point mort en quantité ?', 'Charges fixes / Marge unitaire sur coût variable', 'Charges variables / Prix de vente unitaire', 'Chiffre d\'affaires / Coût unitaire', 'Marge brute / Charges totales', 1),
(226, 5, 'Qu\'est-ce que la gestion de trésorerie ?', 'Optimisation des flux de liquidités', 'Gestion des stocks', 'Gestion des clients', 'Gestion des fournisseurs', 1),
(227, 5, 'Que mesure le ratio de charges financières ?', 'Charges financières / Chiffre d\'affaires', 'Chiffre d\'affaires / Charges financières', 'Charges financières / Résultat net', 'Emprunts / Charges financières', 1),
(228, 5, 'Qu\'est-ce que l\'escompte de règlement ?', 'Réduction accordée pour paiement anticipé', 'Intérêt sur découvert', 'Commission bancaire', 'Frais de recouvrement', 1),
(229, 5, 'Comment interpréter un BFR négatif ?', 'Les dettes fournisseurs financent l\'exploitation', 'L\'entreprise manque de liquidités', 'Les stocks sont trop importants', 'Les créances sont trop élevées', 1),
(230, 5, 'Qu\'est-ce que la cession-bail (lease-back) ?', 'Vente puis location du même bien', 'Achat puis revente immédiate', 'Location simple', 'Crédit-bail classique', 1),
(231, 5, 'Que représente le ratio de marge nette ?', 'Résultat net / Chiffre d\'affaires', 'Marge brute / Chiffre d\'affaires', 'EBE / Chiffre d\'affaires', 'Résultat d\'exploitation / Chiffre d\'affaires', 1);

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
