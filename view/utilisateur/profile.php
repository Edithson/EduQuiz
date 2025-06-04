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

        <div class="page-header">
            <h1 class="page-title">📚 Gérez votre profil</h1>
            <p class="page-subtitle">
                Organisez et gérez votre profil à votre ressemblance. 🎯
            </p>
        </div>

        <section class="user_box_profil">
            <br>
            <?php
            if (isset($msg) && isset($msg_type)) {?>
                <div class="alert alert-<?=$msg_type?> alert-dismissible fade show" role="alert">
                    <strong><?=$msg?></strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div><?php
            }
            ?>
            <div>
                <form action="index.php?path=profile" method="post">
                    <label for="">Votre Email : </label>
                    <input type="email" name="email" value="<?=$_SESSION['email']?>" class="filter-input"><br><br>
                    <label for="">Votre nom d'utilisateur : </label>
                    <input type="text" name="nom" value="<?=$_SESSION['nom']?>" class="filter-input"><br><br>
                    <input type="submit" value="Mettre à jour" name="update1" class="cta-button">
                </form>
            </div><br><hr><br>

            <div>
                <form action="index.php?path=profile" method="post">
                    <label for="">Ancient mot de passe : </label>
                    <input type="password" name="password1" class="filter-input"><br><br>
                    <label for="">Nouveau mot de passe : </label>
                    <input type="password" name="password2" class="filter-input"><br><br>
                    <label for="">Confirmation du nouveau mot de passe : </label>
                    <input type="password" name="password3" class="filter-input"><br><br>
                    <input type="submit" value="Mettre à jour" name="update2" class="cta-button">
                    
                    <div id="compte_action">
                        <a href="index.php?path=user/reinitialisation">Mot de passe oublier</a>
                    </div>
                </form>
            </div>
        </section>
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