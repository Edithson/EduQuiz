<?php

require_once('model/Utilisateur.php');
require_once('model/Matiere.php');
require_once('model/Classe.php');
require_once('model/Filiere.php');
require_once('model/Type.php');
require_once('model/Cycle.php');
require_once('model/Classe_Matiere.php');
require_once('model/Enseignant_Matiere.php');

function create_eng($input)
{
    if (isset($input['valider'])) {
        if (isset($input['email']) && isset($input['nom']) && !empty($input['email']) && !empty($input['nom'])) {
            $email = htmlspecialchars($input['email']);
            $nom = htmlspecialchars($input['nom']);
            $type = htmlspecialchars($input['type']);
            $eng = new Utilisateur();
            $create = $eng->create($email, $nom, $type);
            if ($create == 1) {
                $matiere = new Matiere();
                $matieres = $matiere->readAll();
                while ($matiere = $matieres->fetch()) {
                    if (isset($input[''.$matiere['id'].''])) {
                        Enseignant_Matiere::create($email, $matiere['id']);
                    }
                }
                $msg = 'Création Réussie';
                $msg_type = 'success';
            }else {
                $msg = 'Utilisateur déja existant. Type d\'erreur : '.$create;
                $msg_type = 'danger';
            }
        }else {
            $msg = 'Veuillez remplir correctement tout les champs';
            $msg_type = 'warning';
        }
    }elseif (isset($input['update'])) {
        if (isset($input['email']) && isset($input['nom']) && !empty($input['email']) && !empty($input['nom'])) {
            $email = htmlspecialchars($input['email']);
            $nom = htmlspecialchars($input['nom']);
            $type = htmlspecialchars($input['type']);
            $eng = new Utilisateur();
            $anc_eng = new Utilisateur();
            $Aemail = htmlspecialchars($input['Aemail']);
            $ancienne_info = $anc_eng->read($Aemail)->fetch();
            $update = $eng->update($email, $nom, $type, $ancienne_info['email']);
            if ($update == 1) {
                Enseignant_Matiere::deleteFromEng($email);
                $matiere = new Matiere();
                $matieres = $matiere->readAll();
                while ($matiere = $matieres->fetch()) {
                    if (isset($input[''.$matiere['id'].''])) {
                        Enseignant_Matiere::create($email, $matiere['id']);
                    }
                }
                $msg = 'Mise à jour Réussie';
                $msg_type = 'success';
            }else {
                $msg = 'Utilisateur déja existant. Type d\'erreur : '.$update;
                $msg_type = 'warning';
            }
        }else {
            $msg = 'Veuillez remplir correctement tous les champs!';
            $msg_type = 'warning';
        }
    }
    $matiere = new Matiere();
    $matieres = $matiere->readAll();
    $eng = new Utilisateur();
    // $enseignants = $eng->read_eng();
    $enseignants = $eng->readAll();
    $types = Type::readAll();
    require_once('view/administration/nouveauEng.php');
}

