<?php
require_once('view/layout/nav_bar.php');

if (isset($msg)) {
    echo $msg;
}
?>

<form action="index.php?path=connexion" method="post">
    <label for="">Matricule : </label>
    <input type="text" name="mat" placeholder="facultatif"><br>
    <label for="">email : </label>
    <input type="email" name="email" placeholder="obligatoire"><br>
    <input type="submit" value="valider" name="valider">
</form>