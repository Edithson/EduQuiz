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
            <h2>Denierre ligne droite ;)</h2><br>
            <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
            <form action="index.php?path=user/creation/validation" method="post">
                <div style="display: none;">
                    <input type="email" value="<?=$email?>" name="email" class="filter-input" required><br><br>
                    <input type="text" value="<?=$nom?>" name="nom" class="filter-input" required><br><br>
                    <input type="password" value="<?=$password?>" name="password" class="filter-input" required><br><br>
                    <input type="password" value="<?=$password2?>" name="password2" class="filter-input" required><br><br>
                    <input type="text" value="<?=$code?>" name="true_code">
                </div><br>
                
                <label for="">Entrez votre code de vérification reçu par mail</label><br>
                <input type="text" name="user_code" class="filter-input" required><br><br>

                <input type="submit" value="Créer mon compte" name="valider" class="cta-button">

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