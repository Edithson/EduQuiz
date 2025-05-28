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
            <h1 class="page-title">📚 Gestion des Enseignants</h1>
            <p class="page-subtitle">
                Organisez et gérez tout le corps enseignant de votre plateforme d'apprentissage. 🎯
            </p>
        </div>

        <div class="action-bar">
            <div class="search-container">
                <input type="text" class="search-input filter-input" placeholder="🔍 Rechercher un enseignant..." 
                       onkeyup="filterSubjects()" id="searchInput">
                <!-- <select class="filter-select" onchange="filterByLevel()" id="levelFilter">
                    <option value="">Tous les niveaux</option>
                    <option value="debutant">Débutant</option>
                    <option value="intermediaire">Intermédiaire</option>
                    <option value="avance">Avancé</option>
                </select> -->
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
                    <input type="submit" name="valider" value="valider">
                    <button id="hide">Annuler</button>
                </form>
            </div>
        </section>

        <div class="subjects-grid2">
        <h2>Liste des Enseignants</h2>

            <div id="contenu">
            <?php
            while ($eng = $enseignants->fetch()) {
                ?>
                <div class="subject-card">
                    <div class="subject-header">
                        <div>
                            <div class="subject-icon">📖</div>
                            <h3 class="subject-title matiere" value="<?=$eng['email']?>"><?=$eng['email']?> | <?=$eng['nom']?><option value="<?=$eng['email']?>"></option></h3>
                        </div>
                        <div class="subject-actions">
                            <button class="action-btn edit-btn updateb" value="<?=$eng['email']?>" title="Modifier">✏️</button>
                            <button class="action-btn delete-btn deleteb" value="<?=$eng['email']?>" title="Supprimer">🗑️</button>
                        </div>
                    </div>
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
</script>