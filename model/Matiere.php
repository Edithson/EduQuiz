<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
    require_once('model/Enseignant_Matiere.php');
}

class Matiere
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
        $new = $this->cnx->prepare('INSERT INTO matiere VALUES(?,?,?)');
        $new->execute(array(null, $nom, $desc));

        /**
         * lorsqu'on enrégistre une nouvelle matiere, tout les utilisateurs super_administrateurs doivent y avoir acces
         */

        //sélection du  dernier id des matiere
        $last_id = $this->cnx->query('SELECT id FROM matiere ORDER BY id DESC LIMIT 1');
        $last_id = $last_id->fetch();

        //selection de l(administrateur)
        $super_admin = $this->cnx->query('SELECT email FROM utilisateur WHERE type > 2');

        //enrégistrement des droits d'acces
        while ($email = $super_admin->fetch()) {
            Enseignant_Matiere::create($email['email'], $last_id['id']);
        }
    }

    public function readAll()
    {
        $matiere = $this->cnx->prepare('SELECT * FROM matiere ORDER BY id DESC');
        $matiere->execute();
        return $matiere;
    }

    public function read($id)
    {
        $matiere = $this->cnx->prepare('SELECT * FROM matiere WHERE id=?');
        $matiere->execute(array($id));
        return $matiere;
    }

    public function update($id, $nom, $desc)
    {
        $update = $this->cnx->prepare('UPDATE matiere SET nom=?,description=? WHERE id=?');
        $update->execute(array($nom, $desc, $id));
    }

    public function delete($id)
    {
        $delete_question = $this->cnx->prepare('DELETE FROM question WHERE id_matiere=?');
        $delete_question->execute(array($id));
        $delete_matiere = $this->cnx->prepare('DELETE FROM matiere WHERE id=?');
        $delete_matiere->execute(array($id));
    }

    public function last_id()
    {
        $id = $this->cnx->query('SELECT id FROM matiere ORDER BY id DESC LIMIT 1');
        return $id->fetch();
    }
}