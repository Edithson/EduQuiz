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
                <!-- <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select> -->
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
                    while ($sp = $specialites->fetch()) {
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
                    <div class="subject-card">
                        <div class="subject-header">
                            <div>
                                <div class="subject-icon">📖</div>
                                <h3 class="subject-title matiere" value="<?=$classe['id']?>"><?=$classe['intitule']?></h3>
                            </div>
                            <div class="subject-actions">
                                <button class="action-btn edit-btn updateb" value="<?=$classe['id']?>" title="Modifier">✏️</button>
                                <button class="action-btn delete-btn deleteb" value="<?=$classe['id']?>" title="Supprimer">🗑️</button>
                            </div>
                        </div>
                        <!-- <p><?=$classe['description']?></p> -->
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
</script>