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
            <h2>Opétation de réinitialisation de mot de passe</h2><br>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
            <form action="index.php?path=user/reinitialisation/password/store" method="post">
                <div style="display: none;">
                    <input type="email" value="<?=$email?>" name="email" class="filter-input" required><br><br>
                </div>
                <label for="">Mot de passe : </label><br>
                <input type="password" name="password" class="filter-input" required><br><br>
                <label for="">Confirmation mot de passe : </label><br>
                <input type="password" name="password2" class="filter-input" required><br><br>
                <input type="submit" value="Réinitialiser" name="valider" class="cta-button">
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