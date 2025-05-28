<?php

require_once('../../../model/Classe.php');
require_once('../../../model/Matiere.php');
require_once('../../../model/Classe_Matiere.php');
require_once('../../../model/Filiere.php');
require_once('../../../model/Cycle.php');
require_once('../../../model/Db.php');
$id = htmlspecialchars($_GET['id']);

$cl = new Classe();
$matiere = new Matiere();
$cycles = Cycle::readAll();
$specialites = Filiere::readAll();

$matieres = $matiere->readAll();
$classes = $cl->read($id);

$classes = $classes->fetch();

?>
    <input type="text" style="display: none;" name="id" value="<?=$classes['id']?>">
    <label for="">Nom de la classe : </label><br>
    <input required type="text" name="intitule" value="<?=$classes['intitule']?>" class="filter-input"><br><br>
    <label for="">Spécialité : </label><br>
    <select name="sp" id="" class="filter-select">
    <?php
    while ($sp = $specialites->fetch()) {
        ?>
        <option value="<?=$sp['id']?>"
        <?php
        if ($sp['id']==$classes['id_specialite']) {
            ?>selected<?php
        }
        ?>
        ><?=$sp['nom']?></option>
        <?php
    }
    ?>
    </select><br><br>

    <label for="">Cycle : </label><br>
    <select name="cycle" id="" class="filter-select">
    <?php
    while ($cl = $cycles->fetch()) {
        ?>
        <option value="<?=$cl['id']?>"
        <?php
        if ($cl['id']==$classes['id_cycle']) {
            ?>selected<?php
        }
        ?>
        ><?=$cl['intitule']?></option>
        <?php
    }
    ?>
    </select><br><br>
    <label for="">Matierès consernées</label><br>
    <div class="classement">
    <?php
    $i=0;
    while ($une_mt = $matieres->fetch()) {
        ?>
        <span><input class="element" type="checkbox" name="<?=$une_mt['id']?>"
        <?php
        $classe_matiere = Classe_Matiere::read_matiere($classes['id']);
        while ($cl_mt = $classe_matiere->fetch()) {
            if ($une_mt['id']==$cl_mt['id_matiere']) {
                ?>checked <?php
            }
        }
        ?>
        ><?=$une_mt['nom']?></span>
        <?php
        $i++;
    }
    ?></div><br>
    <input type="submit" value="Mettre à jour" name="update">
    <button id="hide">Annuler</button>
    <script>
        document.getElementById('hide').addEventListener('click', function(e){
            e.preventDefault()
            document.getElementById('drap').style.display='none';
            window.location.reload();
        })
    </script>
    <?php
