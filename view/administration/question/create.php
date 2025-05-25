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

    
    <form action="index.php?path=question" class="add_question" method="post">
        
        <h3>Ajouter une question</h3>
        <label for="">Intitule de la question : </label><br>
        <textarea name="int" id="intitule" cols="50" rows="2" class="filter-input" required></textarea><br>
        <div class="add_question_conteneur">
            <div>
                <label for="">proposition réponse 1 : </label><br>
                <textarea name="p1" id="p1" cols="25" rows="2" class="filter-input" required></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 2 : </label><br>
                <textarea name="p2" id="p2" cols="25" rows="2" class="filter-input" required></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 3 : </label><br>
                <textarea name="p3" id="p3" cols="25" rows="2" class="filter-input" required></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 4 : </label><br>
                <textarea name="p4" id="p4" cols="25" rows="2" class="filter-input" required></textarea><br>
            </div>
            <div>
                <label for="">Proposition correct : </label><br>
                <select name="rep" id="rep" class="filter-select">
                    <option value="1">proposition_1</option>
                    <option value="2">proposition_2</option>
                    <option value="3">proposition_3</option>
                    <option value="4">proposition_4</option>
                </select><br>
            </div>
            <div>
                <label for="">Matière concerné</label><br>
                <select name="matiere" id="matiere" class="filter-select">
                    <option value="0"></option>
                    <?php
                    while ($matiere = $matieres->fetch()) {
                        ?>
                        <option value="<?=$matiere['id_matiere']?>"
                        <?php
                        if (isset($ma_matiere) && $ma_matiere==$matiere['id_matiere']) {
                            ?>selected<?php
                        }
                        ?>
                        > <?=$matiere['nom_matiere']?> </option>
                        <?php
                    }
                    ?>
                </select><br>
            </div>
            <div></div>
        </div>
        
        <input type="submit" value="Ajouter ✔ " name="valider" id="vld" class="cta-button submit-green-check">
        <input type="button" value="Annuler ❌" name="annuler" onclick="history.back()" class="cta-button">
    </form>
    <?php
    if (isset($msg)) {
        echo $msg;
    }        
    ?>


<script>

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