<?php

require_once('../../../model/Db.php');
require_once('../../../model/Filiere.php');
require_once('../../../model/Classe.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_filiere = htmlspecialchars($_GET['id']);
    $all_classe = new Classe();
    $classes = $all_classe->readAll_Classe_Sp($id_filiere);
    if ($classes->rowCount() > 0) {
        while ($classe = $classes->fetch()) {
            $all_classe->delete($classe['id']);
        }
    }
    Filiere::delete($id_filiere);
    $specialites = Filiere::readAll();
}

while ($filiere = $specialites->fetch()) {
    ?>
    <div class="subject-card" style="height: 270px; overflow: hidden;"
        data_intitule="<?=htmlspecialchars($filiere['description'], ENT_QUOTES, 'UTF-8')?>" 
        data_reponse="<?=htmlspecialchars($filiere['nom'], ENT_QUOTES, 'UTF-8')?>" 
        >
        <div class="subject-header" style="height: 200px;">
            <div>
                <div class="subject-icon">📖</div>
                <h3 class="subject-title matiere" value="<?=$filiere['id']?>"><?=substr($filiere['nom'], 0, 30)?></h3>
            </div>
            <div class="subject-actions">
                <button class="action-btn edit-btn updateb" value="<?=$filiere['id']?>" title="Modifier">✏️</button>
                <button class="action-btn delete-btn deleteb" value="<?=$filiere['id']?>" title="Supprimer">🗑️</button>
            </div>
        </div>
        <p style="margin-top: -30px;"><?=substr($filiere['description'], 0, 50)?></p>
    </div>
    <?php
}
?>

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
$(document).ready(function(){
    $("#contenu p").hide()
    $("h3").click(function(){
        $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
    })
})
</script>