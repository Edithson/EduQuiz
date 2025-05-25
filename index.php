<?php
session_start();
require_once('controller/accueil.php');
require_once('controller/utilisateur.php');
require_once('controller/Administration.php');

$_SESSION['type'] = 3;
$_SESSION['auth'] = true;
$_SESSION['admin'] = 1;
$_SESSION['email'] = "jeremi@gmail.com";
$_SESSION['super_admin'] = 1;

if (isset($_GET['path']) && !empty($_GET['path'])) {
    if ($_GET['path'] == 'accueil') {
        accueil();
    }elseif ($_GET['path'] == 'action') {
        show_question($_POST);
    }elseif ($_GET['path'] == 'connexion') {
        connexion($_POST);
    }elseif ($_GET['path'] == 'deconnexion') {
        deconnexion();
    }elseif ($_GET['path'] == 'enseignant' && isset($_SESSION['type']) && $_SESSION['type'] > 2) {
        create_eng($_POST);
    }elseif ($_GET['path'] == 'question' && isset($_SESSION['type']) && $_SESSION['type'] > 1) {
        question($_POST);
    }elseif ($_GET['path'] == 'question/create' && isset($_SESSION['type']) && $_SESSION['type'] > 1) {
        create_question();
    }elseif ($_GET['path'] == 'question/edit' && isset($_SESSION['type']) && $_SESSION['type'] > 1) {
        edit_question($_GET);
    }elseif ($_GET['path'] == 'question/delete' && isset($_SESSION['type']) && $_SESSION['type'] > 1) {
        delete_question($_GET);
    }elseif ($_GET['path'] == 'matiere' && isset($_SESSION['type']) && $_SESSION['type'] > 2) {
        matiere($_POST);
    }elseif ($_GET['path'] == 'classe' && isset($_SESSION['type']) && $_SESSION['type'] > 2) {
        classe($_POST);
    }elseif ($_GET['path'] == 'filiere' && isset($_SESSION['type']) && $_SESSION['type'] > 2) {
        filiere($_POST);
    }elseif ($_GET['path'] == 'profile' && isset($_SESSION['type'])) {
        profile($_POST);
    }else {
        accueil();
    }
}else {
    accueil();
}
