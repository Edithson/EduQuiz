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

function contact_message(){
    $email = htmlspecialchars($_POST['email']);
    $nom = htmlspecialchars($_POST['nom']);
    $sujet = htmlspecialchars($_POST['sujet']);
    $message = htmlspecialchars($_POST['message']);
    $mail_msg = "
        <h3>Email de l'expéditeur : ".$email."</h3>
        <h3>Nom de l'expéditeur : ".$nom."</h3>
        <h3>Sujet du message : ".$sujet."</h3>
        <h3>Message : ".$message."</h3>
    ";
    send_mail("eduquizplus@gmail.com", "FeedBack utilisateur", $mail_msg);
    $msg = '🎉 Merci pour votre message ! Nous vous répondrons très bientôt. 😊';
    require_once('view/nous/contact.php');
}

function deconnexion()
{
    session_destroy();
    header('Location: index.php');
}

function show_creation(){
    require_once('view/compte/creation.php');
}

function store_creation($input){
    if (isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password2']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        if ($password == $password2) {
            $user = new Utilisateur();
            $verify = $user->read($email);
            if ($verify->rowCount() == 0) {
                $code = generateRandomHex();
                $msg = "<p>Votre code de validation est le <b>".$code."</b></p>";
                send_mail($email, "Validation d'adresse mail", $msg);
                require_once('view/compte/validation.php');
            }else {
                $msg = 'Cette adresse email est déjà utiliser par un autre!';
                require_once('view/compte/creation.php');
            }
        }else {
            $msg = 'Mot de passe et confirmation incorrect!';
            require_once('view/compte/creation.php');
        }
    }else{
        $msg = 'Veuillez remplir tous les champs!';
        require_once('view/compte/creation.php');
    }
    echo("mamamiya");
}

function creation_validation($input){
    $email = htmlspecialchars($_POST['email']);
    $nom = htmlspecialchars($_POST['nom']);
    $password = htmlspecialchars($_POST['password']);
    $user_code = htmlspecialchars($_POST['user_code']);
    $code = htmlspecialchars($_POST['true_code']);
    if ($user_code == $code) {
        $user = new Utilisateur();
        $create = $user->create($email, $nom, 1, $password);
        if ($create == true) {
            $_SESSION['auth'] = true;
            $_SESSION['admin'] = 0;
            $_SESSION['super_admin'] = 0;
            $_SESSION['email'] = $email;
            $_SESSION['nom'] = $nom;
            $_SESSION['type'] = 0;
            header('Location: index.php');
        }else {
            $msg = 'Une erreur est survenue lors de la création de votre compte'.$create;
            require_once('view/compte/creation.php');
        }
    }else {
        $msg = 'Code incorrect!';
        require_once('view/compte/validation.php');
    }
}

function show_reinitialisation(){
    require_once('view/compte/reinitialisation.php');
}

function store_reinitialisation($input){
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email = htmlspecialchars($_POST['email']);
        $code = generateRandomHex();
        $msg = "<p>Votre code de vérification est le <b>".$code."</b></p>";
        send_mail($email, "Réinitialisation de mot de passe", $msg);
        require_once('view/compte/validation_code_pass.php');
    }else{
        $msg = 'Veuillez entrez votre adresse mail!';
        require_once('view/compte/reinitialisation.php');
    }
}

function reinitialisation_validation($input){
    $user_code = htmlspecialchars($_POST['user_code']);
    $code = htmlspecialchars($_POST['true_code']);
    $email = htmlspecialchars($_POST['email']);
    if ($user_code == $code) {
        require_once('view/compte/reinitialisation_password.php');
    }else {
        $msg = 'Code incorrect!';
        require_once('view/compte/validation_code_pass.php');
    }
}

function store_reinitialisation_validation($input){
    if (isset($_POST['password']) && isset($_POST['password2']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        $password = htmlspecialchars($_POST['password']);
        $password2 = htmlspecialchars($_POST['password2']);
        $email = htmlspecialchars($_POST['email']);
        if ($password == $password2) {
            $user = new Utilisateur();
            $user->update_password($email, $password2);
            session_destroy();
            $msg = 'Le mot de passe à bien été mis à jour!';
            require_once('view/utilisateur/connexion.php');
        }else{
            $msg = 'Le nouveau mot de passe et sa confirmation ne correspondent pas!';
            require_once('view/compte/reinitialisation_password.php');
        }
    }else{
        $msg = 'Veuillez remplir tous les champs!';
        require_once('view/compte/reinitialisation_password.php');
    }
}


function generateRandomHex() {
    // Utilisation de random_int() pour plus de sécurité
    $hex = '';
    for ($i = 0; $i < 4; $i++) {
        $hex .= dechex(random_int(0, 15));
    }
    return strtoupper($hex);
}