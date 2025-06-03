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
            <h1 class="page-title">📚 Gestion des Classes</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les classes de votre plateforme d'apprentissage. 🎯
            </p>
        </div>

        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une classe..." 
                       onkeyup="filterSubjects()" id="searchInput">
                <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Toutes les spécialités</option>
                    <?php
                    while ($specialite = $specialites->fetch()) {
                        if ($type['id'] < 3) {
                            ?>
                            <option value="<?=$specialite['id']?>"><?=$specialite['nom']?></option>
                        <?php }
                    }
                    ?>
                </select>
            </div>
            <button class="add-btn" id="show" onclick="openModal()">
                ➕ Ajouter une classe
            </button>
        </div>

        <section class="drap" id="drap" onclick="stopMe()">
            <div class="user_form">
                <form action="index.php?path=classe" method="post" id="user_form">
                    <label for="">Nom de la classe : </label><br>
                    <input type="text" name="intitule" class="filter-input" required><br><br>
                    <label for="">Spécialité : </label><br>
                    <select name="sp" id="" class="filter-select" required>
                    <?php
                    while ($sp = $specialites2->fetch()) {
                        ?>
                        <option value="<?=$sp['id']?>"><?=$sp['nom']?></option>
                        <?php
                    }
                    ?>
                    </select><br><br>
    
                    <label for="">Cycle : </label><br>
                    <select name="cycle" id="" class="filter-select" required>
                    <?php
                    while ($cl = $cycles->fetch()) {
                        ?>
                        <option value="<?=$cl['id']?>"><?=$cl['intitule']?></option>
                        <?php
                    }
                    ?>
                    </select><br><br>
                    <label for="">Matierès consernées</label><br>
                    <div class="classement">
                    <?php
                    while ($une_mt = $matieres->fetch()) {
                        ?>
                        <span><input class="element" type="checkbox" name="<?=$une_mt['id']?>"><?=$une_mt['nom']?></span>
                        <?php
                    }
                    ?></div><br>
    
                    <input type="submit" value="valider" name="valider">
                    <button id="hide">Annuler</button>
                </form>
            </div>
        </section>

        <div class="subjects-grid2">
            <h2>Liste des classes</h2>
            <div id="contenu">
                <?php
                while ($classe = $classes->fetch()) {
                    ?>
                    <div class="subject-card"
                        data_intitule="<?=htmlspecialchars($classe['intitule'], ENT_QUOTES, 'UTF-8')?>" 
                        data_reponse="<?=htmlspecialchars($classe['id'], ENT_QUOTES, 'UTF-8')?>" 
                        data_text="<?=htmlspecialchars($classe['id_specialite'], ENT_QUOTES, 'UTF-8')?>">
                        <div class="subject-header">
                            <div>
                                <div class="subject-icon">📖</div>
                                <h3 class="subject-title matiere" value="<?=$classe['id']?>" data-email="<?=htmlspecialchars($classe['intitule'], ENT_QUOTES, 'UTF-8')?>"><?=$classe['intitule']?></h3>
                            </div>
                            <div class="subject-actions">
                                <button class="action-btn edit-btn updateb" value="<?=$classe['id']?>" title="Modifier">✏️</button>
                                <button class="action-btn delete-btn deleteb" value="<?=$classe['id']?>" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>
</div>


<script>
    var option = document.getElementsByClassName('updateb')
    for (let index = 0; index < option.length; index++) {
        option[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/update/updateClasse.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }
    var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#contenu').load('view/administration/delete/deleteClasse.php?id='+id)

        })
    }


    // Fonction de recherche multicritère pour les enseignants
function initializeTeacherSearch() {
    const searchInput = document.getElementById('searchInput');
    const levelFilter = document.getElementById('levelFilter');
    const contenu = document.getElementById('contenu');
    
    // Créer le message "aucun résultat" une seule fois
    const noResultsMessage = document.createElement('div');
    noResultsMessage.className = 'no-results-message';
    noResultsMessage.innerHTML = `
        <div style="text-align: center; padding: 40px; color: #666;">
            <div style="font-size: 48px; margin-bottom: 16px;">👨‍🏫</div>
            <h3 style="margin: 0 0 8px 0;">Aucune classe trouvée</h3>
            <p style="margin: 0;">Essayez de modifier vos critères de recherche</p>
        </div>
    `;
    noResultsMessage.style.display = 'none';
    contenu.appendChild(noResultsMessage);
    
    // Fonction principale de filtrage
    function filterTeachers() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedType = levelFilter.value;
        const teacherCards = document.querySelectorAll('.subject-card');
        let visibleCount = 0;
        
        teacherCards.forEach(card => {
            const nom = card.getAttribute('data_intitule') ? card.getAttribute('data_intitule').toLowerCase() : '';
            const email = card.getAttribute('data_reponse') ? card.getAttribute('data_reponse').toLowerCase() : '';
            const typeEnseignant = card.getAttribute('data_text');
            
            let matchesSearch = true;
            let matchesType = true;
            
            // Vérifier la correspondance avec le texte de recherche (nom ou email)
            if (searchTerm !== '') {
                matchesSearch = nom.includes(searchTerm) || email.includes(searchTerm);
            }
            
            // Vérifier la correspondance avec le type sélectionné
            if (selectedType !== '' && selectedType !== 'all') {
                matchesType = typeEnseignant === selectedType;
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
            counter.textContent = `${total} classe${total > 1 ? 's' : ''} au total`;
        } else {
            counter.textContent = `${visible} classe${visible > 1 ? 's' : ''} trouvée${visible > 1 ? 's' : ''} sur ${total}`;
        }
    }
    
    // Fonction pour réinitialiser la recherche
    function resetSearch() {
        searchInput.value = '';
        levelFilter.value = '';
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
    
    levelFilter.addEventListener('change', filterTeachers);
    
    // Initialiser le compteur
    filterTeachers();
}

// Initialiser la recherche quand le DOM est chargé
document.addEventListener('DOMContentLoaded', initializeTeacherSearch);
</script>