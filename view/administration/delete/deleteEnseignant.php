<?php

require_once('../../../model/Utilisateur.php');
require_once('../../../model/Db.php');
$email = htmlspecialchars($_GET['id']);
$eng = new Utilisateur();
$eng->delete($email);

$enseignants = $eng->read_eng();
    while ($eng = $enseignants->fetch()) {
        ?>
        <div class="subject-card"
            data_intitule="<?=htmlspecialchars($eng['nom'], ENT_QUOTES, 'UTF-8')?>" 
            data_reponse="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
            data_text="<?=htmlspecialchars($eng['type'], ENT_QUOTES, 'UTF-8')?>">
            
            <div class="subject-header">
                <div>
                    <div class="subject-icon">👨‍🏫</div>
                    <h3 class="subject-title matiere" data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>">
                        <?=htmlspecialchars($eng['nom'], ENT_QUOTES, 'UTF-8')?>
                    </h3>
                </div>
                <div class="subject-actions">
                    <button class="action-btn edit-btn updateb" 
                            data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
                            title="Modifier" value="<?=$eng['email']?>">✏️</button>
                    <button class="action-btn delete-btn deleteb" 
                            data-email="<?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?>" 
                            title="Supprimer" value="<?=$eng['email']?>">🗑️</button>
                </div>
            </div>
            <div class="teacher-info">
                <p class="teacher-email">📧 <?=htmlspecialchars($eng['email'], ENT_QUOTES, 'UTF-8')?></p>
                <?php if (isset($eng['type_intitule'])): ?>
                    <p class="teacher-type">🏷️ <?=htmlspecialchars($eng['type_intitule'], ENT_QUOTES, 'UTF-8')?></p>
                <?php endif; ?>
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