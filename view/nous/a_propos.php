<?php
require_once('view/layout/nav_bar.php');

?>

    <div class="stars" id="stars"></div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">📖 À propos d'EduQuiz</h1>
            <p class="page-subtitle">Découvrez notre vision de l'éducation moderne</p>
        </div>

        <div class="about-content">
            <div class="about-section">
                <h2 class="section-title">🌟 Notre Histoire</h2>
                <p class="section-text">
                    EduQuiz est né d'un constat simple : l'évaluation traditionnelle ne permet pas toujours aux étudiants 
                    de révéler leur plein potentiel. Face aux défis de l'éducation moderne, particulièrement en Afrique, 
                    nous avons imaginé une solution qui transforme l'apprentissage en une expérience engageante et ludique.
                    <br><br>
                    Notre plateforme combine les meilleures pratiques pédagogiques avec les technologies numériques 
                    les plus avancées, créant un environnement d'apprentissage où chaque étudiant peut progresser 
                    à son rythme tout en s'amusant.
                </p>
            </div>

            <div class="mission-vision">
                <div class="mission-card">
                    <div class="card-icon">🎯</div>
                    <h3 class="card-title">Notre Mission</h3>
                    <p class="card-text">
                        Révolutionner l'évaluation académique en créant une plateforme interactive qui stimule 
                        l'engagement étudiant et améliore les performances d'apprentissage grâce à la gamification 
                        et aux outils collaboratifs.
                    </p>
                </div>
                
                <div class="vision-card">
                    <div class="card-icon">🔮</div>
                    <h3 class="card-title">Notre Vision</h3>
                    <p class="card-text">
                        Devenir la référence en matière d'évaluation éducative interactive en Afrique, 
                        en créant un écosystème où l'apprentissage devient une aventure passionnante 
                        accessible à tous les étudiants.
                    </p>
                </div>
            </div>

            <div class="values-section">
                <h2 class="section-title">💎 Nos Valeurs</h2>
                <div class="values-grid">
                    <div class="value-item">
                        <div class="value-icon">🎓</div>
                        <h4 class="value-title">Excellence Académique</h4>
                        <p class="value-desc">Nous nous engageons à maintenir les plus hauts standards éducatifs</p>
                    </div>
                    
                    <div class="value-item">
                        <div class="value-icon">🤝</div>
                        <h4 class="value-title">Collaboration</h4>
                        <p class="value-desc">L'apprentissage collaboratif est au cœur de notre approche</p>
                    </div>
                    
                    <div class="value-item">
                        <div class="value-icon">🚀</div>
                        <h4 class="value-title">Innovation</h4>
                        <p class="value-desc">Nous repoussons constamment les limites de l'éducation numérique</p>
                    </div>
                    
                    <div class="value-item">
                        <div class="value-icon">🌍</div>
                        <h4 class="value-title">Accessibilité</h4>
                        <p class="value-desc">L'éducation de qualité doit être accessible à tous</p>
                    </div>
                    
                    <div class="value-item">
                        <div class="value-icon">🎮</div>
                        <h4 class="value-title">Ludification</h4>
                        <p class="value-desc">Apprendre en s'amusant pour une motivation durable</p>
                    </div>
                    
                    <div class="value-item">
                        <div class="value-icon">📈</div>
                        <h4 class="value-title">Amélioration Continue</h4>
                        <p class="value-desc">Nous évoluons constamment grâce aux retours utilisateurs</p>
                    </div>
                </div>
            </div>

            <div class="team-section">
                <div class="team-intro">
                    <h2 class="section-title">👥 Notre Équipe</h2>
                    <p class="section-text">
                        EduQuiz est le fruit du travail d'une équipe passionnée de développeurs, d'éducateurs et de 
                        spécialistes en technologies éducatives. Unis par une vision commune, nous mettons notre 
                        expertise au service de l'amélioration de l'éducation en Afrique.
                        <br><br>
                        Chaque membre de notre équipe apporte son expérience unique pour créer une plateforme qui 
                        répond véritablement aux besoins des étudiants et des enseignants d'aujourd'hui.
                    </p>
                </div>
            </div>

            <div class="about-section">
                <h2 class="section-title">🔮 L'Avenir d'EduQuiz</h2>
                <p class="section-text">
                    Nous travaillons continuellement à l'amélioration de notre plateforme. Nos prochaines évolutions 
                    incluront l'intégration de l'intelligence artificielle pour la génération automatique de questions 
                    à partir de documents PDF, l'expansion vers de nouvelles matières et l'ajout d'outils d'analyse 
                    avancée pour les enseignants.
                    <br><br>
                    Notre objectif est de créer un écosystème éducatif complet où chaque interaction contribue à 
                    l'amélioration de l'expérience d'apprentissage pour tous.
                </p>
            </div>
        </div>

        <div class="cta-section">
            <a href="index.html" class="cta-button">Découvrir EduQuiz 🚀</a>
        </div>
    </div>

    <script>
        // Création des étoiles scintillantes
        function createStars() {
            const starsContainer = document.getElementById('stars');
            const numberOfStars = 50;

            for (let i = 0; i < numberOfStars; i++) {
                const star = document.createElement('div');
                star.className = 'star';
                star.style.left = Math.random() * 100 + '%';
                star.style.top = Math.random() * 100 + '%';
                star.style.width = Math.random() * 3 + 1 + 'px';
                star.style.height = star.style.width;
                star.style.animationDelay = Math.random() * 2 + 's';
                starsContainer.appendChild(star);
            }
        }

        // Fonctions de navigation mobile
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            
            if (mobileMenu.classList.contains('active')) {
                mobileMenu.classList.remove('active');
                menuIcon.textContent = '☰';
            } else {
                mobileMenu.classList.add('active');
                menuIcon.textContent = '✕';
            }
        }

        function closeMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            mobileMenu.classList.remove('active');
            menuIcon.textContent = '☰';
        }

        function toggleMobileDropdown() {
            const dropdown = document.getElementById('mobile-dropdown');
            dropdown.classList.toggle('active');
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            createStars();
        });

        // Fermer le menu mobile si on clique en dehors
        document.addEventListener('click', function(event) {
            const mobileMenu = document.getElementById('mobile-menu');
            const toggleButton = document.querySelector('.mobile-menu-toggle');
            
            if (!mobileMenu.contains(event.target) && !toggleButton.contains(event.target)) {
                closeMobileMenu();
            }
        });

        // Animation de la navbar au scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            const scrolled = window.pageYOffset;
            
            if (scrolled > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.98)';
                navbar.style.boxShadow = '0 2px 20px rgba(0,0,0,0.1)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.95)';
                navbar.style.boxShadow = 'none';
            }
            
            // Effet de parallaxe leger sur les étoiles
            const stars = document.getElementById('stars');
            stars.style.transform = `translateY(${scrolled * 0.5}px)`;
        });
    </script>
</body>
</html>