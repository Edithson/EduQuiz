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
            <h2>Créez votre compte pour une expériance plus optimale</h2><br>
            <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
            <form action="index.php?path=user/creation/store" method="post">
                <label for="">Email : </label><br>
                <input type="email" name="email" class="filter-input" required><br><br>
                <label for="">Nom : </label><br>
                <input type="text" name="nom" class="filter-input" required><br><br>
                <label for="">Mot de passe : </label><br>
                <input type="password" name="password" class="filter-input" required><br><br>
                <label for="">Confirmation mot de passe : </label><br>
                <input type="password" name="password2" class="filter-input" required><br><br>
                <input type="submit" value="Créer compte" name="valider" class="cta-button">

                <div id="compte_action">
                    <a href="index.php?path=connexion">Déjà un compte</a>
                </div>
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