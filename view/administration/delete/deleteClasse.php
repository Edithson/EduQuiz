<?php

require_once('../../../model/Db.php');
require_once('../../../model/Classe.php');

$cl = new Classe();
$cl->delete($_GET['id']);
$classes = $cl->readAll();

while ($classe = $classes->fetch()) {
    ?>
    <h3 class="h3"><?=$classe['intitule']?><option value="<?=$classe['id']?>" class="classe"></option></h3>
    <p class="p"><button value="<?=$classe['id']?>" class="updateb">Mettre à jour</button> <button value="<?=$classe['id']?>" class="deleteb danger">Supprimer</button></p>
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