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
                       onkeyup="filterSubjects()" id="searchInput">
                <!-- <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select> -->
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
                <div class="subject-card" style="width: 360px; height: 360px;">
                    <div class="subject-header">
                        <div>
                            <div class="subject-icon">📖</div>
                            <h3 class="subject-title matiere" value="<?=$une_qs['id']?>"><?php echo(substr($une_qs['intitule'], 0, 700)) ?></h3>
                        </div>
                        <div class="subject-actions">
                            <a href="index.php?path=question/edit&id=<?=$une_qs['id']?>"><button class="action-btn edit-btn" title="Modifier">✏️</button></a>
                            <a href="index.php?path=question/delete&id=<?=$une_qs['id']?>"><button class="action-btn delete-btn deleteb" title="Supprimer">🗑️</button></a>
                            
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
    matiere = document.getElementById('matiere').value
    if (matiere!=0) {
        $('#questions').load('view/administration/question_action.php?matiere='+matiere)
    }
    document.getElementById('matiere').addEventListener('click', function(){
        matiere = document.getElementById('matiere').value
        if (matiere!=0) {
            $('#questions').load('view/administration/question_action.php?matiere='+matiere)
        }
    })
    var x=0
    document.getElementById('check').addEventListener('click', function(e){
        if (x==0) {
            document.getElementById('nav_bar').style.marginLeft='0px';
            x=1
        }else{
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
        
    })
    document.getElementById('conteneur').addEventListener('click', function(){
        if (x==1) {
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
    })
</script>