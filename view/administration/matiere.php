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
                       onkeyup="filterSubjects()" id="searchInput">
                <!-- <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select> -->
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
                        <textarea name="desc" id="" cols="20" rows="2" placeholder="facultative" class="filter-input" required></textarea><br><br>
        
                        <label for="">Classes consernées</label>
                        <div class="classement">
                        <?php
                        while ($une_classe = $classes->fetch()) {
                            ?>
                            <span><input type="checkbox" name="<?=$une_classe['id']?>"><?=$une_classe['intitule']?></span>
                            <?php
                        }
                        ?></div><br>
        
                        <label for="">Enseignants consernés</label>
                        <div class="classement">
                        <?php
                        while ($un_eng = $engs->fetch()) {
                            ?>
                            <span><input type="checkbox" name="<?=$un_eng['nom']?>"><?=$un_eng['nom']?></span>
                            <?php
                        }
                        ?></div><br>
        
                        <input type="submit" value="valider" name="valider">
                        <button id="hide">Annuler</button>
                    </form>
                </div>
            </section>

            <div class="subjects-grid2">
                <?php
                echo '<div id="contenu">';
                while ($une_matiere = $matieres->fetch()) {
                    ?>
                    <div class="subject-card">
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
                        <p><?=$une_matiere['nom']?></p>
                    </div>
                    <?php
                }
                echo '</div>';
                ?>
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
    $(document).ready(function(){
        $("p").hide()
        $("h3").click(function(){
            $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
        })
    })

</script>
