<?php

require_once('../../../model/Db.php');
require_once('../../../model/Classe.php');

$cl = new Classe();
$cl->delete($_GET['id']);
$classes = $cl->readAll();

while ($classe = $classes->fetch()) {
    ?>
    <div class="subject-card"
        data_intitule="<?=htmlspecialchars($classe['intitule'], ENT_QUOTES, 'UTF-8')?>" 
        data_reponse="<?=htmlspecialchars($classe['id'], ENT_QUOTES, 'UTF-8')?>" 
        data_text="<?=htmlspecialchars($classe['id_specialite'], ENT_QUOTES, 'UTF-8')?>">
        <div class="subject-header">
            <div>
                <div class="subject-icon">📖</div>
                <h3 class="subject-title matiere" value="<?=$classe['id']?>" data-email="<?=htmlspecialchars($classe['intitule'], ENT_QUOTES, 'UTF-8')?>"><?=$classe['intitule']?></h3>
            </div>
            <div class="subject-actions">
                <button class="action-btn edit-btn updateb" value="<?=$classe['id']?>" title="Modifier">✏️</button>
                <button class="action-btn delete-btn deleteb" value="<?=$classe['id']?>" title="Supprimer">🗑️</button>
            </div>
        </div>
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

    
    $(document).ready(function(){
        $("p").hide()
        $("h3").click(function(){
            $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
        })
    })
</script>