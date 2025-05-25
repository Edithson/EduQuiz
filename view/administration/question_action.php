<?php

require_once('../../model/Question.php');
require_once('../../model/Db.php');
if (isset($_GET['id'])) {
    $question = new Question();
    $id = $question->readOne($_GET['id']);
    $id = $id->fetch();
    $mt = $id['id_matiere'];
    $question->delete($_GET['id']);
}else {
    $mt = htmlspecialchars($_GET['matiere']);
}
    
$question = new Question();

$questions = $question->read($mt);
if ($questions->rowCount() > 0) {
    echo '<h2>Liste des questions</h2>';
    echo '<div class="contenu">';
    while ($une_qs = $questions->fetch()) {
        ?>
        <div class="subject-card" style="width: 360px; height: 360px;">
            <div class="subject-header">
                <div>
                    <div class="subject-icon">📖</div>
                    <h3 class="subject-title matiere" value="<?=$une_qs['id']?>"><?php echo(substr($une_qs['intitule'], 0, 700)) ?></h3>
                </div>
                <div class="subject-actions">
                    <button class="action-btn edit-btn updateb" value="<?=$une_qs['id']?>" title="Modifier">✏️</button>
                    <button class="action-btn delete-btn deleteb" value="<?=$une_qs['id']?>" title="Supprimer">🗑️</button>
                </div>
            </div>
            <p>Réponse = <?=$une_qs['proposition_'.$une_qs['reponse']]?></p>
        </div>
        
        <?php
    }
    echo '</div>';
}else {
    echo '<h2>Aucunes questions trouvées pour cette matière</h2>';
}

?>
<h2></h2>

<script>
    $(document).ready(function(){
        $("p").hide()
        $("h3").click(function(){
            $(this).next("p").slideToggle("slow").siblings("p:visible").slideUp("slow");
        })
    })
    var option = document.getElementsByClassName('updateb')
    for (let index = 0; index < option.length; index++) {
        option[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#user_form').load('view/administration/update/updateQuestion.php?id='+id)
            form = document.getElementById('drap')
            form.style.display='inline-block';
        })
    }
    var option2 = document.getElementsByClassName('deleteb')
    for (let index = 0; index < option2.length; index++) {
        option2[index].addEventListener('click', function(e){
            e.preventDefault()
            var id = this.value
            $('#questions').load('view/administration/question_action.php?id='+id)
        })
    }
</script>