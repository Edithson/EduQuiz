<?php

require_once('../../../model/Db.php');
require_once('../../../model/Classe.php');

$cl = new Classe();
$cl->delete($_GET['id']);
$classes = $cl->readAll();

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
        <p><?=$classe['description']?></p>
    </div>
    <?php
}
?>
<script>
var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#contenue').load('view/administration/delete/deleteClasse.php?id='+id)

        })
    }
    $(document).ready(function(){
        $("p").hide()
        $("h3").click(function(){
            $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
        })
    })
</script>