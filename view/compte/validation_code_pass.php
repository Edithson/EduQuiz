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
            <h2>Dernière ligne droite ;)</h2><br>
            <?php
            if (isset($msg)) {
                echo $msg;
            }
            ?>
            <form action="index.php?path=user/reinitialisation/validation" method="post">
                <div style="display: none;">
                    <input type="email" value="<?=$email?>" name="email" class="filter-input" required><br><br>
                    <input type="text" value="<?=$code?>" name="true_code">
                </div><br>
                
                <label for="">Entrez votre code de vérification reçu par mail</label><br>
                <input type="text" name="user_code" class="filter-input" required><br><br>

                <input type="submit" value="Suivant" name="valider" class="cta-button">
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