<?php

require_once('../../../model/Db.php');
require_once('../../../model/Filiere.php');

Filiere::delete($_GET['id']);
$specialites = Filiere::readAll();

while ($filiere = $specialites->fetch()) {
    ?>
    <h3 class="h3"><?=$filiere['nom']?><option value="<?=$filiere['id']?>" class="filiere"></option></h3>
    <p class="p">Description : <?=$filiere['description']?><br><button value="<?=$filiere['id']?>" class="updateb">Mettre à jour</button> <button value="<?=$filiere['id']?>" class="deleteb danger">Supprimer</button></p>
    <?php
}
?>

<script>
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