<?php

require_once('model/Filiere.php');
require_once('model/Question.php');

function accueil()
{
    $filiere = new Filiere();
    $filieres = $filiere->readAll2();
    require_once('view/utilisateur/accueil.php');
}

function show_question($input)
{
    $question = new Question();
    $filiere = new Filiere();
    $filieres = $filiere->readAll();
    if (isset($input['valider'])) {
        if (isset($input['matiere']) && !empty($input['matiere'])) {
            $matiere = htmlspecialchars($input['matiere']);
            $questions = $question->read($matiere);
            if ($questions->rowCount() > 0) {
                //$list_questions = $questions->fetchAll();
                $list_questions = [];
                $i=0;
                $j=1;
                $k=1;
                function generateCookie($id, $list_questions)
                {
                    $value = json_encode($list_questions, JSON_UNESCAPED_UNICODE);
                    setcookie("questions".$id."", $value, time()+300, "/");
                }
                while (($row = $questions->fetch())) {
                    $i++;
                    $tableau = [
                        'id' => $i,
                        'intitule' => $row['intitule'],
                        'proposition_1' => $row['proposition_1'],
                        'proposition_2' => $row['proposition_2'],
                        'proposition_3' => $row['proposition_3'],
                        'proposition_4' => $row['proposition_4'],
                        'reponse' => $row['reponse'],
                    ];
                    $list_questions[] = $tableau;
                    
                    if ($i == 3) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 6) {
                        generateCookie(2, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 9) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 12) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 15) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 18) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 21) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 24) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 27) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }elseif ($i == 30) {
                        generateCookie($j, $list_questions);
                        $list_questions = [];
                        $j++;
                    }
                }
                //trasformation des question en json, en créarion du cookie
                
                header('Location: API/page1.html');
            }else {
                $msg = 'Pour cette matière, il n’existe pas encore de question! Veuillez choisir de nouveau :';
                require_once('view/utilisateur/accueil.php');
            }
        }else {
            $msg = 'Aucune matière n’a été sélectionnée... Veuillez choisir de nouveau :';
            require_once('view/utilisateur/accueil.php');
        }
    }else {
        $msg = 'Aucune matière n’a été sélectionnée...\nVeuillez choisir de nouveau :';
        require_once('view/utilisateur/accueil.php');
    }

}