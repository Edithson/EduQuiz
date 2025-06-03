<?php
require_once('../../model/Classe_Matiere.php');
require_once('../../model/Db.php');

$matiere = new Classe_Matiere();
$classe = $_GET['classe'];
$matieres = $matiere->read_matiere2($classe);
if ($matieres->rowCount() > 0) {
    echo "<p>Choisis la matière sur laquelle vous souhaités vous auto évaluer</p>";
    echo "<p>Seule les matières ayant plus de 3 questions apparaissent</p>";
    while ($une_matiere = $matieres->fetch()) {
        ?>
        <input type="radio" name="matiere" value="<?=$une_matiere['id_matiere']?>"><?=$une_matiere['nom_mat']?><br>
        <?php
    }
    echo "<br><input type='submit' name='valider' value='Ajouter ✔'>";
}else {
    echo "<p>Aucunes matières trouvées...</p>";
}

?>

<?php

?>