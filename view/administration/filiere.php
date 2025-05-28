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
            <h1 class="page-title">📚 Gestion des Filières</h1>
            <p class="page-subtitle">
                Organisez et gérez toutes les filières de votre plateforme d'apprentissage. 🎯
            </p>
        </div>

        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher une classe..." 
                       onkeyup="filterSubjects()" id="searchInput">
                <!-- <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select> -->
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
                <button id="hide">Annuler</button>
            </form>
            </div>


        </section>

        <div class="subjects-grid2">

            <h2>Liste des filières</h2>
            <div id="contenu">
                <?php
                while ($filiere = $specialites->fetch()) {
                    ?>
                    <div class="subject-card">
                        <div class="subject-header" style="height: 200px;">
                            <div>
                                <div class="subject-icon">📖</div>
                                <h3 class="subject-title matiere" value="<?=$filiere['id']?>"><?=$filiere['nom']?></h3>
                            </div>
                            <div class="subject-actions">
                                <button class="action-btn edit-btn updateb" value="<?=$filiere['id']?>" title="Modifier">✏️</button>
                                <button class="action-btn delete-btn deleteb" value="<?=$filiere['id']?>" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                        <p><?=$filiere['description']?></p>
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
    
</script>