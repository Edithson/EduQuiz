<?php

require_once('model/Question.php');

function get_question(){
    if (isset($_GET['id_mat']) && !empty($_GET['id_mat'])) {
        $id_mat = htmlspecialchars($_GET['id_mat']);
        $question = new Question();
        $qts = $question->read($id_mat);
        $questions = $qts->fetchAll(PDO::FETCH_ASSOC);
    
        $data = [
            'question' => $questions,
            'success' => true
        ];
    }else{
        $data = [
            'question' => null,
            'success' => false
        ];
    }
    // Retourner les données en format JSON
    header('Content-Type: application/json');
    echo json_encode($data);
}