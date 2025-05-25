<?php
require_once('view/layout/nav_bar.php');

?>

<div class="stars" id="stars"></div>
    
    <div class="floating-elements">
        <div class="floating-book">📚</div>
        <div class="floating-pencil">✏️</div>
        <div class="floating-lightbulb">💡</div>
    </div>

    <div class="container">

        <section class="user_box">
            <h2>Connectez vous afin d'accéder à l'interface d'administration</h2><br>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
            <form action="index.php?path=connexion" method="post">
                <label for="">Email : </label><br>
                <input type="text" name="email" class="filter-input" required><br><br>
                <label for="">Mot de passe : </label><br>
                <input type="password" name="password" class="filter-input" required><br><br>
                <input type="submit" value="Connexion" name="valider" class="cta-button">
            </form>
        </section>
    </div>
</div>
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