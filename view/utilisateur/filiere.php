<?php
require_once('../../model/Classe.php');
require_once('../../model/Db.php');

$classe = new Classe();
$sp = $_GET['filiere'];
$classes = $classe->readAll_Classe_Sp($sp);
?>
<option value='0' selected> Choisissez votre niveau </option>;
<?php
    while ($une_classe = $classes->fetch()) {
        ?>
        <option value="<?=$une_classe['id']?>"> <?=$une_classe['intitule']?> </option>
        
        <?php
    }

?>
<?php

?>
