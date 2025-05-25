<?php

require_once('../../../model/Matiere.php');

require_once('../../../model/Db.php');
$id = htmlspecialchars($_GET['id']);

$matiere = new Matiere();

$matieres = $matiere->read($id);

$matieres = $matieres->fetch();


?>

    <input type="text" style="display: none;" name="id" value="<?=$matieres['id']?>">
    <label for="">Nom du cour : <?=$matieres['nom']?></label>
    <p>Attention ! Soyez conscient de ce que vous êtes sur le point de faire.</p>
    <p>La suppression d’une matière entraine également celle de toutes les questions concernant celle-ci…</p>
    <p>Cette opération est irréversible !</p>
    <input type="submit" value="Supprimer" name="delete">
    <button id="hide">Annuler</button>

    <script>
        document.getElementById('hide').addEventListener('click', function(e){
            e.preventDefault()
            document.getElementById('drap').style.display='none';
        })
    </script>