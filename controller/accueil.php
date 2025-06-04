<?php

require_once('model/Filiere.php');
require_once('model/Matiere.php');
require_once('model/Classe.php');
require_once('model/Classe_Matiere.php');
require_once('model/Question.php');

function accueil()
{
    $filiere = new Filiere();
    $filieres = $filiere->readAll();
    $classe = new Classe();
    $classes = $classe->readAll();
    $matieres = Classe_Matiere::read_matiere_classe();
    require_once('view/utilisateur/accueil.php');
}

function start_game()
{
    $filiere = new Filiere();
    $filieres = $filiere->readAll();
    $classe = new Classe();
    $classes = $classe->readAll();
    $matieres = Classe_Matiere::read_matiere_classe();
    require_once('view/utilisateur/accueil.php');
}

function show_question($input)
{
    $question = new Question();
    $filiere = new Filiere();
    $filieres = $filiere->readAll();
    if (isset($input['valider'])) {
        if (isset($input['matiere_game']) && !empty($input['matiere_game'])) {
            $matiere = htmlspecialchars($input['matiere_game']);
            $questions = $question->read($matiere);
            if ($questions->rowCount() > 0) {
                
                //chargement du générateur de question avec l'id des matieres                
                header('Location: API/page1.html?id_mat='.$matiere);
            }else {
                $msg = 'Pour cette matière, il n’existe pas encore de question! Veuillez choisir de nouveau :';
                $msg_type = 'warning';
                require_once('view/utilisateur/accueil.php');
            }
        }else {
            $msg = 'Aucune matière n’a été sélectionnée... Veuillez choisir de nouveau :';
            $msg_type = 'warning';
            require_once('view/utilisateur/accueil.php');
        }
    }else {
        $msg = 'Aucune matière n’a été sélectionnée...\nVeuillez choisir de nouveau :';
        $msg_type = 'warning';
        require_once('view/utilisateur/accueil.php');
    }

}