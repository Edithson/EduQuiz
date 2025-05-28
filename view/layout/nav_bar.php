<?php
 require_once('view/layout/header.php');
?>

<nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">🎓 EduQuiz</a>
            
            <!-- Desktop Menu -->
            <ul class="nav-menu">
            <div id="check"><hr><hr><hr></div>
                <li class="nav-item">
                    <a href="index.php?path=accueil" class="nav-link active" id="accueil">🏠 Accueil</a>
                </li>
                
                <?php
                if (isset($_SESSION['auth']) && $_SESSION['auth']==true) {
                    ?>
                    <li class="nav-item dropdown">
                        <a href="#fonctionnalites" class="nav-link">
                            ⚙️ Fonctionnalités <span class="dropdown-arrow">▼</span>
                        </a>
                        <div class="dropdown-content">
                        <?php
                            if ($_SESSION['admin'] == 1) {
                                ?>
                                <a class="dropdown-item" href="index.php?path=question" id="question">❓ Gestion des Questions</a>
                                <?php
                                if ($_SESSION['super_admin'] == 1) {
                                    ?>
                                    <a class="dropdown-item" href="index.php?path=enseignant" id="enseignant">👤 Gestion des Enseignants</a>
                                    <a class="dropdown-item" href="index.php?path=matiere" id="matiere">📚 Gestion des Matieres</a>
                                    <a class="dropdown-item" href="index.php?path=classe" id="classe">👥 Gestion des Classes</a>
                                    <a class="dropdown-item" href="index.php?path=filiere" id="filiere">🗃️ Gestion des Filieres</a>
                                    <a href="#statistiques" class="dropdown-item">📊 Statistiques</a>
                                    <a href="#parametres" class="dropdown-item">⚙️ Paramètres</a>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile" href="index.php?path=profile">Profil</a></li>
                    <?php
                }
                ?>
                <li class="nav-item">
                    <a href="index.php?path=apropos" class="nav-link" id="apropos">📖 À propos</a>
                </li>
                <li class="nav-item">
                    <a href="index.php?path=contact" class="nav-link" id="contact">📧 Contact</a>
                </li>
                <?php
                if (isset($_SESSION['auth']) && $_SESSION['auth']==true) {
                    ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?path=deconnexion" id="deconnexion">Déconnexion</a></li>
                    <?php
                }else{
                    ?>
                    <li class="nav-item"><a class="nav-link" href="index.php?path=connexion" id="connexion">Connexion</a></li>
                    <?php
                } ?>
            </ul>
            
            <!-- Mobile Menu Toggle -->
            <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                <span id="menu-icon">☰</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobile-menu">
        <div class="mobile-nav-menu">
            <a href="index.php?path=accueil" class="mobile-nav-link active" onclick="closeMobileMenu()">🏠 Accueil</a>
            
            <?php
            if (isset($_SESSION['auth']) && $_SESSION['auth']==true) {
                ?>
                <a href="#" class="mobile-nav-link" onclick="toggleMobileDropdown()">⚙️ Fonctionnalités ▼</a>
                <div class="mobile-dropdown" id="mobile-dropdown">
                <?php
                if ($_SESSION['admin'] == 1) {
                    ?>
                    <a class="mobile-dropdown-item" href="index.php?path=question">❓ Gestion des Questions</a>
                    <?php
                    if ($_SESSION['super_admin'] == 1) {
                        ?>
                        <a class="mobile-dropdown-item" href="index.php?path=enseignant">👤 Gestion des Enseignants</a>
                        <a class="mobile-dropdown-item" href="index.php?path=matiere">📚 Gestion des Matieres</a>
                        <a class="mobile-dropdown-item" href="index.php?path=classe">👥 Gestion des Classes</a>
                        <a class="mobile-dropdown-item" href="index.php?path=filiere">🗃️ Gestion des Filieres</a>
                        <a href="#statistiques" class="mobile-dropdown-item">📊 Statistiques</a>
                        <a href="#parametres" class="mobile-dropdown-item">⚙️ Paramètres</a>
                    <?php
                    }
                }
                ?>
                </div>
            <?php
            }
            ?>
            <a href="index.php?path=apropos" class="mobile-nav-link" onclick="closeMobileMenu()">📖 À propos</a>
            <a href="index.php?path=contact" class="mobile-nav-link" onclick="closeMobileMenu()">📧 Contact</a>
            <?php
            if (isset($_SESSION['auth']) && $_SESSION['auth']==true) {
                ?>
                <a class="mobile-nav-link" href="index.php?path=deconnexion">Déconnexion</a>
                <?php
            }else{
                ?>
                <a class="mobile-nav-link" href="index.php?path=connexion">Connexion</a>
                <?php
            } ?>
        </div>
    </div>

    <script>

        const currentUrl = window.location.href; // Récupère l'URL complète
    
        console.log("Chemin principale = ", getMainPath(currentUrl));
    
        //suppression de la classe active
        const elements = document.querySelectorAll('.nav-link');
        elements.forEach(function(element) {
            element.classList.remove('active'); // Supprime 'ma-classe' de chaque élément
        });
        // const mobile_elements = document.querySelectorAll('.mobile-nav-link');
        // elements.forEach(function(element) {
        //     mobile_elements.classList.remove('active'); // Supprime 'ma-classe' de chaque élément
        // });
    
        //activation de l'onglet courant
        let currentOnglet = document.getElementById(''+currentUrl)
        
        // currentOnglet.classList.toggle('active');
        currentOnglet.style.color = 'red';
        console.log(currentOnglet)
            
            
        function getMainPath(url) {
        
            const urlObj = new URL(url); // Crée un objet URL
            const path = urlObj.searchParams.get('path'); // Récupère le paramètre 'path'
            
            if (path) {
                const mainPath = path.split('/')[0]; // Prend le premier segment
                return mainPath; // Retourne le path principal
            }
            
            return null; // Retourne null si le paramètre 'path' n'existe pas
        }
    </script>