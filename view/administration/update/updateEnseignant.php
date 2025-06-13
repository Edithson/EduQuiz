<?php

require_once('../../../model/Matiere.php');
require_once('../../../model/Utilisateur.php');
require_once('../../../model/Enseignant_Matiere.php');
require_once('../../../model/Db.php');
$email = htmlspecialchars($_GET['id']);

$eng = new Utilisateur();
$matiere = new Matiere();

$matieres = $matiere->readAll();
$enseignant = $eng->read($email);

$enseignant = $enseignant->fetch();
?>
<input type="email" name="Aemail" value="<?=$enseignant['email']?>" style="display: none;" required>
<input type="text" name="type" value="<?=$enseignant['type']?>" style="display: none;" required>
    <label for="">Email : </label><br>
    <input type="email" name="email" value="<?=$enseignant['email']?>" class="filter-input" required><br><br>
    <label for="">Nom : </label><br>
    <input type="text" name="nom" value="<?=$enseignant['nom']?>" class="filter-input" required><br><br>
    <label for="">Type : </label><br>
    <select name="type" class="filter-select" id="type">
        <option value="1" <?php if($enseignant['type']==1){?>selected<?php ;}?> ?>Joueur</option>
        <option value="2" <?php if($enseignant['type']==2){?>selected<?php ;}?> ?>Enseignant</option>
    </select><br><br>
    <span id="type_on" <?php if($enseignant['type']==1){?>style="display: none;"<?php ;}?> ?> >
        <label for="">Matiere : </label><br>
        <div class="classement">
            <?php
            while ($une_matiere = $matieres->fetch()) {
                ?>
                <span><input type="checkbox" name="<?=$une_matiere['id']?>"
                <?php
                $id_mt = Enseignant_Matiere::read_mt($enseignant['email']);
                while ($mt = $id_mt->fetch()) {
                    if ($une_matiere['id']==$mt['id_matiere']) {
                        ?> checked <?php
                    }
                }
                ?>
                ><?=$une_matiere['nom']?></span>
                <?php
            }
            ?>
        </div><br><br>
    </span>
    <input type="submit" name="update" value="valider">
    <button id="hide">Annuler</button>


<script>
    document.getElementById('hide').addEventListener('click', function(e){
        var path = 'index.php?path=enseignant';
        window.location.href = path;
    })

    document.getElementById('type').addEventListener('change', function(){
        const verify = document.getElementById('type').value
        let box_mat = document.getElementById('type_on')
        if (verify == 1) {
            box_mat.style.display = 'none'
        }else{
            box_mat.style.display = 'block'
        }
    })

</script>