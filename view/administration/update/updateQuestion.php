<?php

require_once('../../../model/Question.php');

require_once('../../../model/Db.php');
$id = htmlspecialchars($_GET['id']);

$qt = new Question();

$questions = $qt->readOne($id);
$question = $questions->fetch();
$rep = $question['reponse'];

?>
    <input type="text" style="display: none;" name="id" value="<?=$question['id']?>">
    <input type="text" style="display: none;" name="matiere" value="<?=$question['id_matiere']?>">
    <label for="">Intitule de la question : </label><br>
    <textarea name="int" id="intitule" cols="25" rows="2" class="filter-input" required><?=$question['intitule']?></textarea><br>
    <label for="">proposition réponse 1 : </label><br>
    <textarea name="p1" id="p1" cols="25" rows="2" class="filter-input" required><?=$question['proposition_1']?></textarea><br>
    <label for="">proposition réponse 2 : </label><br>
    <textarea name="p2" id="p2" cols="25" rows="2" class="filter-input" required><?=$question['proposition_2']?></textarea><br>
    <label for="">proposition réponse 3 : </label><br>
    <textarea name="p3" id="p3" cols="25" rows="2" class="filter-input" required><?=$question['proposition_3']?></textarea><br>
    <label for="">proposition réponse 4 : </label><br>
    <textarea name="p4" id="p4" cols="25" rows="2" class="filter-input" required><?=$question['proposition_4']?></textarea><br>
    <label for="">Proposition correct : </label><br>
    <select name="rep" id="rep">
    <?php
    for ($i=1; $i <= 4; $i++) { 
        ?>
        <option value="<?=$i ?>" <?php if ($rep==$i) { ?> selected <?php } ?> >proposition_<?=$i ?></option>
        <?php
    }
    ?>

    </select><br>

    <input type="submit" value="Mettre à jour" name="update" id="vld">
    <button id="hide">Annuler</button>

<script>
    document.getElementById('hide').addEventListener('click', function(e){
        e.preventDefault()
        document.getElementById('drap').style.display='none';
    })
</script>