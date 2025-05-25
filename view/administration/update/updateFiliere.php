<?php

require_once('../../../model/Filiere.php');
require_once('../../../model/Db.php');
$id = htmlspecialchars($_GET['id']);

$fl = new Filiere();
$filieres = $fl->read($id);

$filieres = $filieres->fetch();
?>
    <input style="display: none;" name="id" type="text" value="<?= $filieres['id'] ?>">
    <label for="">Nom de la Spécialité : </label><br>
    <input type="text" name="sp" id="" value="<?= $filieres['nom'] ?>" class="filter-input" required><br><br>
    <label for="">Description de la Spécialité : </label><br>
    <textarea name="desc" id="" cols="20" rows="3" placeholder="facultative" class="filter-input"><?= $filieres['description'] ?></textarea><br><br>
    <input type="submit" value="Mettre à jour" name="update">
    <button id="hide">Annuler</button>
    <script>
        document.getElementById('hide').addEventListener('click', function(e){
            e.preventDefault()
            document.getElementById('drap').style.display='none';
        })
    </script>
    <?php
