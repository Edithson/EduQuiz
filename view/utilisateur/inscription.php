<?php
require_once('view/layout/nav_bar.php');

if (isset($msg) && isset($msg_type)) {?>
    <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
        <strong><?=$msg?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div><?php
}
?>

<form action="index.php?path=connexion" method="post">
    <label for="">Matricule : </label>
    <input type="text" name="mat" placeholder="facultatif"><br>
    <label for="">email : </label>
    <input type="email" name="email" placeholder="obligatoire"><br>
    <input type="submit" value="valider" name="valider">
</form>