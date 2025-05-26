<?php

require_once('model/Utilisateur.php');

function connexion($input)
{
    if (isset($_POST['valider'])) {
        if (isset($input['email']) && !empty($input['email']) && isset($input['password']) && !empty($input['password'])) {
            $email = htmlspecialchars($input['email']);
            $password = htmlspecialchars($input['password']);
            $eng = new Utilisateur();
            if ($eng->check($email, $password)) {
                $info = $eng->read($email);
                $info = $info->fetch();
                $_SESSION['auth'] = true;
                $_SESSION['admin'] = 0;
                $_SESSION['super_admin'] = 0;
                $_SESSION['email'] = $info['email'];
                $_SESSION['nom'] = $info['nom'];
                $_SESSION['type'] = $info['type'];
                if ($info['type']>1) {
                    $_SESSION['admin'] = 1;
                    if ($info['type']>2) {
                        $_SESSION['super_admin'] = 1;
                    }
                }
                header('Location: index.php');
            }else {
                echo 'Echec de connexion! Information invalide';
            }
        }else {
            echo 'Veuillez remplir correctement tous les champs!';
        }
    }
    require_once('view/utilisateur/connexion.php');
}
  
function profile($input)
{
    $user = new Utilisateur();
    if (isset($input['update1'])) {
        if (isset($input['email']) && isset($input['nom']) && !empty($input['email']) && !empty($input['nom']) ) {
            $nom = htmlspecialchars($input['nom']);
            $email = htmlspecialchars($input['email']);
            if ($email != $_SESSION['email']) {
                $info_user = $user->read($email);
                if ($info_user->rowCount() > 0) {
                    $msg = 'Cet email est déjà utiliser par un autre!';
                }else{
                    $update = $user->update($email, $nom, $_SESSION['type'], $_SESSION['email']);
                }
            }else{
                $update = $user->update($email, $nom, $_SESSION['type'], $_SESSION['email']);
            }
            
            if (isset($update) && $update == 1) {
                $info = $user->read($email);
                $mes_info = $info->fetch();
                $_SESSION['email'] = $mes_info['email'];
                $_SESSION['nom'] = $mes_info['nom'];
                $msg = 'Les informations ont bien été mises à jour!';
            }else {
                $msg = 'Une erreur s’est produite !'.$update;
            }
            
        }else {
            $msg = 'Veuillez remplir tous les champs!';
        }
    }elseif (isset($input['update2'])) {
        if (isset($input['password1']) && isset($input['password2']) && isset($input['password3']) && !empty($input['password1']) && !empty($input['password2']) && !empty($input['password3'])) {
            $password1 = htmlspecialchars($input['password1']);
            $password2 = htmlspecialchars($input['password2']);
            $password3 = htmlspecialchars($input['password3']);
            $info = $user->check($_SESSION['email'], $password1);
            if ($info == true) {
                if ($password2 == $password3) {
                    $user->update_password($_SESSION['email'], $password2);
                    $msg = 'Le mot de passe à bien été mis à jour!';
                }else {
                    $msg = 'Le nouveau mot de passe et sa confirmation ne correspondent pas!';
                }
            }else {
                $msg = 'Ancien mot de passe incorrect!';
            }
        }else {
            $msg = 'Veuillez remplir tous les champs!';
        }
    }
    require_once('view/utilisateur/profile.php');
}

function apropos(){
    require_once('view/nous/a_propos.php');
}

function contact(){
    require_once('view/nous/contact.php');
}

function deconnexion()
{
    session_destroy();
    header('Location: index.php');
}