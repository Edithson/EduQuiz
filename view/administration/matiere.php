<?php
require_once('view/layout/nav_bar.php');
?>

<div class="stars" id="stars"></div>
    
    <div class="floating-elements">
        <div class="floating-book">📚</div>
        <div class="floating-atom">⚛️</div>
        <div class="floating-globe">🌍</div>
    </div>

    <div class="container">
        <div class="page-header">
            <h1 class="page-title">📚 Gestion des Matières</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les matières de votre plateforme d'apprentissage. 
                Créez, modifiez et suivez les performances de chaque discipline ! 🎯
            </p>
        </div>

        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une matière..." 
                       id="searchInput">
            </div>
            <button class="add-btn" id="show" onclick="openModal()">
                ➕ Ajouter une matière
            </button>
        </div>


        <section class="drap" id="drap" onclick="stopMe()">
            <div class="user_form">
                <form action="index.php?path=matiere" method="post" id="user_form">
                    <label for="">Nom du cour : </label><br>
                    <input type="text" name="nom" class="filter-input" required><br><br>
                    <label for="">Description : </label><br>
                    <textarea name="desc" id="" cols="20" rows="2" placeholder="facultative" class="filter-input"></textarea><br><br>
    
                    <label for="">Classes consernées</label>
                    <div class="classement">
                    <?php
                    while ($une_classe = $classes->fetch()) {
                        ?>
                        <span><input type="checkbox" name="cls_".<?php echo(''.$une_classe['id'])?>><?=$une_classe['intitule']?></span>
                        <?php
                    }
                    ?></div><br>
    
                    <label for="">Enseignants consernés</label>
                    <div class="classement">
                    <?php
                    while ($un_eng = $engs->fetch()) {
                        ?>
                        <span><input type="checkbox" name="<?php echo(''.$un_eng['nom'])?>"><?=$un_eng['nom']?></span>
                        <?php
                    }
                    ?></div><br>
    
                    <input type="submit" value="valider" name="valider">
                    <button id="hide">Annuler</button>
                </form>
            </div>
        </section>

        <div class="subjects-grid2">
            <div id="contenu">
                <?php
                while ($une_matiere = $matieres->fetch()) {
                    ?>
                    <div class="subject-card" style="height: 270px; overflow: hidden;"
                            data_intitule="<?=htmlspecialchars($une_matiere['description'], ENT_QUOTES, 'UTF-8')?>" 
                            data_reponse="<?=htmlspecialchars($une_matiere['nom'], ENT_QUOTES, 'UTF-8')?>" >
                        <div class="subject-header">
                            <div>
                                <div class="subject-icon">📖</div>
                                <h3 class="subject-title matiere" value="<?=$une_matiere['id']?>"><?=$une_matiere['nom']?></h3>
                            </div>
                            <div class="subject-actions">
                                <button class="action-btn edit-btn updateb" value="<?=$une_matiere['id']?>" title="Modifier">✏️</button>
                                <button class="action-btn delete-btn deleteb" value="<?=$une_matiere['id']?>" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                        <p><?=substr($une_matiere['description'], 0, 50)?></p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>

<script>
    var option = document.getElementsByClassName('updateb')
    for (let index = 0; index < option.length; index++) {
        option[index].addEventListener('click', function(e){
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            })
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/update/updateMatiere.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }
    var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/delete/deleteMatiere.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }


    // Fonction de recherche multicritère pour les enseignants
    function initializeTeacherSearch() {
        const searchInput = document.getElementById('searchInput');
        const contenu = document.getElementById('contenu');
        
        // Créer le message "aucun résultat" une seule fois
        const noResultsMessage = document.createElement('div');
        noResultsMessage.className = 'no-results-message';
        noResultsMessage.innerHTML = `
            <div style="text-align: center; padding: 40px; color: #666;">
                <div style="font-size: 48px; margin-bottom: 16px;">👨‍🏫</div>
                <h3 style="margin: 0 0 8px 0;">Aucune matière trouvée</h3>
                <p style="margin: 0;">Essayez de modifier vos critères de recherche</p>
            </div>
        `;
        noResultsMessage.style.display = 'none';
        contenu.appendChild(noResultsMessage);
        
        // Fonction principale de filtrage
        function filterTeachers() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const teacherCards = document.querySelectorAll('.subject-card');
            let visibleCount = 0;
            
            teacherCards.forEach(card => {
                const nom = card.getAttribute('data_intitule') ? card.getAttribute('data_intitule').toLowerCase() : '';
                const email = card.getAttribute('data_reponse') ? card.getAttribute('data_reponse').toLowerCase() : '';
                
                let matchesSearch = true;
                let matchesType = true;
                
                // Vérifier la correspondance avec le texte de recherche (nom ou email)
                if (searchTerm !== '') {
                    matchesSearch = nom.includes(searchTerm) || email.includes(searchTerm);
                }
                
                // Afficher ou masquer la carte selon les critères
                if (matchesSearch && matchesType) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Afficher/masquer le message "aucun résultat"
            if (visibleCount === 0) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
            
            // Mettre à jour le compteur (optionnel)
            updateResultsCounter(visibleCount, teacherCards.length);
        }
        
        // Fonction pour afficher le nombre de résultats (optionnel)
        function updateResultsCounter(visible, total) {
            let counter = document.getElementById('results-counter');
            if (!counter) {
                counter = document.createElement('div');
                counter.id = 'results-counter';
                counter.style.cssText = `
                    margin: 10px 0;
                    padding: 8px 12px;
                    border-radius: 4px;
                    font-size: 14px;
                    color:rgb(8, 8, 8);
                    text-align: center;
                `;
                contenu.parentNode.insertBefore(counter, contenu);
            }
            
            if (visible === total) {
                counter.textContent = `${total} filière${total > 1 ? 's' : ''} au total`;
            } else {
                counter.textContent = `${visible} filière${visible > 1 ? 's' : ''} trouvée${visible > 1 ? 's' : ''} sur ${total}`;
            }
        }
        
        // Fonction pour réinitialiser la recherche
        function resetSearch() {
            searchInput.value = '';
            filterTeachers();
        }
        
        // Fonction pour surligner les termes de recherche (optionnel)
        function highlightSearchTerm() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const teacherCards = document.querySelectorAll('.subject-card:not([style*="display: none"])');
            
            teacherCards.forEach(card => {
                const titleElement = card.querySelector('.subject-title');
                const emailElement = card.querySelector('p');
                
                if (searchTerm !== '') {
                    // Surligner dans le nom
                    if (titleElement) {
                        const originalText = titleElement.textContent;
                        const highlightedText = originalText.replace(
                            new RegExp(`(${searchTerm})`, 'gi'),
                            '<mark style="background-color: #ffeb3b; padding: 1px 2px;">$1</mark>'
                        );
                        titleElement.innerHTML = highlightedText;
                    }
                    
                    // Surligner dans l'email
                    if (emailElement) {
                        const originalText = emailElement.textContent;
                        const highlightedText = originalText.replace(
                            new RegExp(`(${searchTerm})`, 'gi'),
                            '<mark style="background-color: #ffeb3b; padding: 1px 2px;">$1</mark>'
                        );
                        emailElement.innerHTML = highlightedText;
                    }
                }
            });
        }
        
        // Ajouter les écouteurs d'événements
        searchInput.addEventListener('input', () => {
            filterTeachers();
            highlightSearchTerm();
        });
        
        searchInput.addEventListener('keyup', () => {
            filterTeachers();
            highlightSearchTerm();
        });
        
        // Initialiser le compteur
        filterTeachers();
    }

    // Initialiser la recherche quand le DOM est chargé
    document.addEventListener('DOMContentLoaded', initializeTeacherSearch);


</script>
