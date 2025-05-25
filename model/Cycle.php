<?php
if (file_exists('model/Db.php')) {
    require_once('model/Db.php');
}

class Cycle
{
    protected $db;
    protected $cnx;

    public function __construct()
    {
        $this->db = new Db();
        $this->cnx = $this->db->getCnx();
    }

    public function create($intitule)
    {
        $new = $this->cnx->prepare('INSERT INTO cycle VALUES(?,?)');
        $new->execute(array(null, $intitule));
    }

    public static function readAll()
    {
        $db = new Db();
        $cnx = $db->getCnx();
        $cycle = $cnx->query('SELECT * FROM cycle');
        return $cycle;
    }

    public function update($id, $intitule)
    {
        $update = $this->cnx->prepare('UPDATE cycle SET intitule=?, WHERE id=?');
        $update->execute(array($intitule, $id));
    }

}