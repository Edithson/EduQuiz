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
        <input type="text" style="display: none;" name="id" value="<?=$question['id']?>">
        <label for="">Intitule de la question : </label><br>
        <textarea name="int" id="intitule" cols="50" rows="2" class="filter-input" required><?=$question['intitule']?></textarea><br>
        <div class="add_question_conteneur">
            <div>
                <label for="">proposition réponse 1 : </label><br>
                <textarea name="p1" id="p1" cols="25" rows="2" class="filter-input" required><?=$question['proposition_1']?></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 2 : </label><br>
                <textarea name="p2" id="p2" cols="25" rows="2" class="filter-input" required><?=$question['proposition_2']?></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 3 : </label><br>
                <textarea name="p3" id="p3" cols="25" rows="2" class="filter-input" required><?=$question['proposition_3']?></textarea><br>
            </div>
            <div>
                <label for="">proposition réponse 4 : </label><br>
                <textarea name="p4" id="p4" cols="25" rows="2" class="filter-input" required><?=$question['proposition_4']?></textarea><br>
            </div>
            <div>
                <label for="">Proposition correct : </label><br>
                <select name="rep" id="rep" class="filter-select">
                <?php
                    for ($i=1; $i <= 4; $i++) { 
                        ?>
                        <option value="<?=$i ?>" <?php if ($rep==$i) { ?> selected <?php } ?> >proposition_<?=$i ?></option>
                        <?php
                    }
                    ?>
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
                        if ($question['id_matiere']==$matiere['id_matiere']) {
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
        
        <input type="submit" value="Modifier ✔ " name="update" id="vld" class="cta-button submit-green-check">
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