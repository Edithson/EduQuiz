<?php

require_once('../../../model/Utilisateur.php');
require_once('../../../model/Db.php');
$email = htmlspecialchars($_GET['id']);
$eng = new Utilisateur();
$eng->delete($email);

$enseignants = $eng->read_eng();
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
    $(document).ready(function(){
        $("p").hide()
        $("h3").click(function(){
            $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
        })
    })

</script>