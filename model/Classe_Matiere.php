<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}

class Classe_Matiere
{

    public static function create($id_classe, $id_mt)
    {
        $db = new Db();
        $cnx = $db->getCnx();

        $new = $cnx->prepare('INSERT INTO classe_matiere VALUES(?,?)');
        $new->execute(array($id_classe, $id_mt));
        
    }

    //supprimer toutes les matieres d'une classe
    public static function deleteForClasse($id_classe)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $del = $cnx->prepare('DELETE FROM classe_matiere WHERE id_classe=?');
        $del->execute(array($id_classe));
    }

    //supprimer toutes les classes d'une matiere
    public static function deleteForMatiere($id_matiere)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $del = $cnx->prepare('DELETE FROM classe_matiere WHERE id_matiere=?');
        $del->execute(array($id_matiere));
    }

    public static function read()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $classe_matiere = $cnx->query('SELECT * FROM classe_matiere');
        return $classe_matiere;
    }

    //afficher toutes les matieres d'une classe
    public static function read_matiere($id_classe)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $classe_matiere = $cnx->prepare('SELECT matiere.id AS id_matiere, matiere.nom AS nom_mat, matiere.description FROM matiere, classe_matiere, classe WHERE classe_matiere.id_matiere=matiere.id AND classe_matiere.id_classe=classe.id AND classe.id=?');
        $classe_matiere->execute(array($id_classe));
        return $classe_matiere;
    }

    public static function read_matiere2($id_classe)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $classe_matiere = $cnx->prepare('SELECT matiere.id AS id_matiere, matiere.nom AS nom_mat, matiere.description FROM matiere, classe_matiere, classe, question WHERE classe_matiere.id_matiere=matiere.id AND classe_matiere.id_classe=classe.id AND classe.id=? AND matiere.id = question.id_matiere GROUP BY question.id_matiere HAVING COUNT(question.id_matiere)>3');
        $classe_matiere->execute(array($id_classe));
        return $classe_matiere;
    }

    //afficher toutes les classes d'une matiere
    public static function read_classe($id_matiere)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $classe_matiere = $cnx->prepare('SELECT classe.id AS id_classe, classe.intitule FROM classe_matiere, classe WHERE classe_matiere.id_classe=classe.id AND classe_matiere.id_matiere=?');
        $classe_matiere->execute(array($id_matiere));
        return $classe_matiere;
    }

    //changer la classe d'une matiere
    /**
     * faire en sorte qu'une matiere sois
     */
}