function matiere($input)
{
    $matiere = new Matiere();
    $classe = new Classe();
    $eng = new Utilisateur();
    $engs = $eng->read_eng();
    $classes = $classe->readAll();
    if (isset($input['valider'])) {
        if (isset($input['nom']) && !empty($input['nom'])) {
            $nom = htmlspecialchars($input['nom']);
            $desc = htmlspecialchars($input['desc']);
            $matiere->create($nom, $desc);
            $id_mt = $matiere->last_id();
            while ($une_classe = $classes->fetch()) {
                if (isset($input[''.$une_classe['id'].''])) {
                    Classe_Matiere::create($une_classe['id'], $id_mt['id']);
                }
            }
            while ($un_eng = $engs->fetch()) {
                if (isset($input[$un_eng['nom']])) {
                    Enseignant_Matiere::create($un_eng['email'], $id_mt['id']);
                }
            }
            $msg = 'Création réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir le champ nom';
            $msg_type = 'warning';
        }
    }elseif (isset($input['update'])) {
        if (isset($input['nom']) && !empty($input['nom'])) {
            $nom = htmlspecialchars($input['nom']);
            $desc = htmlspecialchars($input['desc']);
            $id = htmlspecialchars($input['id']);
            $matiere->update($id, $nom, $desc);
            Classe_Matiere::deleteForMatiere($id);
            while ($une_classe = $classes->fetch()) {
                if (isset($input[''.$une_classe['id'].''])) {
                    Classe_Matiere::create($une_classe['id'], $id);
                }
            }
            Enseignant_Matiere::deleteFromMt($id);
            while ($un_eng = $engs->fetch()) {
                if (isset($input[''.$un_eng['nom'].''])) {
                    Enseignant_Matiere::create($un_eng['email'], $id);
                }
            }
            $msg = 'Mise à jour réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir le champ nom';
            $msg_type = 'warning';
        }
    }elseif (isset($input['delete'])) {
        $id = htmlspecialchars($input['id']);
        $all_questions = new Question();
        $questions = $all_questions->read($id);
        if ($questions->rowCount() > 0) {
            while ($question = $questions->fetch()) {
                $all_questions->delete($question['id']);
            }
        }
        $matiere = new Matiere();
        $matiere->delete($id);
        $msg = 'Suppression terminée';
        $msg_type = 'success';
    }
    $engs = $eng->read_eng();
    $matieres = $matiere->readAll();
    $classes = $classe->readAll();
    require_once('view/administration/matiere.php');
}

function classe($input)
{
    $matiere = new Matiere();
    $classe = new Classe();
    $matieres = $matiere->readAll();
    if (isset($input['valider'])) {
        if (isset($input['intitule']) && !empty($input['intitule'])) {
            $intitule = htmlspecialchars($input['intitule']);
            $cycle = htmlspecialchars($input['cycle']);
            $sp = htmlspecialchars($input['sp']);
            $classe->create($cycle, $sp, $intitule);
            $id_cl = $classe->last_id();
            while ($une_mt = $matieres->fetch()) {
                if (isset($input[''.$une_mt['id'].''])) {
                    Classe_Matiere::create($id_cl['id'], $une_mt['id']);
                }
            }
            $msg = 'Création réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir tous les champs';
            $msg_type = 'warning';
        }
    }elseif (isset($input['update'])) {
        if (isset($input['intitule']) && !empty($input['intitule'])) {
            $intitule = htmlspecialchars($input['intitule']);
            $cycle = htmlspecialchars($input['cycle']);
            $sp = htmlspecialchars($input['sp']);
            $id = htmlspecialchars($input['id']);
            $classe->update($id, $cycle, $sp, $intitule);
            Classe_Matiere::deleteForClasse($id);
            while ($une_mt = $matieres->fetch()) {
                if (isset($input[''.$une_mt['id'].''])) {
                    Classe_Matiere::create($id, $une_mt['id']);
                }
            }
            $msg = 'Mise à jour réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir tous les champs';
            $msg_type = 'warning';
        }
    }
    $cycles = Cycle::readAll();
    $specialites = Filiere::readAll();
    $specialites2 = Filiere::readAll();
    $matieres = $matiere->readAll();
    $classes = $classe->readAll();
    require_once('view/administration/classe.php');
}

function filiere($input)
{
    $filiere = new Filiere();
    if (isset($input['valider'])) {
        if (isset($input['sp']) && !empty($input['sp'])) {
            $nom = htmlspecialchars($input['sp']);
            $desc = htmlspecialchars($input['desc']);
            $filiere->create($nom, $desc);
            $msg = 'Création réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir tous les champs';
            $msg_type = 'warning';
        }
    }elseif (isset($input['update'])) {
        if (isset($input['sp']) && !empty($input['sp'])) {
            $nom = htmlspecialchars($input['sp']);
            $desc = htmlspecialchars($input['desc']);
            $id = htmlspecialchars($input['id']);
            $filiere->update($id, $nom, $desc);
            $msg = 'Mise à jour réussie';
            $msg_type = 'success';
        }else {
            $msg = 'Veuillez remplir tous les champs';
            $msg_type = 'warning';
        }
    }
    $specialites = Filiere::readAll();
    require_once('view/administration/filiere.php');
}

