<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}


class Filiere
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }

    public function create($nom, $desc)
    {
        $new = $this->cnx->prepare('INSERT INTO filiere VALUES(?,?,?)');
        $new->execute(array(null, $nom, $desc));
    }

    public static function readAll()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $filiere = $cnx->query('SELECT * FROM filiere ORDER BY id DESC');
        return $filiere;
    }

    public static function readAll2()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $filiere = $cnx->query(
            'SELECT filiere.id, filiere.nom FROM filiere WHERE id IN(
                SELECT classe.id_specialite FROM classe, classe_matiere 
                WHERE classe.id = classe_matiere.id_classe AND classe_matiere.id_matiere IN(
                    SELECT matiere.id FROM matiere, question WHERE matiere.id = question.id_matiere GROUP BY question.id_matiere HAVING COUNT(question.id_matiere)>3
                    )
            )');
        return $filiere;
    }

    public static function read($id)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $filiere = $cnx->prepare('SELECT * FROM filiere WHERE id=?');
        $filiere->execute(array($id));
        return $filiere;
    }

    public function update($id, $nom, $desc)
    {
        $update = $this->cnx->prepare('UPDATE filiere SET nom=?,description=? WHERE id=?');
        $update->execute(array($nom, $desc, $id));
    }

    public static function delete($id)
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $update = $cnx->prepare('DELETE FROM filiere WHERE id=?');
        $update->execute(array($id));
    }

}