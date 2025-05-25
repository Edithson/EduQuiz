<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}

class Question
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }

    public function readAll()
    {
        $questions = $this->cnx->prepare('SELECT * FROM question');
        $questions->execute(array());
        return $questions;
    }

    //afficher une question précise
    public function readOne($id)
    {
        $questions = $this->cnx->prepare('SELECT * FROM question WHERE id=?');
        $questions->execute(array($id));
        return $questions;
    }

    //afficher toutes les questions d'une matière
    public function read($id_matiere)
    {
        $questions = $this->cnx->prepare('SELECT * FROM question WHERE id_matiere = ? ORDER BY id DESC');
        $questions->execute(array($id_matiere));
        return $questions;
    }

    public function create($id_matiere, $intitule, $p1, $p2, $p3, $p4, $reponse)
    {
        $new = $this->cnx->prepare('INSERT INTO question VALUES(?,?,?,?,?,?,?,?)');
        $new->execute(array(null, $id_matiere, $intitule, $p1, $p2, $p3, $p4, $reponse));
    }

    public function update($id, $id_matiere, $intitule, $p1, $p2, $p3, $p4, $reponse)
    {
        $update = $this->cnx->prepare('UPDATE question SET id_matiere=?,intitule=?,proposition_1=?,proposition_2=?,proposition_3=?,proposition_4=?,reponse=? WHERE id=?');
        $update->execute(array($id_matiere, $intitule, $p1, $p2, $p3, $p4, $reponse, $id));
    }

    public function delete($id)
    {
        $delete = $this->cnx->prepare('DELETE FROM question WHERE id=?');
        $delete->execute(array($id));
    }

}