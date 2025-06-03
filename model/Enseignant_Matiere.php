<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}

class Enseignant_Matiere
{

    public static function create($email_eng, $id_mt)
    {
        $db = new Db();
        $cnx = $db->getCnx();

        $new = $cnx->prepare('INSERT INTO enseignant_matiere VALUES(?,?)');
        $new->execute(array($email_eng, $id_mt));
    }

    //afficher tous les enseignants d'une matiere
    public static function read_eng($id_mat)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $result = $cnx->prepare('SELECT utilisateur.email AS email_enseignant, utilisateur.nom FROM utilisateur, enseignant_matiere WHERE enseignant_matiere.id_matiere=? AND enseignant_matiere.email_enseignant=utilisateur.email');
        $result->execute(array($id_mat));
        return $result;
    }

    //afficher toutes les matieres d'un enseignant
    public static function read_mt($email_eng, $type=null)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        if (is_null($type)) {
            $result = $cnx->prepare('SELECT DISTINCT(matiere.nom), matiere.id AS id_matiere, matiere.nom AS nom_matiere, matiere.description FROM matiere, enseignant_matiere WHERE enseignant_matiere.id_matiere = matiere.id AND enseignant_matiere.email_enseignant=? ORDER BY matiere.nom');
            $result->execute(array($email_eng));
        }else {
            if ($type > 2) {
                $result = $cnx->prepare('SELECT DISTINCT(matiere.nom), matiere.id AS id_matiere, matiere.nom AS nom_matiere, matiere.description FROM matiere ORDER BY matiere.nom');
                $result->execute(array());
            }else{
                $result = $cnx->prepare('SELECT DISTINCT(matiere.nom), matiere.id AS id_matiere, matiere.nom AS nom_matiere, matiere.description FROM matiere, enseignant_matiere WHERE enseignant_matiere.id_matiere = matiere.id AND enseignant_matiere.email_enseignant=? ORDER BY matiere.nom');
                $result->execute(array($email_eng));
            }
        }
        return $result;
    }

    //afficher les matieres sans enseignant
    public static function read_free()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $result = $cnx->query('SELECT matiere.id, matiere.nom, matiere.description FROM matiere WHERE matiere.id NOT IN (SELECT enseignant_matiere.id_matiere FROM enseignant_matiere)');
        return $result;
    }

    //supprimer toutes les matieres d'un enseignant
    public static function deleteFromEng($id_eng)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $result = $cnx->prepare('DELETE FROM enseignant_matiere WHERE email_enseignant=?');
        $result->execute(array($id_eng));
    }

    //supprimer tous les enseignants d'une matiere
    public static function deleteFromMt($id_mat)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $result = $cnx->prepare('DELETE FROM enseignant_matiere WHERE id_matiere=?');
        $result->execute(array($id_mat));
    }
}