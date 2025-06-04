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
            <h1 class="page-title">👤 Gestion des Utilisateur</h1>
            <p class="page-subtitle">
                Organisez et gérez tout le corps enseignant et les joueurs de votre plateforme d'apprentissage. 🎯
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
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher un enseignant..." 
                    id="searchInput">
                <select class="filter-select" id="levelFilter">
                    <option value="">Tous les utilisateurs</option>
                    <?php
                    while ($type = $types->fetch()) {
                        if ($type['id'] < 3) {
                            ?>
                            <option value="<?=$type['id']?>"><?=$type['intitule']?></option>
                        <?php }
                    }
                    ?>
                </select>
            </div>
            <button class="add-btn" id="show" onclick="openModal()">
                ➕ Ajouter un enseignant
            </button>
        </div>

        <section class="drap" id="drap" onclick="stopMe()">
            <div class="user_form">
                <form action="index.php?path=enseignant" method="post" id="user_form">
                    <label for="">Email : </label><br>
                    <input type="email" name="email" class="filter-input" required><br><br>
                    <label for="">Nom : </label><br>
                    <input type="text" name="nom" class="filter-input" required><br><br>
                    <label for="">Type : </label><br>
                    <select name="type" class="filter-select" id="type">
                        <option value="1" selected>Joueur</option>
                        <option value="2">Enseignant</option>
                    </select><br><br>
                    <span id="type_on" style="display: none;">
                        <label for="">Matiere : </label><br>
                        <div class="classement">
                        <?php
                        while ($une_matiere = $matieres->fetch()) {
                            ?>
                            <span><input type="checkbox" name="<?=$une_matiere['id']?>"><?=$une_matiere['nom']?></span>
                            <?php
                        }
                        ?>
                        </div><br>
                    </span>
                    <input type="submit" name="valider" value="valider">
                    <button id="hide">Annuler</button>
                </form>
            </div>
        </section>

        <div class="subjects-grid2">
        <h2>Liste des Utilisateurs</h2>

            <!-- Affichage des enseignants -->
            <div id="contenu" class="contenu">
                <?php
                if ($enseignants && $enseignants->rowCount() > 0) {
                    while ($eng = $enseignants->fetch()) {
                        if ($eng['type'] < 3) {
                            ?>
                            <div class="subject-card"
                                data_intitule="<?=htmlspecialchars($eng['nom'], ENT_QUOTES, 'UTF-8')?>" 
                                data_reponse="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
                                data_text="<?=htmlspecialchars($eng['type'], ENT_QUOTES, 'UTF-8')?>">
                                
                                <div class="subject-header">
                                    <div>
                                        <div class="subject-icon">👨‍🏫</div>
                                        <h3 class="subject-title matiere" data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>">
                                            <?=htmlspecialchars($eng['nom'], ENT_QUOTES, 'UTF-8')?>
                                        </h3>
                                    </div>
                                    <div class="subject-actions">
                                        <button class="action-btn edit-btn updateb" 
                                                data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
                                                title="Modifier" value="<?=$eng['email']?>">✏️</button>
                                        <button class="action-btn delete-btn deleteb" 
                                                data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
                                                title="Supprimer" value="<?=$eng['email']?>">🗑️</button>
                                    </div>
                                </div>
                                <div class="teacher-info">
                                    <p class="teacher-email">📧 <?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?></p>
                                    <?php if (isset($eng['type_intitule'])): ?>
                                        <p class="teacher-type">🏷️ <?=htmlspecialchars($eng['type_intitule'], ENT_QUOTES, 'UTF-8')?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="no-teachers-message" style="text-align: center; padding: 40px; color: #666;">
                        <div style="font-size: 48px; margin-bottom: 16px;">👨‍🏫</div>
                        <h3>Aucun enseignant enregistré</h3>
                        <p>Commencez par ajouter des enseignants à votre système.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>

    </div>


<script>

    document.getElementById('type').addEventListener('change', function(){
        const verify = document.getElementById('type').value
        let box_mat = document.getElementById('type_on')
        if (verify == 1) {
            box_mat.style.display = 'none'
        }else{
            box_mat.style.display = 'block'
        }
    })

    var option = document.getElementsByClassName('updateb')
    for (let index = 0; index < option.length; index++) {
        option[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/update/updateEnseignant.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }
    var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#contenu').load('view/administration/delete/deleteEnseignant.php?id='+id)
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
            <h3 style="margin: 0 0 8px 0;">Aucun utilisateur trouvé</h3>
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
            counter.textContent = `${total} utilisateur${total > 1 ? 's' : ''} au total`;
        } else {
            counter.textContent = `${visible} utilisateur${visible > 1 ? 's' : ''} trouvé${visible > 1 ? 's' : ''} sur ${total}`;
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