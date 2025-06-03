<?php

require_once('../../../model/Classe.php');
require_once('../../../model/Matiere.php');
require_once('../../../model/Utilisateur.php');
require_once('../../../model/Classe_Matiere.php');
require_once('../../../model/Enseignant_Matiere.php');
require_once('../../../model/Db.php');
$id = htmlspecialchars($_GET['id']);

$cl = new Classe();
$eng = new Utilisateur();
$matiere = new Matiere();

$matieres = $matiere->read($id);
$classes = $cl->readAll();
$enseignants = $eng->read_eng();

$matieres = $matieres->fetch();


?>

    <input type="text" style="display: none;" name="id" value="<?=$matieres['id']?>">
    <label for="">Nom du cour : </label><br>
    <input type="text" name="nom" value="<?=$matieres['nom']?>" class="filter-input" required><br><br>
    <label for="">Description : </label><br>
    <textarea name="desc" id="" cols="20" rows="2" placeholder="facultative" class="filter-input"><?=$matieres['description']?></textarea><br><br>

    <label for="">Classes consernées</label>
    <div class="classement">

    <?php
    while ($une_cl = $classes->fetch()) {
        ?>
        <span><input type="checkbox" name="<?=$une_cl['id']?>"
        <?php
        $classe_mt = Classe_Matiere::read_classe($matieres['id']);
        while ($une_cl_mt = $classe_mt->fetch()) {
            if ($une_cl['id']==$une_cl_mt['id_classe']) {
                ?> checked <?php
            }
        }
        ?>
        ><?=$une_cl['intitule']?></span>
        <?php
    }
    ?></div><br><br>

    <label for="">Enseignants consernés</label>
    <div class="classement">
        
        <?php
        while ($un_eng = $enseignants->fetch()) {
            ?>
            <span><input type="checkbox" name="<?=$un_eng['nom']?>"
            <?php
            $eng_mt = Enseignant_Matiere::read_eng($matieres['id']);
            while ($une_eng_mt = $eng_mt->fetch()) {
                if ($un_eng['email']==$une_eng_mt['email_enseignant']) {
                    ?> checked <?php
                }
            }
            ?>
            ><?=$un_eng['nom']?></span>
            <?php
        }
        ?></div><br><br>

    <input type="submit" value="Mettre à jour" name="update">
    <button id="hide">Annuler</button>

    <script>
        document.getElementById('hide').addEventListener('click', function(e){
            window.location.reload();
        })
    </script>