function create_question(){
    $matieres = Enseignant_Matiere::read_mt($_SESSION['email'], $_SESSION['type']);
    require_once('view/administration/question/create.php');
}

function edit_question(){
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $matieres = Enseignant_Matiere::read_mt($_SESSION['email'], $_SESSION['type']);
        $id = htmlspecialchars($_GET['id']);
    
        $qt = new Question();
    
        $questions = $qt->readOne($id);
        $question = $questions->fetch();
        $rep = $question['reponse'];
    
        require_once('view/administration/question/edit.php');
    }else{
        $matieres = Enseignant_Matiere::read_mt($_SESSION['email'], $_SESSION['type']);
        require_once('view/administration/question.php');
    }
}

function delete_question(){
    if (isset($_GET['id']) && !empty($_GET['id'])) {

        $id = htmlspecialchars($_GET['id']);
        $qt = new Question();
    
        $questions = $qt->delete($id);
        $msg = 'Suppression terminée';
        $msg_type = 'success';
    }
    $question = new Question();
    $questions = $question->readAllByType($_SESSION['email'], $_SESSION['type']);
    $matieres = Enseignant_Matiere::read_mt($_SESSION['email'], $_SESSION['type']);
    require_once('view/administration/question.php');
}

function question($input)
{
    if (isset($_POST['valider'])) {
        $ma_matiere = htmlspecialchars($_POST['matiere']);
        if (isset($_POST['int']) && isset($_POST['p1']) && isset($_POST['p2']) && isset($_POST['p3']) && isset($_POST['p4']) && isset($_POST['rep']) && !empty($_POST['int']) && !empty($_POST['p1']) && !empty($_POST['p2']) && !empty($_POST['p3']) && !empty($_POST['p4']) && !empty($_POST['rep'])) {
            $ma_matiere = htmlspecialchars($_POST['matiere']);
            $intitule = ($_POST['int']);
            $p1 = ($_POST['p1']);
            $p2 = ($_POST['p2']);
            $p3 = ($_POST['p3']);
            $p4 = ($_POST['p4']);
            $rep = ($_POST['rep']);
            $qt = new Question();
            $qt->create($ma_matiere, $intitule, $p1, $p2, $p3, $p4, $rep);
            $msg = "enregistrement ok";
            $msg_type = 'success';
        }else {
            $msg = "veuillez remplir tout les champs";
            $msg_type = 'warning';
        }
        
    }elseif (isset($_POST['update'])) {
        if (isset($_POST['int']) && isset($_POST['p1']) && isset($_POST['p2']) && isset($_POST['p3']) && isset($_POST['p4']) && isset($_POST['rep']) && !empty($_POST['int']) && !empty($_POST['p1']) && !empty($_POST['p2']) && !empty($_POST['p3']) && !empty($_POST['p4']) && !empty($_POST['rep'])) {
            $id = htmlspecialchars($_POST['id']);
            $ma_matiere = htmlspecialchars($_POST['matiere']);
            $intitule = ($_POST['int']);
            $p1 = ($_POST['p1']);
            $p2 = ($_POST['p2']);
            $p3 = ($_POST['p3']);
            $p4 = ($_POST['p4']);
            $rep = htmlspecialchars($_POST['rep']);
            $qt = new Question();
            $qt->update($id, $ma_matiere, $intitule, $p1, $p2, $p3, $p4, $rep);
            $msg = "mise à jour ok";
            $msg_type = 'success';
        }else {
            $msg = "veuillez remplir tout les champs";
            $msg_type = 'warning';
        }
    }
    $question = new Question();
    $questions = $question->readAllByType($_SESSION['email'], $_SESSION['type']);
    $matieres = Enseignant_Matiere::read_mt($_SESSION['email'], $_SESSION['type']);
    require_once('view/administration/question.php');
}