

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

        // Animation des statistiques
        function animateStats() {
            const counters = document.querySelectorAll('.stat-number');
            counters.forEach(counter => {
                const target = counter.textContent.replace(/[^\d]/g, '');
                const increment = target / 100;
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    
                    if (counter.id === 'success-rate') {
                        counter.textContent = Math.floor(current) + '%';
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 20);
            });
        }

        // Fonctions interactives
        function startQuiz() {
            document.getElementById('start_game').style.display='block';
            document.getElementById('arriere_plan').style.display='block';
        }

        

        function stopQuiz() {
            document.getElementById('start_game').style.display='none';
            document.getElementById('arriere_plan').style.display='none';
        }
        
        function showFeature(feature) {
            const messages = {
                vote: '🗳️ Le vote de classe vous permet de voir ce que pensent vos camarades virtuels. Une aide précieuse quand vous hésitez !',
                help: '📞 Besoin d\'un coup de main ? Votre professeur virtuel est là pour vous donner un indice bienveillant.',
                fifty: '⚡ Le 50/50 élimine deux mauvaises réponses pour vous faciliter le choix. Utilisez-le judicieusement !'
            };
            
            alert(messages[feature]);
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', function() {
            createStars();
            setTimeout(animateStats, 1000);
        });

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
    
