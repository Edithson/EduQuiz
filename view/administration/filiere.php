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
            <h1 class="page-title">🗃️ Gestion des Filières</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les filières de votre plateforme d'apprentissage. 🎯
            </p>
        </div>
        <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une filière..." 
                    id="searchInput">
            </div>
            <button class="add-btn" id="show" onclick="openModal()">
                ➕ Ajouter une filière
            </button>
        </div>

        <section class="drap" id="drap" onclick="stopMe()">
            <div class="user_form">
            <form action="index.php?path=filiere" method="post" id="user_form">
                <label for="">Nom de la Spécialité : </label><br>
                <input type="text" name="sp" id="" class="filter-input" required><br><br>
                <label for="">Description de la Spécialité : </label><br>
                <textarea name="desc" id="" cols="20" rows="3" placeholder="facultative" class="filter-input"></textarea><br><br>
                <input type="submit" value="Valider" name="valider">
            </form>
            <button id="hide">Annuler</button>
            </div>


        </section>

        <div class="subjects-grid2">

            <h2>Liste des filières</h2>
            <div id="contenu">
                <?php
                while ($filiere = $specialites->fetch()) {
                    ?>
                    <div class="subject-card" style="height: 270px; overflow: hidden;"
                        data_intitule="<?=htmlspecialchars($filiere['description'], ENT_QUOTES, 'UTF-8')?>" 
                        data_reponse="<?=htmlspecialchars($filiere['nom'], ENT_QUOTES, 'UTF-8')?>" 
                        >
                        <div class="subject-header" style="height: 200px;">
                            <div>
                                <div class="subject-icon">🗃️</div>
                                <h3 class="subject-title matiere" value="<?=$filiere['id']?>"><?=substr($filiere['nom'], 0, 30)?></h3>
                            </div>
                            <div class="subject-actions">
                                <button class="action-btn edit-btn updateb" value="<?=$filiere['id']?>" title="Modifier">✏️</button>
                                <button class="action-btn delete-btn deleteb" value="<?=$filiere['id']?>" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                        <p style="margin-top: -30px;"><?=substr($filiere['description'], 0, 50)?></p>
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
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/update/updateFiliere.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }
    var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#contenu').load('view/administration/delete/deleteFiliere.php?id='+id)
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
            <div style="font-size: 48px; margin-bottom: 16px;">🗃️</div>
            <h3 style="margin: 0 0 8px 0;">Aucune filière trouvée</h3>
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