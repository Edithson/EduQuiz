<?php
require_once('view/layout/nav_bar.php');
?>
<section class="conteneur" id="conteneur" style="height: 100%;">
    <h2>Votre profil</h2>
<?php
if (isset($msg)) {
    echo $msg.'<br>';
}
?>
<div>
    <form action="index.php?path=profile" method="post">
        <label for="">Votre Email : </label>
        <input type="email" name="email" value="<?=$_SESSION['email']?>"><br><br>
        <label for="">Votre nom d'utilisateur : </label>
        <input type="text" name="nom" value="<?=$_SESSION['nom']?>"><br><br>
        <input type="submit" value="Mettre à jour" name="update1">
    </form>
</div><br><hr>

<div>
    <form action="index.php?path=profile" method="post">
        <label for="">Ancient mot de passe : </label>
        <input type="password" name="password1"><br><br>
        <label for="">Nouveau mot de passe : </label>
        <input type="password" name="password2"><br><br>
        <label for="">Confirmation du nouveau mot de passe : </label>
        <input type="password" name="password3"><br><br>
        <input type="submit" value="Mettre à jour" name="update2">
    </form>
</div>
</section>
<script>
    var x=0
    document.getElementById('check').addEventListener('click', function(e){
        if (x==0) {
            document.getElementById('nav_bar').style.marginLeft='0px';
            x=1
        }else{
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
        
    })
    document.getElementById('conteneur').addEventListener('click', function(){
        if (x==1) {
            document.getElementById('nav_bar').style.marginLeft='-200px';
            x=0
        }
    })
</script>