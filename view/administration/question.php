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
            <h1 class="page-title">📚 Gestion des Questions</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les questions de votre plateforme d'apprentissage. 🎯
            </p>
        </div>

        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une question..." 
                       id="searchInput">
                <select class="filter-select" id="levelFilter">
                    <option value="">Toutes les matières</option>
                <?php print_r($matieres);
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

    <?php
    if (isset($msg)) {
        echo $msg;
    }        
    ?>
    <div class="subjects-grid2">
    <?php
        if ($questions->rowCount() > 0) {
            echo '<h2>Liste des questions</h2>';
            echo '<div class="contenu">';
while ($une_qs = $questions->fetch()) {
    ?>
    <div class="subject-card" 
         data_intitule="<?=htmlspecialchars($une_qs['intitule'], ENT_QUOTES, 'UTF-8')?>" 
         data_reponse="<?=htmlspecialchars($une_qs['proposition_'.$une_qs['reponse']], ENT_QUOTES, 'UTF-8')?>" 
         data_text="<?=$une_qs['id_matiere']?>" 
         style="width: 360px; height: 360px; overflow: hidden;">
        <div class="subject-header">
            <div>
                <div class="subject-icon">📖</div>
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
    // Fonction de recherche multicritère
function initializeSearch() {
    const searchInput = document.getElementById('searchInput');
    const levelFilter = document.getElementById('levelFilter');
    const contenu = document.querySelector('.contenu');
    
    // Créer le message "aucun résultat" une seule fois
    const noResultsMessage = document.createElement('div');
    noResultsMessage.className = 'no-results-message';
    noResultsMessage.innerHTML = `
        <div style="text-align: center; padding: 40px; color: #666;">
            <div style="font-size: 48px; margin-bottom: 16px;">🔍</div>
            <h3 style="margin: 0 0 8px 0;">Aucune question trouvée</h3>
            <p style="margin: 0;">Essayez de modifier vos critères de recherche</p>
        </div>
    `;
    noResultsMessage.style.display = 'none';
    contenu.appendChild(noResultsMessage);
    
    // Fonction principale de filtrage
    function filterQuestions() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedMatiere = levelFilter.value;
        const questionCards = document.querySelectorAll('.subject-card');
        let visibleCount = 0;
        
        questionCards.forEach(card => {
            const intitule = card.getAttribute('data_intitule') ? card.getAttribute('data_intitule').toLowerCase() : '';
            const reponse = card.getAttribute('data_reponse') ? card.getAttribute('data_reponse').toLowerCase() : '';
            const idMatiere = card.getAttribute('data_text');
            
            let matchesSearch = true;
            let matchesMatiere = true;
            
            // Vérifier la correspondance avec le texte de recherche
            if (searchTerm !== '') {
                matchesSearch = intitule.includes(searchTerm) || reponse.includes(searchTerm);
            }
            
            // Vérifier la correspondance avec la matière sélectionnée
            if (selectedMatiere !== '' && selectedMatiere !== 'all') {
                matchesMatiere = idMatiere === selectedMatiere;
            }
            
            // Afficher ou masquer la carte selon les critères
            if (matchesSearch && matchesMatiere) {
                card.style.display = 'block';
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
    }
    
    // Ajouter les écouteurs d'événements
    searchInput.addEventListener('input', filterQuestions);
    searchInput.addEventListener('keyup', filterQuestions);
    levelFilter.addEventListener('change', filterQuestions);
    
    // Fonction pour réinitialiser la recherche
    function resetSearch() {
        searchInput.value = '';
        levelFilter.value = '';
        filterQuestions();
    }
    
    // Optionnel : ajouter un bouton de réinitialisation
    const resetButton = document.createElement('button');
    resetButton.innerHTML = '🔄 Réinitialiser';
    resetButton.className = 'reset-btn';
    resetButton.style.cssText = `
        margin-left: 10px;
        padding: 8px 16px;
        background-color: #f0f0f0;
        border: 1px solid #ddd;
        border-radius: 4px;
        cursor: pointer;
        font-size: 14px;
    `;
    resetButton.addEventListener('click', resetSearch);
    
    // Insérer le bouton après le select
    //levelFilter.parentNode.insertBefore(resetButton, levelFilter.nextSibling);
}

// Initialiser la recherche quand le DOM est chargé
document.addEventListener('DOMContentLoaded', initializeSearch);
</script>