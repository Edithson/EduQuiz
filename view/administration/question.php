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
            <h1 class="page-title">❓ Gestion des Questions</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les questions de votre plateforme d'apprentissage. 🎯
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
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une question..." 
                       id="searchInput">
                <select class="filter-select" id="levelFilter">
                    <option value="">Toutes les matières</option>
                <?php
                    while ($matiere = $matieres->fetch()) {
                        ?>
                        <option value="<?=$matiere['id_matiere']?>"><?=$matiere['nom_matiere']?></option>
                    <?php }
                    ?>
                </select>
            </div>
            <a href="index.php?path=question/create">
                <button class="add-btn">
                    ➕ Ajouter une question
                </button>
            </a>
        </div>

    <div class="subjects-grid2">
    <?php
        if ($questions->rowCount() > 0) {
            echo '<h2>Liste des questions</h2>';
            echo '<div id="contenu" class="contenu">';
            while ($une_qs = $questions->fetch()) {
                ?>
                <div class="subject-card" 
                    data_intitule="<?=htmlspecialchars($une_qs['intitule'], ENT_QUOTES, 'UTF-8')?>" 
                    data_reponse="<?=htmlspecialchars($une_qs['proposition_'.$une_qs['reponse']], ENT_QUOTES, 'UTF-8')?>" 
                    data_text="<?=$une_qs['id_matiere']?>" 
                    style="width: 360px; height: 360px; overflow: hidden;">
                    <div class="subject-header">
                        <div>
                            <div class="subject-icon">❓</div>
                            <h3 class="subject-title matiere" value="<?=$une_qs['id']?>">
                                <?=(substr($une_qs['intitule'], 0, 100)); ?>
                            </h3>
                        </div>
                        <div class="subject-actions">
                            <a href="index.php?path=question/edit&id=<?=$une_qs['id']?>">
                                <button class="action-btn edit-btn" title="Modifier">✏️</button>
                            </a>
                            <a href="index.php?path=question/delete&id=<?=$une_qs['id']?>">
                                <button class="action-btn delete-btn deleteb" title="Supprimer">🗑️</button>
                            </a>
                        </div>
                    </div>
                    <p>Réponse = <?=$une_qs['proposition_'.$une_qs['reponse']]?></p>
                </div>
                <?php
            }
            echo '</div>';
        }else {
            echo '<h2>Aucunes questions trouvées pour cette matière</h2>';
        } ?>
    </div>

<script>

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
            <div style="font-size: 48px; margin-bottom: 16px;">❓</div>
            <h3 style="margin: 0 0 8px 0;">Aucune question trouvée</h3>
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
            counter.textContent = `${total} question${total > 1 ? 's' : ''} au total`;
        } else {
            counter.textContent = `${visible} question${visible > 1 ? 's' : ''} questionvé${visible > 1 ? 's' : ''} sur ${total}`;
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