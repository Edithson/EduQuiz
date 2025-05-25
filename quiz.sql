
DROP DATABASE IF EXISTS `quiz`;
CREATE DATABASE IF NOT EXISTS `quiz`;

DROP TABLE IF EXISTS `classe`;
CREATE TABLE IF NOT EXISTS `classe` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_cycle` int NOT NULL,
  `id_specialite` int NOT NULL,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_classe_cycle` (`id_cycle`),
  KEY `fk_classe_filiere` (`id_specialite`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;


INSERT INTO `classe` (`id`, `id_cycle`, `id_specialite`, `intitule`) VALUES
(1, 1, 1, 'GL1'),
(2, 1, 1, 'GL2'),
(3, 1, 3, 'GSI1'),
(4, 1, 3, 'GSI2');

DROP TABLE IF EXISTS `classe_matiere`;
CREATE TABLE IF NOT EXISTS `classe_matiere` (
  `id_classe` int NOT NULL,
  `id_matiere` bigint NOT NULL,
  PRIMARY KEY (`id_classe`,`id_matiere`),
  KEY `fk_contenir_matiere` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

INSERT INTO `classe_matiere` (`id_classe`, `id_matiere`) VALUES
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(1, 54),
(2, 54),
(3, 54),
(4, 54);

-- --------------------------------------------------------

--
-- Structure de la table `cycle`
--

DROP TABLE IF EXISTS `cycle`;
CREATE TABLE IF NOT EXISTS `cycle` (
  `id` int NOT NULL AUTO_INCREMENT,
  `intitule` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cycle`
--

INSERT INTO `cycle` (`id`, `intitule`) VALUES
(1, 'BTS'),
(2, 'Licence');

-- --------------------------------------------------------

--
-- Structure de la table `enseignant_matiere`
--

DROP TABLE IF EXISTS `enseignant_matiere`;
CREATE TABLE IF NOT EXISTS `enseignant_matiere` (
  `email_enseignant` varchar(255) NOT NULL,
  `id_matiere` bigint NOT NULL,
  KEY `enseignant_matiere_ibfk_1` (`email_enseignant`),
  KEY `enseignant_matiere_ibfk_2` (`id_matiere`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `enseignant_matiere`
--

INSERT INTO `enseignant_matiere` (`email_enseignant`, `id_matiere`) VALUES
('admin@gmail.com', 3),
('jeremi@gmail.com', 3),
('jeremi@gmail.com', 54),
('Ultra@gmail.com', 3),
('Ultra@gmail.com', 54);

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `description`) VALUES
(1, 'Genie Logiciel', 'conseption et implémentation de logiciel'),
(3, 'Gestion des Systèmes d information', ''),
(4, 'Automatisme et Informatique Industrielle', ''),
(5, 'Comptabilité et Gestion des Entreprises', ''),
(8, 'ma spécialité préférée', 'ma spécialité à moi et rien qu&#039;a moi'),
(9, 'Marketing Commerce et Vente', ''),
(14, 'Industrie d&#039;Habillement', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `nom`, `description`) VALUES
(3, 'Infographie', 'l&#039;info c&#039;est la classe'),
(54, 'Français', 'technique d&#039;expression française');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `id_matiere` bigint NOT NULL,
  `intitule` mediumtext NOT NULL,
  `proposition_1` varchar(255) NOT NULL,
  `proposition_2` varchar(255) NOT NULL,
  `proposition_3` varchar(255) NOT NULL,
  `proposition_4` varchar(255) NOT NULL,
  `reponse` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_question_matiere` (`id_matiere`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`id`, `id_matiere`, `intitule`, `proposition_1`, `proposition_2`, `proposition_3`, `proposition_4`, `reponse`) VALUES
(1, 3, 'Qu\'es ce que le BIOS', 'Basic Input Output System', 'Basic Input Output Service', 'Bit Input Output System', 'Basic Insert Online System', 1),
(2, 3, 'Le signe I D E, signifie :', 'Integrated Development Environment.', 'Initiation au Développement Evènementielle.', 'Integrated Development Elementary.', 'Infographics Development Elementary.', 1),
(3, 3, 'La taille d’une image numérique peut se définir par :', 'Sa définition, ses valeurs par défauts et sa résolution', 'Sa colorimétrie, ses dimensions et sa résolution', 'Sa définition, ses dimensions et sa résolution', 'Sa définition, ses dimensions et son nombre de bits de traitement', 3),
(4, 3, 'La combinaison du vert et du rouge donne :', 'Le cyan', 'L’indigo', 'Le marron', 'Le jaune', 4),
(5, 3, 'Les 3 couleurs primaires lumineuse sont :', 'Le vert, le rouge et le jaune', 'Le bleu, le vert et le rouge', 'Le vert, le blanc et le jaune', 'Le bleu, le blanc et le rouge', 2),
(6, 3, 'La hauteur d’un son, qui est la fréquence de vibration de l’aire s’exprime en :', 'Décibels', 'HERTZ', 'Pourcentage', 'Kg', 2),
(7, 3, 'Le système informatique est ’un ensemble d’élément composer de 2 éléments indissociable :', 'Le matériel et le hardware\r\n', 'Le matériel et la carte mère', 'Le matériel et le logiciel', 'Le logiciel et l’invite de commande', 3),
(8, 3, 'Il existe 3 types d’ordinateurs qui sont :', 'Les mac book, les pro book et les chrome book', 'Les ordinateurs, les serveurs et les terminaux', 'Les micro-ordinateurs, les macro-ordinateurs et les mini-ordinateurs', 'Les laptops, les desktops et les PC', 3),
(9, 3, 'On distingue 3 types de mémoires qui sont :', 'La mémoire morte, la mémoire vive et la mémoire virtuelle', 'La RAM, la ROM et le Disque Dur', 'La mémoire centrale, la mémoire auxiliaire et la mémoire cache', 'La RAM, la ROM et la mémoire auxiliaire', 4),
(10, 3, 'Le sigle DVD signifie :', 'Direct Versatile Disk', 'Digital Video Disk', 'Digital Versatile Disk', 'Distance Vector Disk', 3),
(11, 3, 'Le composant principale de l’unité centrale est :', 'Le Disque Dur', 'La carte mère', 'Le ventilateur', 'Le processeur', 2),
(12, 3, 'La notation en bosse de chameau est encore appelée :', 'Snake case', 'Camel case', 'Pascal case', 'Kebab case', 2),
(13, 3, 'Le débogage consiste à :', 'Chercher, trouver et rectifier les bugs', 'Exécuter le code en mode pas à pas', 'Redémarrer le code', 'Exécuter le code en tenant compte les bugs', 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`id`, `intitule`, `description`) VALUES
(1, 'joueurs', 'les jouers classiques'),
(2, 'administrateur', 'les differents enseignants'),
(3, 'super administrateur', 'les supers administrateurs');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `email` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `type` int DEFAULT NULL,
  PRIMARY KEY (`email`),
  KEY `utilisateur_ibfk_1` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`email`, `nom`, `mot_de_passe`, `type`) VALUES
('admin@gmail.com', 'Admin+', '$2y$10$bDKpTIiwqHmWNePxVU6rBuXJiMVC5ht40U09vnHk9dyYPmssVAgJK', 3),
('jeremi@gmail.com', 'Jérémi', '$2y$10$.BG0.DnbCvZK3a6C9bPwJOxgZ5viMnR9d5jqvNQ8Bpy9JSMIo/jCO', 2),
('Ultra@gmail.com', 'Ultra', '$2y$10$skxnGvsYbAqhLFVg.njxN.dPEirLhSKaRavB2ro/wobj1ufGn01rC', 3);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `fk_classe_cycle` FOREIGN KEY (`id_cycle`) REFERENCES `cycle` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_classe_filiere` FOREIGN KEY (`id_specialite`) REFERENCES `filiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `classe_matiere`
--
ALTER TABLE `classe_matiere`
  ADD CONSTRAINT `fk_contenir_classe` FOREIGN KEY (`id_classe`) REFERENCES `classe` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_contenir_matiere` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `enseignant_matiere`
--
ALTER TABLE `enseignant_matiere`
  ADD CONSTRAINT `enseignant_matiere_ibfk_1` FOREIGN KEY (`email_enseignant`) REFERENCES `utilisateur` (`email`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `enseignant_matiere_ibfk_2` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `fk_question_matiere` FOREIGN KEY (`id_matiere`) REFERENCES `matiere` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`type`) REFERENCES `type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;
