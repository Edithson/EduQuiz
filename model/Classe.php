<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}

class Classe
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }

    public function create($id_cycle, $id_sp, $intitule)
    {
        $new = $this->cnx->prepare('INSERT INTO classe VALUES(?,?,?,?)');
        $new->execute(array(null, $id_cycle, $id_sp, $intitule));
    }

    public function readAll()
    {
        $classe = $this->cnx->query('SELECT * FROM classe');
        return $classe;
    }

    public function read($id)
    {
        $classe = $this->cnx->prepare('SELECT * FROM classe WHERE id=?');
        $classe->execute(array($id));
        return $classe;
    }

    public function delete($id)
    {
        $classe = $this->cnx->prepare('DELETE FROM classe WHERE id=?');
        $classe->execute(array($id));
    }

    //afficher toutes les classes d'une spécialité (filière)
    public function readAll_Classe_Sp($id_sp)
    {
        $classe = $this->cnx->prepare('SELECT classe.id as id, id_cycle, id_specialite, classe.intitule FROM classe, filiere WHERE classe.id_specialite=filiere.id AND filiere.id=?');
        $classe->execute(array($id_sp));
        return $classe;
    }

    public function update($id, $id_cycle, $id_sp, $intitule)
    {
        $update = $this->cnx->prepare('UPDATE classe SET id_cycle=?, id_specialite=?, intitule=? WHERE id=?');
        $update->execute(array($id_cycle, $id_sp, $intitule, $id));
    }

    public function last_id()
    {
        $classe = $this->cnx->query('SELECT id FROM classe ORDER BY id DESC LIMIT 1');
        return $classe->fetch();
    }

}